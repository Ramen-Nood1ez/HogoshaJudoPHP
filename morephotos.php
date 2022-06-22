<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" href="style.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://kit.fontawesome.com/8e00593c4c.js" crossorigin="anonymous"></script>
		<script> 
			$(function(){
			  $("#photos").load("morephotostemplate.html"); 
			});
		</script> 
		<title>Hogosha Judo</title>
	</head>
	<body>
		<div id="includedContent" class="topnav">
			<?php 
				$myfile = fopen("navbar.php", "r") or die("Unable to load navbar!");
				echo fread($myfile, filesize("navbar.php"));
				fclose($myfile);
			?>
		</div>
		<div id="photos">
			<?php
				$images = scandir("./morephotos/");
				for ($i = 2; $i < count($images); $i++) {
					$image_name = $images[$i];
					$image_info = getimagesize("morephotos/" . $image_name);
					$width = $image_info[0];
					$height = $image_info[1];
					echo "<img class='photosimg' width='$width' ";
					echo "src='morephotos/$image_name' alt='$image_name'>";
				}
			?>
		</div>
	</body>
</html>