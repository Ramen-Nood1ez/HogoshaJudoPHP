<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">  
		<link rel="stylesheet" href="/public/newstyle.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://kit.fontawesome.com/8e00593c4c.js" crossorigin="anonymous"></script>
		<title>Hogosha Judo</title>
	</head>
	<body>
		<div class="grid-container">
			<div id="includedContent" class="topnav">
				<?php 
					include("navbar.php");
				?>
			</div>

			<main>
				<div class="menu">
					<h3>Meals</h3> <p>Prices</p>
					<p class="indent1">Get a Brat or Burger, chips and a drink</p> <p>$5</p>
					<!--hr style="grid-column: 1 / span 2; width: 100%;"-->
					<h3>Seperately Sold Items</h3> <p></p>
					<p class="indent1">Brat</p> 			<p>$3.50</p>
					<p class="indent1">Burger</p> 			<p>$4.00</p>
					<p class="indent2">Cheese</p> 			<p>$.50 extra</p>
					<p class="indent1">Chips</p> 			<p>$1.00</p>
					<p class="indent1">Water or Soda</p> 	<p>$1.00</p>
					<p class="indent1">Gatorade</p> 		<p>$1.50</p>
				</div>
			</main>
	</body>
</html>