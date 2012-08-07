
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
      color: hsl(hue(@base), 45%, 90%);
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

  compile = ->
    output_node.innerHTML = "Processing..."
    css = encodeURIComponent editor.getValue()
    send "go.php", "css=#{css}", (req) ->
      output_node.innerHTML = if req.responseText == ""
        '<i class="hint">no output</i>'
      else
        req.responseText

  $("compile-button").onclick = compile
  $("clear-button").onclick = -> editor.setValue ""

  # snippet button
  if snippet_button = $("snippet-button")
    snippet_url = $("snippet-url")
    snippet_button.onclick = ->
      base = window.location.href.match(/^([^#]*)/)[1]
      snippet_url.value = base + "#" + encodeURIComponent(editor.getValue())
      snippet_url.focus()
      snippet_url.select()

    # loading a snippet in the url?
    unless show_example
      hash = window.location.hash.substr(1)
      if hash.length > 0
        editor.setValue decodeURIComponent hash
        compile()

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


window.leafo = {
  track_elm: (id) ->
    if elm = document.getElementById(id)
      elm.onclick = ->
        leafo.track_event "lessphp", "click", id

  track_event: (cat, action, label, value=0, interactive=true) ->
    try
      _gaq.push ['_trackEvent', cat, action, label, value, interactive]
      console.log "tracked #{cat} #{action} #{label}"
    catch e
}

setTimeout (->
  leafo.track_elm "big-download"
  leafo.track_elm "small-download"
  leafo.track_elm "doc-button"
  leafo.track_elm "github-button"), 0

