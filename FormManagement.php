<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Form Management</title>
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

<style>
  td{
    padding-left: 3px;
    vertical-align: middle;
  }
  td.mid{
    padding-left: 0px;
    text-align: center;
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
          <p>
            <button type="button" class="btn" id="New" onclick="clearAll();">New</button>
            <button type="button" class="btn" id="OK" onclick="saveForm();">Create</button>
          </p>
          <table>
            <tr>
              <td width="120px;">Kode Form</td>
              <td width="15px;"> : </td>
              <td><input type="text" id="formid" name="formid"></td>
            </tr>
            <tr>
              <td>Nama Form</td>
              <td>:</td>
              <td><input type="text" id="formname" name="formname"></td>
            </tr>
          </table>

          --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
          <br>
          <h3>Form List</h3>
          <table>
            <tr>
              <td width="120px;">Search Form</td>
              <td width="15px;"> : </td>
              <td><input type="text" id="katakunci" name="katakunci"></td>
              <td><button type="button" class="btn" id="saringtabel">Search</button></td>
            </tr>
          </table>
          <div id="tampiltabel"></div>
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
  function clearAll()
  {
    document.getElementById("formid").value = "";
    document.getElementById("formname").value = "";
    document.getElementById("OK").innerHTML = "Create";
    document.getElementById("formid").readOnly = false;
  }

  function saveForm()
  {
    var formid, formname;
    formid = document.getElementById("formid").value;
    formname = document.getElementById("formname").value;

    if(formid != "" && formname != "")
    {
      window.location = "FormSave.php?formid=" + formid + "&formname=" + formname;
    }
    else
    {
      alert("Lengkapi semua data terlebih dahulu");
    }

    document.getElementById("OK").innerHTML = "Create";
    document.getElementById("formid").readOnly = false;
  }

  $(document).ready(function(){
    $("#saringtabel").click(function(){
      var url = 'TabelForm.php?katakunci='+$("#katakunci").val();
      url = url.replace(" ","%20");

      $("#tampiltabel").empty();
      $("#tampiltabel").html("<h2>Please Wait. . . .</h2>");
      $("#tampiltabel").load(url);
    });
  });

  $("#katakunci").keyup(function(e){       //Trigger for "enter" key event.
    if(e.keyCode == 13){
      $("#saringtabel").trigger("click");
    }
  });

</script>

<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script src="js/base.js"></script>

</body>
</html>
