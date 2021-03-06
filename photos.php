<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" href="public/newstyle.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://kit.fontawesome.com/8e00593c4c.js" crossorigin="anonymous"></script>
		<script> 
			$(function(){
			  $("#photos").load("photostemplate.html"); 
			});
		</script> 
		<title>Hogosha Judo</title>
	</head>
	<body>
		<div id="includedContent" class="topnav">
			<?php 
				include("navbar.php");
			?>
		</div>

		<br>

		<div id="photos">
			<?php
				$file = fopen("photos/desc.txt", "r") or die ("Unable to load description file!");
				$description = fread($file, filesize("photos/desc.txt"));
				fclose($file);
				$lines = explode("\n", $description);
				foreach ($lines as $line) {
					$sep_line = explode("+", $line);
					$image_name = $sep_line[0];
					$image_desc = $sep_line[1];
					$image_info = getimagesize("photos/" . $image_name);
					$width = $image_info[0];
					$height = $image_info[1];
					echo "<figure><img class='photosimg' width='$width' ";//height='$height' ";
					echo "src='photos/$image_name' alt='$image_name'> <br>\n";
					echo "<figcaption>$image_desc</figcaption></figure>\n";
				}
			?>
		</div>
	</body>
</html>