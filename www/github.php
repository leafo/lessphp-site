<?php
/**
 * this only exists to avoid github's per hour api limit
 * if it ever becomes a problem.
 */

$fname = 'commits.js';

if (!file_exists($fname) || time() - filemtime($fname) > 5) {
	$ch = curl_init("http://github.com/api/v2/json/commits/list/leafo/lessphp/master?callback=github_commit_callback");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$feed = curl_exec($ch);
	curl_close($ch);
	file_put_contents($fname, $feed);
	echo $feed;
} else {
	echo file_get_contents($fname);
}

