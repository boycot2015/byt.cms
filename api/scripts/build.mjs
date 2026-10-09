import { build } from "esbuild";
import { mkdir, rm, stat, writeFile } from "node:fs/promises";
import { fileURLToPath, pathToFileURL } from "node:url";
import { tmpdir } from "node:os";
import path from "node:path";

/**
 * 把 TypeScript 源码构建成 EdgeOne Makers 可部署的产物。
 *
 * 产出两部分：
 *
 * 1. `cloud-functions/api` 下的函数文件 —— 每个 URL 一个。
 *    EdgeOne 按文件名做文件路由，且每个函数文件独立构建、不支持项目内的相对
 *    import，所以每个产物都是自包含的 bundle：入口统一 `export { onRequest }`
 *    来自 src/runtime.ts，实际路由仍由运行时按 path 分发（与原来 wrangler 的
 *    fetch 分发逻辑一致）。没有用 `[[default]].js` catch-all，是因为平台的
 *    静态资源层会先接管 `/`，且 catch-all 在构建期的识别不如具体文件名可靠。
 *
 * 2. 根目录 `index.html` —— 静态 API 文档页。
 *    `/` 不会转发给云函数，只能以静态文件形式提供；模板与 `/index.html`
 *    路由共用 src/utils/docsPage.ts，两处内容不会漂移。
 *
 * `--packages=external` 让 `@edgeone/pages-blob` 保持为运行时依赖 —— 按 EdgeOne
 * 的要求，第三方包声明在根 package.json 的 dependencies 里，由平台安装。
 */

/** 需要生成函数文件的 API 路由，与 src/routes 里的 path 判断一一对应。 */
const API_ROUTES = [
  "api/articles",
  "api/categories",
  "api/categories/page",
  "api/comments",
  "api/cron",
  "api/docs",
  "api/health",
  "api/site-config",
  "api/tags",
  "api/tags/page",
  "api/upload/image",
  "api/users",
  "api/users/login",
  "api/users/register",
  "api/video-fetch-recommend",
  "api/video-source-probe",
  "api/video-sources",
  "api/videos",
  "api/videos/recommended",
];

const root = path.resolve(path.dirname(fileURLToPath(import.meta.url)), "..");
const functionsDir = path.join(root, "cloud-functions");

await rm(functionsDir, { recursive: true, force: true });
await mkdir(functionsDir, { recursive: true });

// ── 1. 云函数产物 ────────────────────────────────────────────────
// resolveDir 固定为项目根，这样不论输出目录深浅都能用同一条 import 路径。
const shared = {
  bundle: true,
  format: "esm",
  platform: "node",
  target: "node20",
  packages: "external",
  minify: false,
  sourcemap: false,
  legalComments: "none",
  logLevel: "warning",
  banner: {
    js: "// 由 scripts/build.mjs 自动生成，请勿直接修改。",
  },
};

for (const route of API_ROUTES) {
  await mkdir(path.dirname(path.join(functionsDir, route)), { recursive: true });
  await build({
    ...shared,
    stdin: {
      contents: 'export { onRequest } from "./src/runtime";',
      resolveDir: root,
      sourcefile: `${route}.js`,
      loader: "js",
    },
    outfile: path.join(functionsDir, `${route}.js`),
  });
}

// ── 2. 静态文档首页 ──────────────────────────────────────────────
// docsPage.ts 是 TypeScript，先单独编译一份再 import，避免在构建脚本里重复模板。
const tmpModule = path.join(tmpdir(), `byt-cms-docsPage-${process.pid}.mjs`);
await build({
  ...shared,
  entryPoints: [path.join(root, "src/utils/docsPage.ts")],
  outfile: tmpModule,
});

const { renderDocsPage } = await import(pathToFileURL(tmpModule).href);
await writeFile(path.join(root, "index.html"), renderDocsPage(), "utf8");
await rm(tmpModule, { force: true });

const { size } = await stat(path.join(functionsDir, "api/videos.js"));
console.log(
  `构建完成：${API_ROUTES.length} 个云函数（单份约 ${(size / 1024).toFixed(0)} KB）+ 静态 index.html`
);
