<?php 

include_once 'db.php';


$bill_no = $_GET['bill_no'];

$sql_select_quotation = "select * from quotation_order where bill_no=$bill_no GROUP BY bill_no;";
$sql_data_quotation = mysqli_query($con,$sql_select_quotation);
$quotation_data = mysqli_fetch_assoc($sql_data_quotation);

$quotaion_user_id = $quotation_data['user_id'];

$sql_select_quotation_user = "select * from quotation_user where u_id=$quotaion_user_id";
$sql_data_quotation_user = mysqli_query($con,$sql_select_quotation_user);
$quotation_user_data = mysqli_fetch_assoc($sql_data_quotation_user);

$user_contact_no = $quotation_user_data['contact_no'];

$sql_select_order_user = "select * from user where contact_no=$user_contact_no";
$sql_data_order_user = mysqli_query($con,$sql_select_order_user);
$find_user_register = mysqli_num_rows($sql_data_order_user);


if($find_user_register==0)
{
	$name = $quotation_user_data['name'];
	$contact_no = $quotation_user_data['contact_no'];
	$address = $quotation_user_data['address'];
	$b_date = $quotation_user_data['b_date'];


	$register_new_user = "INSERT INTO `user`(`name`, `contact_no`, `address`,`b_date`) VALUES ('$name','$contact_no','$address','$b_date')";
	mysqli_query($con,$register_new_user);
	$user_id= mysqli_insert_id($con);
}
else
{
	$order_user_data = mysqli_fetch_assoc($sql_data_order_user);
	$user_id = $order_user_data['u_id'];
}

$sql_select_quotation = "select * from quotation_order where bill_no=$bill_no";
$sql_data_quotation = mysqli_query($con,$sql_select_quotation);

$sql_select_bill_no = "select * from product_order order by bill_no desc limit 0,1";
$sql_bill_data = mysqli_query($con,$sql_select_bill_no);
$bill_data = mysqli_fetch_assoc($sql_bill_data);
$bill_data_count = mysqli_num_rows($sql_bill_data);


	($bill_data_count!=0) ? $bill_no_payment = $bill_data['bill_no']+1 : $bill_no_payment=1;

$sql_advance_payment = "select * from advance_payment where q_bill_no=$bill_no";
$advance_data = mysqli_query($con,$sql_advance_payment);

while($row_of_payment = mysqli_fetch_assoc($advance_data))
{

	$amount = $row_of_payment['amount'];
	$date = $row_of_payment['date'];
	$payment_mode = $row_of_payment['payment_mode'];
	$extra_note = $row_of_payment['extra_note'];
	$bank_name = $row_of_payment['bank_name'];
	$check_date = $row_of_payment['cheque_date'];
	$login_user_name = $_SESSION['Login_user_name'];

	$sql_insert_payment = "INSERT INTO `paid_amount`(`p_u_id`, `amount`, `discount_amount`, `date`, `payment_mode`, `extra_note`, `bank_name`, `cheque_date`, `s_created_by`) VALUES ('$user_id','$amount',0,'$date','$payment_mode','$extra_note','$bank_name','$check_date','$login_user_name')";
	mysqli_query($con,$sql_insert_payment);
}

while($quotation_data = mysqli_fetch_assoc($sql_data_quotation))
{
	$cat_id = $quotation_data['cat_id'];
	$sub_cat_id = $quotation_data['sub_cat_id'];
	$sub_cat_name = $quotation_data['sub_cat_name'];
	$quantity = $quotation_data['quantity'];
	$price = $quotation_data['price'];
	$order_date = date('d'.'-'.'m'.'-'.'Y');
 	$login_user_name = $_SESSION['Login_user_name'];


 				$update_quntity_query = "select * from stock where cat_id=$cat_id and sub_cat_name='$sub_cat_name'"; 
				$update_quntity_data = mysqli_query($con,$update_quntity_query);
				$cnt=mysqli_num_rows($update_quntity_data);

				if($cnt==0)
				{
					$update_quntity_query = "select * from extra_cat_stock where cat_id=$cat_id and sub_cat_name='$sub_cat_name'";
					$update_quntity_data = mysqli_query($con,$update_quntity_query);
				}

				$quntity_update_row = mysqli_fetch_assoc($update_quntity_data);

				$stock_id = $quntity_update_row['s_id'];
				$total_stock = $quntity_update_row['quantity'] - $quantity;

				if($cnt==0)
				{
					$update_stock = "update extra_cat_stock set quantity=$total_stock where s_id=$stock_id";
				}
				else
				{
					$update_stock = "update stock set quantity=$total_stock where s_id=$stock_id";
				}

				mysqli_query($con,$update_stock);


	$order_query = "insert into product_order(cat_id,sub_cat_name,quantity,price,user_id,bill_no,order_date,sub_cat_id,o_place_by)values('$cat_id','$sub_cat_name','$quantity',$price,'$user_id','$bill_no_payment','$order_date',$sub_cat_id,'$login_user_name')";

	mysqli_query($con,$order_query);

	header('location:view_order.php');

}





?>