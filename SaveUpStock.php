<?php
	include "koneksi.php";
	date_default_timezone_set("Asia/Bangkok");

	$kode = $_POST['scode'];
	$desc = $_POST['sdesc'];
	$qty = $_POST['stock'];
	$unit = $_POST['unit'];
	$ket = $_POST['ket'];

	$que = "insert into T_UpStockBatch (Create_Date,Service_Id,Descp,Qty,Unit,Keterangan) values (CONVERT(datetime, '".date('Y-m-d H:i:s')."', 120),'".$kode."','".$desc."',".$qty.",'".$unit."','".$ket."')";
	$que_exe = sqlsrv_query($conn,$que);

	$queGet = "select Stock from T_CurrentStock where Service_Id = '".$kode."'";
	$queGet_exe = sqlsrv_query($conn,$queGet);
	$stock = sqlsrv_fetch_array($queGet_exe, SQLSRV_FETCH_ASSOC);

	$newStock = $stock['Stock'] + $qty;

	$queUp = "update T_CurrentStock set Stock = '".$newStock."' where Service_Id = '".$kode."'";
	$queUp_exe = sqlsrv_query($conn,$queUp);
?>
<script type="text/javascript">
	window.location.href = "T_UpdateStock.php";
</script>