<?php
include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

echo '<script type="text/javascript" src="Script/jquery-1.7.2.min.js"></script>';

if(isset($_GET['pat']))
{
	$patno = $_GET['pat'];
}

if(isset($_GET['case']))
{
	$caseno = $_GET['case'];
}

if(isset($_GET['pembayar']))
{
	$pembayar = $_GET['pembayar'];
}

if(isset($_GET['amount']))
{
	$amt = $_GET['amount'];
}

$datebill = date('Y-m-d');
$user = $_GET['usrname'];

$que = "SELECT max(Bill_Id) as invNo FROM T_Billing where Bill_Id like 'I%'";
$sql = sqlsrv_query($conn,$que);
$row = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC);
$billno = $row['invNo'];
if (is_null($billno) == false)
{
	$bulan = substr($billno,7,2);
	if ($bulan == substr($datebill,5,2))
	{
		$noUrut = (int) substr($billno,10,4);
		$noUrut++;
		$id = "I-";
		$invno = $id.substr($datebill,0,4).'-'.substr($datebill,5,2).'-'.sprintf("%04s",$noUrut);
	}
	else
	{
		$invno = 'I-'.substr($datebill,0,4).'-'.substr($datebill,5,2).'-0001';
	}
}
else
{
	$invno = 'I-'.substr($datebill,0,4).'-'.substr($datebill,5,2).'-0001';
}

$queUpSrvc = "update T_Service set Billed = '".$invno."' where Pat_No = ".$patno." and Case_No = ".$caseno." and (Billed is null or Billed = '')";
$queUpSrvc_execute = sqlsrv_query($conn3,$queUpSrvc);

//$sql1 = "update T_Billing set Bill_Id = '".$invno."',status = 'X' where case_no = '".$caseno."'";
$sql1 = "insert into T_Billing values('".$patno."','".$caseno."','".$invno."','".$amt."','X','','".$user."',CONVERT(datetime, '".date('Y/m/d H:i:s')."', 120))";
$sql_execute = sqlsrv_query($conn1,$sql1);

$pembayar1 = substr($pembayar,0,2);
if ($pembayar1 == '72')
{
	$sql2 = "insert into T_Insurance values(".$pembayar.",'".$invno."','',null,null)";
	$sql_execute1 = sqlsrv_query($conn2,$sql2);
}
echo "
	<script>
		parent.getInv('".$invno."');
	</script>
";
?>
