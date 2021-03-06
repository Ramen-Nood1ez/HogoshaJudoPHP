<?php
	session_start();
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: /index.php");
		exit;
	}
?>

<?php
	define('KB', 1024);
	define('MB', 1048576);
	define('GB', 1073741824);
	define('TB', 1099511627776);

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$morephotos = isset($_POST["morephotos"]);
		chdir("../morephotos/");
		// chdir("./morephotos");
		$description = isset($_POST["desc"]) ? $_POST["desc"] : "";
		$d = getcwd();
		echo $d;
		$target_dir = (empty($description)) ? "$d/morephotos" : "../photos/";
		$target_file = $target_dir . basename($_FILES["file"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

		if (!empty($description)) {
			echo $_FILES["file"]["name"] . "$description";
			$file = fopen("../photos/desc.txt", "a") or die("Unable to open file!");
			fwrite($file, "\n" . $_FILES["file"]["name"] . "+$description");
			fclose($file);
		}

		// Skipping the check to check if an image is fake

		if (file_exists($target_file)) {
			$message = "Sorry, file already exists.";
			echo "Sorry, file already exists.";
			$uploadOk = 0;
		}

		// Check file size
		if ($_FILES["file"]["size"] > 20*MB) {
			$message = "Sorry, your file is too large.";
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}

		// Skipping ext check

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			//$message = "Sorry, there was a problem with your upload... Please try again later...";
			echo "Sorry, there was a problem with your upload... Please try again later...";
			// If everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
				$message = "The file " . htmlspecialchars( basename( $_FILES["file"]["name"])) . " has been uploaded";
				echo "The file " . htmlspecialchars( basename( $_FILES["file"]["name"])) . " has been uploaded";
			} else {
				$message = "Sorry, there was a problem uploading your file... Please try again later...";
				echo "Sorry, there was a problem uploading your file... Please try again later...";
			}
		}
	}

	header("location: upload.php?message=$message");
	exit;
?>