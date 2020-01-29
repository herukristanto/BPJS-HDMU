<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Service - Create</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
<!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet"> -->
<link href="css/fontGoogle.css" rel="stylesheet">
<link href="css/css/font-awesome.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/pages/dashboard.css" rel="stylesheet">
<script src="js/jquery-1.7.2.min.js"></script>
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
<style>
td{
	padding-left: 3px;
	height: 30px;
}
td.mid{
	padding-left: 0px;
	text-align: center;
}
</style>

<!-- ========== Datetime Picker ========== -->
<!-- format tanggal php di ubah menjadi m/d/y mengikuti format JqueryUI -->
	<link rel="stylesheet" href="css/jquery-ui.min.css"> 
	<script src="js/jquery-ui.min.js"></script>
	<script>
		$( function() {
			$( ".datepicker" ).datepicker();
			$( ".datepicker" ).datepicker( "option", "dateFormat", 'dd/mm/yy' );
		} );
	</script>
<!-- ===================================== -->

</head>
<body onload="fillvalid();">
<?php include "header_mstr.php" ?>
<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12 mainPage">
					<form action="M_Service_Save.php" method="post" onsubmit="return validate();">
						<button type="submit" class="btn">Save</button>
						<button type="reset" class="btn">Reset</button>
						<button type="button" class="btn closeMstr">Exit</button>
						<br><br>

						<table>
							<tr>
								<td width="120">Kode Service</td>
								<td width="15"> : </td>
								<td colspan="2"><input type="text" id="service" name="service" maxlength="10" required>
							<tr>
								<td>Deskripsi</td>
								<td> : </td>
								<td colspan="2"><input type="text" id="deskripsi" name="deskripsi" maxlength="100" required></td>
							</tr>
							<tr>
								<td>Unit</td>
								<td> : </td>
								<td colspan="2">
									<select type="text" id="unit" name="unit">
									<?php
										include "koneksi.php";

										$queUnit = "select * from M_Unit order by Unit";
										$queUnit_exe = sqlsrv_query($conn,$queUnit);

										while($row = sqlsrv_fetch_array($queUnit_exe, SQLSRV_FETCH_ASSOC)){
											echo "<option value='".trim($row['Unit'])."'>".trim($row['Unit'])."</option>";
										}
									?>
									</select>
								</td>
							</tr>
							<tr>
								<td>Potong Stok</td>
								<td> : </td>
								<td><input type="radio" name="stok" value="X" checked> Ya</td>
								<td><input type="radio" name="stok" value=" "> Tidak</td>
							</tr>
							<tr>
								<td>Servis Dokter</td>
								<td> : </td>
								<td><input type="radio" name="dok" id="rbya" value="X"> Ya</td>
								<td><input type="radio" name="dok" id="rbtdk" value=" " checked> Tidak</td>
							</tr>
							<tr>
								<td>Display Servis</td>
								<td> : </td>
								<td><input type="radio" name="disp" id="dispya" value="X" checked> Ya</td>
								<td><input type="radio" name="disp" id="disptdk" value=" "> Tidak</td>
							</tr>
							<tr>
								<td>Service Group</td>
								<td> : </td>
								<td><input type="radio" name="srvgrp" id="frm" value="FRM"> Farmasi</td>
								<td><input type="radio" name="srvgrp" id="mmd" value="MMD"> MMD</td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td><input type="radio" name="srvgrp" id="oth" value="OTH" checked> Lainnya</td>
								<td></td>
							</tr>
							<tr>
								<td>Valid From</td>
								<td> : </td>
								<td colspan="2"><input type="text" class="datepicker" id="datepicker" name="validfrom" required></td>
							</tr>
							<tr>
								<td>Valid To</td>
								<td> : </td>
								<td colspan="2"><input type="text" class="datepicker" id="datepicker1" name="validto" required></td>
							</tr>
						</table>

						<input type="hidden" name="mode" value="create">
					</form>

					<?php include "M_Service_Search.php"; ?>
				</div>
				<!-- /span12 -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /main-inner -->
</div>
<!-- /main -->
<?php include "footer.html"; ?>

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script>
	function validate(){
		var validfrom = document.getElementById('datepicker').value;
		var validto = document.getElementById('datepicker1').value;

		if(validfrom > validto){
			alert("Valid From tidak boleh lebih besar dari Valid To");
			document.getElementById('datepicker').focus();
			return false;
		}else{
			return true;
		}
	}
	function fillvalid(){
		document.getElementById('datepicker1').value = "31/12/9999";
	}
</script>
	
<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script src="js/base.js"></script>

</body>
</html>
