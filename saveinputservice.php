<?php
include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");
$caseid="";
$TData = $_POST['myData'];
$userID = $_POST['hidUser'];
foreach($TData as $row) {
	if ($row[9]=="") {
		$sql1 = "INSERT INTO T_Service VALUES(".$row[0].",".$row[1].",'".$row[2]."',".$row[3].",".$row[4].",".$row[5].",'".$row[6]."','','X','".$userID."',CONVERT(datetime, '".date('Y/m/d H:i:s')."', 120));";
		$sql_execute1 = sqlsrv_query($conn,$sql1);

		$query = "SELECT Stock FROM T_CurrentStock WHERE Service_Id like '". $row[2] ."'";
		$params = array();
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$sql = sqlsrv_query( $conn, $query , $params, $options );
		$row_count = sqlsrv_num_rows( $sql );
		if ($row_count == 0) {
			echo "Data tidak ditemukan..";
		} else {
			$rs1 = sqlsrv_fetch_array($sql);
			$stock = $rs1['Stock'];
		}

		$stoksekarang = $stock - $row[3];

		if ($row[8]=="X") {
			$sql2 = "INSERT INTO M_Inventory VALUES('".$row[2]."',CONVERT(datetime, '".date('d/m/Y')."', 103),-".$row[3].",'".$row[7]."','".$userID."',CONVERT(datetime, '".date('Y/m/d H:i:s')."', 120));";
			$sql_execute2 = sqlsrv_query($conn,$sql2);

			$sql3 = "UPDATE T_CurrentStock set Stock = '".$stoksekarang."' where Service_Id = '".$row[2]."';";
			$sql_execute3 = sqlsrv_query($conn,$sql3);
		}
		$caseid=$row[1];
	}
}
?>
