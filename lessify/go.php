<?php

require '../src/lessify.inc.php';

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

try  {
	$parser = new lessify();
	echo htmlentities($parser->parse($data));
} catch (exception $ex) {
	echo "<b>Fatal Error:\n".str_repeat('=', 20)."</b>\n".$ex->getMessage()."\n";
}

?>