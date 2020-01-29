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
        padding: 3px;
      }
    </style>
    <div id="exportarea">
      <table id="myTable" border="1">
        <tr>
          <th>No. RM</th>
          <th>No. Case</th>
          <th>Nama Pasien</th>
          <th>Tanggal</th>
          <th>Kode Diagnosa</th>
          <th>Deskripsi</th>
        </tr>

        <?php
          include "koneksi.php";

          $from = ''; $to = '';

          if(isset($_POST['from'])){
            $p1 = $_POST['from'];
            $from = date('Y-m-d',strtotime($_POST['from']))." 00:00:00";
          }

          if(isset($_POST['to']) && $_POST['to'] != ''){
            $p2 = $_POST['to'];
            $to = date('Y-m-d',strtotime($_POST['to']))." 23:59:59";
          }else{
            $p2 = $_POST['from'];
            $to = date('Y-m-d',strtotime($_POST['from']))." 23:59:59"; 
          }

          // echo $from." to ".$to;

          $que = "select * from V_Diagnose where Tanggal between '".$from."' and '".$to."'";
          // echo $que;
          $que_exe = sqlsrv_query($conn, $que);

          while($row = sqlsrv_fetch_array($que_exe, SQLSRV_FETCH_ASSOC)){
            echo "
              <tr>
                <td>".$row['Case_No']."</td>
                <td>".$row['Pat_No']."</td>
                <td>".$row['Name']."</td>
                <td>".$row['Tanggal']->format('d/m/Y')."</td>
                <td>".$row['Diag_Id']."</td>
                <td>".$row['Diagnose']."</td>
              </tr>
            ";
          }
        ?>
      </table>
    </div>
  </div>
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

    var mywindow = window.open('', 'PRINT', 'height=600,width=800');

    mywindow.document.write('<html><head>');
    mywindow.document.write('</head><body >');
    mywindow.document.write('<center><h2>Laporan List Diagnosa</h2></center>');
    mywindow.document.write('<br>');
    mywindow.document.write("Periode : <?php echo $p1; ?> s/d <?php echo $p2; ?><br>");
    mywindow.document.write("Tanggal Cetak Laporan : "+datetime);
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

    var title = "<center><h2>Laporan List Diagnosa</h2></center>";
    title = title + "Periode : <?php echo $p1; ?> s/d <?php echo $p2; ?><br>";
    title = title + "Tanggal Cetak Laporan : "+datetime;

    html = title + html;

    var result = "data:application/vnd.ms-excel," + encodeURIComponent(html);
    this.href = result;
    this.download = "Report List Diagnosa.xls";
    return true;
  });
</script>

<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script src="js/base.js"></script>

</body>
</html>
