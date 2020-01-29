<html>
<head>
	<?php
	include "koneksi.php";

	if (isset($_GET['userid']))
	{
		$userid = $_GET['userid'];
		$query = "SELECT User_Id, Password FROM M_User WHERE User_Id like '". $userid ."'";
		$sql = sqlsrv_query($conn,$query);
		if ($sql){
			while($rs1 = sqlsrv_fetch_array($sql)){
				$Isi = $rs1['Password'];
			}
		}

		$passlama = $_GET['passlama'];

		//Encrypt_password
		$passlama = strtoupper($passlama);
		$pwd = 0;
		for($i=0;$i<strlen($passlama);$i++){
			$pwd=$pwd+(ord($passlama{$i})*(strlen($passlama)-$i));
			echo $pwd;
		}
	}
	?>
</head>
<body onload="autoclick()">
	<form name="myform">
		<input type="text" name="getIsi" id="getIsi" value="<?php echo $Isi ?>" disabled/>
		<input type="text" name="getIsi2" id="getIsi2" value="<?php echo $pwd ?>" disabled/>
		<input type="button" id="pencet" class="pencet" onclick="parent.savepassword(this.form.getIsi.value, this.form.getIsi2.value);" value="Cek" />
	</form>

	<script>
		function autoclick() {
			document.getElementById('pencet').click();
		}
	</script>
</body>
</html>