<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
	echo "<h3>Please Wait . . .</h3>";
	include "koneksi.php";

	$case = $_POST['caseno'];
	$servis = $_POST['servis'];
	$qty = $_POST['qty'];
	$time = $_POST['time'];
	$pot = $_POST['pot'];

	$que = "delete from T_Service where Case_No=".$case." and Service_Id='".$servis."' and Qty=".$qty." and Create_Time='".$time."'";
	// echo $que;
	$que_exe = sqlsrv_query($conn, $que);

	echo $pot;

	if($pot == 'X'){		//balikin stock ke service
		//get current stock
		$queStock = "select * from T_CurrentStock where Service_Id='".$servis."'";		
		echo $queStock;
		$queStock_exe = sqlsrv_query($conn, $queStock);
		$stock = sqlsrv_fetch_array($queStock_exe);

		$newStock = $stock['Stock'];
		// echo $newStock;
		$newStock = $newStock + $qty;

		//update stock retur
		$queReturn = "update T_CurrentStock set Stock=".$newStock." where Service_Id='".$servis."'";
		$queReturn_exe = sqlsrv_query($conn, $queReturn);
	}
	

	header('Location: ServiceTable.php?caseno='.$case);
?>
</body>
</html>