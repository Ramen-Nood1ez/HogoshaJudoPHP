<?php 
	require("./login/config.php");
	/* Post Parameters
	*  creator id 
	*  title
	*  description (optional)
	*  announcement type (0 = Normal, 1 = Warning, 2 = Critical)
	*  end date (optional)
	*/

	$current_date = date("Y-m-d");

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$creator_id = -1;
		$title = "";
		$description = empty(trim($_POST["desc"])) ? "NULL" : htmlspecialchars($_POST["desc"]);
		$announcement_type = 0;
		$end_date = empty(trim($_POST["enddate"])) ? "NULL" : htmlspecialchars($_POST["enddate"]);

		require("logincheck.php");

		if (empty(trim($_POST["creator_id"]))){
			die("Creator ID cannot be blank!");
		} else {
			$creator_id = $_POST["creator_id"];
		}

		if (empty(trim($_POST["title"]))) {
			die("Title cannot be blank!");
		} else {
			$title = $_POST["title"];
		}

		$announcement_type = empty(trim($_POST["announcement_type"])) ? 0 : $_POST["announcement_type"];

		$sql = "INSERT INTO announcements (creator, title, description, type, end_date) ";
		$sql .= "VALUES ('$creator_id', '$title', '$description', '$announcement_type', '$end_date')";
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
		$description = $title = "";
		$end_date = $current_date;
		$type = $id = 0;

		// echo $end_date;

		$sql = "SELECT id, title, description, type, end_date FROM announcements WHERE id=(SELECT MAX(id) FROM announcements)";

		if ($stmt = mysqli_prepare($link, $sql)) {
			// Attempt to execute prepared statement
			if (mysqli_stmt_execute($stmt)) {
				// Store result
				mysqli_stmt_store_result($stmt);

				// Bind result variables
				mysqli_stmt_bind_result($stmt, $id, $title, $description, $type, $end_date);
				
				if (mysqli_stmt_fetch($stmt)) {
					if ((strtotime($current_date) <= strtotime($end_date)) || empty(trim($end_date))) {
						$class = "";
						switch ($type) {
							case 1:
								$class = "warning";
								break;

							case 2:
								$class = "critical";
								break;
							
							default:
								# code...
								break;
						}

						echo "<div class='announcement-panel $class'>\n";

						echo "<h2>" . $title . "</h2>\n";
						echo "<p>" . $description . "</p>";

						echo "</div>\n";
					}
				} else {
					echo "Fetch went wrong!";
				}
			} else {
				echo "Oops! Something went wrong. Please try again later.";
			}

			// Close statement
			mysqli_stmt_close($stmt);
		}

		// Close connection
		mysqli_close($link);
		exit;
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
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
					<label for="creator_id">Creator ID</label>
					<input type="number" name="creator_id" min="0" max="2">
					<br>
					<label for="title">Title</label>
					<input type="text" name="title">
					<br>
					<label for="desc">Description</label>
					<input type="text" name="desc">
					<br>
					<label for="announcement_type">Announcement Type</label>
					<input type="text" name="announcement_type">
					<br>
					<label for="enddate">End Date</label>
					<input type="date" name="enddate">
					<br>
					<input type="submit" value="Submit">
				</form>
			</main>
		</div>
	</body>
</html>