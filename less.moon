
module "less", package.seeall

export highlight, theme

lpeg = require "lpeg"
import P, R, S, Cs, Cmt, C, Cg, Cb from lpeg

html = require "sitegen.html"

theme = setmetatable {
  sym1: "o"
  sym2: "o"
  sym3: "o"
  prop: "k"
  unit: "cp"
  id: "nx"
  clr: "nx"
  cls: "nx"
  var: "nb"
  var2: "nb"
  tag: "nf"
  url: "s1"
  c2: "c1"
  word: "nv"
}, __index: (k) => k

char = P(1) / html.encode
atom = (R("az", "AZ") + S"-_") * (R("az", "AZ", "09") + S"-_")^0
stop = P"\n" + -1

n = R"09"
num = n^0 * "." * n^1 + n^1

cls = (style) ->
  (text) ->
    style = theme[style]
    '<span class="'..style..'">'..text..'</span>'

match_group = (set) ->
  patt = nil
  for p in *set
    p = (if p[3] then p[2] / p[3] else p[2]) / cls p[1]
    patt = if patt == nil then p else patt + p

  patt + char



tags = {name, true for name in *{
  'abbr', 'acronym', 'address', 'applet', 'area', 'a', 'b', 'base',
  'basefont', 'bdo', 'big', 'blockquote', 'body', 'br', 'button', 'caption',
  'center', 'cite', 'code', 'col', 'colgroup', 'dd', 'del', 'dfn', 'dir',
  'div', 'dl', 'dt', 'em', 'fieldset', 'font', 'form', 'frame', 'frameset',
  'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'head', 'hr', 'html', 'img', 'i',
  'iframe', 'img', 'input', 'ins', 'isindex', 'kbd', 'label', 'legend', 'li',
  'link', 'map', 'menu', 'meta', 'noframes', 'noscript', 'ol', 'optgroup',
  'option', 'p', 'param', 'pre', 'q', 's', 'samp', 'script', 'select',
  'small', 'span', 'strike', 'strong', 'style', 'sub', 'sup', 'tbody', 'td',
  'textarea', 'tfoot', 'th', 'thead', 'title', 'tr', 'tt', 'ul', 'u', 'var'
}}

highlight = (code) ->
  string_var = "@{" * atom * "}" / cls"var2"

  string_patt = (delim, end_delim=delim) ->
    delim = P(delim) / html.encode
    end_delim = P(end_delim) / html.encode

    Cs(delim * (string_var + (char - end_delim))^0 * end_delim)

  unit = num * R("az", "AZ")^0

  hex = R "AF", "af", "09"
  hex3 = hex * hex * hex

  match = match_group {
    { "c1", P"//" * (1 - stop)^0, html.encode }
    { "c2", P"/*" * (1 - P"*/")^0 * P"*/", html.encode }
    { "s1", string_patt"'" }
    { "s2", string_patt'"' }
    { "url", string_patt "url(", ")" }
    { "clr", "#" * hex3 * hex3^-1 }
    { "cls", "." * atom }
    { "var", "@" * atom }
    { "id", "#" * atom }
    { "tag", Cmt(atom, (b, p, t) -> tags[t])  }
    { "prop", atom * #P":"}
    { "unit", unit }
    { "sym1", S":+-/*[];~><" }
    { "sym2", S"()" }
    { "sym2", S"{}" }
    { "word", atom }
  }

  document = Cs(match^0)
  assert document\match code

