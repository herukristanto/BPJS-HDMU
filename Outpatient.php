<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Outpatient</title>
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
a.point:hover{
  cursor: pointer;
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
<?php include "header_tran.php" ?>
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12 mainPage">
          <table>
            <tr>
              <td>
                <button type="button" class="btn" name="App" id="App" onclick="button('T_Appointment.php');">Appointment</button>
              </td>
              <td>
                <button type="button" class="btn" name="Case" id="Case" onclick="buttonCase('T_Case.php?case=');">Case</button>
              </td>
              <td>
                <button type="button" class="btn" name="Service" id="Service" onclick="buttonCase('T_Service.php?caseid=');">Service</button>
              </td>
              <td>
                <div class="btn-group">
                  <a class="btn " onclick="buttonCase('T_Billing.php?case=');"><i class="icon-user icon-white"></i>Billing</a>
                  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a class="point" onclick="button('T_ResetBilling.php');"><i class="icon-pencil"></i>Reset Billing</a></li>
                    <li class="divider"></li>
                    <li><a class="point" onclick="buttonCase('T_SplitInvoice.php?case=');"><i class="icon-trash"></i>Create Split Billing</a></li>
                    <li><a class="point" onclick="buttonCase('T_ResetSplit.php?case=');"><i class="icon-trash"></i>Reset Split Billing</a></li>
                    <!-- <li><a href="#"><i class="icon-ban-circle"></i> Ban</a></li>
                    <li class="divider"></li>
                    <li><a href="#"><i class="i"></i> Make admin</a></li> -->
                  </ul>
                </div>
              </td>
              <td>
                <button type="button" class="btn" name="POS" id="POS" onclick="buttonPatInv('T_POS.php');">POS</button>
              </td>
            </tr>
          </table>
          <br>
          <!-- <p style="display: inline;">
            <button type="button" class="btn" name="App" id="App" onclick="button('T_Appointment.php');">Appointment</button>
            <button type="button" class="btn" name="Case" id="Case" onclick="buttonCase('T_Case.php?case=');">Case</button>
            <button type="button" class="btn" name="Service" id="Service" onclick="buttonCase('T_Service.php?caseid=');">Service</button>
            <button type="button" class="btn" name="Billing" id="Billing" onclick="buttonCase('T_Billing.php?case=');">Billing</button>
            <button type="button" class="btn" name="SBilling" id="SBilling" onclick="buttonCase('T_SplitInvoice.php?case=');">Split Billing</button>
            <button type="button" class="btn" name="Reset" id="Reset" onclick="button('T_ResetBilling.php');">Reset Billing</button>
            <button type="button" class="btn" name="POS" id="POS" onclick="buttonPatInv('T_POS.php');">POS</button>
          </p> -->
          <table border="0" >
            <tr>
              <td width="120">Tanggal</td>
              <td width="10">:</td>
              <td width="162"><input type="text" name="Tgl" id="Tgl2" class="datepicker key" value="<?php echo date('m/d/Y'); ?>"/></td>
            </tr>
            <tr>
              <td>Ruang</td>
              <td>:</td>
              <td>
                <select name="roomID" id="roomID" class="key">
                  <option value=''></option>
              		<?php
                      include "koneksi.php";

                      $que = "SELECT * FROM M_Room where active = 'X'";
                      $sql = sqlsrv_query($conn,$que);

                  		while($hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)){
                  			echo "<option value=$hasil[Room_Id]>$hasil[Name]</option>";
                  		}
                  ?>
                </select>
              </td>
            </tr>
            <tr>
              <td>Nama Pasien</td>
              <td>:</td>
              <td><input name="Patnam" type="text" id="Patnam" class="key" /></td>
            </tr>
          </table>
          <span id="tab"><?php include "OutPatTable.php"; ?></span>

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

	function button(x)
	{
		window.location.href = x;
	}

	function buttonCase(x)
	{
		var caseno = document.querySelector('input[name="caseRow"]:checked').value;
		if(caseno == '' || caseno == null)
		{
			alert('Data yang dipilih tidak memiliki Case');
		}
		else
		{
			window.location.href = x + caseno;
		}

	}

  function buttonPat(x)
	{
    var patno = document.querySelector('input[name="caseRow"]:checked').getAttribute("data-patient");
    if(patno == '' || patno == null)
    {
      alert('Pasien belum memiliki Patient No');
    }
    else
    {
      window.location.href = x + patno;
    }
	}
  function buttonPatInv(x)
  {
    var patno = document.querySelector('input[name="caseRow"]:checked').getAttribute("data-patient");
    var caseno = document.querySelector('input[name="caseRow"]:checked').value;
    if(patno == '')
    {
      alert('Data belum lengkap, Tidak bisa dilakukan POS.');
    }
    else
    {
      window.location.href = x + "?patno=" + patno + "&caseno=" + caseno;
    }
  }

	$('.key').bind("enterKey",function(e){
    var url = 'OutPatTable.php?tang=' + $("#Tgl2").val() + "&room=" + $("#roomID").val() + "&nama=" + $("#Patnam").val();
    url = url.replace(" ","%20");

		$("#tab").empty();
    $("#tab").html("<h2>Please Wait. . . .</h2>");
		$("#tab").load(url);
	});

	$('.key').keyup(function(e){
  	if(e.keyCode == 13)
  	{
      var cekTgl = $.trim($("#Tgl2").val());
      alert(cekTgl);
      if(cekTgl != ""){
        if(isValidDate(cekTgl) == false){
          return false;
        }
      }
  	  $(this).trigger("enterKey");
  	}
	});

	$('#roomID').change(function(e){
	  $(this).trigger("enterKey");
	});

  $('.datepicker').change(function(e){
    $(this).trigger("enterKey");
  });
</script>

<!-- <script src="js/excanvas.min.js"></script>
<script src="js/chart.min.js" type="text/javascript"></script> -->
<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<!-- <script language="javascript" type="text/javascript" src="js/full-calendar/fullcalendar.min.js"></script> -->
<script src="js/base.js"></script>

</body>
</html>
