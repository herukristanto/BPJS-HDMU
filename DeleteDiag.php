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
	if(isset($_GET['case']))
	{
		$caseno = $_GET['case'];
	}

	if(isset($_GET['diag']))
	{
		$DiagId = $_GET['diag'];
	}

	$sql="delete from T_Diagnose where Case_No = '".$caseno."' and Diag_Id = '".$DiagId."'";
	$sql_execute = sqlsrv_query($conn,$sql);

	echo "<script>
			window.location.href = 'DiagTable.php?case=".$caseno."';
		</script>";
}
?>