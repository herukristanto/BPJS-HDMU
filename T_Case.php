<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Case</title>
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
          <?php
            include 'koneksi.php';
            date_default_timezone_set("Asia/Bangkok");
            $caseno = $_GET['case'];

            $que = "select * from V_Appointment where Case_No = ".$caseno;
            $sql = sqlsrv_query($conn,$que);
            $hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC);
          ?>

          <form action="SaveCase.php" method="post" id="myForm" onsubmit="return validat();">
            <!-- <h3>
              <button type="submit" class="btn" name="Save" id="Save">Save</button>
              <button type="button" class="btn" name="Cancel" id="Cancel" onclick="button();">Cancel</button>
              <button type="submit" class="btn" name="Plabel" id="Plabel" formaction="T_Diagnosa.php">Diagnosa</button>
              <button type="submit" class="btn" name="Plabel" id="Plabel" formaction="PrintLabel.php">Print Label</button>
              <button type="submit" class="btn" name="Pcatatan" id="Pcatatan" formaction="PrintCatatan.php">Print Catatan Dokter</button>
              <button type="submit" class="btn" name="Presep" id="Presep" formaction="PrintResep.php">Print Resep</button>
              <button type="submit" class="btn" name="Referral" id="Referral" formaction="SuratRujukan.php">Surat Rujukan</button>
            </h3> -->

            <table>
              <tr>
                <td>
                  <button type="submit" class="btn" name="Save" id="Save">Save</button>
                </td>
                <td>
                  <button type="button" class="btn" name="Cancel" id="Cancel" onclick="button();">Exit</button>
                </td>
                <td>
                  <button type="submit" class="btn" name="Plabel" id="Plabel" formaction="T_Diagnosa.php">Diagnosa</button>
                </td>
                <td>
                  <div class="btn-group">
                    <a class="btn " onclick=""><i class="icon-user icon-white"></i>Catatan Terintegrasi</a>
                    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a class="point" onclick="openNotes('T_Notes.php');"><i class="icon-white"></i>Buat Catatan</a></li>
                      <li><a class="point" onclick="openNotes('T_NotesEdit.php');"><i class="icon-pencil"></i>Ubah Catatan</a></li>
                      <li><a class="point" onclick="openNotes('T_NotesHist.php');"><i class="icon-trash"></i>Histori Catatan</a></li>
                      <!-- <li><a href="#"><i class="icon-ban-circle"></i> Ban</a></li>
                      <li class="divider"></li>
                      <li><a href="#"><i class="i"></i> Make admin</a></li> -->
                    </ul>
                  </div>
                  <!-- <button type="button" class="btn" name="Plabel" id="Plabel" onclick="openNotes();">Catatan Terintegrasi</button> -->
                </td>
                <td>
                  <div class="btn-group">
                    <a class="btn " onclick=""><i class="icon-user icon-white"></i>Form</a>
                    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a class="point" onclick="submitForm('PrintLabel.php');"><i class="icon-pencil"></i>Label Pasien</a></li>
                      <li><a class="point" onclick="submitForm('PrintCatatan.php');"><i class="icon-pencil"></i>Catatan Dokter</a></li>
                      <li><a class="point" onclick="submitForm('PrintResep.php');"><i class="icon-pencil"></i>Resep</a></li>
                      <li><a class="point" onclick="submitForm('SuratRujukan.php');"><i class="icon-pencil"></i>Rujukan</a></li>
                      <li><a class="point" onclick="submitForm('F_HD01.php');"><i class="icon-pencil"></i>Catatan Keperawatan Hemodialisa</a></li>
                      <li><a class="point" onclick="submitForm('F_HD02.php');"><i class="icon-pencil"></i>Pengkajian Pra-Tindakan</a></li>

                      <!-- <li class="divider"></li> -->
                    </ul>
                  </div>
                </td>
              </tr>
            </table>

            <input type="hidden" name="hidUser" id="hidUser" value="<?php echo $usrname ?>" />

          </br>
            <h3>Identitas Pasien </h3>
            <table border="0">
              <tr>
                <td width="130">Nomor Pasien</td>
                <td width="15">:</td>
                <td><input name="Patno" type="text" id="Patno" readonly value="<?php echo $hasil['Pat_No']; ?>" /></td>
              </tr>
              <tr>
                <td>No.Case</td>
                <td>:</td>
                <td><input name="Caseno" type="text" id="Caseno" readonly value="<?php echo $hasil['Case_No']; ?>"/></td>
              </tr>
              <tr>
                <td>Nama</td>
                <td>:</td>
                <td><input type="text" name="Nama" id="Nama" value="<?php echo $hasil['Name']; ?>"/> &nbsp;&nbsp;</td>
              </tr>
              <tr>
                <td>Tanggal Lahir</td>
                <td>:</td>
                <td><input type="text" class="datepicker" name="DOB" id="DOB" value="<?php echo $hasil['DOB']->format('m/d/Y'); ?>"/></td>
              </tr>
              <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td>
                  <select name="Sex" size="1" id="Sex">
                    <option value = 'M' <?php if($hasil['Sex'] == 'M'){echo 'selected="selected"';} ?>>Laki-Laki</option>
                    <option value = 'F' <?php if($hasil['Sex'] == 'F'){echo 'selected="selected"';} ?>>Perempuan</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><textarea name="Alamat" id="Alamat" cols="45" rows="4" ><?php echo $hasil['Address']; ?></textarea></td>
              </tr>
              <tr>
                <td>Propinsi</td>
                <td>:</td>
                <td>
                  <select name="Prop" id="Prop">
                    <option value=''></option>
                    <?php
                      $myProp = $hasil['Prop'];
                      $que = "SELECT * FROM M_Propinsi where active = 'X' order by name asc";
                      $sql = sqlsrv_query($conn,$que);

                      while($hasil1 = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)){
                        if($hasil1['Prop_Id'] == $myProp)
                        {
                          echo "<option value='$hasil1[Prop_Id]' selected='selected'>$hasil1[Name]</option>";
                        }
                        else
                        {
                          echo "<option value='$hasil1[Prop_Id]'>$hasil1[Name]</option>";
                        }
                      }
                    ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td>No.Telp</td>
                <td>:</td>
                <td><input type="text" class="numberonly" name="Telp" id="Telp" value="<?php echo $hasil['Telp']; ?>" /></td>
              </tr>
              <tr>
                <td>No.KTP</td>
                <td>:</td>
                <td><input type="text" class="numberonly" name="KTP" id="KTP" value="<?php echo $hasil['KTP']; ?>" /></td>
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

                      while($hasil1 = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)){
                        if($hasil1['Status_Id'] == $hasil['Status'])
                        {
                          echo "<option value=$hasil1[Status_Id] selected='selected'>$hasil1[Name]</option>";
                        }
                        else
                        {
                          echo "<option value=$hasil1[Status_Id]>$hasil1[Name]</option>";
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

                      while($hasil1 = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)){
                        if($hasil1['Religion_Id'] == $hasil['Religion'])
                        {
                          echo "<option value=$hasil1[Religion_Id] selected='selected'>$hasil1[Name]</option>";
                        }
                        else
                        {
                          echo "<option value=$hasil1[Religion_Id]>$hasil1[Name]</option>";
                        }
                      }
                    ?>
                  </select>
                </td>
              </tr>
            </table>

          </br>
            <h3>Identitas yang bisa dihubungi dalam keadaan darurat</h3>
            <table border="0">
              <tr>
                <td width="130">Nama</td>
                <td width="15">:</td>
                <td><input type="text" name="NokName" id="NokName" value="<?php echo $hasil['Nok']; ?>"/></td>
              </tr>
              <tr>
                <td>No.Telp</td>
                <td>:</td>
                <td><input type="text" class="numberonly" name="NokTelp" id="NokTelp" value="<?php echo $hasil['Nok_Telp']; ?>"/></td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><textarea name="NokAdd" id="NokAdd" cols="45" rows="4"><?php echo $hasil['Nok_Address']; ?></textarea></td>
              </tr>
            </table>

          </br>
            <h3>Detail Data</h3>
            <table border="0">
              <tr>
                <td width="130">Tanggal</td>
                <td width="15">:</td>
                <td><input type="text" name="Tgl" id="Tgl" readonly=true value="<?php echo $hasil['Case_Date']->format('d/m/Y'); ?>" /></td>
              </tr>
              <tr>
                <td>Jam</td>
                <td>:</td>
                <td><input type="text" name="Jam" id="Jam" readonly=true value="<?php echo $hasil['Case_Time']; ?>" /></td>
              </tr>
              <tr>
                <td>Dokter</td>
                <td>:</td>
                <td>
                  <select name="docId" id="docId">
                    <option value=''></option>
                    <?php
                      $que = "SELECT * FROM M_Doctor where active = 'X' order by name asc";
                      $sql = sqlsrv_query($conn,$que);

                      while($hasil1 = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)){
                        if($hasil1['Doctor_Id'] == $hasil['Doctor_Id'])
                        {
                          echo "<option value=$hasil1[Doctor_Id] selected='selected'>$hasil1[Name]</option>";
                        }
                        else
                        {
                          echo "<option value=$hasil1[Doctor_Id]>$hasil1[Name]</option>";
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
                  <select name="roomId" id="roomId">
                    <option value=''></option>
                    <?php
                      $que = "SELECT * FROM M_Room where active = 'X' order by name asc";
                      $sql = sqlsrv_query($conn,$que);

                      while($hasil1 = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)){
                        if($hasil1['Room_Id'] == $hasil['Room_Id'])
                        {
                          echo "<option value=$hasil1[Room_Id] selected='selected'>$hasil1[Name]</option>";
                        }
                        else
                        {
                          echo "<option value=$hasil1[Room_Id]>$hasil1[Name]</option>";
                        }
                      }
                    ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td>Pembayar</td>
                <td>:</td>
                <td>Pasien Sendiri &nbsp;<input type="checkbox" name="SP" id="SP" <?php if($hasil['Pat_No'] == $hasil['Pembayar']){ echo "checked"; } ?> onClick="Selfpay();" /></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>Asuransi &nbsp;
                  <input name="Asuransi" type="text" id="Asuransi" readonly <?php if($hasil['Pat_No'] != $hasil['Pembayar']){ echo "value=".$hasil['Pembayar']; } ?> />
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
  function button(x)
  {
    window.location.href = "Outpatient.php";
  }

  function Selfpay()
  {
    document.getElementById('Asuransi').value = '';
  }

  function validat(){
    var dob = document.getElementById("DOB").value;
    var tgl = document.getElementById("Tgl").value;
    var jam = document.getElementById("Jam").value;

    return cekContent();

    if(isValidDate(dob) == false || isValidDate(tgl) == false){
      alert("Tanggal tidak valid, Periksa kembali tanggal yang dimasukan");
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
    var ele = new Array("Nama", "DOB", "Alamat", "Prop", "Telp", "KTP", "Status", "Religion", "NokName", "NokTelp");
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

  function submitForm(form){
    document.getElementById("myForm").action = form;
    document.getElementById("myForm").submit();
  }
  
  function openNotes(form){
    var patno = document.getElementById("Patno").value;
    var caseno = document.getElementById("Caseno").value;
    window.location.href = form+"?patno="+patno+"&caseno="+caseno;
  }
</script>

<!-- <script src="js/excanvas.min.js"></script>
<script src="js/chart.min.js" type="text/javascript"></script> -->
<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<!-- <script language="javascript" type="text/javascript" src="js/full-calendar/fullcalendar.min.js"></script> -->
<script src="js/base.js"></script>

</body>
</html>
