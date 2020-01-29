<?php
    include "koneksi.php";

	$caseno = "";
	$invno = "";
	$cond1 = "";

	if(isset($_GET['caseno']))
	{
		$caseno = str_replace("%20", " ", $_GET['caseno']);
	}

	if(isset($_GET['invno']))
	{
		$invno = str_replace("%20", " ", $_GET['invno']);
	}

	//=========== setting condition for selection ===========
	if($caseno <> ''){
		$cond1 = "where Case_No like '%".$caseno."%'";
	}

	if($invno <> ''){
		if($cond1 <> ''){
			$cond1 = $cond1." and Bill_Id like '%".$invno."%'";
		}
		else{
			$cond1 = "where Bill_Id like '%".$invno."%'";
		}
	}
	//========================================================

	if($cond1 <> ''){
	$que = "SELECT * FROM T_Billing ".$cond1."and status = 'X'";
	$sql = sqlsrv_query($conn,$que);

	echo "
	<table id='myTable' width='677' border='1' style='margin-top:10px;'>
  	<tr>
    	<td><div align='center'>No. Pasien</div></td>
    	<td><div align='center'>Nama Pasien</div></td>
		<td><div align='center'>No. Case</div></td>
    	<td><div align='center'>No. Invoice</div></td>
    	<td><div align='center'>Total Invoice</div></td>
  	</tr>
	";

    while($hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)){
	  $que1 = "SELECT name as Nama FROM M_Patient where PAT_NO = '".$hasil['Pat_No']."'";
	  $sql1 = sqlsrv_query($conn2,$que1);
	  $Patnam = sqlsrv_fetch_array($sql1, SQLSRV_FETCH_ASSOC);
      echo "
	  <tr class='srcRowInv'>
	  	<td>".$hasil['Pat_No']."</td>
		<td>".$Patnam['Nama']."</td>
		<td>".$hasil['Case_No']."</td>
		<td>".$hasil['Bill_Id']."</td>
		<td>".$hasil['Amount']."</td>
	  </tr>";
    }
	echo "</table>";

	echo '<script>
	$( ".srcRowInv" ).dblclick(function() {
		$("#Patno").val($(this).find("td").eq(0).text());
		$("#Nama").val($(this).find("td").eq(1).text());
		$("#Caseno").val($(this).find("td").eq(2).text());
		$("#Invno").val($(this).find("td").eq(3).text());
    $("#Reset").prop("disabled", false);
		modal.style.display = "none";
		$( "#Patno" ).focus();
		$("#srcCaseno").val("");
		$("#srcInvno").val("");
		$("#tabInv").empty();
	});
	</script>';
	}
?>
