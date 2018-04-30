<?php 
include 'connectivity.php'; // Establish connection ($mysqli)

// check for submission
// retrieve value from posted data
if ($_POST['submit']){
	$name = $_POST['name'];
	$password = $_POST['passw'];
	
	// Create the query
	$query = "SELECT * FROM Users WHERE name='".$name."', password='".$password."'";

	// DEBUG
	echo "--------------------------- QUERY ------------------------------<br/>";
	echo $query."<br/>";
	echo "--------------------------- QUERY ------------------------------<br/>";
	
	if (mysqli_ping($mysqli)){
		echo "Our connection is ok! <br/>";
	} else {
		echo "ERROR MESSAGE: ".mysqli_error($mysqli)."<br/>";
	}

	// Get a result
	$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
	
	mysqli_close($mysqli);
	
	// Create while loop and loop through result set
	if (mysqli_fetch_array($result) !== false){
		return "LOGGED IN";
	}
	
	return "Username or password was incorrect!";
}

?>
