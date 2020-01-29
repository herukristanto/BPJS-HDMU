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
		$ruang = str_replace("%20", " ", $_GET['room']);
	}

	if(isset($_GET['nama']))
	{
		$nama = str_replace("%20", " ", $_GET['nama']);
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
	  <td width='25'></td>
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
    	<td align='center'><input type='radio' name='caseRow' data-patient='".$hasil['Pat_No']."' value='".$hasil['Case_No']."'/></td>
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

	echo "
		<form method='post' action='T_appointment.php' id='frmSub'>
			<input type='hidden' name='app_id' id='app_id' />
		</form>

		<script>
			$('.outrow').dblclick(function() {
				$('#app_id').val($(this).attr('id'));
				$('#frmSub').submit();
			});
		</script>
	";
?>
