<!doctype html>

<html>

<head>
	<!--
		Author: Conner Duncan
		Date: 10.02.18
		
		file: ViewFiles2
		
		key:
			# means note
			// means documentation
		-->
	<title>View Files 2</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1.0">
	<script src="modernizr.custom.65897.js"></script>
</head>

<body>
	<h2>View Files 3</h2>

	<?php
	//Global Variable
	$dir = "../Exercise_02_01_01";
	$dirEntries = scandir($dir);
	
	
	// cycles through files within the parent directory untill none left
	foreach($dirEntries as $entry){
		if(strcmp($entry, '.') !== 0 && strcmp($entry, '..') !== 0){
			echo "<a href=\"$dir/$entry\">$entry</a><br />\n";
		}
	}
	?>

</body>

</html>
