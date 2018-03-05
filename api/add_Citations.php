<?php

$servername = "localhost";
$citation_id = "citation_id";
$url = "url";
$author = "author";
$title = "title";
$citation = "citation";
$DOI = "DOI"
$dbname = "myDB";


//Create connection
$conn = new mysqli($servername, $target_id, $type, $full_name, $symbol, $gene_name, $gene_symb, $target_desc, $dbname);
//Check Connection
if($conn->connect_error){
	die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO Targets (target_id, type, full_name, symbol, gene_name, gene_symb, target_desc)";

if($conn->query($sql) === TRUE) {
	echo "New record created successfully";
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn -> close();

?>