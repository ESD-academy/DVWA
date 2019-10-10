<?php

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>Inclusion de fichier</h1>
	<div class=\"vulnerable_code_area\">
		<h3>Page 1</h3>
		<hr />
		Bonjour <em>" . dvwaCurrentUser() . "</em><br />
		Votre adresse IP est : <em>{$_SERVER[ 'REMOTE_ADDR' ]}</em><br /><br />
		[<em><a href=\"?page=include.php\">retour</a></em>]
	</div>
</div>\n";

?>
