<?php
include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

if(isset($_POST['hidUser']))
{
	$userID = $_POST['hidUser'];
}

if(isset($_POST['app_id']))
{
	$no = $_POST['app_id'];
}

if(isset($_POST['Patno']))
{
	$patno = $_POST['Patno'];
	if($patno == ''){
		$patno = 'null';
	}
}

if(isset($_POST['Nama']))
{
	$patnam = $_POST['Nama'];
}

if(isset($_POST['DOB']))
{
	$DOB = $_POST['DOB'];
	if($DOB <> "")
	{
		$DOB1 = DateTime::createFromFormat('d/m/Y', $DOB);
		$DOB = $DOB1->format('Y/m/d');
	}
}

if(isset($_POST['Sex']))
{
	$sex = $_POST['Sex'];
}

if(isset($_POST['Telp']))
{
	$telp = $_POST['Telp'];
}

if(isset($_POST['Tgl']))
{
	$dateapp = $_POST['Tgl'];
	if($dateapp <> "")
	{
		$dateapp1 = DateTime::createFromFormat('d/m/Y', $dateapp);
		$dateapp = $dateapp1->format('Y/m/d');
	}
}

if(isset($_POST['Jam']))
{
	$time = $_POST['Jam'];
	if($time <> "")
	{
		$time1 = DateTime::createFromFormat('H:i', $time);
		$time = $time1->format('H:i');
	}
}

if(isset($_POST['dokter']))
{
	$docID = $_POST['dokter'];
}

if(isset($_POST['Ruang']))
{
	$roomID = $_POST['Ruang'];
}

$sql = "select count(*) as row from T_Appointment where App_no = '".$no."'";
$sql_execute = sqlsrv_query($conn,$sql);
$hasil = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);

if($sql_execute == false || $hasil['row'] < 1)
{
	$sql1="insert into T_Appointment values(".$patno.",null,'".$patnam."','".$DOB."','".$sex."','".$telp."',CONVERT(datetime, '".$dateapp."', 111),'".$time."','".$roomID."','".$docID."','".$userID."',CONVERT(datetime, '".date('Y/m/d H:i:s')."', 120))";
	$sql_execute1 = sqlsrv_query($conn1,$sql1);
}
else
{
	$sql2 = "update T_Appointment set pat_no=".$patno.",name='".$patnam."',dob='".$DOB."',sex='".$sex."',telp='".$telp."',app_date=CONVERT(datetime, '".$dateapp."', 111),app_time='".$time."',room_id='".$roomID."',doctor_id='".$docID."' where app_no='".$no."'";
	$sql_execute2 = sqlsrv_query($conn2,$sql2);
}

echo "<script>window.location.href='Outpatient.php';</script>";

?>
