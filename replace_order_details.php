<?php include_once 'header.php'; include_once 'db.php';; 


	if(isset($_GET['u_bill_no']))
  {
    $billno = $_GET['u_bill_no'];
    $_SESSION['billno'] = $billno;
  	$select_cat_wise_order = "select category.* , replace_order.* , user.* FROM replace_order join category on category.cat_id=replace_order.cat_id join user on user.u_id=replace_order.user_id where replace_order.bill_no=$billno"; 
    $cat_wise_data = mysqli_query($con,$select_cat_wise_order);
  }

  if(isset($_GET['o_id']))
  {
      $o_id = $_GET['o_id'];

      $update_order_status = "update replace_order set packing_status=1 where o_id=$o_id";
      mysqli_query($con,$update_order_status);

      header("location:replace_order_details.php?u_bill_no=".$_SESSION['billno']);
  }


?>

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Order Detail</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Order Detail</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Order Detail</h3>
        </div>
        <div class="card-body">
          <div class="row">

            <div class="col-12 col-md-12 col-lg-12 order-2 order-md-1">
              <div class="row">
                <?php while($order_row = mysqli_fetch_assoc($cat_wise_data)) { 

                    $user_id = $order_row['user_id'];
                    $cat_id = $order_row['cat_id'];
                    $order_id = $order_row['o_id'];

                    // echo $order_row['packing_status']; die();
                    if($order_row['packing_status']==0)
                    {
                        $back_color = "background-color:#d6ffcc";
                    }
                    else
                    {
                        $back_color = "background-color:#ccebff";
                    }

                   $select_order = "select * from replace_order where user_id=$user_id and cat_id=$cat_id and order_status=0 and bill_no=$billno and o_id=$order_id"; 
                    $order_select_data = mysqli_query($con,$select_order);

                ?>
                <div class="col-12 col-sm-3">
                  <div class="info-box " style="<?php echo $back_color; ?>">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted"><b><?php echo $order_row['cat_name']; ?></b></span>
                        <?php while($order_row_data = mysqli_fetch_assoc($order_select_data)) { ?>
                      <span class="info-box-number text-center text-muted mb-0"><?php echo $order_row_data['sub_cat_name']  ?> : <?php echo $order_row_data['quantity']; ?></span>
                       <?php } ?>

                       <?php if($order_row['packing_status']==0) { ?>
                       <a href="replace_order_details.php?o_id=<?php echo $order_row['o_id']; ?>" class="stretched-link"></a>
                     <?php } ?>
                    </div>
                  </div>
                </div>
              <?php } ?>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
<?php include_once 'footer.php'; ?>