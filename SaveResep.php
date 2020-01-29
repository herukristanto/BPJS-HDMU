<?php
include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

session_start();

echo '<script type="text/javascript" src="Script/jquery-1.7.2.min.js"></script>';

if(isset($_POST['hidPatno']))
{
	$patno = $_POST['hidPatno'];
}

if(isset($_POST['hidCase']))
{
	$caseno = $_POST['hidCase'];
}

if(isset($_POST['rNote']))
{
	$resep = $_POST['rNote'];
}

$sql = "insert into T_Resep values('".$patno."','".$caseno."','".$_SESSION['username']."',CONVERT(datetime, '".date('Y/m/d H:i:s')."', 120),'".$resep."')";
$sql_execute = sqlsrv_query($conn,$sql);

echo "
	<script>
		alert('Data Berhasil Disimpan');
	</script>
";
?>
