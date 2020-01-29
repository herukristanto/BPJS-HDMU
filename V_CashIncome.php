<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="..//RSBPJS/img/bpjs.png"/>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>View Stock Usage</title>
</style>
<script type="text/javascript">
function ExportToExcel(testTable){
       var htmltable= document.getElementById('TableDetail');
       var html = htmltable.outerHTML;
       window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
    }

</script>
</head>

<?php
// Turn off error reporting
error_reporting(0);

// Report runtime errors
error_reporting(E_ERROR | E_WARNING | E_PARSE);

// Report all errors
error_reporting(E_ALL);

// Same as error_reporting(E_ALL);
ini_set("error_reporting", E_ALL);

// Report all errors except E_NOTICE
error_reporting(E_ALL & ~E_NOTICE);
?>

<?php
include "koneksi.php";
?>


<body bgcolor="#F7F7F7">
<a href="R_CashIncome.php">Back To Menu</a>

<font face="Verdana, Geneva, sans-serif">

<?php

$DateTo = $_POST['TFDateTo'];

$session = $_POST['Session'];

$terminal = $_POST['Terminal'];

$bayar = $_POST['bayar'];

$payment = "";
If($bayar == 'Tunai')
{ $payment = 'H0'; }
elseif($bayar == 'Visa')	
{ $payment = 'V0'; }
elseif($bayar == 'Master')	
{ $payment = 'M0'; }
elseif($bayar == 'Debit')	
{ $payment = 'D0'; }
else
{ $bayar = "All"; }

$Rd = $_POST['RadioButton'];

$Yt = substr($DateTo,6,4);
$Mt = substr($DateTo,3,2);
$Dt = substr($DateTo,0,2);
$DateT = $Yt.'-'.$Mt.'-'.$Dt;


$where = "";
if($Rd == "Detail"){
	$table = "V_CashIncome_Detail";

	if($session != ""){
		$where = " and CSession = '".$session."'";
	}
	if($terminal != ""){
		$where = $where." and CTerminal = '".$terminal."'";		
	}
	if($payment != ""){
		$where = $where." and Payment_Type = '".$payment."'";
	}
}elseif($Rd == "Summary") {
	$table = "V_CashIncome_Summary";
}

$query = "select * from ".$table." WHERE Case_Date = CONVERT(DATETIME,'".$DateT." 00:00:00',102)".$where;
$sql = sqlsrv_query($conn,$query);
if($sql){
	echo "
		<table id=\"TableDetail\" border=\"1\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\">
			<caption>
				<h2><center>Laporan Pendapatan Kasir</center></h2>
				<h3><center>( Cash Income Report )</center></h3>
				<h3><center>".$Rd."</center></h3>
				<h3><center>Pembayaran ".$bayar."</center></h3>
				<h4><center>Periode&nbsp&nbsp&nbsp&nbsp:&nbsp ".$DateTo." </center></h4> <br>
				<p></p>
			</caption>
		";
		if($Rd == "Detail"){
			echo "
				<tr>
					<td align=\"center\" width=\"60\" style=\"font-weight:bold\">No</td>
					<td align=\"center\" width=\"170\" style=\"font-weight:bold\">No. Kwitansi</td>
					<td align=\"center\" width=\"170\" style=\"font-weight:bold\">No. Invoice</td>
					<td align=\"center\" width=\"115\" style=\"font-weight:bold\">No. Pasien</td>
					<td align=\"center\" width=\"115\" style=\"font-weight:bold\">No. Kasus</td>
					<td align=\"center\" width=\"200\" style=\"font-weight:bold\">Amount</td>
					<td align=\"center\" width=\"140\" style=\"font-weight:bold\">Session</td>
				</tr>
			";
			$no=0;
			while($rs = sqlsrv_fetch_array($sql)){
				$no++;
				echo "
					<tr>
						<td align=\"center\">$no</td>
						<td align=\"center\">".$rs['Pay_Id']."</td>
						<td align=\"center\">".$rs['Bill_Id']."</td>
						<td align=\"center\">".$rs['Pat_No']."</td>
						<td align=\"center\">".$rs['Case_No']."</td>
						<td align=\"right\">".number_format($rs['Amount'],0,",",".")."</td>
						<td align=\"center\">".$rs['CSession']."</td>
					</tr>
					";
			}
		}elseif($Rd == "Summary") {
			echo "
				<tr>
					<td align=\"center\" width=\"60\" style=\"font-weight:bold\">No</td>
					<td align=\"center\" width=\"180\" style=\"font-weight:bold\">Jenis Pembayaran</td>
					<td align=\"center\" width=\"170\" style=\"font-weight:bold\">No. Kwitansi</td>
					<td align=\"center\" width=\"200\" style=\"font-weight:bold\">Pendapatan Kasir</td>
					<td align=\"center\" width=\"170\" style=\"font-weight:bold\">No. Invoice</td>
					<td align=\"center\" width=\"200\" style=\"font-weight:bold\">Sistem</td>
					<td align=\"center\" width=\"200\" style=\"font-weight:bold\">Selisih</td>
				</tr>";
			$no=0;
			while($rs = sqlsrv_fetch_array($sql))
			{
				$no++;
				
				$selisih = $rs['AmountBilling'] - $rs['AmountPOS'] - $rs['Disc_Amt'];
				$totalpos = $rs['AmountPOS'] + $rs['Disc_Amt'];
				
				echo "
					<tr>
						<td align=\"center\">$no</td>
						<td align=\"center\">".$rs['Payment_Type']."</td>
						<td align=\"center\">".$rs['Pay_Id']."</td>
						<td align=\"right\">".number_format($totalpos,0,",",".")."</td>
						<td align=\"center\">".$rs['Bill_Id']."</td>
						<td align=\"right\">".number_format($rs['AmountBilling'],0,",",".")."</td>
						<td align=\"right\">".$selisih."</td>
					</tr>
					";
			}
		}
		
	echo "</table>";
}

echo "
	<table>
		<tr>
			<td><button id=\"btnExport\" onclick=\"ExportToExcel();\">Export to excel</button></td>
		</tr>
	</table>
	<br>
	<br>";



?>
</body>
</html>
