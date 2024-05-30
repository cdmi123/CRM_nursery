<?php

include "db.php";
ob_start();

$url = $_SERVER['REQUEST_URI'];    

if(!isset($_SESSION["Login_id"]))
{
  header("location:index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> <?php if(@$_SESSION['role']==1) { 
          echo "Admin";
        }else if(@$_SESSION['role']==2){
          echo "Manager";
        }else if(@$_SESSION['role']==3){
          echo "Staff";
        }else{
          echo "Login";
        }
        ?> | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="assets/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="assets/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>
<body class="sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="assets/dist/img/nursery_logo.png" alt="AdminLTELogo"  width="200">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="dashboard.php" class="nav-link">Home</a>
      </li>
       <?php if($_SESSION['role']==1 || $_SESSION['role']==2){ ?>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="view_order.php" class="nav-link">View Order</a>
      </li>
        <li class="nav-item d-none d-sm-inline-block">
        <a href="view_old_record.php" class="nav-link">View old Order</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="view_deliver_record.php" class="nav-link">View Deliver Order</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="view_replace_order.php" class="nav-link">view Replace Order</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="payment.php" class="nav-link">Payment</a>
      </li>

        <?php if($_SESSION['role']==1 || $_SESSION['role']==2) { ?>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="view_expenses.php" class="nav-link">View Expenses</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="add_expenses.php" class="nav-link">Add Expenses</a>
          </li>

        <?php } ?>

    <?php } ?>

    <?php if($_SESSION['role']==3) { ?>

       <li class="nav-item d-none d-sm-inline-block">
        <a href="show_order.php" class="nav-link">view order</a>
      </li>

      <li class="nav-item d-none d-sm-inline-block">
        <a href="view_replace_order.php" class="nav-link">view Replace Order</a>
      </li>


    <?php } ?>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="logout.php">
          <i class="fas fa-power-off"></i>
        </a>
      </li>
    </ul>
    <div id="google_translate_element"></div>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="text-center">
    <a href="index3.html" class="brand-link" >
      <?php echo @$_SESSION["Login_user_name"]; ?> (
      <span class="brand-text font-weight-light">
        <?php if(@$_SESSION['role']==1) { 
          echo "Admin";
        }else if(@$_SESSION['role']==2){
          echo "Manager";
        }else if(@$_SESSION['role']==3){
          echo "Employee";
        }else{
          echo "Login";
        }
        ?>
          )
        </span>
    </a>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="dashboard.php" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <?php if($_SESSION['role']==3) { ?>

          <li class="nav-item">
                <a href="show_order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>view order</p>
                </a>
              </li>
          </li>

          <?php } ?>

          <?php if($_SESSION['role']==1 || $_SESSION['role']==2){ ?>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Staff
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="add_staff.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Staff</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="view_staff.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Staff</p>
                </a>
              </li>
            </ul>
          </li>

          <?php } ?>

          <?php if($_SESSION['role']==1 || $_SESSION['role']==2){ ?>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Category
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="add_category.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="add_sub_category.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Price</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="add_extra_category_price.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Extra Price</p>
                </a>
              </li>
            </ul>
          </li>

          <?php } ?>

          <?php if($_SESSION['role']==1 || $_SESSION['role']==2){ ?>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Inquiry
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="add_inquiry.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Inquiry</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="view_inquiry.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Inquiry</p>
                </a>
              </li>
            </ul>
          </li>

          <?php } ?>

          <?php if($_SESSION['role']==1 || $_SESSION['role']==2 || $_SESSION['role']==3){ ?>

           <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Quotation 
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="quotation.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Generate Quotation</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="view_quotation.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Quotation</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="convert_order.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Convert Order</p>
                </a>
              </li>

              <?php if($_SESSION['role']==1 || $_SESSION['role']==2){ ?>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-copy"></i>
                      <p>
                        Advance Payment 
                        <i class="fas fa-angle-left right"></i>
                        <span class="badge badge-info right"></span>
                      </p>
                    </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="quotation.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add Payment</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="view_advance_payment.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>View Payment</p>
                      </a>
                    </li>
                  </ul>
                </li>
              <?php } ?>
            </ul>
          </li>

          <?php } ?>

          <?php if($_SESSION['role']==1 || $_SESSION['role']==2){ ?>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Stock
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="add_stock.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Stock</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="add_extra_stock.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Extra Stock</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="view_stock.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Stock</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="view_second_stock.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Second Stock</p>
                </a>
              </li>
            </ul>
          </li>

          <?php } ?>

          <?php if($_SESSION['role']==1 || $_SESSION['role']==2){ ?>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Replace Product
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="add_replace.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Replace Product</p>
                </a>
              </li>
            </ul>
          </li>


          <?php } ?>

          <?php if($_SESSION['role']==1){ ?>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                  Payment Report
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right"></span>
                </p>
              </a>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="add_expenses.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Expenses</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="view_advance_payment.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View advance payment</p>
                  </a>
                </li>
                 <li class="nav-item">
                  <a href="view_expenses.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View Expenses</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="view_payment.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View Payment</p>
                  </a>
                </li>
                 <li class="nav-item">
                  <a href="view_payment_report.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View Report</p>
                  </a>
                </li>
              </ul>
            </li>

              <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                  Sales report
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right"></span>
                </p>
              </a>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="view_sales.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View Report</p>
                  </a>
                </li>
              </ul>
            </li>
          <?php } ?>

          <?php if ($_SESSION['role']==1 || $_SESSION['role==2']) { ?>
             <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Westage
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="add_westage.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Westage</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="view_westage.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Westage</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>