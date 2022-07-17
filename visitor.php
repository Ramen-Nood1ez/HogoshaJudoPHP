<?php 
	session_start();
	echo $_SERVER['REMOTE_ADDR'] . "\n";

	$address = $_SERVER['REMOTE_ADDR'];

	$sql = "SELECT ip FROM uvisitors WHERE ip='$address'";

	$selected_addr = "";

	if ($stmt = mysqli_prepare($link, $sql)) {
		echo "Prepare\n";
		// Attempt to execute prepared statement
		if (mysqli_stmt_execute($stmt)) {
			echo "execute\n";
			// Store result
			mysqli_stmt_store_result($stmt);
			echo "store\n";

			// Bind result variables
			mysqli_stmt_bind_result($stmt, $selected_addr);
			echo "bind\n";
			
			if (mysqli_stmt_fetch($stmt)) {
				echo "fetch\n";
				echo "Found ip:\t\t$selected_addr\n";
			} else {
				echo "Fetch went wrong!\n";
			}
		} else {
			echo "Oops! Something went wrong. Please try again later.\n";
		}

		// Close statement
		mysqli_stmt_close($stmt);
	}

	// Close connection
	mysqli_close($link);
?>