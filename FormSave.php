<?php
include "koneksi.php";

$formid = $_GET['formid'];
$formname = $_GET['formname'];
$message = "";

$sql = "select count(*) as hasil from M_Form where Form_Id = '".$formid."'";
$sql_execute = sqlsrv_query($conn,$sql);
$hasil = sqlsrv_fetch_array($sql_execute);

if($hasil['hasil'] == 0) {
	$sql = "INSERT INTO M_Form(Form_Id, Form_Name, Create_By, Create_Time) values('".$formid."','".$formname."','admin',CONVERT(datetime, '".date('Y/m/d H:i:s')."', 120))";
	$message = "Form berhasil disimpan";
} else {
	$sql = "UPDATE M_Form set Form_Name = '".$formname."' where Form_Id = '".$formid."'";
	$message = "Form berhasil diganti";
}

$sql_execute = sqlsrv_query($conn,$sql);

echo '<script>
alert("'.$message.'");
window.location = "FormManagement.php";
</script>';
?>