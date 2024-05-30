<?php include_once 'header.php'; 

	$sql_select_inquiry = "SELECT * FROM `inquiry`";
	$inquiry_data = mysqli_query($con,$sql_select_inquiry);

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
                <h3 class="card-title">View inquiry Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">No</th>
                      <th>Name</th>
                      <th>Contact No</th>
                      <th>Address</th>
                      <th>Visit Date</th>
                      <th>inqury Date</th>
                    </tr>
                  </thead>
                  <tbody>
               
                  	<?php $id=1; while($inquiry_row = mysqli_fetch_assoc($inquiry_data)) { 

                  		$dt = new DateTime($inquiry_row["inqury_date"]); 
                  		$vt = new DateTime($inquiry_row["visit_date"]); 

                  	?>

                  		<tr>
                  			<td><?php echo $id; ?></td>
                  			<td><?php echo $inquiry_row["name"]; ?></td>
                  			<td><?php echo $inquiry_row["contact"]; ?></td>
                  			<td><?php echo $inquiry_row["address"]; ?></td>
                  			<td><?php echo $vt->format('d-m-Y'); ?></td>
                  			<td><?php echo $dt->format('d-m-Y'); ?></td>
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