require "sitegen"

extra = require "sitegen.extra"
html = require "sitegen.html"

-- compile less to css
compile_less = (code) ->
  fname = os.tmpname!
  with io.open fname, "w"
    \write code
    \close!

  handle = io.popen "plessc "..fname
  handle\read"*a"

site = sitegen.create_site =>
  -- automatically add <?php when it's missing
  extra.PygmentsPlugin.custom_highlighters.php = (code_text) =>
    remove_php = false
    if not code_text\match "%s*<%?php"
      remove_php = true
      code_text = "<?php ".. code_text

    html_code = @highlight "php", code_text
    if remove_php
      front = escape_patt '<span class="cp">&lt;?php</span> '
      html_code = html_code\match "^%s*" .. front .. "(.-)\n?$"

    @pre_tag html_code, "php"

  extra.PygmentsPlugin.custom_highlighters.less = (code_text) =>
    if code_text\match"@import"
      @pre_tag code_text
    else
      css = compile_less code_text
      html.build ->
        tag.table {
          __breakclose: true
          class: "code-split"
          cellspacing: "0"
          cellpadding: "0"
          tr {
            td {
              raw @pre_tag code_text
            }
            td {
              class: "right-cell"
              raw @pre_tag @highlight "css", css
            }
          }
        }

  @title = "lessphp"
  feed "feed.moon", "feed.xml"
  add "docs/index.md"

site\write!
