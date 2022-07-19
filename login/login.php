<?php
	$redirect = isset($_GET["redirect"]) ? htmlspecialchars($_GET["redirect"]) : "/index.php";

	// Intialize the session
	session_start();

	// Check if user is already logged in, 
	// if yes send them to the welcome page
	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
		echo $redirect;
		header("location: $redirect");
		exit;
	}
	
	// Include config file
	require_once ("./config.php");

	// Define variables and initialize with empty values
	$username = $password = "";
	$permlevel = 0;
	$username_err = $password_err = $login_err = "";

	$account_disabled = false;

	if (isset($_SESSION["accountdisabled"]) && $_SESSION["accountdisabled"]) {
		$login_err = "account disabled";
		$account_disabled = true;
	}

	// Processing form data when form is submitted
	if(($_SERVER["REQUEST_METHOD"] == "POST") && !$account_disabled) {

		// Check if username is empty
		if (empty(trim($_POST["username"]))) {
			$username_err = trim($_POST["username"]);
		} else {
			$username = trim($_POST["username"]);
		}

		// Check if password is empty
		if (empty(trim($_POST["password"]))) {
			$password_err = "Please enter your password.";
		} else {
			$password = trim($_POST["password"]);
		}

		$invalid_password = false;

		// Validate credentials
		if (empty($username_err) && empty($password_err)) {
			// Prepare a select statement
			$sql = "SELECT id, username, password, permlevel, disabled FROM users WHERE username = ?";

			if ($stmt = mysqli_prepare($link, $sql)) {
				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt, "s", $param_username);

				// Set parameters
				$param_username = $username;

				// Attempt to execute prepared statement
				if (mysqli_stmt_execute($stmt)) {
					// Store result
					mysqli_stmt_store_result($stmt);

					// Check if username exists, if yes then verify password
					if (mysqli_stmt_num_rows($stmt) == 1) {
						// Bind result variables
						mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $permlevel, $disabled);
						
						if (mysqli_stmt_fetch($stmt)) {
							if ($disabled == 1) {
								$login_err = "Account disabled";
								session_start();
								$_SESSION["accountdisabled"] = true;
							} else {
								if (password_verify($password, $hashed_password)) {
									// Password is correct, so start a new session
									session_start();
	
									// Store data in session variables
									$_SESSION["loggedin"] = true;
									$_SESSION["id"] = $id;
									$_SESSION["username"] = $username;
									$_SESSION["permlevel"] = $permlevel;
									unset($_SESSION["numattempts"]);
	
									// Redirect user to main page
									header("location: $redirect");
								} else {
									// Password is not valid, display a generic error message
									$login_err = "Invalid username or password.";
									$invalid_password = true;
								}
							}
						}
					} else {
						// Username doesn't exist, display a generic error message
						$login_err = "Invalid username or password.";
					}
				} else {
					echo "Oops! Something went wrong. Please try again later.";
				}

				// Close statement
				mysqli_stmt_close($stmt);
			}
		}

		if ($invalid_password) {
			session_start();
			if (!isset($_SESSION["numattempts"])) {
				$_SESSION["numattempts"] = 1;
			} else {
				$_SESSION["numattempts"] += 1;
			}
			$num_attempts = $_SESSION["numattempts"];

			if ($num_attempts >= 3) {
				$sql = "UPDATE users SET disabled = 1 WHERE username='$username'"; // VALUES (?, ?)";
				// echo "Test";

				if ($stmt = mysqli_prepare($link, $sql)) {
					// echo "prepare\n";
					// Bind variables to the prepared statement as parameters
					mysqli_stmt_bind_param($stmt, "is", $param_disabled, $param_username);
					// echo "bind\n";

					// Set parameters
					$param_disabled = 1;
					$param_username = $username;

					// Attempt to execute the prepared statement
					if (mysqli_stmt_execute($stmt)) {
						echo "Account Disabled because of 3 failed attempts!";
						session_start();
						$_SESSION["accountdisabled"] = true;
						$addr = $_SERVER['REMOTE_ADDR'];

						$msg = "<html><head><title>Login Alert</title>";
						$msg .= "<link rel='stylesheet' href='https://hogoshajudo.org/public/newstyle.css'";
						$msg .= "</head><body>";
						$msg .= "Someone with the ip address of <b>($addr)</b> attempted ";
						$msg .= "to login with a valid username <b>($username)</b>, but incorrect ";
						$msg .= "password 3 times. The account has been disabled.";
						$msg .= "</body></html>";
						
						$headers = "MIME-Version: 1.0" . "\r\n";
						$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
						$headers .= "From: loginalerts@hogoshajudo.org" . "\r\n";

						mail("cookiejar@hogoshajudo.org", "Failed Login Attempt", wordwrap($msg));
					} else {
						echo "Oops! Something went wrong...";
					}
				} else {
					// echo "$address";
					echo "prepare failed!";
				}

					mysqli_stmt_close($stmt);
			} else {
				$address = $_SERVER['REMOTE_ADDR'];
				$sql = "INSERT INTO loginattempts (ip, username, attempt_num) VALUES ('$address', '$username', '$num_attempts')"; // VALUES (?, ?)";
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
						echo "Attempt Logged!";
					} else {
						echo "Oops! Something went wrong...";
					}

					mysqli_stmt_close($stmt);
				} else {
					// echo "$address";
					echo "prepare failed!";
				}
			}
		}

		// Close connection
		mysqli_close($link);
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Hogosha Judo File Share</title>
	<!--link rel="stylesheet" href="/public/style.css"-->
	<link rel="stylesheet" href="/public/newstyle.css">
</head>
<body>

	<div id="includedContent" class="topnav">
		<?php 
			include("../navbar.php");
		?>
	</div>

	<div class="panel">
		<section class="login">
			<h2 style="grid-area: header;">Login</h2>
			<p style="grid-area: instructions;">Please fill in your credentials to login.</p>

			<?php 
				if (!empty($login_err)) {
					echo "<div class='error'> " . $login_err . "</div>";
				}
			?>

			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
				<div class="username">
					<label style="grid-area: username-label;">Username</label>
					<br>
					<input style="grid-area: username-input;" 
						type="text" name="username" value="<?php echo $username; ?>">
					<br>
					<span style="grid-area: username-err;" ><?php echo $username_err; ?></span>
				</div>
				<div class="password">
					<label style="grid-area: password-label;">Password</label>
					<br>
					<input type="password" style="grid-area: password-input;" name="password">
					<br>
					<span style="grid-area: password-err; font-size: small;"><?php echo $password_err; ?></span>
				</div>
				<div class="submit">
					<input type="submit" style="grid-area: submit-btn;" value="Login">
				</div>
			</form>
		</section>
	</div>
</body>
</html>