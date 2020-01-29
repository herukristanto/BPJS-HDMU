<?php
include "koneksi.php";

$formid = $_GET['formid'];
$formnama = $_GET['formnama'];
$message = "";

$sql = "select count(*) as hasil from M_Form where Form_Id = '".$formid."'";
$sql_execute = sqlsrv_query($conn,$sql);
$hasil = sqlsrv_fetch_array($sql_execute);

if($hasil['hasil'] == 0) {
	$sql = "INSERT INTO M_Form(Form_Id, Form_Name, Create_By, Create_Time) values('".$formid."','".$formnama."','admin',CONVERT(datetime, '".date('Y/m/d H:i:s')."', 120))";
	$message = "Form berhasil disimpan";
} else {
	$message = "Form sudah tercatat dalam sistem";
}

$sql_execute = sqlsrv_query($conn,$sql);

echo '<script>
alert("'.$message.'");
window.location = "FormManagement.php"
</script>';
?>