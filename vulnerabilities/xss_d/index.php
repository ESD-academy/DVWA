<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ]   = 'Cross-Site Scripting (DOM)' . $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'xss_d';
$page[ 'help_button' ]   = 'xss_d';
$page[ 'source_button' ] = 'xss_d';

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

require_once DVWA_WEB_PAGE_TO_ROOT . "vulnerabilities/xss_d/source/{$vulnerabilityFile}";

# For the impossible level, don't decode the querystring
$decodeURI = "decodeURI";
if ($vulnerabilityFile == 'impossible.php') {
	$decodeURI = "";
}

$page[ 'body' ] = <<<EOF
<div class="body_padded">
	<h1>Cross-Site Scripting (XSS DOM-based)</h1>

	<div class="vulnerable_code_area">

 		<p>Choisissez un language:</p>

		<form name="XSS" method="GET">
			<select name="default">
				<script>
					if (document.location.href.indexOf("default=") >= 0) {
						var lang = document.location.href.substring(document.location.href.indexOf("default=")+8);
						document.write("<option value='" + lang + "'>" + $decodeURI(lang) + "</option>");
						document.write("<option value='' disabled='disabled'>----</option>");
					}

					document.write("<option value='English'>English</option>");
					document.write("<option value='French'>French</option>");
					document.write("<option value='Spanish'>Spanish</option>");
					document.write("<option value='German'>German</option>");
				</script>
			</select>
			<input type="submit" value="Select" />
		</form>
	</div>
EOF;

$page[ 'body' ] .= "

</div>\n";

dvwaHtmlEcho( $page );

?>
