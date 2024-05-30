<?php include_once 'header.php'; include_once 'query.php'; ?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <br>

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
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">No</th>
                      <th>Name</th>
                      <th>Contact No</th>
                      <th>Total Amount</th>
                      <th>Paid Amount</th>
                      <th>Last Paid Amount</th>
                      <th>Discount</th>
                      <th>Pending Amount</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                <?php $id=1; while($order_data = mysqli_fetch_assoc($payment_data)){ $user_id = $order_data['user_id']; ?>


                  <?php 

                  $total_payment_query = "select * from product_order where user_id=$user_id"; 
                  $total_data = mysqli_query($con,$total_payment_query);

                  $total_price = 0;

                  while($order_rows = mysqli_fetch_assoc($total_data))
                  {
                      $total_price += $order_rows['price'] * $order_rows['quantity'];
                  }

                  $total_payment_paid_query = "select * from paid_amount where p_u_id=$user_id"; 
                  $total_paid_data = mysqli_query($con,$total_payment_paid_query);

                  $total_paid_amount = 0;
                  $discount = 0;


                  while($payment_rows = mysqli_fetch_assoc($total_paid_data))
                  {
                      $total_paid_amount += $payment_rows['amount'];
                      $discount += $payment_rows['discount_amount'];

                  }

                  $last_paid_amout_query = "select * from paid_amount where p_u_id=$user_id ORDER BY p_id DESC limit 0,1";
                  $last_paid_data = mysqli_query($con,$last_paid_amout_query);
                  $last_paid_data_fetch = mysqli_fetch_assoc($last_paid_data);
                  $cnt_paid = mysqli_num_rows($last_paid_data);
                  if($cnt_paid==1)
                  {
                    $last_paid_amount = $last_paid_data_fetch['amount'];
                  }
                  else
                  {
                    $last_paid_amount=0;
                  }

                  $pending_amount = $total_price - $total_paid_amount - $discount;

                  ?>

                  <tr>
                    <td><?php echo $id; ?></td>
                    <td><?php echo $order_data['name']; ?></td>
                    <td><?php echo $order_data['contact_no']; ?></td>
                    <td><?php echo $total_price; ?></td>
                    <td><?php echo $total_paid_amount; ?></td>
                    <td><?php echo $last_paid_amount; ?></td>
                    <td><?php echo $discount; ?></td>
                    <td><?php echo $pending_amount;?></td>

                    <td><?php if(($pending_amount)!=0) { ?><a href="add_payment.php?payment_id=<?php echo $order_data['u_id']; ?>&uname=<?php echo $order_data['name']; ?>&total_bill=<?php echo $pending_amount; ?>">Pay</a><?php } else { ?> <?php } ?></td>

                  </tr>
                <?php $id++; } ?>
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
