<?php 

include_once 'db.php';

$query_insert = "select * from category";
$data = mysqli_query($con,$query_insert);

$stock_data = array('MR-2 Mini');

while($row = mysqli_fetch_assoc($data))
{
	$insert_category_id = $row['cat_id'];
	
	foreach ($stock_data as $key => $value) {

		$stock_insert = "insert into stock(cat_id,sub_cat_name) VALUES ('$insert_category_id','$value')";
		mysqli_query($con,$stock_insert);

		$query_sub_cat_insert = "insert into sub_category(cat_id,sub_cat_name,sub_cat_price)values('$insert_category_id','$value','0')";
		mysqli_query($con,$query_sub_cat_insert);
	}
}
 ?>