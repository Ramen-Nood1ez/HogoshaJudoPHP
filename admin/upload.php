<?php
	session_start();
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: /login/login.php/?redirect=/admin/imgupload.php");
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
	<link rel="stylesheet" href="/public/style.css">
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

	<h1>Image/Video Upload Tool</h1>
	
	<form action="uploader.php" method="post">
		<div>
			<label>Upload image</label>
			<input type="file" name="file">
		</div>
		<div>
			<input type="submit" value="Image">
		</div>
	</form>
</body>
</html>