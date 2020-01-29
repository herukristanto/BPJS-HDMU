<?php
include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

$TData = $_POST['myData'];
foreach($TData as $row) {
	$sql = "select * from M_Service where Service_Id = '".$row[0]."'";
	$sql_execute = sqlsrv_query($conn, $sql, array(), array( "Scrollable" => 'static' ));
	$hitungbaris = sqlsrv_num_rows($sql_execute);
	if ($hitungbaris > 0){
		$sql = "select * from M_Service where Service_Id = '".$row[0]."'";
		$sql_execute = sqlsrv_query($conn,$sql);
		$hasil = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);
		$cekstok = $hasil['Stock'];
		if ($cekstok = "X") {
			$sql = "insert into M_Inventory values('".$row[0]."',CONVERT(datetime, '".date('d/m/Y')."', 103),'".$row[2]."','".$row[3]."','Admin',CONVERT(datetime, '".date('Y/m/d H:i:s')."', 120))";
			$sql_execute = sqlsrv_query($conn,$sql);

			$sql = "select * from T_CurrentStock where Service_Id = '".$row[0]."'";
			$sql_execute = sqlsrv_query($conn, $sql, array(), array( "Scrollable" => 'static' ));
			$hitungbaris2 = sqlsrv_num_rows($sql_execute);
			if ($hitungbaris2 > 0) {
				$sql = "select * from T_CurrentStock where Service_Id = '".$row[0]."'";
				$sql_execute = sqlsrv_query($conn,$sql);
				$hasil = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);
				$cekstok = $hasil['Stock'];
				$hasilhitung = $cekstok + $row[2];
				$sql1 = "UPDATE T_CurrentStock SET Stock = '".$hasilhitung."' WHERE Service_Id = '".$row[0]."'";
				$sql_execute = sqlsrv_query($conn,$sql1);
			} else {
				$sql = "insert into T_CurrentStock values('".$row[0]."','".$row[2]."','".$row[3]."')";
				$sql_execute = sqlsrv_query($conn,$sql);
			}
		} else {
			$sql = "UPDATE M_Service SET Stock = 'X' WHERE Service_Id = '".$row[0]."'";
			$sql_execute = sqlsrv_query($conn,$sql);

			$sql = "insert into M_Inventory values('".$row[0]."',CONVERT(datetime, '".date('d/m/Y')."', 103),'".$row[2]."','".$row[3]."','Admin',CONVERT(datetime, '".date('Y/m/d H:i:s')."', 120))";
			$sql_execute = sqlsrv_query($conn,$sql);

			$sql = "select * from T_CurrentStock where Service_Id = '".$row[0]."'";
			$sql_execute = sqlsrv_query($conn, $sql, array(), array( "Scrollable" => 'static' ));
			$hitungbaris2 = sqlsrv_num_rows($sql_execute);
			if ($hitungbaris2 > 0) {
				$sql = "select * from T_CurrentStock where Service_Id = '".$row[0]."'";
				$sql_execute = sqlsrv_query($conn,$sql);
				$hasil = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);
				$cekstok = $hasil['Stock'];
				$hasil = $cekstok + $row[2];

				$sql = "UPDATE T_CurrentStock SET Stock = '".$hasil."' WHERE Service_Id = '".$row[0]."'";
				$sql_execute = sqlsrv_query($conn,$sql);
			} else {
				$sql = "insert into T_CurrentStock values('".$row[0]."','".$row[2]."','".$row[3]."')";
				$sql_execute = sqlsrv_query($conn,$sql);
			}
		}
	} else {
		$sql = "INSERT INTO M_Service VALUES('".$row[0]."','".$row[1]."','X','".$row[3]."',CONVERT(datetime, '".date('d/m/Y')."', 103),CONVERT(datetime,'31-12-9999', 103),'Admin',CONVERT(datetime, '".date('Y/m/d H:i:s')."', 120))";
		$sql_execute = sqlsrv_query($conn,$sql);

		$sql = "insert into T_CurrentStock values('".$row[0]."','".$row[2]."','".$row[3]."')";
		$sql_execute = sqlsrv_query($conn,$sql);

		$sql = "insert into M_Inventory values('".$row[0]."',CONVERT(datetime, '".date('d/m/Y')."', 103),'".$row[2]."','".$row[3]."','Admin',CONVERT(datetime, '".date('Y/m/d H:i:s')."', 120))";
		$sql_execute = sqlsrv_query($conn,$sql);
	};
	
}
?>