<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ]   = 'Contournement de CSP' . $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'csp';
$page[ 'help_button' ]   = 'csp';
$page[ 'source_button' ] = 'csp';

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

$page[ 'body' ] = <<<EOF
<div class="body_padded">

	<div class="vulnerable_code_area">
		<h1>Contournement de CSP (Content Security Policy)</h1>
EOF;

require_once DVWA_WEB_PAGE_TO_ROOT . "vulnerabilities/csp/source/{$vulnerabilityFile}";

$page[ 'body' ] .= <<<EOF
	</div>
EOF;


dvwaHtmlEcho( $page );

?>
