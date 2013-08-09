require "sitegen"

extra = require "sitegen.extra"
html = require "sitegen.html"
tools = require "sitegen.tools"

-- compile less to css
compile_less = (code) ->
  fname = os.tmpname!
  with io.open fname, "w"
    \write code
    \close!

  handle = io.popen "plessc "..fname
  handle\read"*a"

less = require "less"

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

  extra.PygmentsPlugin.custom_highlighters.lessbasic = (code_text) =>
    @pre_tag less.highlight code_text

  extra.PygmentsPlugin.custom_highlighters.less = (code_text) =>
    if code_text\match"@import"
      return extra.PygmentsPlugin.custom_highlighters.lessbasic code_text

    css = compile_less code_text
    html.build ->
      tag.table {
        __breakclose: true
        class: "code-split"
        cellspacing: "0"
        cellpadding: "0"
        tr {
          class: "split-header"
          td "LESS"
          td { "CSS", class: "right-header" }
        }
        tr {
          td {
            raw @pre_tag less.highlight code_text
          }
          td {
            class: "right-cell"
            raw @pre_tag less.highlight css
          }
        }
      }

  @title = "lessphp"
  @current_version = "0.4.0"
  deploy_to "leaf@leafo.net", "www/lessphp"
  feed "feed.moon", "feed.xml"
  add "docs/index.md"
  add "editor.html"
  add "changelog.moon"

  scssphp = tools.system_command "pscss < %s > %s", "css"
  lessphp = tools.system_command "plessc -r < %s > %s", "css"

  coffeescript = tools.system_command "coffee -c -s < %s > %s", "js"

  build scssphp, "style.scss", "style/style.css"
  build coffeescript, "index.coffee"

site\write!
