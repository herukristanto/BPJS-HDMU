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
<!-- <script src="js/jquery-1.12.4.js"></script> -->
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

          	if(isset($_GET['patno']))
          	{
              $patno = $_GET['patno'];
              $caseno = $_GET['caseno'];

          		include "koneksi.php";

          		$que = "select * from M_Patient where PAT_NO = ".$patno;
          		$sql = sqlsrv_query($conn,$que);
          		$row = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC);
          	}
          ?>
          <form action="T_Kwitansi.php" method="post" id="myForm" >
          <p>
            <button type="button" class="btn" name="Proses" id="Proses" onclick="savePOS(event);">Process</button>
            <button type="button" class="btn" name="Cancel" id="Cancel" onclick="button();">Exit</button>

            <input type="hidden" name="hidUser" value="<?php echo $usrname; ?>" />
          </p>
          <table width="550" border="0">
            <tr>
              <td width="96">No. Pasien</td>
              <td width="23">:</td>
              <td width="483"><input name="Patno" type="text" id="Patno" maxlength="10" readonly="readonly" value="<?php echo $patno; ?>" /></td>
            </tr>
            <tr>
              <td>Nama</td>
              <td>:</td>
              <td><input name="Patnam" type="text" id="Patnam" size="50" maxlength="50" readonly="readonly" value="<?php if(isset($row['Name'])){echo $row['Name'];} ?>" /></td>
            </tr>
          </table>

          <?php include "KwitansiTable.php"; ?>
          <br />

          <table width="536" border="0">
            <tr>
              <td width="199">Jumlah yang akan dibayarkan</td>
              <td width="10">:</td>
              <td width="273">
                <input name="TAmt" type="text" id="TAmt" readonly="readonly" value="0"/>
                <input type="hidden" name="jmltagih" id="jmltagih" value="<?php echo $jmltagihan; ?>" />
              </td>
            </tr>
            <tr>
              <td height="24">Jenis pembayaran</td>
              <td>:</td>
              <td>
                <select name="JnsBayar" size="1" id="JnsBayar" onchange="payment();">
          				<?php
          					$quePayType = 'select * from M_PayType';
          					$quePayType_exe = sqlsrv_query($conn,$quePayType);

          					while($PayType = sqlsrv_fetch_array($quePayType_exe, SQLSRV_FETCH_ASSOC)){
          						echo "<option value='".$PayType['Pay_Id']."'>".$PayType['Payment']."</option>";
          					}
          				?>
          			</select>
          		</td>
            </tr>
            <tr>
              <td>Nomor Kartu</td>
              <td>:</td>
              <td><input name="CardNo" type="text" id="CardNo" style="width: 300px;" readonly /></td>
            </tr>
            <tr>
              <td>Jumlah tunai yang dibayarkan</td>
              <td>:</td>
              <td><input name="TBayar" type="text" id="TBayar" value="0" onkeyup="kembali(event);"/></td>
            </tr>
            <tr>
              <td>Kembali</td>
              <td>:</td>
              <td><input name="Kembali" type="text" id="Kembali" value="0"/></td>
            </tr>
          </table>
          <input type='text' name='hidPayId' id='hidPayId' style="display:none;"/>
          <input type='text' name='hidCase' id='hidCase' value="<?php echo $caseno; ?>" style="display:none;"/>
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

<script>
	$("br[type='_moz']").remove();

	function button()
	{
		window.location.href = "Outpatient.php";
	}

	function payment()
	{
		if(document.getElementById('JnsBayar').value != 'H0')
		{
			document.getElementById('TBayar').value = "0";
			document.getElementById('TBayar').disabled = true;
      document.getElementById('Kembali').value = "0";
      document.getElementById('Kembali').disabled = true;
      document.getElementById('CardNo').value = "";
      document.getElementById('CardNo').readOnly = false;
		}
		else
		{
			document.getElementById('TBayar').value = "0";
			document.getElementById('TBayar').disabled = false;
			document.getElementById('Kembali').value = "0";
			document.getElementById('Kembali').disabled = false;
      document.getElementById('CardNo').value = "";
      document.getElementById('CardNo').readOnly = true;
		}
	}
	function kembali(e)
	{
		if(e.keyCode == "13")
		{
			e.preventDefault();
			var tot = document.getElementById("TAmt").value;
			var pay = document.getElementById("TBayar").value;
			document.getElementById('Kembali').value = parseInt(pay) - parseInt(tot);
		}
	}

	function savePOS(e){
		e.preventDefault();
		if(document.getElementById("countRow").value != 0)
    {
      var payType = document.getElementById('JnsBayar').value;
      var card = document.getElementById('CardNo').value;
			var i;
			var j;
			var arr1 = [];
			var arr2 = [];
			var row;
			var flag = '';
			var flag2 = '';
			var idxArr = 0;

			var tab = document.getElementById('myTable');
			var rowCount = tab.rows.length - 1;

			for (i = 0; i < rowCount; i++) {
				j = i + 1;
				if(tab.rows[j].cells[3].innerHTML != '')
        {
					arr2 = [];
					arr2[0] = tab.rows[j].cells[0].innerHTML;
					arr2[1] = payType;

					if(tab.rows[j].cells[2].innerHTML == '')
          {
						arr2[2] = 0;
					}
          else
          {
						arr2[2] = tab.rows[j].cells[2].innerHTML;
					}

					arr2[3] = tab.rows[j].cells[3].innerHTML;
          arr2[4] = card;
					arr1[idxArr] = arr2;
					idxArr = idxArr + 1;
				}
			}

			$.post("SaveKwitansi.php", {'myData': arr1}, function(data, status){
				$('#hidPayId').val(data);
				if(status == 'success'){
          // alert(data);
					$('#myForm').trigger('submit');
				}
			});

		}
    else
    {
			alert("Save Data Gagal, Tidak ada data yang disimpan.");
			return false;
		}
	}

	function cek()
  {
		return false;
	}
</script>

<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script src="js/base.js"></script>

</body>
</html>
