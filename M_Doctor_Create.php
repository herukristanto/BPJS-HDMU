<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Doctor - Create</title>
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
          <button type="button" class="btn" onclick="savedokter();">Save</button>
          <button type="button" class="btn" onclick="cleardokter();">Exit</button>
          <button type="button" class="btn closeMstr">Exit</button>
          <br><br>
          <table>
            <tr>
              <td width="120">Kode Dokter</td>
              <td width="15"> : </td>
              <td><input type="text" id="iddok" name="kodedokter" disabled></td>
            </tr>
            <tr>
              <td>Nama Dokter</td>
              <td> : </td>
              <td><input type="text" id="namadok" name="nama" maxlength="50"></td>
            </tr>
            <tr hidden>
              <td>Aktif</td>
              <td> : </td>
              <td><input type="radio" name="statdok" id="aktif" checked> Aktif</td>
              <td><input type="radio" name="statdok" id="nonaktif"> Non-Aktif</td>
            </tr>
          </table>

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
  function savedokter(){
    var iddok;
    var namadok;
    iddok = document.getElementById('iddok').value;
    namadok = document.getElementById('namadok').value;

    var cekradiobutton = document.getElementById('aktif');
    if (cekradiobutton.checked){
      statdok = "X";
    }else{
      statdok = " ";
    }

    var simpan;
    simpan = "baru";

    if (namadok) {
      window.location.href='M_Doctor_Save.php?iddok=' + iddok + '&namadok=' + namadok + '&statdok=' + statdok + '&simpan=' + simpan;
    } else {
      alert("Kolom 'Nama' harus diisi..");
    }
  }

  function cleardokter(){
    document.getElementById('namadok').value = '';
    document.getElementById('iddok').value = '';
    radiobtn = document.getElementById("aktif");
    radiobtn.checked = true;
    radiobtn = document.getElementById("nonaktif");
    radiobtn.checked = false;
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
