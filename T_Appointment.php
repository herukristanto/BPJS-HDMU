<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Appointment</title>
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
          <?php
          if(isset($_POST['app_id']))
          {
          	$id = $_POST['app_id'];

          	include "koneksi.php";

          	$que = "select * from T_Appointment where app_no = ".$id;
          	$sql = sqlsrv_query($conn,$que);
          	$app = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC);
          }
          ?>

          <form action="SaveAppointment.php" method="post" onsubmit="return validat();">
          <input type='hidden' name='app_id' id='app_id' value="<?php if(isset($_POST['app_id'])){echo $id;} ?>"/>
          <input type='hidden' name='hidUser' id='hidUser' value="<?php echo $usrname; ?>"/>
          <p>
            <button type="submit" class="btn" name="Save" id="Save" <?php if(isset($app['Case_No']) == true && $app['Case_No'] <> ''){echo 'disabled="disabled"';}?>>Save</button>
            <button type="button" class="btn" name="Cancel" id="Cancel" onclick="button('Outpatient.php');">Exit</button>
            <button type="submit" class="btn" name="Actual" id="Actual" formaction="T_Actual.php" <?php if(isset($_POST['app_id']) == false){echo 'disabled="disabled"';} elseif($app['Case_No'] <> ''){echo 'disabled="disabled"';}?>>Actual</button>
          </p>
          <table width="392" border="0">
            <tr>
              <td width="112">Nomor Pasien</td>
              <td width="15">:</td>
              <td width="251">
                <input name="Patno" type="text" id="Patno" readonly value="<?php if(isset($app['Pat_No'])){echo $app['Pat_No'];} ?>"/>
                <input type="button" name="Searchpat" id="Searchpat" value="..."/>
              </td>
            </tr>
            <tr>
              <td>Nama</td>
              <td>:</td>
              <td><input name="Nama" type="text" id="Nama" maxlength="50" value="<?php if(isset($app['Name'])){echo $app['Name'];} ?>"/></td>
            </tr>
            <tr>
              <td>Tanggal Lahir</td>
              <td>:</td>
              <td><input name="DOB" class="datepicker" type="text" id="DOB" maxlength="10" value="<?php if(isset($app['DOB'])){echo $app['DOB']->format('m/d/Y');} ?>"/></td>
            </tr>
            <tr>
              <td>Jenis Kelamin</td>
              <td>:</td>
              <td>
                <select name="Sex" size="1" id="Sex">
                  <option value='M' <?php if(isset($app['Sex'])){if($app['Sex'] == 'M'){echo 'selected="selected"';}} ?>>Laki-Laki</option>
                  <option value='F' <?php if(isset($app['Sex'])){if($app['Sex'] == 'F'){echo 'selected="selected"';}} ?>>Perempuan</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>No. Telp</td>
              <td>:</td>
              <td><input type="text" class="numberonly" name="Telp" id="Telp" maxlength="30" value="<?php if(isset($app['Telp'])){echo $app['Telp'];} ?>"/></td>
            </tr>
            <tr>
              <td>Tanggal</td>
              <td>:</td>
              <td>
                <?php
                if(isset($app['App_Date']))
                  {$appdat = $app['App_Date']->format('m/d/Y');}
                else
                  {$appdat = date('m/d/Y');} 
                ?>
                <input name="Tgl" class="datepicker" type="text" id="Tgl" maxlength="10" value="<?php echo $appdat; ?>"/>
              </td>
            </tr>
            <tr>
              <td>Jam</td>
              <td>:</td>
              <td><input name="Jam" type="text" id="Jam" maxlength="8" value="<?php if(isset($app['App_Time'])){echo $app['App_Time'];} ?>" onkeypress="return isNumberKey(event);"/></td>
            </tr>
            <tr>
              <td>Dokter</td>
              <td>:</td>
            	<td>
            	  <select name="dokter" id="docID">
                    <option value=''></option>
            		      <?php
                        include "koneksi.php";

                        $que = "SELECT * FROM M_Doctor where active = 'X' order by name asc";
                        $sql = sqlsrv_query($conn,$que);

                        if(isset($app['Doctor_Id']))
                        {
                          while($hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)){
                            if($app['Doctor_Id'] == $hasil['Doctor_Id'])
                            {
                              echo "<option value=$hasil[Doctor_Id] selected='selected'>$hasil[Name]</option>";
                    			  }
                    			  else
                    			  {
                              echo "<option value=$hasil[Doctor_Id]>$hasil[Name]</option>";
                    			  }
                          }
                        }
                        else
                        {
                          while($hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)){
                            echo "<option value=$hasil[Doctor_Id]>$hasil[Name]</option>";
                          }
                        }
                      ?>
                  </select>
            	</td>
            </tr>
            <tr>
              <td>Ruang</td>
              <td>:</td>
              <td>
                <select name="Ruang" id="roomID">
                <option value=''></option>
          		    <?php
                    include "koneksi.php";

                    $que = "SELECT * FROM M_Room where active = 'X' order by name asc";
                    $sql = sqlsrv_query($conn,$que);

                    if(isset($app['Room_Id']))
                    {
                      while($hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)){
                  			if($app['Room_Id'] == $hasil['Room_Id']){
                  			  echo "<option value=$hasil[Room_Id] selected='selected'>$hasil[Name]</option>";
                  			}
                  			else
                  			{
                  			  echo "<option value=$hasil[Room_Id]>$hasil[Name]</option>";
                  			}
                  		}
                    }
                    else
                    {
                      while($hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)){
                        echo "<option value=$hasil[Room_Id]>$hasil[Name]</option>";
                  		}
                    }
                  ?>
                </select>
              </td>
            </tr>
          </table>
          </form>

          <?php include "SearchPat.php"; ?>

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

  function validat(){
    var nama = document.getElementById("Nama").value;
    var tlp = document.getElementById("Telp").value;
    var jam = document.getElementById("Jam").value;
    var dok = document.getElementById("docID").value;
    var room = document.getElementById("roomID").value;

    if(nama.trim() == ""){
      alert("Nama pasien tidak boleh kosong");
      return false;
    }

    var dob = document.getElementById("DOB").value;
    if(isValidDate(dob) == false){
      return false;
    }
	
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1; //January is 0!
	
	var yyyy = today.getFullYear();
	if(dd<10){
		dd='0'+dd;
	} 
	if(mm<10){
		mm='0'+mm;
	} 
	var today = yyyy+'/'+mm+'/'+dd;
	var dob1 = dob.substring(6,10)+"/"+dob.substring(3,5)+"/"+dob.substring(0,2);

	if(today < dob1)
	{
		alert("Tanggal lahir tidak bisa lebih besar dari hari ini");
		return false;
	}
	
    if(tlp.trim() == ""){
      alert("masukan nomor yang bisa dihubungi");
      return false;
    }

    var tgl = document.getElementById("Tgl").value;
    if(isValidDate(tgl) == false){
      return false;
    }

    if(jam.trim() == ""){
      alert("Masukan jam appointment");
      return false;
    }else if (isValidTime(jam) == false) {
      return false;
    }

    if(dok.trim() == ""){
      alert("Pilih dokter");
      return false;
    }

    if(room.trim() == ""){
      alert("Pilih ruangan");
    }
  }
  
  function isNumberKey(e)
  {
  	var charCode;
    if (e.keyCode > 0) {
    	charCode = e.which || e.keyCode;
    }
    else if (typeof (e.charCode) != "undefined") {
    	charCode = e.which || e.keyCode;
    }
    
	if (charCode == 58)
    	return true
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
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
