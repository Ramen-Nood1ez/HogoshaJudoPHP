<?php
	session_start();
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: /index.php");
		exit;
	}
?>

<?php 
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		echo $_POST["file"];
	}
?>