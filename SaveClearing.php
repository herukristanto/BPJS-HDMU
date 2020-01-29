<?php
include 'koneksi.php';
date_default_timezone_set("Asia/Bangkok");

$datebill = date('Y-m-d');

$TData = $_POST['myData'];
$userID = $_POST['hidUser'];

$ins = '';
foreach($TData as $row) {
	$datecase1 = DateTime::createFromFormat('d/m/Y', $row[2]);
	$datecase = $datecase1->format('Y/m/d');
  $ins = $ins." update T_Insurance set clear = 'X', c_date = '".$datecase."', c_by = '".$userID."' where insurance_id = '".$row[0]."' and bill_id = '".$row[1]."'";
}
$ins_execute = sqlsrv_query($conn1,$ins);
echo $ins;
echo "Save Berhasil.";

?>
