<?php
include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

session_start();

$serviceid = $_POST['service'];
$deskripsi = $_POST['deskripsi'];
$unit = $_POST['unit'];
$stok = $_POST['stok'];
$doc = $_POST['dok'];
if(isset($_POST['disp'])){
	$disp = $_POST['disp'];
}
$srvgrp = $_POST['srvgrp'];
$validfrom = $_POST['validfrom'];
$validto = $_POST['validto'];

$mode = $_POST['mode'];


$sql = "select * from M_Service where Service_Id = '".$serviceid."'";
$sql_execute = sqlsrv_query($conn, $sql, array(), array( "Scrollable" => 'static' ));
$count = sqlsrv_num_rows($sql_execute);

if($mode == "create"){
	if($count == 0){
		$que = "INSERT INTO M_Service(Service_Id, Descp, Unit, Stock, Doctor, Display, Srv_Group, Valid_From, Valid_To, Create_By, Create_Time) VALUES( '".$serviceid."', '".$deskripsi."', '".$unit."', '".$stok."', '".$doc."', '".$disp."','".$srvgrp."', CONVERT(datetime,'".$validfrom."', 103),CONVERT(datetime,'".$validto."', 103), '".$_SESSION["username"]."', CONVERT(datetime, '".date('Y/m/d H:i:s')."', 120))";
		$que_exe = sqlsrv_query($conn, $que);

		if(!$que_exe){echo
			"<script>
				alert('Terjadi kesalahan saat membuat service.');
			</script>";
			header('location:M_Service_Create.php');
		}


		if($stok == 'X'){
			$que = "INSERT INTO T_CurrentStock(Service_Id, Stock, Unit) VALUES('".$serviceid."','0','".$unit."')";
			$que_exe1 = sqlsrv_query($conn, $que);
		}

		if(!$que_exe1){echo
			"<script>
				alert('Terjadi kesalahan saat membuat stock.');
			</script>";
			header('location:M_Service_Create.php');
		}

		if($disp == ' '){
			$que = "INSERT INTO M_Price(Service_Id, Price, Valid_From, Valid_To, Create_By, Create_Time) VALUES('".$serviceid."','0',CONVERT(datetime,'".$validfrom."', 103),CONVERT(datetime,'31/12/9999', 103),'".$_SESSION['username']."', CONVERT(datetime, '".date('Y/m/d H:i:s')."', 120))";
			$que_exe2 = sqlsrv_query($conn, $que);
			// echo $que;
		}

		if(!$que_exe2){echo
			"<script>
				alert('Terjadi kesalahan saat memberikan harga.');
			</script>";
			header('location:M_Service_Create.php');
		}

		echo
		"<script>
			alert('Servis berhasil dibuat.');
			window.location.href='M_Service_Create.php';
		</script>";
	}else{
		echo
		"<script>
			alert('Servis sudah ada pada sistem sebelumnya, tidak bisa menyimpan.');
			window.location.href='M_Service_Create.php';
		</script>";
	}
}else if($mode == "update"){
	$flag = 0;
	if($count == 1){
		$rs = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);

		$queStock = "SELECT * FROM T_CurrentStock WHERE Service_Id = '".$serviceid."'";
		$queStock_exe = sqlsrv_query($conn, $queStock, array(), array( "Scrollable" => 'static' ));
		$countstock = sqlsrv_num_rows($queStock_exe);
		$rsstock = sqlsrv_fetch_array($queStock_exe, SQLSRV_FETCH_ASSOC);

		if($rs['Stock'] == 'X' && $stok == ' '){
			if($countstock == 1 && $rsstock['Stock'] != 0){
				$flag = 1;
				echo
				"<script>
					alert('Servis masih memiliki sisa stok, tidak bisa merubah Potong Stok.');
					window.location.href='M_Service_Change.php';
				</script>";
			}
		}

		if($flag == 0){
			$queup = "UPDATE M_Service 
					  		SET	Descp = '".$deskripsi."',
										Stock = '".$stok."',
										Unit = '".$unit."',
										Doctor = '".$doc."',
										Srv_Group = '".$srvgrp."',
										Valid_From = CONVERT(datetime,'".$validfrom."', 103),
										Valid_to = CONVERT(datetime,'".$validto."', 103)
								WHERE Service_Id = '".$serviceid."'";
			$queup_exe = sqlsrv_query($conn, $queup);

			$quetcurr = "UPDATE T_CurrentStock SET Unit = '".$unit."' WHERE Service_Id = '".$serviceid."'";
			$quetcurr_exe = sqlsrv_query($conn, $quetcurr);

			if($rs['Stock'] == 'X' && $stok == ' '){
				$quedel = "DELETE FROM T_CurrentStock WHERE Service_Id = '".$serviceid."'";
				$quedel_exe = sqlsrv_query($conn, $quedel);
			}else if($rs['Stock'] == ' ' && $stok == 'X'){
				// $queins = "INSERT INTO T_CurrentStock VALUES('".$serviceid."',0,'".$unit."')";
				// $queins_exe = sqlsrv_query($conn, $queins);
			}

			echo
			"<script>
				alert('Servis berhasil diubah.');
				window.location.href='M_Service_Change.php';
			</script>";
		}		

	}else{
		echo
		"<script>
			alert('Servis belum terdaftar.');
			window.location.href='M_Service_Change.php';
		</script>";
	}
}

//================================================================================================================


// $sql = "select * from M_Service where Service_Id = '".$serviceid."'";
// $sql_execute = sqlsrv_query($conn, $sql, array(), array( "Scrollable" => 'static' ));
// $hitungbaris = sqlsrv_num_rows($sql_execute);
// if ($hitungbaris > 0){

// 	if ($simpan=="baru"){
// 		echo
// 		"<script>
// 		alert('Servis sudah ada pada sistem sebelumnya, tidak bisa menyimpan.');
// 		window.location.href='M_Service_Create.php';
// 		</script>";
// 	} elseif ($simpan=="ubah") {
// 		$sql = "select * from M_Service where Service_Id = '".$serviceid."'";
// 		$sql_execute = sqlsrv_query($conn,$sql);
// 		$hasil = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);
// 		$cekStok = $hasil['Stock'];
// 		if ($cekStok == $stok) {
// 			$sql = "update M_Service set Descp = '".$deskripsi."' , Unit = '".$unit."' , Doctor = '".$doc."', Valid_From = CONVERT(datetime,'".$validfrom."', 103), Valid_to = CONVERT(datetime,'".$validto."', 103) where Service_Id = '".$serviceid."'";
// 			$sql_execute = sqlsrv_query($conn,$sql);
// 			$sql = "UPDATE T_CurrentStock SET Unit = '".$unit."' WHERE Service_Id='".$serviceid."'";
// 			$sql_execute = sqlsrv_query($conn,$sql);
// 		} elseif ($cekStok <> $stok){
// 			if ($stok == "X") {
// 				$sql = "update M_Service set Descp = '".$deskripsi."', Stock = '".$stok."' , Unit = '".$unit."' , Doctor = '".$doc."', Valid_From = CONVERT(datetime,'".$validfrom."', 103), Valid_to = CONVERT(datetime,'".$validto."', 103) where Service_Id = '".$serviceid."'";
// 				$sql_execute = sqlsrv_query($conn,$sql);
// 				$sql = "insert into T_CurrentStock values('".$serviceid."', 0 , Unit = '".$unit."' )";
// 				$sql_execute = sqlsrv_query($conn,$sql);
// 			} elseif ($stok == " ") {
// 				$sql = "select * from T_CurrentStock where Service_Id = '".$serviceid."'";
// 				$sql_execute = sqlsrv_query($conn,$sql);
// 				$hasilcekcurrent = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);
// 				$cekStokDiCurrent = $hasilcekcurrent['Stock'];
// 				if ($cekStokDiCurrent == 0){
// 					$sql = "update M_Service set Descp = '".$deskripsi."', Stock = '".$stok."' , Unit = '".$unit."' , Doctor = '".$doc."', Valid_From = CONVERT(datetime,'".$validfrom."', 103), Valid_to = CONVERT(datetime,'".$validto."', 103) where Service_Id = '".$serviceid."'";
// 					$sql_execute = sqlsrv_query($conn,$sql);
// 					$sql = "Delete From T_CurrentStock where Service_Id = '".$serviceid."'";
// 					$sql_execute = sqlsrv_query($conn,$sql);
// 				} elseif ($cekStokDiCurrent > 0) {
// 					echo
// 					"<script>
// 					alert('Ada stok');
// 					window.location.href='M_Service_Change.php';
// 					</script>";
// 				}
// 			}
// 		}

// 		$sql = "select * from M_Service where Service_Id = '".$serviceid."'";
// 		$sql_execute = sqlsrv_query($conn,$sql);
// 		$hasil = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);

// 		echo
// 		"<script>
// 		alert('Service ".$hasil['Service_Id']." - ".$hasil['Descp']." Berhasil Diubah');
// 		window.location.href='M_Service_Change.php';
// 		</script>";
// 	}
// } else {
// 	if ($stok == "X") {
// 		$sql = "insert into M_Service values('".$serviceid."','".$deskripsi."','".$stok."','".$unit."','".$doc."',CONVERT(datetime,'".$validfrom."', 103),CONVERT(datetime,'".$validto."', 103),'".$_SESSION["username"]."',CONVERT(datetime, '".date('Y/m/d H:i:s')."', 120))";
// 		$sql_execute = sqlsrv_query($conn,$sql);
// 		$sql = "insert into T_CurrentStock values('".$serviceid."','0','".$unit."')";
// 		$sql_execute = sqlsrv_query($conn,$sql);
// 	} else if ($stok == " ") {
// 		$sql = "insert into M_Service values('".$serviceid."','".$deskripsi."','".$stok."','".$unit."','".$doc."',CONVERT(datetime,'".$validfrom."', 103),CONVERT(datetime,'".$validto."', 103),'".$_SESSION["username"]."',CONVERT(datetime, '".date('Y/m/d H:i:s')."', 120))";
// 		$sql_execute = sqlsrv_query($conn,$sql);
// 	}

// 	$sql = "select * from M_Service where Service_Id = '".$serviceid."'";
// 	$sql_execute = sqlsrv_query($conn,$sql);
// 	$hasil = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);

// 	echo
// 	"<script>
// 	alert('Service ".$hasil['Service_Id']." berhasil ditambah');
// 	window.location.href='M_Service_Create.php';
// 	</script>";
// }
?>
