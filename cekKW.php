<?php
	include "koneksi.php";

	$noKW = $_GET['noKW'];
	echo $noKW;

	$que = "select * from T_POS where pay_id ='".$noKW."' and Printed = 'X'";
	echo $que;
	$que_exe = sqlsrv_query($conn,$que);
	$hasil = sqlsrv_fetch_array($que_exe, SQLSRV_FETCH_ASSOC);

	if($hasil){
		echo "
		<script>
			alert('Kwitansi sudah pernah diprint, tidak bisa diprint ulang');
		</script>";
	}else{
		$queUp = "update T_POS set Printed = 'X' where Pay_Id = '".$noKW."'";
		$queUp_exe = sqlsrv_query($conn,$queUp);
		echo "
		<script>
			parent.PrintKW();
		</script>
		";

	}
?>
