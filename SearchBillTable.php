<?php
    include "koneksi.php";

	$invno = "";
	$caseno = "";
	$cond1 = "";

	if(isset($_GET['invno']))
	{
		$invno = str_replace("%20", " ", $_GET['invno']);
	}
	if(isset($_GET['caseno']))
	{
		$caseno = str_replace("%20", " ", $_GET['caseno']);
	}

	//=========== setting condition for selection ===========
	if($invno <> ''){
		$cond1 = "where Bill_Id like '%".$invno."%'";
	}

	if($caseno <> ''){
		if($cond1 <> ''){
			$cond1 = $cond1." and Case_No like '%".$caseno."%'";
		}
		else{
			$cond1 = "where Case_No like '%".$caseno."%'";
		}
	}

	//========================================================
	if($cond1 <> ''){
	$que = "SELECT * FROM V_Case ".$cond1." and (Bill_Id <> '' and status <> 'c') order by Bill_Id desc";
	$sql = sqlsrv_query($conn,$que);

	echo "
	<table id='myTable' width='677' border='1' style='margin-top:10px;'>
  	<tr>
    	<td><div align='center'>No. Invoice</div></td>
    	<td><div align='center'>No. Case</div></td>
    	<td><div align='center'>Amount</div></td>
		<td><div align='center'>Tanggal Case</div></td>
    	<td><div align='center'>Jam Case</div></td>
    	<td><div align='center'>Pembayar</div></td>
		<td style='display:none;'><div align='center'>No. Pasien</div></td>
  		<td style='display:none;'><div align='center'>Nama</div></td>
  		<td style='display:none;'><div align='center'>DOB</div></td>
  		<td style='display:none;'><div align='center'>Sex</div></td>
  	</tr>
	";

    while($hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)){
	  	if($hasil['Pat_Sex']=='M')
		{
			$sex1 = 'Laki-Laki';
		}
		else
		{
			$sex1 = 'Perempuan';
		}
      echo "
	  <tr class='srcRowCase'>
	  <td>".$hasil['Bill_Id']."</td>
      <td>".$hasil['Case_No']."</td>
      <td>".$hasil['Amount']."</td>
      <td>".$hasil['Case_Date']->format('d/m/Y')."</td>
      <td>".$hasil['Case_Time']."</td>
      <td>".$hasil['Pembayar']."</td>
	  <td style='display:none;'>".$hasil['Pat_No']."</td>
      <td style='display:none;'>".$hasil['Pat_Name']."</td>
      <td style='display:none;'>".$hasil['Pat_DOB']->format('d/m/Y')."</td>
      <td style='display:none;'>".$sex1."</td>
	  </tr>";
    }
	echo "</table>";

	echo '<script>
	$( ".srcRowCase" ).dblclick(function() {
		$("#Invno").val($(this).find("td").eq(0).text());
		$("#Caseno").val($(this).find("td").eq(1).text());
		$("#Patno").val($(this).find("td").eq(6).text());
		$("#Nama").val($(this).find("td").eq(7).text());
		$("#DOB").val($(this).find("td").eq(8).text());
		$("#Sex").val($(this).find("td").eq(9).text());
		$("#Pembayar").val($(this).find("td").eq(5).text());
		modal.style.display = "none";
		$("#srcCaseno").val("");
		$("#srcInvno").val("");
		$("#tab2").empty();

		$("#Billing").prop("disabled", true);

		$("#BillTab").empty();
		$("#BillTab").load("BillTable.php?case=" + $(this).find("td").eq(1).text() + "&inv=" + $(this).find("td").eq(0).text());
	});
	</script>';

	}
?>
