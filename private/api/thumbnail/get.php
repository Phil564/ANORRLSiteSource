<?php
	use anorrl\User;

	if(!isset($_GET['userid']))
		die(http_response_code(500));
	
	$user = User::FromID(intval($_GET['userid']));

	if(!$user)
		die(http_response_code(500));

	$hash = $user->currentoutfitmd5;

	header("Content-Type: application/json");

	echo json_encode([
		"Final" => true,
		"Url" => "/thumbnail/avatar/generate?for={$user->id}"
	])
?>