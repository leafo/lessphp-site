<?php

require 'lessify.inc.php';

if (get_magic_quotes_gpc()) {
	function stripslashes_deep($value) {
		$value = is_array($value) ?
			array_map('stripslashes_deep', $value) :
			stripslashes($value);

		return $value;
	}

	$_POST = array_map('stripslashes_deep', $_POST);
	$_GET = array_map('stripslashes_deep', $_GET);
	$_COOKIE = array_map('stripslashes_deep', $_COOKIE);
	$_REQUEST = array_map('stripslashes_deep', $_REQUEST);
}

$data = $_POST['css'];
/*
if (strlen($data) > 1024*10) {
	echo '<b>Error:</b> input size too large for online demo. '.
		'Download <a href="http://github.com/leafo/lessphp/blob/master/lessify.inc.php">lessify.inc.php</a> '.
		'to run locally. See <a href="http://github.com/leafo/lessphp/blob/master/lessify">lessify</a> for usage.';
	return;
}
 */

try  {
	$parser = new lessify();
	echo htmlentities($parser->parse($data));
} catch (exception $ex) {
	echo "<b>Fatal Error:\n".str_repeat('=', 20)."</b>\n".$ex->getMessage()."\n";
}

?>