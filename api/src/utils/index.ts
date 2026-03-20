export const hasSensitiveWords = (str: string) => {
  let sensitiveWords = ["自拍", "偷拍", "三级", "伦理", "色情", "福利", "擦边"];
  return sensitiveWords.some(word => str.includes(word));
}
export const randomImage = (size?: string, color?: string,text?: string) => {
  return `https://dummyimage.com/${size||'200x300'}?text=${text||'image'}&color=${color||'ccc'}`;
}
