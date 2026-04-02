<?php
	session_start();

	require_once $_SERVER['DOCUMENT_ROOT'].'/core/utilities/userutils.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/core/utilities/splasher.php';
	$user = UserUtils::RetrieveUser();

	if($user == null) {
		die(header("Location: /login"));
	}

	$randomsplash = new Splasher("client")->getRandomSplash();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Download - ANORRL</title>
		<link rel="icon" type="image/x-icon" href="/favicon.ico">
		<link rel="stylesheet" href="/css/new/main.css">
		<link rel="stylesheet" href="/css/new/download.css">
		<script src="/js/core/jquery.js"></script>
		<script src="/js/main.js?t=1771413807"></script>
	</head>
	<body>
		<div id="Container">
		<?php include $_SERVER['DOCUMENT_ROOT'].'/core/ui/header.php'; ?>
			<div id="Body">
				<div id="BodyContainer">
					<h2><?= $randomsplash ?></h2>
					<div id="DownloadContainer">
						<p id="Splasher">So much malware!!!!!!!!!!</p>
						<span id="Note">(Unfortunately, it is windows only. But wine works fine on linux! Mac builds may come soon...)</span>
						<hr>
						<h3>Windows</h3>
						<div id="DownloadContainer" style="background: #161616;">
							<table style="width: 100%">
								<tr>
									<td>
										<div>
											<a href="2016/ANORRLPlayerLauncher.exe">
												<img src="/images/download/2016client.png">
												<span>Client</span>
											</a>
										</div>
									</td>
									<td>
										<div>
											<a href="2016/ANORRLStudioLauncher.exe">
												<img src="/images/download/2016studio.png">
												<span>Studio</span>
											</a>
										</div>
									</td>
								</tr>
							</table>
						</div>
						
					</div>
					
				</div>
				<?php include $_SERVER['DOCUMENT_ROOT'].'/core/ui/footer.php'; ?>
			</div>
		</div>
	</body>
</html>
