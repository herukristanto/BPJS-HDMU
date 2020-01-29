<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Print Invoice</title>
<style>
.THead{
	border-collapse:collapse;
}
</style>
<script type="text/javascript" src="script/jquery-1.7.2.min.js"></script>
</head>

<body>
<input type="button" class="btn" id="printInv" onclick="PrintInv();" value="PRINT"/>
<input type="button" class="btn" name="Cancel" id="Cancel" value="Exit" onclick="button();" />    
<div  id="PrintArea">
	<style>
		@media print {
		  @page { margin: 0; }
		  body { margin: 0.3cm; }
		}
    </style>
<?php
	include 'koneksi.php';
  	date_default_timezone_set("Asia/Bangkok");

	$tgl = date('d/m/Y');
	$caseno = '';
	$invno = '';
	$tglInv = '';
	$grandtotal = 0;

	if(isset($_GET['case']))
	{
		$caseno = $_GET['case'];
	}

	if(isset($_GET['inv']))
	{
		$invno = $_GET['inv'];
	}

	$que = "select * from V_Invoice where Case_No = '".$caseno."' and Bill_Id = '".$invno."'";
  	$sql = sqlsrv_query($conn,$que);
  	$hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC);

	if(isset($hasil['Create_Time']))
	{
		$tglInv = substr($hasil['Create_Time']->format('d/m/Y'),0,10);
	}


?>
<table width="" border="0">
	<tr>
		<td width="90" >&nbsp;</td>
		<td width="405" >&nbsp;</td>
		<td width="30" >&nbsp;</td>
		<td width="130" >&nbsp;</td>
		<td width="140" >&nbsp;</td>
	</tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
		<td colspan="2"><img src="Image/logo.png" width="198" height="100" align="right" /></td>
  </tr>
  <tr>
    <td><?php echo $tgl; ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">Pada saat pembayaran mohon sebutkan,</td>
  </tr>
  <tr>
    <td colspan='2'><?php if(isset($hasil['Name'])){echo $hasil['Name'];} ?></td>
    <td>&nbsp;</td>
    <td>No. Customer</td>
    <td>: <?php if(isset($hasil['Pembayar'])){echo $hasil['Pembayar'];} ?></td>
  </tr>
  <tr>
    <td colspan='2'><?php if(isset($hasil['Address'])){echo $hasil['Address'];} ?></td>
    <td>&nbsp;</td>
    <td>No. Invoice</td>
    <td>: <?php if(isset($hasil['Bill_Id'])){echo $hasil['Bill_Id'];} ?></td>
  </tr>
  <tr>
    <td colspan='2'><?php if(isset($hasil['Prop_Name'])){echo $hasil['Prop_Name'];} ?></td>
    <td>&nbsp;</td>
    <td>Tgl. Invoice</td>
    <td>: <?php echo $tglInv; ?></td>
  </tr>
  <tr>
    <td colspan="5"><h1 align="center"><u>I N V O I C E</u></h1></td>
  </tr>
  <tr>
    <td width="90">No. Pasien</td>
    <td>: <?php if(isset($hasil['Pat_No'])){echo $hasil['Pat_No'];} ?></td>
    <td>&nbsp;</td>
    <td>Nomor Kasus</td>
    <td>: <?php if(isset($hasil['Case_No'])){echo $hasil['Case_No'];} ?></td>
  </tr>
  <tr>
    <td>Nama Pasien</td>
    <td>: <?php if(isset($hasil['Name'])){echo $hasil['Name'];} ?></td>
    <td>&nbsp;</td>
    <td>Tgl. Kunjungan</td>
    <td>: <?php if(isset($hasil['Case_Date'])){echo $hasil['Case_Date']->format('d/m/Y');} ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Jam Kunjungan</td>
    <td>: <?php if(isset($hasil['Case_Time'])){echo $hasil['Case_Time'];} ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Ruang Konsultasi</td>
    <td>: <?php if(isset($hasil['Room_Name'])){echo $hasil['Room_Name'];} ?></td>
  </tr>
</table>

<?php
	$que1 = "select * from T_Service where Display = 'X' and Case_No = '".$caseno."' and Billed = '".$invno."'";
  	$sql1 = sqlsrv_query($conn1,$que1);

	echo "
	<table class='THead' style='border-bottom:1px dashed black;border-top:1px dashed black;'>
  	<tr style='border-bottom:1px dashed black;'>
    	<td width='93'>Tanggal</td>
    	<td width='97'>Service</td>
    	<td width='280'>Nama Service</td>
    	<td width='66'>Jumlah</td>
    	<td style='padding-right:45px;' width='110'><div align='right'>Total</div></td>
    	<td width='86'>No. Kontrol</td>
  	</tr>
  	";

	while($row = sqlsrv_fetch_array($sql1, SQLSRV_FETCH_ASSOC)){
		$que2 = "select * from M_Service where Service_Id = '".$row['Service_Id']."'";
  		$sql2 = sqlsrv_query($conn2,$que2);
		$hasil1 = sqlsrv_fetch_array($sql2, SQLSRV_FETCH_ASSOC);
		$servname = $hasil1['Descp'];
		if($row['Qty'] <= 0)
		{
			$total = $row['Service_Price'] * -1;
		}
		else
		{
			$total = $row['Service_Price'];
		}
		$servdate = substr($row['Create_Time']->format('d/m/Y'),0,10);
		echo "
	  	<tr>
	  		<td>".$servdate."</td>
			<td>".$row['Service_Id']."</td>
	  		<td>".$servname."</td>
			<td>".$row['Qty']."</td>
			<td style='padding-right:50px;' ><div align='right'>".number_format($total,0,",",".")."</div></td>
			<td></td>
	   	</tr>";
		$grandtotal = $grandtotal + $total;
	}
	echo "</table>";

	echo "
	<table border='0'>
  	<tr>
    	<td>&nbsp;</td>
    	<td><div align='left'>Total Biaya</div></td>
    	<td><div align='right'>".number_format($grandtotal,0,",",".")."</div></td>
  	</tr>
  	<tr>
    	<td>&nbsp;</td>
   	 	<td>Administrasi Rumah Sakit</td>
    	<td><div align='right'>0</div></td>
  	</tr>
  	<tr>
    	<td>&nbsp;</td>
    	<td>&nbsp;</td>
    	<td><div align='right'>-----------------</div></td>
  	</tr>
  	<tr>
    	<td>&nbsp;</td>
    	<td>Grand Total</td>
    	<td><div align='right'>".number_format($grandtotal,0,",",".")."</div></td>
  	</tr>
  	<tr>
    	<td width='180'>&nbsp;</td>
    	<td width='330'>Jumlah yg masih harus dibayar</td>
    	<td width='110'><div align='right'>".number_format($grandtotal,0,",",".")."</div></td>
  	</tr>
	</table>";

?>
</div>

<?php echo "<input type='text' id='hidCase' value='".$caseno."' hidden/>"; ?>
<?php echo "<input type='text' id='hidInv' value='".$invno."' hidden/>"; ?>

<script>
function PrintInv()
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
	window.location.href = "T_Billing.php?case="+document.getElementById('hidCase').value+"&inv="+document.getElementById('hidInv').value;
}
</script>
</body>
</html>
