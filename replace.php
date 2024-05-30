<?php include_once 'header.php'; include_once 'db.php';?>


<?php 

if (isset($_GET['bill_no'])) {
	
	$bill_no = $_GET['bill_no'];

	$select_oder_category = "select product_order.cat_id , category.cat_name from product_order join category on category.cat_id = product_order.cat_id where product_order.bill_no=$bill_no group by product_order.cat_id";
	$category_data = mysqli_query($con,$select_oder_category);
}

 ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Replace</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Add Stock</li>
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
                <h3 class="card-title">Select Replace Order</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="replace_manage_form">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                        	<input type="hidden" name="r_bill_no" id="bill_no" value="<?php echo $bill_no; ?>">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Select Category:</label>
                                    <select class="form-control" name="category_id" id="cat_id">
                                        <option value="0" selected>Select Category:</option>
                                            <?php while($cat_row = mysqli_fetch_assoc($category_data)){?>
                                                <option value="<?php echo $cat_row['cat_id']; ?>"><?php echo $cat_row['cat_name']; ?></option>
                                            <?php } ?>
                                    </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Select Sub Category:</label>
                                    <select class="form-control" name="sub_category_id" id="sub_cat_name">
                                        <option value="0" selected disabled>Select Sub Category:</option>
                                    </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Purchase Quantity:</label>
                                    <input type="text" class="form-control" id="sub_purchase_qty" placeholder="purchase quantity" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Quantity:</label>
                                    <input type="text" class="form-control" id="sub_cat_qty" placeholder="Enter category Stock" name="sub_cat_stock" onkeyup="get_qty()" disabled>
                            </div>
                        </div>
                    </div>
                </div>
               
                <!-- /.card-body -->
               
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" id="add_cat" value="Add">Submit</button>
                </div>
                </form>
            </div>
            <!-- /.card -->
          </div>
        </div>
         <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Category Name</th>
                    <th>Sub Category Name</th>
                    <th>quantity</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody id="display_cat_data">
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<?php include_once 'footer.php'; ?>

<script type="text/javascript">

    function get_qty() {
        
        var p_qty = parseInt(document.getElementById('sub_purchase_qty').value);
        var r_qty = parseInt(document.getElementById('sub_cat_qty').value);

        if(p_qty<r_qty)
        {
            document.getElementById('sub_cat_qty').value = p_qty;
        }


    }
</script>


<script>
    $(document).ready(function(){
        $('#replace_manage_form').submit(function(e){
            e.preventDefault();

            var replace_order_data = $('#replace_manage_form').serialize();

                $.ajax({
                type:"post",
                url:"ajax_order_replace.php",
                data:replace_order_data,

                success:function(res){
                    $('#display_cat_data').html(res);
                }
            })
        })
    });

    $(document).ready(function(){
        $('#cat_id').change(function(){

            var cat_id = $('#cat_id').val();
            var bill_no = $('#bill_no').val();


                $.ajax({
                type:"post",
                url:"ajax_order_replace.php",
                data:{"cat_id":cat_id,'bill_no':bill_no},

                success:function(res){
                    $('#sub_cat_name').html(res);
                    
                }
            })
        })
    })

     $(document).ready(function(){
        $('#sub_cat_name').change(function(){

            var cat_order_id = $(this).val();

            $.ajax({
                type:"post",
                url:"ajax_order_replace.php",
                data:{"cat_order_id":cat_order_id},

                success:function(res){
                    $('#sub_purchase_qty').val(res);
                    
                }
            })
        })
    })

     $(document).ready(function(){
        $('#sub_cat_name').change(function(){
                $('#sub_cat_qty').removeAttr("disabled");
        })
    })
</script>