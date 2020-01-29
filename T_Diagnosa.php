<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Diagnose</title>
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
iframe{
	border:0;
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
        <form action="SaveDiagnosa.php" method="post" target="DiagTab">
        <p>
          <input type="submit" name="Submit" id="Submit" value="Submit" class="btn" />
          <input type="button" name="Cancel" id="Cancel" value="Exit" onclick="button();" class="btn"/>
        </p>
        <?php
			include "koneksi.php";
	
			$caseno = $_POST['Caseno'];
			$patno = $_POST['Patno'];
		?>
        <input type="hidden" name="hidPatno" id="hidPatno" value="<?php echo $patno ?>" />
		<input type="hidden" name="hidCase" id='hidCase' value="<?php echo $caseno ?>" />
        
        <table width="462" border="0">
          <tr>
            <td width="105">Group</td>
            <td width="14">:</td>
            <td width="323"><label for="Group"></label>
            <input name="Group" type="text" id="Group" readonly="readonly" />
            <input type="button" name="SrcDiag" id="SrcDiag" value="..." /></td>
          </tr>
          <tr>
            <td>Kode Diagnosa</td>
            <td>:</td>
            <td><label for="KodeDiag"></label>
            <input name="KodeDiag" type="text" id="KodeDiag" readonly="readonly" /></td>
          </tr>
          <tr>
            <td>Deskripsi</td>
            <td>:</td>
            <td><label for="DescDiag"></label>
            <input name="DescDiag" type="text" id="DescDiag" size="50" style="width:100%;" readonly="readonly" /></td>
          </tr>
        </table>
        </form>
        <iframe name="DiagTab" src="DiagTable.php?case=<?php echo $caseno ?>" border="0" height="500px" width="845px"></iframe>
        <?php include "SearchDiagnosa.php"; ?>
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
	function clear()
	{
		document.getElementById("Group").value = "";
		document.getElementById("KodeDiag").value = "";
		document.getElementById("DescDiag").value = "";
	}
	
	function button()
	{
		window.location.href = "T_Case.php?case="+document.getElementById('hidCase').value;
	}
</script>

<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script src="js/base.js"></script>

</body>
</html>
