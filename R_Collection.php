<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Report Counter Collection</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
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
div.mainPage{
  min-height: 600px;
}
td{
  padding-left: 3px;
}
td.mid{
  padding-left: 0px;
  text-align: center;
}
iframe{
  border: 0;
  width: 1100px;
  height: 500px;
}
label{
  display: inline;
}
input[type=text]{
  width: 88%;
}
</style>

<!-- ========== Datetime Picker ========== -->
<!-- format tanggal php di ubah menjadi m/d/y mengikuti format JqueryUI -->
  <link rel="stylesheet" href="css/jquery-ui.min.css"> 
  <script src="js/jquery-ui.min.js"></script>
  <script>
    $( function() {
      $( ".datepicker" ).datepicker();
      $( ".datepicker" ).datepicker( "option", "dateFormat", 'dd/mm/yy' );
    } );
  </script>
<!-- ===================================== -->

</head>
<body>
<?php include "header_tran.php" ?>
<?php
  include "koneksi.php";

  $terminal = gethostbyaddr($_SERVER['REMOTE_ADDR']);
  $terminal = str_replace(".MMU.LOCAL.ID","",$terminal);
  $terminal = str_replace(".MMU","",$terminal);

  if($terminal == '192.168.2.60'){
    $terminal = "rumpin-laptop";
  }elseif($terminal == '192.168.2.61'){
    $terminal = "Rumpin-1";
  }elseif($terminal == '192.168.2.62'){
    $terminal = "Rumpin-2";
  }

  $que = "select count(*) as hasil from V_SessionOpen where User_Id = '".$usrname."' and Terminal_Id= '".$terminal."'";

  $que_exe = sqlsrv_query($conn,$que);
  $rs = sqlsrv_fetch_array($que_exe, SQLSRV_FETCH_ASSOC);

  if($rs['hasil'] != 0){
    echo "<input type='hidden' id='printable' value='false' />";
  }else{
    echo "<input type='hidden' id='printable' value='true' />";    
  }

?>
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12 mainPage">
          <br>
          <table>
            <tr>
              <td width="80">User ID</td>
              <td width="15">:</td>
              <td width="100"><input type="text" id="user"></td>             
              <td width="15"></td>
              <td width="80">Terminal</td>
              <td width="15">:</td>
              <td width="100"><input type="text" id="terminal"></td>
            </tr>
            <tr>
              <td>Tanggal</td>
              <td>:</td>
              <td><input type="text" id="tanggal" class="datepicker"></td>             
              <td></td>
              <td>Session</td>
              <td>:</td>
              <td><input type="text" id="session"></td> 
            </tr>
            <tr>
              <td>Tipe Laporan</td>
              <td>:</td>
              <td>
                <input type="radio" name="radType" id="detail" value="det" checked>
                <label for="detail">Detail</label>
              </td>
              <td colspan="4"><input type="radio" name="radType" id="summary" value="sum">
                <label for="summary">summary</label></td>
            </tr>
            <tr>
              <td colspan="2"></td>
              <td style="padding-top: 20px;"><button class="btn" onclick="searchCollection();">Submit</button></td>
              <td colspan="4"></td>
            </tr>
          </table>
          <br>
          <iframe id="collectionTable" src=""></iframe>
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
<script type="text/javascript">
  function searchCollection(){
    var user = document.getElementById("user").value;
    var tanggal = document.getElementById("tanggal").value;
    var terminal = document.getElementById("terminal").value;
    var session = document.getElementById("session").value;
    var tipe = document.getElementsByName('radType')[0].value;

    if(document.getElementsByName('radType')[0].checked){
      document.getElementById('collectionTable').src = "V_CollectionDet.php?user="+user+"&tanggal="+tanggal+"&terminal="+terminal+"&session="+session;
    }else if(document.getElementsByName('radType')[1].checked){
      document.getElementById('collectionTable').src = "V_CollectionSum.php?user="+user+"&tanggal="+tanggal+"&terminal="+terminal+"&session="+session;
    }
  }
</script>

<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script src="js/base.js"></script>

</body>
</html>
