<?php

$html = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$cookie_value = time();
	setcookie("esdownSession", $cookie_value);
}
?>
