<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
</style>
</head>

<body>
<?php
	include "koneksi.php";
	
	$caseno = $_GET['caseno'];
	$patno = $_GET['patno'];
	
	$que = "select * from T_Referral where Case_No = '".$caseno."' and Pat_No = '".$patno."'";
    $sql = sqlsrv_query($conn,$que);
    $hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC);
	
	
?>

<form action="SuratRujukan.php" method="post">
  <p>
  <input type="hidden" name="Patno" id="hidPatno" value="<?php echo $patno ?>" />
  <input type="hidden" name="Caseno" id="hidCase" value="<?php echo $caseno ?>" />
  <input type="hidden" name="Nama" id="Nama" value="<?php echo $hasil['Pat_Nam'] ?>" />
  <input type="hidden" name="DOB" id="DOB" value="<?php echo $hasil['Pat_DOB']->format('d/m/Y') ?>" />
  <input type="hidden" name="Sex" id="Sex" value="<?php echo $hasil['Pat_Sex'] ?>" />
  <input type="button" id="print" onclick="PrintR();" value="Print"/>
  <input type="submit" name="Cancel" id="Cancel" value="Exit" />
  </p>
</form>
<div  id="PrintArea">
	<style>
		@media print {
		  @page { margin: 0; }
		  body { margin: 0.6cm; }
		}
		
		table {
				border-left: double;
				border-right: double;
				width: 100%;
		}
	
		td {
				padding-top : 5px;
				padding-bottom : 5px;
		}
	
		.style1{
				font-size:10px;
				font-family:Arial, Helvetica, sans-serif;	
		}
		
		.style2{
				font-family:Times New Roman, Times, serif;	
		}
	</style>

<table style="border-top: double" width="800" border="0">
  <tr>
    <td colspan="2"><div align="center"> <b>SURAT RUJUKAN</b>    </div></td>
    <td width="147"><img src="image/logo.png" width="250" align="right" style="margin-right: 30px;margin-top: 30px;"></td>
  </tr>
  <tr>
    <td colspan="3">Kepada Yth.</td>
  </tr>
  <tr>
    <td width="27">Ts.</td>
    <td width="813"><?php if(isset($hasil['Doctor'])){echo $hasil['Doctor'];} ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Di</td>
    <td><?php if(isset($hasil['Tempat'])){echo $hasil['Tempat'];} ?></td>
    <td>&nbsp;</td>
  </tr>
</table>

<table width="800" border="0" style="border-bottom:double">
  <tr>
  	<td colspan="3">Mohon perawatan / penatalaksanaan selanjutnya untuk pasien :</td>
  </tr>
  <tr>
    <td width="167">Nama</td>
    <td width="13">:</td>
    <td width="606"><?php if(isset($hasil['Pat_Nam'])){echo $hasil['Pat_Nam'];} ?></td>
  </tr>
  <tr>
    <td>Tanggal Lahir</td>
    <td>:</td>
    <td>
	<?php 
		if(isset($hasil['Pat_DOB']))
		{
			$dob = $hasil['Pat_DOB']->format('d/m/Y');
			
			$tgl = substr($dob,0,2);
			$bulan = substr($dob,3,2);
			$tahun = substr($dob,6,4);
		
			if($bulan == '01')
			{
				$bln = 'Januari';	
			}
			else if($bulan == '02')
			{
				$bln = 'Februari';	
			}
			else if($bulan == '03')
			{
				$bln = 'Maret';
			}
			else if($bulan == '04')
			{
				$bln = 'April';
			}
			else if($bulan == '05')
			{
				$bln = 'Mei';
			}
			else if($bulan == '06')
			{
				$bln = 'Juni';
			}
			else if($bulan == '07')
			{
				$bln = 'Juli';
			}
			else if($bulan == '08')
			{
				$bln = 'Agustus';
			}
			else if($bulan == '09')
			{
				$bln = 'September';
			}
			else if($bulan == '10')
			{
				$bln = 'Oktober';
			}
			else if($bulan == '11')
			{
				$bln = 'November';
			}
			else if($bulan == '12')
			{
				$bln = 'Desember';
			}
		
			echo $tgl." ".$bln." ".$tahun;
		} 
	?>
    </td>
  </tr>
  <tr>
    <td>Jenis Kelamin</td>
    <td>:</td>
    <td>
	<?php 
		if(isset($hasil['Pat_Sex']))
		{
			if($hasil['Pat_Sex'] == 'M')
			{
				echo "Laki-Laki";
			}
			else
			{
				echo "Perempuan";
			}
		} 
	?>
    </td>
  </tr>
  <tr>
    <td>Anamnesa</td>
    <td>:</td>
    <td><?php if(isset($hasil['Anamnesa'])){echo $hasil['Anamnesa'];} ?></td>
  </tr>
  <tr>
    <td>Pemeriksaan Fisik</td>
    <td>:</td>
    <td><?php if(isset($hasil['Fisik'])){echo $hasil['Fisik'];} ?></td>
  </tr>
  <tr>
    <td>Pemeriksaan Penunjang</td>
    <td>:</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>- Laboratorium </td>
    <td>&nbsp;</td>
    <td><?php if(isset($hasil['Lab'])){echo $hasil['Lab'];} ?></td>
  </tr>
  <tr>
    <td>- Radiologi</td>
    <td>&nbsp;</td>
    <td><?php if(isset($hasil['Rad'])){echo $hasil['Rad'];} ?></td>
  </tr>
  <tr>
    <td>- Lain-lain</td>
    <td>&nbsp;</td>
    <td><?php if(isset($hasil['Lainnya'])){echo $hasil['Lainnya'];} ?></td>
  </tr>
  <tr>
    <td>Diagnosa Kerja</td>
    <td>:</td>
    <td><?php if(isset($hasil['Diag_Kerja'])){echo $hasil['Diag_Kerja'];} ?></td>
  </tr>
  <tr>
    <td>Diagnosa Banding</td>
    <td>:</td>
    <td><?php if(isset($hasil['Diag_Banding'])){echo $hasil['Diag_Banding'];} ?></td>
  </tr>
  <tr>
    <td>Terapi</td>
    <td>:</td>
    <td><?php if(isset($hasil['Terapi'])){echo $hasil['Terapi'];} ?></td>
  </tr>
  <tr>
    <td>Alasan Rujukan</td>
    <td>:</td>
    <td><?php if(isset($hasil['Alasan'])){echo $hasil['Alasan'];} ?></td>
  </tr>
  <tr>
    <td colspan="3" style="text-align:right">Jakarta,
    <?php 
		if(isset($hasil['Tanggal']))
		{
			$tgl1 = $hasil['Tanggal']->format('d/m/Y');
			
			$tglrujuk = substr($tgl1,0,2);
			$blnrujuk = substr($tgl1,3,2);
			$thnrujuk = substr($tgl1,6,4);
		
			if($blnrujuk == '01')
			{
				$bulanrujuk = 'Januari';	
			}
			else if($blnrujuk == '02')
			{
				$bulanrujuk = 'Februari';	
			}
			else if($blnrujuk == '03')
			{
				$bulanrujuk = 'Maret';
			}
			else if($blnrujuk == '04')
			{
				$bulanrujuk = 'April';
			}
			else if($blnrujuk == '05')
			{
				$bulanrujuk = 'Mei';
			}
			else if($blnrujuk == '06')
			{
				$bulanrujuk = 'Juni';
			}
			else if($blnrujuk == '07')
			{
				$bulanrujuk = 'Juli';
			}
			else if($blnrujuk == '08')
			{
				$bulanrujuk = 'Agustus';
			}
			else if($blnrujuk == '09')
			{
				$bulanrujuk = 'September';
			}
			else if($blnrujuk == '10')
			{
				$bulanrujuk = 'Oktober';
			}
			else if($blnrujuk == '11')
			{
				$bulanrujuk = 'November';
			}
			else if($blnrujuk == '12')
			{
				$bulanrujuk = 'Desember';
			}
		
			echo $tglrujuk." ".$bulanrujuk." ".$thnrujuk;
		} 
	?></td>
  </tr>
  <tr>
    <td colspan="3" style="text-align:right">Dokter yang merujuk</td>
  </tr>
  <tr>
    <td colspan="3" style="text-align:right">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" style="text-align:right">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" style="text-align:right"><?php if(isset($hasil['Perujuk'])){echo $hasil['Perujuk'];} ?></td>
  </tr>
  <tr>
    <td colspan="3" style="text-align:right">Nama & tanda tangan</td>
  </tr>
  <tr>
    <td colspan="3" style="text-align:right; padding-bottom:inherit" class="style1">Jl. Pantai Indah Utara 3, Pantai Indah Kapuk, Jakarta 14460</td>
  </tr>
  <tr>
    <td colspan="3" class="style1" style="text-align:right; padding-top:inherit">Tel. (021) 588 0911, 588 5188 Fax. (021) 588 0910, <em class="style2">www.pikhospital.co.id</em></td>
  </tr>
</table>
</div>
<script>

function PrintR()
{
    var mywindow = window.open('', 'PRINT', 'height=600,width=900');

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

</script>
</body>
</html>