<?php include_once 'db.php'; 


if (isset($_SESSION['Login_id'])) {
  header('location:dashboard.php');
}


if (isset($_POST['login'])) {
  
  $email = $_POST['email'];
  $password = $_POST['password'];

  $user_data = "select * from admin where email='$email' and password='$password' or username='$email' and password='$password'";
  $login_data = mysqli_query($con,$user_data);
  $total_record = mysqli_num_rows($login_data);

  if($total_record>0)
  {
    $user_data = mysqli_fetch_assoc($login_data);
    $_SESSION['Login_id'] = $user_data["a_id"];
    $_SESSION['role'] = $user_data["role"];
    $_SESSION['Login_user_name'] = $user_data["name"];
    header("location:dashboard.php");

  }else{
    echo "<script>alert('Check Your Email And password!')</script>";
  }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-header text-center login_header">
      <a href="assets/index2.html" class="h1">
        <!-- <img src="assets/dist/img/nursery_logo.svg" /> -->
        <img src="assets/dist/img/login_logo.svg" />
      </a>
    </div>
    <div class="card-body">
      <form  method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Email & Username" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block sign_btn" name="login">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<style>
    
  .login_header{
      background-color: #012918;
      padding: 30px;
  }
  .login_header img{
    width: 100%;
  }
  .sign_btn{
    background-color: #012918;
    border: none;
  }
  .sign_btn:hover, .btn-primary:focus{
    background-color: #004427 !important;
  }

</style>

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
</body>
</html>
