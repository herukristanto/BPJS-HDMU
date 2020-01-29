<?php
include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

$userid = $_GET['userid'];
$passbaru = $_GET['passbaru'];

//Encrypt_password
$passbaru = strtoupper($passbaru);
$pwd = 0;
for($i=0;$i<strlen($passbaru);$i++){
	$pwd=$pwd+(ord($passbaru{$i})*(strlen($passbaru)-$i));
	echo $pwd;
}

$sql = "UPDATE M_User SET Password='".$pwd."' WHERE User_Id='".$userid."'";
$sql_execute = sqlsrv_query($conn,$sql);

echo
"<script>
alert('Password berhasil diganti');
</script>";
?>