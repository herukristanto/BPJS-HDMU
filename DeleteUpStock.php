<?php
	include "koneksi.php";
	date_default_timezone_set("Asia/Bangkok");

	$id = $_GET['id'];

	$queDet = "select * from T_UpStockBatch where ID = ".$id;
	$queDet_exe = sqlsrv_query($conn,$queDet);
	$detail = sqlsrv_fetch_array($queDet_exe, SQLSRV_FETCH_ASSOC);

	$que = "delete from T_UpStockBatch where ID = '".$id."'";
	$que_exe = sqlsrv_query($conn,$que);

	$queGet = "select Stock from T_CurrentStock where Service_Id = '".$detail['Service_Id']."'";
	$queGet_exe = sqlsrv_query($conn,$queGet);
	$stock = sqlsrv_fetch_array($queGet_exe, SQLSRV_FETCH_ASSOC);

	$newStock = $stock['Stock'] - $detail['Qty'];

	$queUp = "update T_CurrentStock set Stock = '".$newStock."' where Service_Id = '".$detail['Service_Id']."'";
	$queUp_exe = sqlsrv_query($conn,$queUp);
?>
<script type="text/javascript">
	window.location.href = "T_UpdateStock.php";
</script>