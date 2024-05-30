<?php include_once 'query.php'; 

function convert_number_to_words($number) {

    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        100000             => 'lakh',
        10000000          => 'crore'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        case $number < 100000:
            $thousands   = ((int) ($number / 1000));
            $remainder = $number % 1000;

            $thousands = convert_number_to_words($thousands);

            $string .= $thousands . ' ' . $dictionary[1000];
            if ($remainder) {
                $string .= $separator . convert_number_to_words($remainder);
            }
            break;
        case $number < 10000000:
            $lakhs   = ((int) ($number / 100000));
            $remainder = $number % 100000;

            $lakhs = convert_number_to_words($lakhs);

            $string = $lakhs . ' ' . $dictionary[100000];
            if ($remainder) {
                $string .= $separator . convert_number_to_words($remainder);
            }
            break;
        case $number < 1000000000:
            $crores   = ((int) ($number / 10000000));
            $remainder = $number % 10000000;

            $crores = convert_number_to_words($crores);

            $string = $crores . ' ' . $dictionary[10000000];
            if ($remainder) {
                $string .= $separator . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}



?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Bill</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">

		<style type="text/css">
			body {
				width: 100%;
				height: 100%;
				margin: 0;
				padding: 0;

			}
			* {
				box-sizing: border-box;
				-moz-box-sizing: border-box;

			}
			.page {
				width: 210mm;
				min-height: 148.5mm;
				padding: 20px;
				margin: 10px auto;
				border-radius: 5px;
				background: white;
			}
			.table td, .table th{
				padding:10px;
			}
			.header{
				background-color: #012918;
				padding: 20px;
				position: relative;
			}
			.main_logo{
				padding-left: 20px;
				display:flex;
				align-items:center;
			}
			.main_logo img{
				width: 175px;
			}
			.main_logo img.guj_logo{
				width:400px;
				margin-left:50px;
			}
			.address{
				color: white;
				text-align: center;
				position: absolute;
				width: 100%;
				text-align: center;
				bottom: 15px;
				left: 0;
				font-size: 18px;
				font-weight: bold;
			}
			.mob_no{
				text-align: right;
				position: absolute;
				top: 5px;
				right: 10px;
				color:white;
			}
			.swami_title{
				color: #fff;
				position: absolute;
				top: 10px;
				left: 50%;
				transform: translateX(-50%);
				width: 100%;
				font-size:14px;
				text-align:center;
			}
			.chalan_title{
				color: #fff;
				font-size: 20px;
				font-weight: bold;
				text-align: center;
				position: absolute;
				bottom: 0;
				right: 0;
				padding: 10px 30px;
				background-color: #7CC439;
			}
			.line{
				text-decoration: underline;
				text-underline-offset: 5px;
				text-decoration-color: #aaa;
			}
			.card-body{
				border: 1px #012918 solid !important;
				min-height: 148.5mm;
			}
			.profile-username{
				margin: 2px 0 2px;
			}
			.cash_digit{
				border: 2px #000 solid;
				display: inline-block;
				padding: 10px 20px 10px 95px;
				border-radius: 5px;
				font-size: 25px;
				font-weight: bold;
				position: relative;

			}
			.cash_digit::before{
				content: '₹';
				height: 100%;
				width: 70px;
				background: #7CC439;
				color: white;
				position: absolute;
				top: 0;left: 0;
				border-radius: 3px 0 0 3px;
				text-align: center;
				display: flex;
				align-items: center;
				justify-content: center;
				font-size: 50px;
			}
			@page {
				size: A4;
				margin: 0;
			}
			@media print {
				html, body {
					width: 210mm;
					height: 297mm;        
				}
				.page {
					margin: 0;
					border: initial;
					border-radius: initial;
					width: initial;
					min-height: initial;
					box-shadow: initial;
					background: initial;
					page-break-after: always;
				}
			}

		</style>

		<!-- Main content -->
		<section class="content mb-4">
			<div class="card page shadow-none m-2">

				<?php while($slip_rows = mysqli_fetch_assoc($pay_slip_data)) { $test = convert_number_to_words($slip_rows["amount"]); ?>
				<!-- Receipt 1 -->
						<div class="card-body myTableBg4 p-0 mb-5">
							<div class="header mb-1">
								<div class="mob_no">
									<b>
										Off. Mo. +91 78628 83381<br>
										Off. Mo. +91 93289 09006<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mo. +91 63558 90035<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mo.  +91 97244 70044
									</b>	
								</div>
								<div class="swami_title">
									<b>।। શ્રી સ્વામિનારાયણ ।।</b>											
								</div>
								<div class="main_logo">
									<img src="assets/dist/img/nursery_logo.svg">
									<img src="assets/dist/img/guj_logo.svg" class="guj_logo" alt="">

								</div>
								<div class="address">
									એડ્રેસ : મુ. પો. અરેઠ, બૌધાન રોડ, તા.માંડવી, જી. સુરત.
								</div>
								<div class="chalan_title">
									Cash Receipt
								</div>
							</div>
							<div class="p-3">
								<table width="100%" class="mb-3">
									<tr>
										<td width="50%">
											<h5 class="profile-username font-weight-bold">Date : <span class=""><?php $date_slip = explode('-',$slip_rows['date']); echo $date_slip[2].'-'.$date_slip[1].'-'.$date_slip[0]; ?></span></h5>
										</td>
										<td width="50%" align="right">
											<h5 class="profile-username font-weight-bold">Receipt No. : <span class="">P.<?php echo $slip_rows['p_id']; ?></span></h5>
										</td>
									</tr>
								</table>
								<table class="table mb-0" align="center">							
									<tr>
										<td colspan="2">                              
											<h5 class="profile-username font-weight-bold">
												M/s : 
												<span class="font-weight-normal"><?php echo $slip_rows['name']; ?></span>
											</h5>
										</td>
									</tr>
									<tr>
										<td colspan="2">                              
											<h5 class="profile-username font-weight-bold">
												Cheque / Cash : 
												<span class="font-weight-normal"><?php if($slip_rows['payment_mode']==1) { echo "BY UPI"; }else if($slip_rows['payment_mode']==2) { echo "BY Bank Transfer"; }else if($slip_rows['payment_mode']==3) { echo "BY Cheque"; }else{ echo "BY Cash "; } ?></span>
											</h5>
										</td>
									</tr>
									<tr>
										<td colspan="2">
											<h5 class="profile-username font-weight-bold text-left">
												Bank Name : 
												<span class="font-weight-normal"><?php echo $slip_rows['bank_name']; ?></span>
											</h5>
										</td>    
									</tr>
									<tr>
										<td>
											<h5 class="profile-username font-weight-bold text-left">
												Cheque Date : 
												<span class="font-weight-normal"><?php echo $slip_rows['cheque_date']; ?></span>
											</h5>
										</td> 
										<td>
											<h5 class="profile-username font-weight-bold text-left">
												Detail : 
												<span class="font-weight-normal"><?php echo $slip_rows['extra_note']; ?></span>
											</h5>
										</td>    
									</tr>
									<tr>
										<td colspan="2">
											<h5 class="profile-username font-weight-bold text-left d-flex">
												<span>Amount (In Words) : </span>
												<div class="font-weight-normal">&nbsp;<?php echo $test; ?> Only.</div>
											</h5>
										</td>    
									</tr>
								</table>  
								<br>
								<table width="100%" class="mb-3">
									<tr>
										<td width="33.33%">
											<div class="cash_digit">
											 <?php echo $slip_rows["amount"]; ?>/-
											</div>
										</td> 
				            <td width="33.33%" align="left" valign="bottom">
				              ______________________________________<br> 
				              <h5 class="font-weight-bold ml-4 mb-0">Signature of Lender</h5>
				            </td>
				            <td width="33.33%" align="right" valign="bottom">
				              _________________________________________ 
				              <h5 class="font-weight-bold mr-4 mb-0">For, Shree Hari Nursery</h5>
				            </td>
				          </tr>
								</table>
							</div>
						</div>

				<!-- Receipt 2 -->
						<div class="card-body myTableBg4 p-0">
							<div class="header mb-1">
								<div class="mob_no">
									<b>
										Off. Mo. +91 93289 09006<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mo. +91 63558 90035<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mo.  +91 78628 83381
									</b>	
								</div>
								<div class="swami_title">
									<b>।। શ્રી સ્વામિનારાયણ ।।</b>											
								</div>
								<div class="main_logo">
									<img src="assets/dist/img/nursery_logo.svg">
									<img src="assets/dist/img/guj_logo.svg" class="guj_logo" alt="">

								</div>
								<div class="address">
									એડ્રેસ : મુ. પો. અરેઠ, બૌધાન રોડ, તા.માંડવી, જી. સુરત.
								</div>
								<div class="chalan_title">
									Cash Receipt
								</div>
							</div>
							<div class="p-3">
								<table width="100%" class="mb-3">
									<tr>
										<td width="50%">
											<h5 class="profile-username font-weight-bold">Date : <span class=""><?php $date_slip = explode('-',$slip_rows['date']); echo $date_slip[2].'-'.$date_slip[1].'-'.$date_slip[0]; ?></span></h5>
										</td>
										<td width="50%" align="right">
											<h5 class="profile-username font-weight-bold">Receipt No. : <span class="">P.<?php echo $slip_rows['p_id']; ?></span></h5>
										</td>
									</tr>
								</table>
								<table class="table mb-0" align="center">							
									<tr>
										<td colspan="2">                              
											<h5 class="profile-username font-weight-bold">
												M/s : 
												<span class="font-weight-normal"><?php echo $slip_rows['name']; ?></span>
											</h5>
										</td>
									</tr>
									<tr>
										<td colspan="2">                              
											<h5 class="profile-username font-weight-bold">
												Cheque / Cash : 
												<span class="font-weight-normal"><?php if($slip_rows['payment_mode']==1) { echo "BY UPI"; }else if($slip_rows['payment_mode']==2) { echo "BY Bank Transfer"; }else if($slip_rows['payment_mode']==3) { echo "BY Cheque"; }else{ echo "BY Cash "; } ?></span>
											</h5>
										</td>
									</tr>
									<tr>
										<td colspan="2">
											<h5 class="profile-username font-weight-bold text-left">
												Bank Name : 
												<span class="font-weight-normal"><?php echo $slip_rows['bank_name']; ?></span>
											</h5>
										</td>    
									</tr>
									<tr>
										<td>
											<h5 class="profile-username font-weight-bold text-left">
												Cheque Date : 
												<span class="font-weight-normal"><?php echo $slip_rows['cheque_date']; ?></span>
											</h5>
										</td> 
										<td>
											<h5 class="profile-username font-weight-bold text-left">
												Detail : 
												<span class="font-weight-normal"><?php echo $slip_rows['extra_note']; ?></span>
											</h5>
										</td>    
									</tr>
									<tr>
										<td colspan="2">
											<h5 class="profile-username font-weight-bold text-left d-flex">
												<span>Amount (In Words) : </span>
												<div class="font-weight-normal"> &nbsp;<?php echo $test; ?> Only.</div>
											</h5>
										</td>    
									</tr>
								</table>  
								<br>
								<table width="100%" class="mb-3">
									<tr>
										<td width="33.33%">
											<div class="cash_digit">
											 <?php echo $slip_rows["amount"]; ?>/-
											</div>
										</td> 
				            <td width="33.33%" align="left" valign="bottom">
				              ______________________________________<br> 
				              <h5 class="font-weight-bold ml-4 mb-0">Signature of Lender</h5>
				            </td>
				            <td width="33.33%" align="right" valign="bottom">
				              _________________________________________ 
				              <h5 class="font-weight-bold mr-4 mb-0">For, Shree Hari Nursery</h5>
				            </td>
				          </tr>
								</table>
							</div>
						</div>
				<?php } ?>
			</div>

		</section>

		<script type="text/javascript">
			window.onload=function(){
				window.print();
			}
		</script>




