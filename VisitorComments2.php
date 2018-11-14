<!doctype html>

<html>

<head>
	<!--
		Author: Conner Duncan
		Date: 10.11.18
		
		file: VisitorComments2.php
		
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
				
				//collects time info and extracts what it needs
				echo "\$saveString: $saveString<br />"; #debug
				$currentTime = microtime();
				echo "\$currentTime: $currentTime<br />\n"; #debug
				$timeArray = explode(" ", $currentTime);
				echo var_dump($timeArray) . "<br />";
				$timeStamp = (float)$timeArray[1] + (float)$timeArray[0];
				echo "\$timeStamp: $timeStamp<br />";
				$saveFileName = "$dir/comment.$timeStamp.txt";
				echo "\$saveFileName: $saveFileName<br />";
				//Opens file under a file handle
				$fileHandle = fopen($saveFileName, "wb"); //creates a new file if it doesn't exist. Returns false if there is an error
				#W specifies that clears the content of the file if it already existed, along with other things
				if ($fileHandle === false){
					echo "There was an error creating \"" . htmlentities($saveFileName). "\".<br />\n";
				}else {
					//locks file (like a temporary permission)
					if (flock($fileHandle, LOCK_EX)) {
						//Write to file attempt
						if (fwrite($fileHandle, $saveString) > 0) {
							echo "Successfully wrote to \"". htmlentities($saveFileName) . "\".<br />\n";
						}else {
							echo "There was an error writing to \"" . htmlentities($saveFileName). "\".<br />\n";
						}
						fclose($fileHandle);	
					}
					else {
						echo "There was an error locking file \"" . htmlentities($saveFileName)."\".<br />\n";
					}
				fclose($fileHandle);	
				}
				
			}
		}
	}else {
		mkdir($dir);
		chmod($dir, 0767);
	}
	?>
		<h2>Visitor Comments</h2>
		<form action="VisitorComments2.php" method="post">
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
