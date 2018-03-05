<?php  

	$servername = "localhost";
	$dbname = "myDB";


	//Create connection
	$conn = mysqli_connect($servername, $dbname)
	//Check connection
	if(!$conn) {
		die("connection failed: " . mysqli_connect_error());
	}

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


?>