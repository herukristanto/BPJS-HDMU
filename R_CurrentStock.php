<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Current Stock Report</title>
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

td.mid{
  padding-left: 0px;
  text-align: center;
}
iframe{
  width: 750px;
  min-height: 600px;
  border: 0;
}
</style>
</head>
<body>
<?php include "header.php" ?>
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12 mainPage">
        	<br>
        	<table>
        		<tr>
        			<td width=120>Kode Material</td>
        			<td width=15>:</td>
        			<td width=100><input type="text" id="kode1" style="width: 88%;"></td>
        			<td width=40><center>s/d</center></td>
        			<td width=100><input type="text" id="kode2" style="width: 88%;"></td>
        			<td style="padding-left: 10px;"><button class="btn" onclick="searchStock();">Cari</button></td>
        		</tr>
        	</table>
        	<br>
        	<iframe id="stockTable" src="V_CurrentStock.php"></iframe>
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
	function searchStock(){
		var kode1 = document.getElementById("kode1");
		var kode2 = document.getElementById("kode2");
		var iframe = document.getElementById("stockTable");

		if(kode1.value != ""){
			if(kode2.value != ""){
				iframe.src = "V_CurrentStock.php?kode1=" + kode1.value + "&kode2="+kode2.value;
			}else{
				iframe.src = "V_CurrentStock.php?kode1=" + kode1.value;
			}
		}else{
			alert("Masukan kode material");
			kode1.focus();
		}
	}
</script>

<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script src="js/base.js"></script>

</body>
</html>
