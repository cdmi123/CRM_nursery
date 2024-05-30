<?php include_once 'header.php'; include_once 'db.php'; ?>
<?php 

$selected_order_query = "SELECT quotation_order.* , quotation_user.* FROM `quotation_order` JOIN quotation_user on quotation_user.u_id=quotation_order.user_id  GROUP BY quotation_order.bill_no ";
	$total_order = mysqli_query($con,$selected_order_query);

 ?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Order Data</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">View Order</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
           <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">View Order Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">Bill No</th>
                      <th>Name</th>
                      <th>Bill Date</th>
                      <th>Contact No</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                <?php while($order_data = mysqli_fetch_assoc($total_order)){ ?>


                	<tr>
                		<td><?php echo $order_data['bill_no']; ?></td>
                		<td><?php echo $order_data['name']; ?></td>
                		<td><?php echo $order_data['b_date']; ?></td>
                		<td><?php echo $order_data['contact_no']; ?></td>
                    <td><a href="convert_to_bill.php?bill_no=<?php echo $order_data['bill_no']; ?>">convert</a></td>
                  </tr>
                <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>

          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<?php include_once 'footer.php'; ?>