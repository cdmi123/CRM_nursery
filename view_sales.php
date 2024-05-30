<?php 

 include_once 'header.php'; include_once 'db.php';

$total_category = "select * from category";
$sql_data = mysqli_query($con,$total_category);

?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <a href="" class="btn btn-primary">Payment Report</a> -->
            <h3>Total Saling</h3>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
		

				        	<div class="col-md-6">
					            <div class="card bg-light ">
					              <div class="card-header bg-primary text-center ">
					                <h2 class="card-title text-white font-weight-bold float-none" align="center">Total Sale</h2>
					              </div>
					              <!-- /.card-header -->
					              <div class="card-body">
					                <table class="table table-bordered">
					                  <thead>
					                    <tr>
					                      <th>ID</th>
					                      <th>Category Name</th>
					                      <th>Total Sale</th>
					                    </tr>
					                  </thead>
					                  <tbody>
					                  	<?php while($row = mysqli_fetch_assoc($sql_data)) { 

					                  		$cat_id = $row['cat_id'];

					                  		$sql_select_data = "SELECT sum(quantity) as total_qty FROM `product_order` WHERE cat_id=  $cat_id GROUP BY cat_id";
					                  		$tol_data_qty = mysqli_query($con,$sql_select_data);
					                  		$count_data = mysqli_num_rows($tol_data_qty);
					                  		$total_qty=0;

					                  		if ($count_data>0) {
					                  			$total_data_row = mysqli_fetch_assoc($tol_data_qty);
					                  			$total_qty = $total_data_row['total_qty'];
					                  		}

					                  		if($cat_id!=98 && $cat_id!=99){

					                  		?>

					                  		<tr>
					                  			<td><?php echo $row['cat_id']; ?></td>
					                  			<td><?php echo $row['cat_name']; ?></td>
					                  			<td><?php echo $total_qty; ?></td>
					                  		</tr>

					                  	<?php } } ?>
					                  </tbody>
					                </table>
					              </div>
					            </div>
				          	</div>

          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


<?php include_once 'footer.php'; ?>

