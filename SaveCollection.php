<?php
include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

$userID = $_GET["user"];

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

$Datecollection = date('Y/m/d');
$curtime = date('H:i');

if($_GET["cmd"] == "open"){
	$queses = "select * from T_Collection where User_Id = '".$userID."' and Terminal_Id = '".$terminal."' and start_date = '".$Datecollection."' order by ID DESC";
	$queses_exe = sqlsrv_query($conn,$queses);
	$row = sqlsrv_fetch_array($queses_exe, SQLSRV_FETCH_ASSOC);

	if(isset($row)){
		$session = (int)$row["Session_Id"] + 1;
	}else{
		$session = 1;
	}

	$queins = "insert into T_Collection ([user_id],terminal_id,session_id,start_date,start_time) values('".$userID."','".$terminal."','".$session."','".$Datecollection."','".$curtime."')";
	$queins_exe = sqlsrv_query($conn1,$queins);

	echo "<script>window.location.href = 'T_Collection.php';</script>";

}else if($_GET["cmd"] == "close"){
	$session = $_GET["session"];

	$queup = "update T_Collection set End_Date = '".$Datecollection."', End_Time = '".$curtime."' where User_Id = '".$userID."' and Terminal_Id = '".$terminal."' and Session_Id = '".$session."' and End_Date is null";
	$queup_exe = sqlsrv_query($conn,$queup);

	echo "<script>window.location.href = 'T_EditCollection.php?session=".$session."';</script>";
}


?>
