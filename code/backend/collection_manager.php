<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
     "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
	 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>collection manager</title>
	<style type="text/css">
	.container{margin:20px 0 0 100px}
	table{
	border-style:solid;
	}
	#collection_list, .insert{border-collapse:collapse}
	#collection_list th,#collection_list td, .insert th, .insert td{border: 1px solid black;}
	
	</style>

	
</head>

<?php

include("../shared variables.php");


//to check if a person is not an administrator
$is_not_admin = true;

for ($i = 0; $i <= count($admin_emails)-1; $i++) {
	
	if ($_SESSION["email"] == $admin_emails[$i]) {
		$is_not_admin = false;	
		break;
	}
}
//if person logged in is not an administrator redirect  them to the home page
if ($is_not_admin) { 
	echo "<body onload=\"document.location.href = '../home.php';\">
	</body>
	</html>
	";
	exit;
}

	include("../protected/dbconnect_auto.php");
	//select database
	mysql_select_db("thesty10_auto-manipulate");
	
	if (isset($_POST["addCollection"])) {
		extract($_POST);
		$errorMessage = "";
		if ($collectionNameVal == "") {
			$errorMessage = "need to supply a name for the new collection"; 
		}
		else {
			
			$addCollection = "INSERT INTO collections (collection_name, active) VALUES ('".$collectionNameVal."', '$activeVal')";
			if (!mysql_query($addCollection)) {
				$errorMessage = mysql_error();
			}
			else {
				$errorMessage = "collection successfully inserted into table.";
			}
		}
	}
	$collections = mysql_query("SELECT * FROM collections ORDER BY id");
	echo "
	<body>
		<iframe frameborder=\"0\" scrolling=\"no\" src=\"backend_header.php\" width=\"100%\" height=\"$backend_header_height"."px\"></iframe>
		
			<div class='container'>
				<div>
					
					<b>* required field</b>
					
					<h1>insert new collection</h1>
					<span>$errorMessage</span>
					
					<form method='post' action='collection_manager.php'>
						<table class='insert'>
							<tr>
								<th><b>collection name*</b></th>
								<th><b>active*</b></th>
							</tr>
							<tr>
								<td><input type='text' name='collectionNameVal' value='' /></td>
								<td>
									<select name='activeVal'>
										<option value='yes'>yes</option>
										<option value='no'>no</option>
									</select>
								</td>
							</tr>
						</table>
						<input type='submit' value='add collection' name='addCollection' />
					</form>
				</div>
				
				<div>
					<h1>collections list:</h1>
					<table id='collection_list'>
						<tr>
							<th><b>collection name</b></th>
							<th><b>active</b></th>
							<th>ID</th>
							<th>
						</tr></th>
					";
					while ($row = mysql_fetch_assoc($collections)) {
						echo "
						<tr>
							<td>" . $row['collection_name'] . "</td>
							<td>" . $row['active'] . "</td>
							<td>" . $row['id'] . "</td>
							<td>
								<form method='post' action='collection_editor.php'>
								<input type='hidden' name='collectionId' value='" . $row['id'] . "'>
								<input type='submit' value='EDIT' />
								</form>
							</td>
						</tr>
						";
					}
					echo "
					</table>
				</div>
			</div>
	";
?>
	</body>
</html>