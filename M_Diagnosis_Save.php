<?php
session_start();
$grup = $_GET['grup'];
$iddiag = $_GET['iddiag'];
$diagnose = $_GET['diagnose'];
$statdiag = $_GET['statdiag'];
$simpan = $_GET['simpan'];

include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

if ($simpan == "ubah"){
	$sql = "update M_Diagnose set Diagnose = '".$diagnose."', Active = '".$statdiag."' where Diag_Id = '".$iddiag."'";
	$sql_execute = sqlsrv_query($conn,$sql);

	$sql = "select * from M_Diagnose where Diag_Id = '".$iddiag."'";
	$sql_execute = sqlsrv_query($conn,$sql);
	$hasil = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);

	echo
	"<script>
	alert('Diagnosis ".$hasil['Diag_Id']." Berhasil Diubah');
	window.location.href='M_Diagnosis_Change.php';
	</script>";
} elseif ($simpan == "baru") {
	$sql = "select * from M_Diagnose where Diag_Id = '".$iddiag."'";
	$sql_execute = sqlsrv_query($conn, $sql, array(), array( "Scrollable" => 'static' ));
	$hitungbaris = sqlsrv_num_rows($sql_execute);

	if ($hitungbaris == 0) {
		$sql = "insert into M_Diagnose values('".$grup."','".$iddiag."','".$diagnose."','".$statdiag."','".$_SESSION["username"]."',CONVERT(datetime, '".date('Y/m/d H:i:s')."', 120))";
		$sql_execute = sqlsrv_query($conn,$sql);

		$sql = "select * from M_Diagnose where Diag_Id = '".$iddiag."'";
		$sql_execute = sqlsrv_query($conn,$sql);
		$hasil = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);

		echo
		"<script>
		alert('Diagnosis ".$hasil['Diag_Id']." Berhasil Ditambah');
		window.location.href='M_Diagnosis_Create.php';
		</script>";
	} else {
		echo
		"<script>
		alert('Data sudah tercatat pada sistem sebelumnya.');
		window.location.href='M_Diagnosis_Create.php';
		</script>";
	}
}
?>
