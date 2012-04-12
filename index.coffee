
examples = {
  default: '''
    @base: 24px;
    @border-color: #B2B;

    .underline { border-bottom: 1px solid green }

    #header {
      color: black;
      border: 1px solid @border-color + #222222;

      .navigation {
        font-size: @base / 2;
        a {
        .underline;
        }
      }
      .logo {
        width: 300px;
        :hover { text-decoration: none }
      }
    }
  '''
  variables: '''
    @a: 2;
    @x: @a * @a;
    @y: @x + 1;
    @z: @x * 2 + @y;

    @nice-blue: #5B83AD;
    @light-blue: @nice-blue + #111;

    @b: @a * 10;
    @c: #888;
    @fonts: "Trebuchet MS", Verdana, sans-serif;

    .variables {
      width: @z + 1cm; // 14cm
      height: @b + @x + 0px; // 24px
      color: @c;
      background: @light-blue;
      font-family: @fonts;
    }
    
  '''
  mixins: '''
    .rounded-corners (@radius: 5px) {
      border-radius: @radius;
      -webkit-border-radius: @radius;
      -moz-border-radius: @radius;
    }

    #header {
      .rounded-corners;
    }

    #footer {
      .rounded-corners(10px);
    }
  '''
  nested_rules: '''
    #header {
      h1 {
        font-size: 26px;
        font-weight: bold;
      }
      p {
        font-size: 12px;
        a {
          text-decoration: none;
          &:hover { border-width: 1px }
        }
      }
    }
  '''
  namespaces: '''
    #bundle {
      .button() {
        display: block;
        border: 1px solid black;
        background-color: grey;
        &:hover { background-color: white }
      }
    }

    #header a {
      color: orange;
      #bundle > .button;
    }
  '''
  color_funcs: '''
    @base: #f04615;

    .class {
      color: saturate(@base, 5%);
      background-color: lighten(spin(@base, 8), 25%);
    }

    a {
      color: hsl(hue(@old), 45%, 90%);
    }

  '''
  strings: '''
    @symbol: ">";
    h1:before {
      content: "@{symbol}: ";
    }

    @path: "files/";
    body {
      background: url(@{path}my_background.png);
    }

    @opacity: 0.5;
    .ie-transparent {
      filter: e(%("alpha(opacity=%d)", @opacity));
    }
  '''
}

send = (url, data, on_finish) ->
  if typeof XMLHttpRequest == "undefined"
    window.XMLHttpRequest = ->
      try
        new ActiveXObject "Msxml2.XMLHTTP.6.0"
      catch e
        try
          new ActiveXObject "Msxml2.XMLHTTP.3.0"
        catch e
          throw new Error "Unable to load XMLHttpRequest"

   req = new XMLHttpRequest()
   req.onreadystatechange = ->
     if req.readyState == 4
       if req.status == 200
         on_finish req
       else
         alert "Fatal error performing XHR [#{req.status}]"

   req.open "POST", url, true
   req.setRequestHeader "Content-type", "application/x-www-form-urlencoded"
   req.send data

$ = (id) -> document.getElementById(id)

div = (inner, opts) ->
  node = document.createElement "div"
  if opts
    for opt_name of opts
      node[opt_name] = opts[opt_name]

  if inner
    if typeof inner == "string"
      node.innerHTML = inner
    else
      node.appendChild part for part in inner

  node

# repository tracker
format_date = (date) ->
  (new Date(date)).toDateString()

editor = null
window.setup_editor = (show_example=true)->
  # prepare editor
  window.editor = editor = CodeMirror.fromTextArea $("editor-code"), {
    tabMode: "shift",
    lineNumbers: true
  }

  editor.setValue examples.default if show_example

  output_node = $ "demo-out"

  $("compile-button").onclick = ->
    output_node.innerHTML = "Processing..."
    css = encodeURIComponent editor.getValue()
    send "go.php", "css=#{css}", (req) ->
      output_node.innerHTML = if req.responseText == ""
        '<i class="hint">no output</i>'
      else
        req.responseText

  $("clear-button").onclick = ->
    editor.setValue ""

## commit callback
window.github_commit_callback = (out) ->
  commits = out.commits
  container = $ "commit-list"
  container.removeChild container.firstChild while container.firstChild

  max = if commits.length > 4 then 4 else commits.length
  for i in [0...max]
    do (i) ->
      commit = commits[i]
      date = format_date commit.committed_date
      author_url = "http://github.com/#{commit.author.login}"

      node = div [
        div "<b>#{date}</b> &#151; <a href=\"#{author_url}\">#{commit.author.login}</a>"
        div commit.message, { className: "commit-message" }
      ], { className: "single-commit" }

      node.onclick = ->
        window.location = "http://github.com#{commit.url}"

      container.appendChild node

  repo_url = "http://github.com/leafo/lessphp/commits/master"
  more = div "<a href=\"#{repo_url}\">See all...</a>", { className: 'center'}
  container.appendChild more
  null

window.load_example_links = ->
  links = $("demoselect").getElementsByTagName "a"
  for link in links
    link.onclick = ->
      id = this.id.match(/load_([\w_]+)/)
      if id
        ex = examples[id[1]]
        if ex
          editor.setValue(ex)
        else
          alert "Failed to load example: #{id}"
      false

window.load_github_commits = ->
  script = document.createElement "script"
  script.type = "text/javascript"
  script.async = true
  script.src = "github.php"

  document.body.appendChild script


window.leafo = {
  track_event: (cat, action, label, value=0, interactive=true) ->
    try
      _gaq.push ['_trackEvent', cat, action, label, value, interactive]
    catch e
}

