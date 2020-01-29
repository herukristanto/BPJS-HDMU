<?php
include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

$userID = $_POST['hidUser'];

$no = '';
$patno = '';
$patnam = '';
$DOB = '';
$sex = '';
$add = '';
$prop = '';
$telp = '';
$pid = '';
$status = '';
$agama = '';
$nokNam = '';
$nokTlp = '';
$nokAdd = '';
$datecase = '';
$timecase = '';
$docName = '';
$roomName = '';
$SP = '';
$iCode = '';

if(isset($_POST['noId']))
{
	$no = $_POST['noId'];
}

if(isset($_POST['Pno']))
{
	$patno = $_POST['Pno'];
}

if(isset($_POST['Pnam']))
{
	$patnam = $_POST['Pnam'];
}

if(isset($_POST['PDOB']))
{
	$DOB = $_POST['PDOB'];
	if($DOB <> "")
	{
		$DOB1 = DateTime::createFromFormat('d/m/Y', $DOB);
		$DOB = $DOB1->format('Y/m/d');
	}
}

if(isset($_POST['PSex']))
{
	$sex = $_POST['PSex'];
}

if(isset($_POST['Padd']))
{
	$add = $_POST['Padd'];
}

if(isset($_POST['Prop']))
{
	$prop = $_POST['Prop'];
}

if(isset($_POST['Ptlp']))
{
	$telp = $_POST['Ptlp'];
}

if(isset($_POST['KTPno']))
{
	$pid = $_POST['KTPno'];
}

if(isset($_POST['Status']))
{
	$status = $_POST['Status'];
}
if(isset($_POST['Religion']))
{
	$agama = $_POST['Religion'];
}

if(isset($_POST['NokName']))
{
	$nokNam = $_POST['NokName'];
}

if(isset($_POST['NokAdd']))
{
	$nokAdd = $_POST['NokAdd'];
}

if(isset($_POST['NokTelp']))
{
	$nokTlp = $_POST['NokTelp'];
}
//========================================================= master patient ===================================================================
if ($patno == ''){
	$sql1="INSERT INTO M_Patient (Name, DOB, Sex, KTP, Address, Prop, Telp, Status, Religion, Nok_Name, Nok_Address, Nok_Telp, Create_By, Create_Time)
			VALUES('".$patnam."','".$DOB."','".$sex."','".$pid."','".$add."','".$prop."','".$telp."','".$status."','".$agama."','".$nokNam."','".$nokAdd."','".$nokTlp."','".$userID."',CONVERT(datetime, '".date('Y/m/d H:i:s')."', 120))";
	$sql_execute1 = sqlsrv_query($conn1,$sql1);
} else{
	$sql1 = "update M_Patient
				set Name = '".$patnam."',
					DOB = '".$DOB."',
					Sex = '".$sex."',
					KTP = '".$pid."',
					Address = '".$add."',
					Prop = '".$prop."',
					Telp = '".$telp."',
					Status = '".$status."',
					Religion = '".$agama."',
					Nok_Name = '".$nokNam."',
					Nok_Address = '".$nokAdd."',
					Nok_Telp = '".$nokTlp."'
				where PAT_NO = '".$patno."'
				";
	$executeUp = sqlsrv_query($conn4,$sql1);
	sqlsrv_close($conn4);
}
//==============================================================================================================================================

$datecase = '';
$timecase = '';
$docName = '';
$roomName = '';
$SP = '';
$iCode = '';
$payer = '';

if(isset($_POST['Tgl']))
{
	$datecase = $_POST['Tgl'];
	if($datecase <> "")
	{
		$datecase1 = DateTime::createFromFormat('d/m/Y', $datecase);
		$datecase = $datecase1->format('Y/m/d');
	}
}

if(isset($_POST['Jam']))
{
	$timecase = $_POST['Jam'];
	if($timecase <> "")
	{
		$timecase1 = DateTime::createFromFormat('H:i', $timecase);
		$timecase = $timecase1->format('H:i');
	}
}

if(isset($_POST['DName']))
{
	$docName = $_POST['DName'];
}

if(isset($_POST['RName']))
{
	$roomName = $_POST['RName'];
}

if(isset($_POST['SP']))
{
	$SP = $_POST['SP'];
}
if(isset($_POST['Asuransi']))
{
	$iCode = $_POST['Asuransi'];
}

if ($patno == '')
{
	$que1 = "SELECT max(PAT_NO) as Patno FROM M_Patient where Name = '".$patnam."'";
    $sql3 = sqlsrv_query($conn,$que1);
    $row = sqlsrv_fetch_array($sql3, SQLSRV_FETCH_ASSOC);
	$patno = $row['Patno'];
	echo "<input type='text' id='hidPatno' value='".$patno."' hidden/>";

}

if($SP <> '')
{
	$payer = $patno;
}
elseif($iCode <> '')
{
	$payer = $iCode;
}

$sql2 = "INSERT INTO T_Case (Pat_No, Case_Date, Case_Time, Room_Id, Doctor_Id, Pembayar, Create_By, Create_Time)
			VALUES('".$patno."','".$datecase."','".$timecase."','".$roomName."','".$docName."','".$payer."','".$userID."',CONVERT(datetime, '".date('Y/m/d H:i:s')."', 120))";
$sql_execute2 = sqlsrv_query($conn2,$sql2);

$getcase = "select max(Case_No) as caseno from T_Case where Pat_no = '".$patno."' and Case_Date = '".$datecase."'";
$exeCase = sqlsrv_query($conn,$getcase);
$myCase = sqlsrv_fetch_array($exeCase, SQLSRV_FETCH_ASSOC);
$caseno = $myCase['caseno'];
echo "<input type='text' id='hidCase' value='".$caseno."' hidden/>";

$sql5 = "update T_Appointment set Pat_No='".$patno."',Case_No='".$caseno."' where app_no='".$no."'";
$sql_execute3 = sqlsrv_query($conn3,$sql5);

?>
<script>
	window.location.href = 'Outpatient.php';
</script>
