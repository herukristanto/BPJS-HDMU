<?php
    include "koneksi.php";
			
	$rm = "";
	$caseno = "";
	$patno = "";
	$cond1 = "";
	
	if(isset($_GET['caseno']))
	{
		$caseno = str_replace("%20", " ", $_GET['caseno']);
	}
	if(isset($_GET['patno']))
	{
		$patno = str_replace("%20", " ", $_GET['patno']);
	}

	//=========== setting condition for selection ===========
	if($caseno <> ''){
		$cond1 = "where Case_No like '%".$caseno."%'";
	}
	
	if($patno <> ''){
		if($cond1 <> ''){
			$cond1 = $cond1." and Pat_No like '%".$patno."%'";
		}
		else{
			$cond1 = "where Pat_No like '%".$patno."%'"; 	
		}
	}
	
	//========================================================
	
	if($cond1 <> ''){
	$que = "SELECT * FROM T_Case ".$cond1;
	$sql = sqlsrv_query($conn,$que);
		
	echo "
	<table id='myTable' width='677' border='1' style='margin-top:10px;'>
  	<tr>
    	<td><div align='center'>No. Case</div></td>
    	<td><div align='center'>No. Pasien</div></td>
    	<td><div align='center'>Tanggal Case</div></td>
    	<td><div align='center'>Jam Case</div></td>
    	<td><div align='center'>Pembayar</div></td>
  	</tr>
	";	
	
    while($hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)){
	
      echo "
	  <tr class='srcRowCase'>
	  	<td>".$hasil['Case_No']."</td>
		<td>".$hasil['Pat_No']."</td>
	  	<td>".$hasil['Case_Date']->format('d/m/Y')."</td>
		<td>".$hasil['Case_Time']."</td>
		<td>".$hasil['Pembayar']."</td>
	  </tr>";
    }
	echo "</table>";
	
	echo '<script>
	$( ".srcRowCase" ).dblclick(function() {
		$("#Patno").val($(this).find("td").eq(4).text());
		modal.style.display = "none";
		$("#srcCaseno").val("");
		$("#srcPatno").val("");
		$("#tab2").empty();		 
	});
	</script>';
	
	}
?>