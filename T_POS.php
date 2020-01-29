<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>POS</title>
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
					<?php
						include "koneksi.php";
						$terminal = gethostbyaddr($_SERVER['REMOTE_ADDR']);
						$terminal = str_replace(".MMU.LOCAL.ID","",$terminal);
						$terminal = str_replace(".MMU","",$terminal);
						
						if($terminal == '192.168.2.60'){
							$terminal = "rumpin-laptop";
						}elseif($terminal == '192.168.2.61'){
							$terminal = "Rumpin-1";
						}elseif($terminal == '192.168.2.62'){
							$terminal = "Rumpin-2";
						}
						
						$que = "select count(*) as hasil from V_SessionOpen where User_Id = '".$usrname."' and Terminal_Id = '".$terminal."'";
						$que_exe = sqlsrv_query($conn,$que);
						$hasil = sqlsrv_fetch_array($que_exe, SQLSRV_FETCH_ASSOC);
						if($hasil["hasil"] != 1){
							echo "
								<script>
									alert('Open Collection sebelum melakukan POS');
									window.location.href = 'Outpatient.php';
								</script>
							";
						}
					?>
					
					<p>
						<button type="button" class="btn" name="Submit" id="Submit" onclick="Proses();">Process</button>
						<button type="button" class="btn" name="Cancel" id="Cancel" onclick="button();">Exit</button>
					</p>
					<p>
						<label>Nomor pasien :</label>
						<input type="text" name="Patno" id="Patno" value="<?php echo $_GET['patno']; ?>"/>
						<input type="button" name="Search" id="Search" value="..." />
					</p>
					<iframe src='' id='myFrame' hidden></iframe>

					<?php
					include "SearchPatPOS.php";
					echo "<input type='text' id='hidCase' value='".$_GET['caseno']."' style='display:none;' />";
					?>
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
		document.getElementById('myFrame').src = "ProsesPOS.php?patno="+document.getElementById('Patno').value+"&caseno="+document.getElementById('hidCase').value;
		//window.location.href = "ProsesPOS.php?patno="+document.getElementById('Patno').value;
	}

	function button()
	{
		window.location.href = "Outpatient.php";
	}

</script>

<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script src="js/base.js"></script>

</body>
</html>
