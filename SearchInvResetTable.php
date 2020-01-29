<?php
    include "koneksi.php";
	
	$invno = "";
	$cond1 = "";
	
	if(isset($_GET['invno']))
	{
		$invno = str_replace("%20", " ", $_GET['invno']);
	}
	
	$que = "SELECT * FROM T_Insurance where bill_id like '%".$invno."%' and clear = 'X' order by bill_id";
	$sql = sqlsrv_query($conn,$que);
		
	echo "
	<table id='myTable' width='300' border='1' style='margin-top:10px;'>
  	<tr>
    	<td width = '120'><div align='center'>No.Invoice</div></td>
    	<td><div align='center'>Amount</div></td>
  	</tr>
	";	
	
    while($hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)){
	  $que1 = "SELECT amount as amt FROM T_Billing where bill_id = '".$hasil['Bill_Id']."'";
	  $sql1 = sqlsrv_query($conn1,$que1);
	  $amount = sqlsrv_fetch_array($sql1, SQLSRV_FETCH_ASSOC);
      echo "
	  <tr class='srcRowInv'>
	  	<td>".$hasil['Bill_Id']."</td>
		<td>".$amount['amt']."</td>
	  </tr>";
    }
	echo "</table>";
	
	echo '<script>
	$( ".srcRowInv" ).dblclick(function() {
		$("#noInv").val($(this).find("td").eq(0).text());
		modal.style.display = "none";
		$("#srcInvno").val("");
		$("#tab2").empty();		 
	});
	</script>';
	
?>