<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ]   = 'ID de session prévisible' . $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'weak_id';
$page[ 'help_button' ]   = 'weak_id';
$page[ 'source_button' ] = 'weak_id';
dvwaDatabaseConnect();

$method            = 'GET';
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
		$method = 'POST';
		break;
}

require_once DVWA_WEB_PAGE_TO_ROOT . "vulnerabilities/weak_id/source/{$vulnerabilityFile}";


$page[ 'body' ] .= <<<EOF
<div class="body_padded">
	<div class=\"vulnerable_code_area\">
	<h1>ID de session prévisible</h1>
	<p align=center>
		Cette page attribue un nouveau cookie appelé esdownSession à chaque fois que vous clickerez sur le bouton<br />
	</p>
	<form method="post" style='text-align:center'>
		<input type="submit" value="Générer ID" />
	</form>
	</div>
$html

EOF;

/*
Maybe display this, don't think it is needed though
if (isset ($cookie_value)) {
	$page[ 'body' ] .= <<<EOF
	The new cookie value is $cookie_value
EOF;
}
*/

dvwaHtmlEcho( $page );

?>
