<?php
include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

if(isset($_POST['hidCase']))
{
	$caseno = $_POST['hidCase'];
}

if(isset($_POST['hidPatno']))
{
	$patno = $_POST['hidPatno'];
}

if(isset($_POST['Doctor']))
{
	$docnam = $_POST['Doctor'];
}

if(isset($_POST['In']))
{
	$tempat = $_POST['In'];
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

if(isset($_POST['Anamnesa']))
{
	$anamnesa = $_POST['Anamnesa'];
}

if(isset($_POST['PFisik']))
{
	$fisik = $_POST['PFisik'];
}

if(isset($_POST['Lab']))
{
	$lab = $_POST['Lab'];
}

if(isset($_POST['Rad']))
{
	$rad = $_POST['Rad'];
}

if(isset($_POST['LN']))
{
	$lain = $_POST['LN'];
}

if(isset($_POST['DiagKerja']))
{
	$diagkerja = $_POST['DiagKerja'];
}

if(isset($_POST['DiagBanding']))
{
	$diagbanding = $_POST['DiagBanding'];
}

if(isset($_POST['Terapi']))
{
	$terapi = $_POST['Terapi'];
}

if(isset($_POST['Alasan']))
{
	$alasan = $_POST['Alasan'];
}

if(isset($_POST['Tgl']))
{
	$daterefer = $_POST['Tgl'];
	if($daterefer <> "")
	{
		$daterefer1 = DateTime::createFromFormat('d/m/Y', $daterefer);
		$daterefer = $daterefer1->format('Y/m/d');
		
	}
}

if(isset($_POST['DName']))
{
	$perujuk = $_POST['DName'];
}

$sql = "select count(*) as row from T_Referral where Pat_No = '".$patno."' and Case_No = '".$caseno."'";
$sql_execute = sqlsrv_query($conn,$sql);
$hasil = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);

if($sql_execute == false || $hasil['row'] < 1)
{
	$sql1="insert into T_Referral values('".$patno."','".$caseno."','".$docnam."','".$tempat."','".$patnam."','".$DOB."','".$sex."','".$anamnesa."','".$fisik."','".$lab."','".$rad."','".$lain."','".$diagkerja."','".$diagbanding."','".$terapi."','".$alasan."','".$daterefer."','".$perujuk."')";
	$sql_execute1 = sqlsrv_query($conn1,$sql1);
}
else
{
	$sql2 = "update T_Referral set Doctor='".$docnam."',Tempat='".$tempat."',Pat_Nam='".$patnam."',Pat_DOB='".$DOB."',Pat_Sex='".$sex."',Anamnesa='".$anamnesa."',Fisik='".$fisik."',Lab='".$lab."',Rad='".$rad."',Lainnya='".$lain."',Diag_Kerja='".$diagkerja."',Diag_Banding='".$diagbanding."',Terapi='".$terapi."',Alasan='".$alasan."',Tanggal='".$daterefer."',Perujuk='".$perujuk."' where Pat_No='".$patno."' and Case_No = '".$caseno."'";
	$sql_execute2 = sqlsrv_query($conn2,$sql2);
}

echo "
	<script>
		alert('Data Berhasil Disimpan');
		parent.document.getElementById('Print').disabled = false;
	</script>
";

?>
