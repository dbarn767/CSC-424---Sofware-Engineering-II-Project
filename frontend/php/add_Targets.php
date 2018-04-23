<?php
include 'connectivity.php'; // Establishes connection ($mysqli)

if ($_POST['submit']){
	$query = "INSERT INTO Target (".
			 "target_id, ".
			 "intended_target_gene_id, ".
			 "intended_target_entrez_gene_id, ".
			 "intended_target_official_full_name, ".
			 "intended_target_gene_name, ".
			 "intended_target_official_symbol, ".
			 "intended_target_gene_symbol, ".
			 "intended_target_description, ".
			 "intended_target_uniprot_accession_number, ".
			 "intended_target_organism_id, ".
			 "intended_target_track_status, ".
			 "technological_target_gene_id, ".
			 "technological_target_entrez_gene_id, ".
			 "technological_target_official_full_name, ".
			 "technological_target_gene_name, ".
			 "technological_target_official_symbol, ".
			 "technological_target_gene_symbol, ".
			 "technological_target_description, ".
			 "technological_target_uniprot_accession_number, ".
			 "technological_target_organism_id, ".
			 "technological_target_track_status".
			 ")".
			 " VALUES ('".
			 $_POST['target_id']."', '".
			 $_POST['intended_target_gene_id']."', '".
			 $_POST['intended_target_entrez_gene_id']."', '".
			 $_POST['intended_target_official_full_name']."', '".
			 $_POST['intended_target_gene_name']."', '".
			 $_POST['intended_target_official_symbol']."', '".
			 $_POST['intended_target_gene_symbol']."', '".
			 $_POST['intended_target_description']."', '".
			 $_POST['intended_target_uniprot_accession_number']."', '".
			 $_POST['intended_target_organism_id']."', '".
			 $_POST['intended_target_track_status']."', '".
			 $_POST['technological_target_gene_id']."', '".
			 $_POST['technological_target_entrez_gene_id']."', '".
			 $_POST['technological_target_official_full_name']."', '".
			 $_POST['technological_target_gene_name']."', '".
			 $_POST['technological_target_official_symbol']."', '".
			 $_POST['technological_target_gene_symbol']."', '".
			 $_POST['technological_target_description']."', '".
			 $_POST['technological_target_uniprot_accession_number']."', '".
			 $_POST['technological_target_organism_id']."', '".
			 $_POST['technological_target_track_status'].
			 "')";
			 
			 // PRINT THE QUERY FOR DEBUGGING
			 echo "----------------------------------QUERY-------------------------------------<br/>";
			 echo $query."<br/";
			 echo "----------------------------------------------------------------------------<br/>";
			 
			 // Send the query to the database
			 //if ($mysqli->query($query) === TRUE){
			 if (mysqli_query($mysqli, $query) === TRUE){
				 echo "New record created in Target successfully! <br/>";
			 } else {
				 echo "Error: ".$query."<br>".$mysqli->error;
			 }
			 
			 // Close the connection once finished
			 //$mysqli->close();
			 mysqli_close($mysqli);
}

/*
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
*/

?>