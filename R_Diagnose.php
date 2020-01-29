<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Diagnose</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="css/fontGoogle.css" rel="stylesheet">
<link href="css/css/font-awesome.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/pages/dashboard.css" rel="stylesheet">
<script src="js/jquery-1.7.2.min.js"></script>

<link rel="stylesheet" href="css/jquery-ui.min.css">
<script src="js/jquery-ui.min.js"></script>
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
input.datepicker{
	width: 150px;
}
iframe{
	border: 0;
	width: 98%;
	height: 600px;
}
</style>

<!-- ========== Datetime Picker ========== -->
<!-- format tanggal php di ubah menjadi m/d/y mengikuti format JqueryUI -->
  <link rel="stylesheet" href="css/jquery-ui.min.css"> 
  <script src="js/jquery-ui.min.js"></script>
  <script>
    $( function() {
      $( ".datepicker" ).datepicker();
      $( ".datepicker" ).datepicker( "option", "dateFormat", 'dd-mm-yy' );
    } );
  </script>
<!-- ===================================== -->

</head>
<body>
<?php include "header.php" ?>
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12 mainPage">
        	<form action="V_Diagnose.php" method="post" target="myFrame" onsubmit="return validate();">
        		<table>
							<caption><h2>Report List Diagnosa</h2></caption>
							<tr>
								<td colspan="3">&nbsp;</td>
							</tr>
							<tr>
								<td>Periode</td>
								<td width="15">:</td>
								<td width="150"><input type="text" class="datepicker" name="from" id="from"></td>
								<td width="25"> s/d </td>
								<td width="150"><input type="text" class="datepicker" name="to" id="to"></td>
								<td><button type="submit" class="btn">Preview</button></td>
							</tr>
						</table>
        	</form>

        	<iframe src="" name="myFrame"></iframe>
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
	function validate(){
		var from = document.getElementById('from').value;
		var to = document.getElementById('to').value;

		if(from == ''){
			alert('Masukan Tanggal Awal.');
			return false;
		}

		return true;
	}
</script>

<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script src="js/base.js"></script>

</body>
</html>
