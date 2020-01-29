<?php
    include "koneksi.php";

	$rm = "";
	$patnam = "";
	$DOB = "";
	$cond1 = "";

	if(isset($_GET['tgl']))
	{
		$DOB = $_GET['tgl'];
		if($DOB <> "")
		{
			$DOB1 = DateTime::createFromFormat('d/m/Y', $DOB);
			$DOB = $DOB1->format('Y/m/d');
		}
	}
	if(isset($_GET['patno']))
	{
		$rm = $_GET['patno'];
	}
	if(isset($_GET['nama']))
	{
		//$patnam = $_GET['nama'];
		$patnam = str_replace("%20", " ", $_GET['nama']);
	}

	//=========== setting condition for selection ===========
	if($rm <> ''){
		$cond1 = "where PAT_NO like '%".$rm."%'";
	}

	if($patnam <> ''){
		if($cond1 <> ''){
			$cond1 = $cond1." and Name like '%".$patnam."%'";
		}
		else{
			$cond1 = "where Name like '%".$patnam."%'";
		}
	}

	if($DOB <> ''){
		if($cond1 <> ''){
			$cond1 = $cond1." and DOB = '".$DOB."'";
		}
		else{
			$cond1 = "where DOB = '".$DOB."'";
		}
	}
	//========================================================

	if($cond1 <> ''){
	$que = "SELECT * FROM M_Patient ".$cond1;
	$sql = sqlsrv_query($conn,$que);
	// echo $que;
	echo "
	<table id='myTable' width='677' border='1' style='margin-top:10px;'>
  	<tr>
    	<td><div align='center'>No. Pasien</div></td>
    	<td><div align='center'>Nama Pasien</div></td>
    	<td><div align='center'>Tanggal Lahir</div></td>
    	<td><div align='center'>Jenis Kelamin</div></td>
    	<td><div align='center'>Alamat</div></td>
    	<td><div align='center'>No. Telp</div></td>
  	</tr>
	";

    while($hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)){
		if($hasil['Sex']=='M')
		{
			$sex1 = 'Laki-Laki';
		}
		else
		{
			$sex1 = 'Perempuan';
		}
      echo "
	  <tr class='srcRow'>
	  	<td>".$hasil['PAT_NO']."</td>
		<td>".$hasil['Name']."</td>
	  	<td>".$hasil['DOB']->format('d/m/Y')."</td>
		<td>".$sex1."</td>
		<td>".$hasil['Address']."</td>
		<td>".$hasil['Telp']."</td>
	  </tr>";
    }
	echo "</table>";

	echo '<script>
	$( ".srcRow" ).dblclick(function() {
		$("#Patno").val($(this).find("td").eq(0).text());
		$("#Nama").val($(this).find("td").eq(1).text());
		$("#DOB").val($(this).find("td").eq(2).text());
		if($(this).find("td").eq(3).text() == "Laki-Laki"){
			$("#Sex").val("M");
		}
		else{
			$("#Sex").val("F");
		}
		$("#Telp").val($(this).find("td").eq(5).text());
		modal.style.display = "none";
		$( "#tgl" ).focus();
		$("#srcPatno").val("");
		$("#srcPatnam").val("");
		$("#srcDOB").val("");
		$("#tab1").empty();
	});
	</script>';
	}
?>
