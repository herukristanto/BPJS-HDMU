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
      window.location="main_tran.php";
      </script>';
    }
  }

  $usrname = $_SESSION["username"];
  $name = $_SESSION["name"];
?>

<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
      <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a>
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
        <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-user-md"></i><span>Doctor</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="M_Doctor_Create.php">Create</a></li>
            <li><a href="M_Doctor_Change.php">Change</a></li>
            <li><a href="M_Doctor_Display.php">Display</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-medkit"></i><span>Services</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="M_Service_Create.php">Create</a></li>
            <li><a href="M_Service_Change.php">Change</a></li>
            <li><a href="M_Service_Display.php">Display</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-dollar"></i><span>Price</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="M_Price_Create.php">Create</a></li>
            <li><a href="M_Price_Change.php">Change</a></li>
            <li><a href="M_Price_Display.php">Display</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-commenting"></i><span>Diagnosis</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="M_Diagnosis_Create.php">Create</a></li>
            <li><a href="M_Diagnosis_Change.php">Change</a></li>
            <li><a href="M_Diagnosis_Display.php">Display</a></li>
            <li>--------------------------------------</li>
            <li><a href="M_Group_Diag_Create.php">Create Group</a></li>
            <li><a href="M_Group_Diag_Change.php">Change  Group</a></li>
            <li><a href="M_Group_Diag_Display.php">Display  Group</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-shield"></i><span>Insurance</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="M_Insurance_Create.php">Create</a></li>
            <li><a href="M_Insurance_Change.php">Change</a></li>
            <li><a href="M_Insurance_Display.php">Display</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-hospital-o"></i><span>Room</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="M_Room_Create.php">Create</a></li>
            <li><a href="M_Room_Change.php">Change</a></li>
            <li><a href="M_Room_Display.php">Display</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-map-marker"></i><span>Province</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="M_Province_Create.php">Create</a></li>
            <li><a href="M_Province_Change.php">Change</a></li>
            <li><a href="M_Province_Display.php">Display</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-table"></i><span>Religion</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="M_Religion_Create.php">Create</a></li>
            <li><a href="M_Religion_Change.php">Change</a></li>
            <li><a href="M_Religion_Display.php">Display</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-male"></i><i class="fa fa-female"></i><span>Status</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="M_Status_Create.php">Create</a></li>
            <li><a href="M_Status_Change.php">Change</a></li>
            <li><a href="M_Status_Display.php">Display</a></li>
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
