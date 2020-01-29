<?php
  include "koneksi.php";
  session_start();

  //Cek variabel user dan pass
  if (empty($_SESSION["username"])){
  	echo "
  	<script>
  		alert('Silahkan Login Terlebih Dahulu');
  		window.location.href = 'index.html';
  	</script>
  	";
  }else{
    $page = basename($_SERVER['PHP_SELF']);
    $quer = "select count(*) as hasil from M_Authorization where User_ID = '".$_SESSION["username"]."' and Form_ID = '".$page."'";
    $sql_execute = sqlsrv_query($conn,$quer);
    $rs = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);
    if($rs["hasil"] == 0)
    {
    	echo '<script>
    	alert("Anda tidak berhak membuka halaman ini");
    	window.location="main.php";
    	</script>';
    }
  }

  $usrname = $_SESSION["username"];
  $name = $_SESSION["name"];
?>
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
      <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a>
      <a class="brand" href="main.php">Klinik Hemodialisis Medika Utama</a>
      <div class="nav-collapse">
        <ul class="nav pull-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="icon-cog"></i><font size="3"><?php echo $name; ?> </font><b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
              <li><a href="ChangePassword.php">Change Password</a></li>
              <li><a href="javascript:keluar();">Log Off</a></li>
            </ul>
          </li>

        </ul>

      </div>
      <!--/.nav-collapse -->
    </div>
    <!-- /container -->
  </div>
  <!-- /navbar-inner -->
</div>
<!-- /navbar -->
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
        <li class="defMain"><a href="main.php"><i class="fa fa-home"></i><span>Home</span> </a> </li>
        <li><a href="main_mstr.php"><i class="fa fa-database"></i><span>Master Data</span> </a> </li>
        <li><a href="Outpatient.php"><i class="fa fa-handshake-o"></i><span>Transaction</span> </a> </li>
        <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-upload"></i><span>Upload Data</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="U_DataService.php">Upload Master Service</a></li>
            <li><a href="U_DataInventory.php">Upload Stock</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-file-text"></i><span>Report</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="R_CurrentStock.php">Report Current Stock</a></li>
            <li><a href="R_StockUsage.php">Report Stock Usage</a></li>
            <li><a href="R_CashIncome.php">Report Cash Income</a></li>
            <li><a href="R_OutstandingInsurance.php">Report Outstanding Insurance</a></li>
            <li><a href="R_VisitorAmount.php">Report Visit Patient</a></li>
            <li><a href="R_Diagnose.php">Report List Diagnosa</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-wrench"></i><span>Tools</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="FormManagement.php">Form Management</a></li>
            <li><a href="UserForm.php">User Management</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- /container -->
  </div>
  <!-- /subnavbar-inner -->
</div>
<!-- /subnavbar -->

<script>
  function keluar(){
    var r = confirm("Apakah Anda Yakin Ingin Keluar?");
    if(r == true){
      $.post("logoff.php", {}, function(data, status){
        $(location).attr('href',"index.html");
      });
    }
  }
</script>
