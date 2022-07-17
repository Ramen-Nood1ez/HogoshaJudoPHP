<?php 
	session_start();
	echo $_SERVER['REMOTE_ADDR'] . "\n";
	$packed = inet_pton($_SERVER['REMOTE_ADDR']);
	if ($packed == false) {
		echo "IP address is not valid\n";
	}
	else {
		echo "$packed";
	}
?>