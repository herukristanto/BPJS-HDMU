<?php
include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

if(isset($_GET['no']))
{
	$invno = $_GET['no'];
}

$sql = "select * from T_Insurance where bill_id = '".$invno."'";
$sql_execute = sqlsrv_query($conn,$sql);

if($sql_execute == true)
{
	$sql1 = "update T_Insurance set clear = '',c_date = null,c_by = null where bill_id = '".$invno."'";
	$sql_execute1 = sqlsrv_query($conn1,$sql1);
	echo "<script>alert('Reset Clearing Berhasil');window.location.href='T_ResetClearing.php';</script>";
}
else
{
	echo "<script>alert('Reset Clearing Gagal');window.location.href='T_ResetClearing.php';</script>";
}

?>
