<?php include_once 'header.php'; include_once 'query.php'; ?>

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
              <li class="breadcrumb-item active">Add Payment</li>
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
                <h3 class="card-title">Add Payemnt</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Customer Name:</label>
                    <input type="hidden" class="form-control" id="exampleInputEmail1" placeholder="Name" readonly name="u_id" value="<?php echo $_GET['payment_id']; ?>">
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Name" readonly name="u_name" value="<?php echo $_GET['uname']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Payment Date</label>
                    <input type="date" class="form-control" required id="todayDate" name="t_date">
                  </div>
                   <div class="form-group">
                    <label for="exampleInputPassword1">Total Amount</label>
                    <input type="text" class="form-control" id="total_amount" required  name="total_amount" readonly value="<?php echo $_GET['total_bill']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Pending Amount</label>
                    <input type="text" class="form-control" required  name="total_pending" readonly value="0" id="pending_amount" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Pay Amount</label>
                    <input type="text" class="form-control" placeholder="Amount" name="amount" id="pay_amount" onkeyup="get_pay_amount()">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Discount Amount</label>
                    <input type="text" class="form-control" id="discount_amount" placeholder="discount" name="discount">
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
                  <button type="submit" class="btn btn-primary" name="add_payment">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


<?php  include_once 'footer.php';?>
<script type="text/javascript">

       
  
    function get_pay_amount()
    {
       var pay_amount = document.getElementById("pay_amount").value
        var total_amount = document.getElementById("total_amount").value
        var pending_amount = total_amount-pay_amount;

        document.getElementById("pending_amount").value = pending_amount

        if(pending_amount<0)
        {
            document.getElementById("pay_amount").value = total_amount
            document.getElementById("pending_amount").value = 0

        }
    }

    function discount_pay_amount()
    {
       var total_amount = document.getElementById("total_amount").value
        var discount_amount = document.getElementById("discount_amount").value
        var pending_amount = total_amount-discount_amount;

        document.getElementById("pay_amount").value = pending_amount
    }

</script>