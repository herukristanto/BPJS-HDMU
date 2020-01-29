<?php
include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");
session_start();

$page = basename($_SERVER['PHP_SELF']);
$quer = "select count(*) as hasil from M_Authorization where User_ID = '".$_SESSION["username"]."' and Form_ID = '".$page."'";
$sql_execute = sqlsrv_query($conn,$quer);
$rs = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);
if($rs["hasil"] == 0)
{
  echo '<script>
  alert("Anda tidak berhak melakukan perubahan data.");
  window.location="DiagTable.php?case='.$_POST['hidCase'].'";
  </script>';
}
else
{
	echo "Please Wait . . . ";

	if(isset($_POST['hidPatno']))
	{
		$patno = $_POST['hidPatno'];
	}

	if(isset($_POST['hidCase']))
	{
		$caseno = $_POST['hidCase'];
	}

	if(isset($_POST['KodeDiag']))
	{
		$DiagId = $_POST['KodeDiag'];
	}

	$sql = "select count(*) as row from T_Diagnose where Case_No = '".$caseno."' and Diag_Id = '".$DiagId."'";
	$sql_execute = sqlsrv_query($conn,$sql);
	$hasil = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);

	if($sql_execute == false || $hasil['row'] < 1)
	{
	$sql1="insert into T_Diagnose values(".$patno.",'".$caseno."',CONVERT(datetime, '".date('Y/m/d H:i:s')."', 120),'".$DiagId."')";
	$sql_execute1 = sqlsrv_query($conn1,$sql1);
	}
	else
	{
		echo "<script>alert('Kode ".$DiagId." Sudah Pernah Diinput');</script>";	
	}

	echo "<script>
			parent.clear();
			window.location.href = 'DiagTable.php?case=".$caseno."';
		</script>";
		
}

?>
