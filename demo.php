<?php 

$con = mysqli_connect("localhost","root","","crm_system");

$e_update_stock = "update stock set quantity=10 , edit_status=0 where s_id=1";

				if(mysqli_query($con,$e_update_stock)) {  }else{ echo "error"; };


 ?>