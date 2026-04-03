<?php
	use anorrl\Asset;

	header("Content-Type: application/json");

	if(SESSION) {
		$user = SESSION->user;
		if(isset($_POST['asset'])) {
			$assetid = intval($_POST['asset']);
			$asset = Asset::FromID($assetid);

			if($asset != null) {

				if(!$asset->HasUserFavourited($user)) {
					$asset->Favourite($user);
				} else {
					$asset->Unfavourite($user);
				}

				die(json_encode(["error" => false, "favourited" => $asset->HasUserFavourited($user)]));
			}
		} else {
			die(json_encode(["error" => true, "reason" => "Invalid request."]));
		}
	} else {
		die(json_encode(["error" => true, "reason" => "User not logged in."]));
	}
?>