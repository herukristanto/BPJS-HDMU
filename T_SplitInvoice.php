<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Split Invoice</title>
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

            $que = "Select Pembayar from T_Case where Case_No = '".$case."'";
            $que_exe = sqlsrv_query($conn,$que);
            $bayar = sqlsrv_fetch_array($que_exe, SQLSRV_FETCH_ASSOC);

            if(substr($bayar['Pembayar'],0,2) != '72'){
              echo "
                <script>
                  alert('Split invoice hanya berlaku untuk pembayaran menggunakan asuransi.');
                  window.location.href = 'Outpatient.php';
                </script>
              ";
            }else{
              $ins = $bayar['Pembayar'];
            }
          ?>

          <p>
            <input type="button" class="btn" name="Submit" id="Submit" value="Proses" onclick="proses();" />
            <!-- <input type="button" class="btn" id="Reset" value="Reset Split" onclick="resetSplit();" /> -->
            <input type="button" class="btn" name="Cancel" id="Cancel" value="Exit" onclick="button();" />
          </p>

          <table>
            <tr>
              <td width="73">Asuransi</td>
              <td width="10">:</td>
              <td width="250">
                <input type="text" name="Insno" id="Insno" value="<?php echo $ins; ?>" readonly/>&nbsp;
                <input type="submit" name="SrcIns" id="SrcIns" value="..." />
              </td>
            </tr>
            <tr>
              <td>No. Case</td>
              <td>:</td>
              <td><label for="Caseno"></label>
              <input type="text" name="Caseno" id="Caseno" value="<?php echo $case; ?>" readonly/></td>
            </tr>
          </table>

          <!-- <?php include "SearchInsurance.php"; ?> -->

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
  function button()
  {
    window.location.href = "Outpatient.php";
  }
  function proses()
  {
    var caseno = document.getElementById("Caseno").value;
    window.location.href = "T_ProsesSplit.php?case="+caseno;
  }
  // function resetSplit()
  // {
  //   var caseno = document.getElementById("Caseno").value;
  //   window.location.href = "T_ResetSplit.php?case="+caseno;
  // }
</script>

<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script src="js/base.js"></script>

</body>
</html>
