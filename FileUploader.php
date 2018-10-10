<!doctype html>

<html>

<head>
	<!--
		Author: Conner Duncan
		Date: 10.04.18
		
		file: FileUploader.php
		
		key:
			# means note
			// means documentation
		-->
	<title>File Uploader</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1.0">
	<script src="modernizr.custom.65897.js"></script>
</head>

<body>
	<h2>File Uploader</h2>

	<?php
	//Globals
	$dir = "."; #current file (aka relative syntax)
	
	//checks for submition
	if(isset($_POST['upload'])){
		if(isset($_FILES['newFile'])){
			if(move_uploaded_file($_FILES['newFile']['tmp_name'], $dir . "/" . $_FILES['newFile']['name']) == true){
				chmod($dir . "/" . $_FILES['newFile']['name'], 0644);
				echo "File \"" . htmlentities($_FILES['newFile']['name']) . "\" successfully uploaded.<br />\n";
			}else{
				echo "There was an error uploading \"" . htmlentities($_FILES['newFile']['name']) . "\".<br />\n";
			}
//			echo $_FILES['newFile']['tmp_name'];
		}
	}
	
	?>

		<form action="FileUploader.php" method="post" enctype="multipart/form-data">
			<input type="hidden" name="MAX_FILE_SIZE" value="25000" /> File to upload:
			<input type="file" name="newFile" />
			<br /> (25,000 byte limit)
			<br />
			<input type="submit" name="upload" value="Upload the File" />
			<br />
		</form>

</body>

</html>
