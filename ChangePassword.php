<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Change Password</title>
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
<?php include "header.php" ?>
	<div class="main">
		<div class="main-inner">
			<div class="container">
				<div class="row">
					<div class="span12 mainPage">
						<p>
							<button type="button" class="btn" onclick="cekpassword()">Save</button>
							<button type="button" class="btn" onclick="goto('main.php');">Exit</button>
						</p>
						<table>
							<tr>
								<td>User ID</td>
								<td> : </td>
								<td><input type="text" id="username" name="username" value=<?php echo $usrname; ?> disabled></td>
							</tr>
							<tr>
								<td>Password Lama</td>
								<td> : </td>
								<td><input type="password" id="passlama" name="passlama" maxlength="50"></td>
							</tr>
							<tr>
								<td>Password Baru</td>
								<td> : </td>
								<td><input type="password" id="passbaru" name="passbaru" maxlength="50"></td>
							</tr>
							<tr>
								<td>Konfirmasi Password Baru</td>
								<td> : </td>
								<td><input type="password" id="repass" name="repass" maxlength="50"></td>
							</tr>
						</table>
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

    function clearAll(){
      document.getElementById("passlama").value = "";
      document.getElementById("passbaru").value = "";
      document.getElementById("repass").value = "";
      document.getElementById("passlama").focus();
    }

    function cekpassword() {
      var username = document.getElementById("username").value;
      var passlama = document.getElementById("passlama").value;
      var passbaru1 = document.getElementById("passbaru").value;
      var passbaru2 = document.getElementById("repass").value;

      if(passlama != ""){
        if(passbaru1 != ""){
          if(passbaru1 == passbaru2){
            $.post("updatepass.php", {id:username,oldpass:passlama,newpass:passbaru1 }, function(data, status){
              alert(data);
              clearAll();
            });
          }else{
            alert("Konfirmasi Password Baru harus sama dengan Password Baru");
            clearAll();
          }
        }else{
          alert("Password Baru tidak boleh kosong");
          clearAll();
        }
      }else{
        alert("Password Lama tidak boleh kosong");
        clearAll();
      }
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
