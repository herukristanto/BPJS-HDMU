<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Update Stock Batch</title>
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
  width: 700px;
  height: 500px;
}
</style>
</head>
<body>
<?php include "header_tran.php" ?>
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12 mainPage">
          <h2>Stock Adjustment</h2><br>

          <form method="post" action="SaveUpStock.php" onsubmit="return verify();">
            <table>
              <tr>
                <td width="100">Kode Servis</td>
                <td width="15">:</td>
                <td>
                  <input type="text" id="scode" name="scode" style="width: 100px;" onfocusout="getDesc();">
                  <input type="button" name="srvSrc" id="myBtn" value="...">
                  - 
                  <input type="text" id="sdesc" name="sdesc" style="width: 300px;" readonly>
                </td>
              </tr>
              <tr>
                <td>Jumlah</td>
                <td>:</td>
                <td>
                  <input type="text" id="stock" name="stock" style="width: 100px;" onfocusout="cekStock();">
                </td>
              </tr>
              <tr>
                <td>Keterangan</td>
                <td>:</td>
                <td>
                  <input type="text" id="ket" name="ket" style="width: 450px;">&nbsp;&nbsp;
                  <button type="submit" class="btn" >Submit</button>
                </td>
              </tr>
            </table>

            <input type="hidden" id="type">
            <input type="hidden" id="currstock">
            <input type="hidden" id="unit" name="unit">
            <input type="hidden" id="startd">
            <input type="hidden" id="endd">
          </form>

          <br>

          <table id='myTable'>
            <tr>
              <th width=50></th>
              <th width=100>Kode Service</th>
              <th width=300>Deskripsi</th>
              <th width=90>Jumlah</th>
              <th width=250>Keterangan</th>
            </tr>

            <?php
              include "koneksi.php";
              date_default_timezone_set("Asia/Bangkok");

              $today = date('Y/m/d');
              $que = "Select * from T_UpStockBatch where CONVERT(varchar, Create_Date, 111) = '".$today."'";
              $que_exe = sqlsrv_query($conn, $que);

              while ($rows = sqlsrv_fetch_array($que_exe)) {
                echo "
                  <tr>
                    <td><input type='button' class='btn' value='del' onclick='delRow(\"".$rows['ID']."\");'></td>
                    <td>".$rows['Service_Id']."</td>
                    <td>".$rows['Descp']."</td>
                    <td>".$rows['Qty']." ".$rows['Unit']."</td>
                    <td>".$rows['Keterangan']."</td>
                  </tr>
                ";
              }

            ?>

          </table>

          <iframe src="" id="getDesc" hidden></iframe>

          <?php include "SearchService.php"; ?>
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
  function getDesc(){
    var kode = document.getElementById("scode").value;
    
    if(kode != ''){
      document.getElementById("getDesc").src = "GetDesc.php?kode="+kode;
    }
  }
  
  function cekStock(){
    var stock = parseInt(document.getElementById("currstock").value);
    var potstock = parseInt(document.getElementById("stock").value);
    var tipeStock = document.getElementById("type").value;

    if(potstock != '' && tipeStock == 'X'){
      if(potstock > stock){
        alert("stock material tidak mencukupi");
        document.getElementById("stock").value = '';
      }
    }
  }

  function verify(){
    var kode = document.getElementById("scode").value;
    var desc = document.getElementById("sdesc").value;
    var stck = document.getElementById("stock").value;

    var cf = confirm('Simpan data?');
    if(cf)
    {
      if(kode != '' && desc != '' && stck != '' ){
        return true;
      }else{
        alert('Lengkapi data');
        return false;
      }
    }else{
      return false;
    }
  }

  function delRow(idnya){
    var cf = confirm('Anda Yakin Ingin Menghapus?');
    if(cf)
    {
    window.location.href = "DeleteUpStock.php?id="+idnya;
    }
  }
</script>

<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script src="js/base.js"></script>

</body>
</html>