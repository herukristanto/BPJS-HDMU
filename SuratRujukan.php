<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
			table {
				border-left: double;
				border-right: double;
				width: 100%;
			}
			
			td {
				padding-top : 5px;
				padding-bottom : 5px;
			}
			
			textarea{
				width:98%;	
			}
			
			.style1{
				font-size:11px;
				font-family:Arial, Helvetica, sans-serif;	
			}
			
			.style2{
				font-family:Times New Roman, Times, serif;	
			}
			</style>
</head>

<body>
<form action="SaveReferral.php" method="post" target="save">
<?php
	include 'koneksi.php';
  date_default_timezone_set("Asia/Bangkok");
  session_start();

  $page = basename($_SERVER['PHP_SELF']);
  $quer = "select count(*) as hasil from M_Authorization where User_ID = '".$_SESSION["username"]."' and Form_ID = '".$page."'";
  $sql_execute = sqlsrv_query($conn,$quer);
  $rs = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);
  if($rs["hasil"] == 0)
  {
    echo '<script>
    alert("Anda tidak berhak membuka halaman ini.");
    window.location="T_Case.php?case='.$_POST['Caseno'].'";
    </script>';
  }
			
	$caseno = $_POST['Caseno'];
	$patno = $_POST['Patno'];
	$pnam = $_POST['Nama'];
	$dob = $_POST['DOB'];
	$sex = $_POST['Sex'];
	
	$que = "select * from T_Referral where Case_No = '".$caseno."' and Pat_No = '".$patno."'";
    $sql = sqlsrv_query($conn,$que);
    $hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC);
?>
<p>
  <input type="submit" name="Save" id="Save" value="Save" />
  <input type="button" name="Print" id="Print" value="Print" <?php if($hasil['ID'] == ''){echo 'disabled="disabled"';}?> onClick="PrintRujuk();"/>
  <input type="button" name="Cancel" id="Cancel" value="Exit" onClick="button();" />
</p>
<input type="hidden" name="hidCase" id="hidCase" value="<?php echo $caseno ?>" />
<input type="hidden" name="hidPatno" id="hidPatno" value="<?php echo $patno ?>" />

<table style="border-top: double" width="401" border="0">
  <tr>
    <td colspan="2"><div align="center"> <b>SURAT RUJUKAN</b>    </div></td>
    <td width="147"><img src="image/logo.png" width="250" align="right" style="margin-right: 20px;margin-top: 20px;"></td>
  </tr>
  <tr>
    <td colspan="3">Kepada Yth.</td>
  </tr>
  <tr>
    <td width="27">Ts.</td>
    <td width="813"><label for="Doctor"></label>
    <input type="text" name="Doctor" id="Doctor" value="<?php if(isset($hasil['Doctor'])){echo $hasil['Doctor'];} ?>" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Di</td>
    <td><label for="In"></label>
    <input type="text" name="In" id="In" value="<?php if(isset($hasil['Tempat'])){echo $hasil['Tempat'];} ?>" /></td>
    <td>&nbsp;</td>
  </tr>
</table>

<table width="77%" border="0" style="border-bottom:double">
  <tr>
  	<td colspan="3">Mohon perawatan / penatalaksanaan selanjutnya untuk pasien :</td>
  </tr>
  <tr>
    <td width="143">Nama</td>
    <td width="7">:</td>
    <td width="753"><label for="Nama"></label>
    <input name="Nama" type="text" id="Nama" style="width:98%" value="<?php if(isset($hasil['Pat_Nam'])){echo $hasil['Pat_Nam'];}else { echo $pnam; } ?>" readonly="readonly"  /></td>
  </tr>
  <tr>
    <td>Tanggal Lahir</td>
    <td>:</td>
    <td><label for="DOB"></label>
    <input name="DOB" type="text" id="DOB" value="<?php if(isset($hasil['Pat_DOB'])){echo $hasil['Pat_DOB']->format('d/m/Y');}else { echo $dob; } ?>" readonly="readonly"/></td>
  </tr>
  <tr>
    <td>Jenis Kelamin</td>
    <td>:</td>
    <td><input type="radio" name="Sex" id="Male" value="M" <?php if(isset($hasil['Pat_Sex'])){echo ($hasil['Pat_Sex'] == 'M')?'checked':'';}else { if ($sex == 'M') { echo 'checked="checked"';}} ?> />
    <label for="Male">Laki-laki    
       <input type="radio" name="Sex" id="Female" value="F" <?php if(isset($hasil['Pat_Sex'])){echo ($hasil['Pat_Sex'] == 'F')?'checked':'';}else { if ($sex == 'F') { echo 'checked="checked"';}} ?> />
    Perempuan</label></td>
  </tr>
  <tr>
    <td>Anamnesa</td>
    <td>:</td>
    <td><label for="Anamnesa">
      <textarea name="Anamnesa" id="Anamnesa" maxlength="240"><?php if(isset($hasil['Anamnesa'])){echo $hasil['Anamnesa'];} ?></textarea>
    </label></td>
  </tr>
  <tr>
    <td>Pemeriksaan Fisik</td>
    <td>:</td>
    <td><textarea name="PFisik" id="PFisik" maxlength="240"><?php if(isset($hasil['Fisik'])){echo $hasil['Fisik'];} ?></textarea></td>
  </tr>
  <tr>
    <td>Pemeriksaan Penunjang</td>
    <td>:</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>- Laboratorium </td>
    <td>&nbsp;</td>
    <td><textarea name="Lab" id="Lab" maxlength="240"><?php if(isset($hasil['Lab'])){echo $hasil['Lab'];} ?></textarea></td>
  </tr>
  <tr>
    <td>- Radiologi</td>
    <td>&nbsp;</td>
    <td><textarea name="Rad" id="Rad" maxlength="240"><?php if(isset($hasil['Rad'])){echo $hasil['Rad'];} ?></textarea></td>
  </tr>
  <tr>
    <td>- Lain-lain</td>
    <td>&nbsp;</td>
    <td><textarea name="LN" id="LN" maxlength="240"><?php if(isset($hasil['Lainnya'])){echo $hasil['Lainnya'];} ?></textarea></td>
  </tr>
  <tr>
    <td>Diagnosa Kerja</td>
    <td>:</td>
    <td><label for="DiagKerja"></label>
    <textarea name="DiagKerja" id="DiagKerja" maxlength="240"><?php if(isset($hasil['Diag_Kerja'])){echo $hasil['Diag_Kerja'];} ?></textarea></td>
  </tr>
  <tr>
    <td>Diagnosa Banding</td>
    <td>:</td>
    <td><label for="DiagBanding"></label>
    <textarea name="DiagBanding" id="DiagBanding" maxlength="240"><?php if(isset($hasil['Diag_Banding'])){echo $hasil['Diag_Banding'];} ?></textarea></td>
  </tr>
  <tr>
    <td>Terapi</td>
    <td>:</td>
    <td><label for="Terapi"></label>
    <textarea name="Terapi" id="Terapi" maxlength="240"><?php if(isset($hasil['Terapi'])){echo $hasil['Terapi'];} ?></textarea></td>
  </tr>
  <tr>
    <td>Alasan Rujukan</td>
    <td>:</td>
    <td><label for="Alasan"></label>
    <textarea name="Alasan" id="Alasan" maxlength="240"><?php if(isset($hasil['Alasan'])){echo $hasil['Alasan'];} ?></textarea></td>
  </tr>
  <tr>
    <td colspan="3" style="text-align:right">Jakarta,
    <input type="text" name="Tgl" id="Tgl" value="<?php if(isset($hasil['Tanggal'])){echo $hasil['Tanggal']->format('d/m/Y');}else {echo date('d/m/Y');} ?>"/></td>
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
    <td colspan="3" style="text-align:right"><input type="text" name="DName" id="DName" value="<?php if(isset($hasil['Perujuk'])){echo $hasil['Perujuk'];} ?>"/></td>
  </tr>
  <tr>
    <td colspan="3" style="text-align:right">Nama & tanda tangan</td>
  </tr>
  <tr>
    <td colspan="3" style="text-align:right; padding-bottom:inherit" class="style1">Jl. Pantai Indah Utara 3, Pantai Indah Kapuk, Jakarta 14460</td>
  </tr>
  <tr>
    <td colspan="3" style="text-align:right; padding-top:inherit" class="style1">Tel. (021) 588 0911, 588 5188 Fax. (021) 588 0910, <em class="style2">www.pikhospital.co.id</em></td>
  </tr>
</table>

</form>
<iframe name="save" hidden></iframe>
<script>

  	function button()
  	{
  		window.location.href = "T_Case.php?case="+document.getElementById('hidCase').value;
  	}
	
	function PrintRujuk()
  	{
  		window.location.href = "PrintReferral.php?caseno="+document.getElementById('hidCase').value+"&patno="+document.getElementById('hidPatno').value;
  	}
	
</script>
</body>
</html>