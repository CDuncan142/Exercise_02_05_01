<!doctype html>

<html>

<head>
	<!--
		Author: Conner Duncan
		Date: 10.12.18
		
		file: TheGame.php
		
		key:
			# means note
			// means documentation
	-->
	<title>The Game</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1.0">
	<script src="modernizr.custom.65897.js"></script>
	<link rel="stylesheet" href="modernizr.custom.65897.js" />
	<link rel="stylesheet" href="TheGame.css" />
</head>

<body>
	<div class="pageHeader">
		<h2>The Game</h2>
	</div>


	<?php
	//global variables
	$redisplayForm = false;
	$errorCount = 0;
	$file = "./TheGame.txt";
	
	//When form is submited
	if (isset($_POST['submit'])){
		$registration[] = processFormData("username", $_POST['username']);
		$registration[] = processFormData("password", $_POST['password']);
		$registration[] = processFormData("fullName", $_POST['fullName']);
		$registration[] = processFormData("screenName", $_POST['screenName']);
		$registration[] = processFormData("email", $_POST['email']);
		$registration[] = processFormData("age", $_POST['age']);
		$registration[] = processFormData("comments", $_POST['comments']);
		
		//Unique validation
		
		#check for illegal characters (such as |)
		
		//Redisplays form below any error messages or records information
		if($redisplayForm){
			//reinput data into 
			displayForm($registration[0],
						$registration[1],
						$registration[2],
						$registration[3],
						$registration[4],
						$registration[5],
						$registration[6]);
		} else {
			
			//Organizes form data into delimited string. Then opens file record & creates it if it is missing.
			$playerRecord = implode("|", $registration);
			$fileHandle = fopen($file, "ab");
			
			//Opens, locks, and writes info to file. Displays error if it fails to do so.
			if ($fileHandle === false) {
				echo "Could not open TheGame.txt";
			} else {
				//lock
				if(flock($fileHandle, LOCK_EX)){#not suppose to be a string for some reason
					$playerRecord .= "\n";
					if (fwrite($fileHandle, $playerRecord) > 0){
						echo "Successfully created account.";
					}else {
						echo "Error writing record to file.";
					}
				} else {
					echo "Error locking record file.";
				}
				fclose($fileHandle);
			}
		}
		
	} else { 
		//initialize form
		displayForm("", "", "", "", "", "", "");
	}
	
	
	//validates and formats individual form data
	function processFormData($fieldName, $fieldData) {
		$finalValue;
		
		if (empty($fieldData)){
			$finalValue = "";
			displayError("is required.<br />\n", $fieldName);
		} else {
			//format
			$finalValue = trim($fieldData);
			$finalValue = addslashes($finalValue);
		}
		return $finalValue;
	}
	
	// displays indications of an error
	
	function displayError($errorMsg, $field) {
		//track and display error
		global $errorCount;	
		global $redisplayForm;
		$errorCount++;
		$redisplayForm = true;
		echo "$field $errorMsg";
		//highlight element	
	}
	
	//displays form
	function displayForm($username, $password, $fullName, $screenName, $email, $age, $comments){
		?>
		<form action="TheGame.php" id="registerForm" method="post">
			<div class="formRow">
				<label for="username">Username</label>
				<input type="text" name="username" value="<?php $username ?>" />
				<label for="password">Password</label>
				<input type="text" name="password" value="<?php $password ?>" />
			</div>
			<div class="formRow">
				<label for="fullName">Full Name</label>
				<input type="text" name="fullName" value="<?php $fullName ?>" />
				<label for="screenName">Screen Name</label>
				<input type="text" name="screenName" value="<?php $screenName ?>" />
			</div>
			<div class="formRow">
				<label for="email">E-Mail</label>
				<input type="email" name="email" value="<?php $email ?>" />
				<label for="age">Age</label>
				<input type="number" name="age" value="<?php $age ?>" />
			</div>
			<div class="formRow">
				<label for="comments" id="commentLabel">Comments</label>
				<textarea name="comments" id="commentInput" value="<?php $comments ?>"></textarea>
			</div>
			<div class="formRow">
				<input type="reset" value="reset" />
				<input type="submit" name="submit" />
			</div>

		</form>

		<?php
	}
	echo "<hr /><br />\n";
	
	/*display screen name for each recorded user*/
	
	//Opens, then locks and reads info from file. Displays error if it fails to do so.
	if(is_file($file)){
		$fileHandle = fopen($file, "rb");// HERES THE ISSUE!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	} else {
		$fileHandle = fopen($file, "rb");// HERES THE ISSUE!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		chmod($file, 0757); #could possibly apply it regardless to simplify it.
	}
	
	if ($fileHandle === false) {
		echo "Could not access records";
	} else {
		if(flock($fileHandle, LOCK_EX)){#not suppose to be a string for some reason
			//loops through each line of the text file until it reaches the end.
			while(!feof($fileHandle)){
				//collects a singular players account records
				$rawAccountRecord = fgets($fileHandle);
				//checks if there is any player data
				if (!empty($rawAccountRecord)){
					//displays screen name 
					$account = explode("|", $rawAccountRecord);
					$screenName = $account[3]; #screenName
					echo "<div class=\"playerBoard\">$screenName</div>";
				}
			}
		} else {
			echo "Error locking record file";
		}
		fclose($fileHandle);
	}
	
	
	?>
</body>

</html>
