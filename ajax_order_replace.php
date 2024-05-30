<?php 

include_once 'db.php';

if (isset($_POST['cat_id'])) {

	$bill_no = $_POST['bill_no'];
	$cat_id = $_POST['cat_id'];
	$cat_id_query = "select * from product_order where cat_id=$cat_id and bill_no=$bill_no";
	$cat_data = mysqli_query($con,$cat_id_query);

?>

 <option value="0" selected disabled>Select Sub Category:</option>

<?php while($row = mysqli_fetch_assoc($cat_data)) { if($row['replace_status']==1) { $replace_status="disabled"; }else{ $replace_status=""; } ?>
 <option value="<?php echo $row['sub_cat_id'].','.$row['o_id']; ?>" <?php echo $replace_status; ?> ><?php echo $row['sub_cat_name']; ?></option>
 <?php } } ?>

<?php 

if (isset($_POST['cat_order_id'])) {


	
	$order_id_and_cat_id = explode(',',$_POST['cat_order_id']);
	$_SESSION['order_id'] = $order_id_and_cat_id[1];

	 $quantity_of_purchase_query = "select * from product_order where o_id=$order_id_and_cat_id[1] and sub_cat_id=$order_id_and_cat_id[0]";
	$quantity_of_purchase_data = mysqli_query($con,$quantity_of_purchase_query);
	$quantity_of_purchase = mysqli_fetch_assoc($quantity_of_purchase_data);

	echo $quantity_of_purchase['quantity'];
}

 ?>

 <?php if (isset($_POST['r_bill_no'])) {
 	
 	$r_bill_no = $_POST['r_bill_no'];
 	$category_id = $_POST['category_id'];
 	$sub_category_id = $_POST['sub_category_id'];

 	$sub_category_id = explode(',',$sub_category_id);


 	 $cat_id_query = "select * from product_order where cat_id=$category_id and bill_no=$r_bill_no and sub_cat_id=$sub_category_id[0]";
 	$replace_data = mysqli_query($con,$cat_id_query);
 	$replace_order_data = mysqli_fetch_assoc($replace_data);


 	$sub_cat_name = $replace_order_data['sub_cat_name'];
 	$quantity = $replace_order_data['quantity'];
 	$r_quantity = $_POST['sub_cat_stock'];
 	$price = $replace_order_data['price'];
 	$user_id = $replace_order_data['user_id'];
 	$order_date = $replace_order_data['order_date'];
 	$today_date = date("Y-m-d");


 	if($r_quantity<$quantity)
 	{
 		$quantity=$r_quantity;

 		$place_order = "insert into replace_order(cat_id,sub_cat_name,quantity,price,user_id,bill_no,order_date,sub_cat_id)values('$category_id','$sub_cat_name','$quantity',$price,'$user_id','$r_bill_no','$today_date',$sub_category_id[0])"; 
		mysqli_query($con,$place_order);

		$order_reqplace_id = $_SESSION['order_id'];

		$replace_status_query = "update product_order set replace_status = 1 where o_id = $order_reqplace_id";
		mysqli_query($con,$replace_status_query);

		
 	}
 
 		$replace_order_data_query = "select * from replace_order where cat_id=$category_id and bill_no=$r_bill_no and packing_status=0 and user_id=$user_id";
 		$replace_query_data = mysqli_query($con,$replace_order_data_query);

?>

<?php $id=1; while($replaced_order_data = mysqli_fetch_assoc($replace_query_data)) { ?>
<tr>
	<td><?php echo $id; ?></td>
	<td><?php echo $replaced_order_data['cat_id']; ?></td>
	<td><?php echo $replaced_order_data['sub_cat_name']; ?></td>
	<td><?php echo $replaced_order_data['quantity']; ?></td>
	<td><a href="#">Replaced</a></td>
</tr>
<?php $id++;} } ?>

