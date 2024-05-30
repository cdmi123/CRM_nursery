<?php include_once 'header.php'; include_once 'query.php'; ?>


<?php 

    if(isset($_GET['id']))
    {
          $id = $_GET['id'];
          $inq_data = "delete from inquiry where `id` = ".$id;
          mysqli_query($con,$inq_data);
          header("location:add_inquiry.php");
    }

    if(isset($_POST['addinq']))
    {
        $name = $_POST['name'];
        $contact = $_POST['contact'];
        $address = $_POST['address'];
        $extra = $_POST['extra'];
        $date = $_POST['date'];
    
        $qry = "insert into `inquiry` (`name`,`contact`,`address`,`extra_info`,`visit_date`)values('$name','$contact','$address','$extra','$date')";
        mysqli_query($con,$qry);

    }

    $data = "select * from `inquiry`";
    $res = mysqli_query($con,$data);


 ?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add visitor</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Add visitor</li>
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
          <div class="col-md-7">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add visitor</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="cate_form" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name:</label>
                    <input type="text" class="form-control" id="cat_name" name="name" placeholder="Enter name" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Contact:</label>
                    <input type="text" name="contact" class="form-control" id="cat_name" placeholder="Enter contact No" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Address:</label>
                    <input type="text" name="address" class="form-control" id="cat_name" placeholder="Enter Address" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Extra Information:</label>
                    <input type="text" name="extra" class="form-control" id="cat_name" placeholder="Extra Information" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Visit Date:</label>
                    <input type="date" name="date" class="form-control" id="cat_name" placeholder="" >
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="submit" value="Add Inquiry" class="btn btn-primary" name="addinq">
                </div>
               </form>
            
            </div>
            <!-- /.card -->
          </div>
        </div>
         <div class="col-md-12 px-0">
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
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Extra Info</th>
                    <th>Visit Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                  </thead>
                  <tbody id="display_cat_data">
                  <?php while($row = mysqli_fetch_assoc($res)){ ?>
                    <tr>
                      <td><?php echo $row['id']; ?></td>
                      <td><?php echo $row['name']; ?></td>
                      <td><?php echo $row['contact']; ?></td>
                      <td><?php echo $row['address']; ?></td>
                      <td><?php echo $row['extra_info']; ?></td>
                      <td><?php echo $row['visit_date']; ?></td>
                      <td><a href="add_category.php?edit_id=<?php echo $row['id']; ?>">Edit</a></td>
                      <td><a href="add_inquiry.php?id=<?php echo $row['id']; ?>">Delete</a></td>
                    </tr>
                  <?php } ?>
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
    
		$('#add_cat').click(function(){
			
			var cat_data = $('#cat_name').val();

			$.ajax({
				type:"post",
				url:"add_cat_ajax.php",
				data:{"cat_name":cat_data},

				success:function(res){
					$('#display_cat_data').html(res);
          $('#cat_name').val("");

				}
			})
		})
	})
</script>

<style>
  .dt-buttons{
    justify-content:center
  }
  .dt-buttons button{
    margin:3px;
    border-radius:0px;
  }
</style>

