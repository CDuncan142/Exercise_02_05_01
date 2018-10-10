<!--
	Author: Conner Duncan
	Date: 10.02.18

	file: FileDownloader.php
	
	key:
		# means note
		// means documentation
-->

<?php
	
	//Global variables
	$dir = "../Exercise_02_01_01";
	//if form submited
	if (isset($_GET['fileName'])) {
		$fileToGet = $dir . "/" . stripslashes($_GET['fileName']);
		if(is_readable($fileToGet)){
			$errorMsg = "";
			$showErrorPage = false;
			header("Content-Description: File Transfer");
			header("Content-Type: application/force-download");
			header("Content-Disposition: attachment; filename=\"" . $_GET['fileName'] . "\"");
			header("Content-Transfer-Encoding: base64");
			header("Content-Length: " . filesize($fileToGet));
			readfile($fileToGet);
		} else {
			$errorMsg = "Cannot read \"$fileToGet\"";
			$showErrorPage = true;
		}
		
	}// if initial load
	else{
		$errorMsg = "No filename specified";
		$showErrorPage = true;
	}

	//Displays error page html if required.
	if ($showErrorPage) {
	?>

	<!doctype html>

	<html>

	<head>

		<title>File Download Error</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0">
		<script src="modernizr.custom.65897.js"></script>
	</head>

	<!--Body Start-->

	<body>

		<p>There was an error downloading "
			<?php echo htmlentities($_GET['fileName']); ?>."</p>

	</body>
	<!--Body End-->

	</html>
	<?php
	}
?>
