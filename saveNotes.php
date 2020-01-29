<!DOCTYPE html>
<html>
<head>
	<title></title>
	</title>
</head>
<body>
<?php
	include "koneksi.php";
	date_default_timezone_set("Asia/Bangkok");

	echo "Please Wait . . . ";

	$username = $_POST['hidUser'];
	$patno = $_POST['hidPatno'];
	$caseno = $_POST['hidCaseno'];
	$notes = $_POST['catatan'];

	$noteId = 'null';

	$flag = 0; 								//0 = create new
	if(isset($_POST['hidId'])){$flag = 1;} 	//1 = update

	if($flag == 1){
		$noteId = $_POST['hidId'];
		$que = "update T_Notes set Note = '".trim($notes)."' where ID = ".$noteId;
	}else{
		$que = "insert into T_Notes(Pat_No, Case_No, Tanggal, User_Id, Note) values(".$patno.",".$caseno.",CONVERT(datetime, '".date('Y/m/d H:i:s')."', 120),'".$username."','".trim($notes)."')";
	}

	$que_exe = sqlsrv_query($conn,$que);

	if($flag == 0){
		$getID = "select ID from T_Notes where Pat_No = '".$patno."' and Case_No = '".$caseno."' order by ID desc";
		$getID_exe = sqlsrv_query($conn2,$getID);
		$rsID = sqlsrv_fetch_array($getID_exe, SQLSRV_FETCH_ASSOC);
		$noteId = $rsID['ID'];
		//get id number from newly added notes
	}

	$queHis = "insert into T_LogNotes values(".$noteId.",".$patno.",".$caseno.",CONVERT(datetime, '".date('Y/m/d H:i:s')."', 120),'".$username."','".trim($notes)."')";
	$queHis_exe = sqlsrv_query($conn1,$queHis);

	echo "
		<script>";
	
	if($flag == 0){
		echo "parent.clr();";
	}			
	
	echo "		window.location.href = 'NotesTable.php?patno=".$patno."&caseno=".$caseno."';
		</script>
	";
?>
</body>
</html>
