<!DOCTYPE html>
<html lang="en">
<head>
<link rel="shortcut icon" href="..//RSBPJS/img/bpjs.png"/>
<meta charset="utf-8">
<title>Visitor Amount Report</title>
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
.style1 {
	font-size: 18px;
	color: #0099CC;
	font-style: italic;
}
.style2 {font-size: 24px; color: #0099CC; font-weight: bold; }
.style3 {font-size: 24px; color: #0099CC; font-style: italic; }
</style>
</head>
<body>
<?php include "header.php" ?>
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12 mainPage">
		
		<form name="Stock" method="POST" action="V_VisitorAmount.php">

          <p align="center" class="style2">Laporan Jumlah Visit</p>
          <p align="center" class="style3">( Visitor Amount Report )</p>
          <p align="center" class="style1">&nbsp;</p>
          <table width="1000" border="0" >
            <tr>
              <td>&nbsp;</td>
              <td>Tanggal</td>
              <td><div align="center">:</div></td>
              <td width="678" > <input name="TFDateFrom" type="text" class="key" id="TFDateFrom" size="12" value="<?php
          		if(isset($app['App_Date']))
          			{echo $app['App_Date']->format('d/m/Y');}
          		else
          			{echo date('d/m/Y');} ?>"/>
				   s/d
				<input name="TFDateTo" type="text" class="key" id="TFDateTo" size="12" value="<?php
          		if(isset($app['App_Date']))
          			{echo $app['App_Date']->format('d/m/Y');}
          		else
          			{echo date('d/m/Y');} ?>"/></td>
            </tr>
            <tr>
              <td width="227">&nbsp;</td>
              <td width="62">&nbsp;</td>
              <td width="15">&nbsp;</td>
              <td ><label for="Tgl2">
              <input type="submit" name="BtLogin" id="BtLogin" value="Preview" />
              </label></td>
            </tr>
          </table>

          <div style="display:none;">
            <table>
            </table>
          </div>
          <span id="tab"><?php /*?><?php include "T_Outpat_Table.php"; ?><?php */?></span>

          <script>

          	function button(x)
          	{
          		window.location.href = x;
          	}

          	$('.key').bind("enterKey",function(e){
          		$("#tab").empty();
          		$("#tab").load('T_Outpat_Table.php?tang=' + $("#Tgl2").val() + "&room=" + $("#roomID").val() + "&nama=" + $("#Patnam").val());
          	});

          	$('.key').keyup(function(e){
          	if(e.keyCode == 13)
          	{
          	  $(this).trigger("enterKey");
          	}
          	});

          	$('#roomID').change(function(e){
          	  $(this).trigger("enterKey");
          	});

          </script>
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

<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script src="js/base.js"></script>

</body>
</html>
