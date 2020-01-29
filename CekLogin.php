<?php
include "koneksi.php";

//Form Login
$username = $_POST['username'];
$password = $_POST['password'];

//Encrypt_password
$password = strtoupper($password);
$pwd = 0;
for($i=0;$i<strlen($password);$i++){
	$pwd=$pwd+(ord($password{$i})*(strlen($password)-$i));
}

//Cek variabel user dan pass
if (empty($username) || empty($password)){
	echo "
	<script>
		alert('Masukan Username dan Password');
		window.location.href = 'index.html';
	</script>
	";
} else {
	// koneksi data base
	$que = "SELECT * FROM M_User WHERE User_Id = '".$username."' AND Password = '".$pwd."'";
	$que_exe = sqlsrv_query($conn, $que, array(), array( "Scrollable" => 'static' ));
	$count = sqlsrv_num_rows($que_exe);
	$result = sqlsrv_fetch_array($que_exe);

	// $sql = sqlsrv_query($conn,$que);
	$user = strip_tags($_POST['username']);

	if($count > 0) {	// Apabila username dan password di temukan
		session_start();
		$_SESSION["username"] = $user;
		$_SESSION["name"] = $result['Name'];
		header('location:main.php');
	}
	else {
		echo "
		<script>
			alert('Login Gagal');
			window.location.href = 'index.html';
		</script>
		";
	}
}
?>
