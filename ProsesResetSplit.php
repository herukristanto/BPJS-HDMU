<?php
	include "koneksi.php";

	$ref = $_GET['ref'];
	$case = $_GET['case'];

	$que = "delete T_Billing where Ref = '".$ref."' and Amount < 0;";
	$que = $que." update T_Billing set Ref = '' where Ref = '".$ref."';";
	$que = $que." update T_Billing set Status = 'C' where Bill_Id = '".$ref."';";

    $que_exe = sqlsrv_query($conn,$que);

    echo "
    	<script>
			alert('Split Invoice berhasil direset.');
			window.location.href = 'Outpatient.php';
		</script>
    ";
?>