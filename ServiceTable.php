<html>
<head>
	<link href="css/style.css" rel="stylesheet">
	<script src="js/jquery-1.7.2.min.js"></script>

	<style type="text/css">
		button{
			min-width:50px !important;
		}
	</style>
</head>
<body>
	<?php 
		include 'koneksi.php';
		date_default_timezone_set("Asia/Bangkok");

		$caseno = $_GET["caseno"];

		$que = "SELECT T.Service_Id, M.Descp, T.Qty, M.Unit, T.Service_Price, T.Doctor_Id, T.Note, T.Billed, T.Flag, M.Unit, M.Stock, T.Create_Time FROM T_Service T, M_Service M WHERE T.Service_Id=M.Service_Id AND T.Case_No = ".$caseno." ORDER BY T.Create_Time";
		// echo $que;
		$que_exe = sqlsrv_query($conn, $que);

		echo "
			<table id='myTable'>
				<tr>
					<td></td>
					<td>Kode Service</td>
					<td>Deskripsi</td>
					<td>Jumlah</td>
					<td>Satuan</td>
					<td>Harga</td>
					<td>Kode Dokter</td>
					<td>Keterangan</td>
					<td hidden></td>
				</tr>";

		while ($rows = sqlsrv_fetch_array($que_exe)) {
			$color = "";
			if($rows['Qty'] < 0){
				$color = "  style='background-color:#f7cac9 !important;'";
			}
			echo "
				<tr".$color.">";

			if($rows['Billed'] <> "" && is_null($rows['Billed']) == false){
				echo "<td>Billed</td>";
			}else{
				echo "<td><input type='button' class='delKey' value='Del'></td>";
			}

			echo "
					<td>".$rows['Service_Id']."</td>
					<td>".$rows['Descp']."</td>
					<td>".$rows['Qty']."</td>
					<td>".$rows['Unit']."</td>
					<td>".number_format($rows['Service_Price'],0,",",".")."</td>
					<td>".$rows['Doctor_Id']."</td>
					<td>".$rows['Note']."</td>
					<td hidden>".$rows['Create_Time']->format('Y-m-d H:i:s')."</td>
					<td hidden>".$rows['Stock']."</td>
				</tr>
			";
		}

		echo "
			</table>
		";
		
	?>


	<form action='DeleteService.php' method='post' id='target' onsubmit="return msgbox();">
		<input type="hidden" name="caseno" id="caseno" value="<?php echo $caseno; ?>" >
		<input type="hidden" name="servis" id="servis">
		<input type="hidden" name="qty" id="qty">
		<input type="hidden" name="pot" id="pot">
		<input type="hidden" name="time" id="time">
	</form>
	
<script type="text/javascript">
	$('.delKey').click(function(){
		var row = $(this).parents('tr');

		$("#servis").val(row.find('td:eq(1)').text());
		$("#qty").val(row.find('td:eq(3)').text());
		$("#time").val(row.find('td:eq(8)').text());
		$("#pot").val(row.find('td:eq(9)').text());

		$( "#target" ).submit();

	});

	function msgbox(){
		if (confirm("Delete Service?")) {
		    return true;
		} else {
		    return false;
		}
	}

</script>
</body>
<html>