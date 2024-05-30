<?php include_once 'header.php'; include_once 'db.php';?>

<?php 

	if (isset($_POST['check_status'])) {
		
		$bill_no = $_POST['bill_no'];

		$check_replace_status_query = "SELECT * FROM `product_order` WHERE bill_no=$bill_no GROUP BY bill_no";
		$data_check = mysqli_query($con,$check_replace_status_query);
		$order_data = mysqli_fetch_assoc($data_check);

		$order_date = $order_data['order_date'];
		$today_date = date("Y-m-d");

		$earlier = new DateTime($order_date);
		$later = new DateTime($today_date);

		$total_days = $later->diff($earlier)->format("%a");

    if(isset($_POST['any_resion']))
    {
        header('location:replace.php?bill_no='.$bill_no);
    }
    else
    {

  		if ($total_days<=60) {
  			header('location:replace.php?bill_no='.$bill_no);
  		}
  		else
  		{
  			echo "<script>alert('Your Order is out of $total_days!')</script>";
  		}
    }
	}

 ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Replace Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Add Stock</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Replace Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post">
                <div class="card-body">

                  <div class="form-group">
                    <label for="exampleInputEmail1">Enter Bill No:</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Bil No" name="bill_no">
                  </div>

                   <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="any_resion">
                    <label class="form-check-label" for="exampleCheck1">Replace Product In Any Cases</label>
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="check_status">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

  </div>

<?php include_once 'footer.php'; ?>