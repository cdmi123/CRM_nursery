<?php include_once 'header.php'; include_once 'db.php'; ?>

<?php if (isset($_GET['quotation_bill_no'])) {
	
	$q_bill_no = $_GET['quotation_bill_no'];

	$selected_order_query = "SELECT quotation_order.* , quotation_user.* FROM `quotation_order` JOIN quotation_user on quotation_user.u_id=quotation_order.user_id   where quotation_order.bill_no = $q_bill_no  GROUP BY quotation_order.bill_no";
	$total_order = mysqli_query($con,$selected_order_query);
	$q_order_row = mysqli_fetch_assoc($total_order);

} 

if(isset($_POST['advance_payment']))
{
    $user_id = $_POST['u_id'];
    $t_date = $_POST['t_date'];
    $amount = $_POST['amount'];
    $payment_mode = $_POST['payment_mode'];
    $b_name = $_POST['note'];
    $c_name = $_POST['c_date'];
    $note = $_POST['b_name'];

   $advance_payement_query = "insert into advance_payment(q_bill_no,q_bill_no_user_id,amount,date,extra_note ,bank_name,cheque_date,payment_mode)values('$q_bill_no','$user_id','$amount','$t_date','$b_name','$note','$c_name','$payment_mode')";

    mysqli_query($con,$advance_payement_query);



    header('location:view_advance_payment.php');

}

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Payment</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Add Advance</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Advance</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Customer Name:</label>
                    <input type="hidden" class="form-control" id="exampleInputEmail1" placeholder="Name" readonly name="u_id" value="<?php echo $q_order_row['u_id']; ?>">
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Name" readonly name="u_name" value="<?php echo $q_order_row['name']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Payment Date</label>
                    <input type="date" class="form-control" required id="todayDate" name="t_date">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Pay Amount</label>
                    <input type="text" class="form-control" placeholder="Amount" name="amount" id="pay_amount">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Select Payment Mode:</label>
                    <select class="form-control" name="payment_mode">
                    	<option value="0" selected disabled>select Payment Modd:</option>
                    	<option value="1">BY UPI</option>
                    	<option value="2">BY Bank Trasnfer</option>
                    	<option value="3">BY Cheque</option>
                    	<option value="4">BY Cash</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Extra Note</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="note" name="note">
                  </div><div class="form-group">
                    <label for="exampleInputPassword1">Cheque Date</label>
                    <input type="date" class="form-control" id="exampleInputPassword1" placeholder="Cheque Date" name="c_date">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Bank Name:</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="bankname" name="b_name">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="advance_payment">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<?php include_once 'footer.php'; ?>