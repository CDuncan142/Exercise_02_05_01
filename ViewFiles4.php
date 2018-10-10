<!doctype html>

<html>

<head>
	<!--
		Author: Conner Duncan
		Date: 10.05.18
		
		file: ViewFiles4
		
		key:
			# means note
			// means documentation
		-->
	<title>View Files 3</title>
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
	
	/* Table start */
	echo "<table border = '1' width = '100%'>\n";
	// Table title
	echo "<tr><th colspan='4'>Directory Listing for <strong>".htmlentities($dir)/*Protects Output*/."</strong></th></tr>\n";
	//Row start: table headings start
	echo "<tr>";
	echo "<th><strong><em>Name</em></strong></th>";
	echo "<th><strong><em>Owner</em></strong></th>";
	echo "<th><strong><em>Permissions</em></strong></th>";
	echo "<th><strong><em>Size</em></strong></th>";
	
	//row end: table headings start \/
	echo "</tr>\n";
	
	// cycles through files and creates a table cell for each
	foreach($dirEntries as $entry){
		if(strcmp($entry, '.') !== 0 && strcmp($entry, '..') !== 0){
			$fullEntryName = $dir . "/" . $entry;
			//row start
			
			//creates one row made up of 3 cells. If's alternate between two different versions of the same cell
			//each iteration creates one 3 column row aligned with the last
			echo "<tr><td>";
			if (is_file($fullEntryName)) {
				echo "<a href=\"FileDownloader.php?fileName=$entry\">".htmlentities($entry)."</a>";
			}
			else {
				echo htmlentities($entry);
			}
			echo "</td>";
			echo "<td align='center'>".fileowner($fullEntryName);
			if (is_file($fullEntryName)) {
				$perms = fileperms($fullEntryName);
				$perms = decoct($perms % 01000);
				echo"</td><td align='center'> 0$perms";
				echo"</td><td align='right'>" . number_format(filesize($fullEntryName), 0). " bytes";
			}
			else{
				echo "</td><td colspan='2' align='center'>&lt;DIR&gt;";
			}
			echo "</td></tr>\n";
		}
	}
	echo "</table>\n";
	/* Table End */
	?>

</body>

</html>
