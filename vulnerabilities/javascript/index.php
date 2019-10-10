<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ]   = 'JavaScript' . $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'javascript';
$page[ 'help_button' ]   = 'javascript';
$page[ 'source_button' ] = 'javascript';

dvwaDatabaseConnect();

$vulnerabilityFile = '';
switch( $_COOKIE[ 'security' ] ) {
	case 'low':
		$vulnerabilityFile = 'low.php';
		break;
	case 'medium':
		$vulnerabilityFile = 'medium.php';
		break;
	case 'high':
		$vulnerabilityFile = 'high.php';
		break;
	default:
		$vulnerabilityFile = 'impossible.php';
		break;
}

$message = "";
// Check whwat was sent in to see if it was what was expected
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	if (array_key_exists ("phrase", $_POST) && array_key_exists ("token", $_POST)) {

		$phrase = $_POST['phrase'];
		$token = $_POST['token'];

		if ($phrase == "success") {
			switch( $_COOKIE[ 'security' ] ) {
				case 'low':
					if ($token == md5(str_rot13("success"))) {
						$message = "<p style='color:green'>Bravo !</p>";
					} else {
						$message = "<p>Invalid token.</p>";
					}
					break;
				case 'medium':
					if ($token == strrev("XXsuccessXX")) {
						$message = "<p style='color:green'>Bravo !</p>";
					} else {
						$message = "<p>Invalid token.</p>";
					}
					break;
				case 'high':
					if ($token == hash("sha256", hash("sha256", "XX" . strrev("success")) . "ZZ")) {
						$message = "<p style='color:green'>Bravo !</p>";
					} else {
						$message = "<p>Invalid token.</p>";
					}
					break;
				default:
					$vulnerabilityFile = 'impossible.php';
					break;
			}
		} else {
			$message = "<p>Loupé !</p>";
		}
	} else {
		$message = "<p>Missing phrase or token.</p>";
	}
}

if ( $_COOKIE[ 'security' ] == "impossible" ) {
$page[ 'body' ] = <<<EOF
<div class="body_padded">
	<h1>JavaScript</h1>

	<div class="vulnerable_code_area">
	<p>
		You can never trust anything that comes from the user or prevent them from messing with it and so there is no impossible level.
	</p>
EOF;
} else {
$page[ 'body' ] = <<<EOF
<div class="body_padded">
	<h1>JavaScript</h1>

	<div class="vulnerable_code_area">
	<p>
		Soumettre le mot "success" pour réussir.
	</p>

	$message

	<form name="low_js" method="post">
		<input type="hidden" name="token" value="" id="token" />
		<input type="text" name="phrase" value="ChangeMe" id="phrase" />
		<input type="submit" id="send" name="send" value="Submit" />
	</form>
EOF;
}

require_once DVWA_WEB_PAGE_TO_ROOT . "vulnerabilities/javascript/source/{$vulnerabilityFile}";

$page[ 'body' ] .= <<<EOF
	</div>
EOF;

$page[ 'body' ] .= "
</div>\n";

dvwaHtmlEcho( $page );

?>
