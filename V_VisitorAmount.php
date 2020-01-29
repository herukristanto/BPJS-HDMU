<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="..//RSBPJS/img/bpjs.png"/>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>View Visitor Amount</title>
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
	<a href=\"R_VisitorAmount.php\">Back To Menu</a>";
?>

<font face="Verdana, Geneva, sans-serif">
<?php

$DateFrom = $_POST['TFDateFrom'];
$DateTo = $_POST['TFDateTo'];

//change format Date
$Yf = substr($DateFrom,6,4);
$Mf = substr($DateFrom,3,2);
$Df = substr($DateFrom,0,2);
$DateF = $Yf.'-'.$Mf.'-'.$Df;
$Yt = substr($DateTo,6,4);
$Mt = substr($DateTo,3,2);
$Dt = substr($DateTo,0,2);
$DateT = $Yt.'-'.$Mt.'-'.$Dt;

{	$query = "SELECT * FROM V_VisitorAmount WHERE Case_Date >= CONVERT(DATETIME,'".$DateF." 00:00:00',102) AND Case_Date <= CONVERT(DATETIME,'".$DateT." 00:00:00',102) ORDER BY Case_Date";
	$sql = sqlsrv_query($conn,$query);
	if  ($sql){
	echo "
			<table id=\"TableDetail\" border=\"1\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\">
			<h2><center>Laporan Jumlah Visit</center></h2>
			<h3><center>( Visitor Amount Report )</center></h3>

			<h4><center>Periode&nbsp&nbsp&nbsp&nbsp:&nbsp ".$DateFrom." &nbsp&nbsps/d&nbsp&nbsp ".$DateTo." </center></h4> <br>
			<p></p>
			</caption>
				<tr>
			<td align=\"center\" width=\"60\" style=\"font-weight:bold\">No</td>
			<td align=\"center\" width=\"122\" style=\"font-weight:bold\">Tanggal Visit</td>
			<td align=\"center\" width=\"117\" style=\"font-weight:bold\">No. Pasien</td>
			<td align=\"center\" width=\"117\" style=\"font-weight:bold\">No. Kasus</td>
			<td align=\"center\" width=\"500\" style=\"font-weight:bold\">Nama</td>
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
					<td align=\"left\">".$rs['Name']."</td>
					</tr>";
					
				
					}
					echo"</table>";
			}
		
		;
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
