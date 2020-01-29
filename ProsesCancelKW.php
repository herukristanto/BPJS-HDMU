<?php
include "koneksi.php";

session_start();

if(isset($_GET['no']))
{
	$noKW = $_GET['no'];
}
if(isset($_GET['usrname']))
{
	$usrname = $_GET['usrname'];
	echo $_GET['usrname'];
	$queName = "select Name from M_User where User_Id = '".$usrname."'";
	$queName_exe = sqlsrv_query($conn,$queName);
	if($queName_exe){
		$res = sqlsrv_fetch_array($queName_exe, SQLSRV_FETCH_ASSOC);
		$nam = $res['Name'];
	}
}

$terminal = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$terminal = str_replace(".MMU.LOCAL.ID","",$terminal);
$terminal = str_replace(".MMU","",$terminal);

if($terminal == '192.168.2.60'){
	$terminal = "rumpin-laptop";
}elseif($terminal == '192.168.2.61'){
	$terminal = "Rumpin-1";
}elseif($terminal == '192.168.2.62'){
	$terminal = "Rumpin-2";
}

$que = "select * from V_SessionOpen where User_Id = '".$usrname."' and Terminal_Id = '".$terminal."'";
$que_exe = sqlsrv_query($conn,$que, array(), array( "Scrollable" => 'static' ));
$count = sqlsrv_num_rows($que_exe);
$hasil1 = sqlsrv_fetch_array($que_exe, SQLSRV_FETCH_ASSOC);
if($count != 1){
	echo "
		<script>
			alert('".$que."');
			alert('Open Collection sebelum melakukan POS');
			window.location.href = 'T_CancelKwitansi.php';
		</script>
	";
}


$datekw = date('Y-m-d');
$bulan = substr($datekw,5,2);
$tahun = substr($datekw,0,4);

//------------------------------------------------------------------
$que = "SELECT * FROM T_POS where pay_id = '".$noKW."'";
$sql = sqlsrv_query($conn1,$que);

while($hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)){
	if($hasil['Reference_No'] != '')
	{
		echo "<script type='text/javascript'>alert('Nomor Kwitansi Sudah Pernah Dicancel');</script>";
		echo "<script>window.location.href='T_CancelKwitansi.php';</script>";
		break;
	}
	else
	{
		$que1 = "select * from T_RunNumKW where tahun = '".$tahun."' and bulan = '".$bulan."'";
		$sql1 = sqlsrv_query($conn2,$que1);
		$row1 = sqlsrv_fetch_array($sql1, SQLSRV_FETCH_ASSOC);
		$payno = $row1['NoUrut'];

		if ($sql1)
		{
			$noUrut = (int) $payno;
			$noUrut++;
			$id = "P-";
			$KWno = $id.$tahun.'-'.$bulan.'-'.sprintf("%04s",$noUrut);
			$noUrut1 = sprintf("%04s",$noUrut);

			$queUp = "update T_RunNumKW set NoUrut = '".$noUrut1."' where tahun = '".$tahun."' and bulan = '".$bulan."'";
		}
		else
		{
			$KWno = 'P-'.$tahun.'-'.$bulan.'-0001';
			$queUp = "insert into T_RunNumKW values('".$tahun."','".$bulan."','0001')";
		}

		$sql2 = "update T_POS set reference_no = '".$KWno."' where pay_id = '".$noKW."'";
		$sql_execute = sqlsrv_query($conn2,$sql2);
		$up_execute = sqlsrv_query($conn3,$queUp);

		$quePOS = "select * from T_POS where pay_id = '".$noKW."'";
		$quePOS_execute = sqlsrv_query($conn,$quePOS);
		$rs = sqlsrv_fetch_array($quePOS_execute, SQLSRV_FETCH_ASSOC);


		$querefund = "insert into T_Refund values('".$KWno."','".$rs['Bill_Id']."','','',".$rs['Disc_Amt'].",".$rs['Amount'].",'".$noKW."',' ','".$hasil1['Session_Id']."','".$hasil1['Terminal_Id']."','".$_SESSION['username']."',CONVERT(datetime, '".date('Y/m/d H:i:s')."', 120));";

		// $quedel = "Delete from T_ClearPayment where Pay_id = '".$noKW."'";
		
		// echo $querefund;

		$querefund_execute = sqlsrv_query($conn,$querefund);
		// $quedel_execute = sqlsrv_query($conn,$quedel);

		echo "<script>window.location.href='T_Refund.php?payno=".$noKW."&no=".$KWno."&usrname=".$nam."';</script>";
		break;
	}
}
if($hasil == false){
	echo "<script type='text/javascript'>alert('Nomor Kwitansi Tidak Ditemukan');</script>";
	echo "<script>window.location.href='T_CancelKwitansi.php';</script>";
}
?>
