<?php
	include "koneksi.php";

	$dateObj = $_GET['tgl'];
	$tgl = substr($dateObj,0,2);
	$bln = substr($dateObj,3,2);
	$thn = substr($dateObj,6,4);
	$tanggal =  $thn."/".$bln."/".$tgl;

	$que = "Select * from T_UpStockBatch where CONVERT(varchar, Create_Date, 111) = '".$tanggal."'";
	$que_exe = sqlsrv_query($conn, $que);

?>
	<div  id="PrintArea">
		<link href="css/style.css" rel="stylesheet">
		<table id='myTable' border="1">
			<tr>
				<th width="100">Kode Service</th>
				<th width="250">Deskripsi</th>
				<th>Jumlah</th>
				<th width="250">Keterangan</th>
			</tr>

			<?php
				while ($rows = sqlsrv_fetch_array($que_exe)) {
					echo "
	                  <tr>
	                    <td>".$rows['Service_Id']."</td>
	                    <td>".$rows['Descp']."</td>
	                    <td>".$rows['Qty']." ".$rows['Unit']."</td>
	                    <td>".$rows['Keterangan']."</td>
	                  </tr>
	                ";
				}
			?>

		</table>
	</div>
	<br>
	<button type="button" class="btn" onclick="PrintInv();">Print</button>
	<a class="btn" id="btnExport">Export</a>

	<script>
	function PrintInv()
	{
		var date = document.getElementById('tanggal').value;
		var mywindow = window.open('', 'PRINT', 'height=400,width=600');

		mywindow.document.write('<html><head>');
		mywindow.document.write('</head><body >');
		mywindow.document.write('<center><h2>Stock Adjustment Report</h2></center>');
		mywindow.document.write('Tanggal Laporan : '+date);
		mywindow.document.write(document.getElementById("PrintArea").innerHTML);
		mywindow.document.write('</body></html>');

		mywindow.document.close(); // necessary for IE >= 10
		mywindow.focus(); // necessary for IE >= 10*/

		mywindow.print();
		mywindow.close();

		return true;
	}

    $("#btnExport").click(function (e) {
    	var htmltable= document.getElementById('myTable');
		var html = htmltable.outerHTML;
		var date = document.getElementById('tanggal').value;

		var title = "<center><h2>Laporan Pemakaian Harian</h2></center>";
		title = title + "Tanggal Laporan : "+date;

		html = title + html;

        var result = "data:application/vnd.ms-excel," + encodeURIComponent(html);
        this.href = result;
        this.download = "my-custom-filename.xls";
        return true;
    });
	</script>