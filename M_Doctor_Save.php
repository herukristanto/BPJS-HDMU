<?php
session_start();
$iddok = $_GET['iddok'];
$namadok = $_GET['namadok'];
$statdok = $_GET['statdok'];
$simpan = $_GET['simpan'];

include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

if ($simpan == "ubah"){
	$sql = "update M_Doctor set Name = '".$namadok."', Active = '".$statdok."' where Doctor_Id = '".$iddok."'";
	$sql_execute = sqlsrv_query($conn,$sql);

	$sql = "select * from m_doctor where Doctor_Id = '".$iddok."'";
	$sql_execute = sqlsrv_query($conn,$sql);
	$hasil = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);

	echo
	"<script>
	alert('Dokter ".$hasil['Doctor_Id']." - ".$hasil['Name']." Berhasil Diubah');
	window.location.href='M_Doctor_Change.php';
	</script>";
} elseif ($simpan == "baru") {
	$sql = "select * from M_Doctor where name = '".$namadok."'";
	$sql_execute = sqlsrv_query($conn, $sql, array(), array( "Scrollable" => 'static' ));
	$hitungbaris = sqlsrv_num_rows($sql_execute);

	if ($hitungbaris == 0) {
		$sql = "insert into M_Doctor values('".$namadok."','X','".$_SESSION["username"]."',CONVERT(datetime, '".date('Y/m/d H:i:s')."', 120))";
		$sql_execute = sqlsrv_query($conn,$sql);

		$sql = "select * from m_doctor where name = '".$namadok."'";
		$sql_execute = sqlsrv_query($conn,$sql);
		$hasil = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);

		echo
		"<script>
		alert('Dokter ".$hasil['Doctor_Id']." - ".$hasil['Name']." Berhasil Ditambah');
		window.location.href='M_Doctor_Create.php';
		</script>";
	} else {
		echo
		"<script>
		alert('Data sudah tercatat pada sistem sebelumnya.');
		window.location.href='M_Doctor_Create.php';
		</script>";
	}
}
?>
