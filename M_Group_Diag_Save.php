<?php
session_start();
$grup_id = $_GET['group_id'];
$desc = $_GET['desc'];
$simpan = $_GET['simpan'];

include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

if ($simpan == "ubah"){
	$sql = "update M_Group_Diag set Group_Desc = '".$desc."' where Group_Id = '".$grup_id."'";
	$sql_execute = sqlsrv_query($conn,$sql);

	$sql = "select * from M_Group_Diag where Group_Id = '".$grup_id."'";
	$sql_execute = sqlsrv_query($conn,$sql);
	$hasil = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);

	echo
	"<script>
	alert('Group Diagnosis ".$hasil['Group_Id']." Berhasil Diubah');
	window.location.href='M_Group_Diag_Change.php';
	</script>";
} elseif ($simpan == "baru") {
	$sql = "select * from M_Group_Diag where Group_Id = '".$grup_id."'";
	$sql_execute = sqlsrv_query($conn, $sql, array(), array( "Scrollable" => 'static' ));
	$hitungbaris = sqlsrv_num_rows($sql_execute);

	if ($hitungbaris == 0) {
		$sql = "insert into M_Group_Diag values('".$grup_id."','".$desc."','".$_SESSION["username"]."',CONVERT(datetime, '".date('Y/m/d H:i:s')."', 120))";
		$sql_execute = sqlsrv_query($conn,$sql);

		$sql = "select * from M_Group_Diag where Group_Id = '".$grup_id."'";
		$sql_execute = sqlsrv_query($conn,$sql);
		$hasil = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);

		echo
		"<script>
		alert('Group Diagnosis ".$hasil['Group_Id']." Berhasil Ditambah');
		window.location.href='M_Group_Diag_Create.php';
		</script>";
	} else {
		echo
		"<script>
		alert('Data sudah tercatat pada sistem sebelumnya.');
		window.location.href='M_Group_Diag_Create.php';
		</script>";
	}
}
?>
