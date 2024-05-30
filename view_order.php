<?php include_once 'header.php'; include_once 'query.php'; 

  if(isset($_GET['d_bill_no']))
          {
                $bid = $_GET['d_bill_no'];

                $status_update = "delete from product_order where`bill_no`=".$bid;
                mysqli_query($con,$status_update);
                header("location:view_order.php");
          }

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
                      <?php if($_SESSION['role']==1) { ?>
                      <th>Delete</th>
                    <?php } ?>
                      <th>Order By</th>
                    </tr>
                  </thead>
                  <tbody>
                <?php  while($order_data = mysqli_fetch_assoc($total_order)){ 

                  $place_status = 0;
                  $billno = $order_data['bill_no'];
                  $order_place = "select * from product_order where bill_no='$billno'";
                  $order_place_data = mysqli_query($con,$order_place);

                  while($order_place_row = mysqli_fetch_assoc($order_place_data))
                  {
                      if($order_place_row['packing_status']==1)
                      {
                          $place_status=1;
                      }
                  }

                  ?>

                  <?php if($place_status==1){
                      $style = "background-color:#ccebff";
                    } ?>

                	<tr style="<?php echo $style; ?>">
                		<td><?php echo $order_data['bill_no']; ?></td>
                		<td><?php echo $order_data['name']; ?></td>
                		<td><?php echo $order_data['order_date']; ?></td>
                		<td><?php echo $order_data['contact_no']; ?></td>
                    <?php if($order_data['print_status']==0) { ?>
                		  <td><a href="print_order_slip.php?bill_no=<?php echo $order_data['bill_no']; ?>">Print Bill</a></td>
                    <?php }else{ ?>
                		<td><a href="print_order_slip.php?bill_no=<?php echo $order_data['bill_no']; ?>">Re-Print</a></td>
                  <?php } ?>
                  <td><a href="edit_bill.php?edit_bill_no=<?php echo $order_data['bill_no']; ?>">Edit Bill</a></td>
                   <?php if($_SESSION['role']==1) { ?>
                          <td><a href="view_order.php?d_bill_no=<?php echo $order_data['bill_no']?>">Delete</a></td>
                        <?php } ?>
                  <td><?php echo $order_data['o_place_by']; ?></td>
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