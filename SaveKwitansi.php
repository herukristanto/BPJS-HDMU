<?php
include 'koneksi.php';
date_default_timezone_set("Asia/Bangkok");

$datebill = date('Y-m-d');
$bulan = substr($datebill,5,2);
$tahun = substr($datebill,0,4);

$que = "select * from T_RunNumKW where tahun = '".$tahun."' and bulan ='".$bulan."'";
$sql = sqlsrv_query($conn,$que);
$row = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC);
$recno = $row['NoUrut'];
if ($row)
{
	$noUrut = (int) $recno;
	$noUrut++;
	$id = "P-";
	$PayId = $id.$tahun.'-'.$bulan.'-'.sprintf("%04s",$noUrut);
	$noUrut1 = sprintf("%04s",$noUrut);

	$queUp = "update T_RunNumKW set NoUrut = '".$noUrut1."' where tahun = '".$tahun."' and bulan = '".$bulan."'";
}
else
{
	$PayId = 'P-'.$tahun.'-'.$bulan.'-0001';
	$queUp = "insert into T_RunNumKW values('".$tahun."','".$bulan."','0001')";
}
//echo $queUp;
$TData = $_POST['myData'];

session_start();

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

$queCol = "select * from V_SessionOpen where User_Id = '".$_SESSION["username"]."' and Terminal_Id = '".$terminal."'";
$que_exe = sqlsrv_query($conn,$queCol);
$collection = sqlsrv_fetch_array($que_exe, SQLSRV_FETCH_ASSOC);

$ins = '';
foreach($TData as $row) {
	$ins = $ins." insert into T_POS values('".$PayId."','".$row[0]."','".$row[1]."','".$row[4]."',".$row[2].",".$row[3].",'','','".$collection['Session_Id']."','".$collection['Terminal_Id']."','".$collection['User_Id']."',CONVERT(datetime, '".date('Y/m/d H:i:s')."', 120));";
	
	$que1 = "Insert into T_ClearPayment values(CONVERT(datetime, '".date('Y/m/d')."', 120),'".$PayId."','','',CONVERT(datetime, '".date('Y/m/d H:i:s')."', 120))";
	// echo $que1;
}
$ins_execute = sqlsrv_query($conn1,$ins);
$up_execute = sqlsrv_query($conn2,$queUp);
$que1_exe = sqlsrv_query($conn,$que1);

// echo $PayId;
?>
