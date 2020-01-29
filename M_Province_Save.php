<?php
session_start();
$propinsiid = $_GET['propinsiid'];
$namapropinsi = $_GET['namapropinsi'];
$statprop = $_GET['statprop'];
$simpan = $_GET['simpan'];

include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

$sql = "select * from M_Propinsi where Prop_Id = '".$propinsiid."'";
$sql_execute = sqlsrv_query($conn, $sql, array(), array( "Scrollable" => 'static' ));
$hitungbaris = sqlsrv_num_rows($sql_execute);
if ($hitungbaris > 0){
	if ($simpan=="baru"){
		echo
		"<script>
		alert('Data batal dicatat didalam sistem dikarenakan propinsi id sudah tercatat dalam database. Jika ingin merubah data dengan propinsi id tersebut, gunakan menu ubah propinsi pada menu utama');
		window.location.href='M_Province_Create.php';
		</script>";
	} elseif ($simpan=="ubah") {
		$sql = "update M_Propinsi set Name = '".$namapropinsi."', Active = '".$statprop."' where Prop_Id = '".$propinsiid."'";
		$sql_execute = sqlsrv_query($conn,$sql);

		$sql = "select * from M_Propinsi where Prop_Id = '".$propinsiid."'";
		$sql_execute = sqlsrv_query($conn,$sql);
		$hasil = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);

		echo
		"<script>
		alert('Propinsi ".$hasil['Prop_Id']." - ".$hasil['Name']." Berhasil diubah');
		window.location.href='M_Province_Change.php';
		</script>";
	}
} else {
	$sql = "insert into M_Propinsi values('".$propinsiid."','".$namapropinsi."','X','".$_SESSION["username"]."',CONVERT(datetime, '".date('Y/m/d H:i:s')."', 120))";
	$sql_execute = sqlsrv_query($conn,$sql);

	$sql = "select * from M_Propinsi where Prop_Id = '".$propinsiid."'";
	$sql_execute = sqlsrv_query($conn,$sql);
	$hasil = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);

	echo
	"<script>
	alert('Propinsi ".$hasil['Prop_Id']." - ".$hasil['Name']." Berhasil Ditambah');
	window.location.href='M_Province_Create.php';
	</script>";
}
?>
