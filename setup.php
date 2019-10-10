<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '' );
require_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ]   = 'Setup' . $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'setup';

if( isset( $_POST[ 'create_db' ] ) ) {
	// Anti-CSRF
	checkToken( $_REQUEST[ 'user_token' ], $_SESSION[ 'session_token' ], 'setup.php' );

	if( $DBMS == 'MySQL' ) {
		include_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/DBMS/MySQL.php';
	}
	elseif($DBMS == 'PGSQL') {
		// include_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/DBMS/PGSQL.php';
		dvwaMessagePush( 'PostgreSQL is not yet fully supported.' );
		dvwaPageReload();
	}
	else {
		dvwaMessagePush( 'ERROR: Invalid database selected. Please review the config file syntax.' );
		dvwaPageReload();
	}
}

// Anti-CSRF
generateSessionToken();

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>Database Setup <img src=\"" . DVWA_WEB_PAGE_TO_ROOT . "dvwa/images/spanner.png\" /></h1>
	<!-- Create db button -->
	<form action=\"#\" method=\"post\">
		<input name=\"create_db\" type=\"submit\" value=\"Create / Reset Database\">
		" . tokenField() . "
	</form>
</div>";

dvwaHtmlEcho( $page );

?>
