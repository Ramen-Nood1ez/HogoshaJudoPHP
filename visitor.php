<?php 
	session_start();
	echo $_SERVER['REMOTE_ADDR'];
	echo inet_pton($_SERVER['REMOTE_ADDR']);
?>