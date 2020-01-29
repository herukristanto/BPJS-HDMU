<?php
    include "koneksi.php";

	$group = "";
	$kode = "";
	$desc = "";
	$cond1 = "";

	if(isset($_GET['grup']))
	{
		$group = $_GET['grup'];
	}
	if(isset($_GET['kode']))
	{
		$kode = $_GET['kode'];
	}
	if(isset($_GET['desc']))
	{
		$desc = $_GET['desc'];
	}

	//=========== setting condition for selection ===========
	if($group <> ''){
		$cond1 = "and Diag_Grp like '%".$group."%'";
	}

	if($kode <> ''){
		$cond1 = $cond1." and Diag_Id like '%".$kode."%'";
	}

	if($desc <> ''){
		$cond1 = $cond1." and Diagnose = '".$desc."'";
	}
	//========================================================

	$que = "SELECT * FROM M_Diagnose where Active = 'X'".$cond1;
	$sql = sqlsrv_query($conn,$que);

	echo "
	<table id='myTable' width='677' border='1' style='margin-top:10px;'>
  	<tr>
    	<td><div align='center'>Group</div></td>
    	<td><div align='center'>Kode Diagnosa</div></td>
    	<td><div align='center'>Deskripsi</div></td>
  	</tr>
	";

    while($hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)){

      echo "
	  <tr class='srcRow'>
	  	<td>".$hasil['Diag_Grp']."</td>
		<td>".$hasil['Diag_Id']."</td>
		<td>".$hasil['Diagnose']."</td>
	  </tr>";
    }
	echo "</table>";

	echo '<script>
	$( ".srcRow" ).dblclick(function() {
		$("#Group").val($(this).find("td").eq(0).text());
		$("#KodeDiag").val($(this).find("td").eq(1).text());
		$("#DescDiag").val($(this).find("td").eq(2).text());
		modal.style.display = "none";
		$("#srcGroup").val("");
		$("#srcKode").val("");
		$("#srcDesc").val("");
		//$("#tab1").empty();
	});
	</script>';

?>
