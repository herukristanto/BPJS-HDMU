<html>
<head>
	<?php
	include "koneksi.php";

	if (isset($_GET['kodeservice']))
	{
		$kodeservice = $_GET['kodeservice'];
		$query = "SELECT S.Service_Id, S.Descp, P.Price, T.Stock, S.Unit, S.Stock as 'Potong' FROM M_Service S, M_Price P, T_CurrentStock T WHERE S.Service_Id=P.Service_Id AND S.Service_Id=T.Service_Id AND S.Service_Id like '". $kodeservice ."'";
		$sql = sqlsrv_query($conn,$query);
		if ($sql){
			while($rs1 = sqlsrv_fetch_array($sql)){
				$descp = $rs1['Descp'];
				$price = $rs1['Price'];
				$stock = $rs1['Stock'];
				$unit = $rs1['Unit'];
				$potong = $rs1['Potong'];
			}
		}
	}
	?>
</head>
<body onload="autoclick()">
	<form name="myform">
		<input type="text" name="getDescp" id="getDescp" value="<?php echo $descp ?>" disabled/>
		<input type="text" name="getPrice" id="getPrice" value="<?php echo $price ?>" disabled/>
		<input type="text" name="getStock" id="getStock" value="<?php echo $stock ?>" disabled/>
		<input type="text" name="getUnit" id="getUnit" value="<?php echo $unit ?>" disabled/>
		<input type="text" name="getPotong" id="getPotong" value="<?php echo $potong ?>" disabled/>
		<input type="button" id="pencet" class="pencet" onclick="parent.ambildataservice(this.form.getDescp.value, this.form.getPrice.value, this.form.getStock.value, this.form.getUnit.value, this.form.getPotong.value);" value="Add" />
	</form>

	<script>
		function autoclick() {
			document.getElementById('pencet').click();
		}
	</script>
</body>
</html>