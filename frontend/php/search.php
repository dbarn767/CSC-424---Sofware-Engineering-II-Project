<?php 
include 'connectivity.php';
// REFERENCE USED: webreference.com/programming/php/search/2.html
// DEBUG OUTPUT
echo "search.php should be running! \n";
// check for submission
// retrieve value from posted data
if ($_POST['submit']){
	// DEBUG: Print our input
	echo "You entered for name: ".$_POST['name']."\n";
	echo "You entered for id: ".$_POST['id']."\n";
	echo "You entered for symbol/formula: ".$_POST['symbol']."\n";
	echo "You entered for item-type: ".$_POST['item-type']."\n";
	
	// Store our data into variables
	$name = $_POST['name'];
	$id = $_POST['id'];
	$symbol = $_POST['symbol'];
	$type = $_POST['item-type'];

	// SET default values
	if ($name == "" || $name == " "){
		$name = NULL;
	}
	if ($id == "" || $id == " "){
		$id = NULL;
	}
	if ($symbol == "" || $symbol == " "){
		$symbol = NULL;
	}
	
	// Create the query
	if ($type == "che"){
		//$query = "SELECT cid, casn, FROM Chemicals WHERE cid LIKE '%".$id."%' OR casn LIKE'%".$name."%'";
		//$query = "SELECT DSSTox_Substance_Id, Substance_Name FROM Chemicals WHERE DSSTox_Substance_Id LIKE '%".$id."%' OR Substance_Name LIKE '%".$name."%'";
		//$query = "SELECT * FROM Chemicals";
		//$query = "SELECT Substance_Name, Substance_CASRN, Structure_SMILES, Structure_InChI, Structure_Formula, Structure_MolWt FROM Chemicals WHERE Substance_Name LIKE '%".$name."%' OR Substance_CASRN LIKE '%".$id."%' OR Structure_SMILES LIKE '%".$symbol."%'";
		//if ($name != NULL || $id != NULL || $symbol != NULL){
			/*
			$query = "SELECT Substance_Name, Substance_CASRN, Structure_SMILES, Structure_InChI, Structure_Formula, Structure_MolWt FROM Chemicals WHERE Substance_Name LIKE '%".$name."%' 
			AND EXISTS ( 
			SELECT Substance_Name, Substance_CASRN, Structure_SMILES, Structure_InChI, Structure_Formula, Structure_MolWt FROM Chemicals WHERE Substance_CASRN LIKE '%".$id."%' 
			) AND EXISTS ( 
			SELECT Substance_Name, Substance_CASRN, Structure_SMILES, Structure_InChI, Structure_Formula, Structure_MolWt FROM Chemicals WHERE Structure_SMILES LIKE '%".$symbol."%')";
			*/

		$query = "SELECT Substance_Name, Substance_CASRN, Structure_SMILES, Structure_InChI, Structure_Formula, Structure_MolWt FROM Chemicals";
		$original = $query;
		$partCounter = 0;
		if ($name != NULL){
			if ($query == $original) {
				$query = "";
			}
			$combiner = "";
			if($partCounter >= 1){
				$combiner = " AND EXISTS (";
			}
			$query = $query . $combiner . "SELECT Substance_Name, Substance_CASRN, Structure_SMILES, Structure_InChI, Structure_Formula, Structure_MolWt FROM Chemicals WHERE Substance_Name LIKE '%".$name."%'";
			//$combineFlag = true;
			$partCounter += 1;
		}
		if ($id != NULL){
			if ($query == $original) {
				$query = "";
			}
			$combiner = "";
			if ($partCounter >= 1){
				$combiner = " AND EXISTS (";
			}

			$query = $query . $combiner . "SELECT Substance_Name, Substance_CASRN, Structure_SMILES, Structure_InChI, Structure_Formula, Structure_MolWt FROM Chemicals WHERE Substance_CASRN LIKE '%".$id."%'";
			$partCounter += 1;
		}
		if ($symbol != NULL){
			if ($query == $original) {
				$query = "";
			}
			$combiner = "";
			if ($partCounter >= 1){
				$combiner = " AND EXISTS (";
			}

			$query = $query . $combiner . "SELECT Substance_Name, Substance_CASRN, Structure_SMILES, Structure_InChI, Structure_Formula, Structure_MolWt FROM Chemicals WHERE Structure_SMILES LIKE '%".$symbol."%'";
			$partCounter += 1;
		}
		while ($partCounter - 1 > 0){
			$query = $query . ")";
			$partCounter -= 1;
		}
		
		echo "\n----------------------------------------\n";
		echo $query;
		echo  "\n----------------------------------------\n";
	}
	elseif ($type == "tox"){
		$query = "SELECT * FROM Toxicity";
	}
	elseif ($type == "tar"){
		//$query = "SELECT * FROM Target";
		//$query = "SELECT target_id FROM Target WHERE target_id LIKE '%".$id."%'";
		$query = "SELECT target_id, intended_target_official_full_name, intended_target_gene_name, intended_target_official_symbol, intended_target_gene_symbol, technological_target_official_full_name, technological_target_gene_name, technological_target_official_symbol, technological_target_gene_symbol FROM Target WHERE target_id LIKE '%".$id."%' OR intended_target_official_full_name LIKE '%".$name."%'";
	}
	elseif ($type == "asy"){
		//$query = "SELECT aeid FROM Assay WHERE aeid LIKE '%".$id."%'";
		$query = "SELECT * FROM Assay";
	}
	elseif ($type == "cit"){
		//$query = "SELECT citation_id FROM Citation WHERE citation_id LIKE '%".$id."%'";
		$query = "SELECT * FROM Citation";
	}
	elseif ($type == "pub"){
		$query = "SELECT * FROM Published";
	}
	elseif ($type == "tes"){
		$query = "SELECT * FROM Tested";
	}
	else{
		echo "ERROR: No table specified! \n";
	}

	// DEBUG
	echo "DEBUG: query to use was determined to be ".$query."!";
	echo "DEBUG: Checking our connection!";
	
	if (!$mysqli)
	//if (!$conn)
	{
		echo "ERROR:No connection before getting result in search.php!";
	}
	
	if (mysqli_ping($mysqli)){
	//if (mysqli_ping($conn)){
		echo "Our connection is ok!\n";
	} else {
		echo "ERROR: connection is NOT ok!\n";
		echo "ERROR MESSAGE: ".mysqli_error($mysqli);
		//echo "ERROR MESSAGE: ".mysqli_error($conn);
	}

	echo "DEBUG: About to get result!";
	// Get a result
	//$result = mysql_query($query);
	//$result = mysqli_query($mysqli, $query); // Continues on
	$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli)); // Sudden stop in code... why?
	//$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

	$numOfRows=mysqli_num_rows($result);
	//if ($result->num_rows === 0)
	if ($numOfRows == 0)
	{
		echo "--NO RESULTS FOUND!--";
	}
	else
	{
		echo "Result returned ".$numOfRows." number of rows!";
	}

	// DEBUG
	echo "DEBUG: About to try to print result based on type!";
	
	// Create while loop and loop through result set
	if ($type == "che"){
		while ($row=mysqli_fetch_array($result)){
			
			$Substance_Name=$row['Substance_Name'];
			$Substance_CASRN=$row['Substance_CASRN'];
			$Structure_SMILES=$row['Structure_SMILES'];
			$Structure_InChI=$row['Structure_InChI'];
			$Structure_Formula=$row['Structure_Formula'];
			$Structure_MolWt=$row['Structure_MolWt'];
			
			echo "<ul>\n";
			echo "<li>".$Substance_Name." ".$Substance_CASRN." ".$Structure_SMILES." ".$Structure_InChI." ".$Structure_Formula." ".$Structure_MolWt."</li>\n";
			echo "</ul>";
		}
	}
	elseif ($type == "tar"){
		while ($row=mysqli_fetch_array($result)){
			$intended_target_official_full_name=$row['intended_target_official_full_name'];
			$intended_target_gene_name=$row['intended_target_gene_name'];
			$intended_target_official_symbol=$row['intended_target_official_symbol'];
			$intended_target_gene_symbol=$row['intended_target_gene_symbol'];
			$technological_target_official_full_name=$row['technological_target_official_full_name'];
			$technological_target_gene_name=$row['technological_target_gene_name'];
			$technological_target_official_symbol=$row['technological_target_official_symbol'];
			$technological_target_gene_symbol=$row['technological_target_gene_symbol'];

			echo "<ul>\n";
			echo "<li>".$intended_target_official_full_name." | ".$intended_target_gene_name." | ".$intended_target_official_symbol." | ".$intended_target_gene_symbol." | ".$technological_target_official_full_name." | ".$technological_target_gene_name." | ".$technological_target_official_symbol." | ".$technological_target_gene_symbol."</li>\n";
			echo "</ul>";
		}
	}
	elseif ($type == "tox"){
		while($row=mysqli_fetch_array($result)){
			$SDDTox_Substance_Id=$row['SDDTox_Substance_Id'];
			$aeid=$row['aeid'];
			
			echo "<ul>\n";
			echo "<li>".$SDDTox_Substance_Id." ".$aeid."</li>\n";
			echo "</ul>";
		}
	}
	//elseif ($type == "exp" or $type == "asy"){
	elseif ($type == "asy"){
		//DEBUG
		echo "DEBUG: About to start while loop for Assay!";
		//while($row=mysql_fetch_array($result)){
		while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
			echo "DEBUG: Inside while loop for Assay!";
			$aid=$row['aid'];
			$acid=$row['acid'];
			$aeid=$row['aeid'];
			$asid=$row['asid'];
			$assay_source_name=$row['assay_source_name'];
			$assay_source_long_name=$row['assay_source_long_name'];
			$assay_source_desc=$row['assay_source_desc'];
			$assay_name=$row['assay_name'];
			$assay_desc=$row['assay_desc'];
			$timepoint_hr=$row['timepoint_hr'];
			$organism_id=$row['organism_id'];
			$organism=$row['organism'];
			$tissue=$row['tissue'];
			$cell_format=$row['cell_format'];
			$cell_free_component_source=$row['cell_free_component_source'];
			$cell_short_name=$row['cell_short_name'];
			$cell_growth_mode=$row['cell_growth_mode'];
			$assay_footprINT=$row['assay_footprINT'];
			$assay_format_type=$row['assay_format_type'];
			$assay_format_type_sub=$row['assay_format_type_sub'];
			$content_readout_type=$row['content_readout_type'];
			$dilution_solvent=$row['dilution_solvent'];
			$dilution_solvent_percent_max=$row['dilution_solvent_percent_max'];
			$assay_component_name=$row['assay_component_name'];
			$assay_component_desc=$row['assay_component_desc'];
			$assay_component_target_desc=$row['assay_component_target_desc'];
			$parameter_readout_type=$row['parameter_readout_type'];
			$assay_design_type=$row['assay_design_type'];
			$assay_design_type_sub=$row['assay_design_type_sub'];
			$biological_process_target=$row['biological_process_target'];
			$detection_technology_type=$row['detection_technology_type'];
			$detection_technology_type_sub=$row['detection_technology_type_sub'];
			$detection_technology=$row['detection_technology'];
			$signal_direction_type=$row['signal_direction_type'];
			$key_assay_reagent_type=$row['key_assay_reagent_type'];
			$key_assay_reagent=$row['key_assay_reagent'];
			$technological_target_type=$row['technological_target_type'];
			$technological_target_type_sub=$row['technological_target_type_sub'];
			$assay_component_endpoINT_name=$row['assay_component_endpoINT_name'];
			$export_ready=$row['export_ready'];
			$internal_ready=$row['internal_ready'];
			$assay_component_endpoINT_desc=$row['assay_component_endpoINT_desc'];
			$assay_function_type=$row['assay_function_type'];
			$normalized_data_type=$row['normalized_data_type'];
			$analysis_direction=$row['analysis_direction'];
			$burst_assay=$row['burst_assay'];
			$key_positive_control=$row['key_positive_control'];
			$signal_direction=$row['signal_direction'];
			$intended_target_type=$row['intended_target_type'];
			$intended_target_type_sub=$row['intended_target_type_sub'];
			$intended_target_family=$row['intended_target_family'];
			$intended_target_family_sub=$row['intended_target_family_sub'];
			$fit_all=$row['fit-all'];
			$reagent_arid=$row['reagent-arid'];
			$reagent_reagent_name_value=$row['reagent_reagent_name_value'];
			$reagent_reagent_name_value_type=$row['reagent_reagent_name_value_type'];
			$reagent_culture_or_assay=$row['reagent_culture_or_assay'];
			
			// DEBUGGING
			echo "DEBUG: ABOUT TO PRINT ASSAY TABLE!";
			echo "'%".$aid."%'";
			echo "".$aid." ".$acid." ".$aeid." ".$asid." ".$assay_source_name." ".$assay_source_long_name." ".$assay_source_desc." ".$assay_name." ".$assay_desc." ".$timepoint_hr." ".$organism_id." ".$organism." ".$tissue." ".$cell_format." ".$cell_free_component_source." ".$cell_short_name." ".$cell_growth_mode." ".$assay_footprINT." ".$assay_format_type." ".$assay_format_type_sub." ".$content_readout_type." ".$dilution_solvent." ".$dilution_solvent_percent_max." ".$assay_component_name." ".$assay_component_desc." ".$assay_component_target_desc." ".$parameter_readout_type." ".$assay_design_type." ".$assay_design_type_sub." ".$biological_process_target." ".$detection_technology_type." ".$detection_technology_type_sub." ".$detection_technology." ".$signal_direction_type." ".$key_assay_reagent_type." ".$key_assay_reagent." ".$technological_target_type." ".$technological_target_type_sub." ".$assay_component_endpoINT_name." ".$export_ready." ".$internal_ready." ".$assay_component_endpoINT_desc." ".$assay_function_type." ".$normalized_data_type." ".$analysis_direction." ".$burst_assay." ".$key_positive_control." ".$signal_direction." ".$intended_target_type." ".$intended_target_type_sub." ".$intended_target_family." ".$intended_target_family_sub." ".$fit_all." ".$reagent_arid." ".$reagent_reagent_name_value." ".$reagent_reagent_name_value_type." ".$reagent_culture_or_assay."</li>\n";
			

			echo "<ul>\n";
			echo "<li>".$aid." ".$acid." ".$aeid." ".$asid." ".$assay_source_name." ".$assay_source_long_name." ".$assay_source_desc." ".$assay_name." ".$assay_desc." ".$timepoint_hr." ".$organism_id." ".$organism." ".$tissue." ".$cell_format." ".$cell_free_component_source." ".$cell_short_name." ".$cell_growth_mode." ".$assay_footprINT." ".$assay_format_type." ".$assay_format_type_sub." ".$content_readout_type." ".$dilution_solvent." ".$dilution_solvent_percent_max." ".$assay_component_name." ".$assay_component_desc." ".$assay_component_target_desc." ".$parameter_readout_type." ".$assay_design_type." ".$assay_design_type_sub." ".$biological_process_target." ".$detection_technology_type." ".$detection_technology_type_sub." ".$detection_technology." ".$signal_direction_type." ".$key_assay_reagent_type." ".$key_assay_reagent." ".$technological_target_type." ".$technological_target_type_sub." ".$assay_component_endpoINT_name." ".$export_ready." ".$internal_ready." ".$assay_component_endpoINT_desc." ".$assay_function_type." ".$normalized_data_type." ".$analysis_direction." ".$burst_assay." ".$key_positive_control." ".$signal_direction." ".$intended_target_type." ".$intended_target_type_sub." ".$intended_target_family." ".$intended_target_family_sub." ".$fit_all." ".$reagent_arid." ".$reagent_reagent_name_value." ".$reagent_reagent_name_value_type." ".$reagent_culture_or_assay."</li>\n";
			echo "</ul>";
		}
	}
	elseif ($type == "cit"){
		while($row=mysqli_fetch_array($result)){
			$citation_id=$row['citation_id'];
			$pmid=$row['pmid'];
			$doi=$row['doi'];
			$other_source=$row['other_source'];
			$other_id=$row['other_id'];
			$citation=$row['citation'];
			$title=$row['title'];
			$author=$row['author'];
			$url=$row['url'];
			
			echo "<ul>\n";
			echo "<li>".$citation_id." ".$pmid." ".$doi." ".$other_source." ".$other_id." ".$citation." ".$title." ".$author." ".$url."</li>\n";
			echo "</ul>";
		}
	}
	elseif ($type == "pub"){
		while($row=mysqli_fetch_array($result)){
			$aeid=$row['aeid'];
			$citation_id=$row['citation_id'];
			$pmid=$row['pmid'];
			
			echo "<ul>\n";
			echo "<li>".$aeid." ".$citation_id." ".$pmid."</li>\n";
			echo "</ul>";
		}
	}
	elseif ($type == "tes"){
		while($row=mysqli_fetch_array($result)){
			$aeid=$row['aeid'];
			$target_id=$row['target_id'];
			$DSSTox_Substance_Id=$row['DSSTox_Substance_Id'];
			
			echo "<ul>\n";
			echo "<li>".$aeid." ".$target_id." ".$DSSTox_Substance_Id."</li>\n";
			echo "</ul>";
		}
	}
	
}

echo "DEBUG: Ending search.php";
mysqli_close($mysqli);
//mysqli_close($conn);
?>
