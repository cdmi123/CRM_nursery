<?php include_once 'header.php'; include_once 'query.php'; ?>

    <?php 

          if(isset($_GET['billid']))
          {
                $bid = $_GET['billid'];

                $status_update = "delete from paid_amount where`p_id`=".$bid;
                mysqli_query($con,$status_update);
                header("location:view_payment.php");
          }
     ?>

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
              <div class="card-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">No</th>
                      <th>Name</th>
                      <th>Contact No</th>
                      <th>Paid Amount | Discount Amount</th>
                      <th>Bill Date</th>
                      <th>Action</th>
                      <?php if($_SESSION['role']==1) { ?>
                      <th>Delete</th>
                    <?php } ?>
                      <th>Created By</th>
                    </tr>
                  </thead>
                  <tbody>
               
                  	<?php $id=1; while($pay_data = mysqli_fetch_assoc($pay_amount_data)) { ?>

                  		<tr>
                  			<td><?php echo $id; ?></td>
                  			<td><?php echo $pay_data["name"]; ?></td>
                  			<td><?php echo $pay_data["contact_no"]; ?></td>
                  			<td><?php echo $pay_data["amount"]; ?> <?php if($pay_data['discount_amount']!=0) { ?> || <?php echo $pay_data['discount_amount']; } ?></td>
                  			<td><?php echo $pay_data["date"]; ?></td>
                  			<td><a href="print_cash_receipt.php?p_id=<?php echo $pay_data['p_id'] ?>&u_id=<?php echo $pay_data['p_u_id']; ?>">Print slip</a></td>
                        <?php if($_SESSION['role']==1) { ?>
                          <td><a href="view_payment.php?billid=<?php echo $pay_data['p_id']?>">Delete</a></td>
                        <?php } ?>
                          <td><?php echo $pay_data['s_created_by']; ?></td>
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

                    <style>
  .dt-buttons{
    justify-content:center
  }
  .dt-buttons button{
    margin:3px;
    border-radius:0px;
  }
</style>


<?php  include_once 'footer.php';?>
