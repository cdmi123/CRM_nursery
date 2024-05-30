<?php include_once 'header.php'; include_once 'query.php'; ?>

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
                      <th>Village</th>
                      <th>Taluka</th>
                      <th>City</th>
                      <th>Bill Date</th>
                      <th>Contact No</th>
                      <th>Print Bill</th>
                      <th>Edit Bill</th>
                    </tr>
                  </thead>
                  <tbody>
                <?php while($order_data = mysqli_fetch_assoc($total_order_old)){ ?>


                	<tr>
                		<td><?php echo $order_data['bill_no']; ?></td>
                		<td><?php echo $order_data['name']; ?></td>
                    <td><?php echo $order_data['village']; ?></td>
                    <td><?php echo $order_data['taluka']; ?></td>
                    <td><?php echo $order_data['city']; ?></td>
                		<td><?php echo $order_data['b_date']; ?></td>
                		<td><?php echo $order_data['contact_no']; ?></td>
                    <?php if($order_data['print_status']==0) { ?>
                		  <td><a href="print_order_slip.php?bill_no=<?php echo $order_data['bill_no']; ?>">Print Bill</a></td>
                    <?php }else{ ?>
                		<td><a href="print_order_slip.php?bill_no=<?php echo $order_data['bill_no']; ?>">Re-Print</a></td>
                  <?php } ?>
                  <td><a href="edit_bill.php?edit_bill_no=<?php echo $order_data['bill_no']; ?>">Edit Bill</a></td>
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