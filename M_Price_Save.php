<?php
session_start();
$serviceid = $_GET['serviceid'];
$harga = $_GET['harga'];
$validfrom = $_GET['validfrom'];
$validto = $_GET['validto'];
$simpan = $_GET['simpan'];

include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

$sql = "select P.Service_Id, S.Descp from M_Price P, M_Service S where P.Service_Id = S.Service_Id and P.Service_Id ='".$serviceid."'";
$sql_execute = sqlsrv_query($conn, $sql, array(), array( "Scrollable" => 'static' ));
$hitungbaris = sqlsrv_num_rows($sql_execute);
if ($hitungbaris > 0){
	if ($simpan=="baru"){
		echo
		"<script>
		alert('Data batal dicatat didalam sistem dikarenakan service id sudah tercatat dalam database. Jika ingin merubah data dengan service id tersebut, gunakan menu ubah price pada menu utama');
		window.location.href='M_Price_Create.php';
		</script>";
	} elseif ($simpan=="ubah") {
		$sql = "update M_Price set Price = '".$harga."', Valid_From = CONVERT(datetime,'".$validfrom."', 103), Valid_to = CONVERT(datetime,'".$validto."', 103) where Service_Id = '".$serviceid."'";
		$sql_execute = sqlsrv_query($conn,$sql);

		$sql = "select P.Service_Id, S.Descp from M_Price P, M_Service S where P.Service_Id = S.Service_Id and P.Service_Id ='".$serviceid."'";
		$sql_execute = sqlsrv_query($conn,$sql);
		$hasil = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);

		echo
		'<script>
		alert("Harga '.$hasil['Service_Id'].' - '.$hasil['Descp'].' berhasil diubah");
		window.location.href="M_Price_Create.php";
		</script>';
	}
} else {
	$sql = "insert into M_Price values('".$serviceid."',CONVERT(Money,'".$harga."'),CONVERT(datetime,'".$validfrom."', 103),CONVERT(datetime,'".$validto."', 103),'".$_SESSION["username"]."',CONVERT(datetime, '".date('Y/m/d H:i:s')."', 120))";
	$sql_execute = sqlsrv_query($conn,$sql);

	$sql = "select P.Service_Id, S.Descp from M_Price P, M_Service S where P.Service_Id = S.Service_Id and P.Service_Id ='".$serviceid."'";
	$sql_execute = sqlsrv_query($conn,$sql);
	$hasil = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);

	$msg = "Harga ".$hasil['Service_Id']." - ".$hasil['Descp']." berhasil dibuat";

	echo
	'<script>
	alert("'.$msg.'");
	window.location.href="M_Price_Create.php";
	</script>';
}
?>
