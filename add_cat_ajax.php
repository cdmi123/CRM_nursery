<?php include_once 'query.php';

if(isset($_POST['cat_name']))
{
	while($data_cat = mysqli_fetch_assoc($cat_data))
	{ ?>
	<tr>
		<td><?php echo $data_cat['cat_id']; ?></td>
		<td><?php echo $data_cat['cat_name']; ?></td>
		<td><a href="#">Edit</a></td>
        <td><a href="#">update</a></td>
	</tr>
<?php } } if(isset($_POST['cat_id'])) { 

	$id=1; while($data_cat = mysqli_fetch_assoc($sub_cat_data))
	{ ?>
	<tr>
	 	<td><?php echo $id; ?></td>
		<td><?php echo $data_cat['sub_cat_name']; ?></td>
		<td><?php echo $data_cat['sub_cat_price']; ?></td>
	</tr>

<?php $id++;} } if(isset($_POST['selct_cat_id'])) { 

	$id=1; while($data_cat = mysqli_fetch_assoc($extra_sub_cat_data))
	{ ?>
	<tr>
	 	<td><?php echo $id; ?></td>
		<td><?php echo $data_cat['sub_cat_name']; ?></td>
		<td><?php echo $data_cat['sub_cat_price']; ?></td>
	</tr>

<?php $id++;} } ?>

<?php if(isset($stock_data)) {  ?>

	<tr>
		<?php $count=1; while($stock_row = mysqli_fetch_assoc($stock_data)) { ?>

			<?php if($count==1){ ?>
		  		<td>1</td>
		  		<td><?php echo $stock_row['cat_name']; ?></td>
		  	<?php } ?>
		  		<td><?php if($stock_row['quantity']!=0) { echo $stock_row['quantity']; } ?></td>
		 <?php $count++; } ?>
	</tr>

<?php }else if(isset($extra_data)){  ?>
	
		<tr>
		<?php $count=1; while($stock_row = mysqli_fetch_assoc($extra_data)) { ?>

			<?php if($count==1){ ?>
		  		<td>1</td>
		  		<td><?php echo $stock_row['cat_name']; ?></td>
		  	<?php } ?>
		  		<td><?php if($stock_row['quantity']!=0) { echo $stock_row['quantity']; } ?></td>
		 <?php $count++; } ?>
	</tr>
<?php 
	echo $e_cnt;
} ?>

