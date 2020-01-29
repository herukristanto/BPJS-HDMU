<?php
include "koneksi.php";

$username = $_POST["id"];
$passold = $_POST["oldpass"];
$passnew = $_POST["newpass"];

//Encrypt_password
$passlama = strtoupper($passold);
$pwd = 0;
for($i=0;$i<strlen($passlama);$i++){
	$pwd=$pwd+(ord($passlama{$i})*(strlen($passlama)-$i));
}

$quecek = "select count(*) from M_User where User_Id = '".$username."' and Password = '".$pwd."'";
$quecek_exe = sqlsrv_query($conn,$quecek);
$hasil = sqlsrv_fetch_array($quecek_exe);

if($hasil < 1){
	echo "Password lama salah";
}else{
	//Encrypt_password
	$passbaru = strtoupper($passnew);
	$pwd = 0;
	for($i=0;$i<strlen($passbaru);$i++){
		$pwd=$pwd+(ord($passbaru{$i})*(strlen($passbaru)-$i));
	}

	$queup = "update M_User set Password = '".$pwd."' where User_Id = '".$username."'";
	$queup_exe = sqlsrv_query($conn1,$queup);
	echo "Password berhasil diubah";
}
?>
