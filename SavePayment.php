<?php
include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

$ins = "";

$colID = $_POST["colID"];

if(isset($_POST['myData'])){
	$TData = $_POST["myData"];
	
	foreach($TData as $row) {
		$ins = $ins." insert into D_Collection values('".$colID."','".$row[0]."',".$row[1].");";
	}
	$ins_execute = sqlsrv_query($conn,$ins);
}

echo "Data Berhasil Disimpan";	
?>