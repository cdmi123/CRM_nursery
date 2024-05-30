<?php 

include_once 'db.php';


if(isset($_GET['quotation_bill_no']))
  {
    $e_bill_no = $_GET['quotation_bill_no'];
    $edit_bill_query = "select * from quotation_order where bill_no=$e_bill_no";
    $edit_bill_data = mysqli_query($con,$edit_bill_query);

    $m_cat_id = "";
    $sub_cat_name="";
    $e_quntity="";
    $u_id="";
    $sub_cat_id="";
    $e_cat_price="";


    $e_total_payment = 0 ; while($edit_bill_rows = mysqli_fetch_assoc($edit_bill_data))
    {

      $user_id = $edit_bill_rows['user_id'];
      $q_bill_no = $edit_bill_rows['bill_no'];

      $select_e_user = "select * from quotation_user where u_id=$user_id";
      $select_user_data = mysqli_query($con,$select_e_user);
      $user_data = mysqli_fetch_assoc($select_user_data);

      $cat_id = $edit_bill_rows['cat_id'];
      $s_cat_name = $edit_bill_rows['sub_cat_name'];

      $e_total_payment+=$edit_bill_rows['quantity'] * $edit_bill_rows['price'];


      $update_quntity_query = "select * from stock where cat_id='$cat_id' and sub_cat_name='$s_cat_name' and edit_status=0";

      $update_quntity_data = mysqli_query($con,$update_quntity_query);

      // if(mysqli_num_rows($update_quntity_data)>0)
      // {
      //   $quntity_update_row = mysqli_fetch_assoc($update_quntity_data);

      //   $stock_id = $quntity_update_row['s_id'];
      //   $total_stock = $quntity_update_row['quantity'] + $edit_bill_rows['quantity'];

      //   $update_stock = "update stock set quantity=$total_stock , edit_status=1 where s_id=$stock_id";
      //   mysqli_query($con,$update_stock);
      // }

      if($m_cat_id=="")
      {
        $m_cat_id = $edit_bill_rows['cat_id'];
      }
      else
      {
        $m_cat_id = $m_cat_id.",".$edit_bill_rows['cat_id'];
      }

      if($sub_cat_name=="")
      {
        $sub_cat_name = $edit_bill_rows['sub_cat_name'];
      }
      else
      {
        $sub_cat_name = $sub_cat_name.",".$edit_bill_rows['sub_cat_name'];
      }

      if($e_quntity=="")
      {
        $e_quntity = $edit_bill_rows['quantity'];
      }
      else
      {
        $e_quntity = $e_quntity.",".$edit_bill_rows['quantity'];
      }

      if($u_id=="")
      {
        $u_id = $edit_bill_rows['q_id'];
      }
      else
      {
        $u_id = $u_id.",".$edit_bill_rows['q_id'];
      }

      if($sub_cat_id=="")
      {
        $sub_cat_id = $edit_bill_rows['sub_cat_id'];
      }
      else
      {
        $sub_cat_id = $sub_cat_id.",".$edit_bill_rows['sub_cat_id'];
      }

       if($e_cat_price=="")
      {
        $e_cat_price = $edit_bill_rows['price'];
      }
      else
      {
        $e_cat_price = $e_cat_price.",".$edit_bill_rows['price'];
      }

    }

    $e_cat_id = explode(",",$m_cat_id);
    $e_sub_cat_name = explode(",",$sub_cat_name);
    $e_quntity = explode(",",$e_quntity);
    $u_id = explode(",",$u_id);
    $e_sub_cat_id = explode(",",$sub_cat_id);
    $e_cat_price = explode(",",$e_cat_price);


    $_SESSION['q_e_cat_id'] = $e_cat_id;
    $_SESSION['q_e_sub_cat_name'] = $e_sub_cat_name;
    $_SESSION['q_e_quntity'] = $e_quntity;
    $_SESSION['q_u_id'] = $u_id;
    $_SESSION['q_e_sub_cat_id'] = $e_sub_cat_id;
    $_SESSION['q_user_data'] = $user_data;
    $_SESSION['q_e_cat_price'] = $e_cat_price;
    $_SESSION['q_bill_no'] = $q_bill_no;

    $e_bill_no = $_GET['quotation_bill_no'];
    $delete_edit_bill_query = "delete from quotation_order where bill_no=$e_bill_no";
    mysqli_query($con,$delete_edit_bill_query);
    

    header('location:quotation.php');
  }
 ?>