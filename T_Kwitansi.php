<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Receipt</title>
</head>

<body>
<?php
include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

$datekw = date('d/m/Y');

if(isset($_POST['Patno']))
{
	$patno = $_POST['Patno'];
}

if(isset($_POST['hidCase']))
{
	$caseno = $_POST['hidCase'];
}

if(isset($_POST['Patnam']))
{
	$patnam = $_POST['Patnam'];
}

if(isset($_POST['TAmt']))
{
	$tAmt = $_POST['TAmt'];
}

if(isset($_POST['JnsBayar']))
{
	$jnsbayar = $_POST['JnsBayar'];

	$que = "select * from M_PayType where pay_id = '".$jnsbayar."'";
  	$sql = sqlsrv_query($conn,$que);
  	$hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC);
	$paytype = $hasil['Payment'];
}

if(isset($_POST['CardNo']))
{
	$card = $_POST['CardNo'];
}

if(isset($_POST['TBayar']))
{
	$jmlbayar = $_POST['TBayar'];
}

if(isset($_POST['jmltagih']))
{
	$jmltagih = $_POST['jmltagih'];
}

if($paytype == 'Tunai')
{
	$Tbyr = $jmlbayar;
}
else
{
	$Tbyr = $tAmt;
}

if(isset($_POST['hidPayId']))
{
	$payid = $_POST['hidPayId'];
}

if(isset($_POST['hidUser']))
{
	$hidUser = $_POST['hidUser'];
	$queName = "select Name from M_User where User_Id = '".$hidUser."'";
	$queName_exe = sqlsrv_query($conn1,$queName);
	if($queName_exe){
		$res = sqlsrv_fetch_array($queName_exe, SQLSRV_FETCH_ASSOC);
		$nam = $res['Name'];
	}
}
?>
<button type="button" class="btn" name="printKW" id="printKW" onclick="checkKW();">Print</button>
<button type="button" class="btn" name="Cancel" id="Cancel" onclick="button();">Exit</button>
<div  id="PrintArea">
	<style>
		@media print {
		  @page { margin: 0; }
		  body { margin: 1.6cm; }
		}
		table{
			border-collapse:collapse;
		}
		tr, td
		{
			padding:0px;
			padding-bottom:5px;
		}
  </style>
	<h3>KWITANSI</h3>
	<table width="570" border="0">
	  <tr>
	    <td width="138">Tanggal</td>
	    <td width="10">:</td>
	    <td width="107"><?php echo $datekw; ?></td>
	    <td width="119">No. pembayaran</td>
	    <td width="10">:</td>
	    <td width="160"><?php echo $payid; ?></td>
	  </tr>
	  <tr>
	    <td>No. pasien</td>
	    <td>:</td>
	    <td><?php echo $patno; ?></td>
	    <td>No. Kasus</td>
	    <td>:</td>
	    <td><?php echo $caseno; ?></td>
	  </tr>
	  <tr>
	    <td>Nama pasien</td>
	    <td>:</td>
	    <td><?php echo $patnam; ?></td>
	    <td>Nama kasir</td>
	    <td>:</td>
	    <td><?php if(isset($nam)){echo $nam;} ?></td>
	  </tr>
	</table>
	<table width="780" height="132" border="0" style="margin-top:10px">
	  <tr>
	    <td width="139">Jumlah tagihan</td>
	    <td width="10">:</td>
	    <td width="617"><?php if(isset($_POST['jmltagih'])){echo $_POST['jmltagih'];} ?></td>
	  </tr>
	  <tr>
	    <td>Jumlah pembayaran</td>
	    <td>:</td>
	    <td><?php echo $Tbyr; ?></td>
	  </tr>
	  <tr>
	    <td>Terbilang</td>
	    <td>:</td>
	    <td><?php echo ltrim(Terbilang($Tbyr)." Rupiah"); ?></td>
	  </tr>
	  <tr>
	    <td>Jenis pembayaran</td>
	    <td>:</td>
	    <td><?php echo $paytype; ?></td>
	  </tr>
	  <?php
	  	if($paytype != "Tunai"){
	  		echo "
	  			<tr>
	  				<td>Nomor Kartu</td>
	  				<td>:</td>
	  				<td>".$card."</td>
	  			</tr>
	  		";
	  	}
	  ?>
	  <tr>
	    <td>Kembali</td>
	    <td>:</td>
	    <td><?php if(isset($_POST['Kembali'])){echo $_POST['Kembali'];} ?></td>
	  </tr>
	</table>

	<?php
	function Terbilang($x)
	{
	  $abil = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
	  if ($x < 12)
	    return " " . $abil[$x];
	  elseif ($x < 20)
	    return Terbilang($x - 10) . "belas";
	  elseif ($x < 100)
	    return Terbilang($x / 10) . " Puluh" . Terbilang($x % 10);
	  elseif ($x < 200)
	    return " Seratus" . Terbilang($x - 100);
	  elseif ($x < 1000)
	    return Terbilang($x / 100) . " Ratus" . Terbilang($x % 100);
	  elseif ($x < 2000)
	    return " Seribu" . Terbilang($x - 1000);
	  elseif ($x < 1000000)
	    return Terbilang($x / 1000) . " Ribu" . Terbilang($x % 1000);
	  elseif ($x < 1000000000)
	    return Terbilang($x / 1000000) . " Juta" . Terbilang($x % 1000000);
	  elseif ($x < 1000000000000)
	    return Terbilang($x / 1000000000) . " Miliar" . Terbilang($x % 1000000000);
	}
	?>
</div>
<iframe id="myFrame" hidden></iframe>

<script>
function checkKW(){
	document.getElementById("myFrame").src = "cekKW.php?noKW=" + <?php echo '"'.$payid.'"'; ?>;
}
function PrintKW()
{
    var mywindow = window.open('', 'PRINT', 'height=400,width=600');

    mywindow.document.write('<html><head>');
    mywindow.document.write('</head><body >');
    mywindow.document.write(document.getElementById("PrintArea").innerHTML);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();
    mywindow.close();

    return true;
}

function button()
{
	window.location.href = "outpatient.php";
}
</script>
</body>
</html>
