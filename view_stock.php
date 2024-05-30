<?php  include_once 'header.php'; include_once 'query.php'; ?>


  <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <div class="form-group">
                <!-- <select class="form-control">
                  <option>Select To Search</option>
                  <option>Total Kalam</option>
                  <option>Selling</option>
                  <option>Pending</option>
                  <option>Replace</option>
                  <option>Westage</option>
                </select> -->

                Total Kalam /  Selling Kalam  /  Pending Kalam  /  Replace Kalam
              </div>

            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>

      <section class="content">
        <div class="container-fluid">
          </div>
           <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Category Stock</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                    <thead>
                       <tr>
                          <th scope="col">NO</th>
                          <th scope="col">CATEGORY</th>
                          <th scope="col">B-1 K-1</th>
                          <th scope="col">B-1 K-2</th>
                          <th scope="col">B-1 K-3</th>
                          <th scope="col">B-1 K-4</th>
                          <th scope="col">MR-2</th>
                          <th scope="col">MR-3</th>
                          <th scope="col">MR-4</th>
                          <th scope="col">MR 2 - MINI</th>

                       </tr>
                    </thead>
                    <tbody class="text-left">
                      <?php $id=1; $index=0; $q_index=0; while($cate_rows = mysqli_fetch_assoc($sel_cat_data)){ $cate_id = $cate_rows['cat_id']; $category_name = $cate_rows['cat_name']; ?>
                       <tr>
                          <td><b><?php echo $id; ?></b></td>
                          <td><b><?php echo $cate_rows['cat_name']; ?></b></td>

                          <?php $sub_cat = "select * from sub_category where cat_id=$cate_id";
                                $sub_cat_data = mysqli_query($con,$sub_cat);
                                
                                while($sub_cat_row = mysqli_fetch_assoc($sub_cat_data)) { $sub_cat_name = $sub_cat_row['sub_cat_name'];

                                    $stock_query = "select * from stock where cat_id=$cate_id and sub_cat_name='$sub_cat_name'"; 

                                    $stock_query_total = "select sum(quantity) as sell from product_order where cat_id=$cate_id and sub_cat_name='$sub_cat_name'";
                                    $sell_data = mysqli_query($con,$stock_query_total);
                                    $total_sell = mysqli_fetch_assoc($sell_data);

                                    $stock_select = mysqli_query($con,$stock_query);
                                    $stock_data = mysqli_fetch_assoc($stock_select);

                                      $stock_query_replace = "select sum(quantity) as replace_p from replace_order where cat_id=$cate_id and sub_cat_name='$sub_cat_name'";
                                    $replace_data = mysqli_query($con,$stock_query_replace);
                                    $total_replace = mysqli_fetch_assoc($replace_data);

                                    if($total_replace['replace_p']!=""){
                                      $total_replace = $total_replace['replace_p'];
                                    }else{
                                      $total_replace = 0;
                                    }

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

                                    $total_pending = $stock_data['quantity'] + $total_sell['sell'];;
                                ?>

                                  <td>
                                    <table width="100%">
                                      <tr>
                                        <td  align="center"><?php echo $stock_data['quantity'] + $total_sell['sell'];; ?> </td>
                                        <td  align="center"><?php echo $total_sell['sell']; ?></td>
                                        <td  align="center"><?php echo $total_pending - $total_sell['sell']; ?></td>
                                        <td  align="center"><?php echo $total_replace; ?></td>
                                      </tr>
                                    </table>
                                  </td>

                                <?php $index++; } ?>
                       </tr>
                      <?php $id++; } ?>
                    </tbody>
                 </table>
              </div>
            </form>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include_once 'footer.php'; ?>