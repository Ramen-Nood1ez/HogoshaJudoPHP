<?php 
	require_once("./login/config.php");
	session_start();
	echo $_SERVER['REMOTE_ADDR'] . "\n";


	$address = $_SERVER['REMOTE_ADDR'];

	$details = json_decode(file_get_contents("http://ipinfo.io/{$address}/json"));
	echo $details->country; // -> "Mountain View"

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

	echo "$selected_addr";

	if (empty($selected_addr)) {
		$sql = "INSERT INTO uvisitors (ip, country) VALUES ('$address', '$details')"; // VALUES (?, ?)";
		echo "Test";

		if ($stmt = mysqli_prepare($link, $sql)) {
			echo "prepare\n";
			// Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt, "ss", $param_ip, $param_country);
			echo "bind\n";

			// Set parameters
			$param_ip = $address;
			$param_country = $details;

			// Attempt to execute the prepared statement
			if (mysqli_stmt_execute($stmt)) {
				echo "Added to visitors!";
			} else {
				echo "Oops! Something went wrong...";
			}

			mysqli_stmt_close($stmt);
		} else {
			echo "$address";
			echo "prepare failed!";
		}
	}

	mysqli_close($link);
?>