<?php include_once 'header.php';
ob_start();

if (isset($_POST['add_staff'])) {

    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $contactno = $_POST['contactno'];
    $address = $_POST['address'];
    $role = $_POST['role'];
    $status = $_POST['status'];

  $sql_add_employee = "insert into admin(name,username,email,password,contactno,address,role,status)values('$name','$username','$email','$password','$contactno','$address','$role','$status')";
    mysqli_query($con,$sql_add_employee);

    header('location:add_staff.php');

}

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Staff </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Add Staff</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Staff</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name:</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter name" name="name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">username</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter username" name="username">
                  </div>
                   <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="email" class="form-control" id="exampleInputPassword1" placeholder="Enter email" name="email">
                  </div>
                   <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
                  </div>
                   <div class="form-group">
                    <label for="exampleInputPassword1">Contact No</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="contact no" name="contactno">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Address</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="address" name="address">
                  </div>

                   <div class="form-group">
                    <label for="exampleInputPassword1">Role</label>
                    <select class="form-control" name="role">
                      <option selected disabled>Select Role</option>
                      <option value="1">Admin</option>
                      <option value="2">Manager</option>
                      <option value="3">Emaployee</option>

                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Status</label>
                    <select class="form-control" name="status">
                      <option selected disabled>Select Status</option>
                      <option value="1">Active</option>
                      <option value="2">De-Active</option>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="add_staff">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include_once 'footer.php'; ?>