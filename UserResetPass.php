<?php
include "koneksi.php";

$id = $_GET['id'];
$message;

$sql1 = "select count(*) as hasil from M_User where User_Id = '".$id."'";
$sql_execute1 = sqlsrv_query($conn1,$sql1); 
$hasil = sqlsrv_fetch_array($sql_execute1);

if($hasil['hasil'] == 1)
{
	$sql = "update M_User set Password = '731' where User_Id = '".$id."'";
	$sql_execute = sqlsrv_query($conn,$sql);
	$message = "Password berhasil direset menjadi 'hdmu'";	
}
else
{
	$message = "User tidak ditemukan, reset password gagal.";	
}

echo '<script>
	alert("'.$message.'");
	window.location = "UserForm.php"
	</script>';
?>