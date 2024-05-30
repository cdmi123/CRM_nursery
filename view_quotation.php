<?php include_once 'header.php'; include_once 'db.php';

  if (isset($_GET['d__no'])) {
      
      $d__id = $_GET['d__no'];

      $sql_delete_data = "delete from quotation_order where bill_no=$d__id";
      mysqli_query($con,$sql_delete_data);

      $sql_delete_advance_payment = "delete from advance_payment where q_bill_no=$d__id";
      mysqli_query($con,$sql_delete_advance_payment);

      header("location:view_quotation.php");
  }

 ?>
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
                      <th>Print Bill</th>
                      <th>Edit Bill</th>
                      <?php if($_SESSION['role']!=3) { ?>
                      <th>Advance Pay</th>
                    <?php } ?>
                     <?php if($_SESSION['role']==1) { ?>
                      <th>Delete</th>
                    <?php } ?>
                    </tr>
                  </thead>
                  <tbody>
                <?php while($order_data = mysqli_fetch_assoc($total_order)){ 


                    if($order_data['bill_date']==""){
                      $date = $order_data['b_date'];
                    }else{
                      $date = $order_data['bill_date'];
                    }

                  ?>


                	<tr>
                		<td><?php echo $order_data['bill_no']; ?></td>
                		<td><?php echo $order_data['name']; ?></td>
                		<td><?php echo $date; ?></td>
                		<td><?php echo $order_data['contact_no']; ?></td>
                    <?php if($order_data['print_status']==0) { ?>
                		  <td><a href="print_estimate.php?q_bill_no=<?php echo $order_data['bill_no']; ?>">Print Bill</a></td>
                    <?php }else{ ?>
                		<td><a href="print_estimate.php?q_bill_no=<?php echo $order_data['bill_no']; ?>">Re-Print</a></td>
                  <?php } ?>
                  <td><a href="edit_quotation.php?quotation_bill_no=<?php echo $order_data['bill_no']; ?>">Edit Bill</a></td>
                  <?php if($_SESSION['role']!=3) { ?>
                  <td><a href="Add_advance_payment.php?quotation_bill_no=<?php echo $order_data['bill_no']; ?>">Pay Advance</a></td>
                <?php } if ($_SESSION['role']==1) { ?>
                  <td><a href="view_quotation.php?d__no=<?php echo $order_data['bill_no']; ?>">Delete</a></td>
                <?php } ?>
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