<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Current Stock</title>
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
</style>
</head>
<body>
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12 mainPage">
          <button type="button" class="btn" onclick="PrintInv();">Print</button>
          <a class="btn" id="btnExport">Export</a>
          <br>
          <div id="PrintArea">
            <style type="text/css">
              table{
                border-collapse: collapse;
              }
              td{
                border:1px solid black;
              }
            </style>
            <div id="exportarea">
              <table id="myTable" border="1">
                <tr>
                  <th>Kode Service</th>
                  <th>Deskripsi</th>
                  <th>Jumlah Stock</th>
                  <th>Unit</th>
                </tr>

                <?php
                  include "koneksi.php";

                  $que = "select t.Service_Id, m.Descp, t.Stock, t.Unit from T_CurrentStock as t, M_Service as m where t.Service_Id = m.Service_id order by t.Service_Id";
                  
                  if(isset($_GET['kode1'])){
                    $kode1 = $_GET['kode1'];
                    $que = "select t.Service_Id, m.Descp, t.Stock, t.Unit from T_CurrentStock as t, M_Service as m where t.Service_Id = m.Service_id and t.Service_Id = '".$kode1."' order by t.Service_Id";
                  }

                  if(isset($_GET['kode2'])){
                    $kode2 = $_GET['kode2'];
                    $que = "select t.Service_Id, m.Descp, t.Stock, t.Unit from T_CurrentStock as t, M_Service as m where t.Service_Id = m.Service_id and t.Service_Id >= '".$kode1."' and t.Service_Id <= '".$kode2."' order by t.Service_Id";
                  }

                  $que_exe = sqlsrv_query($conn, $que);
                  while($currstock = sqlsrv_fetch_array($que_exe, SQLSRV_FETCH_ASSOC)){
                    echo "
                      <tr>
                        <td>".$currstock['Service_Id']."</td>
                        <td>".$currstock['Descp']."</td>
                        <td>".number_format($currstock['Stock'],0,",",".")."</td>
                        <td>".$currstock['Unit']."</td>
                      </tr>
                    ";
                  }
                ?>
              </table>
            </div>
          </div>
            
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

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script>
  function PrintInv()
  {
    var currentdate = new Date(); 
    var datetime = currentdate.getDate() + "/"
                    + (currentdate.getMonth()+1)  + "/" 
                    + currentdate.getFullYear() + " @ "  
                    + currentdate.getHours() + ":"  
                    + currentdate.getMinutes() + ":" 
                    + currentdate.getSeconds();

    var mywindow = window.open('', 'PRINT', 'height=400,width=600');

    mywindow.document.write('<html><head>');
    mywindow.document.write('</head><body >');
    mywindow.document.write('<center><h2>Laporan Stock Saat Ini</h2></center>');
    mywindow.document.write('<center>'+datetime+'</center>');
    mywindow.document.write('<br>');
    
    mywindow.document.write(document.getElementById("PrintArea").innerHTML);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();
    mywindow.close();

    return true;
  }
  $("#btnExport").click(function (e) {
    var currentdate = new Date(); 
    var datetime = currentdate.getDate() + "/"
                    + (currentdate.getMonth()+1)  + "/" 
                    + currentdate.getFullYear() + " @ "  
                    + currentdate.getHours() + ":"  
                    + currentdate.getMinutes() + ":" 
                    + currentdate.getSeconds();

    var htmltable= document.getElementById('myTable');
    var html = htmltable.outerHTML;

    var title = "<center><h2>Laporan Data Stock</h2></center>";
    title = title + "Tanggal Laporan : "+datetime;

    html = title + html;

    var result = "data:application/vnd.ms-excel," + encodeURIComponent(html);
    this.href = result;
    this.download = "Current Stock "+datetime+".xls";
    return true;
  });
</script>

<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script src="js/base.js"></script>

</body>
</html>
