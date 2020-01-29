<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Refund Receipt</title>
</head>

<body>

<?php
  include 'koneksi.php';
  date_default_timezone_set("Asia/Bangkok");

  if(isset($_GET['payno'])){
    $payno = $_GET['payno'];
  }

  if(isset($_GET['no'])){
    $no = $_GET['no'];
  }

  if(isset($_GET['usrname'])){
    $userid = $_GET['usrname'];
  }

  //$userid = 'Yudi'; // pake counter collection
  $datecancel = date('d/m/Y');

  $que = "select * from V_HReceipt where pay_id = '".$payno."'";
  $sql = sqlsrv_query($conn,$que);
  $hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC);

  $jmltagih = 0;
  $jmlbayar = 0;
  $que1 = "SELECT * FROM V_DReceipt where pay_id = '".$payno."'";
  $sql1 = sqlsrv_query($conn1,$que1);
  while($hasil1 = sqlsrv_fetch_array($sql1, SQLSRV_FETCH_ASSOC))
  {
		$jmltagih = $jmltagih + $hasil1['Bill_Amount'];
		$jmlbayar = $jmlbayar + $hasil1['POS_Amount'];
  }

  function Terbilang($x)
  {
  	$abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", 	"sebelas");
  	if ($x < 12)
    	return " " . $abil[$x];
  	elseif ($x < 20)
    	return Terbilang($x - 10) . "belas";
  	elseif ($x < 100)
    	return Terbilang($x / 10) . " puluh" . Terbilang($x % 10);
  	elseif ($x < 200)
    	return " seratus" . Terbilang($x - 100);
  	elseif ($x < 1000)
    	return Terbilang($x / 100) . " ratus" . Terbilang($x % 100);
  	elseif ($x < 2000)
    	return " seribu" . Terbilang($x - 1000);
  	elseif ($x < 1000000)
    	return Terbilang($x / 1000) . " ribu" . Terbilang($x % 1000);
  	elseif ($x < 1000000000)
    	return Terbilang($x / 1000000) . " juta" . Terbilang($x % 1000000);
  	elseif ($x < 1000000000000)
    	return Terbilang($x / 1000000000) . " miliar" . Terbilang($x % 1000000000);
  }
?>
<button type="button" class="btn" name="printKW" id="printKW" onclick="PrintKW();">Print</button>
<button type="button" class="btn" name="Cancel" id="Cancel" onclick="window.location.href='Outpatient.php';">Exit</button>
<div id="PrintArea">
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
  <h3>REFUND</h3>
  <table width="680" border="0">
    <tr>
      <td width="130">Tanggal</td>
      <td width="13">:</td>
      <td width="153"><?php echo $datecancel; ?></td>
      <td width="112">No. pembayaran</td>
      <td width="15">:</td>
      <td width="231"><?php echo $no; ?></td>
    </tr>
    <tr>
      <td>No. pasien</td>
      <td>:</td>
      <td><?php if(isset($hasil['Pat_No'])){echo $hasil['Pat_No'];} ?></td>
      <td>Nama kasir</td>
      <td>:</td>
      <td><?php echo $userid; ?></td>
    </tr>
    <tr>
      <td>Nama pasien</td>
      <td>:</td>
      <td><?php if(isset($hasil['Name'])){echo $hasil['Name'];} ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <table width="781" border="0" style="margin-top:10px">
    <tr>
      <td width="131">Jumlah tagihan</td>
      <td width="13">:</td>
      <td width="623"><?php echo $jmltagih; ?></td>
    </tr>
    <tr>
      <td>Jumlah pembayaran</td>
      <td>:</td>
      <td><?php echo $jmlbayar; ?></td>
    </tr>
    <tr>
      <td>Terbilang</td>
      <td>:</td>
      <td><?php echo ltrim(Terbilang($jmlbayar)." Rupiah"); ?></td>
    </tr>
    <tr>
      <td>Jenis pembayaran</td>
      <td>:</td>
      <td><?php if(isset($hasil['Payment'])){echo $hasil['Payment'];} ?></td>
    </tr>
  </table>
</div>

<script>

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
}</script>
</body>
</html>
