<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Input Service</title>
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
#tabService{
  border: 0;
  width: 100%;
  height: 400px;
}
.short{
  width: 100px;
}
.medium{
  width: 303px;
}
.long{
  width: 450px;
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
          <?php
            include "koneksi.php";
            
            $caseid = $_GET['caseid'];

            $query = "SELECT C.Pat_No, C.Case_No, P.Name, P.DOB, P.Sex, C.Pembayar FROM M_Patient P, T_Case C WHERE C.Pat_No = P.Pat_No AND C.Case_No like '%".$caseid."%'";
            $sql = sqlsrv_query($conn, $query);

            $rs = sqlsrv_fetch_array($sql);
            $nopasien = $rs['Pat_No'];
            $caseid = $caseid;
            $name = $rs['Name'];
            $dob = $rs['DOB']->format('d-m-Y');
            $sex = $rs['Sex'];
            $pembayar = $rs['Pembayar'];
          ?>
          <form action="SaveService.php" method="post" target="ifsave" onsubmit="return be4save();">
            <table style="background-color: white; border: 1px solid black; border-radius: 5px;width:60%">
              <tr>
                <td>RM / Case</td>
                <td> : </td>
                <td><?php echo $nopasien." / ".$caseid;?></td>
                <td></td>
                <td>Jenis Kelamin</td>
                <td> : </td>
                <td><?php if($sex=='M'){echo "Laki-laki";}else{echo "Perempuan";}?></td>
              </tr>
              <tr>
                <td>Nama</td>
                <td> : </td>
                <td><?php echo $name; ?></td>
                <td></td>
                <td>Pembayar</td>
                <td> : </td>
                <td><?php echo $pembayar; ?></td>
              </tr>
              <tr>
                <td>Tanggal Lahir</td>
                <td> : </td>
                <td><?php echo $dob;?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </table>
            <br>
            <table>
              <tr>
                <td>Kode Service</td>
                <td>:</td>
                <td>
                  <input type="text" class="short key" name="scode" id="scode" >
                  <input type="button" name="srvSrc" id="myBtn" value="...">
                   - 
                  <input type="text" class="medium" name="sdescp" id="sdescp" readonly="true">
                </td>
              </tr>
              <tr>
                <td>Jumlah</td>
                <td>:</td>
                <td><input type="text" class="short" onkeypress="return isNumberKey(event);" name="sqty" id="sqty"></td>
                <td></td>
              </tr>
              <tr>
                <td>Kode Dokter</td>
                <td>:</td>
                <td>
                  <input type="text" class="short" name="sdoctor" id="sdoctor">
                  <input type="button" name="dokSrc" id="dokSrc" value="...">
                </td>
                <td></td>
              </tr>
              <tr>
                <td>Keterangan</td>
                <td>:</td>
                <td><input type="text" name="snote" id="snote" class="long"></td>
                <td style="padding-left: 15px;"><button type="submit" class="btn">Add Service</button></td>
              </tr>
            </table>

            <input type="hidden" name="patno" value="<?php echo $nopasien; ?>" >
            <input type="hidden" name="caseno" value="<?php echo $caseid; ?>" >
            <input type="hidden" name="sunit" id="sunit" value="" >
            <input type="hidden" name="sprice" id="sprice" value="" >
            <input type="hidden" name="scurstock" id="scurstock" value="" >
            <input type="hidden" name="spotstock" id="spotstock" value="" >
            <input type="hidden" name="sdesc" id="sdesc" value = "">


          </form>
          <iframe id="tabService" src="ServiceTable.php?caseno=<?php echo $caseid; ?>"></iframe>
          <iframe name="ifsave" id="ifsave" src="" hidden></iframe>

          <?php
            include "SearchService.php";
            include "SearchServiceDoctor.php";
          ?>
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
   function refreshif(){
    document.getElementById('tabService').src = "ServiceTable.php?caseno=<?php echo $caseid; ?>";
   }

   function clearData(){
    document.getElementById("scode").value = "";
    document.getElementById("sdescp").value = "";
    document.getElementById("sqty").value = "";
    document.getElementById("sdoctor").value = "";
    document.getElementById("snote").value = "";
   }

  function be4save(){
    var scode = document.getElementById("scode").value;
    var sqty = document.getElementById("sqty").value;

    if(scode == ""){
      alert("Masukan Kode Servis");
      return false;
    }else if(sqty == "" || sqty == "0"){
      alert("Masukan Jumlah Servis");
      return false;
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

    if (charCode == 45)
      return true
    if (charCode > 31 && (charCode < 48 || charCode > 57))
      return false;

    return true;
  }

  $('.key').bind("enterKey",function(e){
    $('#sqty').focus();
	});

  $('.key').keyup(function(e){
  	if(e.keyCode == 13)
  	{
      $(this).trigger("enterKey");
  	}
	});
</script>

<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>

</body>
</html>
