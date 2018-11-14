<!--
	Author: Conner Duncan
	Date: 10.18.18
	
	File: TheGame2.php

-->


<!doctype html>

<html>

<head>
	<title>TheGame2</title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="initial-scale=1.0" />
	<script src="modernizr.custom.65897.js"></script>
</head>

<body>
	<?php
	//entry code
	//determine if user has submited data to us
	//yes ~ process the data
	$dir = ".";	
	$saveFileName = "./TheGamers.txt";
	$saveString = "";
	$dataArray = array();

	displayAlert("I be an alert :}");
	
	function displayAlert($message) {
		echo "<script>alert(\"$message\")</script>";
	}

	if(is_dir()){
		if (isset($_POST['save'])){
			if(empty($_POST['userName'])) {
				displayAlert("Unknown Visitor");
			} 
			else {
				$dataArray[] = stripslashes($_POST['userName']);
				$dataArray[] = stripslashes($_POST['password']);
				$dataArray[] = stripslashes($_POST['fullName']);
				$dataArray[] = stripslashes($_POST['email']);
				$dataArray[] = stripslashes($_POST['age']);
				$dataArray[] = stripslashes($_POST['screenName']);
				$dataArray[] = stripslashes($_POST['comments']);
				$saveString = implode(";", $dataArray);
				
				echo "$saveString: $saveString";
				$fileHandle = fopen($saveString, "ab");
				if (!$fileHandle){
					displayAlert("There was an error creating $saveFileName");
				} else {
					fclose($fileHandle);
				}
			}
		}
	}
	?>

		<!-- HTML for form-->
		<h2>The Game #2</h2>
		<form action="TheGame2.php" method="post">
			User Name
			<input type="text" name="userName" />
			<br /> Password
			<input type="password" name="password" />
			<br /> Full Name
			<input type="text" name="fullName" />
			<br /> E-Mail
			<input type="email" name="email" />
			<br /> Age
			<input type="number" name="age" />
			<br /> Screen Name
			<input type="text" name="screenName">
			<br /> Comments
			<textarea name="comments" cols="30" rows="10">MOŒ!!!!!!</textarea>
			<br />
			<input type="submit" name="submit" />
		</form>

		<?php
		//displays code to display all gamers
		
		?>
</body>

</html>
