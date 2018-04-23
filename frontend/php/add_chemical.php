<?php
include 'connectivity.php'; // Establishes connection ($mysqli)

if ($_POST['submit']){
	$query = "INSERT INTO Chemicals (".
			 "DSSTox_Substance_Id, ".
			 "DSSTox_Structure_Id, ".
			 "`DSSTox_QC-Level`, ".
			 "Substance_Name, ".
			 "Substance_CASRN, ".
			 "Substance_Type, ".
			 "Substance_Note, ".
			 "Structure_SMILES, ".
			 "Structure_InChI, ".
			 "Structure_InChIKey, ".
			 "Structure_Formula, ".
			 "Structure_MolWt".
			 ")".
			 " VALUES ('".
			 $_POST['DSSTox_Substance_Id']."', '".
			 $_POST['DSSTox_Structure_Id']."', '".
			 $_POST['DSSTox_QC-Level']."', '".
			 $_POST['Substance_Name']."', '".
			 $_POST['Substance_CASRN']."', '".
			 $_POST['Substance_Type']."', '".
			 $_POST['Substance_Note']."', '".
			 $_POST['Structure_SMILES']."', '".
			 $_POST['Structure_InChI']."', '".
			 $_POST['Structure_InChIKey']."', '".
			 $_POST['Structure_Formula']."', '".
			 $_POST['Structure_MolWt'].
			 "')";
			 
			 // PRINT THE QUERY FOR DEBUGGING
			 echo "----------------------------------QUERY-------------------------------------<br/>";
			 echo $query."<br/";
			 echo "----------------------------------------------------------------------------<br/>";
			 
			 // Send the query to the database
			 //if ($mysqli->query($query) === TRUE){
			 if (mysqli_query($mysqli, $query) === TRUE){
				 echo "New record created in Chemicals successfully! <br/>";
			 } else {
				 echo "Error: ".$query."<br>".$mysqli->error;
			 }
			 
			 // Close the connection once finished
			 //$mysqli->close();
			 mysqli_close($mysqli);
}
/*
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
*/
?>