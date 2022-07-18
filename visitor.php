<?php 
	require_once("./login/config.php");
	session_start();
	echo $_SERVER['REMOTE_ADDR'] . "\n";

	$address = $_SERVER['REMOTE_ADDR'];

	$sql = "SELECT ip FROM uvisitors WHERE ip='$address'";

	$selected_addr = "";

	if ($stmt = mysqli_prepare($link, $sql)) {
		// Attempt to execute prepared statement
		if (mysqli_stmt_execute($stmt)) {
			// Store result
			mysqli_stmt_store_result($stmt);

			// Bind result variables
			mysqli_stmt_bind_result($stmt, $selected_addr);
			
			if (mysqli_stmt_fetch($stmt)) {
				echo "Found ip:\t\t$selected_addr\n";
			} else {
				// echo "Couldn't find ip address in the database... Adding it...";
			}
		} else {
			echo "Oops! Something went wrong. Please try again later.\n";
		}

		// Close statement
		mysqli_stmt_close($stmt);
	}

	// Close connection
	mysqli_close($link);

	echo "$selected_addr";

	if (empty($selected_addr)) {
		$sql2 = "INSERT INTO uvisitors (id, ip) VALUES (NULL, $address)"; // VALUES (?, ?)";
		echo "Test";

		if ($stmt2 = mysqli_prepare($link2, $sql2)) {
			echo "prepare\n";
			// Bind variables to the prepared statement as parameters
			// mysqli_stmt_bind_param($stmt, "ss", $param_id, $param_ip);
			// echo "bind\n";

			// Set parameters
			$param_ip = $address;
			$param_id = "NULL";

			// Attempt to execute the prepared statement
			if (mysqli_stmt_execute($stmt2)) {
				echo "Added to visitors!";
			} else {
				echo "Oops! Something went wrong...";
			}

			mysqli_stmt_close($stmt2);
		} else {
			echo "prepare failed!";
		}
	}

	mysqli_close($link2);
?>