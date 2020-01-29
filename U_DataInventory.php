<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Upload Data Inventory</title>
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
	<script src="js/xls.js"></script>
	<style>
	td{
		padding-left: 3px;
	}
	td.mid{
		padding-left: 0px;
		text-align: center;
	}
	.holds-the-iframe {
		background:url(..\RSBPJS\img\lg.dual-gear-loading-icon.gif) center center no-repeat;
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
						<input type="file" id="my_file_input" />

						<iframe here id="myiframe" src="" hidden class="holds-the-iframe"></iframe>
					</br></br>
						<p>
							* File harus dalam format .xls (exel 2003).</br>
							* Data tidak boleh ada header.</br>
							* Hapus semua sheet yang kosong.</br>
							* Tanda petik satu ( ' ) harus di replace dengan 2x petik satu ( '' ).
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include "footer.html"; ?>

	<!-- Le javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->

	<script>
		var oFileIn;
		$(function() {
			oFileIn = document.getElementById('my_file_input');
			if(oFileIn.addEventListener) {
				oFileIn.addEventListener('change', filePicked, false);
			}
		});

		function filePicked(oEvent) {
			var oFile = oEvent.target.files[0];
			var sFilename = oFile.name;
			var reader = new FileReader();
			reader.onload = function(e) {
				var data = e.target.result;
				var cfb = XLS.CFB.read(data, {type: 'binary'});
				var wb = XLS.parse_xlscfb(cfb);
				var hitungbaris=-1;
				wb.SheetNames.forEach(function(sheetName) {
					var sCSV = XLS.utils.make_csv(wb.Sheets[sheetName]);
					var data = XLS.utils.sheet_to_json(wb.Sheets[sheetName], {header:1});
					var hitung = data.length;
					if (hitung > 0){
						var j = 0;
						var arr1 = [];
						$.each(data, function( indexR, valueR ) {
							var sRow = "<tr>";
							var serviceid;
							var deskripsi;
							var quantity;
							var BUn;
							$.each(data[indexR], function( indexC, valueC ) {
								sRow = sRow + "<td>" + valueC + "</td>";
								if (indexC == 0) {
									serviceid = valueC;
								} else if (indexC == 1) {
									deskripsi = valueC;
								} else if (indexC == 2) {
									quantity = valueC;
								} else if (indexC == 3) {
									BUn = valueC;
								}
							});
							arr2 = [];
							arr2[0] =  serviceid;
							arr2[1] =  deskripsi;
							arr2[2] =  quantity;
							arr2[3] =  BUn;

							arr1[j] = arr2;

							j = j + 1;
							sRow = sRow + "</tr>";
						});
						$.post("saveuploaddatainventory.php", {'myData': arr1}, function(data, status){
							alert("Data Berhasil Disimpan" + data);
							window.location.href='U_DataInventory.php';
						});
					}
				});
			};
			reader.readAsBinaryString(oFile);
		}
	</script>

	<script src="js/bootstrap.js"></script>
	<script src="js/Script.js"></script>
	<script src="js/base.js"></script>

</body>
</html>
