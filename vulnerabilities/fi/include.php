<?php

// Check if the right PHP functions are enabled
$WarningHtml = '';
if( !ini_get( 'allow_url_include' ) ) {
	$WarningHtml .= "<div class=\"warning\">The PHP function <em>allow_url_include</em> is not enabled.</div>";
}
if( !ini_get( 'allow_url_fopen' ) ) {
	$WarningHtml .= "<div class=\"warning\">The PHP function <em>allow_url_fopen</em> is not enabled.</div>";
}


$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>Inclusion de fichier</h1>

	{$WarningHtml}

	<div class=\"vulnerable_code_area\">
		<em><a href=\"?page=file1.php\">page 1</a></em> - <em><a href=\"?page=file2.php\">page 2</a></em> - <em><a href=\"?page=file3.php\">page 3</a></em>
	</div>

</div>\n";

?>
