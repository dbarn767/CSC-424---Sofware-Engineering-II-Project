<?php 
include 'connectivity.php'; // Establish connection ($mysqli)

// check for submission
// retrieve value from posted data
if ($_POST['submit']){
	$searchKey = $_POST['search-key'];
	$searchItem = $_POST['search-item'];

	// SET default values
	if ($searchItem == "" || $searchItem == " "){
		$searchItem = NULL;
	}
	
	// Create the query
	$query = "SELECT Substance_Name, Substance_CASRN, Structure_SMILES, Structure_InChI, Structure_Formula, Structure_MolWt FROM Chemicals";
	if ($searchItem != NULL){
		switch($searchKey){
			case 'S-Name':
				$query = $query." WHERE Substance_Name LIKE '%".$searchItem."%'";
				break;
			case 'S-CASRN':
				$query = $query." WHERE Substance_CASRN LIKE '%".$searchItem."%'";
				break;
			case 'S-SMILES':
				$query = $query." WHERE Structure_SMILES LIKE '%".$searchItem."%'";
				break;
			default:
				break;
		}
	}

	// DEBUG
	echo "--------------------------- QUERY ------------------------------<br/>";
	echo $query."<br/>";
	echo "--------------------------- QUERY ------------------------------<br/>";
	
	if (mysqli_ping($mysqli)){
		echo "Our connection is ok! <br/>";
	} else {
		echo "ERROR MESSAGE: ".mysqli_error($mysqli)."<br/>";
	}

	// Get a result
	$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
	
	// Create while loop and loop through result set
	while ($row=mysqli_fetch_array($result, MYSQLI_NUM)){
		echo "<ul>";
		echo "<li>";
		for ($i = 0; $i < count($row); $i++){
			echo " | ".$row[$i]." | ";
		}
		echo "</li>";
		echo "</ul>";
	}
	
	mysqli_close($mysqli);
}

?>
