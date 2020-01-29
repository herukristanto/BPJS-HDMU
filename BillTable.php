<?php
	include "koneksi.php";

	if(isset($_GET['case']))
	{
		$caseno = $_GET['case'];
	}

	if(isset($_GET['inv']))
	{
		$string = " and Billed = '".$_GET['inv']."'";
	}

	$queTab = "SELECT * FROM T_Service where Display = 'X' and case_no = ".$caseno.$string;
	$string = "";
	$sqlTab = sqlsrv_query($conn3,$queTab);

	$amount = 0;
	$service = false;

	echo "
	<table id='myTable' width='987' border='1' style='margin-top:10px;'>
	  <tr>
		<td width='93'><div align='center'>Kode Service</div></td>
    	<td width='261'><div align='center'>Deskripsi</div></td>
    	<td width='48'><div align='center'>Qty</div></td>
    	<td width='102'><div align='center'>Kode Dokter</div></td>
    	<td width='129'><div align='center'>Harga</div></td>
    	<td width='314'><div align='center'>Keterangan</div></td>
	  </tr>
	";

  while($hasilTab = sqlsrv_fetch_array($sqlTab, SQLSRV_FETCH_ASSOC)){
		$service = true;
		$que2 = "SELECT Descp from M_Service where Service_Id='".$hasilTab['Service_Id']."'";
		$sql2 = sqlsrv_query($conn2,$que2);
		$ket = sqlsrv_fetch_array($sql2, SQLSRV_FETCH_ASSOC);
    echo "
		  <tr>
			  <td>".$hasilTab['Service_Id']."</td>
				<td>".$ket['Descp']."</td>
				<td>".$hasilTab['Qty']."</td>
				<td>".$hasilTab['Doctor_Id']."</td>
				<td>".number_format($hasilTab['Service_Price'],0,",",".")."</td>
				<td>".$hasilTab['Note']."</td>
		  </tr>";
	  $amount = $amount + $hasilTab['Service_Price'];
  }
	echo "</table>";
	if($service == true){
		echo "<input type='text' id='hidAmt' value='".$amount."' style='display:none;' />";
	}else{
		echo "<input type='text' id='hidAmt' value='false' style='display:none;' />";
	}

?>
