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
	//$query;
	
	// Create the query
	if ($type == "che"){
		//$query = "SELECT cid, casn, FROM Chemicals WHERE cid LIKE '%".$id."%' OR casn LIKE'%".$name."%'";
		$query = "SELECT DSSTox_Substance_Id, Substance_Name FROM Chemicals WHERE DSSTox_Substance_Id LIKE '%".$id."%' OR Substance_Name LIKE '%".$name."%'";
	}
	elseif ($type == "tox"){
		$query = "SELECT * FROM Toxicity";
	}
	elseif ($type == "tar"){
		$query = "SELECT target_id FROM Target WHERE target_id LIKE '%".$id."%'";
	}
	elseif ($type == "exp" or $type == "asy"){
		//$query = "SELECT aeid FROM Experiments WHERE aeid LIKE '%".$id."%'";
		$query = "SELECT aeid FROM Assay WHERE aeid LIKE '%".$id."%'";
	}
	//elseif ($_POST['item-type'] == "asy"){
	//	$query = "
	//}
	elseif ($type == "cit"){
		$query = "SELECT citation_id FROM Citation WHERE citation_id LIKE '%".$id."%'";
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
	
	// Get a result
	$result = mysql_query($query);
	
	// Create while loop and loop through result set
	if ($type == "che"){
		while ($row=mysql_fetch_array($result)){
			/*
			$cid=$row['cid'];
			$casn=$row['casn'];
			
			echo "<ul>\n";
			echo "<li>".$cid." ".$casn."</li>\n
			*/
			
			$DSSTox_Substance_Id=$row['DSSTox_Substance_Id'];
			$DSSTox_Structure_Id=$row['DSSTox_Structure_Id'];
			$DSSTox_QC=$row['DSSTox_QC'];
			$Substance_Name=$row['Substance_Name'];
			$Substance_CASRN=$row['Substance_CASRN'];
			$Substance_Type=$row['Substance_Type'];
			$Substance_Note=$row['Substance_Note'];
			$Structure_SMILES=$row['Structure_SMILES'];
			$Structure_InChI=$row['Structure_InChI'];
			$Structure_InChIKey=$row['Structure_InChIKey'];
			$Structure_Formula=$row['Structure_Formula'];
			$Structure_MolWt=$row['Structure_MolWt'];
			
			echo "<ul>\n";
			echo "<li>".$DSSTox_Substance_Id." ".$DSSTox_Structure_Id." ".$DSSTox_QC." ".$Substance_Name." ".$Substance_CASRN." ".$Substance_Type." ".$Substance_Note." ".$Structure_SMILES." ".$Structure_InChI." ".$Structure_InChIKey." ".$Structure_Formula." ".$Structure_MolWt."</li>\n";
			echo "</ul>";
		}
	}
	elseif ($type == "tar"){
		while ($row=mysql_fetch_array($result)){
			$target_id=$row['target_id'];
			$intended_target_gene_id=$row['intended_target_gene_id'];
			$intended_target_entrez_gene_id=$row['intended_target_entrez_gene_id'];
			$intended_target_official_full_name=$row['intended_target_official_full_name'];
			$intended_target_gene_name=$row['intended_target_gene_name'];
			$intended_target_official_symbol=$row['intended_target_official_symbol'];
			$intended_target_gene_symbol=$row['intended_target_gene_symbol'];
			$intended_target_description=$row['intended_target_description'];
			$intended_target_uniprot_accession_number=$row['intended_target_uniprot_accession_number'];
			$intended_target_organism_id=$row['intended_target_organism_id'];
			$intended_target_track_status=$row['intended_target_track_status'];
			$technological_target_gene_id=$row['technological_target_gene_id'];
			$technological_target_entrez_gene_id=$row['technological_target_entrez_gene_id'];
			$technological_target_official_full_name=$row['technological_target_official_full_name'];
			$technological_target_gene_name=$row['technological_target_gene_name'];
			$technological_target_official_symbol=$row['technological_target_official_symbol'];
			$technological_target_gene_symbol=$row['technological_target_gene_symbol'];
			$technological_target_description=$row['technological_target_description'];
			$technological_target_uniprot_accession_number=$row['technological_target_uniprot_accession_number'];
			$technological_target_organism_id=$row['technological_target_organism_id'];
			$technological_target_track_status=$row['technological_target_track_status'];
			
			echo "<ul>\n";
			echo "<li>".$target_id." ".$intended_target_gene_id." ".$intended_target_entrez_gene_id." ".$intended_target_official_full_name." ".$intended_target_gene_name." ".$intended_target_official_symbol." ".$intended_target_gene_symbol." ".$intended_target_description." ".$intended_target_uniprot_accession_number." ".$intended_target_organism_id." ".$intended_target_track_status." ".$technological_target_gene_id." ".$technological_target_entrez_gene_id." ".$technological_target_official_full_name." ".$technological_target_gene_name." ".$technological_target_official_symbol." ".$technological_target_gene_symbol." ".$technological_target_description." ".$technological_target_uniprot_accession_number." ".$technological_target_organism_id." ".$technological_target_track_status."</li>\n";
			echo "</ul>";
		}
	}
	elseif ($type == "tox"){
		while($row=mysql_fetch_array($result)){
			$SDDTox_Substance_Id=$row['SDDTox_Substance_Id'];
			$aeid=$row['aeid'];
			
			echo "<ul>\n";
			echo "<li>".$SDDTox_Substance_Id." ".$aeid."</li>\n";
			echo "</ul>";
		}
	}
	elseif ($type == "exp" or $type == "asy"){
		while($row=mysql_fetch_array($result)){
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
			
			echo "<ul>\n";
			echo "<li>".$aid." ".$acid." ".$aeid." ".$asid." ".$assay_source_name." ".$assay_source_long_name." ".$assay_source_desc." ".$assay_name." ".$assay_desc." ".$timepoint_hr." ".$organism_id." ".$organism." ".$tissue." ".$cell_format." ".$cell_free_component_source." ".$cell_short_name." ".$cell_growth_mode." ".$assay_footprINT." ".$assay_format_type." ".$assay_format_type_sub." ".$content_readout_type." ".$dilution_solvent." ".$dilution_solvent_percent_max." ".$assay_component_name." ".$assay_component_desc." ".$assay_component_target_desc." ".$parameter_readout_type." ".$assay_design_type." ".$assay_design_type_sub." ".$biological_process_target." ".$detection_technology_type." ".$detection_technology_type_sub." ".$detection_technology." ".$signal_direction_type." ".$key_assay_reagent_type." ".$key_assay_reagent." ".$technological_target_type." ".$technological_target_type_sub." ".$assay_component_endpoINT_name." ".$export_ready." ".$internal_ready." ".$assay_component_endpoINT_desc." ".$assay_function_type." ".$normalized_data_type." ".$analysis_direction." ".$burst_assay." ".$key_positive_control." ".$signal_direction." ".$intended_target_type." ".$intended_target_type_sub." ".$intended_target_family." ".$intended_target_family_sub." ".$fit_all." ".$reagent_arid." ".$reagent_reagent_name_value." ".$reagent_reagent_name_value_type." ".$reagent_culture_or_assay."</li>\n";
			echo "</ul>";
		}
	}
	elseif ($type == "cit"){
		while($row=mysql_fetch_array($result)){
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
		while($row=mysql_fetch_array($result)){
			$aeid=$row['aeid'];
			$citation_id=$row['citation_id'];
			$pmid=$row['pmid'];
			
			echo "<ul>\n";
			echo "<li>".$aeid." ".$citation_id." ".$pmid."</li>\n";
			echo "</ul>";
		}
	}
	elseif ($type == "tes"){
		while($row=mysql_fetch_array($result)){
			$aeid=$row['aeid'];
			$target_id=$row['target_id'];
			$DSSTox_Substance_Id=$row['DSSTox_Substance_Id'];
			
			echo "<ul>\n";
			echo "<li>".$aeid." ".$target_id." ".$DSSTox_Substance_Id."</li>\n";
			echo "</ul>";
		}
	}
	
}

/* 
	//Search Query
	$query = "(SELECTED cid, casn as type FROM chemicals WHERE content LIKE '%" . $keyword . "%' OR title LIKE '%" . $keyword . "%')
		UNION
		(SELECTED aeid as type FROM experiments WHERE content LIKE '%" . $keyword . "%' OR title LIKE '%" . $keyword . "%')
		UNION
		(SELECTED * as type FROM toxicity WHERE content LIKE '%" . $keyword . "%' OR title LIKE '%" . $keyword . "%')
		UNION
		(SELECTED * as type FROM tested WHERE content LIKE '%" . $keyword . "%' OR title LIKE '%" . $keyword . "%')
		UNION
		(SELECTED * as type FROM published WHERE content LIKE '%" . $keyword . "%' OR title LIKE '%" . $keyword . "%')
		UNION
		(SELECTED citation_id as type FROM citations WHERE content LIKE '%" . $keyword . "%' OR title LIKE '%" . $keyword . "%')
		UNION
		(SELECTED target_id as type FROM targets WHERE content LIKE '%" . $keyword . "%' OR title LIKE '%" . $keyword . "%')";


	$result = mysqli_query($conn, $query);

	if(mysqli_num_rows($result) > 0){
		// output data of each row
		while($row = mysqli_fetch_assoc($result)){
			echo $result
		}
	}
*/

?>