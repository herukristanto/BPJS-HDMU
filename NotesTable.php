<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Blank</title>
  <link href="css/style.css" rel="stylesheet">
  <style>
    #myTable{
      width: 100%;
      table-layout: fixed;
      white-space: normal;
    }
  </style>
</head>
<body>
  <?php
    include "koneksi.php";
    date_default_timezone_set("Asia/Bangkok");
    session_start();

    echo "<input type='hidden' id='hidUser' value='".$_SESSION["username"]."' />";

    if(isset($_GET['patno'])){
      $patno = $_GET['patno'];
    }
    if(isset($_GET['caseno'])){
      $caseno = $_GET['caseno'];
    }

    $que = "Select * from T_Notes where Pat_No=".$patno." and Case_No=".$caseno." order by Tanggal desc";
    $que_exe = sqlsrv_query($conn1,$que);

    echo "<b><h4>&nbsp;&nbsp;&nbsp;Case : ".$caseno."</h4></b>";

    echo "<table id='myTable'>
            <tr>
              <td style='width:10%;'><b>Tanggal</b></td>
              <td style='width:15%;'><b>User Name</b></td>
              <td><b>Catatan</b></td>
              <td style='width:5%;'>&nbsp;</td>
            </tr>";

    while($notes = sqlsrv_fetch_array($que_exe, SQLSRV_FETCH_ASSOC)){
      $queName = "Select * from M_User where User_Id='".$notes['User_Id']."'";
      $queName_exe = sqlsrv_query($conn2,$queName);
      $name = sqlsrv_fetch_array($queName_exe, SQLSRV_FETCH_ASSOC);
      $tglNotes = $notes['Tanggal']->format("m/d/Y H:i:s");
      echo "
        <tr>
          <td style='vertical-align:top;'>
            ".$notes['Tanggal']->format("d/m/Y")."
          </td>
          <td style='vertical-align:top;'>
            ".$name['Name']."
          </td>
          <td style='word-wrap:break-word;' id='".$notes['ID']."'>
            ".$notes['Note']."
          </td>
          <td>
            <input type='button' value='Edit' onclick=\"popUp('".$notes['ID']."','".$tglNotes."','".$notes['User_Id']."');\"/>
          </td>
        </tr>
      ";

    }
    echo "</table>";
  ?>

  <script>
    function popUp(noid,x,usr1){ //x with date format m/d/Y H:i:s
      var dof1 = new Date(x);
      var dof2 = new Date();
      var hours = Math.floor(Math.abs(dof2 - dof1) / 36e5); //36e5 means 36 with 5 zero (3600000) in milsec per 1 hour
      var usr2 = document.getElementById('hidUser').value;
      
      if(usr1 != usr2){
        alert("Tidak dapat mengubah catatan milik user lain");
        return false;
      }

      if(hours < 24){
        parent.openEdit(noid);
      }else{
        alert("Catatan tidak dapat di edit setelah lewat dari 24 jam");
        return false;
      }
    }
  </script>
</body>
</html>