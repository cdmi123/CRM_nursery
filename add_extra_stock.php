<?php  include_once 'header.php'; include_once 'query.php';?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Stock </h1>
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
                <h3 class="card-title">Add Category wise Stock</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="stock_manage_form">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
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
                                    <select class="form-control" name="sub_category" id="sub_cat_name">
                                        <option value="0" selected>Select Sub Category:</option>
                                        <option value="B2-K1">B2-K1</option>
                                        <option value="B2-K2">B2-K2</option>
                                        <option value="B2-K3">B2-K3</option>
                                        <option value="B3-K1">B3-K1</option>   
                                        <option value="B3-K2">B3-K2</option>   
                                        <option value="B4-K1">B4-K1</option>   
                                        <option value="B4-K2">B4-K2</option>   
                                        <option value="B5-K1">B5-K1</option>   
                                        <option value="B5-K2">B5-K2</option>
                                    </select>
                            </div>
                        </div>
                         <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Action:</label>
                                    <select class="form-control" name="action" id="action">
                                        <option value="0" selected>Add</option>
                                        <option value="1">Delete</option>
                                    </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Quantity:</label>
                                    <input type="text" class="form-control" id="sub_cat_stock" placeholder="Enter category Stock" name="sub_cat_extra_stock" disabled>
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
                    <th>Cat Name</th>
                      <th scope="col">B2 K1</th>
                      <th scope="col">B2 K2</th>
                      <th scope="col">B2 K3</th>
                      <th scope="col">B3 K1</th>
                      <th scope="col">B3 K2</th>
                      <th scope="col">B4 K1</th>
                      <th scope="col">B4 K2</th>
                      <th scope="col">B5 K1</th>
                      <th scope="col">B5 K2</th>
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

<script>
    $(document).ready(function(){
        $('#stock_manage_form').submit(function(e){
            e.preventDefault();

            var cat_data = $('#stock_manage_form').serialize();

                $.ajax({
                type:"post",
                url:"add_cat_ajax.php",
                data:cat_data,

                success:function(res){
                    $('#display_cat_data').html(res);
                    $('#sub_cat_stock').val("");
                }
            })
        })
    });

    $(document).ready(function(){
        $('#cat_id').change(function(){

            var cat_id = $('#cat_id').val();

                $.ajax({
                type:"post",
                url:"add_cat_ajax.php",
                data:{"select_extra":cat_id},

                success:function(res){
                    $('#display_cat_data').html(res);
                    
                }
            })
        })
    })

     $(document).ready(function(){
        $('#sub_cat_name').change(function(){

                // $('#sub_cat_stock').prop("disabled", true);
                $('#sub_cat_stock').removeAttr("disabled");
        })
    })
</script>