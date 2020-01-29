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
        <div class="span12 mainPage1">
          <div id="PrintArea">
            <style type="text/css">
              table{
                border-collapse: collapse;
              }
              td{
                border:1px solid black;
              }
              table tr td.noBorder{
                border:0;
              }
            </style>
            <?php 
              include "koneksi.php";

              $user = $_GET["user"];
              $tanggal = $_GET["tanggal"];
              $terminal = $_GET["terminal"];
              $session = $_GET["session"];

              $tgl1 = DateTime::createFromFormat('d/m/Y', $tanggal);
              $tgl = $tgl1->format('Y/m/d');

              $quecek = "Select count(*) as hasil from T_Collection where User_Id = '".$user."' and Terminal_Id = '".$terminal."' and Start_Date = CONVERT(datetime, '".$tgl."', 120) and End_Date is null";
              $quecek_exe = sqlsrv_query($conn,$quecek);
              $rs = sqlsrv_fetch_array($quecek_exe, SQLSRV_FETCH_ASSOC);

              if($rs['hasil'] != 0){
                exit("<h3>Tidak bisa mencetak laporan sebelum menutup counter collection!</h3>");
              }
            ?>
            <div id="exportarea">
              <table>
                <tr>
                  <td class="noBorder" width="80">User ID</td>
                  <td class="noBorder" width="15">:</td>
                  <td class="noBorder" width="100"><?php echo $user; ?></td>             
                  <td class="noBorder" width="15"></td>
                  <td class="noBorder" width="80">Terminal</td>
                  <td class="noBorder" width="15">:</td>
                  <td class="noBorder" width="100"><?php echo $terminal; ?></td>
                </tr>
                <tr>
                  <td class="noBorder">Tanggal</td>
                  <td class="noBorder">:</td>
                  <td class="noBorder"><?php echo $tanggal; ?></td>             
                  <td class="noBorder"></td>
                  <td class="noBorder">Session</td>
                  <td class="noBorder">:</td>
                  <td class="noBorder"><?php echo $session; ?></td> 
                </tr>
              </table>
              <br>
              <table id="myTable" border="1">
                <tr>
                  <th width="250px">Jenis Pembayaran</th>
                  <th>Jumlah</th>
                </tr>

                <?php

                  $day = substr($tanggal,0,2);
                  $mon = substr($tanggal,3,2);
                  $year = substr($tanggal,6,4);

                  $tanggal = $year."/".$mon."/".$day;

                  $que = "select m.Payment, sum(d.Amount) as Amount from T_Collection as t, D_Collection as d, M_PayType as m where t.ID = d.ID and t.User_Id = '".$user."' and d.Payment_Type = m.Pay_Id and t.Start_Date = '".$tanggal."' and t.Terminal_Id = '".$terminal."' and t.Session_Id = '".$session."' group by m.Payment order by m.Payment";

                  $que = "
                    select Payment, sum(amt) as total from(
                      select Payment, (Amount - Disc_Amt) as amt from V_POSTrans
                      where Create_By = '".$user."' 
                      and CTerminal = '".$terminal."' 
                      and CSession = '".$session."' 
                      and CONVERT(varchar, Create_Time, 111) = '".$tanggal."' 

                      union

                      Select Payment, (Amount - Disc_Amt) * -1 as amt from V_POSRefund 
                      where Create_By = '".$user."' 
                      and CTerminal = '".$terminal."' 
                      and CSession = '".$session."' 
                      and CONVERT(varchar, Create_Time, 111) = '".$tanggal."'
                    ) a
                    group by payment";
                   
                  
                  $que_exe = sqlsrv_query($conn, $que);
                  while($pay = sqlsrv_fetch_array($que_exe, SQLSRV_FETCH_ASSOC)){
                    echo "
                      <tr>
                        <td>".$pay['Payment']."</td>
                        <td style='text-align: right;'>".number_format($pay['total'],0,",",".")."</td>
                      </tr>
                    ";
                  }
                ?>

              </table>
            </div>
            
          </div>
          <br>
          <button type="button" class="btn" onclick="PrintInv();">Print</button>
          <a class="btn" id="btnExport">Export</a>
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
    var mywindow = window.open('', 'PRINT', 'height=400,width=600');

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
  $("#btnExport").click(function (e) {
    var htmltable= document.getElementById('exportarea');
    var html = htmltable.outerHTML;

    var title = "<center><h2>Laporan Detail Kasir</h2></center>";

    html = title + html;

    var result = "data:application/vnd.ms-excel," + encodeURIComponent(html);
    this.href = result;
    this.download = "my-custom-filename.xls";
    return true;
  });
</script>
<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script src="js/base.js"></script>

</body>
</html>
