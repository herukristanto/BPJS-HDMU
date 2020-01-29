<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Cancel Receipt</title>
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
						<button type="button" class="btn" name="Proses" id="Proses" onclick="Proses();">Process</button>
						<button type="button" class="btn" name="Cancel" id="Cancel">Exit</button>
					</p>

					<input type="hidden" name="hidUser" id="hidUser" value="<?php echo $usrname ?>" />

					<p>Nomor kwitansi yang ingin di cancel :
						<input type="text" name="noKW" id="noKW" />
					</p>
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
	function Proses()
	{
		var noKW = document.getElementById('noKW').value;
		var r = confirm("Refund kwitansi "+noKW+" ?");
		if (r == true) {
			var usrname = document.getElementById('hidUser').value;
			window.location.href = "ProsesCancelKW.php?no="+noKW+"&usrname="+usrname;
		}
	}
</script>

<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script src="js/base.js"></script>

</body>
</html>
