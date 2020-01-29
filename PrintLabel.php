<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Print Label</title>
<style>

</style>
<script type="text/javascript" src="script/jquery-1.7.2.min.js"></script>
</head>

<body>


<div  id="PrintArea">
	<style>
		@media print {
		  @page { margin: 0 !important; }
		  body { margin: 0 !important; }
		}
		body{
			/*font-size: 12px;
			font-weight: bold;*/
			margin-left:20px !important; 
			margin-top:20px !important;"
		}
		table{
			border-collapse:collapse !important;
			font-size: 16px !important;
		}
		tr, td
		{
			padding:0px;
			margin:0px;
			line-height: 90%;
		}
    </style>
  <?php
	include "koneksi.php";

	$caseno = $_POST['Caseno'];
	$patno = $_POST['Patno'];
	$pnam = $_POST['Nama'];
	$dob = $_POST['DOB'];
	if($dob <> "")
	{
		$dob1 = DateTime::createFromFormat('d/m/Y', $dob);
		$dob = $dob1->format('Y/m/d');

		$tgl = substr($dob,8,2);
		$bulan = substr($dob,5,2);
		$tahun = substr($dob,0,4);

		if($bulan == '01')
		{
			$bln = 'Jan';
		}
		else if($bulan == '02')
		{
			$bln = 'Feb';
		}
		else if($bulan == '03')
		{
			$bln = 'Mar';
		}
		else if($bulan == '04')
		{
			$bln = 'Apr';
		}
		else if($bulan == '05')
		{
			$bln = 'May';
		}
		else if($bulan == '06')
		{
			$bln = 'Jun';
		}
		else if($bulan == '07')
		{
			$bln = 'Jul';
		}
		else if($bulan == '08')
		{
			$bln = 'Aug';
		}
		else if($bulan == '09')
		{
			$bln = 'Sep';
		}
		else if($bulan == '10')
		{
			$bln = 'Oct';
		}
		else if($bulan == '11')
		{
			$bln = 'Nov';
		}
		else if($bulan == '12')
		{
			$bln = 'Dec';
		}

		$dob2 = $tgl." ".$bln." ".$tahun;
	}


	$sex = $_POST['Sex'];
	if ($sex == 'M')
	{
		$sex1 = 'L';
	}
	else
	{
		$sex1 = 'P';
	}

	$tglcase = $_POST['Tgl'];
	if($tglcase <> "")
	{
		$tglcase1 = DateTime::createFromFormat('d/m/Y', $tglcase);
		$tglcase = $tglcase1->format('Y/m/d');

		$cdate = substr($tglcase,8,2);
		$cmonth = substr($tglcase,5,2);
		$cyear = substr($tglcase,0,4);

		if($cmonth == '01')
		{
			$cbln = 'Jan';
		}
		else if($cmonth == '02')
		{
			$cbln = 'Feb';
		}
		else if($cmonth == '03')
		{
			$cbln = 'Mar';
		}
		else if($cmonth == '04')
		{
			$cbln = 'Apr';
		}
		else if($cmonth == '05')
		{
			$cbln = 'May';
		}
		else if($cmonth == '06')
		{
			$cbln = 'Jun';
		}
		else if($cmonth == '07')
		{
			$cbln = 'Jul';
		}
		else if($cmonth == '08')
		{
			$cbln = 'Aug';
		}
		else if($cmonth == '09')
		{
			$cbln = 'Sep';
		}
		else if($cmonth == '10')
		{
			$cbln = 'Oct';
		}
		else if($cmonth == '11')
		{
			$cbln = 'Nov';
		}
		else if($cmonth == '12')
		{
			$cbln = 'Dec';
		}

		$tglcase2 = $cdate." ".$cbln." ".$cyear;
	}

	$docId = $_POST['docId'];

	$year = $cyear - $tahun;
	$mon = $cmonth - $bulan;
	$day = $cdate - $tgl;

	if((int) $day < 0)
	{
		$mon = (int) $mon - 1;
	}

	if((int) $mon < 0)
	{
		$year = (int) $year - 1;
		$mon = (int) $mon + 12;
	}

	$umur = $year.' th '.$mon.' bl';

	$que = "select * from M_Doctor where Doctor_Id = ".$docId;
	$sql = sqlsrv_query($conn,$que);
	$row = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC);

?>

	<table width="298" border="0">
	  <tr>
	    <td colspan="3"><?php echo $pnam; ?></td>
	  </tr>
	  <tr>
	    <td width="88"><?php echo $umur; ?></td>
	    <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $dob2; ?></td>
	  </tr>
	  <tr>
	    <td colspan="2">Tgl.Datang : <?php echo $tglcase2; ?></td>
	    <td width="110">HDMU &nbsp;&nbsp;&nbsp;&nbsp; <?php echo $sex1; ?></td>
	  </tr>
	  <tr>
	    <td colspan="3"><?php echo $docId." - ".$row['Name']; ?></td>
	  </tr>
	  <tr>
	    <td colspan="3">RM/KS : <?php echo $patno."/".$caseno; ?></td>
	  </tr>

	  <tr style="height: 39px;"><td colspan="3">&nbsp;</td></tr>

	  <tr>
	    <td colspan="3"><?php echo $pnam; ?></td>
	  </tr>
	  <tr>
	    <td width="88"><?php echo $umur; ?></td>
	    <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $dob2; ?></td>
	  </tr>
	  <tr>
	    <td colspan="2">Tgl.Datang : <?php echo $tglcase2; ?></td>
	    <td width="110">HDMU &nbsp;&nbsp;&nbsp;&nbsp; <?php echo $sex1; ?></td>
	  </tr>
	  <tr>
	    <td colspan="3"><?php echo $docId." - ".$row['Name']; ?></td>
	  </tr>
	  <tr>
	    <td colspan="3">RM/KS : <?php echo $patno."/".$caseno; ?></td>
	  </tr>

	  <tr style="height: 39px;"><td colspan="3">&nbsp;</td></tr>

	  <tr>
	    <td colspan="3"><?php echo $pnam; ?></td>
	  </tr>
	  <tr>
	    <td width="88"><?php echo $umur; ?></td>
	    <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $dob2; ?></td>
	  </tr>
	  <tr>
	    <td colspan="2">Tgl.Datang : <?php echo $tglcase2; ?></td>
	    <td width="110">HDMU &nbsp;&nbsp;&nbsp;&nbsp; <?php echo $sex1; ?></td>
	  </tr>
	  <tr>
	    <td colspan="3"><?php echo $docId." - ".$row['Name']; ?></td>
	  </tr>
	  <tr>
	    <td colspan="3">RM/KS : <?php echo $patno."/".$caseno; ?></td>
	  </tr>

	  <tr style="height: 39px;"><td colspan="3">&nbsp;</td></tr>

	  <tr>
	    <td colspan="3"><?php echo $pnam; ?></td>
	  </tr>
	  <tr>
	    <td width="88"><?php echo $umur; ?></td>
	    <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $dob2; ?></td>
	  </tr>
	  <tr>
	    <td colspan="2">Tgl.Datang : <?php echo $tglcase2; ?></td>
	    <td width="110">HDMU &nbsp;&nbsp;&nbsp;&nbsp; <?php echo $sex1; ?></td>
	  </tr>
	  <tr>
	    <td colspan="3"><?php echo $docId." - ".$row['Name']; ?></td>
	  </tr>
	  <tr>
	    <td colspan="3">RM/KS : <?php echo $patno."/".$caseno; ?></td>
	  </tr>

	  <tr style="height: 30px;"><td colspan="3">&nbsp;</td></tr>

	  <tr>
	    <td colspan="3"><?php echo $pnam; ?></td>
	  </tr>
	  <tr>
	    <td width="88"><?php echo $umur; ?></td>
	    <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $dob2; ?></td>
	  </tr>
	  <tr>
	    <td colspan="2">Tgl.Datang : <?php echo $tglcase2; ?></td>
	    <td width="110">HDMU &nbsp;&nbsp;&nbsp;&nbsp; <?php echo $sex1; ?></td>
	  </tr>
	  <tr>
	    <td colspan="3"><?php echo $docId." - ".$row['Name']; ?></td>
	  </tr>
	  <tr>
	    <td colspan="3">RM/KS : <?php echo $patno."/".$caseno; ?></td>
	  </tr>
	</table>
</div>

<br><br>
<button type="button" class="btn" name="printLabel" id="printLabel" onclick="PrintLabel();">Print</button>
<button type="button" class="btn" name="Cancel" id="Cancel" onclick="button();">Exit</button>

<?php echo "<input type='text' id='hidCase' value='".$caseno."' hidden/>"; ?>

<script>
function PrintLabel()
{
    var mywindow = window.open('', 'PRINT', 'height=400,width=600');

    mywindow.document.write('<html><head>');
    mywindow.document.write('</head><body>');
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
	window.location.href = "T_Case.php?case="+document.getElementById('hidCase').value;
}
</script>
</body>
</html>
