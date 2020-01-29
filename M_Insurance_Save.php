<?php
session_start();
if(isset($_POST['kodeasuransi'])){
	$kodeasuransi = $_POST['kodeasuransi'];
}
$namaasuransi = $_POST['namaasuransi'];
$alamat = $_POST['alamat'];
$telp = $_POST['notelepon'];
$kontak = $_POST['kontakperson'];
$statasuransi = $_POST['statasuransi'];
$simpan = $_POST['hidmode'];

include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

if ($simpan == "ubah"){
	$sql = "update M_Insurance set Name = '".$namaasuransi."', Address = '".$alamat."', Telp = '".$telp."', Contact = '".$kontak."', Active = '".$statasuransi."' where INS_NO = '".$kodeasuransi."'";
	$sql_execute = sqlsrv_query($conn,$sql);

	$sql = "select * from M_Insurance where INS_NO = '".$kodeasuransi."'";
	$sql_execute = sqlsrv_query($conn,$sql);
	$hasil = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);

	echo
	"<script>
	alert('Asuransi ".$hasil['INS_NO']." - ".$hasil['Name']." Berhasil Diubah');
	window.location.href='M_Insurance_Change.php';
	</script>";

} elseif ($simpan == "baru") {

	$sql = "select * from M_Insurance where Name = '".$namaasuransi."'";
	$sql_execute = sqlsrv_query($conn, $sql, array(), array( "Scrollable" => 'static' ));
	$hitungbaris = sqlsrv_num_rows($sql_execute);

	if ($hitungbaris==0){
		$sql = "insert into M_Insurance values('".$namaasuransi."','".$alamat."','".$telp."','".$kontak."','X','".$_SESSION["username"]."',CONVERT(datetime, '".date('Y/m/d H:i:s')."', 120))";
		$sql_execute = sqlsrv_query($conn,$sql);

		$sql = "select * from M_Insurance where Name = '".$namaasuransi."'";
		$sql_execute = sqlsrv_query($conn,$sql);
		$hasil = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);
		echo
		"<script>
		alert('Asuransi ".$hasil['INS_NO']." - ".$hasil['Name']." Berhasil Ditambah');
		window.location.href='M_Insurance_Create.php';
		</script>";
	} else {
		echo
		"<script>
		alert('Data sudah tercatat pada sistem sebelumnya');
		window.location.href='M_Insurance_Create.php';
		</script>";
	}

}
?>
