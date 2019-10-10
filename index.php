<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '' );
require_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ]   = '// ESDown //';
$page[ 'page_id' ] = 'home';

$page[ 'body' ] .= '';

dvwaHtmlEcho( $page );

?>
