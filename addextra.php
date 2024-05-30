<?php 

$con = mysqli_connect("localhost","root","","crm_system");

	$category_data_query = "select * from category";
	$category_data = mysqli_query($con,$category_data_query);	



	while($row = mysqli_fetch_assoc($category_data)) {

		$insert_category_id = $row['cat_id'];

		$stock_data = array('MR-2 Mini');

		foreach ($stock_data as $key => $value) {

			$stock_insert = "insert into stock(cat_id,sub_cat_name) VALUES ('$insert_category_id','$value')";
			mysqli_query($con,$stock_insert);

			$query_sub_cat_insert = "insert into sub_category(cat_id,sub_cat_name,sub_cat_price)values('$insert_category_id','$value','sub_cat_price')";
			mysqli_query($con,$query_sub_cat_insert);
		}


	}


 ?>