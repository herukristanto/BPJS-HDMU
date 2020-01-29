<?php
include 'koneksi.php';
date_default_timezone_set("Asia/Bangkok");


//Update Data Pasien.
if(isset($_POST['Patno']))
{
  $patno = $_POST['Patno'];
}

if(isset($_POST['Nama']))
{
  $nama = $_POST['Nama'];
}

if(isset($_POST['DOB']))
{
  $dob = $_POST['DOB'];
  if($dob <> "")
  {
    $dob1 = DateTime::createFromFormat('d/m/Y', $dob);
    $dob = $dob1->format('Y/m/d');
  }
}

if(isset($_POST['Sex']))
{
  $sex = $_POST['Sex'];
}

if(isset($_POST['Alamat']))
{
  $alamat = $_POST['Alamat'];
}

if(isset($_POST['Prop']))
{
  $prop = $_POST['Prop'];
}

if(isset($_POST['Telp']))
{
  $telp = $_POST['Telp'];
}

if(isset($_POST['KTP']))
{
  $ktp = $_POST['KTP'];
}

if(isset($_POST['Status']))
{
  $status = $_POST['Status'];
}

if(isset($_POST['Religion']))
{
  $religion = $_POST['Religion'];
}

if(isset($_POST['NokName']))
{
  $nokname = $_POST['NokName'];
}

if(isset($_POST['NokTelp']))
{
  $noktelp = $_POST['NokTelp'];
}

if(isset($_POST['NokAdd']))
{
  $nokadd = $_POST['NokAdd'];
}

$quePat = "update M_Patient
    set Name = '".$nama."',
        DOB = '".$dob."',
        Sex = '".$sex."',
        KTP = '".$ktp."',
        Address = '".$alamat."',
        Prop = '".$prop."',
        Telp = '".$telp."',
        Status = '".$status."',
        Religion = '".$religion."',
        Nok_Name = '".$nokname."',
        Nok_Address = '".$nokadd."',
        Nok_Telp = '".$noktelp."'
    where PAT_NO = '".$patno."'
      ";
$sqlPat = sqlsrv_query($conn,$quePat);
//Selesai Update Data Pasien.

//Update Data Case.
if(isset($_POST['Caseno']))
{
  $caseno = $_POST['Caseno'];
}

if(isset($_POST['Tgl']))
{
  $casetgl = $_POST['Tgl'];
}

if(isset($_POST['Jam']))
{
  $casejam = $_POST['Jam'];
}

if(isset($_POST['docId']))
{
  $docid = $_POST['docId'];
}

if(isset($_POST['roomId']))
{
  $roomid = $_POST['roomId'];
}

if(isset($_POST['Asuransi']))
{
  $payer = $_POST['Asuransi'];
}

if(isset($_POST['SP']))
{
  $payer = $patno;
}

$queCase = "update T_Case
            set Doctor_Id = '".$docid."',
                Room_Id = '".$roomid."',
                Pembayar = '".$payer."'
            where Pat_No = ".$patno."
            and   Case_No = ".$caseno."
            ";
$sqlCase = sqlsrv_query($conn,$queCase);
//echo $queCase;
?>
<script>
	window.location.href = 'Outpatient.php';
</script>
