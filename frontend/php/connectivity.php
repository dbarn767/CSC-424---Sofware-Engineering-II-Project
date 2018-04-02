<?php
	// DEBUG OUTPUT
	echo "connectivity.php should be running! \n";
	// Variables
	$servername = "localhost";
	$username = "root";
	$password = "";
	$databasename = "ChemDB";
	// Create connection
	$mysqli = new mysqli($servername, $username, $password, $databasename);
	// Check connection
	if(!$mysqli) {
		die("connection failed: " . mysqli_connect_error());
	}
?>