<?php
	include "koneksi.php";
	session_start();
	date_default_timezone_set("Asia/Bangkok");
	ini_set('memory_limit', '-1');

	$arr = $_POST["myData"];

	$patno = $_POST["pat"];
	$caseno = $_POST["case"];

	$datebill = date('Y-m-d');

	$que = "SELECT max(Bill_Id) as invNo FROM T_Billing where Bill_Id like 'S%'";
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
			$id = "S-";
			$invno = $id.substr($datebill,0,4).'-'.substr($datebill,5,2).'-'.sprintf("%04s",$noUrut);
		}
		else
		{
			$invno = 'S-'.substr($datebill,0,4).'-'.substr($datebill,5,2).'-0001';
		}
	}
	else
	{
		$invno = 'S-'.substr($datebill,0,4).'-'.substr($datebill,5,2).'-0001';
	}

	$total = 0;
	$sql = '';
	foreach ($arr as $line) {
		if(intval($line[1]) != 0){
			$amt = intval($line[1]) * -1;
			$sql = $sql."insert into T_Billing values('".$patno."','".$caseno."','".$line[0]."',".$amt.",'X','','".$_SESSION["username"]."',CONVERT(datetime, '".date('Y/m/d H:i:s')."', 120));";
			$total = $total + intval($line[1]);
			
			$sql = $sql."update T_Billing set Ref = '".$invno."' where Bill_Id = '".$line[0]."';";
		}
	}

	$sql = $sql."insert into T_Billing values('".$patno."','".$caseno."','".$invno."',".$total.",'X','','".$_SESSION["username"]."',CONVERT(datetime, '".date('Y/m/d H:i:s')."', 120));";

	$sql_exe = sqlsrv_query($conn1,$sql);

	echo "Split Invoice berhasil - ".$invno;




	// $sql1 = "insert into T_Billing values('".$patno."','".$caseno."','".$invno."','".$amt."','X','".$user."',CONVERT(datetime, '".date('Y/m/d H:i:s')."', 120))";
	// $sql_execute = sqlsrv_query($conn1,$sql1);

?>