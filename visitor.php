<?php 
	session_start();
	echo $_SERVER['REMOTE_ADDR'] . "\n";
	echo $_SERVER['HTTP_X_FORWARDED_FOR'];
?>