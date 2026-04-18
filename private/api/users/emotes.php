<?php
	use anorrl\User;
	use anorrl\enums\AssetType;

	header("Content-Type: application/json");

	if(SESSION) {
		$userid = SESSION->user->id;
	} else {
		$userid = 1;
	}

	$user = User::FromID($userid);

	$emotes = [];

	foreach($user->getOwnedAssets(AssetType::ANIMATION) as $emote) {
		$emotes[] = [
			"id" => $emote->id,
			"name" => $emote->name,
			"version" => $emote->current_version,
			"versionid" => $emote->getLatestVersionDetails()->id,
		];
	}

	die(json_encode([
		"success" => true,
		"emotes" => $emotes
	]));

?>