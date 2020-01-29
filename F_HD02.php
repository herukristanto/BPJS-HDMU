<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Pengkajian Pra-Tindakan Pusat Dialisa</title>
  <style>
    #header{
      border-collapse: collapse;
      border-style:double;
      border-bottom:0;
    }
    #header tr td{
      border:1px solid black;
    }
    .noBorder tr td{
      border: 0 !important;
    }
    .allBorder{ 
      border-collapse:collapse;
    }
    .allBorder tr td{
      border-collapse:collapse;
      border: 1px solid black;
      padding-left : 5px; 
    }
    .short{
      width:70px;
    }
    .xshort{
      width:35px;
    }
    .midTable{
      border-left-style:double;
      border-right-style:double;
    }
    .botTable{
      border-left-style:double;
      border-right-style:double;
      border-bottom-style:double;
    }
    .inputTab tr td{
      padding-right:5px;  
    }
    .inputTab input[type=text]{
      border:1px solid black;
      border-radius:4px;
    }
    .inputTab textarea{
      border:1px solid black;
      border-radius:4px;  
    }
    td{
    	padding: 2px;
    	padding-left: 5px; 
    	vertical-align: top;
    }
    td.off{
    	background-color: white;
    	cursor: pointer; 
    }
    td.on{
    	background-color: #3399ff;
    	cursor: pointer;
    }
    .midText{
    	text-align: center;
    	width: 13%;
    }
    table{
    	border-collapse: collapse;
    }
    table#paintab{
    	display: none;
    	text-align: center;
    }
    table#paintab tr td :hover{
    	border:1px solid blue;
    }
    textarea{
    	resize: vertical;
    }
  </style>
  <link rel="stylesheet" href="css/jquery-ui.min.css">
  <script src="js/jquery-1.7.2.min.js"></script>

</head>
<body>
	<?php
		function getselect($x,$y){
			if($x == $y){
				echo "checked";
			}	
		}
		function getclass($x,$y){
			if(trim($x) == trim($y)){
				echo "on";
			}else{
				echo "off";
			}
		}
	?>

	<?php
		include "koneksi.php";
		session_start();
		date_default_timezone_set("Asia/Bangkok");

		$arr = array("alergi"=>"", "riwayat"=>"", "obat"=>"", "polanapas"=>"1",	"warnakulit"=>"1",
				"catnafas"=>"", "polamakan"=>"1", "tenggorok"=>"1", "catnutrisi"=>"", "bab"=>"1",
				"bak"=>"1", "cateliminasi"=>"", "keluhnyeri"=>"1", "skalanyeri"=>"", "lokasi"=>"",
				"catnyeri"=>"", "mobilitas"=>"1", "motorik"=>"1", "catmobilitas"=>"", "polatidur"=>"1",
				"obattidur"=>"1", "cattidur"=>"", "penampilan"=>"1", "kebersihan"=>"1", "catkebersihan"=>"",
				"psikologi"=>"1", "pengaruh"=>"", "catpsikologi"=>"", "hidtot1"=>"", "hidtot2"=>"",
				"hidtot3"=>"", "catjatuh"=>"", "butuhedu"=>"1", "catedukasi"=>"", "nilai2"=>"1",
				"catspirit"=>"", "temuan"=>"");

		$arr2 = array("a11"=>"", "a12"=>"", "a13"=>"", "a21"=>"", "a22"=>"", "a23"=>"", "a31"=>"", "a32"=>"", "a33"=>"", "a41"=>"", "a42"=>"", "a43"=>"", "a51"=>"", "a52"=>"", "a53"=>"", "a61"=>"", "a62"=>"", "a63"=>"");

		if(isset($_GET['patno'])){
			$patno = $_GET["patno"];
			$caseno = $_GET["caseno"];
			$doctorid = $_GET["doctorid"];
		}else{
			$patno = $_POST["Patno"];
			$caseno = $_POST["Caseno"];
			$doctorid = $_POST["docId"];
		}

		$page = basename($_SERVER['PHP_SELF']);
		$quer = "select count(*) as hasil from M_Authorization where User_ID = '".$_SESSION["username"]."' and Form_ID = '".$page."'";
		$sql_execute = sqlsrv_query($conn,$quer);
		$rs = sqlsrv_fetch_array($sql_execute, SQLSRV_FETCH_ASSOC);
		if($rs["hasil"] == 0)
		{
		  echo '<script>
			alert("Anda tidak berhak membuka halaman ini.");
			window.location="T_Case.php?case='.$caseno.'";
		  </script>';
		}

		$arrForm = array();

		$que = "Select * from V_Case where Pat_No = ".$patno." and Case_No = ".$caseno;
		$que_exe = sqlsrv_query($conn,$que);
		$pat = sqlsrv_fetch_array($que_exe, SQLSRV_FETCH_ASSOC);

		$quedok = "Select * from M_Doctor where Doctor_Id = ".$doctorid;
		$quedok_exe = sqlsrv_query($conn,$quedok);
		$dok = sqlsrv_fetch_array($quedok_exe, SQLSRV_FETCH_ASSOC);

		$que1 = "select * from F_HD02_01 where case_no = '".$caseno."'";
		$que1_exe = sqlsrv_query($conn,$que1);
		$rs = sqlsrv_fetch_array($que1_exe, SQLSRV_FETCH_ASSOC);

		$que2 = "select * from F_HD02_02 where case_no = '".$caseno."'";
		$que2_exe = sqlsrv_query($conn1,$que2);
		$rs2 = sqlsrv_fetch_array($que2_exe, SQLSRV_FETCH_ASSOC);

		$mode = "insert";

		if(!empty($rs)){
			$mode = "update";
			foreach ($rs as $key => $value) {
				$arr[$key] = $value;
				// echo $key.' = '.$value.'<br>';
			}
			foreach ($rs2 as $key => $value) {
				$arr2[$key] = $value;
				// echo $key.' '.$value.'<br>';
			}

		}

	?>

	<form action="F_HD02_Save.php" method="POST" >

		<input type="hidden" name="pat_no" value="<?php echo $patno; ?>">
		<input type="hidden" name="case_no" value="<?php echo $caseno; ?>">
		<input type="hidden" name="doc_id" value="<?php echo $doctorid; ?>">
		<input type="hidden" name="mode" value="<?php echo $mode; ?>">

		<button type="submit" class="btn">Save Form</button>
		<button type="button" class="btn" id="" onclick="">Print</button>
		<button type="button" class="btn" onclick="window.location.href = 'T_Case.php?case=<?php echo $caseno; ?>';">Back</button>

		<br><br>
		<table width="832" id="header">
			<tr>
				<td width="50%">
					<center>
						<p><img src="image/logo.png" width="200px"></p>
						<p>PENGKAJIAN PRA-TINDAKAN PUSAT DIALISA </p>
					</center>
				</td>
				<td>
					<table class="noBorder" id="detailPat">
						<tr>
							<td>Nama Pasien</td>
							<td>:</td>
							<td id="patnam"><?php echo $pat['Pat_Name']; ?></td>
						</tr>
						<tr>
							<td>R.M / Kasus</td>
							<td>:</td>
							<td id="rmcase"><?php echo $pat['Pat_No']." / ".$caseno; ?></td>
						</tr>
						<tr>
							<td>Tgl. Lahir</td>
							<td>:</td>
							<td id="dob"><?php echo $pat['Pat_DOB']->format('d-m-Y'); ?></td>
						</tr>
						<tr>
							<td>Jenis Kelamin</td>
							<td>:</td>
							<td id="sex"><?php if($pat['Pat_Sex'] == "M"){echo "Laki-laki";}else{echo "Perempuan";} ?></td>
						</tr>
						<tr>
							<td>Nama/No. Dokter</td>
							<td>:</td>
							<td id="doctor">
								<?php 
									if(strlen($dok['Name']) >= 27){
										echo substr($dok['Name'], 0, 27)." / ".$doctorid;
									}else{
										echo $dok['Name']." / ".$doctorid;
									}        
								?>
							</td>
						</tr>
						<tr>
							<td>Tgl. Datang</td>
							<td>:</td>
							<td id="datevisit"><?php echo $pat['Case_Date']->format('d-m-Y'); ?></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<table width="832" class="midTable" style="border-collapse: collapse;">
			<tr style="border-bottom: 1px solid black;">
				<td colspan="3">Dokter Penanggung Jawab Pelayanan : <strong><?php echo $dok['Name']; ?></strong></td>
			</tr>
			<tr style="border-bottom: 1px solid black;">
				<td width="130">Alergi</td>
				<td width="15">:</td>
				<td><textarea name="alergi" style="width:98%; vertical-align: top;"><?php echo $arr['alergi']; ?></textarea></td>
			</tr>
			<tr style="border-bottom: 1px solid black;">
				<td width="130">Riwayat Kesehatan</td>
				<td width="15">:</td>
				<td><textarea name="riwayat" style="width:98%; vertical-align: top;"><?php echo $arr['riwayat']; ?></textarea></td>
			</tr>
		</table>
		<table width="832" class="midTable">
			<tr>
				<td width="30"><strong>A.</strong></td>
				<td width="230"><strong>Riwayat Kesehatan</strong></td>
				<td width="15"></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td style="vertical-align: top;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Obat-obatan yang sedang &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;dikonsumsi</td>
				<td style="vertical-align: top;">:</td>
				<td><textarea name="obat" style="width: 98%;"><?php echo $arr['obat']; ?></textarea></td>
			</tr>
			<tr>
				<td></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td><strong>B.</strong></td>
				<td><strong>Pengkajian</strong></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td>1.&nbsp;&nbsp;<u>Penapasan dan Sirkulasi</u></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pola napas</td>
				<td>:</td>
				<td>
					<input type="radio" name="polanapas" id="rad011" value="1"<?php getselect($arr['polanapas'],'1'); ?>><label for="rad011">Spontan</label>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="polanapas" id="rad012" value="2"<?php getselect($arr['polanapas'],'2'); ?>><label for="rad012">Sesak</label>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Warna kulit</td>
				<td>:</td>
				<td>
					<input type="radio" name="warnakulit" id="rad021" value="1"<?php getselect($arr['warnakulit'],'1'); ?>><label for="rad021">Normal</label>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="warnakulit" id="rad022" value="2"<?php getselect($arr['warnakulit'],'2'); ?>><label for="rad022">Pucat</label>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="warnakulit" id="rad023" value="3"<?php getselect($arr['warnakulit'],'3'); ?>><label for="rad023">Lain-lain</label>
				</td>
			</tr>
			<tr>
				<td></td>
				<td style="vertical-align: top;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Catatan</td>
				<td style="vertical-align: top;">:</td>
				<td><textarea name="catnafas" style="width: 98%;"><?php echo $arr['catnafas']; ?></textarea></td>
			</tr>
			<tr>
				<td></td>
				<td>2.&nbsp;&nbsp;<u>Nutrisi dan saluran cerna</u></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pola makan</td>
				<td>:</td>
				<td>
					<input type="radio" name="polamakan" id="rad031" value="1"<?php getselect($arr['polamakan'],'1'); ?>><label for="rad031">Tidak ada masalah</label>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="polamakan" id="rad032" value="2"<?php getselect($arr['polamakan'],'2'); ?>><label for="rad032">Ada masalah</label>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tenggorokan</td>
				<td>:</td>
				<td>
					<input type="radio" name="tenggorok" id="rad041" value="1"<?php getselect($arr['tenggorok'],'1'); ?>><label for="rad041">Tidak ada kelainan</label>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="tenggorok" id="rad042" value="2"<?php getselect($arr['tenggorok'],'2'); ?>><label for="rad042">Sulit menelan</label>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="tenggorok" id="rad043" value="3"<?php getselect($arr['tenggorok'],'3'); ?>><label for="rad043">Sakit menelan</label>
				</td>
			</tr>
			<tr>
				<td></td>
				<td style="vertical-align: top;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Catatan</td>
				<td style="vertical-align: top;">:</td>
				<td><textarea name="catnutrisi" style="width: 98%;"><?php echo $arr['catnutrisi']; ?></textarea></td>
			</tr>
			<tr>
				<td></td>
				<td>3.&nbsp;&nbsp;<u>Eliminasi</u></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BAB</td>
				<td>:</td>
				<td>
					<input type="radio" name="bab" id="rad051" value="1"<?php getselect($arr['bab'],'1'); ?>><label for="rad051">Pola</label>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="bab" id="rad052" value="2"<?php getselect($arr['bab'],'2'); ?>><label for="rad052">Konstipasi</label>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="bab" id="rad053" value="3"<?php getselect($arr['bab'],'3'); ?>><label for="rad053">Diare</label>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BAK</td>
				<td>:</td>
				<td>
					<input type="radio" name="bak" id="rad061" value="1"<?php getselect($arr['bak'],'1'); ?>><label for="rad061">Normal</label>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="bak" id="rad062" value="2"<?php getselect($arr['bak'],'2'); ?>><label for="rad062">Tidak normal</label>
				</td>
			</tr>
			<tr>
				<td></td>
				<td style="vertical-align: top;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Catatan</td>
				<td style="vertical-align: top;">:</td>
				<td><textarea name="cateliminasi" style="width: 98%;"><?php echo $arr['cateliminasi']; ?></textarea></td>
			</tr>
			<tr>
				<td></td>
				<td>4.&nbsp;&nbsp;<u>Nyeri</u></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Keluhan nyeri</td>
				<td>:</td>
				<td>
					<input type="radio" name="keluhnyeri" id="rad071" value="1" onclick="paintable('0');"<?php getselect($arr['keluhnyeri'],'1'); ?>><label for="rad071">Tidak</label>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="keluhnyeri" id="rad072" value="2" onclick="paintable('1');"<?php getselect($arr['keluhnyeri'],'2'); ?>><label for="rad072">Ya (bila ya lakukan penilaian nyeri)</label>
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td>
					<table width="98%" class="hidtab" id="paintab">
						<tr>
							<td><img id="pain1" src="Image/pain1.png" onclick="painscale('0');">0</td>
							<td><img id="pain2" src="Image/pain2.png" onclick="painscale('2');">2</td>
							<td><img id="pain3" src="Image/pain3.png" onclick="painscale('4');">4</td>
							<td><img id="pain4" src="Image/pain4.png" onclick="painscale('6');">6</td>
							<td><img id="pain5" src="Image/pain5.png" onclick="painscale('8');">8</td>
							<td><img id="pain6" src="Image/pain6.png" onclick="painscale('10');">10</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Skala nyeri</td>
				<td>:</td>
				<td><input type="text" name="skalanyeri" id="skalanyeri" <?php echo "value='".$arr['skalanyeri']."'"; ?> readonly></td>
			</tr>
			<tr>
				<td></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lokasi</td>
				<td>:</td>
				<td><input type="text" name="lokasi" <?php echo "value='".$arr['lokasi']."'"; ?> id=""></td>
			</tr>
			<tr>
				<td></td>
				<td style="vertical-align: top;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Catatan</td>
				<td style="vertical-align: top;">:</td>
				<td><textarea name="catnyeri" style="width: 98%;"><?php echo $arr['catnyeri']; ?></textarea></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="3">5.&nbsp;&nbsp;<u>Mobilisasi dan Muskuloskeletal</u></td>
			</tr>
			<tr>
				<td></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mobilitas</td>
				<td>:</td>
				<td>
					<input type="radio" name="mobilitas" id="rad081" value="1"<?php getselect($arr['mobilitas'],'1'); ?>><label for="rad081">Mandiri</label>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="mobilitas" id="rad082" value="2"<?php getselect($arr['mobilitas'],'2'); ?>><label for="rad082">Dengan bantuan</label>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Motorik</td>
				<td>:</td>
				<td>
					<input type="radio" name="motorik" id="rad091" value="1"<?php getselect($arr['motorik'],'1'); ?>><label for="rad091">Tidak ada kelainan</label>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="motorik" id="rad092" value="2"<?php getselect($arr['motorik'],'2'); ?>><label for="rad092">Ada kelainan</label>
				</td>
			</tr>
			<tr>
				<td></td>
				<td style="vertical-align: top;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Catatan</td>
				<td style="vertical-align: top;">:</td>
				<td><textarea name="catmobilitas" style="width: 98%;"><?php echo $arr['catmobilitas']; ?></textarea></td>
			</tr>
			<tr>
				<td></td>
				<td>6.&nbsp;&nbsp;<u>Istirahat Tidur</u></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pola tidur</td>
				<td>:</td>
				<td>
					<input type="radio" name="polatidur" id="rad101" value="1"<?php getselect($arr['polatidur'],'1'); ?>><label for="rad101">Normal</label>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="polatidur" id="rad102" value="2"<?php getselect($arr['polatidur'],'2'); ?>><label for="rad102">Susah tidur</label>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Penggunaan obat tidur</td>
				<td>:</td>
				<td>
					<input type="radio" name="obattidur" id="rad111" value="1"<?php getselect($arr['obattidur'],'1'); ?>><label for="rad111">Tidak</label>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="obattidur" id="rad112" value="2"<?php getselect($arr['obattidur'],'2'); ?>><label for="rad112">Ya</label>
				</td>
			</tr>
			<tr>
				<td></td>
				<td style="vertical-align: top;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Catatan</td>
				<td style="vertical-align: top;">:</td>
				<td><textarea name="cattidur" style="width: 98%;"><?php echo $arr['cattidur']; ?></textarea></td>
			</tr>
			<tr>
				<td></td>
				<td>7.&nbsp;&nbsp;<u>Kebersihan Diri</u></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Penampilan secara &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;keseluruhan</td>
				<td>:</td>
				<td>
					<input type="radio" name="penampilan" id="rad121" value="1"<?php getselect($arr['penampilan'],'1'); ?>><label for="rad121">Bersih</label>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="penampilan" id="rad122" value="2"<?php getselect($arr['penampilan'],'2'); ?>><label for="rad122">Kotor</label>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pemenuhan kebersihan diri</td>
				<td>:</td>
				<td>
					<input type="radio" name="kebersihan" id="rad131" value="1"<?php getselect($arr['kebersihan'],'1'); ?>><label for="rad131">Mandiri</label>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="kebersihan" id="rad132" value="2"<?php getselect($arr['kebersihan'],'2'); ?>><label for="rad132">Dibantu</label>
				</td>
			</tr>
			<tr>
				<td></td>
				<td style="vertical-align: top;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Catatan</td>
				<td style="vertical-align: top;">:</td>
				<td><textarea name="catkebersihan" style="width: 98%;"><?php echo $arr['catkebersihan']; ?></textarea></td>
			</tr>
			<tr>
				<td></td>
				<td>8.&nbsp;&nbsp;<u>Psikososial</u></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yang dirasakan saat ini</td>
				<td>:</td>
				<td>
					<input type="radio" name="psikologi" id="rad141" value="1"<?php getselect($arr['psikologi'],'1'); ?>><label for="rad141">Siap untuk dilakukan tindakan</label>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="psikologi" id="rad142" value="2"<?php getselect($arr['psikologi'],'2'); ?>><label for="rad142">Takut / cemas</label>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Siapa yang berpengaruh <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;bagi pasien</td>
				<td>:</td>
				<td><input type="text" name="pengaruh" <?php echo "value='".$arr['pengaruh']."'"; ?>></td>
			</tr>
			<tr>
				<td></td>
				<td style="vertical-align: top;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Catatan</td>
				<td style="vertical-align: top;">:</td>
				<td><textarea name="catpsikologi" style="width: 98%;"><?php echo $arr['catpsikologi']; ?></textarea></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="3">9.&nbsp;&nbsp;<u>Resiko Jatuh (Morse Scale)</u></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="3">
					<!-- Table Morse Scale -->
					<table width="96%" border="1" style="margin-left: 2.5%;">       
						<tr>
							<td colspan="2" width="55%"><center><strong>KRITERIA PENILAIAN</strong></center></td>
							<td colspan="3" width="45%"><center><strong>PENILAIAN</strong></center></td>
						</tr>
						<tr>
							<td colspan="2"></td>
							<td class="midText"><strong>1</strong></td>
							<td class="midText"><strong>2</strong></td>
							<td class="midText"><strong>3</strong></td>
						</tr>
						<tr>
							<td rowspan="2" width="25%" style="vertical-align: top;">1. Riwayat Jatuh</td>
							<td>Ya</td>
							<td class="midText a11 col1 <?php getclass($arr2['a11'],'25'); ?>">25</td>
							<td class="midText a12 col2 <?php getclass($arr2['a12'],'25'); ?>">25</td>
							<td class="midText a13 col3 <?php getclass($arr2['a13'],'25'); ?>">25</td>
						</tr>
						<tr>
							<td>Tidak</td>
							<td class="midText a11 col1 <?php getclass($arr2['a11'],'0'); ?>">0</td>
							<td class="midText a12 col2 <?php getclass($arr2['a12'],'0'); ?>">0</td>
							<td class="midText a13 col3 <?php getclass($arr2['a13'],'0'); ?>">0</td>
						</tr>
						<tr>
							<td rowspan="2" style="vertical-align: top;">2. Diagnosa Sekunder</td>
							<td>Ya</td>
							<td class="midText a21 col1 <?php getclass($arr2['a21'],'15'); ?>">15</td>
							<td class="midText a22 col2 <?php getclass($arr2['a22'],'15'); ?>">15</td>
							<td class="midText a23 col3 <?php getclass($arr2['a23'],'15'); ?>">15</td>
						</tr>
						<tr>
							<td>Tidak</td>
							<td class="midText a21 col1 <?php getclass($arr2['a21'],'0'); ?>">0</td>
							<td class="midText a22 col2 <?php getclass($arr2['a22'],'0'); ?>">0</td>
							<td class="midText a23 col3 <?php getclass($arr2['a23'],'0'); ?>">0</td>
						</tr>
						<tr>
							<td rowspan="3" style="vertical-align: top;">3. Alat Bantu Jalan</td>
							<td>Benda sekitar</td>
							<td class="midText a31 col1 <?php getclass($arr2['a31'],'30'); ?>">30</td>
							<td class="midText a32 col2 <?php getclass($arr2['a32'],'30'); ?>">30</td>
							<td class="midText a33 col3 <?php getclass($arr2['a33'],'30'); ?>">30</td>
						</tr>
						<tr>
							<td>Tongkat / Walker / Kruk</td>
							<td class="midText a31 col1 <?php getclass($arr2['a31'],'15'); ?>">15</td>
							<td class="midText a32 col2 <?php getclass($arr2['a32'],'15'); ?>">15</td>
							<td class="midText a33 col3 <?php getclass($arr2['a33'],'15'); ?>">15</td>
						</tr>
						<tr>
							<td>Tidak Ada</td>
							<td class="midText a31 col1 <?php getclass($arr2['a31'],'0'); ?>">0</td>
							<td class="midText a32 col2 <?php getclass($arr2['a32'],'0'); ?>">0</td>
							<td class="midText a33 col3 <?php getclass($arr2['a33'],'0'); ?>">0</td>
						</tr>
						<tr>
							<td rowspan="2" style="vertical-align: top;">4. Dengan Infus</td>
							<td>Ya</td>
							<td class="midText a41 col1 <?php getclass($arr2['a41'],'20'); ?>">20</td>
							<td class="midText a42 col2 <?php getclass($arr2['a42'],'20'); ?>">20</td>
							<td class="midText a43 col3 <?php getclass($arr2['a43'],'20'); ?>">20</td>
						</tr>
						<tr>
							<td>Tidak</td>
							<td class="midText a41 col1 <?php getclass($arr2['a41'],'0'); ?>">0</td>
							<td class="midText a42 col2 <?php getclass($arr2['a42'],'0'); ?>">0</td>
							<td class="midText a43 col3 <?php getclass($arr2['a43'],'0'); ?>">0</td>
						</tr>
						<tr>
							<td rowspan="3" style="vertical-align: top;">5. Cara Berjalan</td>
							<td>Terganggu</td>
							<td class="midText a51 col1 <?php getclass($arr2['a51'],'20'); ?>">20</td>
							<td class="midText a52 col2 <?php getclass($arr2['a52'],'20'); ?>">20</td>
							<td class="midText a53 col3 <?php getclass($arr2['a53'],'20'); ?>">20</td>
						</tr>
						<tr>
							<td>Lemah</td>
							<td class="midText a51 col1 <?php getclass($arr2['a51'],'10'); ?>">10</td>
							<td class="midText a52 col2 <?php getclass($arr2['a52'],'10'); ?>">10</td>
							<td class="midText a53 col3 <?php getclass($arr2['a53'],'10'); ?>">10</td>
						</tr>
						<tr>
							<td>Normal</td>
							<td class="midText a51 col1 <?php getclass($arr2['a51'],'0'); ?>">0</td>
							<td class="midText a52 col2 <?php getclass($arr2['a52'],'0'); ?>">0</td>
							<td class="midText a53 col3 <?php getclass($arr2['a53'],'0'); ?>">0</td>
						</tr>
						<tr>
							<td rowspan="2" style="vertical-align: top;">6. Kondisi Mental</td>
							<td>Kurang mampu menilai</td>
							<td class="midText a61 col1 <?php getclass($arr2['a61'],'15'); ?>">15</td>
							<td class="midText a62 col2 <?php getclass($arr2['a62'],'15'); ?>">15</td>
							<td class="midText a63 col3 <?php getclass($arr2['a63'],'15'); ?>">15</td>
						</tr>
						<tr>
							<td>Mampu menilai secara penuh atau tidak sama sekali</td>
							<td class="midText a61 col1 <?php getclass($arr2['a61'],'0'); ?>">0</td>
							<td class="midText a62 col2 <?php getclass($arr2['a62'],'0'); ?>">0</td>
							<td class="midText a63 col3 <?php getclass($arr2['a63'],'0'); ?>">0</td>
						</tr>
						<tr>
							<td colspan="2" style="text-align: right; padding-right: 5px;">Total Nilai</td>
							<td class="midText tot1"><?php echo $arr['hidtot1']; ?></td><input type="hidden" name="hidtot1" id="hidtot1" value="">
							<td class="midText tot2"><?php echo $arr['hidtot2']; ?></td><input type="hidden" name="hidtot2" id="hidtot2" value="">
							<td class="midText tot3"><?php echo $arr['hidtot3']; ?></td><input type="hidden" name="hidtot3" id="hidtot3" value="">
						</tr>
						<tr>
							<td colspan="2" style="text-align: right; padding-right: 5px;">Kategori Resiko Jatuh</td>
							<td class="midText cat1"></td>
							<td class="midText cat2"></td>
							<td class="midText cat3"></td>
						</tr>
						<tr>
							<td colspan="2" style="text-align: right; padding-right: 5px;">Jam Periksa / Diperiksa Oleh</td>
							<td class="midText jam1"></td>
							<td class="midText jam2"></td>
							<td class="midText jam3"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="4">&nbsp;</td>
			</tr>
			<tr>
				<td></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Resiko Rendah (RR)</td>
				<td>:</td>
				<td>Total Nilai 0-24</td>
			</tr>
			<tr>
				<td></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Resiko Sedang (RS)</td>
				<td>:</td>
				<td>Total Nilai 25-44</td>
			</tr>
			<tr>
				<td></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Resiko Tinggi (RT)</td>
				<td>:</td>
				<td>Total Nilai 45-60</td>
			</tr>
			<tr>
				<td></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Resiko Ekstrim Tinggi (RET)</td>
				<td>:</td>
				<td>Total Nilai > 60</td>
			</tr>
			<tr>
				<td colspan="4">&nbsp;</td>
			</tr>
			<tr>
				<td></td>
				<td style="vertical-align: top;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Catatan</td>
				<td style="vertical-align: top;">:</td>
				<td><textarea name="catjatuh" style="width: 98%;"><?php echo $arr['catjatuh']; ?></textarea></td>
			</tr>
			<tr>
				<td></td>
				<td>10.<u>Edukasi</u></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Butuh Edukasi</td>
				<td>:</td>
				<td>
					<input type="radio" name="butuhedu" id="rad151" value="1"<?php getselect($arr['butuhedu'],'1'); ?>><label for="rad151">Tidak</label>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="butuhedu" id="rad152" value="2"<?php getselect($arr['butuhedu'],'2'); ?>><label for="rad152">Ya,(bila Ya, gunakan formulir "Pemberian Edukasi")</label>
				</td>
			</tr>
			<tr>
				<td></td>
				<td style="vertical-align: top;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Catatan</td>
				<td style="vertical-align: top;">:</td>
				<td><textarea name="catedukasi" style="width: 98%;"><?php echo $arr['catedukasi']; ?></textarea></td>
			</tr>
				<td></td>
				<td>11.<u>Spiritual</u></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nilai-nilai khusus yang di &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;anut</td>
				<td>:</td>
				<td>
					<input type="radio" name="nilai2" id="rad161" value="1"<?php getselect($arr['nilai2'],'1'); ?>><label for="rad161">Tidak</label>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="nilai2" id="rad162" value="2"<?php getselect($arr['nilai2'],'2'); ?>><label for="rad162">Ya</label>
				</td>
			</tr>
			<tr>
				<td></td>
				<td style="vertical-align: top;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Catatan</td>
				<td style="vertical-align: top;">:</td>
				<td><textarea name="catspirit" style="width: 98%;"><?php echo $arr['catspirit']; ?></textarea></td>
			</tr>
				<td></td>
				<td>12.<u>Temuan Lain</u></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<textarea style="width:95%;" name="temuan"><?php echo $arr['temuan']; ?></textarea></td>
			</tr>
		</table>
		<input type="hidden" id="a11" name="a11" <?php echo 'value="'.$arr2['a11'].'"'; ?>>
		<input type="hidden" id="a12" name="a12" <?php echo 'value="'.$arr2['a12'].'"'; ?>>
		<input type="hidden" id="a13" name="a13" <?php echo 'value="'.$arr2['a13'].'"'; ?>>
		<input type="hidden" id="a21" name="a21" <?php echo 'value="'.$arr2['a21'].'"'; ?>>
		<input type="hidden" id="a22" name="a22" <?php echo 'value="'.$arr2['a22'].'"'; ?>>
		<input type="hidden" id="a23" name="a23" <?php echo 'value="'.$arr2['a23'].'"'; ?>>
		<input type="hidden" id="a31" name="a31" <?php echo 'value="'.$arr2['a31'].'"'; ?>>
		<input type="hidden" id="a32" name="a32" <?php echo 'value="'.$arr2['a32'].'"'; ?>>
		<input type="hidden" id="a33" name="a33" <?php echo 'value="'.$arr2['a33'].'"'; ?>>
		<input type="hidden" id="a41" name="a41" <?php echo 'value="'.$arr2['a41'].'"'; ?>>
		<input type="hidden" id="a42" name="a42" <?php echo 'value="'.$arr2['a42'].'"'; ?>>
		<input type="hidden" id="a43" name="a43" <?php echo 'value="'.$arr2['a43'].'"'; ?>>
		<input type="hidden" id="a51" name="a51" <?php echo 'value="'.$arr2['a51'].'"'; ?>>
		<input type="hidden" id="a52" name="a52" <?php echo 'value="'.$arr2['a52'].'"'; ?>>
		<input type="hidden" id="a53" name="a53" <?php echo 'value="'.$arr2['a53'].'"'; ?>>
		<input type="hidden" id="a61" name="a61" <?php echo 'value="'.$arr2['a61'].'"'; ?>>
		<input type="hidden" id="a62" name="a62" <?php echo 'value="'.$arr2['a62'].'"'; ?>>
		<input type="hidden" id="a63" name="a63" <?php echo 'value="'.$arr2['a63'].'"'; ?>>
  </form>
  <table width="832" class="botTable">
  	<tr>
  		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*Digunakan hanya untuk  pasien yang langsung ke Pusat Dialisa)</td>
  	</tr>
  </table>

<script type="text/javascript">

	$(".off").click(function(){
		var classList = $(this).attr('class').split(/\s+/);
		var target1 = '.'+classList['1'];
		var target2 = '#'+classList['1'];
		var targetval = $(this).html();

		if(classList[3] == 'on'){
			$(this).removeClass( "on" ).addClass( "off" );
			$(target2).val('');
		}else{
			$(target1).removeClass( "on" ).addClass( "off" );
			$(target2).val(targetval);
			$(this).removeClass( "off" ).addClass( "on" );	
		}
		
		getTotal(classList['2']);
		
	});

	$(".on").click(function(){
		var classList = $(this).attr('class').split(/\s+/);
		var target1 = '.'+classList['1'];
		var target2 = '#'+classList['1'];
		var targetval = $(this).html();

		if(classList[3] == 'on'){
			$(this).removeClass( "on" ).addClass( "off" );
			$(target2).val('');
		}else{
			$(target1).removeClass( "on" ).addClass( "off" );
			$(target2).val(targetval);
			$(this).removeClass( "off" ).addClass( "on" );	
		}
		
		getTotal(classList['2']);
		
	});

	function getTotal(col){
		var kolom = '.'+col;
		var hasil = '.tot'+col.substring(3);
		var hidhasil = '#hidtot'+col.substring(3);
		var kategori = '.cat'+col.substring(3);
		var total = 0;
		var flag = '';
		$.each($(kolom),function(){
			if($(this).hasClass('on')){
				total = parseInt(total) + parseInt($(this).html(), 10);
				flag = 'X';
			}
		});

		if(flag == 'X'){
			$(hasil).html(total);
			$(hidhasil).val(total);

			if(total > 60){
				$(kategori).html('RET');
			}else if(total >= 45){
				$(kategori).html('RT');
			}else if(total >= 25){
				$(kategori).html('RS');
			}else{
				$(kategori).html('RR');
			}
		}else{
			$(hasil).html('');
			$(hidhasil).val('');
			$(kategori).html('');
		}

		
	}

	function paintable(x){
		if(x == '0'){
			document.getElementById('paintab').style.display = "none";
			document.getElementById('skalanyeri').value = '';
		}else if(x == '1'){
			document.getElementById('paintab').style.display = "block";
		}
	}

	function painscale(x){
		document.getElementById('skalanyeri').value = x;
	}

	getTotal('col1');
	getTotal('col2');
	getTotal('col3');
</script>

<?php
	if($arr['keluhnyeri'] == '2'){
		echo "<script>
						document.getElementById('paintab').style.display = 'block';	
					</script>";
	}
?>
</body>
</html>
