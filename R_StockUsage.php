<!DOCTYPE html>
<html lang="en">
<head>
<link rel="shortcut icon" href="..//RSBPJS/img/bpjs.png"/>
<meta charset="utf-8">
<title>Stock Usage Report</title>
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
.style4 {font-size: 14px}
</style>
		
</head>
<body>
<?php include "header.php" ?>
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12 mainPage">
		
		      <form name="Stock" method="POST" action="V_StockUsage.php">

            <p align="center" class="style2">Laporan Pemakaian Stok </p>
            <p align="center" class="style3">( Stock Usage Report ) </p>
            <p align="center" class="style1">&nbsp;</p>
            <table width="1000" border="0" class="style4">
              <tr>
                <td>&nbsp;</td>
                <td><span class="style4">Tanggal</span></td>
                <td>:</td>
                <td colspan="2" >
                  <span class="style4">
                    <input name="TFDateFrom" type="text" id="TFDateFrom"
                    value="<?php  if(isset($app['App_Date']))
                              			{echo $app['App_Date']->format('d/m/Y');}
                              		else
                              			{echo date('d/m/Y');} ?>"/>
    				        s/d
    				        <input name="TFDateTo" type="text" id="TFDateTo" size="12" 
                    value="<?php  if(isset($app['App_Date']))
                              			{echo $app['App_Date']->format('d/m/Y');}
                              		else
                              			{echo date('d/m/Y');} ?>"/>
                  </span>
                </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td width="100px" >Kode Servis</td>
                <td>:</td>
                <td colspan="2">
                  <input type="text" name="kode1"> s/d
                  <input type="text" name="kode2">
                </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td width="218">
                  <span class="style4">
                    <input name="RadioButton" type="radio" value="Detail" checked="checked" /> Detail
                  </span>
                </td>
                <td width="454">
                  <span class="style4">
                    <input name="RadioButton" type="radio" value="Summary" id="radio" /> Summary
                  </span>
                </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td width="227">&nbsp;</td>
                <td width="63">&nbsp;</td>
                <td width="16">&nbsp;</td>
                <td colspan="2" >
                  <span class="style4">
                    <label for="Tgl2">
                      <input type="submit" name="BtnPreview" id="BtnPreview" value="Preview" />
  				          </label>
                  </span>
                </td>
              </tr>
            </table>		  

            <span id="tab"></span>
		      </form>

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
