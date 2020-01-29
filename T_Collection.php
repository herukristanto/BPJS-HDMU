<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Blank</title>
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

						$Datecollection = date('Y/m/d');

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

						$stats1 = "";
						$stats2 = "disabled";

						//$Terminal1 = echo "<script>document.getElementById('Terminal').value</script>";
						//echo $Terminal1;

						$que = "select * from V_Collection where User_Id = '".$usrname."' and Terminal_Id = '".$terminal."' and end_date is null ORDER BY ID DESC";
						$sql = sqlsrv_query($conn,$que);
						$app = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC);
						if(isset($app)){
							$stats1 = "disabled";
							$stats2 = "";
						}

					?>

					<p>
						<button type="button" class="btn" onclick="openSes();" <?php echo $stats1; ?> >Open</button>
						<button type="button" class="btn" onclick="closeSes();" <?php echo $stats2; ?> >Close</button>
						<button type="button" class="btn" name="Search" id="Search">Search</button>
						<button type="button" class="btn" name="Cancel" id="Cancel" onclick="goto('main_tran.php');">Exit</button>
						<input type="hidden" name="user_id" id="user_id" value="<?php echo $usrname; ?>"/>
					</p>
					<table border="0">
						<tr>
							<td width="150">User ID</td>
							<td width="15">:</td>
							<td width="250"><input name="Userid" type="text" id="Userid" value="<?php if(isset($app['User_Id'])){echo $app['User_Id'];} ?> " disabled ></td>
							<td width="56">Nama</td>
							<td width="7">:</td>
							<td width="140"><input name="Nama" type="text" id="Nama" value="<?php if(isset($app['Name'])){echo $app['Name'];} ?> " disabled ></td>
						</tr>
						<tr>
							<td>Tanggal open</td>
							<td>:</td>
							<td><input name="Tglopen" type="text" id="Tglopen" value="<?php if(isset($app['Start_Date'])){echo $app['Start_Date']->format('d/m/Y');} ?>" disabled ></td>
							<td>Session</td>
							<td>:</td>
							<td><input name="Session" type="text" id="Session" value="<?php if(isset($app['Session_Id'])){echo $app['Session_Id'];} ?>" disabled /></td>
						</tr>
						<tr>
							<td>Jam open</td>
							<td>:</td>
							<td><input name="Jamopen" type="text" id="Jamopen" value="<?php if(isset($app['Start_Time'])){echo $app['Start_Time'];} ?>" disabled /></td>
							<td>Terminal</td>
							<td>:</td>
							<td><input name="Terminal" type="text" id="Terminal" value="<?php if(isset($app['Terminal_Id'])){echo $app['Terminal_Id'];} ?>" disabled /></td>
						</tr>
						<tr>
							<td>Tanggal close</td>
							<td>:</td>
							<td><input name="Tglclose" type="text" id="Tglclose" value="<?php if(isset($app['End_Date'])){echo $app['End_Date']->format('d/m/Y');} ?>" disabled /></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>Jam close</td>
							<td>:</td>
							<td><input name="Jamclose" type="text" id="Jamclose" value="<?php if(isset($app['End_Time'])){echo $app['End_Time'];} ?>" disabled /></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
					</table>
					<br>
					<table id="myTable">
						<tr>
							<td width="5%"></td>
							<td width="10%" align="center">Payment Type</td>
							<td width="20%" align="center">Amount</td>
							<td hidden></td>
						</tr>
						<tr>
							<td><button>Batal</button></td>
							<td></td>
							<td></td>
							<td hidden></td>
						</tr>
					</table>
					<br>

					<span id="collect"><?php include "SearchCollection.php"; ?></span>
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
	function openSes()
	{
		var usr = document.getElementById('user_id').value;
		window.location.href = 'SaveCollection.php?cmd=open&user='+usr;
	}

	function closeSes()
	{
		var useridclose;
		var sessionid;

		useridclose = document.getElementById('Userid').value;
		sessionid = document.getElementById('Session').value;

		window.location.href = 'SaveCollection.php?cmd=close&user='+useridclose+'&session='+sessionid;
	}

	function removeFirstRow(x) {
			var table = document.getElementById("myTable");
			var rowCount = table.rows.length;
			var rowIndex = x.parentNode.rowIndex;
			if (rowIndex==(rowCount-1)) {
				//do nothing
			} else {
				if (rowIndex == 0) {
					alert("salah");
				} else if (rowIndex == undefined) {
					if (rowCount > 2) {
						document.getElementById("myTable").deleteRow(1);
					} else {
						newrow()
						document.getElementById("myTable").deleteRow(1);
					}
				} else {
					if (rowIndex == 1) {
						if (rowCount > 2) {
							document.getElementById("myTable").deleteRow(rowIndex);
						} else {
							newrow()
							document.getElementById("myTable").deleteRow(rowIndex);
						}
					} else {
						document.getElementById("myTable").deleteRow(rowIndex);
					}
				}
			}
		}

	function newrow() {
		var table = document.getElementById("myTable");
		var row = table.insertRow();
		var cell0 = row.insertCell(0);
		var cell1 = row.insertCell(1);
		var cell2 = row.insertCell(2);

		cell0.innerHTML = "<button>Batal</button>";
		cell0.setAttribute('onclick', 'removeFirstRow(this)');

		cell1.innerHTML = "";
		cell1.setAttribute('class','numberonly');
		cell1.setAttribute('contentEditable', 'true');

		cell2.innerHTML = "";
		cell2.setAttribute('class','numberonly');
		cell2.setAttribute('contentEditable', 'true');
		cell2.setAttribute('onkeypress', 'handle1(this, event)');

		$("br[type='_moz']").remove();
		$("br").remove();
	}

</script>

<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script src="js/base.js"></script>

</body>
</html>
