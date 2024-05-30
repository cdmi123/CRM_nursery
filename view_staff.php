<?php include_once 'header.php'; include_once 'query.php';?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Staff Data</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">View Staff</li>
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
                <h3 class="card-title">View Staff</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Name</th>
                      <th>User Name</th>
                      <th>Email</th>
                      <th>Password</th>
                      <th>contactno</th>
                      <th>address</th>
                      <th >Role</th>
                      <th style="width:100px">Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                <?php $id=1; while($staff_data = mysqli_fetch_assoc($data)){ ?>


                	<!-- Chanage Background Color  -->

                		<?php if($staff_data['status']==1){
                			$style = "background-color:#EBF5FB ";
                		}else if($staff_data['status']==0){
                			$style = "background-color:#F9EBEA";
                		} ?>

                	<!-- End -->

                    <tr style="<?php echo $style; ?>">
                      <td><?php echo $id; ?></td>
                      <td><?php echo $staff_data['name']; ?></td>
                      <td><?php echo $staff_data['username']; ?></td>
                      <td><?php echo $staff_data['email']; ?></td>
                      <td><?php echo $staff_data['password']; ?></td>
                      <td><?php echo $staff_data['contactno']; ?></td>
                      <td><?php echo $staff_data['address']; ?></td>
                      <td>
                      	<?php if($staff_data['role']==1){
                      		echo "Admin";
                      	}else if($staff_data['role']==2){
                      		echo "Manager";
                      	}else if($staff_data['role']==3){
                      		echo "Staff";
                      	} ?>
                      		
                      	</td>
                      <td><?php if($staff_data['status']==1){
                      		echo "Active";
                      	}else if($staff_data['status']==0){
                      		echo "De-Active";
                      	}?></td>
                        <td>
                          <?php if($staff_data['status']==1) { ?> <a href="view_staff.php?d_id=<?php echo $staff_data['a_id']; ?> ">De-Active</a> <?php } ?>
                          <?php if($staff_data['status']==0) { ?><a href="view_staff.php?a_id=<?php echo $staff_data['a_id'];  ?>">Active</a> <?php } ?>

                        </td>
                    </tr>                    
                <?php $id++;} ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<?php include_once 'footer.php'; ?>