<?php
    include "koneksi.php";

	$insno = "";
	$insnam = "";
	$cond1 = "";

	if(isset($_GET['insno']))
	{
		$insno = str_replace("%20", " ", $_GET['insno']);
	}
	if(isset($_GET['nama']))
	{
		$insnam = str_replace("%20", " ", $_GET['nama']);
	}

	//=========== setting condition for selection ===========
	if($insno <> ''){
		$cond1 = "where INS_NO like '%".$insno."%'";
	}

	if($insnam <> ''){
		if($cond1 <> ''){
			$cond1 = $cond1." and Name like '%".$insnam."%'";
		}
		else{
			$cond1 = "where Name like '%".$insnam."%'";
		}
	}

	//========================================================

	if($cond1 <> ''){
	$que = "SELECT * FROM M_Insurance ".$cond1."and active = 'X'";
	$sql = sqlsrv_query($conn,$que);

	echo "
	<table id='myTable' border='1' style='margin-top:10px;'>
  	<tr>
    	<td width='100px'><div align='center'><b>Kode Asuransi</b></div></td>
    	<td width='180px'><div align='center'><b>Nama Asuransi</b></div></td>
  	</tr>
	";

    while($hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)){

      echo "
	  <tr class='srcRowIns'>
	  	<td>".$hasil['INS_NO']."</td>
		<td>".$hasil['Name']."</td>
	  </tr>";
    }
	echo "</table>";

	echo '<script>
	$( ".srcRowIns" ).dblclick(function() {
		$("#Asuransi").val($(this).find("td").eq(0).text());
		$("#NamaIns").val($(this).find("td").eq(1).text());
		modal.style.display = "none";
		$("#srcInsno").val("");
		$("#srcInsnam").val("");
		$("#tab2").empty();

		$("#ClearTab").load("ClearingTable.php?no=" + $(this).find("td").eq(0).text());
 		$("#SP").prop("checked", false);
	});
	</script>';

	}
?>
