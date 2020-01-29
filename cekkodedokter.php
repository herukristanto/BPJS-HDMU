<html>
<head>
	<?php
	include "koneksi.php";

	if (isset($_GET['kodedokter']))
	{
		$kodedokter = $_GET['kodedokter'];
		$query = "SELECT Doctor_Id, Name FROM M_Doctor WHERE Doctor_Id like '". $kodedokter ."'";
		$sql = sqlsrv_query($conn,$query);
		if ($sql){
			while($rs1 = sqlsrv_fetch_array($sql)){
				$Isi = $rs1['Name'];
			}
		}
	}
	?>
</head>
<body onload="autoclick()">
	<form name="myform">
		<input type="text" name="getIsi" id="getIsi" value="<?php echo $Isi ?>" disabled/>
		<input type="button" id="pencet2" class="pencet2" onclick="parent.cekkodedokter(this.form.getIsi.value);" value="Cek" />
	</form>

	<script>
		function autoclick() {
			document.getElementById('pencet2').click();
		}
	</script>
</body>
</html>