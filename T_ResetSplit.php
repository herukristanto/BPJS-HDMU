<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Reset Split Invoice</title>
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
</style>
</head>
<body>
<?php include "header_tran.php" ?>
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12 mainPage">
          <?php
            include "koneksi.php";

            $case = $_GET['case'];

            $que = "select * from V_PayBilling where Case_No = '".$case."' and ref <> ''";
            $que_exe = sqlsrv_query($conn,$que);
            $inv = sqlsrv_fetch_array($que_exe, SQLSRV_FETCH_ASSOC);

            if(is_null($inv)){
              echo "
                <script>
                  alert('Pasien ini tidak memiliki Split Invoice');
                  window.location.href = 'Outpatient.php';
                </script>
              ";
            }else{
              $queSplit = "Select Bill_Id, Amount from V_PayBilling where Bill_Id = '".$inv['Ref']."'";
              $queSplit_exe = sqlsrv_query($conn,$queSplit);
              $split = sqlsrv_fetch_array($queSplit_exe, SQLSRV_FETCH_ASSOC);

            }

            $queDet = "select * from V_Invoice where Case_No = '".$case."'";
            $queDet_exe = sqlsrv_query($conn,$queDet);
            $det = sqlsrv_fetch_array($queDet_exe, SQLSRV_FETCH_ASSOC);
            
          ?>

          <button type="button" class="btn" onclick="prosesReset();">Proses Reset</button>
          <button type="button" class="btn" onclick="cancelReset();">Exit</button>
          <br><br>
          <table>
            <tr>
              <td width="100">Nama</td>
              <td width="15">:</td>
              <td width="150"><?php echo $det['Name']; ?></td>
              <td width="15"></td>
              <td width="100">Pembayar</td>
              <td width="15">:</td>
              <td width="150"><?php echo $det['Pembayar']; ?></td>
            </tr>
            <tr>
              <td>Nomor RM</td>
              <td>:</td>
              <td><?php echo $det['Pat_No']; ?></td>
              <td></td>
              <td>Nomor Case</td>
              <td>:</td>
              <td><?php echo $det['Case_No']; ?></td>
            </tr>
          </table>

          <table id="myTable">
            <tr>
              <th>Nomor Invoice</th>
              <th>Jumlah</th>
            </tr>
            <tr>
              <td><?php echo $split['Bill_Id']; ?></td>              
              <td><?php echo number_format($split['Amount'],0,",","."); ?></td>
            </tr>
          </table>

          <input type="hidden" id="hidCase" value="<?php echo $det['Case_No']; ?>">
          <input type="hidden" id="hidInv" value="<?php echo $split['Bill_Id']; ?>">

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
  var cas = document.getElementById("hidCase").value;
  var ref = document.getElementById("hidInv").value;
  
  function prosesReset(){
    var r = confirm("Reset Split Billing "+ref+" ?");
    if (r == true) {
      window.location.href = "ProsesResetSplit.php?ref="+ref+"&case="+cas;
    }
  }
  
  function cancelReset(){
    window.location.href = "Outpatient.php";
  }
</script>


<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script src="js/base.js"></script>

</body>
</html>
