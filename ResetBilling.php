<?php
include "koneksi.php";

if(isset($_GET['invno']))
{
	$invno = $_GET['invno'];
}

$que = "SELECT Bill_Id as invNo FROM T_POS where Bill_Id = '".$invno."' and Reference_No = ''";
$sql = sqlsrv_query($conn,$que);
$row = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC);
$billno = $row['invNo'];
if (is_null($billno) == true)
{
	$queRef = "SELECT Ref FROM T_Billing where Bill_Id = '".$invno."'";
	$queRef_exe = sqlsrv_query($conn,$queRef);
	$ref = sqlsrv_fetch_array($queRef_exe, SQLSRV_FETCH_ASSOC);
	if($ref['Ref'] != ''){
		echo "
			<script type='text/javascript'>
				alert('Reset split invoice terlebih dahulu.');
				window.location.href='T_ResetBilling.php';
			</script>";
	}else{
		$sql1 = "update T_Billing set status = 'C' where Bill_Id = '".$invno."'";
		$sql_execute = sqlsrv_query($conn1,$sql1);

		$sql2 = "update T_Service set Billed = '' where Billed = '".$invno."'";
		$sql_execute1 = sqlsrv_query($conn1,$sql2);
		
		$sql3 = "delete T_Insurance where Bill_Id = '".$invno."'";
		$sql_execute2 = sqlsrv_query($conn1,$sql3);
		echo "
			<script type='text/javascript'>
				alert('Reset Billing Berhasil');
				window.location.href='T_ResetBilling.php';
			</script>";
	}

	
}
else
{
	echo "
		<script type='text/javascript'>
			alert('Reset Billing Gagal, Sudah Dilakukan POS');
			window.location.href='T_ResetBilling.php';
		</script>";
}
?>
