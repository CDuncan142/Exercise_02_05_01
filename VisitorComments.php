<!doctype html>

<html>

<head>
	<!--
		Author: Conner Duncan
		Date: 10.02.18
		
		file: VisitorComments.php
		
		key:
			# means note
			// means documentation
		-->
	<title>Visitor Comments</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1.0">
	<script src="modernizr.custom.65897.js"></script>
</head>

<body>
	<?php
	//Global Vars
	$dir = "./comments";
	
	//If a folder
	if(is_dir($dir)){
		if(isset($_POST['save'])) {
			//no name
			if (empty($_POST['name'])) {
				echo "Unknown visitor\n";
			}
			else {
				//save info to a string delimited by new lines
				//+ formats data
				$saveString = stripslashes($_POST['name']) . "\n";
				$saveString .= stripslashes($_POST['email']) . "\n";
				$saveString .= date('r') . "\n";
				$saveString .= stripslashes($_POST['comment']) . "\n";
				
				//collects time info
				echo "\$saveString: $saveString<br />"; #debug
				$currentTime = microtime();
				//extracts needed info
				echo "\$currentTime: $currentTime<br />\n"; #debug
				$timeArray = explode(" ", $currentTime);
				echo var_dump($timeArray) . "<br />";
				$timeStamp = (float)$timeArray[1] + (float)$timeArray[0];
				echo "\$timeStamp: $timeStamp<br />";
				//creates timestamped file path
				$saveFileName = "$dir/comment.$timeStamp.txt";
				echo "\$saveFileName: $saveFileName<br />";
				//creates file with info inside. Handles if unsuccessful
				if (file_put_contents($saveFileName, $saveString) > 0) {
					echo "File \"" . htmlentities($saveFileName). "\" successfully saved.<br />\n";
					
				}
				else {
					echo "There was an error writing \"" . htmlentities($saveFileName). "\".<br />\n";
				}
			}
		}
	}else {
		//makes directory if needed. Gives proper permisions.
		mkdir($dir);
		chmod($dir, 0767);
	}
	?>
		<h2>Visitor Comments</h2>
		<form action="VisitorComments.php" method="post">
			<label for="name">Your Name:</label>
			<input type="text" name="name" />
			<br />
			<label for="email">Your email:</label>
			<input type="email" name="email" />
			<br />
			<textarea name="comment" id="" cols="100" rows="6"></textarea>
			<br />
			<input type="submit" name="save" value="Submit Your Comment">
		</form>


</body>

</html>
