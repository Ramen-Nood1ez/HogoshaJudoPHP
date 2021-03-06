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
	<body style="text-align: center;">
		<div class="grid-container">
			<div id="includedContent" class="topnav">
				<?php 
					include("navbar.php");
				?>
			</div>

			<main>
				<!--h1>Hogosha Judo</h1-->

				<div class="eventmessage" id="eventmessage" 
					style="<?php echo (date('m') == 12) ? "" : "visibility: collapse; width: 0px; height: 0px;" ?>">
					<img src="images/happyholidays.png">
				</div>

				<?php 
					include("announcement.php");
				?>

				<img class="logo" width="300" height="320" alt="Hogosha Judo" src="images/Registered-Hogosha-Logo-3.jpg">

				<br>
				<br>

				<img class="regimg" src="images/mike and josh- tohkon.jpg" alt="Test">

				<h2>Winning Starts Here... Right Here!</h2>
				<h3>Practice makes <strike class="strikeout">perfect</strike> permanent</h3>
				
				<figure>
					<p><q>Perfect practice makes perfect</q></p>
					--Neil Adams
				</figure>

				<br>
				<br>
				<br>

				<?php 
					include("motd.php");
				?>

				<br>

				<div id="Announcements">
					<h1><b>Announcements</b></h1>
					<h2>There have been changes to the rules for Judo, please check it out.</h2>
					<a href="https://www.ijf.org/news/show/new-olympic-cycle-new-judo-rules" target="_blank" rel="noopener noreferrer">New rules</a>
				</div>

				<br>

				<div class="parallax" style="background-image: url('images/mainjudopage4.jpg')"></div>

				<h1>Operating Hours:</h1>
				
				<h2>Judo</h2>
				<p>
					Tuesday
					6:00 pm to 6:50 pm
					<br>
					Thursday
					6:00 pm to 7:00 pm
					<br>
					<b>Ages 6 and older</b>
				</p>

				<h2>Jiu Jitsu + Judo Rules and Randori</h2>
				<p>
					Tuesday
					7:00 pm to 7:45 pm
					<br>
					7:45, Open Randori / Mat
				</p>

				<h2>Brazilian Jiu Jitsu</h2>
				<p>
					Monday and Wednesday
					6:45 pm to 8:00 pm
				</p>

				<hr class="thr">

				<h1>Contact Information:</h1>

				<h2>Jerry L. Cypert - Supervising Instructor</h2>
				<a href="tel:920-296-6451" class="normlink">(920) 296-6451</a>

				<h2>Darlene Cypert - Head Instructor</h2>
				<a href="tel:920-296-6452" class="normlink">(920) 296-6452</a>

				<hr class="thr">

				<h1>For Tuition and Registration:</h1>
				<h2>Third Heaven Martial Arts</h2>
				<address>
					Mr. Justin Morris
					<br>
					1229 Madison Street
					<br>
					Beaver Dam, WI 53916
				</address>
				<a href="tel:920-319-0439" class="normlink">(920) 319-0439</a>
				
				<hr class="thr">

				<h1>Our Curriculum Includes:</h1>
				<p>
					Olympic Judo
					<br>
					Kata
					<br>
					Self Defence
				</p>

				<hr class="thr">

				<h1>Like Us On Facebook:</h1>
				<a style="font-size: larger;" href="https://www.facebook.com/hogoshajudo.org/" target="_blank" rel="noopener noreferrer" class="normlink">Hogosha Judo</a>
			</main>
		</div>
		

		
	</body>
</html>