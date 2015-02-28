<?php

$Page['Title']['Plain'] = 'A Page with Comments';
$Page['Description']['Plain'] = 'This is a Page with Comments powered by Markdown.';
$Page['Keywords'] = 'example page markdown comments';
$Page['Type'] = 'Page';
$Canonical = '/page-with-comments';

require_once __DIR__.'/_simplet/request.php';
if ( $Request['Path'] === $Canonical ) {
	require $Templates['Header'];
	?>

	<h2>A Page with Comments</h2>
	<p>This is a Page with Comments powered by Markdown.</p>

	<?php
	Responses();
	require $Templates['Footer'];
}