<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="..//RSBPJS/img/bpjs.png"/>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>View Stock Usage</title>

<script type="text/javascript">
function ExportToExcel(testTable){
			 var htmltable= document.getElementById('TableDetail');
			 var html = htmltable.outerHTML;
			 window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
		}
</script>
</head>
<body bgcolor="#F7F7F7">

<a href="R_StockUsage.php">Back To Menu</a>


<font face="Verdana, Geneva, sans-serif">
<?php
	include "koneksi.php";

	$DateFrom = $_POST['TFDateFrom'];
	$DateTo = $_POST['TFDateTo'];
	$Rd = $_POST['RadioButton'];

	$kode1 = $_POST['kode1'];
	$kode2 = $_POST['kode2'];

	//change format Date
	$Yf = substr($DateFrom,6,4);
	$Mf = substr($DateFrom,3,2);
	$Df = substr($DateFrom,0,2);
	$DateF = $Yf.'-'.$Mf.'-'.$Df;
	$DateF1 = $Yf.'/'.$Mf.'/'.$Df;
	$Yt = substr($DateTo,6,4);
	$Mt = substr($DateTo,3,2);
	$Dt = substr($DateTo,0,2);
	$DateT = $Yt.'-'.$Mt.'-'.$Dt;
	$DateT1 = $Yt.'/'.$Mt.'/'.$Dt;

	$condition = "";

	// $kode1 = str_replace("*", "%", $kode1);
	// $kode2 = str_replace("*", "%", $kode2);

	if($kode1 != ""){
		if($kode2 != ""){
			$condition = "and (Service_Id >= '".$kode1."' and Service_Id <= '".$kode2."')";
		}else{
			$condition = "and service_id like '".$kode1."'";
		}
	}

	If ($Rd == 'Detail') 
	{ 
		$query = "SELECT * FROM V_StockUsage WHERE Case_Date >= CONVERT(DATETIME,'".$DateF." 00:00:00',102) AND Case_Date <= CONVERT(DATETIME,'".$DateT." 00:00:00',102) ".$condition." and Stock = 'X' ORDER BY Case_Date";
		$sql = sqlsrv_query($conn,$query);
		if ($sql){
			echo "
				<table id='TableDetail' border='1' align='center' cellspacing='0' cellpadding='0'>
					<caption>
						<h2><center>Laporan Pemakaian Stok</center></h2>
						<h3><center>( Stock Usage Report )</center></h3>
						<h3><center>Detil</center></h3>
						<h4><center>Periode&nbsp&nbsp&nbsp&nbsp:&nbsp ".$DateFrom." &nbsp&nbsps/d&nbsp&nbsp ".$DateTo." </center></h4> <br>
					</caption>
				<tr>
					<td align='center' width='60' style='font-weight:bold'>No</td>
					<td align='center' width='120' style='font-weight:bold'>Tanggal</td>
					<td align='center' width='115' style='font-weight:bold'>No. Pasien</td>
					<td align='center' width='115' style='font-weight:bold'>No. Kasus</td>
					<td align='center' width='200' style='font-weight:bold'>Nama</td>
					<td align='center' width='130' style='font-weight:bold'>Kode Service</td>
					<td align='center' width='300' style='font-weight:bold'>Deskripsi</td>
					<td align='center' width='80' style='font-weight:bold'>Jumlah</td>
					<td align='center' width='200' style='font-weight:bold'>Catatan</td>
				</tr>";

			$no=0;

			while($rs = sqlsrv_fetch_array($sql)){
				$no++;
				
				echo "
					<tr>
						<td align='center'>$no</td>
						<td align='center'>".$rs['Case_Date']->format('d/m/Y')."</td>
						<td align='center'>".$rs['Pat_No']."</td>
						<td align='center'>".$rs['Case_No']."</td>
						<td align='left'>".$rs['Name']."</td>
						<td align='center'>".$rs['Service_Id']."</td>
						<td align='left'>".$rs['Descp']."</td>
						<td align='center'>".number_format($rs['Qty'],0,",",".")."</td>
						<td align='center'>".$rs['Note']."</td>
					</tr>";
			}

			$que = "Select * from T_UpStockBatch where CONVERT(varchar, Create_Date, 111) >= '".$DateF1."' and CONVERT(varchar, Create_Date, 111) <= '".$DateT1."' ".$condition." order by Create_Date";
			$que_exe = sqlsrv_query($conn, $que);

			while ($rows = sqlsrv_fetch_array($que_exe)) {
				$no++;

				echo "
					<tr>
						<td align='center'>$no</td>
						<td align='center'>".$rows['Create_Date']->format('d/m/Y')."</td>
						<td align='center'></td>
						<td align='center'></td>
						<td align='left'>ADJUSTMENT</td>
						<td align='center'>".$rows['Service_Id']."</td>
						<td align='left'>".$rows['Descp']."</td>
						<td align='center'>".number_format($rows['Qty'],0,",",".")."</td>
						<td align='center'>".$rows['Keterangan']."</td>
					</tr>";

			}
			
			echo"</table>";
		}
	}
	elseif($Rd == 'Summary')
	{
		$query_sum = "SELECT Service_Id, Descp, SUM(Qty) AS Total FROM V_StockUsage WHERE Case_Date >= CONVERT(DATETIME,'".$DateF." 00:00:00',102) AND Case_Date <= CONVERT(DATETIME,'".$DateT." 00:00:00',102) ".$condition." GROUP BY Descp, Service_Id ";
		$sql_sum = sqlsrv_query($conn,$query_sum);

		if  ($sql_sum){
			echo "
				<table id='TableDetail' border='1' align='center' cellspacing='0' cellpadding='0'>
					<caption>
						<h2><center>Laporan Pemakaian Stok</center></h2>
						<h3><center>( Stock Usage Report )</center></h3>
						<h3><center>Summary</center></h3>
						<h4><center>Periode&nbsp&nbsp&nbsp&nbsp:&nbsp ".$DateFrom." &nbsp&nbsps/d&nbsp&nbsp ".$DateTo." </center></h4> <br>
					</caption>
					<tr>
						<td align='center' width='60' style='font-weight:bold'>No</td>
						<td align='center' width='130' style='font-weight:bold'>Kode Service</td> 
						<td align='center' width='500' style='font-weight:bold'>Deskripsi</td>
						<td align='center' width='80' style='font-weight:bold'>Total</td>
					</tr>";

			$no=0;

			while($rs = sqlsrv_fetch_array($sql_sum)){
				$no++;
				
				echo "
					<tr>
						<td align='center'>$no</td>
						<td align='center'>".$rs['Service_Id']."</td>
						<td align='left'>".$rs['Descp']."</td>
						<td align='center'>".number_format($rs['Total'],0,",",".")."</td>
					</tr>";
			}
			
			// echo"</table>";
						
		}
	}

?>

<table>
	<tr>
		<td><button type="button" id="btnExport" onclick="ExportToExcel();">Export to Excel</button></td>
	</tr>
</table>

<br>
<br>

<table>
	<tr>
		<td><input id="printpagebutton" type="button" value="Print" onclick="printpage();" /></td>
		<td><input id="exportpage" type="button" value="Export" onclick="ExportToExcel();" /></td>
	</tr>
</table>

<script type="text/javascript">
	function printpage() {
		//Get the print button and put it into a variable
		var printButton = document.getElementById("printpagebutton");
		var exportButton = document.getElementById("exportpage");
		var saveButton = document.getElementById("savepage");

		//Set the print button visibility to 'hidden' 
		printButton.style.visibility = 'hidden';
		exportButton.style.visibility = 'hidden';
		saveButton.style.visibility = 'hidden';

		//Print the page content
		window.print();

		//Set the print button to 'visible' again 
		//[Delete this line if you want it to stay hidden after printing]
		printButton.style.visibility = 'visible'; 
		exportButton.style.visibility = 'visible';
		saveButton.style.visibility = 'visible';
	}
</script>

</body>
</html>
