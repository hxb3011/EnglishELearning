// @ts-check

/**
 * @template T
 * @param {T} def 
 * @param {T} [val] 
 */
function udef(def, val) { return val !== undefined ? val : def; }