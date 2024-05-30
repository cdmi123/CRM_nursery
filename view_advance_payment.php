<?php include_once 'header.php'; include_once 'db.php'; ?>

<?php 

if (isset($_GET['a_d_id'])) {
    $p_id = $_GET['a_d_id'];
    $sql_advance_pament_delete = "delete from advance_payment where p_id = $p_id";
    mysqli_query($con,$sql_advance_pament_delete);
    header('location:view_advance_payment.php');
}

	$advance_payment_view_query = "SELECT advance_payment.* , quotation_user.* FROM advance_payment JOIN quotation_user ON quotation_user.u_id=advance_payment.q_bill_no_user_id;";
	$advance_payement_data = mysqli_query($con,$advance_payment_view_query);

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
                      <th>Paid Amount</th>
                      <th>Bill Date</th>
                      <th>Action</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
               
                  	<?php $id=1; while($pay_data = mysqli_fetch_assoc($advance_payement_data)) { ?>

                  		<tr>
                  			<td><?php echo $id; ?></td>
                  			<td><?php echo $pay_data["name"]; ?></td>
                  			<td><?php echo $pay_data["contact_no"]; ?></td>
                  			<td><?php echo $pay_data["amount"]; ?></td>
                  			<td><?php echo $pay_data["b_date"]; ?></td>
                  			<td><a href="print_cash_receipt.php?a_id=<?php echo $pay_data['p_id']; ?>&u_id=<?php echo $pay_data['q_bill_no_user_id']; ?>">Print slip</a></td>

                          <td><a href="view_advance_payment.php?a_d_id=<?php echo $pay_data['p_id']; ?>">Delete</a></td>
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


<?php include_once 'footer.php'; ?>