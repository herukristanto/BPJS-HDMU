<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="..//RSBPJS/img/bpjs.png"/>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>View Oustanding Insurance</title>
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
include "koneksi.php";
?>


<body bgcolor="#F7F7F7">
<?php echo"
	<a href=\"R_OutstandingInsurance.php\">Back To Menu</a>";
?>

<font face="Verdana, Geneva, sans-serif">
	
<?php
$DateFrom = $_POST['TFDateFrom'];
$DateTo = $_POST['TFDateTo'];
//$Rd = $_POST['RadioButton']; 

//change format Date
$Yf = substr($DateFrom,6,4);
$Mf = substr($DateFrom,3,2);
$Df = substr($DateFrom,0,2);
$DateF = $Yf.'-'.$Mf.'-'.$Df;
$Yt = substr($DateTo,6,4);
$Mt = substr($DateTo,3,2);
$Dt = substr($DateTo,0,2);
$DateT = $Yt.'-'.$Mt.'-'.$Dt;

//If ($Rd == 'Detail') 
	{ 
	
	$query = "SELECT * FROM V_Outstanding WHERE Case_Date >= CONVERT(DATETIME,'".$DateF." 00:00:00',102) AND Case_Date <= CONVERT(DATETIME,'".$DateT." 00:00:00',102) AND Status = 'X' ORDER BY Case_Date";
	$sql = sqlsrv_query($conn,$query);
	if  ($sql){
	echo "
			<table id=\"TableDetail\" border=\"1\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\">
			<h2><center>Laporan Outstanding Asuransi</center></h2>
			<h3><center>( Oustanding Insurance Report )</center></h3>
			
			<h4><center>Periode&nbsp&nbsp&nbsp&nbsp:&nbsp ".$DateFrom." &nbsp&nbsps/d&nbsp&nbsp ".$DateTo." </center></h4> <br>
			<p></p>
			</caption>
				<tr>
			<td align=\"center\" width=\"60\" style=\"font-weight:bold\">No</td>
			<td align=\"center\" width=\"110\" style=\"font-weight:bold\">Tanggal</td>
			<td align=\"center\" width=\"110\" style=\"font-weight:bold\">No. Pasien</td>
			<td align=\"center\" width=\"110\" style=\"font-weight:bold\">No. Kasus</td>
			<td align=\"center\" width=\"400\" style=\"font-weight:bold\">Nama</td>
			<td align=\"center\" width=\"180\" style=\"font-weight:bold\">Bill Id</td>
			<td align=\"center\" width=\"200\" style=\"font-weight:bold\">Amount</td>
			<td align=\"center\" width=\"200\" style=\"font-weight:bold\">Asuransi</td>
	</tr>";
	$no=0;
			while($rs = sqlsrv_fetch_array($sql)){
				$no++;
				
				echo "
				<tr>
					<td align=\"center\">$no</td>
					<td align=\"center\">".$rs['Case_Date']->format('d/m/Y')."</td>
					<td align=\"center\">".$rs['Pat_No']."</td>
					<td align=\"center\">".$rs['Case_No']."</td>
					<td align=\"left\">".$rs['Pat_Name']."</td>
					<td align=\"center\">".$rs['Bill_Id']."</td>
					<td align=\"right\">".number_format($rs['Amount'],0,",",".")."</td>
					<td align=\"center\">".$rs['Name']."</td>
					</tr>";
					
				
					}
					echo"</table>";
					
		}
		
		}
// elseif($Rd == 'Summary')
// 	{
// 	$query_sum = "SELECT Service_Id, Descp, SUM(Qty) AS Total FROM V_StockUsage WHERE Case_Date >= CONVERT(DATETIME,'".$DateF." 00:00:00',102) AND Case_Date <= CONVERT(DATETIME,'".$DateT." 00:00:00',102) GROUP BY Descp, Service_Id ";
// 	$sql_sum = sqlsrv_query($conn,$query_sum);

// 	if  ($sql_sum){
// 	echo "
// 			<table id=\"TableDetail\" border=\"1\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\">
// 			<h2><center>Laporan Pemakaian Stok</center></h2>
// 			<h3><center>( Stock Usage Report )</center></h3>
// 			<h3><center>Summary</center></h3>
// 			<h4><center>Periode&nbsp&nbsp&nbsp&nbsp:&nbsp ".$DateFrom." &nbsp&nbsps/d&nbsp&nbsp ".$DateTo." </center></h4> <br>
// 			<p></p>
// 			</caption>
// 				<tr>
// 			<td align=\"center\" width=\"60\" style=\"font-weight:bold\">No</td>
// 			<td align=\"center\" width=\"90\" style=\"font-weight:bold\">Kode Service</td>
// 			<td align=\"center\" width=\"700\" style=\"font-weight:bold\">Deskripsi</td>
// 			<td align=\"center\" width=\"90\" style=\"font-weight:bold\">Total</td>
// 	</tr>";
// 	$no=0;
// 			while($rs = sqlsrv_fetch_array($sql_sum)){
// 				$no++;
				
// 				echo "
// 				<tr>
// 					<td align=\"center\">$no</td>
// 					<td align=\"center\">".$rs['Service_Id']."</td>
// 					<td align=\"left\">".$rs['Descp']."</td>
// 					<td align=\"center\">".$rs['Total']."</td>
// 					</tr>";
					
				
// 					}
// 					echo"</table>";
					
// 		}
		
// 		;
// 	}

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
