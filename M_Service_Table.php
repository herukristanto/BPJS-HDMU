<?php
include "koneksi.php";
if (isset($_GET['katakunci']))
{
	// $katakunci = $_GET['katakunci'];
	$katakunci = str_replace("%20", " ", $_GET['katakunci']);
	
	$query = "SELECT * FROM M_service WHERE Service_Id like '%". $katakunci ."%' order by Service_Id";
	$params = array();
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$sql = sqlsrv_query( $conn, $query , $params, $options );
	$row_count = sqlsrv_num_rows( $sql );
	if ($row_count == 0) {
		echo "Data tidak ditemukan..";
	} else {
		if ($sql){
			echo "
			<table id=\"myTable\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
			<tr>
			<td>Kode Service</td>
			<td>Deskripsi</td>
			<td>Unit</td>
			<td>Potong Stok</td>
			<td>Servis Dokter</td>
			<td>Display Servis</td>
			<td>Group Servis</td>
			<td>Valid From</td>
			<td>Valid To</td>
			</tr>";
			while($rs = sqlsrv_fetch_array($sql)){
				$result = $rs['Valid_From']->format('d/m/Y');
				$result2 = $rs['Valid_to']->format('d/m/Y');
				if(strtoupper($rs['Srv_Group']) == "FRM"){
					$srvGrup = "<b>FARMASI</b>";
				}else if(strtoupper($rs['Srv_Group']) == "MMD"){
					$srvGrup = "<b>MMD</b>";
				}else{
					$srvGrup = "Lain-lain";
				}
				echo "
				<tr>
					<td>".$rs['Service_Id']."</td>
					<td>".$rs['Descp']."</td>
					<td>".$rs['Unit']."</td>
					<td>".$rs['Stock']."</td>
					<td>".$rs['Doctor']."</td>
					<td>".$rs['Display']."</td>
					<td>".$srvGrup."</td>
					<td>".$result."</td>
					<td>".$result2."</td>
				</tr>
				";
			}
		}
		echo"</table>";
	}
}
?>

<script>
	$('#myTable tr').dblclick(function(){
		var stok = $(this).find("td:eq(3)").text();

		$("#serviceid").val($(this).find("td:eq(0)").text());
		$("#deskripsi").val($(this).find("td:eq(1)").text());
		$("#unit").val($(this).find("td:eq(2)").text().trim());

		if (stok=="X"){
			radiobtn = document.getElementById("Ya");
			radiobtn.checked = true;
		} else if(stok==" "){
			radiobtn = document.getElementById("Tidak");
			radiobtn.checked = true;
		}

		if ($(this).find("td:eq(4)").text() == "X"){
			radiobtn = document.getElementById("dokYa");
			radiobtn.checked = true;
		} else{
			radiobtn = document.getElementById("dokTidak");
			radiobtn.checked = true;
		}

		if ($(this).find("td:eq(5)").text() == "X"){
			radiobtn = document.getElementById("dispya");
			radiobtn.checked = true;
		} else{
			radiobtn = document.getElementById("disptdk");
			radiobtn.checked = true;
		}

		if ($(this).find("td:eq(6)").text() == "FARMASI"){
			radiobtn = document.getElementById("frm");
			radiobtn.checked = true;
		} else if ($(this).find("td:eq(6)").text() == "MMD"){
			radiobtn = document.getElementById("mmd");
			radiobtn.checked = true;
		} else{
			radiobtn = document.getElementById("oth");
			radiobtn.checked = true;
		}

		$("#datepicker").val($(this).find("td:eq(7)").text());
		$("#datepicker1").val($(this).find("td:eq(8)").text());

		$("#tampiltabel").empty();
		modal.style.display = "none";

		$("#upData").prop( "disabled", false );
	})
</script>
