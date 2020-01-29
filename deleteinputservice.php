<?php
$nopasien = $_GET['nopasien'];
$nocase = $_GET['nocase'];

include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

$sql = "DELETE FROM T_Service WHERE Pat_No='".$nopasien."' AND Case_No='".$nocase."'";
$sql_execute = sqlsrv_query($conn,$sql);

if ($sql) {
	echo "Berhasil";
} else {
	echo "Gagal";
}
?>