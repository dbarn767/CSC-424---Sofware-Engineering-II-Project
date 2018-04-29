<?php
include 'connectivity.php'; // Establishes connection ($mysqli)

if ($_POST['submit']){
	$query = "DELETE FROM Chemicals WHERE Substance_CASRN LIKE '%".$_POST['Substance_CASRN']."%'";
			 
			 // PRINT THE QUERY FOR DEBUGGING
			 echo "----------------------------------QUERY-------------------------------------<br/>";
			 echo $query."<br/";
			 echo "----------------------------------------------------------------------------<br/>";
			 
			 // Send the query to the database
			 if (mysqli_query($mysqli, $query) === TRUE){
				 echo "Record deleted from Chemicals successfully! <br/>";
			 } else {
				 echo "Error: ".$query."<br/>".$mysqli->error;
			 }
			 
			 // Close the connection once finished
			 mysqli_close($mysqli);
}
?>