<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
	include "koneksi.php";
	session_start();
	date_default_timezone_set("Asia/Bangkok");

	$patno = $_POST['patno'];
	$caseno = $_POST['caseno'];
	$scode = $_POST['scode'];
	$sqty = $_POST['sqty'];
	$sdoctor = "null";

	if(isset($_POST['sdoctor']) && $_POST['sdoctor'] != ""){
		$sdoctor = $_POST['sdoctor'];

		$recheckdoc = "select * from M_Doctor where Doctor_Id ='".$sdoctor."'";
		$recheckdoc_exe = sqlsrv_query($conn, $recheckdoc);
		$hasilcekdoc = sqlsrv_fetch_array($recheckdoc_exe, SQLSRV_FETCH_ASSOC);
		if($hasilcekdoc == false){
			exit("<script>alert('Kode Dokter Tidak Ditemukan');</script>");
		}
	}
	$snote = $_POST['snote'];

	$recheck = "select * from V_Service where Service_Id = '".$scode."'";
	$recheck_exe = sqlsrv_query($conn, $recheck);
	$hasilcek = sqlsrv_fetch_array($recheck_exe, SQLSRV_FETCH_ASSOC);
	if($hasilcek){

		if($hasilcek['Doctor'] == 'X' && $sdoctor == 'null'){
			exit("<script>alert('Kode dokter harus dimasukan untuk servis ini.');</script>");
		}

		$sdesc = $hasilcek['Descp'];
		$sdesc = str_replace("'","''",$sdesc);

		if($hasilcek['Price'] == ""){
			exit("<script>alert('Service Belum Memiliki Harga');</script>");
		}else{
			$sprice = $hasilcek['Price'] * $sqty;
		}

		$sunit = $hasilcek['Unit'];
		$spotstock = $hasilcek['Stock'];
		$sisastock = $hasilcek['Curr_Stock'];

		if($spotstock == 'X'){
			if($sisastock >= $sqty){
				$curStock = $sisastock - $sqty;
				$quePot2 = "update T_CurrentStock set Stock = ".$curStock." where Service_Id = '".$scode."'";
				$quePot2_exe = sqlsrv_query($conn1, $quePot2);
			}else{
				exit("<script>alert('Stock Tidak Mencukupi');</script>");
			}
		}

		$que = "insert into T_Service values(".$patno.",".$caseno.",'".$scode."','".$sdesc."','".$hasilcek['Display']."',".$sqty.",'".$sunit."',".$sprice.",".$sdoctor.",'".$snote."','','X','".$_SESSION["username"]."',CONVERT(datetime, '".date('Y/m/d H:i:s')."', 120))";
		echo $que;
		$que_exe = sqlsrv_query($conn, $que);


		echo "
			<script>
				parent.clearData();
				parent.refreshif();
			</script>
		";
	}else{
		exit("<script>alert('Kode Service Tidak Ditemukan');</script>");
	}
	
?>
</body>
</html>