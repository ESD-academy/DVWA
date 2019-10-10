<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ]   = 'Cross-Site Request Forgery (CSRF)' . $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'csrf';
$page[ 'help_button' ]   = 'csrf';
$page[ 'source_button' ] = 'csrf';

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

require_once DVWA_WEB_PAGE_TO_ROOT . "vulnerabilities/csrf/source/{$vulnerabilityFile}";

$page[ 'body' ] .= "
<div class=\"body_padded\">

	<div class=\"vulnerable_code_area\">
		<h1>Cross Site Request Forgery (CSRF)</h1><br>
		<h3>Changez le mot de passe administrateur</h3>
		<br />

		<form action=\"#\" method=\"GET\">";

if( $vulnerabilityFile == 'impossible.php' ) {
	$page[ 'body' ] .= "
			Mot de passe actuel<br />
			<input type=\"password\" AUTOCOMPLETE=\"off\" name=\"password_current\"><br />";
}

$page[ 'body' ] .= "
			Mot de passe actuel<br />
			<input type=\"password\" AUTOCOMPLETE=\"off\" name=\"password_new\"><br />
			Nouveau mot de passe<br />
			<input type=\"password\" AUTOCOMPLETE=\"off\" name=\"password_conf\"><br />
			<br />
			<input type=\"submit\" value=\"Change\" name=\"Changer\">\n";

if( $vulnerabilityFile == 'high.php' || $vulnerabilityFile == 'impossible.php' )
	$page[ 'body' ] .= "			" . tokenField();

$page[ 'body' ] .= "
		</form>
		{$html}
	</div>

</div>\n";

dvwaHtmlEcho( $page );

?>
