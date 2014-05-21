<?php session_start(); 
error_reporting (E_ALL ^ E_NOTICE); 
include_once("shared variables.php");
include("db_connect/db_connect.php");
//mysql_select_db("style_manor");
$id = 1;
//get the id for the collection
if(isset($_GET['id'])){$id=$_GET['id'];}
else if(isset($_POST['id'])){$id=$_POST['id'];}
else {$id=1;}

$collection_names = array("breakfast at tiffany's", "simplicity", "ostrich", "inspire me");
if(isset($_GET['action']))
{$action=$_GET['action'];}
else if(isset($_GET['link'])){$action='link';}
else{$action='';}
/*
switch($action) {
	case 'link':
		$link=$_GET['link'];
		$query=mysql_query("SELECT item_name FROM shop_test2 WHERE link='".$link."'");
		
		$item_name=mysql_fetch_assoc($query);
		$item=$item_name['item_name'];
		include("page_view/cart_item_view.php");
		break;
	case 'cart':
		$link='cart';
		$item='Cart';
		include("page_view/cart_item_view.php");
		break;
			
	default:*/
	//$collection_name=mysql_fetch_assoc(mysql_query("SELECT * FROM collections where id=".$id.""));
	
	$query = "SELECT * from collection WHERE id = $id";
	$id_row = $db->prepare($query);
	$id_row->execute();
	$collection = $id_row->fetch();
	//echo "this is the collection name " . $collection['collection_name'];
	
	if($collection == false)
	{
		$message = "no such collection exists or we have run out of items for that collection. Please try again";
		echo $message;
		//include("page_view/cart_item_view.php");
		exit;
	}
	

	
	

	//$collection=addslashes($collection_name['collection_name']);
	//$collection='shop_test2';
		
		include("shop_view.php");
	//	break;
//}
$db = null;
//mysql_close($connection);
?>

