<!DOCTYPE html>
<html lang="en">
<head>
<link rel="shortcut icon" href="image/icon.png"/>
<meta charset="utf-8">
<title>Cash Income Report</title>
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

          <form name="Income" method="POST" action="V_CashIncome.php">

          <p align="center" class="style2">Laporan Pendapatan Kasir </p>
          <p align="center" class="style3">( Cash Income Report ) </p>
          <p align="center" class="style1">&nbsp;</p>
          <table width="1077" border="0" >
            <tr>
              <td>&nbsp;</td>
              <td><div align="left">Tanggal</div></td>
              <td><div align="center">:</div></td>
              <td><input name="TFDateTo" type="text" class="key" id="TFDateTo" size="12" value="<?php
          		if(isset($app['App_Date']))
          			{echo $app['App_Date']->format('d/m/Y');}
          		else
          			{echo date('d/m/Y');} ?>"/></td>
              <td width="445" >&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><div align="left">Session</div></td>
              <td>:</td>
              <td><div align="left">
                <input name="Session" type="text" class="key" id="Session" size="12" />
              </div></td>
              <td >&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><div align="left">Terminal</div></td>
              <td>:</td>
              <td><div align="left">
                <input name="Terminal" type="text" class="key" id="Terminal" size="12" />
              </div></td>
              <td >&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td><input name="RadioButton" type="radio" value="Detail" id="RadioButton1" checked="checked" />
                Detail</td>
              <td >&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>Jenis Pembayaran</td>
              <td>:</td>
              <td colspan="2"><select name="bayar" id="bayar">
                <option selected="selected">------- Pilih Jenis Bayar -------</option>
                <?php
          				$bayar=array("Tunai","Visa","Master","Debit");
          				$jlh_byr=count($bayar);
          				for($c=0; $c<$jlh_byr; $c+=1){
          				  echo"<option value=$bayar[$c]> $bayar[$c] </option>";
          				}
        				?>
              </select></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td><div align="left"></div></td>
              <td >&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td><input name="RadioButton" type="radio" value="Summary" id="RadioButton2" />
                Summary </td>
              <td >&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td >&nbsp;</td>
            </tr>
            <tr>
              <td width="214">&nbsp;</td>
              <td width="114">&nbsp;</td>
              <td width="11">&nbsp;</td>
              <td width="271"><input type="submit" name="BtView" id="BtView" value="Preview" /></td>
              <td ><label for="Tgl2"></label></td>
            </tr>
          </table>

          <div style="display:none;">
            <table>
            </table>
          </div>
          <span id="tab"><?php /*?><?php include "T_Outpat_Table.php"; ?><?php */?></span>

          </form>

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
