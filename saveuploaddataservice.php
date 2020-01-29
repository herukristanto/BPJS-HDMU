<?php
include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

$TData = $_POST['myData'];
foreach($TData as $row) {

	if ($row[2] == "X") {
		$stok = $row[2];
	} else {
		$stok = "";
	}

	$sql = "select * from M_Service where Service_Id = '".$row[0]."'";
	$sql_execute = sqlsrv_query($conn, $sql, array(), array( "Scrollable" => 'static' ));
	$hitungbaris = sqlsrv_num_rows($sql_execute);

	if ($hitungbaris > 0){
		$sql = "select * from M_Service where Service_Id = '".$row[0]."'";
		$sql_execute = sqlsrv_query($conn,$sql);
		$hasil = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);
		$cekstok = $hasil['Stock'];
		if ($cekstok == $stok) {

		} else {
			$sql = "UPDATE M_Service SET Stock = '".$stok."', Unit = '".$row[3]."' WHERE Service_Id = '".$row[0]."'";
			$sql_execute = sqlsrv_query($conn,$sql);
		}
	} else {
		$sql = "INSERT INTO M_Service VALUES('".$row[0]."','".$row[1]."','".$stok."','".$row[3]."',CONVERT(datetime, '".date('d/m/Y')."', 103),CONVERT(datetime,'31-12-9999', 103),'Admin',CONVERT(datetime, '".date('Y/m/d H:i:s')."', 120))";
		$sql_execute = sqlsrv_query($conn,$sql);
	}
}