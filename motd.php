<?php 
	require("./login/config.php");
	/* Post Parameters
	*  creator id 
	*  message
	*  show date
	*/

	$current_date = date("Y-m-d");

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$creator_id = -1;
		$message = "";
		$show_date = "";

		require("logincheck.php");

		if (empty(trim($_POST["creator_id"]))){
			die("Creator ID cannot be blank!");
		} else {
			$creator_id = $_POST["creator_id"];
		}

		if (empty(trim($_POST["message"]))) {
			die("Message cannot be blank!");
		} else {
			$message = $_POST["message"];
		}

		if (empty(trim($_POST["show_date"]))) {
			die("Show date cannot be blank!");
		} else {
			$show_date = $_POST["show_date"];
		}

		$sql = "INSERT INTO motd (creator, message, show_date) ";
		$sql .= "VALUES ('$creator_id', '$message', '$show_date')";
		// echo "Test";

		if ($stmt = mysqli_prepare($link, $sql)) {
			// echo "prepare\n";
			// Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt, "ss", $param_ip, $param_username);
			// echo "bind\n";

			// Set parameters
			$param_ip = $address;
			$param_username = $username;
			$param_attempt_num = $num_attempts;

			// Attempt to execute the prepared statement
			if (mysqli_stmt_execute($stmt)) {
				echo "Success!";
				header("location: /");
			} else {
				echo "Oops! Something went wrong...";
			}

			mysqli_stmt_close($stmt);
		} else {
			// echo "$address";
			echo "prepare failed!";
		}
	}

	if (!isset($_GET["create"])) {
		$message = "";
		$show_date = "";

		// echo $end_date;

		$sql = "SELECT message, show_date FROM motd WHERE show_date='$current_date'";

		if ($stmt = mysqli_prepare($link, $sql)) {
			// Attempt to execute prepared statement
			if (mysqli_stmt_execute($stmt)) {
				// Store result
				mysqli_stmt_store_result($stmt);

				// Bind result variables
				mysqli_stmt_bind_result($stmt, $message, $show_date);
				
				if (mysqli_stmt_fetch($stmt)) {
					// echo "ID: $id, Message: $message, Show Date: $show_date";
					echo "<div class='announcement-panel'>\n";

					echo "<h2><b>MOTD</b></h2>\n";
					echo "<p>" . $message . "</p>";

					echo "</div>\n";
				} else {
					// echo "Fetch went wrong!";
				}
			} else {
				echo "Oops! Something went wrong. Please try again later.";
			}

			// Close statement
			mysqli_stmt_close($stmt);
		}

		// Close connection
		mysqli_close($link);
		return;
	}
	mysqli_close($link);
?>

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
				<form class="announcement-panel" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
					<!--label for="creator_id">Creator ID</!--label-->
					<input type="text" name="creator_id" 
						value="<?php session_start(); echo $_SESSION['id']; ?>" readonly hidden>
					<br>
					<label for="message">Message</label>
					<input type="text" name="message">
					<br>
					<label for="show_date">Show Date</label>
					<input type="date" name="show_date" min="<?php echo date("Y-m-d"); ?>">
					<br>
					<input type="submit" value="Submit">
				</form>
			</main>
		</div>
	</body>
</html>