<?php

$servername = "localhost";
$target_id = "target_id";
$type = "type";
$full_name = "full_name";
$symbol = "symbol";
$gene_name = "gene_name";
$gene_symb = "gene_symb";
$target_desc = "target_desc";
$dbname = "myDB";


//Create connection
$conn = new mysqli($servername, $target_id, $type, $full_name, $symbol, $gene_name, $gene_symb, $target_desc, $dbname);
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