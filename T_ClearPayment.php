<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Klinik HDMU</title>
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
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12 mainPage">

					<table>
						<tr>
							<td>Tanggal Payment</td>
							<td width=15>:</td>
							<td><input type="text" class="datepicker" name="key" id="key"></td>
							<td><button type="button" class="btn" onclick="getTable();">Search</button></td>
						</tr>
					</table>
          <br>

          <div id="tabClear"></div>

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
  function getTable(){
    var date = document.getElementById('key').value;
    var url = 'T_ClearPayment_Table.php?date='+date;

		$("#tabClear").empty();
    $("#tabClear").html("<h2>Please Wait. . . .</h2>");
		$("#tabClear").load(url);
  }
</script>

<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script src="js/base.js"></script>

</body>
</html>
