<?php
$cache = 'feed.xml';

if (file_exists($cache) && time() - filemtime($cache) < 60*60*24) {
	header("Content-Type: application/rss+xml");
	echo file_get_contents($cache);
	return;
}

require "lib/FeedWriter/FeedWriter.php";
require "lib/php-markdown/markdown.php";

$entry_dir = 'entires/';

$feed = new FeedWriter(RSS2);

$feed->setTitle('lessphp changelog');
$feed->setLink('http://leafo.net/lessphp/');
$feed->setDescription('lessphp is a compiler for LESS written in php.');

function flatten($str) {
	while ($str != ($out = preg_replace('/[^\w]+/', '_', $str)))
		$str = $out;
	return $str;
}

$entires = array(
	'0.2.0' => '27 Mar 2010 22:00',
	'0.1.6' => '21 Aug 2009 14:35',
	'0.1.5' => '6 Aug 2009 03:35',
	'0.1.4' => '5 Aug 2009 02:35',
	'0.1.3' => '28 Jul 2009 19:22',
	'0.1.2-1 bugfix' => array('#v0.1.2-1', '23 Jul 2009 15:13'),
	'0.1.2' => '23 Jul 2009 13:13',
	'0.1.1' => '22 july 2009, 10:46',
	'0.1.0' => '21 july 2009, 01:52'
);

foreach ($entires as $name => $info) {
	if (is_array($info)) {
		list($url, $date) = $info;
	} else {
		$date = $info;
		$url = '$v'.$name;
	}

	$item = $feed->createNewItem();
	$item->setTitle('version '.$name);
	$item->setLink('http://leafo.net/lessphp/'.$url);
	$item->setDate($date);

	$desc = file_get_contents($entry_dir.flatten($name).".md");
	if ($desc === false) continue;

	$item->setDescription(Markdown($desc));

	$feed->addItem($item);
}


ob_start();
$feed->generateFeed();
$out = ob_get_clean();

file_put_contents($cache, $out);
echo $out;
