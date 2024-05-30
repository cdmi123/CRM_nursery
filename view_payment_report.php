<?php  include_once 'header.php'; include_once 'query.php'; ?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <a href="" class="btn btn-primary">Payment Report</a> -->
            <h3>Payment Report</h3>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

        	<?php $start_year = 2023; $d = date('d');   $today_total_income=0; $today_total_expenses=0;  $td = date('d'); $tm = date('m'); $ty = date('Y');

        	for ($y=date('Y'); $y >=$start_year ; $y--) {

        													$total_income=0; $total_expenses=0; $total_advance_today=0; $year_advance=0;
        									$m=date('m');

        		 							 $dateObj   = DateTime::createFromFormat('!m', $m); $monthName = $dateObj->format('F');

					                  	$total_payment_query1 = "select * from paid_amount where YEAR(date) = $y";
					                  	$total_payment_data1 = mysqli_query($con,$total_payment_query1);

					                  	$total_expenses_query1 = "select * from expenses where YEAR(date) = $y";
					                  	$total_expenses_data1 = mysqli_query($con,$total_expenses_query1);

					                  	$total_advance_query1 = "select * from advance_payment where YEAR(date) = $y";
					                  	$total_advance_data1 = mysqli_query($con,$total_advance_query1);

					                  	$today_date=$ty.'-'.$tm.'-'.$td;
					                		$today_payment_query1 = "select * from paid_amount where date='$today_date'"; 
					                  	$today_payment_data1 = mysqli_query($con,$today_payment_query1);

					                  	$today_expenses_query1 = "select * from expenses where date='$today_date'";
					                  	$today_expenses_data1 = mysqli_query($con,$today_expenses_query1);

					                  	$today_advance_query = "select * from advance_payment where date='$today_date'";
					                  	$today_advance_data = mysqli_query($con,$today_advance_query);

					                  	while($advance_payment = mysqli_fetch_assoc($today_advance_data)){
					                  		$total_advance_today += $advance_payment['amount']; 
					                  	}


					                  	while($payment_data_rows1 = mysqli_fetch_assoc($total_payment_data1))
					                  	{
					                  			$total_income += $payment_data_rows1['amount'];
					                  	}

					                  	while($total_advance_year = mysqli_fetch_assoc($total_advance_data1)){
					                  		$year_advance += $total_advance_year['amount'];
					                  	}

					                  	while($expenses_data_rows1 = mysqli_fetch_assoc($total_expenses_data1))
					                  	{
					                  			$total_expenses += $expenses_data_rows1['amount'];
					                  	}

					                  	while($today_payment_data_rows1 = mysqli_fetch_assoc($today_payment_data1))
					                  	{
					                  			$today_total_income += $today_payment_data_rows1['amount'];
					                  	}

					                  	while($today_expenses_data_rows1 = mysqli_fetch_assoc($today_expenses_data1))
					                  	{
					                  			$today_total_expenses += $today_expenses_data_rows1['amount'];
					                  	}
					        			
        		 						?>  		

				        	<div class="col-md-6">
					            <div class="card bg-light ">
					              <div class="card-header bg-primary text-center ">
					                <h2 class="card-title text-white font-weight-bold float-none" align="center">Year : <?php echo $y; ?></h2>
					              </div>
					              <!-- /.card-header -->
					              <div class="card-body">
					                <table class="table table-bordered">
					                  <thead>
					                    <tr>
					                      <th>Month</th>
					                      <th>Amount</th>
					                      <th>Advance</th>
					                      <th>Expenses</th>
					                      <th>Total</th>
					                    </tr>
					                    <?php if(date('Y')==$y) { ?>
					                    <tr>
					                    	<th> <?php echo $td.'-'.$tm.'-'.$ty; ?> </th>
					                    	<th><?php echo $today_total_income; ?></th>
					                    	<th><?php echo $total_advance_today; ?></th>
					                    	<th><?php echo $today_total_expenses; ?></th>
					                    	<th><?php echo $today_total_income-$today_total_expenses; ?></th>
					                    </tr>
						                    <tr>
						                    	<th>
						                    	Total Incom:-
						                      </th>
						                      <th><?php echo $total_income; ?></th>
						                      <th><?php echo $year_advance; ?></th>
						                      <th><?php echo $total_expenses; ?></th>
						                      <th><?php echo $total_income-$total_expenses; ?></th>
					                    </tr>
					                    <?php } ?>
					                  </thead>
					                  <tbody>
					                  	<?php for($m=date('m');$m>=1;$m--) {


					                  	$dateObj  = DateTime::createFromFormat('!m', $m); $monthName = $dateObj->format('F');

					                  	$total_payment_query = "select * from paid_amount where YEAR(date) = $y and MONTH(date)=$m ";
					                  	$total_payment_data = mysqli_query($con,$total_payment_query);

					                  	$total_expenses_query = "select * from expenses where YEAR(date) = $y and MONTH(date)=$m ";
					                  	$total_expenses_data = mysqli_query($con,$total_expenses_query);

					                  	$total_advance_query = "select * from advance_payment where YEAR(date) = $y and MONTH(date)=$m ";
					                  	$total_advance_data = mysqli_query($con,$total_advance_query);

					                  	$total_month_payment = 0;
					                  	$total_month_expenses = 0;
					                  	$total_month_advance = 0;

					                  	while($payment_data_rows = mysqli_fetch_assoc($total_payment_data))
					                  	{
					                  			$total_month_payment += $payment_data_rows['amount'];
					                  	}

					                  	while($expenses_data_rows = mysqli_fetch_assoc($total_expenses_data))
					                  	{
					                  			$total_month_expenses += $expenses_data_rows['amount'];
					                  	}

					                  	while($advance_data_rows = mysqli_fetch_assoc($total_advance_data))
					                  	{
					                  			$total_month_advance += $advance_data_rows['amount'];
					                  	}

					                  	?>

						                    <tr>
						                      <td><?php echo $monthName; ?></td>
						                      <td><?php echo $total_month_payment; ?></td>
						                      <td><?php echo $total_month_advance; ?></td>
						                      <td><?php echo $total_month_expenses; ?></td>
						                      <td><?php echo $total_month_payment-$total_month_expenses; ?></td>
						                    </tr> 
					                  </tbody>
					                <?php } ?>
					                <?php if(date('Y')!=$y) { ?>
						                    <tr>
						                    	<th>
						                    	Total Incom:-
						                      </th>
						                      <th><?php echo $total_income; ?></th>
						                      <th><?php echo $total_income; ?></th>
						                      <th><?php echo $total_expenses; ?></th>
						                      <th><?php echo $total_income-$total_expenses; ?></th>
					                    </tr>
					                  	<?php } ?>
					                </table>
					              </div>
					            </div>
				          	</div>

				    <?php } ?>

          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<?php include_once 'footer.php' ?>