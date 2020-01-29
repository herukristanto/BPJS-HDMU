<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Price - Create</title>
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

<!-- ========== Datetime Picker ========== -->
<!-- format tanggal php di ubah menjadi m/d/y mengikuti format JqueryUI -->
  <link rel="stylesheet" href="css/jquery-ui.min.css"> 
  <script src="js/jquery-ui.min.js"></script>
  <script>
    $( function() {
      $( ".datepicker" ).datepicker();
      $( ".datepicker" ).datepicker( "option", "dateFormat", 'dd/mm/yy' );
    } );
  </script>
<!-- ===================================== -->

</head>
<body>
<?php include "header_mstr.php" ?>
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12 mainPage">
          <button type="button" class="btn" onclick="saveprice();">Save</button>
        	<button type="button" class="btn" onclick="clearprice();">Exit</button>
          <button type="button" class="btn closeMstr">Exit</button>
					<br><br>
        	<table>
        		<tr>
        			<td width="120">Kode Service</td>
        			<td width="15"> : </td>
        			<td><input type="text" id="serviceid" name="service" disabled></td>
        			<td><input type="button" id="myBtn" value="..."/></td>
        		</tr>
        		<tr>
        			<td>Deskripsi</td>
        			<td> : </td>
        			<td><input type="text" id="deskripsi" name="deskripsi" disabled></td>
        		</tr>
        		<tr>
        			<td>Harga</td>
        			<td> : </td>
        			<td><input type="text" id="harga" name="harga" maxlength="15" class="numberonly"></td>
        		</tr>
        		<tr>
        			<td>Valid From</td>
        			<td> : </td>
        			<td><input type="text" class="datepicker" id="datepicker" name="validfrom" value="<?php echo date("m/d/Y"); ?>"></td>
        		</tr>
        		<tr>
        			<td>Valid To</td>
        			<td> : </td>
        			<td><input type="text" class="datepicker" id="datepicker1" name="validto" value="31/12/9999"></td>
        		</tr>
        	</table>

        	<?php include "M_Price_SrchServiceID.php"; ?>
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
  function saveprice() {
    var serviceid;
    var harga;
    var validfrom;
    var validto;
    serviceid = document.getElementById('serviceid').value;
    harga = document.getElementById('harga').value;
    validfrom = document.getElementById('datepicker').value;
    validto = document.getElementById('datepicker1').value;
    var simpan;
    simpan = "baru";

    if(isValidDate(validfrom) == false || isValidDate(validto) == false){
      return false
    }

    if (serviceid != "" && harga != "" && validfrom != "" && validto != "") {
      window.location.href='M_Price_Save.php?serviceid=' + serviceid + '&harga=' + harga + '&validfrom=' + validfrom + '&validto=' + validto + '&simpan=' + simpan;
    } else {
      alert("Data belum lengkap..");
    }
  }
  function clearprice(){
    document.getElementById('serviceid').value = '';
    document.getElementById('deskripsi').value = '';
    document.getElementById('harga').value = '';
    document.getElementById('datepicker').value = '';
    document.getElementById('datepicker1').value = '';
  }
</script>

<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script src="js/base.js"></script>

</body>
</html>
