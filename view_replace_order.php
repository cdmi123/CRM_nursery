<?php 

include_once 'header.php'; include_once 'db.php';

if(isset($_GET['order_bill']))
{
  $billno = $_GET['order_bill']; 
  $update_order_status = "update replace_order set order_status=1 where bill_no=$billno";
  mysqli_query($con,$update_order_status);
  header("location:view_replace_order.php");
}

$selected_replace_order = "SELECT replace_order.* , user.*, category.cat_name FROM `replace_order` JOIN user on user.u_id=replace_order.user_id join category on replace_order.cat_id=category.cat_id where replace_order.order_status=0 GROUP BY replace_order.bill_no";
  $replace_order = mysqli_query($con,$selected_replace_order);



?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Replace order</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Replace Order</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body pb-0">
          <div class="row">
          <?php while($show_order = mysqli_fetch_assoc($replace_order)) { $user_id = $show_order['user_id']; ?>
             <a href="replace_order_details.php?u_bill_no=<?php echo $show_order["bill_no"]; ?>" style="padding-bottom:50px"> 
              <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                <div class="card bg-light d-flex flex-fill">
                  <div class="card-header text-muted border-bottom-0 bg-secondary">
                    <h1 class="lead text-capitalize mb-0"><b><?php echo $show_order['name']; ?></b></h1>
                  </div>
                  <div class="card-body pt-0">
                    <div class="row">
                      <div class="col-12">
                        <div class="my-3 font-weight-bold text-uppercase"><?php echo $show_order['cat_name']; ?></div>
                        <ul class="ml-0 mb-0 fa-ul text-muted">
                          <li class="d-flex align-items-center"><i class="fas fa-building pr-3"></i> <span><?php echo $show_order['address']; ?></span></li>
                          <br>
                          <li class="d-flex align-items-center"><i class="fas fa-phone-alt pr-3 "></i><span>+91 <?php echo $show_order['contact_no']; ?></span></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer order_btn_foot position-absolute" style="bottom: 0;left: 0; width: 100%;">
                      <a href="view_replace_order.php?order_bill=<?php echo $show_order['bill_no']; ?>" class="btn btn-sm btn-primary btn-block">
                        <i class="fas fa-truck"></i> Delivery
                      </a>
                  </div>
                </div>
              </div>
            </a>
          <?php } ?>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>

<?php include_once 'footer.php'; ?>