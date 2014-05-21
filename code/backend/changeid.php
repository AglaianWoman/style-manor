<?php
include("protected/dbconnect_auto.php");
	//select database
	mysql_select_db("thesty10_auto-manipulate");
	$query = "UPDATE shop_test2 SET collection_id=4 WHERE collection_name=\"inspire me\"";
	if(!mysql_query($query))
	{
		echo mysql_error();
	}
	else {
		echo "update successful";
	}

?>