<?php
session_start();
$religionid = $_GET['religionid'];
$name = $_GET['name'];
$statrel = $_GET['statrel'];
$simpan = $_GET['simpan'];

include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

$sql = "select * from M_Religion where Religion_Id = '".$religionid."'";
$sql_execute = sqlsrv_query($conn, $sql, array(), array( "Scrollable" => 'static' ));
$hitungbaris = sqlsrv_num_rows($sql_execute);
if ($hitungbaris > 0){
	if ($simpan=="baru"){
		echo
		"<script>
		alert('Data batal dicatat didalam sistem dikarenakan religion id sudah tercatat dalam database. Jika ingin merubah data dengan religion id tersebut, gunakan menu ubah religion pada menu utama');
		window.location.href='M_Religion_Create.php';
		</script>";
	} elseif ($simpan=="ubah") {
		$sql = "update M_Religion set Name = '".$name."', Active = '".$statrel."' where Religion_Id = '".$religionid."'";
		$sql_execute = sqlsrv_query($conn,$sql);

		$sql = "select * from M_Religion where Religion_Id = '".$religionid."'";
		$sql_execute = sqlsrv_query($conn,$sql);
		$hasil = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);

		echo
		"<script>
		alert('Data religion ".$hasil['Religion_Id']." - ".$hasil['Name']." Berhasil diubah');
		window.location.href='M_Religion_Change.php';
		</script>";
	}
} else {
	$sql = "insert into M_Religion values('".$religionid."','".$name."','X','".$_SESSION["username"]."',CONVERT(datetime, '".date('Y/m/d H:i:s')."', 120))";
	$sql_execute = sqlsrv_query($conn,$sql);

	$sql = "select * from M_Religion where Religion_Id = '".$religionid."'";
	$sql_execute = sqlsrv_query($conn,$sql);
	$hasil = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);

	echo
	"<script>
	alert('Data religion ".$hasil['Religion_Id']." - ".$hasil['Name']." Berhasil ditambah');
	window.location.href='M_Religion_Create.php';
	</script>";
}
?>
