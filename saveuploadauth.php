<?php
include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

$TData = $_POST['myData'];
foreach($TData as $row) {
	$que = "insert into M_Authorization values('".$row[0]."','".$row[1]."','Admin',CONVERT(datetime, '".date('Y/m/d H:i:s')."', 120))";
	$que_execute = sqlsrv_query($conn, $que);
	echo $que;
}