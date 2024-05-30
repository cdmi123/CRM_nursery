<?php include_once 'header.php';

  $user_data_query = "select * from admin";
  $data = mysqli_query($con,$user_data_query);

 ?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User Data</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">User Data</li>
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
                <h3 class="card-title">View User Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">Bill No</th>
                      <th>Name</th>
                      <th>Username</th>
                      <th>Email</th>
                      <th>Password</th>
                      <th>Contactno</th>
                      <th>Address</th>
                      <th>Role</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while($row = mysqli_fetch_assoc($data)) { ?>
                      <tr>
                        <td><?php echo $row['a_id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['password']; ?></td>
                        <td><?php echo $row['contactno']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php if($row['role']==1) { echo "Admin"; } else if($row['role']==2) { echo "Manager"; } else if($row['role']==3) { echo "Employee"; } ?></td>
                        <td><?php if($row['status']) { echo "unactive"; }else { echo "Active"; } ?></td>
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