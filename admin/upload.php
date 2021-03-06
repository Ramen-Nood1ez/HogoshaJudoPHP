<?php
	$redirect = "/login/login.php?redirect=/admin/upload.php";
	require("../logincheck.php");

	session_start();
	if (!isset($_SESSION["permlevel"]) || $_SESSION["permlevel"] < 2) {
		echo "You don't have permission to access this page...";
		exit;
	}

	function show_alert($message) {
		// Display the alert box
		echo "<script>alert('$message');</script>";
	}

	$mes = htmlspecialchars($_GET["message"]);

	if (!empty(trim($mes))) { 
		show_alert($mes);
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
			include("/navbar.php");
		?>
	</div>

	<br>

	<h1>Image/Video Upload Tool</h1>
	
	<form action="uploader.php" method="post" enctype="multipart/form-data">
		<div>
			<label>Upload image</label>
			<input type="file" name="file">
		</div>

		<div>
			<label>Add a description</label>
			<input type="text" name="desc">
		</div>

		<!--div>
			<label>Add to more photos?</label>
			<input type="checkbox" name="morephotos" value="true">
		</div-->

		<div>
			<input type="submit" value="submit">
		</div>
	</form>

	<br>

	<a href="panel.php">Back</a>
</body>
</html>