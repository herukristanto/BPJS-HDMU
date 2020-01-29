<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Actual</title>
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
            date_default_timezone_set("Asia/Bangkok");
            if(isset($_POST['app_id']))
            {
            	$id = $_POST['app_id'];
            }

            if(isset($_POST['Patno']))
            {
            	$patno = $_POST['Patno'];
            }

            if(isset($_POST['Nama']))
            {
            	$patnam = $_POST['Nama'];
            }

            if(isset($_POST['DOB']))
            {
            	$DOB = $_POST['DOB'];
            	if($DOB <> "")
            	{
            		$DOB1 = DateTime::createFromFormat('d/m/Y', $DOB);
            		$DOB = $DOB1->format('m/d/Y');
            	}
            }

            if(isset($_POST['Sex']))
            {
            	$sex = $_POST['Sex'];
            }

            if(isset($_POST['Telp']))
            {
            	$telp = $_POST['Telp'];
            }

            if(isset($_POST['Telp']))
            {
            	$telp = $_POST['Telp'];
            }

            if(isset($_POST['Tgl']))
            {
            	$dateapp = $_POST['Tgl'];
            	if($dateapp <> "")
            	{
            		$dateapp1 = DateTime::createFromFormat('d/m/Y', $dateapp);
            		$dateapp = $dateapp1->format('d/m/Y');
            	}
            }

            if(isset($_POST['Jam']))
            {
            	$time = $_POST['Jam'];
            	if($time <> "")
            	{
            		$time1 = DateTime::createFromFormat('H:i', $time);
            		$time = $time1->format('H:i');
            	}
            }

            if(isset($_POST['dokter']))
            {
            	$docID = $_POST['dokter'];
            }

            if(isset($_POST['Ruang']))
            {
            	$roomID = $_POST['Ruang'];
            }

            if($patno <> '')
            {
            	include "koneksi.php";

            	$que = "SELECT * FROM M_Patient where PAT_NO = '".$patno."'";
              $sql = sqlsrv_query($conn,$que);
            	$app = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC);
            }
          ?>

          <form action="SaveActual.php" method="post" onsubmit="return validat();">
            <button type="submit" class="btn" name="Save" id="Save">Save</button>
            <button type="button" class="btn" name="Cancel" id="Cancel" onclick="button()" >Exit</button>

            <input type="hidden" name="hidUser" id="hidUser" value="<?php echo $usrname ?>" />

            </br></br>

            <h3>Identitas Pasien </h3>
            <table border="0">
              <tr>
                <td width="130">Nomor Pasien</td>
                <td width="15">:</td>
                <td>
                  <input name="Pno" type="text" id="Pno" readonly value="<?php echo $patno; ?>"/>
                  <input type="hidden" name="noId" id="noId" value="<?php echo $id; ?>" />
                </td>
              </tr>
              <tr>
                <td>No.Case</td>
                <td>:</td>
                <td><input name="Caseno" type="text" id="Caseno" readonly /></td>
              </tr>
              <tr>
                <td>Nama</td>
                <td>:</td>
                <td><input type="text" name="Pnam" id="Pnam" value="<?php echo $patnam; ?>"/></td>
              </tr>
              <tr>
                <td>Tanggal Lahir</td>
                <td>:</td>
                <td><input type="text" class="datepicker" name="PDOB" id="PDOB" value="<?php echo $DOB; ?>"/></td>
              </tr>
                <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td>
                  <select name="PSex" size="1" id="PSex">
                    <option value = 'M' <?php if($sex == 'M'){echo 'selected="selected"';} ?>>Laki-Laki</option>
                    <option value = 'F' <?php if($sex == 'F'){echo 'selected="selected"';} ?>>Perempuan</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><textarea name="Padd" id="Padd" cols="100" rows="4"><?php if(isset($app['Address'])){echo $app['Address'];} ?></textarea></td>
              </tr>
              <tr>
                <td>Propinsi</td>
                <td>:</td>
                <td>
                  <select name="Prop" id="Prop">
                    <option value=''></option>
                    <?php
                      include "koneksi.php";

                      $que = "SELECT * FROM M_Propinsi where active = 'X' order by name asc";
                      $sql = sqlsrv_query($conn,$que);

                      if(isset($app['Prop']))
                      {
                        while($hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC))
                        {
                          if($app['Prop'] == $hasil['Prop_Id'])
                          {
                            echo "<option value=$hasil[Prop_Id] selected='selected'>$hasil[Name]</option>";
                          }
                          else
                          {
                            echo "<option value=$hasil[Prop_Id]>$hasil[Name]</option>";
                          }
                        }
                      }
                      else
                      {
                        while($hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC))
                        {
                          echo "<option value=$hasil[Prop_Id]>$hasil[Name]</option>";
                        }
                      }
                    ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td>No.Telp</td>
                <td>:</td>
                <td><input type="text" class="numberonly" name="Ptlp" id="Ptlp" value="<?php echo $telp; ?>"/></td>
              </tr>
              <tr>
                <td>No.KTP</td>
                <td>:</td>
                <td><input type="text" class="numberonly" name="KTPno" id="KTPno" value="<?php if(isset($app['KTP'])){echo $app['KTP'];} ?>" /></td>
              </tr>
                <tr>
                <td>Status Perkawinan</td>
                <td>:</td>
                <td>
                  <select name="Status" id="Status">
                    <option value=''></option>
                    <?php
                      $que = "SELECT * FROM M_Status where active = 'X' order by name asc";
                      $sql = sqlsrv_query($conn,$que);

                      if(isset($app['Status']))
                      {
                        while($hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC))
                        {
                          if($app['Status'] == $hasil['Status_Id'])
                          {
                            echo "<option value=$hasil[Status_Id] selected='selected'>$hasil[Name]</option>";
                          }
                          else
                          {
                            echo "<option value=$hasil[Status_Id]>$hasil[Name]</option>";
                          }
                        }
                      }
                      else
                      {
                        while($hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC))
                        {
                          echo "<option value=$hasil[Status_Id]>$hasil[Name]</option>";
                        }
                      }
                    ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td>Agama</td>
                <td>:</td>
                <td>
                  <select name="Religion" id="Religion">
                    <option value=''></option>
                    <?php
                      $que = "SELECT * FROM M_Religion where active = 'X' order by name asc";
                      $sql = sqlsrv_query($conn,$que);

                      if(isset($app['Religion']))
                      {
                        while($hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC))
                        {
                          if($app['Religion'] == $hasil['Religion_Id'])
                          {
                            echo "<option value=$hasil[Religion_Id] selected='selected'>$hasil[Name]</option>";
                          }
                          else
                          {
                            echo "<option value=$hasil[Religion_Id]>$hasil[Name]</option>";
                          }
                        }
                      }
                      else
                      {
                        while($hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC))
                        {
                          echo "<option value=$hasil[Religion_Id]>$hasil[Name]</option>";
                        }
                      }
                    ?>
                  </select>
                </td>
              </tr>
            </table>
            <br>
            <h3>Identitas yang bisa dihubungi dalam keadaan darurat</h3>
            <table border="0">
              <tr>
                <td width="130">Nama</td>
                <td width="15">:</td>
                <td><input type="text" name="NokName" id="NokName" value="<?php if(isset($app['Nok_Name'])){echo $app['Nok_Name'];} ?>"/></td>
              </tr>
              <tr>
                <td>No.Telp</td>
                <td>:</td>
                <td><input type="text" class="numberonly" name="NokTelp" id="NokTelp" value="<?php if(isset($app['Nok_Telp'])){echo $app['Nok_Telp'];} ?>" /></td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><textarea name="NokAdd" id="NokAdd" cols="45" rows="5"><?php if(isset($app['Nok_Address'])){echo $app['Nok_Address'];} ?></textarea></td>
              </tr>
            </table>
            <br>
            <h3>Detail Data</h3>
            <table border="0">
              <tr>
                <td width="130">Tanggal</td>
                <td width="15">:</td>
                <td><input type="text" name="Tgl" id="Tgl" value="<?php echo date('d/m/Y'); ?>"/></td>
              </tr>
              <tr>
                <td>Jam</td>
                <td>:</td>
                <td><input type="text" name="Jam" id="Jam" value="<?php echo date('H:i'); ?>"/></td>
              </tr>
              <tr>
                <td>Dokter</td>
                <td>:</td>
                <td>
                  <select name="DName" id="DName">
                    <option value=''></option>
                    <?php
                      $que = "SELECT * FROM M_Doctor where active = 'X' order by name asc";
                      $sql = sqlsrv_query($conn,$que);

                      while($hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC))
                      {
                        if($docID == $hasil['Doctor_Id'])
                        {
                          echo "<option value=$hasil[Doctor_Id] selected='selected'>$hasil[Name]</option>";
                        }
                        else
                        {
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
                  <select name="RName" id="RName">
                    <option value=''></option>
                    <?php
                      $que = "SELECT * FROM M_Room where active = 'X' order by name asc";
                      $sql = sqlsrv_query($conn,$que);

                      while($hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC))
                      {
                        if($roomID == $hasil['Room_Id'])
                        {
                          echo "<option value=$hasil[Room_Id] selected='selected'>$hasil[Name]</option>";
                        }
                        else
                        {
                          echo "<option value=$hasil[Room_Id]>$hasil[Name]</option>";
                        }
                      }
                    ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td>Pembayar</td>
                <td>:</td>
                <td>Pasien Sendiri &nbsp;<input type="checkbox" name="SP" id="SP" value="SP" checked onClick="Selfpay();"/></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>Asuransi &nbsp;
                  <input name="Asuransi" type="text" id="Asuransi" readonly />
                  <input type="button" name="SrcIns" id="SrcIns" value="..." />
                </td>
              </tr>
            </table>
          </form>

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
	function button()
	{
		window.location.href ='Outpatient.php';
	}

	function Selfpay()
	{
		document.getElementById('Asuransi').value = '';
	}

  function validat(){
    var dob = document.getElementById("PDOB").value;
    var tgl = document.getElementById("Tgl").value;
    var jam = document.getElementById("Jam").value;

    return cekContent();

    if(isValidDate(dob) == false || isValidDate(tgl) == false){
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

    if(isValidTime(jam) == false){
		return false;
    }
  }

  function cekContent(){
    var ele = ["Pnam", "PDOB", "Padd", "Prop", "Ptlp", "KTPno", "Status", "Religion", "NokName", "NokTelp"];
    var elem;

    for(elem in ele){
      if(document.getElementById(ele[elem]).value == ''){
        alert("Mohon lengkapi seluruh data pasien.");
        setFoc(ele[elem]);
        return false;
      }else{
        // alert(document.getElementById(ele[elem]).value);
      }
    }
  }
</script>

<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script src="js/base.js"></script>

</body>
</html>
