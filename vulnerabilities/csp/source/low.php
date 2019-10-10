<?php

$headerCSP = "Content-Security-Policy: script-src 'self' https://pastebin.com  example.com code.jquery.com https://ssl.google-analytics.com ;"; // allows js from self, pastebin.com, jquery and google analytics.

header($headerCSP);

# https://pastebin.com/raw/R570EE00

?>
<?php
if (isset ($_POST['include'])) {
$page[ 'body' ] .= "
	<script src='" . $_POST['include'] . "'></script>
";
}
$page[ 'body' ] .= '
<form name="csp" method="POST">
	<p>Vous pouvez inclure des scripts provenant de sources externes et constater le résultat de la CSP</p>
	<input size="50" type="text" name="include" value="" id="include" />
	<input type="submit" value="Inclure" />
</form>
';
