<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title><?php if($id >= 1) echo ucwords($collection_names[$id-1]);?></title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<script type="text/javascript" src="jquery.easing.1.3.js"></script>

<script type="text/javascript" src='dropdown.js'></script>
	
<link href="CSS_main.php" rel="stylesheet" media="screen" />
<style type="text/css">
table{border-collapse: collapse}
td{text-align:center;vertical-align:top;margin:0px;padding:0px;float:none;border-style:none}
img{margin:0px;padding:0px border-style:none}
a .item_link{text-decoration:none; font-size:11pt;color:black}
a img{border:none}
/*a:hover{color:pink}
.main_pic{margin:0 auto;padding:0px;position:relative}*/
.main_pic{float:left}
.name_link{width:100%}
.name_link a:hover span{width:100%;text-decoration:none;color:<?php echo $color_dark_pink;?>}
.cart a{background-color:black; color:white}
.cart a:hover{color:<?php echo $color_dark_pink;?>}
.price{font-size:11pt}
</style>
<!--
<script type="text/javascript">
function get_collection(){
	var selectid=document.getElementById("collection_list");
	var selected_option=selectid.options[selectid.selectedIndex].value;
	
	//document.write(escaped);
	document.location.href="shop_collection.php?id="+selected_option;
}
</script>-->
</head>

<?php

//echo $test . "faggot";
/*
if($_SESSION["email"]=="" || $_SESSION["email"]==-1){$member=false;}
else {$member=true;}
if(isset($_GET['page'])){$page=$_GET['page'];}
else {$page=1;} 

$now=time();

//query to get items that are not active
$check_activation=mysql_query("SELECT * FROM shop_test2 WHERE active='no' AND start_time IS NOT NULL AND collection_name='".$collection."'");

//to check expiration dates
while($row=mysql_fetch_assoc($check_activation)){
	if($row['start_time']!=''&&$row['start_time']!=0){
		if($row['start_time'] <= $now){
			mysql_query("UPDATE shop_test2 SET active='yes', start_time=NULL WHERE item_name='".$row['item_name']."' AND collection_name='".$collection."'");
		}
	}
}
		
//query to check the expiration for an item
$check_expiration=mysql_query("SELECT * FROM shop_test2 WHERE active='yes' AND expire_date IS NOT NULL AND collection_name='".$collection."'");

//to check the expiration of an item
while($row=mysql_fetch_assoc($check_expiration)){
	//need the column for expiration date to not be empty
	if($row['expire_date']!=''&&$row['expire_date']!=0){
		//if the current time is greater than expiration date, then we no longer need the picture/item
		if($row['expire_date']<$now){
			mysql_query("UPDATE shop_test2 SET active='no' WHERE item_name='".$row['item_name']."' AND collection_name='".$collection."'");
		}
	}
}

/*query to get the items from the table
$count_rows=mysql_query("SELECT * FROM shop_test2 WHERE active='yes' AND collection_name='".$collection."' ORDER BY order_number");
$num_rows=mysql_num_rows($count_rows);
*/
$item_query = "SELECT * FROM ".$collection['collection_name']." where active='yes' ORDER BY order_num";
$item = $db->prepare($item_query);
$item->execute();
$items = $item->fetchAll();

//$number_of_pages=ceil($num_rows/10);
/*
$query=mysql_query("SELECT * FROM shop_test2 WHERE active='yes' AND collection_name='".$collection."' ORDER BY order_number LIMIT ".(($page-1)*10).", 10");

$query=mysql_query("SELECT * FROM shop_test2 WHERE active='yes' AND collection_name='".$collection."' ORDER BY order_number");
//query that gets the main picture stored in a different table
$query_main=mysql_query("SELECT * FROM main_shop_pic WHERE active='yes' AND collection_name='".$collection."'");

//gets the row for the main picture
$mainpic=mysql_fetch_assoc($query_main);
*/
//to get the directory for the main picture
$main_pic_query = "SELECT * FROM main_image_collection WHERE collection_id = $id";
$mp = $db->prepare($main_pic_query);
$mp->execute();
$mainpic = $mp->fetch();

//$main_pic_directory=$mainpic['directory'];

//dimensions for the cells. there should be 4 cells in each row
$td_width=$main_home_width/4;
$td_height=$main_home_width/4;


//this will be used to measure the width of the table to check how many items are there 
$total_cells=0;
//to scale the height of the main picture
if ($mainpic !== false) {
	list($main_width, $main_height, $image_type, $image_attr) = getimagesize($mainpic[image_path]);
	$main_pic_height=$td_width*2*$main_height/$main_width;
}
//used later to check if we are in the first row
$first_row=true;
//$collection_query=mysql_query("SELECT * FROM collections");
echo "
<body>

	<div class='outer_container' style=\"width: ".($main_home_width + $header_hr_overflow*2)."px; margin: 0 auto;margin-top:5px\">
	";
	
	include_once('header.php');
	echo "
		<div style='width: 100%; height:".($v_buffer1+30)."px'></div>

		<!--<iframe name=\"Header\" frameborder=\"0\" scrolling=\"no\" src=\"header2.php\" width=\"100%\" height=\"$header2_height"."px\"></iframe>
	    -->
		<div class='contents' style=\"width: $main_home_width"."px; margin: 0 auto\">
			<div style='width:100%'>
				
		";
	
			echo "
				<!--
					<span class='cart' style='float:left'><a href='?action=cart'><img src='images/cart.png' /></a></span>
			-->
		</div>
		
			<!--<div style='width:100%;'></div>-->
		
			<!--this table will contain all the items and main pictures-->
			<table style='margin:0 auto;margin-top:0px;padding:0px;width:$main_home_width"."px' cellspacing='0' cellpadding='0'>
				<tr>
				";
				
				if ($mainpic !== false && file_exists($mainpic[image_path]) !== false) {
					echo "
					<!--this contains the main picture, which is going to span two table cells-->
						<td colspan='2' style='width:".($td_width*2)."px'>
						
							<div class='main_pic'>
								<img src='".$mainpic[image_path]."' width='".($td_width*2)."px' height='".($main_pic_height)."px' />
							</div><!--ends div with class=main_pic-->
						</td>
					";
					$total_cells+=2;
				}
			//this gets all the rows of the items that are active
foreach($items as $row){

	
	//for the height and width of the picture
	$pic_height=0;
	$pic_width=0;
	//gets the directory/path for the picture
	$picdir=$row[image_path];
	//just to make sure the path exists
	if(file_exists($picdir)){
		list($width, $height, $image_type, $image_attr) = getimagesize($picdir);
		if($width>$height){
			$pic_height=$td_width*$height/$width;
			$pic_width=$td_width;
		}
		else if($height>$width){
			$pic_width=$td_height*$width/$height;
			$pic_height=$td_height;
		}
		else{
			$pic_width=$td_width;
			$pic_height=$td_height;
		}
	}
	//$link=$goodsie.$row['link'];
	if($row['link']=='' && $row['link']==null){
		$link='#';
	}

	echo "
				<td style='width:".$td_width."px'>
		
					<div style='width:".$td_width."px; margin:0 auto'>
			";
			//if the width was bigger than the height, them move the picture down so it can be close to its caption name
					if($pic_width>$pic_height){
					echo "	
						<div style='width:".$td_width."px;height:".$td_height."px'>
							
							<div style='width:100%;height:".($td_height-$pic_height)."px'></div>
							
							<a href='?link=".$row['link']."'>
								<img src='".$picdir."' width='".$pic_width."px' height='".$pic_height."px'  />
							</a>
					
						</div>
				";
				}
				else {
				echo "
						<div style='width:".$td_width."px;height:".$td_height."px'>
				
							<a href='?link=".$row['link']."'>
								<img src='".$picdir."' width='".$pic_width."px' height='".$pic_height."px'  />
							</a>
					
						</div>
				";
				}
				
				echo "
					<div class='name_link'>
						<a href='?link=".$row['link']."'>
						
							<span class='item_link'><b>".strtoupper($row[item_name])."</b></span>
						
						</a>
						<br />
						<!--<span class='price'>$".$row['price']."</span>-->
					</div>
				";
				
				/*if($row['expire_date']!=null && $row['expire_date']!=0){
			echo " 
			<iframe name=\"timer\" frameborder=\"0\" scrolling=\"no\" src='timertest.php?endtime=".$row['expire_date']."' width='".($td_width-10)."px' height=\"40px\"></iframe>
					";}
					*/
					echo "
					</div>
				</td>
				";
				$total_cells+=1;
				/*checks that the total width that has been added to see how many items have been added. each item as the same width*/
				if($total_cells>=4)
				{
					
					echo "
					</tr>
					";
					if(!$first_row){
						echo "
							<!--this is just to space out the rows that are not the first rows since they get close together-->
							<tr><td colspan='4' style='height:33px;'></td></tr>
						";
						}
					else if($first_row) {$first_row=false;}
					
					echo "
					<tr>
					";
					$total_cells=0;	
				}

}
echo "
				</tr>
			</table>
			
";
				
				echo "
			
		</div><!--end div with class=contents-->
	<iframe name=\"Footer\" frameborder=\"0\" scrolling=\"no\" src=\"footer.php\" width=\"100%\" height=\"$footer2_height"."px\"></iframe>

</div><!--end div with class=outer_container-->
";


?>

</body>
</html>

<!--<div style='position:absolute;z-index:10;width:".($td_width*2)."px;margin-top:".($main_pic_height/2-26)."px;font-size:26pt'>
									<span>".$mainpic['item_name']."</span>
								</div>-->