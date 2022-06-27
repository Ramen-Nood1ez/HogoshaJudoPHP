<?php 
	// Check if user is logged in, and show them things they have permissions to see
	session_start();

	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
		$permlevel = $_SESSION["permlevel"];

		if ($permlevel >= 3) {
			echo "<a href='/admin/panel.php'>Admin Panel</a>";
		}

		echo "<a href='/login/logout.php'>Logout</a>";
	} else {
		echo "<a href='/login/login.php'>Login</a>";
	}
?>