<?php
	use anorrl\utilities\Thumbnail;
	
	header("Content-Type: image/png");

	if(!isset($hash))
		die(http_response_code(500));

	$data = Thumbnail::Get3DTex($hash);

	if(!$data)
		die(http_response_code(500));

	exit($data);
?>