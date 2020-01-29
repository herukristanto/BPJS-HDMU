<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Insurance - Change</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
<!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet"> -->
<link href="css/fontGoogle.css" rel="stylesheet">
<link href="css/css/font-awesome.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/pages/dashboard.css" rel="stylesheet">
<script src="js/jquery-1.7.2.min.js"></script>
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<style>
td{
  padding-left: 3px;
}
td.mid{
  padding-left: 0px;
  text-align: center;
}
</style>
</head>
<body>
<?php include "header_mstr.php" ?>
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12 mainPage">
          <form method="post" action="M_Insurance_Save.php" onsubmit="return saveasuransi();">
            <button type="button" class="btn" id="myBtn">Search</button>
          	<button type="submit" class="btn" id="upData" onclick="saveasuransi();" disabled>Save</button>
          	<button type="button" class="btn" onclick="clearasuransi();">Exit</button>
            <button type="button" class="btn closeMstr">Exit</button>
  					<br><br>
          	<table>
          		<tr>
          			<td width="120">Kode Asuransi</td>
          			<td width="15"> : </td>
          			<td><input type="text" id="kodeasuransi" name="kodeasuransi" readonly></td>
          		</tr>
          		<tr>
          			<td>Nama Asuransi</td>
          			<td> : </td>
          			<td><input type="text" id="namaasuransi" name="namaasuransi" maxlength="50"></td>
          		</tr>
          		<tr>
          			<td>Alamat</td>
          			<td> : </td>
          			<td><input type="text" id="alamat" name="alamat" maxlength="100"></td>
          		</tr>
          		<tr>
          			<td>No. Telp</td>
          			<td> : </td>
          			<td><input type="text" id="telp" name="notelepon" maxlength="30" class="numberonly"></td>
          		</tr>
          		<tr>
          			<td>Kontak Person</td>
          			<td> : </td>
          			<td><input type="text" id="kontak" name="kontakperson" maxlength="50"></td>
          		</tr>
          		<tr>
          			<td>Aktif</td>
          			<td> : </td>
          			<td><input type="radio" id="aktif" name="statasuransi" value="X" checked>Aktif</td>
          			<td><input type="radio" id="nonaktif" name="statasuransi" value=" ">Tidak Aktif</td>
          		</tr>
          	</table>

            <input type="hidden" name="hidmode" value="ubah" />
          </form>

        	<?php include "M_Insurance_Search.php"; ?>

        </div>
        <!-- /span12 -->
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /main-inner -->
</div>
<!-- /main -->
<?php include "footer.html"; ?>

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script>
  function saveasuransi(){
    var kodeasuransi;
    var namaasuransi;
    var alamat;
    var telp;
    var kontak;
    var statasuransi;
    kodeasuransi = document.getElementById('kodeasuransi').value;
    namaasuransi = document.getElementById('namaasuransi').value;
    alamat = document.getElementById('alamat').value;
    telp = document.getElementById('telp').value;
    kontak = document.getElementById('kontak').value;

    var cekradiobutton = document.getElementById('aktif');
    if (cekradiobutton.checked){
      statasuransi = "X";
    }else{
      statasuransi = " ";
    }

    if (namaasuransi != "" && alamat != "" && telp != "" && kontak != "") {
      //window.location.href='M_Insurance_Save.php?kodeasuransi=' + kodeasuransi + '&namaasuransi=' + namaasuransi + '&alamat=' + alamat + '&telp=' + telp + '&kontak=' + kontak + '&statasuransi=' + statasuransi  + '&simpan=' + simpan ;
    } else {
      alert("Anda belum mengisi data dengan lengkap");
      return false;
    }
  }

  function clearasuransi(){
    document.getElementById('kodeasuransi').value = '';
    document.getElementById('namaasuransi').value = '';
    document.getElementById('alamat').value = '';
    document.getElementById('telp').value = '';
    document.getElementById('kontak').value = '';
    radiobtn = document.getElementById("aktif");
    radiobtn.checked = true;
    radiobtn = document.getElementById("nonaktif");
    radiobtn.checked = false;
    document.getElementById("upData").disabled = true;
  }

</script>

<script src="js/excanvas.min.js"></script>
<script src="js/chart.min.js" type="text/javascript"></script>
<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script language="javascript" type="text/javascript" src="js/full-calendar/fullcalendar.min.js"></script>
<script src="js/base.js"></script>

</body>
</html>
