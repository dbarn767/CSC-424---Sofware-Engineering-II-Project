<?php
include 'connectivity.php'; // Establishes connection ($mysqli)

if ($_POST['submit']){
	$username = $_POST['usr_name'];
	$fullname = $_POST['full_name'];
	$password = $_POST['pass'];
	$confirmPassword = $_POST['pass_2'];
	$email = $_POST['email'];
	
	//$regexNOGO = '/\s+/';
	$regexGO = '/\s*\w/';
	if (!preg_match($regexGO, $username)){
		echo "ERROR: Username must be specified! <br/>";
		mysqli_close($mysqli);
		return;
	}
	if (!preg_match($regexGO, $fullname)){
		echo "ERROR: Fullname must be specified! <br/>";
		mysqli_close($mysqli);
		return;
	}
	if (!preg_match($regexGO, $password)){
		echo "ERROR: Password must be specified! <br/>";
		mysqli_close($mysqli);
		return;
	}
	if (!preg_match($regexGO, $email)){
		echo "ERROR: Email must be specified! <br/>";
		mysqli_close($mysqli);
		return;
	}
	
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo "ERROR: Incorrect Email format! <br/>";
		mysqli_close($mysqli);
		return;
	}
	
	if ($confirmPassword != $password){
		// Throw an error and exit
		echo "ERROR: password confirmation did not match password given! <br/>";
		mysqli_close($mysqli);
		return;
	}
	
	$date = date('m/d/Y h:i:s a', time());
	
	$query = "INSERT INTO Users (".
			 "userID, ".
			 "name, ".
			 "password, ".
			 "email, ".
			 "level, ".
			 "loggedIn, ".
			 "creationDate ".
			 ")".
			 " VALUES ('".
			 $username."', '".
			 $fullname."', '".
			 $password."', '".
			 $email."', '".
			 "ADMIN', '0', '".
			 $date.
			 "')";
			 
			 // PRINT THE QUERY FOR DEBUGGING
			 echo "----------------------------------QUERY-------------------------------------<br/>";
			 echo $query."<br/";
			 echo "----------------------------------------------------------------------------<br/>";
			 
			 // Send the query to the database
			 if (mysqli_query($mysqli, $query) === TRUE){
				 echo "New record created in Target successfully! <br/>";
			 } else {
				 echo "Error: ".$query."<br>".$mysqli->error;
			 }
			 
			 // Close the connection once finished
			 mysqli_close($mysqli);
}

?>