<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Input Service</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
<!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet"> -->
<link href="css/fontGoogle.css" rel="stylesheet">
<link href="css/css/font-awesome.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/pages/dashboard.css" rel="stylesheet">
<script src="js/jquery-1.12.4.js"></script>
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
<body onload="newrow(), hitungtotal(), cekBilled()" id="mybody">
<?php include "header_tran.php" ?>
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12 mainPage">
          <button onclick="saveinputservice();">Save</button>
        	<button onclick="goto('outpatient.php')">Close</button> <br><br>

          <input type="hidden" name="hidUser" id="hidUser" value="<?php echo $usrname; ?>" />

        	<?php
          	include "koneksi.php";
          	$caseid = $_GET['caseid'];

          	$query = "SELECT C.Pat_No, C.Case_No, P.Name, P.DOB, P.Sex, C.Pembayar FROM M_Patient P, T_Case C WHERE C.Pat_No = P.Pat_No AND C.Case_No like '%".$caseid."%'";
          	$sql = sqlsrv_query($conn, $query);

          	$rs = sqlsrv_fetch_array($sql);
          	$nopasien = $rs['Pat_No'];
          	$caseid = $caseid;
          	$name = $rs['Name'];
          	$dob = $rs['DOB']->format('d-m-Y');
          	$sex = $rs['Sex'];
          	$pembayar = $rs['Pembayar'];
        	?>

        	<table>
        		<tr>
        			<td>No. Pasien</td>
        			<td> : </td>
        			<td><input type="text" id="nopasien" name="nopasien" disabled value="<?php echo $nopasien;?>"></td>
        		</tr>
        		<tr>
        			<td>No. Case</td>
        			<td> : </td>
        			<td><input type="text" id="nocase" name="nocase" disabled value="<?php echo $caseid;?>"></td>
        		</tr>
        		<tr>
        			<td>Nama</td>
        			<td> : </td>
        			<td><input type="text" id="nama" name="nama" disabled value="<?php echo $name;?>"></td>
        		</tr>
        		<tr>
        			<td>Tanggal Lahir</td>
        			<td> : </td>
        			<td><input type="text" id="tgllahir" name="tgllahir" disabled value="<?php echo $dob;?>"></td>
        		</tr>
        		<tr>
        			<td>Jenis Kelamin</td>
        			<td> : </td>

        			<td><input type="radio" name="jk" id="laki" <?php if ($sex=='M'): ?>
        				checked="true"
        			<?php endif ?>> Laki-Laki</td>

        			<td><input type="radio" name="jk" id="perempuan" <?php if ($sex=='F'): ?>
        				checked="true"
        			<?php endif ?>> Perempuan</td>
        		</tr>
        		<tr>
        			<td>Pembayar</td>
        			<td> : </td>
        			<td><input type="text" id="pembayar" name="pembayar" disabled value="<?php echo $pembayar;?>"></td>
        		</tr>
        	</table>
        	<br>
        	<?php
        	$query = "SELECT T.Service_Id, M.Descp, T.Qty, T.Service_Price, T.Doctor_Id, T.Note, T.Billed, T.Flag, M.Unit, M.Stock as 'Potong' FROM T_Service T, M_Service M WHERE T.Service_Id=M.Service_Id AND T.Case_No like '%".$caseid."%' ORDER BY T.Billed desc";
        	$params = array();
        	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
        	$sql = sqlsrv_query( $conn, $query , $params, $options );
        	$row_count = sqlsrv_num_rows($sql);
        	if ($row_count == 0) {
        		if ($sql){
        			echo "
        			<table id=\"myTable\">
        			<tr>
        			<td width=\"5%\"></td>
        			<td width=\"10%\"><b>Kode Service</b></td>
        			<td width=\"20%\"><b>Deskripsi</b></td>
        			<td width=\"5%\"><b>Jumlah</b></td>
        			<td width=\"10%\"><b>Kode Dokter</b></td>
        			<td width=\"15%\"><b>Biaya Service</b></td>
        			<td width=\"20%\"><b>Keterangan</b></td>
        			<td width=\"15%\" hidden>Billed</td>
        			<td width=\"15%\" hidden>FLAG</td>
        			<td width=\"15%\" hidden>Unit</td>
        			<td width=\"15%\" hidden>Potong</td>
        			</tr>
        			";
        		}
        		echo"</table>";
        	} else {
        		if ($sql){
        			echo "
              <table id=\"myTable\">
        			<tr>
        			<td width=\"5%\"></td>
        			<td width=\"10%\"><b>Kode Service</b></td>
        			<td width=\"20%\"><b>Deskripsi</b></td>
        			<td width=\"5%\"><b>Jumlah</b></td>
        			<td width=\"10%\"><b>Kode Dokter</b></td>
        			<td width=\"15%\"><b>Biaya Service</b></td>
        			<td width=\"20%\"><b>Keterangan</b></td>
        			<td width=\"15%\" hidden>Billed</td>
        			<td width=\"15%\" hidden>FLAG</td>
        			<td width=\"15%\" hidden>Unit</td>
        			<td width=\"15%\" hidden>Potong</td>
        			</tr>";
        			while($rs = sqlsrv_fetch_array($sql)){
        				echo "
        				<tr>
        				<td onclick=\"removerow(this)\" align=\"center\"><button style='min-width:10px;'>Batal</button></td>
        				<td>".$rs['Service_Id']."</td>
        				<td>".$rs['Descp']."</td>
        				<td align=\"right\">".$rs['Qty']."</td>
        				<td>".$rs['Doctor_Id']."</td>
        				<td align=\"right\">".$rs['Service_Price']."</td>
        				<td>".$rs['Note']."</td>
        				<td hidden>".$rs['Billed']."</td>
        				<td hidden>".$rs['Flag']."</td>
        				<td hidden>".$rs['Unit']."</td>
        				<td hidden>".$rs['Potong']."</td>
        				</tr>
        				";
        			}
        		}
        		echo"</table>";
        	}
        	?>
        	<table id="TabelTotal">
        		<tr>
        			<td align="right" width="55%">Total Biaya</td>
        			<td align="right" width="15%">0</td>
        			<td width="20%"></td>
        			<td width="15%" hidden></td>
        			<td width="15%" hidden></td>
        			<td width="15%" hidden></td>
        		</tr>
        	</table>
        	<br><br>
        	<iframe id="myiframe" src="" hidden></iframe>
        	<iframe id="myiframe2" src="" hidden></iframe>
        	<br><br>
        	<input type="text" name="getStock1" id="getStock1" style="display:none;"/> &nbsp;
        	<input type="text" name="getPrice1" id="getPrice1" style="display:none;"/> &nbsp;
        	<input type="text" name="getIndex" id="getIndex" style="display:none;"/>
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

		var selesai = "belum";

		function hitungtotal() {
			var table = document.getElementById("myTable");
			var rowCount = table.rows.length;
			var i;
			var hasilsvc = 0;
			for (i = 1; i < rowCount; i++) {
				var tambah = Number(table.rows[i].cells[5].innerHTML);
				hasilsvc = Number(hasilsvc + tambah);
			}

			var total = document.getElementById("TabelTotal");
			total.rows[0].cells[1].innerHTML = hasilsvc;
		}

		function newrow() {
			var table = document.getElementById("myTable");
			var row = table.insertRow();
			var cell0 = row.insertCell(0);
			var cell1 = row.insertCell(1);
			var cell2 = row.insertCell(2);
			var cell3 = row.insertCell(3);
			var cell4 = row.insertCell(4);
			var cell5 = row.insertCell(5);
			var cell6 = row.insertCell(6);
			var cell7 = row.insertCell(7);
			var cell8 = row.insertCell(8);
			var cell9 = row.insertCell(9);
			var cell10 = row.insertCell(10);

			cell0.innerHTML = "<button style='min-width:10px;'>Batal</button>";
			cell0.setAttribute('onclick', 'removerow(this)');
			cell0.setAttribute('align','center');

			cell1.innerHTML = "";
			cell1.setAttribute('contentEditable', 'true');
			cell1.setAttribute('onkeypress', 'handle1(this, event)');

			cell2.innerHTML = "";

			cell3.innerHTML = "";
			cell3.setAttribute('onkeypress', 'handle31(this, event)');
			cell3.setAttribute('onfocus', 'handle32(this)');
			cell3.setAttribute('onblur', 'handle33(this)');
			cell3.setAttribute('align', 'right');

			cell4.innerHTML = "";
			cell4.setAttribute('onkeypress', 'handle41(this, event)');
			cell4.setAttribute('onfocus', 'handle42(this)');
			cell4.setAttribute('onblur', 'handle43(this)');

			cell5.innerHTML = "";
			cell5.setAttribute('align', 'right');
			cell5.setAttribute('onkeypress', 'handle5(this, event)');

			cell6.innerHTML = "";
			cell6.setAttribute('onkeypress', 'handle61(this, event)');
			cell6.setAttribute('onfocus', 'handle62(this)');

			cell7.innerHTML = "";
			cell7.setAttribute('hidden', 'true');

			cell8.innerHTML = "";
			cell8.setAttribute('hidden', 'true');

			cell9.innerHTML = "";
			cell9.setAttribute('hidden', 'true');

			cell10.innerHTML = "";
			cell10.setAttribute('hidden', 'true');

			$("br[type='_moz']").remove();
		}

		function removerow(x) {
			var table = document.getElementById("myTable");
			var rowCount = table.rows.length;
			var rowIndex = x.parentNode.rowIndex;
			if (rowIndex==(rowCount-1)) {

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
			hitungtotal();
		}

		function cekBilled() {
			var table = document.getElementById("myTable");
			var rowCount = table.rows.length;
			var i;
			for (i = 1; i < rowCount; i++) {
				var cekbill = table.rows[i].cells[7].innerHTML;
				var cekflag = table.rows[i].cells[8].innerHTML;
				var cell0 = table.rows[i].cells[0];
				if (cekbill==""){
					if (cekflag=="X") {
						cell0.setAttribute('disabled','true');
						cell0.setAttribute('align','center');
						cell0.innerHTML = "<button style='min-width:10px;' disabled>Batal</button>";
					}
				} else {
					cell0.setAttribute('disabled','true');
					cell0.setAttribute('align','center');
					cell0.innerHTML = "Billed";
				}
			}
		}

		function handle1(x, e) {
			if (e.keyCode == 13) {
				e.preventDefault();
				var table = document.getElementById("myTable");
				var rowIndex = x.parentNode.rowIndex;
				document.getElementById("getIndex").value = rowIndex;
				table.rows[rowIndex].cells[1].removeAttribute('contenteditable');
				table.rows[rowIndex].cells[3].setAttribute('contenteditable','true');
				table.rows[rowIndex].cells[4].setAttribute('contenteditable','true');
				table.rows[rowIndex].cells[6].setAttribute('contenteditable','true');
				table.rows[rowIndex].cells[3].focus();
			}
		}

		function handle31(x, e) {
			if (e.keyCode == 13){
				e.preventDefault();

				var table = document.getElementById("myTable");
				var rowIndex = x.parentNode.rowIndex;
				var rowCount = table.rows.length;
				var lastrow = rowCount - 1;

				table.rows[lastrow].cells[1].focus();
			}
		}

		function handle32(x) {
			var table = document.getElementById("myTable");
			var rowIndex = x.parentNode.rowIndex;
			var kodeservice = table.rows[rowIndex].cells[1].innerHTML;
			var kirim = "adddetailservice.php?kodeservice=" + kodeservice;
			myiframe.src = kirim;
		}

		function ambildataservice(string, string2, string3, string4, string5) {
			if (string.length > 30) {
				var table = document.getElementById("myTable");
				var rowIndex= document.getElementById("getIndex").value;
				table.rows[rowIndex].cells[1].innerHTML = "";
				table.rows[rowIndex].cells[2].innerHTML = "";
				table.rows[rowIndex].cells[1].setAttribute('contenteditable','true');
				table.rows[rowIndex].cells[3].removeAttribute('contenteditable');
				table.rows[rowIndex].cells[1].focus();
				alert("Kode Service tidak ditemukan");
			} else {
				var descp=string;
				var price=string2;
				var stock=string3;
				var unit=string4;
				var potong=string5;

				var rowIndex= document.getElementById("getIndex").value;
				document.getElementById("getPrice1").value = price;
				document.getElementById("getStock1").value = stock;
				var table = document.getElementById("myTable");
				var rowCount = table.rows.length;
				var lastrow = rowCount - 1;
				if (table.rows[rowIndex].cells[1].innerHTML == "") {

				} else {
					if (table.rows[rowIndex].cells[2].innerHTML == "") {
						table.rows[rowIndex].cells[2].innerHTML = descp;
						table.rows[rowIndex].cells[9].innerHTML = unit;
						table.rows[rowIndex].cells[10].innerHTML = potong;
					}
				}

				if (table.rows[lastrow].cells[1].innerHTML=="") {

				} else {
					newrow();
				}
			}
		}

		function handle33(x) {
			var table = document.getElementById("myTable");
			var rowIndex = x.parentNode.rowIndex;
			var rowCount = table.rows.length;
			var r = rowCount - 1;

			var hargaservice = Number(document.getElementById("getPrice1").value);
			var stoksekarang = Number(document.getElementById("getStock1").value);
			var hitungstok = Number(table.rows[rowIndex].cells[3].innerHTML);
			var cekPotong = table.rows[rowIndex].cells[10].innerHTML;

			var hitungpotongstock = 0;
			var kodeservice = table.rows[rowIndex].cells[1].innerHTML;
			var i;
			for (i = 1; i < rowCount; i++) {
				var cekFlagservice = table.rows[i].cells[8].innerHTML;
				var cekkodeservice = table.rows[i].cells[1].innerHTML;
				var cekqty = Number(table.rows[i].cells[3].innerHTML);
				if (cekFlagservice=="") {
					if (cekPotong=="X") {
						if (kodeservice == cekkodeservice) {
							hitungpotongstock = hitungpotongstock + cekqty;
						}
					}
				}
			}

			if (cekPotong=="X") {
				if (stoksekarang<hitungpotongstock) {
					alert("Stok saat ini = " + stoksekarang + ". Harap hubungi bagian MMD.");
					document.getElementById("myTable").deleteRow(rowIndex);
				} else {
					table.rows[rowIndex].cells[5].innerHTML= Number(table.rows[rowIndex].cells[3].innerHTML)*hargaservice;
					hitungtotal();
				}
			} else {
				table.rows[rowIndex].cells[5].innerHTML= Number(table.rows[rowIndex].cells[3].innerHTML)*hargaservice;
				hitungtotal();
			}
		}

		function handle41(x, e) {
			if (e.keyCode == 13) {
				e.preventDefault();
				var table = document.getElementById("myTable");
				var rowIndex = x.parentNode.rowIndex;
				var rowCount = table.rows.length;
				var r = rowCount - 1;
				table.rows[r].cells[1].focus();
			}
		}

		function handle42(x) {
			var table = document.getElementById("myTable");
			var rowIndex = x.parentNode.rowIndex;

			if (table.rows[rowIndex].cells[3].innerHTML=="") {
				alert("Isi jumlah service terlebih dahulu");
				table.rows[rowIndex].cells[3].focus();
			}
		}

		function handle43(x) {
			var table = document.getElementById("myTable");
			var rowIndex = x.parentNode.rowIndex;

			var kodedokter = table.rows[rowIndex].cells[4].innerHTML;
			if (kodedokter!="") {
				var kirim = "cekkodedokter.php?kodedokter=" + kodedokter;
				myiframe2.src = kirim;
			}
		}

		function cekkodedokter(string){
			var table = document.getElementById("myTable");
			var rowIndex= document.getElementById("getIndex").value;
			if (string.length > 30) {
				table.rows[rowIndex].cells[4].innerHTML = "";
				table.rows[rowIndex].cells[4].focus();
				alert("Kode Dokter tidak ditemukan");
			}
		}

		function handle61(x, e) {
			if (e.keyCode == 13){
				e.preventDefault();
				var table = document.getElementById("myTable");
				var lastRow = table.rows.length - 1;
				table.rows[lastRow].cells[1].focus();
			}
		}

		function handle62(x) {
			var table = document.getElementById("myTable");
			var rowIndex = x.parentNode.rowIndex;
			if (table.rows[rowIndex].cells[3].innerHTML=="") {
				alert("Isi jumlah service terlebih dahulu");
				table.rows[rowIndex].cells[3].focus();
			}
		}

		function saveinputservice(){
			var nopasien = document.getElementById("nopasien").value;
			var nocase = document.getElementById("nocase").value;
      var usr = document.getElementById("hidUser").value;
			var serviceid;
			var qty;
			var doctorid;
			var keterangan;
			var flag;
			var unit;
			var potong;

			var table = document.getElementById("myTable");
			var rowCount = table.rows.length;
			var r = rowCount - 1;
			var j;
			var arr1 = [];
			var arr2 = [];


			for (i = 1; i < r; i++) {
				// alert(i);

				j = i - 1;
				arr2 = [];

				serviceid = table.rows[i].cells[1].innerHTML;
				qty = table.rows[i].cells[3].innerHTML;
				if (qty==""){
					qty=1;
				}
				serviceprice = table.rows[i].cells[5].innerHTML;
				if (serviceprice==""){
					serviceprice=0;
				}
				doctorid = table.rows[i].cells[4].innerHTML;
				if (doctorid=="" || doctorid=="<br>"){
					doctorid="null";
				}
				keterangan = table.rows[i].cells[6].innerHTML;
				flag = table.rows[i].cells[8].innerHTML;
				unit = table.rows[i].cells[9].innerHTML;
				potong = table.rows[i].cells[10].innerHTML;

				arr2[0] =  nopasien;
				arr2[1] =  nocase;
				arr2[2] =  serviceid;
				arr2[3] =  qty;
				arr2[4] =  serviceprice;
				arr2[5] =  doctorid;
				arr2[6] =  keterangan;
				arr2[7] =  unit;
				arr2[8] =  potong;
				arr2[9] =  flag;

				arr1[j] = arr2;
			}

			$.post("saveinputservice.php", {'myData': arr1,'hidUser':usr}, function(data, status){
				alert("Data Berhasil Disimpan" + data);
				window.location.href='T_InputService.php?caseid=' + nocase;
			});
		}
	</script>

<script src="js/excanvas.min.js"></script>
<script src="js/chart.min.js" type="text/javascript"></script>
<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script language="javascript" type="text/javascript" src="js/full-calendar/fullcalendar.min.js"></script>
<script src="js/base.js"></script>

</body>
</html>
