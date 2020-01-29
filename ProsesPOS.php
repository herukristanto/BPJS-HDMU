<?php
include "koneksi.php";

if(isset($_GET['patno']))
{
	$patno = $_GET['patno'];
}

if(isset($_GET['caseno']))
{
	$caseno = $_GET['caseno'];
}

$que = "SELECT * FROM T_Case where pat_no = '".$patno."' and case_no = '".$caseno."'";
$sql = sqlsrv_query($conn,$que);
$row = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC);
$pembayar = $row['Pembayar'];

$pembayar1 = substr($pembayar,0,2);

if ($pembayar1 == '72')
{
	$split = "select * from T_Billing where pat_no = '".$patno."' and case_no = '".$caseno."' and Bill_Id like 'S%'";
	$split_exe = sqlsrv_query($conn,$split);
	$splitInv = sqlsrv_fetch_array($split_exe, SQLSRV_FETCH_ASSOC);
	if(is_null($splitInv) == false){
		echo "<script>parent.window.location.href='T_ProsesKwitansi.php?patno=$patno&caseno=$caseno&inv=s';</script>";
	}else{
		echo "<script type='text/javascript'>alert('POS hanya untuk pasien pembayar sendiri');</script>";
	}
}
else
{
	echo "<script>parent.window.location.href='T_ProsesKwitansi.php?patno=$patno&caseno=$caseno';</script>";
}

?>
