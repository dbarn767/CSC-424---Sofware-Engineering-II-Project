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
			$Substance_Name=$row['Substance_Name'];
			
			echo "<ul>\n";
			echo "<li>".$DSSTox_Substance_Id." ".$Substance_Name."</li>\n";
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