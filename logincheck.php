<?php 
	session_start();

	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
		echo "Hello there!";
		if (isset($redirect)) {
			header("location: $redirect");
		} else {
			header("location: /login/login.php");
		}
		exit;
	}
?>