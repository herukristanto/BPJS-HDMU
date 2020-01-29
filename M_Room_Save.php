<?php
session_start();
$roomid = $_GET['roomid'];
$nameroom = $_GET['nameroom'];
$statroom = $_GET['statroom'];
$simpan = $_GET['simpan'];

include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

$sql = "select * from M_Room where Room_Id = '".$roomid."'";
$sql_execute = sqlsrv_query($conn, $sql, array(), array( "Scrollable" => 'static' ));
$hitungbaris = sqlsrv_num_rows($sql_execute);
if ($hitungbaris > 0){
	if ($simpan=="baru"){
		echo
		"<script>
		alert('Data batal dicatat didalam sistem dikarenakan room id sudah tercatat dalam database. Jika ingin merubah data dengan room id tersebut, gunakan menu ubah room pada menu utama');
		window.location.href='M_Room_Create.php';
		</script>";
	} elseif ($simpan=="ubah") {
		$sql = "update M_Room set Name = '".$nameroom."', Active = '".$statroom."' where Room_Id = '".$roomid."'";
		$sql_execute = sqlsrv_query($conn,$sql);

		$sql = "select * from M_Room where Room_Id = '".$roomid."'";
		$sql_execute = sqlsrv_query($conn,$sql);
		$hasil = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);

		echo
		"<script>
		alert('Room ".$hasil['Room_Id']." - ".$hasil['Name']." Berhasil diubah');
		window.location.href='M_Room_Change.php';
		</script>";
	}
} else {
	$sql = "insert into M_Room values('".$roomid."','".$nameroom."','X','".$_SESSION["username"]."',CONVERT(datetime, '".date('Y/m/d H:i:s')."', 120))";
	$sql_execute = sqlsrv_query($conn,$sql);

	$sql = "select * from M_Room where Room_Id = '".$roomid."'";
	$sql_execute = sqlsrv_query($conn,$sql);
	$hasil = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);

	echo
	"<script>
	alert('Room ".$hasil['Room_Id']." - ".$hasil['Name']." Berhasil ditambah');
	window.location.href='M_Room_Create.php';
	</script>";
}
?>
