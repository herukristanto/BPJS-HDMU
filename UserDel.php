<?php
include "koneksi.php";

$id = $_GET['id'];
$message;

$sql1 = "select count(*) as hasil from M_User where User_Id = '".$id."'";
$sql_execute1 = sqlsrv_query($conn1,$sql1); 
$hasil = sqlsrv_fetch_array($sql_execute1);

if($hasil['hasil'] == 1)
{
	$sql = "delete M_User where User_Id = '".$id."';";
	$sql_execute = sqlsrv_query($conn,$sql);
	$message = "User berhasil dihapus";
}
else
{
	$message = "User tidak ditemukan";	
}

echo '<script>
	alert("'.$message.'");
	window.location = "UserForm.php"
	</script>';
?>