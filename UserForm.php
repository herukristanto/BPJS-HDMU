<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>User Form</title>
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
            <button type="button" class='btn' id="OK" onclick="saveUser();">Save</button>
            <button type="button" class='btn' id="New" onclick="clearAll();">Reset</button>
          </p>
          <table>
            <tr>
              <td>User ID</td>
              <td> : </td>
              <td><input type="text" id="userid" name="userid"></td>
            </tr>
            <tr>
              <td>Username</td>
              <td> : </td>
              <td><input type="text" id="username" name="username"></td>
            </tr>
          </table>
          --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
          <br>
          <h3>User List</h3>
          <table style="margin-top:10px;">
            <tr>
              <td>Search User ID</td>
              <td> : </td>
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
        document.getElementById("userid").value = "";
        document.getElementById("username").value = "";
        document.getElementById("OK").innerHTML = "Create";
        document.getElementById("userid").readOnly = false;
    }

    function saveUser()
    {
        var id, name;
        id = document.getElementById("userid").value;
        name = document.getElementById("username").value;
        if(id != "" && name != "")
        {
            window.location = "UserSave.php?id=" + id + "&name=" + name;
        }
        else
        {
            alert("Lengkapi semua data terlebih dahulu");
        }
        document.getElementById("OK").innerHTML = "Create";
        document.getElementById("userid").readOnly = false;

    }
    $(document).ready(function(){
        $("#saringtabel").click(function()
        {
            $("#tampiltabel").empty();
            $("#tampiltabel").html("<h2>Please Wait. . . .</h2>");
            $("#tampiltabel").load('TabelUser.php?katakunci='+$("#katakunci").val());
        });
    });

</script>

<script src="js/excanvas.min.js"></script>
<script src="js/chart.min.js" type="text/javascript"></script>
<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script language="javascript" type="text/javascript" src="js/full-calendar/fullcalendar.min.js"></script>

<script src="js/base.js"></script>

</body>
</html>
