<?php 
	session_start();

	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
		if (isset($redirect)) {
			header("location: $redirect");
		} else {
			header("location: /login/login.php");
		}
		exit;
	}
?>