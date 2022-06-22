<?php
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'hogoshaj_carter');
	define('DB_PASSWORD', 'F53MiNGPB6QrXbGgEB3T');
	define('DB_NAME', 'hogoshaj_fileshare');

	$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

	if ($link === false) {
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}
?>