<?php
$nopasien = $_GET['nopasien'];
$nocase = $_GET['nocase'];
$totalbiaya = $_GET['totalbiaya'];
$kondisi = $_GET['kondisi'];

include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

$sql = "SELECT * FROM T_Billing WHERE Pat_No LIKE '".$nopasien."' AND Case_No LIKE '".$nocase."'";
$sql_execute = sqlsrv_query($conn, $sql, array(), array( "Scrollable" => 'static' ));
$hitungbaris = sqlsrv_num_rows($sql_execute);

if ($kondisi == "Create Bill") {
	$sql = "INSERT INTO T_Billing VALUES('".$nopasien."','".$nocase."','','".$totalbiaya."','','Admin',CONVERT(datetime, '".date('Y/m/d H:i:s')."', 120))";
	$sql_execute = sqlsrv_query($conn,$sql);
} else if ($kondisi == "Update Bill"){
	$sql = "UPDATE T_Billing SET Amount = '".$totalbiaya."' WHERE Pat_No LIKE '".$nopasien."' AND Case_No LIKE '".$nocase."' AND Bill_Id=''";
	$sql_execute = sqlsrv_query($conn,$sql);
}
?>