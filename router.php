<?php

	// lifted from pixie - by parakeet

	$dir = __DIR__."/private";
	$router = new AltoRouter();

	function route($method, $path, $file) {
		global $router;
		$router->map($method, $path, function(...$params) use ($file) {
			foreach ($params as $key => $value) {
				$$key = $value;
			}
			require __DIR__.$file;
		});
	}

	function route_api($method, $path) {
		global $router;

		$file = "/private/api/$path.php";

		$router->map($method, "/api/$path", function(...$params) use ($file) {
			foreach ($params as $key => $value) {
				$$key = $value;
			}
			require __DIR__.$file;
		});
	}
 
	route('GET',      '/', '/private/views/index.php');
	route('GET',      '/index', '/private/views/index.php');
	route('GET|POST', '/login', '/private/views/login.php');
	route('GET|POST', '/register', '/private/views/register.php');
	
	route('GET|POST', '/catalog', '/private/views/catalog.php');
	route('GET|POST', '/games', '/private/views/games.php');
	route('GET|POST', '/vandals', '/private/views/vandals.php');
	route('GET|POST', '/edit', '/private/views/edit.php');

	route('GET|POST', '/create/[*:type]', '/private/views/create.php');
	route('GET|POST', '/create/', '/private/views/create.php');

	route('GET|POST', '/[*:name]-item', '/private/views/item.php');
	route('GET|POST', '/[*:name]-place', '/private/views/place.php');

	$router->map('GET', '/game/[i:id]', function($id) {
		$name = "a";
		require __DIR__.'/private/views/place.php';
	});
	
	route('GET|POST', '/users/[i:id]/profile', '/private/views/users/profile.php');
	route('GET',      '/users/[i:id]/css', '/private/views/users/css.php');
	route('GET',      '/users/[i:id]/followers', '/private/views/users/followers.php');
	route('GET',      '/users/[i:id]/following', '/private/views/users/following.php');
	route('GET',      '/users/[i:id]/friends', '/private/views/users/friends.php');

	route('GET',      '/thumbs/profile', '/core/thumbs/profile.php');
	route('GET',      '/thumbs/player', '/core/thumbs/player.php');
	route('GET',      '/thumbs/headshot', '/core/thumbs/headshot.php');
	route('GET',      '/thumbs/', '/core/thumbs/index.php');

	route('GET',      '/asset/', '/core/utilities/assetdeliverer.php');
	route('GET',      '/Asset/', '/core/utilities/assetdeliverer.php');

	route('GET',      '/info/credits', '/private/views/info/credits.php');

	route('GET',      '/download', '/private/views/download/index.php');
	route('GET',      '/download/', '/private/views/download/index.php');
	route('GET',      '/download/thankyou', '/private/views/download/thankyou.php');

	route('GET|POST', '/my/home', '/private/views/my/home.php');
	route('GET|POST', '/my/profile', '/private/views/my/profile.php');
	route('GET|POST', '/my/character', '/private/views/my/character.php');

	route_api('GET', 'logout');
	route_api('GET', 'games');
	route_api('GET', 'catalog');
	route_api('GET', 'people');
	route_api('GET', 'stuff');
	route_api('GET', 'feeds');
	route_api('GET', 'character');


	$match = $router->match();

	if (is_array($match) && is_callable($match['target'])) {
		call_user_func_array($match['target'], $match['params']);
	} else {
		header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
		require __DIR__.'/private/views/errors/404.php';
		exit();
	}
?>