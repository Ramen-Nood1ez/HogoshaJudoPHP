<?php
	session_start();
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: /index.php");
		exit;
	}
?>

<?php
	function show_alert($message) {
		// Display the alert box
		echo "<script>alert('$message');</script>";
	}

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
			show_alert("Sorry, file already exists.");
			echo "Sorry, file already exists.";
			$uploadOk = 0;
		}

		// Check file size
		if ($_FILES["file"]["size"] > 5000000) {
			show_alert("Sorry, your file is too large.");
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}

		// Skipping ext check

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			show_alert("Sorry, there was a problem with your upload... Please try again later...");
			echo "Sorry, there was a problem with your upload... Please try again later...";
			// If everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
				show_alert("The file " . htmlspecialchars( basename( $_FILES["file"]["name"])) . " has been uploaded");
				echo "The file " . htmlspecialchars( basename( $_FILES["file"]["name"])) . " has been uploaded";
			} else {
				show_alert("Sorry, there was a problem uploading your file... Please try again later...");
				echo "Sorry, there was a problem uploading your file... Please try again later...";
			}
		}
	}

	sleep(1);
	header("location: upload.php");
	exit;
?>