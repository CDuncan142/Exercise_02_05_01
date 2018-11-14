<!doctype html>

<html>

<head>
	<!--
		Author: Conner Duncan
		Date: 10.09.18
		
		file: VisitorFeedback4.php
		
		key:
			# means note
			// means documentation
		-->
	<title>Visitor Feedback</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1.0">
	<script src="modernizr.custom.65897.js"></script>
</head>

<body>
	<h2>Visitor Feedback</h2>

	<?php
	//Global Vars
	$dir = "./comments";
	
	//If a folder
	if (is_dir($dir)) {
		//create an array of content in the comments directory
		$commentFiles = scandir($dir);
		//increments through comment files
		foreach ($commentFiles as $fileName) {
			//if it is not the directory and not a parent directory
			if ($fileName !== "." && $fileName !== ".."){
				echo "From <strong>$fileName</strong><br />";
				$fileHandle = fopen($dir . "/" . $fileName, "rb");
				if ($fileHandle === false) {
					echo "There was an error reading file \"". htmlentities($fileName). "\".<br />\n";
				}
				else {
//					output each line of the email.
					$from = fgets($fileHandle);#file get string
					echo "From: " . htmlentities($from) . "<br />\n";
					$email = fgets($fileHandle);
					echo "Email Address: " .htmlentities($email)."<br />\n";
					$date = fgets($fileHandle);
					echo "Date: " .htmlentities($date)."<br />\n";
					while(!feof($fileHandle)){
						$comment = fgets($fileHandle);
							if(!feof($fileHandle)){
								echo htmlentities($comment) . "<br>\n";							
							} else {
								echo htmlentities($comment) . "\n";
							}
						
					}
					
					
					echo "<hr>\n";
					fclose($fileHandle);
				}
			}
		}
	}

	?>

</body>

</html>
