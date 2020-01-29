<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Proses Split Invoice</title>
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

            $queDet = "select * from V_Invoice where Case_No = '".$case."'";
            $queDet_exe = sqlsrv_query($conn,$queDet);
            $det = sqlsrv_fetch_array($queDet_exe, SQLSRV_FETCH_ASSOC);
            if(is_null($det)){
              echo "
                  <script>
                    alert('Pasien ini tidak memiliki billing.');
                    window.location.href='outpatient.php';
                  </script>
              ";
            }
          ?>
          <button type="button" class="btn" onclick="saveSplit();">Proses</button>
          <button type="button" class="btn" onclick="window.location.href='outpatient.php';">Exit</button>

          <input type="hidden" id="pn" value="<?php echo $det['Pat_No']; ?>"  />
          <input type="hidden" id="cn" value="<?php echo $det['Case_No']; ?>"/>

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


          <?php
            $que = "select * from V_PayBilling where Case_No = '".$case."' and Bill_Id like 'I%' and Pay_Id is null and Status <> 'C'";
            $que_exe = sqlsrv_query($conn1,$que);
            // $inv = sqlsrv_fetch_array($que_exe, SQLSRV_FETCH_ASSOC);
          ?>

          <table id="myTable">
            <tr>
              <th>Nomor Invoice</th>
              <th>Jumlah Tagihan</th>
              <th>Potongan</th>
            </tr>

          <?php
            while($inv = sqlsrv_fetch_array($que_exe, SQLSRV_FETCH_ASSOC)){
              if($inv['Ref'] != ''){
                echo "
                  <script>
                    alert('pasien ini sudah memiliki split invoice.');
                    window.location.href='T_SplitInvoice.php?case=".$det['Case_No']."';
                  </script>
                ";
              }
              echo "
                <tr>
                  <td>".$inv['Bill_Id']."</td>
                  <td>".number_format($inv['Amount'],0,",",".")."</td>
                  <td><input id='".$inv['Bill_Id']."' /></td>
                </tr>
              ";
            }
          ?>

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
<script type="text/javascript">
  function saveSplit(){
    var i;
    var j;
    var amt;
    var arr1 = [];
    var arr2 = [];
    var tabs = document.getElementById("myTable");
    var count = tabs.rows.length - 1;
    for(i = 0;i < count;i++){
      j = i + 1;
      amt = tabs.rows[j].cells[2].children[0].value;
      if(amt != "" && amt != "0" && amt != "<br>"){
        arr2 = [];
        arr2[0] = tabs.rows[j].cells[0].innerHTML;
        arr2[1] = amt;
        arr1[i] = arr2;
      }
    }
    var pn = document.getElementById("pn").value;
    var cn = document.getElementById("cn").value;

    if(arr1.length > 0){
    	$.post("ProsesSplitInvoice.php", {'myData': arr1,'pat': pn,'case': cn}, function(data, status){
	      alert(data);
	    });
    }
  }

</script>

<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script src="js/base.js"></script>

</body>
</html>
