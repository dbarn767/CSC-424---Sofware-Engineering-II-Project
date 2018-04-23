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
	$query = "SELECT target_id, intended_target_official_full_name, intended_target_gene_name, intended_target_official_symbol, intended_target_gene_symbol, technological_target_official_full_name, technological_target_gene_name, technological_target_official_symbol, technological_target_gene_symbol FROM Target";
	if ($searchItem != NULL){
		switch($searchKey){
			case 'T-Name':
				$query = $query." WHERE intended_target_official_full_name LIKE '%".$searchItem."%'";
				break;
			case 'T-ID':
				$query = $query." WHERE target_id LIKE '%".$searchItem."%'";
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
