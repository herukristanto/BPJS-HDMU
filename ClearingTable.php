<?php

	echo '
	<!-- ========== Datetime Picker ========== -->
	<!-- format tanggal php di ubah menjadi m/d/y mengikuti format JqueryUI -->
	  <link rel="stylesheet" href="css/jquery-ui.min.css"> 
	  <script src="js/jquery-ui.min.js"></script>
	  <script>
	    $( function() {
	      $( ".datepicker" ).datepicker();
	      $( ".datepicker" ).datepicker( "option", "dateFormat", "dd/mm/yy" );
	    } );
	  </script>
	<!-- ===================================== -->';

    include "koneksi.php";

	if(isset($_GET['no']))
	{
		$insno = $_GET['no'];

		$que = "SELECT * FROM T_Insurance where Insurance_Id = ".$insno." and clear <> 'X' order by bill_id";
		$sql = sqlsrv_query($conn,$que);

		echo "
		<table id='myTable' width='420' border='1' style='margin-top:10px' name='tabInv'>
		 <tr>
			<td width='100'><div align='center'>No.Invoice</div></td>
			<td width='132'><div align='center'>Tagihan</div></td>
			<td width='120'><div align='center'>Tanggal Pembayaran</div></td>
		 </tr>
		";

		while($hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)){
		  $que1 = "SELECT sum(Amount) as Amt FROM T_Billing where Bill_Id = '".$hasil['Bill_Id']."' group by Bill_Id";
		  $sql1 = sqlsrv_query($conn1,$que1);
		  $amount = sqlsrv_fetch_array($sql1, SQLSRV_FETCH_ASSOC);
		  echo "
		  <tr>
			<td>".$hasil['Bill_Id']."</td>
			<td>".number_format($amount['Amt'],0,",",".")."</td>
			<td contenteditable='true'><input type='text' class='datepicker'></input</td>
		  </tr>";
		}
		echo "</table>";
	}

?>
