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
<body onload = "newrow();">
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

						//$Terminal1 = echo "<script>document.getElementById('Terminal').value;</script>";
						//echo $Terminal1;

						$que = "select * from V_Collection where User_Id = '".$usrname."'and Terminal_Id = '".$terminal."' and End_Date = '".$Datecollection."' and Session_Id ='".$_GET['session']."' ORDER BY ID DESC";
						$sql = sqlsrv_query($conn,$que);
						$app = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC);
					?>
					<p>
					<button type="button" class="btn" name="save" id="save" onclick="savePayment();">Save</button>
					<button type="button" class="btn" name="Search" id="Search">Search</button>
					<button type="button" class="btn" name="Cancel" id="Cancel" onclick="goto('main_tran.php');">Exit</button>
					</p>
					<input type="hidden" id="hidID" value="<?php echo $app["ID"]; ?>" />
					<table width="600" border="0">
						<tr>
							<td width="89">User ID</td>
							<td width="9">:</td>
							<td width="144"><label for="Userid"></label>
							<input name="Userid" type="text" id="Userid" value="<?php if(isset($app['User_Id'])){echo $app['User_Id'];} ?> " disabled ></td>
							<td width="56">Nama</td>
							<td width="7">:</td>
							<td width="140"><label for="Nama"></label>
							<input name="Nama" type="text" id="Nama" value="<?php if(isset($app['Name'])){echo $app['Name'];} ?> " disabled ></td>
						</tr>
						<tr>
							<td>Tanggal open</td>
							<td>:</td>
							<td><label for="Tglopen"></label>
							<input name="Tglopen" type="text" id="Tglopen" value="<?php if(isset($app['Start_Date'])){echo $app['Start_Date']->format('d/m/Y');} ?>" disabled ></td>
							<td>Session</td>
							<td>:</td>
							<td><label for="Session"></label>
							<input name="Session" type="text" id="Session" value="<?php if(isset($app['Session_Id'])){echo $app['Session_Id'];} ?>" disabled /></td>
						</tr>
						<tr>
							<td>Jam open</td>
							<td>:</td>
							<td><label for="Jamopen"></label>
							<input name="Jamopen" type="text" id="Jamopen" value="<?php if(isset($app['Start_Time'])){echo $app['Start_Time'];} ?>" disabled /></td>
							<td>Terminal</td>
							<td>:</td>
							<td><label for="Terminal"></label>
							<input name="Terminal" type="text" id="Terminal" value="<?php if(isset($app['Terminal_Id'])){echo $app['Terminal_Id'];} ?>" disabled /></td>
						</tr>
						<tr>
							<td>Tanggal close</td>
							<td>:</td>
							<td><label for="Tglclose"></label>
							<input name="Tglclose" type="text" id="Tglclose" value="<?php if(isset($app['End_Date'])){echo $app['End_Date']->format('d/m/Y');} ?>" disabled /></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>Jam close</td>
							<td>:</td>
							<td><label for="Jamclose"></label>
							<input name="Jamclose" type="text" id="Jamclose" value="<?php if(isset($app['End_Time'])){echo $app['End_Time'];} ?>" disabled /></td>
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
										<td width="15%" hidden></td>
						</tr>
					</table>
					<br>

					<?php include "SearchCollection.php"; ?>
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
	function Payment(x) //save payment type when select onchange
	{
		var paytype = x.options[x.selectedIndex].value;
		var row = x.parentNode.parentNode.rowIndex;
		document.getElementById("myTable").rows[row].cells[3].innerHTML = paytype;
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
			var cell3 = row.insertCell(3);

			cell0.innerHTML = "<button>Batal</button>";
			cell0.setAttribute('onclick', 'removeFirstRow(this)');

			cell1.innerHTML = "<?php include "getPayTipe.php"; ?>";
			//cell1.setAttribute('onclick', 'Payment(this)');

			cell2.innerHTML = "";
			cell2.setAttribute('class','numberonly');
			cell2.setAttribute('contentEditable', 'true');
			cell2.setAttribute('onkeypress', 'cekAmount(this, event)');

			cell3.innerHTML = "H0";
			cell3.setAttribute('hidden', 'true');

			$("br[type='_moz']").remove();
	}

	function cekAmount(x, e) {
		if (e.keyCode == 13){
			e.preventDefault();
			if(x.innerHTML != ""){
				newrow();
			}
			else{
				alert("Jumlah Pembayaran Tidak Boleh Kosong");
			}
		}
	}

	function savePayment(){
		var i;
		var amt;
		var arr1 = [];
		var arr2 = [];
		var tabs = document.getElementById("myTable");
		var count = tabs.rows.length - 1;
		for(i = 0;i < count;i++){
			j = i + 1;
			amt = tabs.rows[j].cells[2].innerHTML;
			if(amt != "" && amt != "0" && amt != "<br>"){
				arr2 = [];
				arr2[0] = tabs.rows[j].cells[3].innerHTML;
				arr2[1] = tabs.rows[j].cells[2].innerHTML;
				arr1[i] = arr2;
			}
		}
		var colID = document.getElementById("hidID").value;
		$.post("SavePayment.php", {'myData': arr1,'colID': colID}, function(data, status){
			alert(data);
			$(location).attr('href', 'main.php');
		});
	}

</script>

<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script src="js/base.js"></script>

</body>
</html>
