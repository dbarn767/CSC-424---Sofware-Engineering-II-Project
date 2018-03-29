<?php
// I want errors displayed
error_reporting(-1);
ini_set('display_errors', true);
// Let us know if the file is working
echo "Hello! I am a test php file! I should be printing your input below! \n";

// check for submission
// retrieve value from posted data
if ($_POST['submit']){
	// Works but runs together
	/*
	echo "You entered for name: ".$_POST['name'];
	echo "You entered for id: ".$_POST['id'];
	echo "You entered for symbol/formula: ".$_POST['symbol'];
	echo "You entered for item-type: ".$_POST['item-type'];
	*/
	
	// Should print each echo on its own line
	echo "You entered for name: ".$_POST['name']."\n";
	echo "You entered for id: ".$_POST['id']."\n";
	echo "You entered for symbol/formula: ".$_POST['symbol']."\n";
	echo "You entered for item-type: ".$_POST['item-type']."\n";
}

?>