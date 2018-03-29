<?php

$servername = "localhost";
$aeid = "aeid";
$assay_src = "assay_src";
$organism = "organism";
$tissue = "tissue";
$cell_line = "cell_line";
$dbname = "myDB";


//Create connection
$conn = new mysqli($servername, $aeid, $assay_src, $organism, $tissue, $cell_line, $dbname);
//Check Connection
if($conn->connect_error){
	die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO Experiment (aeid, assay_src, organism, tissue, cell_line)"

if($conn->query($sql) === TRUE) {
	echo "New record created successfully";
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn -> close();

?>