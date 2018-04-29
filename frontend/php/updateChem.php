<?php 
include 'connectivity.php'; // Establish connection ($mysqli)

// check for submission
// retrieve value from posted data
if ($_POST['submit']){
	$fieldKey = $_POST['field-key'];
	$updateValue = $_POST['update-value'];

	// SET default values
	if ($updateValue == "" || $updateValue == " "){
		$updateValue = NULL;
	}
	
	// Create the query
	//$query = "SELECT Substance_Name, Substance_CASRN, Structure_SMILES, Structure_InChI, Structure_Formula, Structure_MolWt FROM Chemicals";
	$query = "UPDATE Chemicals";
	if ($updateValue != NULL){
		switch($fieldKey){
			case 'S-Name':
				$query = $query." SET Substance_Name = ".$updateValue;
				break;
			case 'S-CASRN':
				$query = $query." SET Substance_CASRN = ".$updateValue;
				break;
			case 'S-SMILES':
				$query = $query." SET Structure_SMILES = ".$updateValue;
				break;
			case 'S-InChI':
				$query = $query." SET Structure_InChI = ".$updateValue;
				break;
			case 'S-Formula':
				$query = $query." SET Structure_Formula = ".$updateValue;
				break;
			case 'S-MolWt':
				$query = $query." SET Structure_MolWt = ".$updateValue;
				break;
			default:
				break;
		}
	}

	 // PRINT THE QUERY FOR DEBUGGING
	 echo "----------------------------------QUERY-------------------------------------<br/>";
	 echo $query."<br/";
	 echo "----------------------------------------------------------------------------<br/>";
	 
	 // Send the query to the database
	 if (mysqli_query($mysqli, $query) === TRUE){
		 echo "Updated record in Chemicals successfully! <br/>";
	 } else {
		 echo "Error: ".$query."<br/>".$mysqli->error;
	 }
	 
	 // Close the connection once finished
	 mysqli_close($mysqli);
}

?>
