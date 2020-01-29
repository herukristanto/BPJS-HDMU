<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Print Appointment</title>
<script type="text/javascript" src="script/jquery-1.7.2.min.js"></script>
</head>

<body>
<input type="button" id="printApp" onclick="PrintApp();" value="Print"/>
<input type="button" name="Cancel" id="Cancel" value="Exit" onclick="button();" />
<div  id="PrintArea">
	<style>
		@media print {
		  @page { margin: 0; }
		  body { margin: 1.6cm; }
		}
    </style>
    <h2>List Appointment</h2>
<?php
	include "koneksi.php";

	$ruang = "";
	$nama = "";
	$tanggal = "";
	
	if(isset($_GET['tang']))
	{
		$tanggal = $_GET['tang'];
		if($tanggal <> "")
		{
			$myDateTime = DateTime::createFromFormat('d/m/Y', $tanggal);
			$tanggal = $myDateTime->format('Y/m/d');
		}
	}

	if(isset($_GET['room']))
	{
		$ruang = $_GET['room'];
	}

	if(isset($_GET['nama']))
	{
		$nama = $_GET['nama'];
	}

	$cond = "";

	if($tanggal <> '')
  {
		$cond = "where App_date = '".$tanggal."'";
	}

	if($ruang <> '')
  {
		if($cond <> '')
    {
			$cond = $cond." and room_id = '".$ruang."'";
		}
		else
    {
			$cond = "where App_date = CONVERT(datetime, '".date('Y/m/d')."', 111) and room_id = '".$ruang."'";
		}
	}

	if($nama <> '')
  {
		if($cond <> '')
    {
			$cond = $cond." and Name like '%".$nama."%'";
		}
		else
    {
			$cond = "where App_date = CONVERT(datetime, '".date('Y/m/d')."', 111) and Name like '%".$nama."%'";
		}
	}

	if($cond == '')
	{
		$cond = "where App_date = CONVERT(datetime, '".date('Y/m/d')."', 111)";
	}

    //$que = "SELECT * FROM T_Appointment where App_date = CONVERT(datetime, '".date('Y/m/d')."', 111)";
	$que = "SELECT * FROM T_Appointment ".$cond;
	$sql = sqlsrv_query($conn,$que);

	echo "
	<table id='myTable' border='1' style='margin-top:10px;'>
	  <tr>
		<td width='85'><div align='center'>Tanggal</div></td>
		<td width='50'><div align='center'>Jam</div></td>
		<td width='85'><div align='center'>No.Pasien</div></td>
		<td width='85'><div align='center'>No.Case</div></td>
		<td width='200'><div align='center'>Nama</div></td>
		<td width='auto' style='min-width:120px;'><div align='center'>Nama Dokter</div></td>
		<td width='100'><div align='center'>Ruang</div></td>
	  </tr>
	";
  $roomname = '';
  while($hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)){

    $que2 = "SELECT Name from M_Room where Room_Id='".$hasil['Room_Id']."'";
		$sql2 = sqlsrv_query($conn2,$que2);
		$roomname = sqlsrv_fetch_array($sql2, SQLSRV_FETCH_ASSOC);

		$que3 = "SELECT Name from M_Doctor where Doctor_Id=".$hasil['Doctor_Id'];
		$sql3 = sqlsrv_query($conn1,$que3);
		$doctorname = sqlsrv_fetch_array($sql3, SQLSRV_FETCH_ASSOC);

    echo "
	  <tr id='".$hasil['App_No']."' class='outrow'>
    	<td align='center'>".$hasil['App_Date']->format('d/m/Y')."</td>
  		<td align='center'>".$hasil['App_Time']."</td>
  		<td align='center'>".$hasil['Pat_No']."</td>
  		<td align='center'>".$hasil['Case_No']."</td>
  		<td style='padding-left:5px;padding-right:5px;'>".$hasil['Name']."</td>
  		<td style='padding-left:5px;padding-right:5px;'>".$doctorname['Name']."</td>
  		<td>".$roomname['Name']."</td>
	  </tr>";
  }
	echo "</table>";
?>
</div>

<script>
function PrintApp()
{
    var mywindow = window.open('', 'PRINT', 'height=400,width=600');

    mywindow.document.write('<html><head>');
    mywindow.document.write('</head><body >');
    mywindow.document.write(document.getElementById("PrintArea").innerHTML);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();
    mywindow.close();

    return true;
}

function button()
{
	window.location.href = "Outpatient.php";
}
</script>
</body>
</html>