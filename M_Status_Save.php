<?php
session_start();
$statusid = $_GET['statusid'];
$namestatus = $_GET['namestatus'];
$statstatus = $_GET['statstatus'];
$simpan = $_GET['simpan'];

include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

$sql = "select * from M_Status where Status_Id = '".$statusid."'";
$sql_execute = sqlsrv_query($conn, $sql, array(), array( "Scrollable" => 'static' ));
$hitungbaris = sqlsrv_num_rows($sql_execute);
if ($hitungbaris > 0){
	if ($simpan=="baru"){
		echo
		"<script>
		alert('Data batal dicatat didalam sistem dikarenakan status id sudah tercatat dalam database. Jika ingin merubah data dengan status id tersebut, gunakan menu ubah status pada menu utama');
		window.location.href='M_Status_Create.php';
		</script>";
	} elseif ($simpan=="ubah") {
		$sql = "update M_Status set Name = '".$namestatus."', Active = '".$statstatus."' where Status_Id = '".$statusid."'";
		$sql_execute = sqlsrv_query($conn,$sql);

		$sql = "select * from M_Status where Status_Id = '".$statusid."'";
		$sql_execute = sqlsrv_query($conn,$sql);
		$hasil = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);

		echo
		"<script>
		alert('Status ".$hasil['Status_Id']." - ".$hasil['Name']." Berhasil diubah');
		window.location.href='M_Status_Change.php';
		</script>";
	}
} else {
	$sql = "insert into M_Status values('".$statusid."','".$namestatus."','X','".$_SESSION["username"]."',CONVERT(datetime, '".date('Y/m/d H:i:s')."', 120))";
	$sql_execute = sqlsrv_query($conn,$sql);

	$sql = "select * from M_Status where Status_Id = '".$statusid."'";
	$sql_execute = sqlsrv_query($conn,$sql);
	$hasil = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);

	echo
	"<script>
	alert('Status ".$hasil['Status_Id']." - ".$hasil['Name']." Berhasil ditambah');
	window.location.href='M_Status_Create.php';
	</script>";
}
?>
