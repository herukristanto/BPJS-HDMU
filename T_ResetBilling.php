<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Reset Billing</title>
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
<?php include "header_tran.php" ?>
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12 mainPage">
          <p>
            <button type="button" class="btn" name="Reset" id="Reset" onclick="Reset();" disabled>Reset Billing</button>
            <button type="button" class="btn" name="Cancel" id="Cancel" onclick="button();">Exit</button>
          </p>
          <table border="0">
            <tr>
              <td width="98">Nomor Pasien</td>
              <td width="12">:</td>
              <td width="300"><input name="Patno" type="text" id="Patno" readonly="readonly" /></td>
            </tr>
            <tr>
              <td>Nomor Case</td>
              <td>:</td>
              <td><input name="Caseno" type="text" id="Caseno" readonly="readonly" /></td>
            </tr>
            <tr>
              <td>Nama Pasien</td>
              <td>:</td>
              <td><input name="Nama" type="text" id="Nama" readonly="readonly" /></td>
            </tr>
            <tr>
              <td>No.Invoice</td>
              <td>:</td>
              <td>
                <input name="Invno" type="text" id="Invno" readonly="readonly" />
                <input type="Button" name="SearchInv" id="SearchInv" value="..." />
              </td>
            </tr>
          </table>
          <?php include "SearchInvoice.php"; ?>
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
	function button()
	{
		window.location.href ='Outpatient.php';
	}

	function Reset()
	{
    var inv = document.getElementById("Invno").value;
    var r = confirm("Reset Billing "+inv+" ?");
    if (r == true) {
      window.location.href = "ResetBilling.php?invno="+document.getElementById('Invno').value;
    }
	}
</script>

<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script src="js/base.js"></script>

</body>
</html>
