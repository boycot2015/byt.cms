export const hasSensitiveWords = (str: string) => {
  let sensitiveWords = ["自拍", "偷拍", "三级", "伦理", "色情", "福利"];
  return sensitiveWords.some(word => str.includes(word));
}