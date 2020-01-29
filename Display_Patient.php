<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Patient - Display</title>
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
	<div id="header_mstr"></div>
	<div class="main">
		<div class="main-inner">
			<div class="container">
				<div class="row">
					<div class="span12 mainPage">
						<button id="myBtn">Search</button>
						<button>Exit</button>
						<br><br>
						<table>
							<tr>
								<td>Nomor Pasien</td>
								<td> : </td>
								<td><input type="text" id="nopasien" name="nopasien" disabled></td>
							</tr>
							<tr>
								<td>Nama</td>
								<td> : </td>
								<td><input type="text" id="nama" name="nama" maxlength="50" disabled></td>
							</tr>
							<tr>
								<td>Tanggal Lahir</td>
								<td> : </td>
								<td><input type="text" id="tgllahir" name="tgllahir" disabled></td>
							</tr>
							<tr>
								<td>Jenis Kelamin</td>
								<td> : </td>
								<td><input type="radio" name="jeniskel" id="lakilaki" checked disabled>Laki-Laki</td>
								<td><input type="radio" name="jeniskel" id="perempuan" disabled>Perempuan</td>
							</tr>
							<tr>
								<td>No. Telp</td>
								<td> : </td>
								<td><input type="text" id="telp" name="telp" maxlength="30" disabled></td>
							</tr>
						</table>

						<?php include "Patient_Search.php"; ?>

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
	<div class="extra">
		<div class="extra-inner">
			<div class="container">
				<div class="row">
					<p>
						Ini Extra.
					</p>
				</div>
			</div>
			<!-- /container -->
		</div>
		<!-- /extra-inner -->
	</div>
	<!-- /extra -->
	<div class="footer">
		<div class="footer-inner">
			<div class="container">
				<div class="row">
					<div class="span12"> &copy; 2013 <a href="#">Bootstrap Responsive Admin Template</a>. </div>
					<!-- /span12 -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /footer-inner -->
	</div>
	<!-- /footer -->
<!-- Le javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	

	<script src="js/excanvas.min.js"></script>
	<script src="js/chart.min.js" type="text/javascript"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/Script.js"></script>
	<script language="javascript" type="text/javascript" src="js/full-calendar/fullcalendar.min.js"></script>

	<script src="js/base.js"></script>

</body>
</html>