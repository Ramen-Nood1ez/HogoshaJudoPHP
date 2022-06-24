<?php
	session_start();
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: /login/login.php/?redirect=/admin/panel.php");
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
	<div id="includedContent" class="topnav">
		<?php 
			$myfile = fopen("../navbar.php", "r") or die("Unable to load navbar!");
			echo fread($myfile, filesize("../navbar.php"));
			fclose($myfile);
		?>
	</div>

	<br>

	<h1>Admin Tools</h1>

	<section class="panel-grid-layout">
		<h2 style="grid-area: headone;">File Utils</h2>
		<div style="grid-area: row1;" class="panel-grid-row">
			<a href="upload.php">Upload an image/video</a>
			<a href="#">Unused</a>
			<a href="#">Unused</a>
			<a href="#">Unused</a>
			<a href="#">Unused</a>
		</div>
		<h2 style="grid-area: headtwo;">Useful Links</h2>
		<div style="grid-area: row1;" class="panel-grid-row">
			<a href="https://cpanel.hogoshajudo.org/">Cpanel</a>
			<a href="https://webmail.hogoshajudo.org/">Webmail</a>
			<a href="#">Unused</a>
			<a href="#">Unused</a>
			<a href="#">Unused</a>
		</div>
		
	</section>
	
</body>
</html>