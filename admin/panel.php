<?php
	session_start();

	$override_err = isset($_GET["error"]) ? htmlspecialchars($_GET["error"]) : "";

	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: /login/login.php/?redirect=/admin/panel.php");
		exit;
	}

	if ($override_err == 403) {
		header("HTTP/1.1 403 FORBIDDEN");
		exit;
	}

	if(!isset($_SESSION["permlevel"]) || $_SESSION["permlevel"] < 3){
		//header("location: /login/login.php/?redirect=/admin/panel.php");
		header("HTTP/1.1 403 FORBIDDEN");
		exit;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">  
	<link rel="stylesheet" href="/public/newstyle.css">
	<title>Hogosha Judo Admin Panel</title>
</head>
<body>
	<div class="grid-container">
		<div id="includedContent" class="topnav">
			<?php 
				include("/navbar.php");
			?>
		</div>

		<div style="grid-area: topright;">
			<p class="center-text">Logged in as: <?php echo $_SESSION["username"] ?></p>
		</div>

		<main>
			<h1>Admin Tools</h1>

			<section class="panel-grid-layout">
				<h2 style="grid-area: headone;">Utilities</h2>
				<div style="grid-area: row1;" class="panel-grid-row">
					<a href="upload.php">Upload an image/video</a>
					<a href="announcement.php">Make an announcement</a>
					<a href="motd.php">Change the MOTD</a>
					<a href="#">Unused</a>
					<a href="#">Unused</a>
				</div>
				<h2 style="grid-area: headtwo;">Useful Links</h2>
				<div style="grid-area: row2;" class="panel-grid-row">
					<a href="https://cpanel.hogoshajudo.org/" target="_blank">Cpanel</a>
					<a href="https://webmail.hogoshajudo.org/" target="_blank">Webmail</a>
					<a href="#">Unused</a>
					<a href="#">Unused</a>
					<a href="#">Unused</a>
				</div>
				
			</section>
		</main>

		<footer><?php echo $_SESSION["permlevel"];?></footer>
	</div>

	
	
</body>
</html>