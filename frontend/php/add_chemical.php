<?php

$servername = "localhost";
$casn = "casn";
$sid = "sid";
$cid = "cid";
$formula = "formula";
$SMILES = "SMILES";
$PC_FP = "PC_FP";
$names = "names";
$mw = "mw";
$dbname = "myDB";
$user


//Create connection
$conn = new mysqli($servername, $casn, $sid, $cid, $formula, $SMILES, $PC_FP, $names, $mw, $dbname);
//Check Connection
if($conn->connect_error){
	die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO Chemicals (casn, sid, cid, formula, SMILES, PC_FP, names, mw)"

if($conn->query($sql) === TRUE) {
	echo "New record created successfully";
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn -> close();

?>