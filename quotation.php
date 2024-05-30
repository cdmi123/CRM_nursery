<?php include_once 'header.php'; include_once 'query.php'; 

if (isset($_SESSION['q_e_cat_id'])) {
  
    $e_cat_id =$_SESSION['q_e_cat_id'];
    $e_sub_cat_name = $_SESSION['q_e_sub_cat_name'] ;
    $e_quntity = $_SESSION['q_e_quntity'];
    $u_id = $_SESSION['q_u_id'];
    $e_sub_cat_id = $_SESSION['q_e_sub_cat_id']; 
    $user_data = $_SESSION['q_user_data']; 
}

?>

<div class="content-wrapper">
 
   <section class="content">
      <div class="container-fluid">
        <div class="row pt-4">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Customer info</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name: <a href=""></a></label>
                                    <input type="text" class="form-control" value="<?php if(isset($_SESSION['q_e_cat_id'])) { echo $user_data['name']; } ?>" name="p_name" placeholder="Full name" required id="c_name">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Contact_no:</label>
                                    <input type="text" class="form-control" value="<?php if(isset($_SESSION['q_e_cat_id'])) { echo $user_data['contact_no']; } ?>" name="p_contact_no" id="Contact_no" maxlength="10" placeholder="Contact No" required>
                            </div>
                        </div>
                           <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Address:</label>
                                    <input type="text" class="form-control" value="<?php if(isset($_SESSION['q_e_cat_id'])) { echo $user_data['address']; } ?>" name="p_address" placeholder="Addresss" required id="c_address">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Bill Date:</label>
                                    <input type="date" class="form-control" value="<?php if(isset($_SESSION['q_e_cat_id'])) { echo $user_data['b_date']; } ?>" name="p_date" required id="todayDate">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <style>
          .tab_menu .nav-item .nav-link{
            background-color: transparent;
          }
          .tab_menu .nav-item .nav-link.active{
            border: none;
            color: #007bff;
            border-bottom:3px #007bff solid;
          }
          .tab_menu .nav-item:hover .nav-link{
            border-width: 0 0 3px 0;
            border-color: transparent transparent #007bff transparent;
            color: #007bff;
          }
        </style>
         <div class="col-md-12 pb-5 px-0">
                  <div class="card p-3">
            <ul class="nav nav-tabs tab_menu" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#category" type="button">Main Category</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#second" type="button">Second Category</button>
              </li>             
            </ul>
            <div class="tab-content" id="myTabContent">
                <style type="text/css">
                  
                  .cell_width{
                    min-width: 200px !important;
                  }
                  .cate_table{
                    border-collapse: unset !important;
                    border-spacing: 0px !important;
                    max-height: 700px;
                    overflow-y: auto;
                  }
                  .cate_table .fix1{
                    position: sticky;
                    left: 0;
                    background-color: white;
                    min-width: 50px;
                  }
                  .cate_table .fix2{
                    position: sticky;
                    left: 50px;
                    background-color: white;
                    min-width: 125px;
                  }
                  #table_header{
                    position: sticky;
                    top: 0;
                    background-color: white;
                    z-index: 5;
                  }

                </style>
              <div class="tab-pane fade show active" id="category" role="tabpanel" >
                  <div class="card-body table-responsive p-0 my-3" style="height: 700px;">
                      <table class="table table-bordered text-center cate_table" cellspacing="0" >
                        <thead id="table_header">
                           <tr>
                              <th class="fix1">NO</th>
                              <th class="fix2">CATEGORY</th>
                              <th >B-1 K-1</th>
                              <th >B-1 K-2</th>
                              <th >B-1 K-3</th>
                              <th >B-1 K-4</th>
                              <th >MR-2</th>
                              <th >MR-3</th>
                              <th >MR-4</th>
                              <th >MR-2 Mini</th>
                           </tr>
                        </thead>
                        <tbody class="text-left">
                          <?php $id=1; $index=0; $q_index=0; while($cate_rows = mysqli_fetch_assoc($sel_cat_data)){ $cate_id = $cate_rows['cat_id']; $category_name = $cate_rows['cat_name']; ?>
                           <tr>
                              <td class="fix1"><b><?php echo $id; ?></b></td>
                              <td class="text-left fix2"><b><?php echo $cate_rows['cat_name']; ?></b></td>

                              <?php $sub_cat = "select * from sub_category where cat_id=$cate_id";
                                    $sub_cat_data = mysqli_query($con,$sub_cat);
                                    
                                    while($sub_cat_row = mysqli_fetch_assoc($sub_cat_data)) { $sub_cat_name = $sub_cat_row['sub_cat_name'];

                                        $stock_query = "select * from stock where cat_id=$cate_id and sub_cat_name='$sub_cat_name'"; 
                                        $stock_select = mysqli_query($con,$stock_query);
                                        $stock_data = mysqli_fetch_assoc($stock_select);

                                        // if($stock_data['quantity']<=10)
                                        // {
                                        //   $style = "background-color: #ffebe6";
                                        // }
                                        // else
                                        // {
                                        //   $style = "";
                                        // }

                                        // if($sub_cat_row['sub_cat_price']==0 || $stock_data['quantity']==0)
                                        // {
                                        //     $status = "disabled";
                                        // }else{
                                        //   $status = "";
                                        // }

                                     // print_r($sub_cat_row); 
                                     // print_r($e_cat_id);
                                     // print_r($e_sub_cat_id); die();

                                    ?>

                                      <td style="<?php echo @$style; ?>" class="cell_width">
                                        <table width="100%">
                                          <tr>
                                            <input type="hidden" name="category[]" value="<?php 
                                            if(isset($_SESSION['q_e_cat_id'])) 
                                            { 
                                                if((in_array($sub_cat_row['sub_cat_id'],$e_sub_cat_id) && in_array($sub_cat_row['cat_id'],$e_cat_id)))
                                                { 
                                                  echo $e_cat_id[$q_index]; 
                                                  
                                                }
                                                else 
                                                { 
                                                  echo "0"; 
                                                } 
                                              } 
                                              else 
                                              { 
                                                  echo "0"; 
                                                }  
                                              ?> " class="category_name">
                                            <input type="hidden" name="price[]" value="" class="category_price">

                                            <?php if(isset($_SESSION['q_e_cat_id'])) { if(in_array($sub_cat_row['sub_cat_name'],$e_sub_cat_name) && in_array($cate_id,$e_cat_id)) { ?> <input type="hidden" name="bill_no_id[]" value="<?php echo $u_id[$q_index] ?>">  <?php } } ?>

                                            <td width="20" align="center"><input type="checkbox"  <?php echo @$status; ?>  onchange="change_data(<?php echo $index; ?> , <?php echo $cate_id; ?>)" name="items[]" value="<?php echo $sub_cat_row['sub_cat_name']; ?>" class="form-check-input product_select " <?php if(isset($_SESSION['q_e_cat_id'])) { if((in_array($sub_cat_row['sub_cat_id'],$e_sub_cat_id) && in_array($sub_cat_row['cat_id'],$e_cat_id))) { ?> checked  <?php } }  ?>></td>

                                            <td width="60" align="center">₹ <?php echo $sub_cat_row['sub_cat_price']; ?></td>
                                            <td width="50" align="center"><?php echo $stock_data['quantity']; ?> Q</td>

                                          </tr>
                                          <tr>

                                            <td colspan="3"><input type="number" name="quntity[]" class="form-control product_check product_quantity" min="0" value="<?php if(isset($_SESSION['q_e_cat_id'])) {  if((in_array($sub_cat_row['sub_cat_id'],$e_sub_cat_id) && in_array($sub_cat_row['cat_id'],$e_cat_id))) { echo $e_quntity[$q_index]; $q_index++; }else{ echo "0"; } } else { echo "0"; } ?>" product_price="<?php echo $sub_cat_row['sub_cat_price']; ?>" max="<?php echo $stock_data['quantity']; ?>" <?php if(isset($_SESSION['q_e_cat_id'])) {  if((in_array($sub_cat_row['sub_cat_id'],$e_sub_cat_id) && in_array($sub_cat_row['cat_id'],$e_cat_id))) { ?>   <?php }else{ echo "disabled"; } } else { echo "disabled"; } ?>  onchange="calculation(<?php echo $total_category; ?>)" onkeyup="calculation(<?php echo $total_category; ?>)"></td>
                                          </tr>
                                        </table>
                                      </td>

                                    <?php $index++; } ?>
                           </tr>
                          <?php $id++; } ?>
                          
                        </tbody>
                     </table>
                  </div>
                  <div class="total_amount py-3" style="display: flex; justify-content: space-between; align-items: center;">

                    <div>
                      <h4>Total Amount :</h4>
                      <h1 id="total">
                        ₹ <?php echo @$e_total_payment; ?>
                      </h1>
                      <h4>Total Quantity :</h4>
                      <h1 id="total_q">
                        Q <?php echo @$e_total_payment; ?>
                      </h1>
                    </div>
                      <input type="submit" class="btn btn-primary form-control w-25" name="quotation_btn" id="submit_btn" value="Generate Quotation" <?php if(!isset($_SESSION['q_e_cat_id'])) { ?> disabled <?php } ?> >

                  </div>
              </div>

              <div class="tab-pane fade" id="second" role="tabpanel">  
                  <div class="card-body">
                          <table class="table table-bordered">
                            <thead>
                               <tr>
                                  <th scope="col">NO</th>
                                  <th scope="col">CATEGORY</th>
                                  <th scope="col">B-2 K-1</th>
                                  <th scope="col">B-2 K-2</th>
                                  <th scope="col">B-2 K-3</th>
                                  <th scope="col">B-3 K-1</th>
                                  <th scope="col">B-3 K-2</th>
                                  <th scope="col">B-4 K-1</th>
                                  <th scope="col">B-4 K-2</th>
                                  <th scope="col">B-5 K-1</th>
                                  <th scope="col">B-5 K-2</th>

                               </tr>
                            </thead>
                            <tbody class="text-left">
                              <?php while($cate_rows = mysqli_fetch_assoc($sel_cat_data1)){ $cate_id = $cate_rows['cat_id']; $category_name = $cate_rows['cat_name']; ?>
                               <tr>
                                  <td><b><?php echo $id; ?></b></td>
                                  <td><b><?php echo $cate_rows['cat_name']; ?></b></td>

                                  <?php $sub_cat = "select * from extra_sub_category where cat_id=$cate_id";
                                        $sub_cat_data = mysqli_query($con,$sub_cat);
                                        
                                        while($sub_cat_row = mysqli_fetch_assoc($sub_cat_data)) { $sub_cat_name = $sub_cat_row['sub_cat_name'];

                                            $stock_query = "select * from extra_cat_stock where cat_id=$cate_id and sub_cat_name='$sub_cat_name'"; 
                                            $stock_select = mysqli_query($con,$stock_query);
                                            $stock_data = mysqli_fetch_assoc($stock_select);

                                            if($stock_data['quantity']<=10)
                                            {
                                              $style = "background-color: #ffebe6";
                                            }
                                            else
                                            {
                                              $style = "";
                                            }

                                            if($sub_cat_row['sub_cat_price']==0 || $stock_data['quantity']==0)
                                            {
                                                $status = "disabled";
                                            }else{
                                              $status = "";
                                            }

                                        ?>

                                          <td style="<?php echo @$style; ?> ">
                                            <table width="100%">
                                              <tr>
                                                <input type="hidden" name="category[]" value="<?php 
                                                if(isset($_SESSION['q_e_cat_id'])) 
                                                { 
                                                    if((in_array($sub_cat_row['sub_cat_id'],$e_sub_cat_id) && in_array($sub_cat_row['cat_id'],$e_cat_id)))
                                                    { 
                                                      echo $e_cat_id[$q_index]; 
                                                      
                                                    }
                                                    else 
                                                    { 
                                                      echo "0"; 
                                                    } 
                                                  } 
                                                  else 
                                                  { 
                                                      echo "0"; 
                                                    }  
                                                  ?> " class="category_name">
                                                <input type="hidden" name="price[]" value="" class="category_price">

                                                <?php if(isset($_SESSION['q_e_cat_id'])) { if(in_array($sub_cat_row['sub_cat_name'],$e_sub_cat_name) && in_array($cate_id,$e_cat_id)) { ?> <input type="hidden" name="bill_no_id[]" value="<?php echo $u_id[$q_index] ?>">  <?php } } ?>

                                                <td width="20" align="center"><input type="checkbox"  <?php echo @$status; ?>  onchange="change_data(<?php echo $index; ?> , <?php echo $cate_id; ?>)" name="items[]" value="<?php echo $sub_cat_row['sub_cat_name']; ?>" class="form-check-input product_select " <?php if(isset($_SESSION['q_e_cat_id'])) { if((in_array($sub_cat_row['sub_cat_id'],$e_sub_cat_id) && in_array($sub_cat_row['cat_id'],$e_cat_id))) { ?> checked  <?php } }  ?>></td>

                                                <td width="60" align="center">₹ <?php echo $sub_cat_row['sub_cat_price']; ?></td>
                                                <td width="50" align="center"><?php echo $stock_data['quantity']; ?> Q</td>

                                              </tr>
                                              <tr>

                                                <td colspan="3"><input type="number" name="quntity[]" class="form-control product_check product_quantity" min="0" value="<?php if(isset($_SESSION['q_e_cat_id'])) {  if((in_array($sub_cat_row['sub_cat_id'],$e_sub_cat_id) && in_array($sub_cat_row['cat_id'],$e_cat_id))) { echo $e_quntity[$q_index]; $q_index++; }else{ echo "0"; } } else { echo "0"; } ?>" product_price="<?php echo $sub_cat_row['sub_cat_price']; ?>" max="<?php echo $stock_data['quantity']; ?>" <?php if(isset($_SESSION['q_e_cat_id'])) {  if((in_array($sub_cat_row['sub_cat_id'],$e_sub_cat_id) && in_array($sub_cat_row['cat_id'],$e_cat_id))) { ?>   <?php }else{ echo "disabled"; } } else { echo "disabled"; } ?>  onchange="calculation(<?php echo $total_category; ?>)" onkeyup="calculation(<?php echo $total_category; ?>)"></td>
                                              </tr>
                                            </table>
                                          </td>

                                        <?php $index++; } ?>
                               </tr>
                              <?php $id++; } ?>
                            </tbody>
                         </table>
                      </div> 
                  </div>
              </div>
                  </div>
            
          </form>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
  </section>



</div>
  <?php include_once 'footer.php'; ?>

  <script type="text/javascript">

        var temp=0;

    function change_data(index,category_name1) {

        var x=document.getElementsByClassName('product_check')[index];
    
        if(x.disabled==true)
        {
            document.getElementsByClassName('product_check')[index].disabled = false;
            document.getElementsByClassName('product_check')[index].value = ""
            document.getElementsByClassName('category_name')[index].value = category_name1;
            var price_1 = parseInt(document.getElementsByClassName('product_quantity')[index].getAttribute('product_price'));
            document.getElementsByClassName('category_price')[index].value = price_1; 
            document.getElementById('submit_btn').disabled = false;
          temp++;
        }
        else
        {
          document.getElementsByClassName('product_check')[index].value = 0;
          document.getElementsByClassName('category_name')[index].value = "";
          document.getElementsByClassName('product_check')[index].disabled = true;
          temp--;
        }

        if(temp==0)
        {
            document.getElementById('submit_btn').disabled = true;
        }
    }

    function calculation(total_category) {

      var total=0;
       var total_q = 0;
      var cat_1,price_1;

      for (var i=0;i<total_category;i++) {

          cat_1 = parseInt(document.getElementsByClassName('product_quantity')[i].value);
          price_1 = parseInt(document.getElementsByClassName('product_quantity')[i].getAttribute('product_price'));

            var check_selected = document.getElementsByClassName('product_select')[i];
            
            if(check_selected.checked==true)
            {
              var price_2 = parseInt(document.getElementsByClassName('product_quantity')[i].getAttribute('product_price'));
      
              document.getElementsByClassName('category_price')[i].value = price_2; 
              document.getElementsByClassName('product_select')[i].value;
            }

          total = total + cat_1*price_1; 
          total_q = total_q + cat_1;
      }        

      document.getElementById('total').innerText = total;
      document.getElementById('total_q').innerText = total_q;
    }
    
  </script>

  <script>
  $(document).ready(function(){

        var typingTimer;                //timer identifier
        var doneTypingInterval = 1000;

    $('#Contact_no').keyup(function(){
      clearTimeout(typingTimer);

      

      if ($('#Contact_no').val) 
      {

        var name = $('#c_name').val();
        var text = $("#Contact_no").val();

          if(name.length==0)
          {
          typingTimer = setTimeout(function(){

            $.ajax({
              type:"POST",
              url:"serach_ajax.php",
              data:{"search_txt":text},
              dataType:"json",
              success:function(data){
                $('#c_name').val(data.name);
                $('#c_address').val(data.address);
              }
            })
          },doneTypingInterval);
        }
      }

    })
  })
</script>

<style>

.table td{
  padding:5px;
}

</style>
