export const hasSensitiveWords = (str: string) => {
  let sensitiveWords = ["自拍", "偷拍", "三级", "伦理", "色情", "福利", "擦边"];
  return sensitiveWords.some(word => str.includes(word));
}
export const randomImage = (size?: string, color?: string,text?: string) => {
  return `https://dummyimage.com/${size||'200x300'}?text=${text||'image'}&color=${color||'ccc'}`;
}

interface NormalizeOptions {
  ac?: string;
  t?: string | number;
  unsetT?: boolean;
}

function repairBareAmpersand(raw: string): string {
  const [base, frag] = raw.split('#');
  const repaired = base.replace(/(?<!\?)(&[^=&]+=[^&]*)/g, (_m, param) => {
    return (base.includes('?') ? '&' : '?') + param.slice(1);
  });
  return frag !== undefined ? `${repaired}#${frag}` : repaired;
}

export function normalizeCmsUrl(rawPath: string, opts: NormalizeOptions = {}): string {
  if (!rawPath) return rawPath;
  try {
    const repaired = repairBareAmpersand(rawPath);
    const url = new URL(repaired);
    if (opts.ac !== undefined) {
      url.searchParams.set("ac", opts.ac);
    } else if (!url.searchParams.has("ac")) {
      url.searchParams.set("ac", "list");
    }
    if (opts.t !== undefined && opts.t !== null && opts.t !== "") {
      url.searchParams.set("t", String(opts.t));
    } else if (opts.unsetT) {
      url.searchParams.delete("t");
    }
    const seen = new Set<string>();
    for (const key of Array.from(url.searchParams.keys())) {
      if (seen.has(key)) {
        const vals = url.searchParams.getAll(key);
        url.searchParams.delete(key);
        url.searchParams.set(key, vals[vals.length - 1]);
      }
      seen.add(key);
    }
    return url.toString();
  } catch {
    return rawPath;
  }
}