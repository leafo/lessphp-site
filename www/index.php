
<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/reset.css" />
	<link rel="stylesheet" href="css/text.css" />
	<link rel="stylesheet" href="css/960.css" />
	<link rel="stylesheet" href="css/main.css" />
	<title>lessphp - leaner css in php</title>
	<link rel="alternate" type="application/rss+xml" title="lessphp changelog feed" href="http://leafo.net/lessphp/feed/" /> 

	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-136625-1']);
	  _gaq.push(['_trackPageview']);

	  (function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>
</head>
<body>
	<div class="top"></div>

	<div class="header">
		<div class="container_12">
			<h1><a href="http://leafo.net/lessphp">lessphp</a></h1>
		</div>
	</div>


	<div class="container_12">
		<div class="grid_4">
			<ul id="nav">
				<li><a href="#about">About</a></li>
				<li><a href="#broken">Issues</a></li>
				<li><a href="#demo">Demo</a></li>
				<li><a href="#download">Download</a></li>
				<li><a href="#quickstart">Quick Start</a></li>
				<li><a href="#changelog">Changelog</a></li>
				<li><a href="#comments">Comments</a></li>
			</ul>
		</div>

		<div class="grid_4 green-info">
			<div class="pad">
				<h3>Resources</h3>
				<ul>
					<li>The <a href="http://leafo.net/lessphp/docs/">official documentation</a>.</li>
					<li>A <a href="http://leafo.net/lessphp/vim/">Vim syntax</a> file.</li>
				</ul>
			</div>
		</div>

		<div class="grid_4 green-info">
			<div class="pad">
				<h3>Plugins</h3>
				<ul>
					<li><a href="http://www.symfony-project.org/plugins/sgLESSPlugin">Symfony plugin</a> 
						<span class="sub">by <a href="http://blog.servergrove.com/2009/07/30/css-symfony-plugin-with-lessphp/">ServerGrove</a></li></span>
					<li><a href="http://wordpress.org/extend/plugins/wp-less/">Wordpress plugin</a> 
						<span class="sub">by <a href="http://case.oncle-tom.net/">Oncle Tom</a></span></li>

					<li><a href="http://www.cotonti.com/downloads/plugins/general/lesscss">Cotonti plugin</a> 
						<span class="sub">by <a href="http://www.ghengeveld.nl">Gert Hengeveld</a></span></li>

				</ul>
			</div>
		</div>

		<div class="clear"></div>

		<div class="grid_12">
			<div class="new">
				<strong>New:</strong> Try converting your existing CSS into LESS using
				<a href="http://leafo.net/lessphp/lessify">lessify</a>.
			</div>


			<a name="about"></a>
			<h2>About</h2>
			<p><strong>lessphp</strong> is a compiler for <a href="http://lesscss.org/">LESS</a> written in PHP.</p>
			<p>The entire compiler comes in a single includable class, but an additional command line interface  to the compiler is included. See the <a href="#quickstart">quick start</a> for basic usage.</p>

			<p>For an overview of the syntax take a look at the <a href="http://leafo.net/lessphp/docs/"><strong>lessphp</strong> official documentation</a>.


			<a name="broken"></a>
			<h2>Issues</h2>
			<p>If you find something that isn't working right feel free to <a href="#comments">leave a comment</a> or 
			post on the <a href="http://github.com/leafo/lessphp/issues">github issues tracker</a>.
			If you have any interesting ideas for additions to the language please do suggest them as well. You can also
			<a href="mailto:leafot+less@gmail.com">email me</a> if you want.</p>


			<a name="demo"></a>
			<h2>Demo</h2>
			<p>Use the demo to test the compiler using your
			own code, or click through the example buttons to see various parts of the language.<p>

			<div class="demo" id="demoselect">
				<div class="pad-small">
				More Examples: 
					<a id="load1" href="#demo">variables</a>, 
					<a id="load2" href="#demo">mixins</a>,
					<a id="load3" href="#demo">nested rules</a>,
					<a id="load4" href="#demo">accessors</a>,
					<a id="load5" href="#demo">namespaces</a>,
					<a id="load6" href="#demo">mixin functions</a>
				</div>
			</div>

			<div>
			<table class="demo" border="0"><tr valign="top">
				<td class="input">
					<p>LESS goes here:</p>
					<textarea id="lessin" rows="20">@base: 24px;
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
}</textarea>
					<div class="buttons">
						<button id="go">Go</button>
						<button id="clear">Clear</button>
					</div>
				</td>
				<td class="output">
					<p>CSS comes here:</p>
					<pre id="lessout"></pre>
				</td>
			</tr></table>
			</div>

		</div>


		<div class="grid_6">
			<a name="download"></a>
			<h2>Download</h2>
			<p>repo: <a href="http://github.com/leafo/lessphp/tree/master">http://github.com/leafo/lessphp/tree/master</a>
			<p>stable: <a href="http://leafo.net/lessphp/src/lessphp-0.2.0.tar.gz">lessphp-0.2.0.tar.gz</a></p>
			<p><i>This archive is a little outdated, if possible try to download the latest version from the repository.</i></p>
		</div>

		<div class="grid_6">
			<h2>Repository Tracker</h2>
			<div id="commit-list">
				Loading...
			</div>
		</div>


		<div class="clear"></div>

		<div class="grid_12">
		
	<a name="quickstart"></a>
	<h2>Quick Start</h2>


<p>There are a few ways to interface with the compiler. The easiest is to have it
compile a LESS file when the page is requested. The static function 
<code>less::ccompile</code>, checked compile, will compile the input LESS file only when it
is newer than the output file.<p>

<pre class="code">
<span class="PreProc">require</span> '<span class="String">lessc.inc.php</span>';

<span class="Statement">try</span> <span class="Delimiter">{</span>
    lessc<span class="Operator">::</span>ccompile<span class="Delimiter">(</span>'<span class="String">input.less</span>', '<span class="String">out.css</span>'<span class="Delimiter">)</span>;
<span class="Delimiter">}</span> <span class="Statement">catch</span> <span class="Delimiter">(</span><span class="Function">exception</span> <span class="Operator">$</span><span class="Identifier">ex</span><span class="Delimiter">)</span> <span class="Delimiter">{</span>
    <span class="Statement">exit</span><span class="Delimiter">(</span>'<span class="String">lessc fatal error:&lt;br /&gt;</span>'<span class="Operator">.</span><span class="Operator">$</span><span class="Identifier">ex</span><span class="Type">-&gt;</span>getMessage<span class="Delimiter">())</span>;
<span class="Delimiter">}</span>
</pre>

<br />
<p>Note that all failures with lessc are reported through exceptions.
If you need more control you can make your own instance of <code>lessc</code>.</p>
<pre class="code">
<span class="PreProc">require</span> '<span class="String">lessc.inc.php</span>';

<span class="Operator">$</span><span class="Identifier">less</span> <span class="Operator">=</span> <span class="PreProc">new</span> lessc<span class="Delimiter">(</span>'<span class="String">path/to/style.less</span>'<span class="Delimiter">)</span>;
<span class="Function">file_put_contents</span><span class="Delimiter">(</span>'<span class="String">path/to/style.css</span>', <span class="Operator">$</span><span class="Identifier">less</span><span class="Type">-&gt;</span>parse<span class="Delimiter">())</span>;
</pre>

<br />
<p>In addition to loading from file, you can also parse from a string like so:</p>
<pre class="code">
<span class="PreProc">require</span> '<span class="String">lessc.inc.php</span>';

<span class="Operator">$</span><span class="Identifier">less</span> <span class="Operator">=</span> <span class="PreProc">new</span> lessc<span class="Delimiter">()</span>;
<span class="Operator">$</span><span class="Identifier">style</span> <span class="Operator">=</span> '<span class="String">&lt;style type=&quot;text/css&quot;&gt;</span>'<span class="Operator">.</span>
    <span class="Operator">$</span><span class="Identifier">less</span><span class="Type">-&gt;</span>parse<span class="Delimiter">(</span>'<span class="String">.block { padding: 3 + 4px }</span>'<span class="Delimiter">)</span><span class="Operator">.</span>
    '<span class="String">&lt;/style&gt;</span>';
</pre>
		
			<p>For a more detailed overview of the lessphp object, check out <a href="http://leafo.net/lessphp/docs/">the documentation</a>.</p>
		</div>


		<div class="grid_12">
			<a name="changelog"></a>
			<h2>Changelog</h2>
			<p id="changelog-message"><a href="javascript:show_changelog();">Click here</a> to show changelog.</p>
			<div id="log" style="display: none;">
				<a name="v0.2.0"></a>
				<div style="margin: 0.0 1.0em 0.5em;"><code><b>version 0.2.0 - March 27 2010</b></code><ul>
					<li>reimplemented core parsing techniques, 50% speed up</li>
					<li>all css selectors should be functional</li>
					<li>support for @charset @font-face</li>
					<li><code>&</code> operator for nesting chained blocks</li>
					<li><code>!</code> operator for inserting important property</li>
					<li>exposed function api: <a href="http://github.com/leafo/lessphp/commit/2fb4296a6a7287ea53e99b73858bfd5a44834cad">http://github.com/leafo/lessphp/commit/2fb4296a6a7287ea53e99b73858bfd5a44834cad</a></li>
					<li>much better number, color, and string parsing support</li>
				</ul></div>


				<a name="v0.1.6"></a>
				<div style="margin: 0.0 1.0em 0.5em;"><code><b>version 0.1.6 - August 21 2009</b></code><ul>
					<li>rewrote command line tool, plessc, with more logical argument parsing and proper exit codes</li>
					<li>separate blocks of the same name will now merge instead of overwriting each over</li>
					<li>fixed a bug with any type of mixin not searching outside the scope</li>
					<li>updated this webpage</li>
				</ul></div>

				<a name="v0.1.5"></a>
				<div style="margin: 0.0 1.0em 0.5em;"><code><b>version 0.1.5 - August 6 2009</b></code><ul>
					<li>wrote documentation, see <a href="http://leafo.net/lessphp/docs/">http://leafo.net/lessphp/docs/</a></li>
					<li>added support for variables inside of strings</li>
					<li>mixins append their data into the block instead of overwriting</li>
					<li>fixed a bug where rgb was being ignored since 0.1.4</li>
				</ul></div>

				<a name="v0.1.4"></a>
				<div style="margin: 0.0 1.0em 0.5em;"><code><b>version 0.1.4 - August 4 2009</b></code><ul>
					<li>blocks that start with @ are treated as abstract blocks and are not printed out</li>
					<li>all blocks/mixins can now take argument lists (with default args) and be treated as functions</li>
					<li>fixed bug with nested blocks inside of a mixin printing the name of the mixin</li>
					<li>added the ability to specify import directory for @import</li>
					<li>the correct import directory is figured out automatically when you compile from file path</li>
					<li>fixed bug with @import and comments in imported file</li>
				</ul></div>


				<a name="v0.1.3"></a>
				<div style="margin: 0.0 1.0em 0.5em;"><code><b>version 0.1.3 - July 28 2009</b></code><ul>
					<li>setting variables to themselves in equations works how you expect</li>
					<li>parentheses are supported in arithmetic</li>
					<li>all variables and arithmetic do lazy evaluation, variables are set to the equation and not the value</li>
					<li>code no longer throws php notices</li>
				</ul></div>
				<a name="v0.1.2-1"></a>
				<div style="margin: 0.0 1.0em 0.5em;"><code><b>version 0.1.2-1 - July 23 2009</b> bugfix</code><ul>
					<li>issue with comments and whitespace on head of document fixed</li>
				</ul></div>
				<a name="v0.1.2"></a>
				<div style="margin: 0.0 1.0em 0.5em;"><code><b>version 0.1.2 - July 23 2009</b></code><ul>
					<li>Performance enhancements (50% faster compile for average case)</li>
					<li>Accepts more native css properties and values (still some trouble with more advanced css3 stuff)</li>
					<li>Better string support in general</li>
					<li>Comments will no longer be interpreted from within strings</li>
				</ul></div>
				<a name="v0.1.1"></a>
				<div style="margin: 0.0 1.0em 0.5em;"><code><b>version 0.1.1 - July 22 2009</b></code><ul>
					<li>New @import parsing, supports media
					<li>Repeated properties are all written instead of overwriting each other
					<li>Support for additional css properties and values that were left out
					<li>New comment parsing prevents comments inside of strings from being removed
					<li>Added a static compile on demand function to lessc
					<li>Updated command line utility significantly
					<li>Fixed color rendering bug for small rgb values
				</ul></div>
				<a name="v0.1.0"></a>
				<div style="margin: 0.0 1.0em 0.5em;"><code><b>version 0.1.0 - July 21 2009</b> Initial release</code></div>
			</div>
		</div>


		<div class="grid_12">
			<a name="comments"></a>
			<h2>Comments</h2>
			<p>If you have a <a href="http://github.com/">github</a> account, you can post bug reports on the <a href="http://github.com/leafo/lessphp/issues">github issues tracker</a>.</p>
			<div class="comments" id="disqus_thread"></div>

			<script type="text/javascript">
				var disqus_shortname = 'leafo'; // required: replace example with your forum shortname
				// var disqus_identifier = 'lessphp';
				var disqus_url = 'http://leafo.net/lessphp/';
				(function() {
					var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
					dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
					(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
				})();
			</script>
		</div>


		<div class="clear" style="height:12px;"></div>

		<hr />
		<p class="foot"> December 14 2010 - <a href="http://leafo.net">leaf corcoran</a> &middot;
		lessphp is licensed under GPL3/MIT
		</p>

	</div>

	<script type="text/javascript">
		// http://github.com/api/v2/json/commits/list/leafo/lessphp/master?callback=load_commits
		function load_commits(out) {
			var commits = out.commits,
				container = document.getElementById('commit-list');

			while (container.firstChild) container.removeChild(container.firstChild);

			var max = commits.length > 4 ? 4 : commits.length;
			for (var i = 0; i < max; i++) {
				(function() {
					var commit = commits[i],
						node = div([
							div('<b>'+pretty_date(commit.committed_date)+'</b>'+' &#151; '+
								'<a href="http://github.com/'+commit.author.login+'">'+commit.author.login+'</a>'),
							div(commit.message, {className: 'commit-message'}),
						], { className: 'single-commit' });

					node.onclick = function() {
						window.location = 'http://github.com'+commit.url;
					}
					container.appendChild(node);
				})();
			}

			container.appendChild(div('<a href="http://github.com/leafo/lessphp/commits/master">See all...</a>', {className: 'center'}));
		}

		function pretty_date(date) {
			var d = new Date(date);
			return d.toDateString();
		}

		function div(inner, opts) {
			var div = document.createElement('div');
			if (opts) for (var oname in opts) div[oname] = opts[oname];
			if (inner) {
				if (typeof inner == "string") {
					div.innerHTML = inner;
				} else {
					for (var i = 0; i < inner.length; i++) div.appendChild(inner[i]);
				}
			}
			return div;
		}

		function show_changelog() {
			document.getElementById('changelog-message').style.display = 'none';
			document.getElementById('log').style.display = 'block';
		}

		window.onload = function() {
			// set up the examples
			var input = document.getElementById('lessin');
			var output = document.getElementById('lessout');

			document.getElementById('go').onclick = function () {
				output.innerHTML = 'Processing...';
				send('go.php', 'css='+encodeURIComponent(input.value),
					function (res) {
						output.innerHTML = res.responseText;
					});
			}

			document.getElementById('clear').onclick = function () {
				input.value = '';
			}

			var exs = document.getElementById('demoselect').getElementsByTagName('a');
			for (var i = 0; i < exs.length; i++) {
				exs[i].onclick = function () {
					var id = /load([0-9])/.exec(this.id)[1];
					input.value = document.getElementById('example' + id).textContent;
					return false;
				}
			}

			// download the repo
			var sctag = document.createElement('script');
			sctag.type = 'text/javascript';
			sctag.src = 'github.php';
			document.body.appendChild(sctag)
		}

		function send(url, data, finish) {
			if (typeof XMLHttpRequest == "undefined") {
				XMLHttpRequest = function () {
					try { return new ActiveXObject("Msxml2.XMLHTTP.6.0"); }
						catch (e) {}
					try { return new ActiveXObject("Msxml2.XMLHTTP.3.0"); }
						catch (e) {}
					throw new Error("This browser does not support XMLHttpRequest.");
				};
			}

			var req = new XMLHttpRequest();
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					if (req.status == 200)
						finish(req);
					else 
						alert('failed to send HttpRequest');
				}
			}

			req.open("POST", url, true);
			req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			req.send(data);
		}

	</script>


<div class="examples">
<code id="example1">@a: 2;
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
}</code>
<code id="example2">.bordered {
  border-top: dotted 1px black;
  border-bottom: solid 2px black;
}
#menu a {
  color: #111;
  .bordered;
}

.post a {
  color: red;
  .bordered;
}</code>
<code id="example3">#header {
  color: black;

  .navigation {
    font-size: 12px;
  }
  .logo {
    width: 300px;
    :hover { text-decoration: none }
  }
}</code>
<code id="example4">#defaults {
  @width: 960px;
  @color: black;
}

.article { color: #294366; }

.comment {
  width: #defaults[@width];
  color: .article['color']; 
}</code>
<code id="example5">#bundle {
  .button {
    display: block;
    border: 1px solid black;
    background-color: grey;
    :hover { background-color: white }
  }
}
#header a {
  color: orange;
  #bundle > .button; // mixin the button class
}</code>
<code id="example6">@outer: 10px;
@class(@var:22px; @car: 400px + @outer) {
  margin: @var;
  height: @car;
}

@group { 
  @f(@color) {
    color: @color;
  }
  .cool {
    border-bottom: 1px solid green;
  }
}

.class(@width:200px) {
  padding: @width;
}

body {
  .class(2.0em);
  @group > @f(red);
  @class(10px; 10px + 2); 
  @group > .cool;
}</code>
</div>


</body>
</html>

