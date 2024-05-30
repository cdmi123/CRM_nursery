<?php include_once 'db.php'; ?>

<?php 

if(isset($_GET['q_bill_no']))
{
	$bill_no = $_GET['q_bill_no'];

	$select_order = "select category.* , quotation_order.* , quotation_user.* FROM quotation_order join category on category.cat_id=quotation_order.cat_id join quotation_user on quotation_user.u_id=quotation_order.user_id where quotation_order.bill_no=$bill_no";

	$order_data = mysqli_query($con,$select_order);
	$order_data1 = mysqli_query($con,$select_order);

	$order_data2 = mysqli_query($con,$select_order);
	$order_user_id = mysqli_fetch_assoc($order_data2);
	$user_id = $order_user_id["user_id"];

	$advance_payment_view_query = "SELECT advance_payment.* , quotation_user.*, quotation_order.* from advance_payment JOIN quotation_user ON advance_payment.q_bill_no_user_id=quotation_user.u_id JOIN quotation_order ON advance_payment.q_bill_no = quotation_order.bill_no where advance_payment.q_bill_no=$bill_no GROUP BY q_bill_no";
	$advance_payement_data = mysqli_query($con,$advance_payment_view_query);
	$advance_data_count = mysqli_num_rows($advance_payement_data);
$a_amount=0;
	if ($advance_data_count>0) {

	$advance_data_row = mysqli_fetch_assoc($advance_payement_data);
	$q_bill_no = $advance_data_row['q_bill_no'];

		$sql_select_advanace_payement = "select * from advance_payment where q_bill_no=$q_bill_no";
		$data = mysqli_query($con,$sql_select_advanace_payement);
		$cnt = mysqli_num_rows($data);
		
		if($cnt!=0)
		{
				while($row = mysqli_fetch_assoc($data))
				{
						$a_amount += $row['amount'];
				}
		}
	}
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Estimate</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">

		<style type="text/css">
			body {
				width: 100%;
				height: 100%;
				margin: 0;
				padding: 0;

			}
			* {
				box-sizing: border-box;
				-moz-box-sizing: border-box;

			}
			.page {
				width: 210mm;
				min-height: 297mm;
/*				padding: 10px;*/
				margin: 10px auto;
				border: 1px #000 solid;
				border-radius: 5px;
				background: white;

			}
			.content::before{
				content: '';
				position: absolute;
				top: 0;
				left: 0;
				height: 100%;
				width: 100%;
				background-image: url('assets/dist/img/nursery_logo.png');
				z-index: 1;
				background-size: 50%;
				background-repeat: no-repeat;
				background-position: 75% 75%;
				opacity: .10;
}
.table td, .table th{
	padding:5px;
}
.receipt-print td, .receipt-print th
{
	padding: 0px;
}
.borderB
{
	border-bottom: 1px #003366 solid;
}	 
.table-bordered{
	border:none !important;
}
.table-bordered td, .table-bordered th{
	border-color:#003366 !important;
}
.table td.inner{
	padding:0;
}
.inner_table td, .inner_table th{
	border:none !important;
	border-bottom: 1px #003366 solid !important;
}
.inner_table td:first-child{
	border-right: 1px #003366 solid !important;
}
.inner_table{
	margin-bottom:0;
}
.header{
	background-color: #003366;
	padding: 20px;
	position: relative;
}
.main_logo{
	/* width: 50%; */
	padding-left: 20px;
	display:flex;
	align-items:center;
}
.main_logo img{
	width: 175px;
}
.main_logo img.guj_logo{
	width:400px;
	margin-left:50px;
}
.address{
	color: white;
	text-align: center;
	position: absolute;
	width: 100%;
	text-align: center;
	bottom: 15px;
	left: 0;
	font-size: 18px;
	font-weight: bold;
}
.mob_no{
	text-align: right;
	position: absolute;
	top: 5px;
	right: 10px;
	color:white;
}
.swami_title{
	color: #fff;
	position: absolute;
	top: 10px;
	left: 50%;
	transform: translateX(-50%);
	width: 100%;
	font-size:14px;
	text-align:center;
}
.chalan_title{
	color: #fff;
	font-size: 22px;
	font-weight: bold;
	text-align: center;
	position: absolute;
	bottom: 0;
	right: 0;
	padding: 10px 30px;
	background-color: #7CC439;
}
.rules li{
	margin-bottom: 5px;
	font-size: 14px;
}
.footer{
	display: flex;
	padding: 0 30px;
	justify-content: space-between;
	font-size: 18px;
}
@page {
	size: A4;
	margin: 0;
}
@media print {
	html, body {
		width: 210mm;
		height: 297mm;        
	}
	.page {
		margin: 0;
		border: initial;
		border-radius: initial;
		width: initial;
		min-height: initial;
		box-shadow: initial;
		background: initial;
		page-break-after: always;
	}
}

</style>

  <?php 

    $billno = $_GET['q_bill_no'];

    $update_print_status_query = "update product_order set print_status=1 where bill_no=$billno";
    mysqli_query($con,$update_print_status_query);

    ?>

<!-- Main content -->
<section class="content mb-4">
	<div class="card page shadow-none m-2">
		<div class="card-body myTableBg4">
			<div class="header mb-1">
				<div class="mob_no">
					<b>
							Off. Mo. +91 78628 83381<br>
							Off. Mo. +91 93289 09006<br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mo. +91 63558 90035<br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mo.  +91 97244 70044
						</b>	
				</div>
				<div class="swami_title">
					<b>।। શ્રી સ્વામિનારાયણ ।।</b>											
				</div>
				<div class="main_logo">
					<img src="assets/dist/img/nursery_logo.svg">
					<img src="assets/dist/img/estimate_logo.svg" class="guj_logo" alt="">

				</div>
				<div class="address">
					એડ્રેસ : મુ. પો. અરેઠ, બૌધાન રોડ, તા.માંડવી, જી. સુરત.
				</div>
				<div class="chalan_title">
					Estimate
				</div>
			</div>

			<table class="table table-bordered mb-1">

					<?php $cnt=0;  while($customer_data = mysqli_fetch_assoc($order_data1)) { if($cnt==0) { ?>
					<tr>
						<td class="w-75"><b>M/s. : </b><?php echo $customer_data['name']; ?></td>
						<td class="text-break"><b>Mob. : </b>+91 <?php echo $customer_data['contact_no']; ?></td>
					</tr>
					<tr>
						<td rowspan="2"><b>Add. : </b><?php echo $customer_data['address']; ?></td>
						<td class="w-25"><b>Ch. No. : </b><?php echo $customer_data['bill_no']; ?></td>
					</tr>
					<tr>

						 <?php if($customer_data['bill_date']==""){
                      $date = $customer_data['b_date'];
                    }else{
                      $date = $customer_data['bill_date'];
                    }

                    $date_array = explode('-',$date);
							?>

						<td><b>Date : </b><?php echo  $date_array[2].'-'.$date_array[1].'-'.$date_array[0]; ?></td>
					</tr>
					<?php $cnt++; } } ?>
				</table>
				<table class="table table-bordered mb-1" width="100%">
					<tr>
						<th class="text-center" width="50px">No</th>
						<th>Particular</th>
						<th class="text-center" width="80px">Qty</th>
						<th class="text-center" width="150px">Rate</th>
						<th class="text-center" width="150px">Amount</th>
					</tr>
						<?php $id=1; $total_price=0; $cnt=1; $total_product=0; while($odrer_row = mysqli_fetch_assoc($order_data)) { $cat_id = $odrer_row['cat_id']; $sub_cat_name = $odrer_row['sub_cat_name']; ?>

					<tr>
						<th class="text-center"><?php echo $id; ?></th>
						<td><?php echo $odrer_row['cat_name']; ?> ( <?php echo $odrer_row['sub_cat_name']; ?> )</td>
						<td class="text-center"><?php echo $odrer_row['quantity']; if($odrer_row['cat_id']!=98 && $odrer_row['cat_id']!=99 && $odrer_row['cat_id']!=100) { $total_product+=$odrer_row['quantity']; } ?></td>

						<td class="text-center"><?php echo $odrer_row['price']; ?></td>
						<td class="text-center"><?php echo $odrer_row['price'] * $odrer_row['quantity'];  $total_price += $odrer_row['price'] * $odrer_row['quantity'];  ?></td>
					</tr>

					<?php $id++; $cnt++;} ?>

					<?php for($i=$cnt-1;$i<=19;$i++){ ?>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
					<?php } ?>		
					
					<tr>
						<th colspan="3"></th>
						<th class="text-center text-danger">Total Kalam</th>
						<th class="text-center" width="20%"><?php echo $total_product; ?></th>
					</tr>	
					<tr>
						<th colspan="3"></th>
						<th class="text-center text-danger">Advance</th>
						<th class="text-center" width="20%"><?php echo $a_amount; ?></th>
					</tr>	
					<tr>
						<th colspan="3"></th>
						<th class="text-center text-danger">Total</th>
						<th class="text-center" width="20%"><?php echo $total_price; ?></th>
					</tr>		
					<tr>
						<th colspan="3"></th>
						<th class="text-center text-danger">&nbsp;</th>
						<th class="text-center" width="20%">&nbsp;</th>
					</tr>		
					<tr>
						<th colspan="5" class="text-center">
							<br>
							<br>
							<div class="footer">
									<span>Receiver's Sign</span>
									<span>For Shree Hari Nursery</span>
							</div>
						</th>
					</tr>
					<tr>
						<th colspan="5" class="text-center">
							ટેમ્પા ભાડુ અલગ રહેશે.
						</th>
					</tr>
				</table>
			</table>
		</div>
	</div>
</section>

	<script type="text/javascript">
		window.onload=function(){
			window.print();
		}
	</script>


