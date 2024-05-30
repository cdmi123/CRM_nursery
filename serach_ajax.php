<?php include 'db.php'; ?>

<?php 

$user_data = array();

if(isset($_POST['search_txt']))
{

$search_txt = $_POST['search_txt'];

$select_user_data = "select * from user where contact_no like '%$search_txt%'";
$sql_data = mysqli_query($con,$select_user_data);
$cnt = mysqli_num_rows($sql_data);
			if($cnt==1)
			{
				$user_data = mysqli_fetch_assoc($sql_data);
				echo json_encode($user_data);
			}
			else
			{
				echo json_encode($user_data);
			}	
}



	if(isset($_POST['quotation_search_txt']))
	{
		$search_txt = $_POST['search_txt'];

		$select_user_data = "select * from user where contact_no like '%$search_txt%'";
		$sql_data = mysqli_query($con,$select_user_data);
		$cnt = mysqli_num_rows($sql_data);
			if($cnt==1)
			{
				$user_data = mysqli_fetch_assoc($sql_data);
				echo json_encode($user_data);
			}
			else
			{
				echo json_encode($user_data);
			}	
	}



 ?>