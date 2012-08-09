title: LESS compiler in PHP
template: home
--

<a name="about"></a>
## About

**lessphp** is a compiler for [LESS][1] written in PHP.

The entire compiler comes in a single includable class, but an additional
command line interface to the compiler is included. It will run on PHP 5.1+.
See the quick start for basic usage.

For an overview of the syntax take a look at the [lessphp documentation][2].

Follow the author on twitter: [@moonscript](http://twitter.com/moonscript).

<div class="github-buttons">
<iframe src="http://ghbtns.com/github-btn.html?user=leafo&repo=lessphp&type=watch&count=true" allowtransparency="true" frameborder="0" scrolling="0" width="110px" height="20px"></iframe>
<iframe src="http://ghbtns.com/github-btn.html?user=leafo&repo=lessphp&type=fork&count=true" allowtransparency="true" frameborder="0" scrolling="0" width="95px" height="20px"></iframe>
</div>

  [1]: http://lesscss.org/  "LESS CSS"
  [2]: ./docs  "lessphp Documentation"
  [3]: http://github.com/leafo/lessphp/issues "lessphp Issues"
  [4]: http://github.com/ "GitHub"
  [5]: ./changelog.html "changelog"

<a name="demo"></a>
## Demo

Use the live demo to test the compiler using your own code, or click through the
example buttons to see various parts of the language.

<div>$render{[[demo]]}</div>

<div>$render{[[download]]}</div>

<a name="quick_start"></a>
## Quick Start

There are a few ways to interface with the compiler. The easiest is to have it
compile a LESS file when the page is requested. The static function
`less::ccompile`, checked compile, will compile the input LESS file only when
it is newer than the output file.

    ```php
    <?php
    require 'lessc.inc.php';

    try {
        lessc::ccompile('input.less', 'out.css');
    } catch (exception $ex) {
        exit('lessc fatal error:<br />'.$ex->getMessage());
    }

    ```

Note that all failures with lessc are reported through exceptions. If you need
more control you can make your own instance of lessc.

    ```php
    <?php
    require 'lessc.inc.php';

    $less = new lessc('path/to/style.less');
    file_put_contents('path/to/style.css', $less->parse());
    ```

In addition to loading from file, you can also parse from a string like so:

    ```php
    <?php
    require 'lessc.inc.php';

    $less = new lessc();
    $style = '<style type="text/css">'.
        $less->parse('.block { padding: 3 + 4px }').
        '</style>';
    ```

<a name="documentation"></a>
## Documentation

Full documentation and reference manual can be found on the [documentation
page][2].

A list of changes is available on the [changelog page][5].

<a name="plugins"></a>
## Plugins

Various **lessphp** plugins exist for many frameworks:

 * [Symfony](http://www.symfony-project.org/plugins/sgLESSPlugin) by [ServerGrove](http://blog.servergrove.com/2009/07/30/css-symfony-plugin-with-lessphp/)

 * [WordPress](http://wordpress.org/extend/plugins/wp-less/) by [Oncle Tom](http://case.oncle-tom.net/)

 * [Drupal](http://drupal.org/project/less) by [Corey Aufang](http://drupal.org/user/163737)

 * [CakePHP](https://github.com/sveggiani/Cakeless) by [sveggiani](https://github.com/sveggiani)

 * [Magento](http://www.magentocommerce.com/magento-connect/catalog/product/view/id/12895/s/lesscss-5369/) by [groupesoczed](http://www.magentocommerce.com/magento-connect/developer/groupesoczed)

*If you've got one, [email me](mailto:leafot@gmail.com) it and I'll post it
here.*

<a name="issues"></a>
## Issues

If you find something that isn't working right feel free to [leave a
comment](#comments) or post on the [GitHub issues tracker][3]. If you have any
interesting ideas for additions to the language please do suggest them as well.
You can also [email me](mailto:leafot@gmail.com) if you want.

<a name="comments"></a>
## Comments

If you have a [GitHub][4] account, you can post bug reports on the [github issues
tracker][3].

<div class="comments" id="disqus_thread"></div>
<script type="text/javascript">
	var disqus_shortname = 'leafo';
	var disqus_url = 'http://leafo.net/lessphp/';

	(function() {
		var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
		dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
		(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
	})();
</script>

