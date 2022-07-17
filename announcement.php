<?php 
	require_once("./login/config.php");
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
		$description = "";
		$announcement_type = 0;
		$end_date = $current_date;

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
	}

	$description = $title = "";
	$end_date = $current_date;
	$type = $id = 0;

	$sql = "SELECT id, title, description, type, end_date FROM announcements WHERE id=(SELECT MAX(id) FROM announcements)";

	if ($stmt = mysqli_prepare($link, $sql)) {
		// Attempt to execute prepared statement
		if (mysqli_stmt_execute($stmt)) {
			// Store result
			mysqli_stmt_store_result($stmt);

			// Bind result variables
			mysqli_stmt_bind_result($stmt, $id, $title, $description, $type, $end_date);
			
			if (mysqli_stmt_fetch($stmt)) {
				// Password is correct, so start a new session
				session_start();

				if (strtotime($current_date) <= strtotime($end_date)) {
					echo "<h3>" . $title . "</h3>\n";
					echo "<p>" . $description . "</p>";
				}
			}
		} else {
			echo "Oops! Something went wrong. Please try again later.";
		}

		// Close statement
		mysqli_stmt_close($stmt);
	}

	// Close connection
	mysqli_close($link);
?>