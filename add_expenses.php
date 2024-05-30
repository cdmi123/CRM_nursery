<?php include 'header.php'; ?>


<?php 

if (isset($_POST['add_expenses'])) {
	
	$name = $_POST['u_name'];
	$t_date = $_POST['t_date'];
	$amount = $_POST['amount'];
	$note = $_POST['note'];
	$mode = $_POST['payment_mode'];
	$created_by = $_SESSION['Login_id'];


	$sql_insert_expenses = "insert into expenses(e_name,date,amount,note,mode,s_created_by)values('$name','$t_date','$amount','$note','$mode','$created_by')";
	mysqli_query($con,$sql_insert_expenses);

	header('location:view_expenses.php');
}

 ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Expenses</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Add Expenses</li>
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
                <h3 class="card-title">Add Expenses</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Customer Name:</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Name" name="u_name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Payment Date</label>
                    <input type="date" class="form-control" required id="todayDate" name="t_date">
                  </div>
                   <div class="form-group">
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
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="add_expenses">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<?php include 'footer.php'; ?>