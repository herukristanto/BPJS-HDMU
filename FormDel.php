<?php
include "koneksi.php";

$id = $_GET['id'];
$message;

$sql1 = "select count(*) as hasil from M_Form where Form_Id = '".$id."'";
$sql_execute1 = sqlsrv_query($conn1,$sql1); 
$hasil = sqlsrv_fetch_array($sql_execute1);

if($hasil['hasil'] == 1)
{
	$sql = "delete M_Form where Form_Id = '".$id."'";
	$sql_execute = sqlsrv_query($conn,$sql);
	$message = "Data berhasil dihapus";
}
else
{
	$message = "Data tidak ditemukan";	
}

echo '<script>
	alert("'.$message.'");
	window.location = "FormManagement.php"
	</script>';
?>