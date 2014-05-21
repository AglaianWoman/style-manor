<?php
//include("DB.php");

	
	

	$dsn = 'mysql:host=localhost;dbname=style_manor';
    $username = 'root';
    $password = 'pauldbz';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
		print_r($error_message);
		exit;
		}

?>
