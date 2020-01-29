<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title></title>
 	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet"> -->
	<link href="css/fontGoogle.css" rel="stylesheet">
	<link href="css/css/font-awesome.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/pages/dashboard.css" rel="stylesheet">
	<script src="js/jquery-1.7.2.min.js"></script>

	<style type="text/css">
		.hid{
			display: none;
		}
	</style>
</head>

<body>
	<button type="button" class="btn" onclick="PrintDiag();">Print</button>
	<div id="PrintArea">
		<?php
			include "koneksi.php";

			if(isset($_GET['case']))
			{
				$caseno = $_GET['case'];
			}

			$queHead = "select * from V_Case where Case_No = '".$caseno."'";
			$queHead_exe = sqlsrv_query($conn,$queHead);
			$header = sqlsrv_fetch_array($queHead_exe, SQLSRV_FETCH_ASSOC)

		?>
		<table class="hid" style="border:0;">
			<tr>
				<td>Nama</td>
				<td width="15">:</td>
				<td><?php echo $header['Pat_Name']; ?></td>
				<td width="60"></td>
				<td>Tanggal lahir</td>
				<td width="15">:</td>
				<td><?php echo $header['Pat_DOB']->format('d-m-Y'); ?></td>
			</tr>
			<tr>
				<td>RM / KS</td>
				<td>:</td>
				<td><?php echo $header['Pat_No']; ?></td>
				<td></td>
				<td>Tanggal Case</td>
				<td>:</td>
				<td><?php echo $header['Case_Date']->format('d-m-Y'); ?></td>
			</tr>
		</table>
		<?php 
			
			$que = "SELECT * FROM T_Diagnose where Case_No = '".$caseno."'";
			$sql = sqlsrv_query($conn,$que);
			
			echo "
			<table id='myTable' width='677' border='1' style='margin-top:10px;'>
		  	<tr>
			  	<td class='hidPrint' width='20px'>&nbsp</td>
		    	<td><div align='center'>Group</div></td>
		    	<td><div align='center'>Kode Diagnosa</div></td>
		    	<td><div align='center'>Deskripsi</div></td>
		  	</tr>
			";
			
			while($hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)){
			  $que1 = "SELECT * FROM M_Diagnose where Diag_Id = '".$hasil['Diag_Id']."'";
			  $sql1 = sqlsrv_query($conn1,$que1);
			  $row = sqlsrv_fetch_array($sql1, SQLSRV_FETCH_ASSOC);
			  $group = $row['Diag_Grp'];
			  $desc = $row['Diagnose'];
			  
		      echo "
			  <tr class='srcRow'>
			  	<td class='hidPrint'><input class='del' type='button' value='Del' onclick=\"del('".$caseno."','".$hasil['Diag_Id']."');\" /></td>
			  	<td>".$group."</td>
				<td>".$hasil['Diag_Id']."</td>
				<td>".$desc."</td>
			  </tr>";
		    }
			echo "</table>";
		?>

	</div>


<script>
	function del(c,d){
		var cf = confirm('Anda Yakin Ingin Menghapus?');
		if(cf)
		{
			window.location.href = "DeleteDiag.php?case="+c+"&diag="+d;
		}
	}
	function PrintDiag()
	{
		var mywindow = window.open('', 'PRINT', 'height=400,width=600');

		var header = " ";


		mywindow.document.write('<html><head>');
		mywindow.document.write('</head><body style="margin:50px;">');
		mywindow.document.write('<style>.hidPrint{display:none;}</style>');
		mywindow.document.write(document.getElementById("PrintArea").innerHTML);
		mywindow.document.write('</body></html>');

		mywindow.document.close(); // necessary for IE >= 10
		mywindow.focus(); // necessary for IE >= 10*/

		mywindow.print();
		mywindow.close();

		return true;
	}
</script>
</body>
</html>