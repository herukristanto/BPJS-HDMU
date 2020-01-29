<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Billing</title>
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
            include 'koneksi.php';
            date_default_timezone_set("Asia/Bangkok");

            if(isset($_GET['case'])){
              $caseno = $_GET['case'];
            }

            $invno = '';
            if(isset($_GET['inv'])){
              $invno = $_GET['inv'];
            }

            $que = "select * from V_Case where Case_No = '".$caseno."'";
            $sql = sqlsrv_query($conn,$que);
            $hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC);
          ?>

          <p>
            <button type="button" class="btn" name="Billing" id="Billing" onclick="Bill();" <?php if($invno <> ''){echo 'disabled="disabled"';}?>>Billing</button>
            <button type="button" class="btn" name="PrintInv" id="PrintInv" onclick="button1();">Print</button>
            <button type="button" class="btn" name="Cancel" id="Cancel" onclick="button('Outpatient.php');">Exit</button>
          </p>

          <input type="hidden" name="hidUser" id="hidUser" value="<?php echo $usrname; ?>" />

          <table border="0">
            <tr>
              <td width="119">Nomor Invoice</td>
              <td width="14">:</td>
              <td width="250">
                <input name="Invno" type="text" id="Invno" readonly="readonly" value="<?php echo $invno; ?>"/>
                <input type="button" name="SrcBill" id="SrcBill" value="..." />
              </td>
            </tr>
            <tr>
              <td>Nomor Pasien</td>
              <td>:</td>
              <td><input name="Patno" type="text" id="Patno" readonly="readonly" value="<?php echo $hasil['Pat_No']; ?>" /></td>
            </tr>
            <tr>
              <td>No.Case</td>
              <td>:</td>
              <td><input name="Caseno" type="text" id="Caseno" class="billkey" readonly="readonly" value="<?php echo $hasil['Case_No']; ?>" /></td>
            </tr>
            <tr>
              <td>Nama</td>
              <td>:</td>
              <td><input name="Nama" type="text" id="Nama" readonly="readonly" value="<?php echo $hasil['Pat_Name']; ?>" /></td>
            </tr>
            <tr>
              <td>Tanggal Lahir</td>
              <td>:</td>
              <td><input name="DOB" type="text" id="DOB" readonly="readonly" value="<?php echo $hasil['Pat_DOB']->format('d/m/Y'); ?>" /></td>
            </tr>
            <tr>
              <td>Jenis Kelamin</td>
              <td>:</td>
              <td>
                <select name="Sex" size="1" id="Sex" disabled>
                  <option <?php if($hasil['Pat_Sex'] == 'M'){echo 'selected';} ?> >Laki-Laki</option>
                  <option <?php if($hasil['Pat_Sex'] == 'F'){echo 'selected';} ?> >Perempuan</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>Pembayar</td>
              <td>:</td>
              <td><input type="text" name="Pembayar" id="Pembayar" readonly="readonly" value="<?php echo $hasil['Pembayar']; ?>"/></td>
            </tr>
          </table>

          <?php $string = " and (Billed is null or Billed = '')"; ?>
          <span id="BillTab">
            <?php include "BillTable.php"; ?>
          </span>
          <iframe id="savebill" hidden></iframe>
          <?php include "SearchBill.php"; ?>

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
  if(document.getElementById('hidAmt').value == 'false')
  {
    document.getElementById('Billing').disabled = true;
  }

	function Bill()
	{
    if(document.getElementById('hidAmt').value != 'false'){
      document.getElementById('savebill').src = "SaveBilling.php?pat="+document.getElementById('Patno').value+"&case="+document.getElementById('Caseno').value+"&pembayar="+document.getElementById('Pembayar').value+"&amount="+document.getElementById('hidAmt').value+"&usrname="+document.getElementById('hidUser').value;
    }else{
      document.getElementById('Billing').disabled = true;
    }
  }

	function button(x)
	{
		window.location.href = x;
	}

	function button1(x)
	{
		window.location.href = "PrintInvoice.php?case="+document.getElementById('Caseno').value+"&inv="+document.getElementById('Invno').value;
	}

  function getInv(InvNo)
  {
    document.getElementById('Invno').value = InvNo;
    document.getElementById('Billing').disabled = true;
  }

//	$('.billkey').bind("enterKey",function(e){
//		$("#BillTab").empty();
//		$("#BillTab").load('BillTable.php?case=' + $("#Caseno").val());
//	});
//
//  $('#Caseno').change(function(e){
//	  $(this).trigger("enterKey");
//	});
</script>

<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script src="js/base.js"></script>

</body>
</html>
