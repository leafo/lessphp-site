(function() {
  var $, div, editor, examples, format_date, send;
  examples = {
    "default": '@base: 24px;\n@border-color: #B2B;\n\n.underline { border-bottom: 1px solid green }\n\n#header {\n  color: black;\n  border: 1px solid @border-color + #222222;\n\n  .navigation {\n    font-size: @base / 2;\n    a {\n    .underline;\n    }\n  }\n  .logo {\n    width: 300px;\n    :hover { text-decoration: none }\n  }\n}',
    variables: '@a: 2;\n@x: @a * @a;\n@y: @x + 1;\n@z: @x * 2 + @y;\n\n@nice-blue: #5B83AD;\n@light-blue: @nice-blue + #111;\n\n@b: @a * 10;\n@c: #888;\n@fonts: "Trebuchet MS", Verdana, sans-serif;\n\n.variables {\n  width: @z + 1cm; // 14cm\n  height: @b + @x + 0px; // 24px\n  color: @c;\n  background: @light-blue;\n  font-family: @fonts;\n}\n',
    mixins: '.rounded-corners (@radius: 5px) {\n  border-radius: @radius;\n  -webkit-border-radius: @radius;\n  -moz-border-radius: @radius;\n}\n\n#header {\n  .rounded-corners;\n}\n\n#footer {\n  .rounded-corners(10px);\n}',
    nested_rules: '#header {\n  h1 {\n    font-size: 26px;\n    font-weight: bold;\n  }\n  p {\n    font-size: 12px;\n    a {\n      text-decoration: none;\n      &:hover { border-width: 1px }\n    }\n  }\n}',
    namespaces: '#bundle {\n  .button() {\n    display: block;\n    border: 1px solid black;\n    background-color: grey;\n    &:hover { background-color: white }\n  }\n}\n\n#header a {\n  color: orange;\n  #bundle > .button;\n}',
    color_funcs: '@base: #f04615;\n\n.class {\n  color: saturate(@base, 5%);\n  background-color: lighten(spin(@base, 8), 25%);\n}\n\na {\n  color: hsl(hue(@old), 45%, 90%);\n}\n',
    strings: '@symbol: ">";\nh1:before {\n  content: "@{symbol}: ";\n}\n\n@path: "files/";\nbody {\n  background: url(@{path}my_background.png);\n}\n\n@opacity: 0.5;\n.ie-transparent {\n  filter: e(%("alpha(opacity=%d)", @opacity));\n}'
  };
  send = function(url, data, on_finish) {
    var req;
    if (typeof XMLHttpRequest === "undefined") {
      window.XMLHttpRequest = function() {
        try {
          return new ActiveXObject("Msxml2.XMLHTTP.6.0");
        } catch (e) {
          try {
            return new ActiveXObject("Msxml2.XMLHTTP.3.0");
          } catch (e) {
            throw new Error("Unable to load XMLHttpRequest");
          }
        }
      };
    }
    req = new XMLHttpRequest();
    req.onreadystatechange = function() {
      if (req.readyState === 4) {
        if (req.status === 200) {
          return on_finish(req);
        } else {
          return alert("Fatal error performing XHR [" + req.status + "]");
        }
      }
    };
    req.open("POST", url, true);
    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    return req.send(data);
  };
  $ = function(id) {
    return document.getElementById(id);
  };
  div = function(inner, opts) {
    var node, opt_name, part, _i, _len;
    node = document.createElement("div");
    if (opts) {
      for (opt_name in opts) {
        node[opt_name] = opts[opt_name];
      }
    }
    if (inner) {
      if (typeof inner === "string") {
        node.innerHTML = inner;
      } else {
        for (_i = 0, _len = inner.length; _i < _len; _i++) {
          part = inner[_i];
          node.appendChild(part);
        }
      }
    }
    return node;
  };
  format_date = function(date) {
    return (new Date(date)).toDateString();
  };
  editor = null;
  window.setup_editor = function(show_example) {
    var output_node;
    if (show_example == null) {
      show_example = true;
    }
    window.editor = editor = CodeMirror.fromTextArea($("editor-code"), {
      tabMode: "shift",
      lineNumbers: true
    });
    if (show_example) {
      editor.setValue(examples["default"]);
    }
    output_node = $("demo-out");
    $("compile-button").onclick = function() {
      var css;
      output_node.innerHTML = "Processing...";
      css = encodeURIComponent(editor.getValue());
      return send("go.php", "css=" + css, function(req) {
        return output_node.innerHTML = req.responseText === "" ? '<i class="hint">no output</i>' : req.responseText;
      });
    };
    return $("clear-button").onclick = function() {
      return editor.setValue("");
    };
  };
  window.github_commit_callback = function(out) {
    var commits, container, i, max, more, repo_url, _fn;
    commits = out.commits;
    container = $("commit-list");
    while (container.firstChild) {
      container.removeChild(container.firstChild);
    }
    max = commits.length > 4 ? 4 : commits.length;
    _fn = function(i) {
      var author_url, commit, date, node;
      commit = commits[i];
      date = format_date(commit.committed_date);
      author_url = "http://github.com/" + commit.author.login;
      node = div([
        div("<b>" + date + "</b> &#151; <a href=\"" + author_url + "\">" + commit.author.login + "</a>"), div(commit.message, {
          className: "commit-message"
        })
      ], {
        className: "single-commit"
      });
      node.onclick = function() {
        return window.location = "http://github.com" + commit.url;
      };
      return container.appendChild(node);
    };
    for (i = 0; 0 <= max ? i < max : i > max; 0 <= max ? i++ : i--) {
      _fn(i);
    }
    repo_url = "http://github.com/leafo/lessphp/commits/master";
    more = div("<a href=\"" + repo_url + "\">See all...</a>", {
      className: 'center'
    });
    container.appendChild(more);
    return null;
  };
  window.load_example_links = function() {
    var link, links, _i, _len, _results;
    links = $("demoselect").getElementsByTagName("a");
    _results = [];
    for (_i = 0, _len = links.length; _i < _len; _i++) {
      link = links[_i];
      _results.push(link.onclick = function() {
        var ex, id;
        id = this.id.match(/load_([\w_]+)/);
        if (id) {
          ex = examples[id[1]];
          if (ex) {
            editor.setValue(ex);
          } else {
            alert("Failed to load example: " + id);
          }
        }
        return false;
      });
    }
    return _results;
  };
  window.load_github_commits = function() {
    var script;
    script = document.createElement("script");
    script.type = "text/javascript";
    script.async = true;
    script.src = "github.php";
    return document.body.appendChild(script);
  };
}).call(this);
