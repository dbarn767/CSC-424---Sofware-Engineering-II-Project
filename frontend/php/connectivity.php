<?php
	// DEBUG OUTPUT
	//echo "connectivity.php should be running! \n";
	// TURNING ON ERROR REPORTING
	ini_set('display_errors', 'On');
	// Variables
	$servername = "localhost";
	$username = "chem";
	$password = "KCGriffith";
	$databasename = "ChemDB";
	// Create connection
	$mysqli = new mysqli($servername, $username, $password, $databasename);
	// Check connection
	if(!$mysqli) {
	//if(!$conn)
		die("connection failed: " . mysqli_connect_error());
	}

	if (mysqli_ping($mysqli)){
		echo "Our connection is ok! <br/>";
	} else {
		//echo "ERROR: connection is NOT ok! <br/>";
		echo "ERROR MESSAGE: ".mysqli_error($mysqli)."<br/>";
	}
?>