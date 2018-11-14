<!doctype html>

<html>

<head>
	<!--
		Author: Conner Duncan
		Date: 10.12.18
		
		file: BackupComments.php
		
		key:
			# means note
			// means documentation
		-->
	<title>Backup Comments</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1.0">
	<script src="modernizr.custom.65897.js"></script>
</head>

<body>
	<h2>Backup Comments</h2>

	<?php
	//globals
	$source = "./comments";
	$destination = "./backups";
	
	//Creates directory if missing
	if (!is_dir($destination)) {
		mkdir($destination);
		chmod($destination, 0757);
	}
	
	//backs up directory or creates it if missing
	if (!is_dir($source)) {
		echo "The source directory did not exist, created it, no files to backup.<br>\n";
		mkdir($source);
		chmod($source, 0757);
	} else {
		/*backup directory*/
		//variables
		$totalFiles = 0;
		$filesCopied = 0;
		$dirEntries = scandir($source);
		
		//cycle through directory entries
		foreach($dirEntries as $entry) {
			//ignore files not inside the directory
			if($entry != "." && $entry != "..") {
				
				++$totalFiles;
				if (copy("$source/$entry", "$destination/$entry")){
					++$filesCopied;
				}else {
					echo "Could not copy file \"" . htmlentities($entry) . "\".<br /> \n";
				}
			}
			
		}
		echo "<p>$filesCopied of $totalFiles successfully backed up.</p>\n";
	}
	?>

</body>

</html>
