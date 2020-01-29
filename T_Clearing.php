<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Clearing Insurance</title>
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
            <button type="button" class="btn" name="Proses" id="Proses" onclick="saveClearing();">Process</button>
            <button type="button" class="btn" name="Cancel" id="Cancel" onclick="goto('main_tran.php');">Exit</button>
          </p>

          <input type="hidden" name="hidUser" id="hidUser" value="<?php echo $usrname ?>" />

          <table border="0">
            <tr>
              <td width="57">Asuransi</td>
              <td width="8">:</td>
              <td width="270">
                <input name="Asuransi" type="text" class="inskey" id="Asuransi" readonly="readonly"/>
                <input type="button" name="SrcIns" id="SrcIns" value="..." />
              </td>
            </tr>
            <tr>
              <td>Nama</td>
              <td>:</td>
              <td><input name="NamaIns" type="text" id="NamaIns" readonly="readonly" /></td>
            </tr>
          </table>
          <span id="ClearTab"><?php include "ClearingTable.php"; ?></span>
          <?php include "SearchInsurance.php"; ?>
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
	$('.inskey').bind("enterKey",function(e){
    $("#ClearTab").empty();
    $("#ClearTab").html("<h2>Please Wait. . . .</h2>");
    $("#ClearTab").load('ClearingTable.php?no=' + $("#Asuransi").val());
	});

  $('#Asuransi').change(function(e){
	  $(this).trigger("enterKey");
	});

	function saveClearing(){
		$("br[type='_moz']").remove();
		var i;
		var j;
		var arr1 = [];
		var idxArr = 0;
    var usr = document.getElementById('hidUser').value;

		var tab = document.getElementsByName('tabInv')[0];
		var rowCount = tab.rows.length - 1;

		for (i = 0; i < rowCount; i++) {
			j = i + 1;
			if(tab.rows[j].cells[2].innerHTML != ''){
				arr2 = [];
				arr2[0] = document.getElementById('Asuransi').value;
				arr2[1] = tab.rows[j].cells[0].innerHTML;
				arr2[2] = tab.rows[j].cells[2].children[0].value;
				arr1[idxArr] = arr2;
				idxArr = idxArr + 1;
			}
		}

		$.post("SaveClearing.php", {'myData': arr1,'hidUser':usr}, function(data, status){
			alert(status);
      $("#ClearTab").html("<h2>Please Wait. . . .</h2>");
      $("#ClearTab").load('ClearingTable.php?no=' + $("#Asuransi").val());
		});
	}
</script>

<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script src="js/base.js"></script>

</body>
</html>
