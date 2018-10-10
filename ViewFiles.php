<!doctype html>

<html>

<head>
	<!--
		Author: Conner Duncan
		Date: 10.02.18
		
		file: ViewFiles
		
		key:
			# means note
			// means documentation
		-->
	<title>View Files</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1.0">
	<script src="modernizr.custom.65897.js"></script>
</head>

<body>
	<h2>View Files</h2>

	<?php
	//Global Variable
	$dir = "../Exercise_02_01_01";
	$openDir = opendir($dir); #collects a 'resource' called a file handle
	
	
	// cycles through files within the parent directory untill none left
	while ($curFile = readdir($openDir)) { #it is not a conditional statement but will evaluate to falls if the statement is unable to execute. Acts simaler to a try statement, in the sense it checks it for an error.
		if(strcmp($curFile, '.') !== 0 && strcmp($curFile, '..')){
			echo "<a href=\"$dir/$curFile\">$curFile</a><br />\n";
		}
	}
	closedir($openDir);
	?>

</body>

</html>
