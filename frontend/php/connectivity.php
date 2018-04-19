<?php
	// DEBUG OUTPUT
	echo "connectivity.php should be running! \n";
	// TURNING ON ERROR REPORTING
	ini_set('display_errors', 'On');
	// Variables
	$servername = "localhost";
	$username = "chem";
	$password = "KCGriffith";
	$databasename = "ChemDB";
	// Create connection
	$mysqli = new mysqli($servername, $username, $password, $databasename);
	//$conn = mysql_connect($servername, $username);
	/*
	$conn = new mysqli($servername, $username, $password);
	mysqli_select_db($databasename, $conn) or die (mysql_error());
	*/
	//$conn = new mysqli($servername, $username, $password, $databasename);
	// Check connection
	if(!$mysqli) {
	//if(!$conn)
		die("connection failed: " . mysqli_connect_error());
	}
	/*
	else
	{
		echo "pre run\n";
		echo $mysqli->query("SHOW TABLES");
		echo "\npost run";
	}
	*/

	if (mysqli_ping($mysqli)){
	//if (mysqli_ping($conn)){
		echo "Our connection is ok!\n";
		//printf("Our connection is ok!\n");
	} else {
		echo "ERROR: connection is NOT ok!\n";
		echo "ERROR MESSAGE: ".mysqli_error($mysqli);
		//echo "ERROR MESSAGE: ".mysqli_error($conn);
		//printf("Error: %s\n", mysqli_error($mysqli));
	}
?>