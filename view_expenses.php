<?php 

	include_once 'header.php'; 

	$select_expenses_data = "select admin.* , expenses.* from expenses inner join admin on admin.a_id=expenses.s_created_by";
	$expenses_data = mysqli_query($con,$select_expenses_data);

  if(isset($_GET['e_delete']))
          {
                $bid = $_GET['e_delete'];
                $status_update = "delete from expenses where `e_id`=".$bid;
                mysqli_query($con,$status_update);
                header("location:view_expenses.php");
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
                      <th>Paid Amount </th>
                      <th>Bill Date</th>
                      <th>Created By</th>
                      <th>Payment Mode</th>
                      <th>Action</th>                      
                    </tr>
                  </thead>
                  <tbody>
               
                  	<?php $id=1; while($pay_data = mysqli_fetch_assoc($expenses_data)) { $today_date_arr = explode('-',$pay_data['date']); $t_date = $today_date_arr[2].'-'.$today_date_arr[1].'-'.$today_date_arr[0]; ?>

                  		<tr>
                  			<td><?php echo $id; ?></td>
                  			<td><?php echo $pay_data["e_name"]; ?></td>
							<td><?php echo $pay_data["amount"]; ?></td>
                  			<td><?php echo $t_date; ?></td>
                  			<td><?php echo $pay_data['name']; ?></td>
                  			<td>
                  				<?php if($pay_data['mode']==1) { echo "UPI"; }else if($pay_data['mode']==2) { echo "Bank Transfer"; }else if($pay_data['mode']==3) { echo "Cheque"; }else{ echo "Cash "; } ?>
                  			</td>
                          <td><a href="print_cash_receipt1.php?e_id=<?php echo $pay_data['e_id'] ?>">Print slip</a> || <a href="view_expenses.php?e_delete=<?php echo $pay_data['e_id']?>">Delete</a></td>
                          
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