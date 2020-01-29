</!DOCTYPE html>
<html>
<head>
	<title>Catatan Keperawatan Hemodialisis</title>
	<div>
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
			}
			textarea{
				resize: vertical;
				vertical-align: top;
			}
			.vtop{
				vertical-align: top;
			}
		</style>
		<link rel="stylesheet" href="css/jquery-ui.min.css">
	</div>
	
	<script src="js/jquery-1.7.2.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>

	<script>
	  $( function() {
		$( ".datepicker" ).datepicker();
		$( ".datepicker" ).datepicker( "option", "dateFormat", 'dd/mm/yy' );
	  } );
	</script>

	<?php
		function getselect($x,$y){
			if($x == $y){
				echo "checked";
			}	
		}
		function getcheck($x){
			if(trim($x) != ""){
				echo "checked";
			}	
		}
		function setclass($x){
			if(trim($x) == ""){
				echo "hid1";
			}	
		}
	?>
</head>
<body>
	<?php
		include "koneksi.php";
		// session_start();
		date_default_timezone_set("Asia/Bangkok");
		session_start();

		$form = array("Alergi"=>"", "Keluhan_Datang"=>"", "Cara_Datang"=>"1", "Status_Pat"=>"1", "Tgl_Dtng1"=>"", "Frekwensi"=>"1", "Surat_Persetujuan"=>"1", "HbsAg"=>"1", "HIV"=>"1", "HCV"=>"1", "Kesadaran"=>"1", "Kulit"=>"1", "Hub_Sirkulasi1"=>"1", "Cat_Sirkulasi1"=>"", "Mata"=>"1", "E_Muka"=>"", "E_Tangan"=>"", "E_Perut"=>"", "E_Paru"=>"", "E_MKaki"=>"", "E_PKaki"=>"", "AB_Telinga"=>"", "AB_Mata"=>"", "AB_Gigi"=>"", "AB_Tangan"=>"", "AB_Kaki"=>"", "Keistimewaan"=>"", "Dosis_Awal"=>"1", "Lanjutkan"=>"", "Protamin"=>"1", "Dialiser"=>"1", "Total_Vol"=>"", "Priming_Vol"=>"", "Sisa_Priming"=>"", "Dialisat"=>"1", "Priming"=>"", "Bilas"=>"", "radio41"=>"on", "Transfusi"=>"", "radio43"=>"on", "Infus"=>"", "radio45"=>"on", "Sonde"=>"", "radio47"=>"on", "Minum"=>"", "Total_Intake"=>"", "Makan"=>"", "Urine"=>"", "CMS"=>"", "UF"=>"", "Total_Output"=>"", "Balance"=>"", "BB_Standart"=>"", "BB_Dial"=>"", "BB_Datang"=>"", "BB_Tarik"=>"", "BB_Pulang"=>"", "Tinggi"=>"", "Hub_Sirkulasi2"=>"1", "Cat_Sirkulasi2"=>"", "Dial_Ke"=>"", "Kode_Mesin"=>"", "No_Kamar"=>"", "CONNA"=>"", "COND"=>"", "Jam_Mulai"=>"", "Jam_Selesai"=>"", "Pendarahan"=>"1", "Tindakan"=>"", "Keluhan_Pulang"=>"", "KTV"=>"", "Lain"=>"");


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

		$queform = "Select * from F_HD01_01 where Pat_No = ".$patno." and Case_No = ".$caseno;
		$queform_exe = sqlsrv_query($conn,$queform);
		$form1 = sqlsrv_fetch_array($queform_exe, SQLSRV_FETCH_ASSOC);

		$mode = "insert";
		if(!empty($form1)){
			$mode = "update";

			foreach ($form1 as $key => $value) {
				$form[$key] = $value;
			}
		}



	?>
<form action="F_HD01_Save.php" method="post">
	<button type="submit" class="btn" >Save Form</button>
	<button type="button" class="btn" onclick="window.location.href = 'T_Case.php?case=<?php echo $caseno; ?>';">Back</button>
		<br><br>
	<!-- Hidden input for post data -->
	<input type="hidden" name="mode" value="<?php echo $mode; ?>" >

	<input type="hidden" name="Pat_No" value="<?php echo $patno; ?>">
	<input type="hidden" name="Case_No" value="<?php echo $caseno; ?>">
	<input type="hidden" name="Pat_Name" value="<?php echo $pat['Pat_Name']; ?>" >
	<input type="hidden" name="DOB" value="<?php echo $pat['Pat_DOB']->format('Y-m-d'); ?>" >
	<input type="hidden" name="Sex" value="<?php echo $pat['Pat_Sex']; ?>" >
	<input type="hidden" name="Doctor_Id" value="<?php echo $doctorid; ?>" >
	<input type="hidden" name="Doctor_Name" value="<?php echo $dok['Name']; ?>" >
	<input type="hidden" name="Tgl_Datang" value="<?php echo $pat['Case_Date']->format('Y-m-d'); ?>" >
	<!-- ============================== -->

	<table width="832" id="header">
		<tr>
			<td width="50%">
				<center>
					<p><img src="image/logo.png" width="200px"></p>
					<p>CATATAN KEPERAWATAN HEMODIALISIS </p>
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
							if(strlen($dok['Name']) >= 27)
							{
								echo substr($dok['Name'], 0, 27)." / ".$doctorid;
							}else{
								echo $dok['Name']." / ".$doctorid;
							}				 
							?></td>
					</tr>
					<tr>
						<td>Tgl. Datang</td>
						<td>:</td>
						<td id="datevisit"><?php echo $pat['Case_Date']->format('d-m-Y'); ?></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">Dokter Penanggung Jawab Pelayanan : <strong><?php echo $dok['Name']; ?></strong></td>
		</tr>
		<tr>
			<td colspan="2">Alergi : <textarea name="Alergi" maxlength="250" style="width: 92%;"><?php echo $form['Alergi']; ?></textarea></td>
		</tr>
	</table>
	<table width="832" class="midTable">
		<tr>
			<td colspan="3">&nbsp;&nbsp;&nbsp;<strong>INFORMASI UMUM </strong></td>
		</tr>
		<tr>
			<td width="250" class="vtop">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Keluhan Saat Datang </td>
			<td width="10" class="vtop">: </td>
			<td><textarea name="Keluhan_Datang" style="width: 98%;"><?php echo $form['Keluhan_Datang']; ?></textarea></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cara Datang </td>
			<td>: </td>
			<td>
				<input name="Cara_Datang" type="radio" id="radio" value="1" <?php getselect($form['Cara_Datang'],'1'); ?>>
				<label for="radio">Jalan Kaki</label>&nbsp;&nbsp;&nbsp;

				<input type="radio" name="Cara_Datang" id="radio2" value="2" <?php getselect($form['Cara_Datang'],'2'); ?>>
				<label for="radio2">Kursi Roda</label>&nbsp;&nbsp;&nbsp;

				<input type="radio" name="Cara_Datang" id="radio3" value="3" <?php getselect($form['Cara_Datang'],'3'); ?>>
				<label for="radio3">Tempat Tidur / Strecher</label>
			</td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status Pasien </td>
			<td>: </td>
			<td>
				<input name="Status_Pat" type="radio" id="radio4" value="1" <?php getselect($form['Status_Pat'],'1'); ?>>
				<label for="radio4">Rawat Inap</label>&nbsp;&nbsp;&nbsp;

				<input type="radio" name="Status_Pat" id="radio5" value="2" <?php getselect($form['Status_Pat'],'2'); ?>>
				<label for="radio5">Rawat Jalan</label>&nbsp;&nbsp;&nbsp;

				<input type="radio" name="Status_Pat" id="radio6" value="3" <?php getselect($form['Status_Pat'],'3'); ?>>
				<label for="radio6">Tulis</label>&nbsp;&nbsp;&nbsp;

				<input type="radio" name="Status_Pat" id="radio7" value="4" <?php getselect($form['Status_Pat'],'4'); ?>>
				<label for="radio7">Rujukan</label>
			</td>
		</tr>
		<?php
			$appdat = "";
			if(isset($form['Tgl_Dtng1']) && $form['Tgl_Dtng1'] != "")
				{$appdat = $form['Tgl_Dtng1']->format('m/d/Y');}
		?>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dialisa Pertama </td>
			<td>: </td>
			<td><input type="text" class="datepicker" name="Tgl_Dtng1" id="dial1" value="<?php echo $appdat; ?>" ></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Frekwensi Dialisa / Minggu</td>
			<td>: </td>
			<td>
				<input name="Frekwensi" type="radio" id="radio8" value="1" <?php getselect($form['Frekwensi'],'1'); ?>>
				<label for="radio8">1 X</label>&nbsp;&nbsp;&nbsp;

				<input type="radio" name="Frekwensi" id="radio9" value="2" <?php getselect($form['Frekwensi'],'2'); ?>>
				<label for="radio9">2 X</label>&nbsp;&nbsp;&nbsp;

				<input type="radio" name="Frekwensi" id="radio10" value="3" <?php getselect($form['Frekwensi'],'3'); ?>>
				<label for="radio10">3 X</label>
			</td>
		</tr>
		<tr>
			<td class="vtop">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Surat Persetujuan<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tindakan Kedokteran </td>
			<td class="vtop">: </td>
			<td class="vtop">
				<input name="Surat_Persetujuan" type="radio" id="radio11" value="1" <?php getselect($form['Surat_Persetujuan'],'1'); ?>>
				<label for="radio11">Tidak</label>&nbsp;&nbsp;&nbsp;

				<input type="radio" name="Surat_Persetujuan" id="radio12" value="2" <?php getselect($form['Surat_Persetujuan'],'2'); ?>>
				<label for="radio12">Ya</label>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;&nbsp;&nbsp;<strong>HASIL LABORATORIUM </strong></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HbsAg </td>
			<td>:</td>
			<td>
				<input name="HbsAg" type="radio" id="radio13" value="1" <?php getselect($form['HbsAg'],'1'); ?>>
				<label for="radio13">Negatif</label>&nbsp;&nbsp;&nbsp;

				<input type="radio" name="HbsAg" id="radio14" value="2" <?php getselect($form['HbsAg'],'2'); ?>>
				<label for="radio14">Positif</label>
			</td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Anti HIV </td>
			<td>:</td>
			<td>
				<input name="HIV" type="radio" id="radio15" value="1" <?php getselect($form['HIV'],'1'); ?>>
				<label for="radio15">Negatif</label>&nbsp;&nbsp;&nbsp;

				<input type="radio" name="HIV" id="radio16" value="2" <?php getselect($form['HIV'],'2'); ?>>
				<label for="radio16">Positif</label>
			</td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Anti HCV </td>
			<td>:</td>
			<td>
				<input name="HCV" type="radio" id="radio17" value="1" <?php getselect($form['HCV'],'1'); ?>>
				<label for="radio17">Negatif</label>&nbsp;&nbsp;&nbsp;

				<input type="radio" name="HCV" id="radio18" value="2" <?php getselect($form['HCV'],'2'); ?>>
				<label for="radio18">Positif</label>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;<strong>PEMERIKSAAN FISIK </strong></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kesadaran </td>
			<td>:</td>
			<td>
				<input name="Kesadaran" type="radio" id="radio19" value="1" <?php getselect($form['Kesadaran'],'1'); ?>>
				<label for="radio19">Sadar Betul</label>&nbsp;&nbsp;&nbsp;

				<input type="radio" name="Kesadaran" id="radio20" value="2" <?php getselect($form['Kesadaran'],'2'); ?>>
				<label for="radio20">Apatis</label>&nbsp;&nbsp;&nbsp;

				<input type="radio" name="Kesadaran" id="radio21" value="3" <?php getselect($form['Kesadaran'],'3'); ?>>
				<label for="radio21">Mengantuk</label>&nbsp;&nbsp;&nbsp;

				<input type="radio" name="Kesadaran" id="radio22" value="4" <?php getselect($form['Kesadaran'],'4'); ?>>
				<label for="radio22">Koma</label>
			</td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kondisi Kulit </td>
			<td>:</td>
			<td>
				<input name="Kulit" type="radio" id="radio23" value="1" <?php getselect($form['Kulit'],'1'); ?>>
				<label for="radio23">Sehat</label>&nbsp;&nbsp;&nbsp;

				<input type="radio" name="Kulit" id="radio24" value="2" <?php getselect($form['Kulit'],'2'); ?>>
				<label for="radio24">Bercak-bercak</label>&nbsp;&nbsp;&nbsp;

				<input type="radio" name="Kulit" id="radio25" value="3" <?php getselect($form['Kulit'],'3'); ?>>
				<label for="radio25">Kemerahan</label>&nbsp;&nbsp;&nbsp;

				<input type="radio" name="Kulit" id="radio26" value="4" <?php getselect($form['Kulit'],'4'); ?>>
				<label for="radio26">Kusam</label>
			</td>
		</tr>
		<tr>
			<td class="vtop">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hubungan Sirkulasi </td>
			<td class="vtop">:</td>
			<td>
				<input name="Hub_Sirkulasi1" type="radio" class="no" id="radio27" value="1" <?php getselect($form['Hub_Sirkulasi1'],'1'); ?>>
				<label for="radio27">Cimino</label>&nbsp;&nbsp;&nbsp;

				<input type="radio" name="Hub_Sirkulasi1" class="no" id="radio28" value="2" <?php getselect($form['Hub_Sirkulasi1'],'2'); ?>>
				<label for="radio28">CDL/CTL</label><br>

				<input type="radio" name="Hub_Sirkulasi1" class="yes" id="radio29" value="3" <?php getselect($form['Hub_Sirkulasi1'],'3'); ?>>
				<label for="radio29">Lain-lain,</label>

				<input type="text" name="Cat_Sirkulasi1" class="hid <?php setclass($form['Cat_Sirkulasi2']); ?>" value="<?php echo $form['Cat_Sirkulasi1']; ?>">
			</td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mata </td>
			<td>:</td>
			<td>
				<input name="Mata" type="radio" id="radio30" value="1" <?php getselect($form['Mata'],'1'); ?>>
				<label for="radio30">Sklera Ikterik</label>&nbsp;&nbsp;&nbsp;

				<input type="radio" name="Mata" id="radio31" value="2" <?php getselect($form['Mata'],'2'); ?>>
				<label for="radio31">Conjunctiva Anemik</label>
			</td>
		</tr>
		<tr>
			<td class="vtop">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Edema </td>
			<td class="vtop">:</td>
			<td>
				<input type="checkbox" name="E_Muka" id="checkbox" value="X" <?php getselect($form['E_Muka'],'X'); ?>>
				<label for="checkbox">Muka</label>&nbsp;&nbsp;

				<input type="checkbox" name="E_Tangan" id="checkbox2" value="X" <?php getselect($form['E_Tangan'],'X'); ?>>
				<label for="checkbox2">Tangan</label>&nbsp;&nbsp;

				<input type="checkbox" name="E_Perut" id="checkbox3" value="X" <?php getselect($form['E_Perut'],'X'); ?>>
				<label for="checkbox3">Perut</label>&nbsp;&nbsp;

				<input type="checkbox" name="E_Paru" id="checkbox4" value="X" <?php getselect($form['E_Paru'],'X'); ?>>
				<label for="checkbox4">Paru-paru</label><br>

				<input type="checkbox" name="E_MKaki" id="checkbox5" value="X" <?php getselect($form['E_MKaki'],'X'); ?>>
				<label for="checkbox5">Mata Kaki</label>&nbsp;&nbsp;

				<input type="checkbox" name="E_PKaki" id="checkbox6" value="X" <?php getselect($form['E_PKaki'],'X'); ?>>
				<label for="checkbox6">Punggung Kaki</label>
			</td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Alat Bantu </td>
			<td>:</td>
			<td>
				<input type="checkbox" name="AB_Telinga" id="checkbox7" value="X" <?php getselect($form['AB_Telinga'],'X'); ?>>
				<label for="checkbox7">Telinga</label>&nbsp;&nbsp;

				<input type="checkbox" name="AB_Mata" id="checkbox8" value="X" <?php getselect($form['AB_Mata'],'X'); ?>>
				<label for="checkbox8">Mata</label>&nbsp;&nbsp;

				<input type="checkbox" name="AB_Gigi" id="checkbox9" value="X" <?php getselect($form['AB_Gigi'],'X'); ?>>
				<label for="checkbox9">Gigi</label>&nbsp;&nbsp;

				<input type="checkbox" name="AB_Tangan" id="checkbox10" value="X" <?php getselect($form['AB_Tangan'],'X'); ?>>
				<label for="checkbox10">Tangan</label>&nbsp;&nbsp;

				<input type="checkbox" name="AB_Kaki" id="checkbox11" value="X" <?php getselect($form['AB_Kaki'],'X'); ?>>
				<label for="checkbox11">Kaki</label>
			</td>
		</tr>
		<tr hidden>
			<td class="vtop">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Keistimewaan Pasien </td>
			<td class="vtop">:</td>
			<td>
				<textarea name="Keistimewaan" style="width: 98%;"><?php echo $form['Keistimewaan']; ?></textarea>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;<strong>HEPARINISASI </strong></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dosis Awal </td>
			<td>:</td>
			<td>
				<input name="Dosis_Awal" type="radio" id="radio32" value="1" <?php getselect($form['Dosis_Awal'],'1'); ?>>
				<label for="radio32">Tidak</label>&nbsp;&nbsp;&nbsp;

				<input type="radio" name="Dosis_Awal" id="radio33" value="2" <?php getselect($form['Dosis_Awal'],'2'); ?>>
				<label for="radio33">Ya</label>
			</td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lanjutkan </td>
			<td>:</td>
			<td>
				<input name="Lanjutkan" type="text" class="short" id="heparlanjut" value="<?php echo $form['Lanjutkan']; ?>"> U'
			</td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Protamin </td>
			<td>:</td>
			<td>
				<input name="Protamin" type="radio" id="radio34" value="1" <?php getselect($form['Protamin'],'1'); ?>>
				<label for="radio34">Tidak</label>&nbsp;&nbsp;&nbsp;

				<input type="radio" name="Protamin" id="radio35" value="2" <?php getselect($form['Protamin'],'2'); ?>>
				<label for="radio35">Ya</label>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;<strong>DIALISER</strong>&nbsp;</td>
			<td>:</td>
			<td>
				<input name="Dialiser" type="radio" id="radio36" value="1" <?php getselect($form['Dialiser'],'1'); ?>>
				<label for="radio36">Baru </label>&nbsp;&nbsp;&nbsp;

				<input type="radio" name="Dialiser" id="radio37" value="2" <?php getselect($form['Dialiser'],'2'); ?>>
				<label for="radio37">Pakai Ulang(Reuse) </label>&nbsp;&nbsp;&nbsp;

				<input type="radio" name="Dialiser" id="radio38" value="3" <?php getselect($form['Dialiser'],'3'); ?>>
				<label for="radio38">Code </label>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td></td>
			<td>
				<label for="textfield">Total Volume:</label>
				<input name="Total_Vol" type="text" class="short" id="totalvol"> ml,&nbsp;&nbsp;&nbsp;

				<label for="textfield2">Priming Volume:</label>
				<input name="Priming_Vol" type="text" class="short" id="primvol"> ml,<br>

				<label for="textfield3">Sisa Priming:</label>
				<input name="Sisa_Priming" type="text" class="short" id="sisaprim"> ml
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;<strong>DIALISAT </strong></td>
			<td>:</td>
			<td>
				<input name="Dialisat" type="radio" id="radio39" value="1" <?php getselect($form['Dialisat'],'1'); ?>>
				<label for="radio39">Asetat </label>&nbsp;&nbsp;&nbsp;

				<input type="radio" name="Dialisat" id="radio40" value="2" <?php getselect($form['Dialisat'],'2'); ?>>
				<label for="radio40">Bikarbonat </label>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;<strong>INTAKE </strong></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Priming </td>
			<td>:</td>
			<td>
				<input name="Priming" type="text" class="short" id="textfield"> ml, 
				Bilas (Wash Out) : <input name="Bilas" type="text" class="short" id="textfield"> ml 
			</td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Transfusi </td>
			<td>:</td>
			<td>
				<input name="radio41" type="radio" id="radio41" class="no" checked>
				<label for="radio41">Tidak </label>&nbsp;&nbsp;&nbsp;

				<input type="radio" name="radio41" id="radio42" class="yes" <?php getcheck($form['Transfusi']); ?>>
				<label for="radio42">Ya </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

				, bila ya&nbsp;&nbsp;&nbsp;<input type="text" class="short hid <?php setclass($form['Transfusi']); ?>" name="Transfusi" id="Transfusi" value="<?php echo $form['Transfusi']; ?>"><label class="<?php setclass($form['Transfusi']); ?>" for="Transfusi"> cc</label>
			</td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Infus </td>
			<td>:</td>
			<td>
				<input name="radio43" type="radio" id="radio43" class="no" checked="checked">
				<label for="radio43">Tidak </label>&nbsp;&nbsp;&nbsp;

				<input type="radio" name="radio43" id="radio44" class="yes" <?php getcheck($form['Infus']); ?>>
				<label for="radio44">Ya </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

				, bila ya&nbsp;&nbsp;&nbsp;<input type="text" class="short hid <?php setclass($form['Infus']); ?>" name="Infus" id="Infus" value="<?php echo $form['Infus']; ?>"><label class="<?php setclass($form['Infus']); ?>" for="Infus"> cc</label>
			</td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sonde/Makan </td>
			<td>:</td>
			<td>
				<input name="radio45" type="radio" id="radio45" class="no" checked="checked">
				<label for="radio45">Tidak </label>&nbsp;&nbsp;&nbsp;

				<input type="radio" name="radio45" id="radio46" class="yes" <?php getcheck($form['Sonde']); ?>>
				<label for="radio46">Ya </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

				, bila ya&nbsp;&nbsp;&nbsp;<input type="text" class="short hid <?php setclass($form['Sonde']); ?>" name="Sonde" id="Sonde" value="<?php echo $form['Sonde']; ?>"><label class="<?php setclass($form['Sonde']); ?>" for="Sonde"> cc</label>
			</td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Minum </td>
			<td>:</td>
			<td>
				<input name="radio47" type="radio" id="radio47" class="no" checked="checked">
				<label for="radio47">Tidak </label>&nbsp;&nbsp;&nbsp;

				<input type="radio" name="radio47" id="radio48" class="yes" <?php getcheck($form['Minum']); ?>>
				<label for="radio48">Ya </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

				, bila ya&nbsp;&nbsp;&nbsp;<input type="text" class="short hid <?php setclass($form['Minum']); ?>" name="Minum" id="Minum" value="<?php echo $form['Minum']; ?>"><label class="<?php setclass($form['Minum']); ?>" for="Minum"> cc</label>
			</td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;TOTAL</td>
			<td>:</td>
			<td>
				<input name="Total_Intake" type="text" class="short" value="<?php echo $form['Total_Intake']; ?>"> ml + Makan
				<input type="text" class="short" name="Makan" value="<?php echo $form['Makan']; ?>"> Porsi
			</td>
		</tr>
		<tr>
			<td class="vtop">&nbsp;&nbsp;&nbsp;<strong>Output </strong></td>
			<td class="vtop">:</td>
			<td>
				Urine : <input type="text" class="short" name="Urine" value="<?php echo $form['Urine']; ?>"> ml, 
				Muntah / CMS : <input type="text" class="short" name="CMS" value="<?php echo $form['CMS']; ?>"> ml, <br>
				UF : <input type="text" class="short" name="UF" value="<?php echo $form['UF']; ?>"> ml, 
				TOTAL : <input type="text" class="short" name="Total_Output" value="<?php echo $form['Total_Output']; ?>"> ml 
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;<strong>BALANS</strong>&nbsp;</td>
			<td>:</td>
			<td>
				<input name="Balance" type="text" class="short" value="<?php echo $form['Balance']; ?>"> ml 
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;<strong>PENGAMATAN</strong>&nbsp;</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td class="vtop">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Berat Badan (BB) </td>
			<td class="vtop">:</td>
			<td>
				<label for="textfield4">Standar :</label>
				<input name="BB_Standart" type="text" class="short" value="<?php echo $form['BB_Standart']; ?>"> Kg&nbsp;&nbsp;&nbsp;

				<label for="textfield5">Dialisa Terakhir : </label>
				<input name="BB_Dial" type="text" class="short" value="<?php echo $form['BB_Dial']; ?>"> Kg<br>

				<label for="textfield6">Datang : </label>
				<input name="BB_Datang" type="text" class="short" value="<?php echo $form['BB_Datang']; ?>"> Kg&nbsp;&nbsp;&nbsp;

				<label for="textfield7">Tarik Air :</label>
				<input name="BB_Tarik" type="text" class="short" value="<?php echo $form['BB_Tarik']; ?>"> Kg&nbsp;&nbsp;&nbsp;

				<label for="textfield8">Pulang :</label>
				<input name="BB_Pulang" type="text" class="short" value="<?php echo $form['BB_Pulang']; ?>"> Kg 
			</td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tinggi Badan </td>
			<td>:</td>
			<td>
				<input name="Tinggi" type="text" class="short" value="<?php echo $form['Tinggi']; ?>"> Cm 
			</td>
		</tr>
		<tr>
			<td class="vtop">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hubungan Sirkulasi </td>
			<td class="vtop">:</td>
			<td>
				<input name="Hub_Sirkulasi2" type="radio" class="no" id="radio49" value="1" <?php getselect($form['Hub_Sirkulasi2'],'1'); ?>>
				<label for="radio49">Cimino </label>&nbsp;&nbsp;&nbsp; 

				<input type="radio" name="Hub_Sirkulasi2" class="no" id="radio50" value="2" <?php getselect($form['Hub_Sirkulasi2'],'2'); ?>>
				<label for="radio50">CDL/CTL </label><br>

				<input type="radio" name="Hub_Sirkulasi2" class="yes" id="radio51" value="3" <?php getselect($form['Hub_Sirkulasi2'],'3'); ?>>
				<label for="radio51">Lain-lain, </label>

				<input type="text" name="Cat_Sirkulasi2" class="hid <?php setclass($form['Cat_Sirkulasi2']); ?>" value="<?php echo $form['Cat_Sirkulasi2']; ?>">
			</td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dialisa Ke </td>
			<td>:</td>
			<td>
				<input type="text" class="short" name="Dial_Ke" value="<?php echo $form['Dial_Ke']; ?>">&nbsp;&nbsp;&nbsp;

				<label for="textfield10">Nomor Mesin :</label>
				<input name="Kode_Mesin" type="text" class="short" id="textfield10" value="<?php echo $form['Kode_Mesin']; ?>">&nbsp;&nbsp;&nbsp;

				<label for="textfield11">No. Bed:</label>
				<input name="No_Kamar" type="text" class="short" id="textfield11" value="<?php echo $form['No_Kamar']; ?>">
			</td>
		</tr>
	</table>
  <?php
	if($mode != 'insert'){
		$queTab2 = "Select * from F_HD01_02 where Case_No = ".$caseno." Order By Jam";
		$queTab2_exe = sqlsrv_query($conn,$queTab2);
	}
  ?>
  <table width="832" class="midTable allBorder inputTab" id="table1">
	  <tr style="padding:5px;">
		<td width="6%" style="border:0;padding:15px;">&nbsp;</td>
		<td colspan="4" style="border:0;padding:15px;"><strong>INSTRUKSI DOKTER :</strong></td>
	  </tr>
	  <tr style="text-align:center;">
		<td>&nbsp;</td>
		<td width="10%">Jam</td>
		<td>Instruksi Dokter</td>
		<td width="17%">Dokter</td>
		<td width="17%">Perawat</td>
	  </tr>
	  <?php
	  if(isset($queTab2_exe)){
		while($tab2 = sqlsrv_fetch_array($queTab2_exe, SQLSRV_FETCH_ASSOC)){
			$seq = "";
			$jam = "";
			$instruksi= "";
			$dokter = "";
			$perawat = "";

			if(isset($tab2)){
				$seq = $tab2['ID'];
				$jam = $tab2['Jam']->format('H:i');
				$instruksi = $tab2['Instruksi'];
				$dokter = $tab2['Dokter'];
				$perawat = $tab2['Perawat'];
			}

			echo "
				<tr>
					<td><input type='button' class='editRow1' value='Edit'></td>
					<td>".$jam."</td>
					<td>".$instruksi."</td>
					<td>".$dokter."</td>
					<td>".$perawat."</td>
					<td hidden>".$seq."</td>
				</tr>
			";
		}
	  }
	  ?>
	  <tr>
		<td><input type="button" value="Add" onClick="addTab1();"></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	  </tr>
	</table>
	<?php
		if($mode != 'insert'){
			$queTab3 = "Select * from F_HD01_03 where Case_No = ".$caseno." Order By Jam";
			$queTab3_exe = sqlsrv_query($conn,$queTab3);
		}
	?>
	<table width="832" class="midTable allBorder inputTab" id="table2">
	  <tr>
		<td colspan="7" style="border:0;">&nbsp;</td>
	  </tr>
	  <tr>
		<td width="6%" style="border:0;">&nbsp;</td>
		<td colspan="6" style="border:0;padding-left:15px;"><strong>SEBELUM - DIALISIS</strong></td>
	  </tr>
	  <tr style="text-align:center;">
		<td>&nbsp;</td>
		<td width="10%">Jam</td>
		<td width="9%">Tensi</td>
		<td width="6%">Nadi</td>
		<td width="6%">Resp</td>
		<td width="6%">Suhu</td>
		<td>Keterangan</td>
	  </tr>
	  <?php
	  if(isset($queTab3_exe)){
		while($tab3 = sqlsrv_fetch_array($queTab3_exe, SQLSRV_FETCH_ASSOC)){
			$seq = "";
			$jam = "";
			$tensi = "";
			$nadi = "";
			$resp = "";
			$suhu = "";
			$keterangan = "";

			if(isset($tab3)){
				$seq = $tab3['ID'];
				$jam = $tab3['Jam']->format('H:i');
				$tensi = $tab3['Tensi'];
				$nadi = $tab3['Nadi'];
				$resp = $tab3['Resp'];
				$suhu = $tab3['Suhu'];
				$keterangan = $tab3['Keterangan'];
			}

			echo "
				<tr>
					<td><input type='button' class='editRow2' value='Edit'></td>
					<td>".$jam."</td>
					<td>".$tensi."</td>
					<td>".$nadi."</td>
					<td>".$resp."</td>
					<td>".$suhu."</td>
					<td>".$keterangan."</td>
					<td hidden>".$seq."</td>
				</tr>
			";
		}
	  }
	  ?>
	  <tr>
		<td><input type="button" value="Add" onClick="addTab2();"></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	  </tr>
  </table>
	<?php
		if($mode != 'insert'){
			$queTab4 = "Select * from F_HD01_04 where Case_No = ".$caseno." Order By Jam";
			$queTab4_exe = sqlsrv_query($conn,$queTab4);
		}
	?>
	<table width="832" class="midTable allBorder inputTab" id="table3">
		<tr>
		<td colspan="14" style="border:0;">&nbsp;</td>
	  </tr>
	  <tr>
		<td width="6%" style="border:0;">&nbsp;</td>
		<td colspan="13" style="border:0;padding-left:15px;">
			<table class="noBorder" width="100%">
				<tr>
					<td><strong>SELAMA - DIALISIS</strong></td>
					<td>CON.NA : <input type="text" class="xshort" name="CONNA" value="<?php echo $form['CONNA']; ?>"></td>
					<td>COND : <input type="text" class="xshort" name="COND" value="<?php echo $form['COND']; ?>"></td>
					<td>Mulai Jam : <input type="text" class="short" name="Jam_Mulai" value="<?php echo $form['Jam_Mulai']; ?>"></td>
					<td>Selesai Jam : <input type="text" class="short" name="Jam_Selesai" value="<?php echo $form['Jam_Selesai']; ?>"></td>
				<tr>	    			
			</table>
		</td>
	  </tr>
	  <tr style="text-align:center;">
		<td>&nbsp;</td>
		<td width="10%">Jam</td>
		<td width="9%">Tensi</td>
		<td width="6%">Nadi</td>
		<td width="6%">Resp</td>
		<td width="6%">TMP</td>
		<td width="6%" hidden>EBF</td>
		<td width="6%">QB</td>
		<td width="6%">UFG</td>
		<td width="6%">UFR</td>
		<td width="6%">UF</td>
		<td width="6%">VP</td>
		<td>CUM.B.V</td>
		<td>Keterangan</td>
	  </tr>
	  <?php
	  if(isset($queTab4_exe)){
		while($tab4 = sqlsrv_fetch_array($queTab4_exe, SQLSRV_FETCH_ASSOC)){
			$jam = "";		$tensi = "";	$nadi = "";		$resp = "";
			$tmp = "";		$ebf = "";		$qb = "";		$ufg = "";
			$ufr = "";		$uf = "";		$vp = "";		$cumbv = "";
			$keterangan = "";				$seq = "";

			if(isset($tab4)){
				$seq = $tab4['ID'];
				$jam = $tab4['Jam']->format('H:i');
				$tensi = $tab4['Tensi'];
				$nadi = $tab4['Nadi'];
				$resp = $tab4['Resp'];
				$tmp = $tab4['TMP'];
				$ebf = $tab4['EBF'];
				$qb = $tab4['QB'];
				$ufg = $tab4['UFG'];
				$ufr = $tab4['UFR'];
				$uf = $tab4['UF'];
				$vp = $tab4['VP'];
				$cumbv = $tab4['CUM_B_V'];
				$keterangan = $tab4['Keterangan'];
			}

			echo "
				<tr>
					<td><input type='button' class='editRow3' value='Edit'></td>
					<td>".$jam."</td>
					<td>".$tensi."</td>
					<td>".$nadi."</td>
					<td>".$resp."</td>
					<td>".$tmp."</td>
					<td hidden>".$ebf."</td>
					<td>".$qb."</td>
					<td>".$ufg."</td>
					<td>".$ufr."</td>
					<td>".$uf."</td>
					<td>".$vp."</td>
					<td>".$cumbv."</td>
					<td>".$keterangan."</td>
					<td hidden>".$seq."</td>
				</tr>
			";
		}
	  }
		
	  ?>
	  <tr>
		<td><input type="button" value="Add" onClick="addTab3();"></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td hidden>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	  </tr>
  </table>
	<?php
		if($mode != 'insert'){
			$queTab5 = "Select * from F_HD01_05 where Case_No = ".$caseno." Order By Jam";
			$queTab5_exe = sqlsrv_query($conn,$queTab5);
		}
	?>
	<table width="832" class="midTable allBorder inputTab" id="table4">
	<tr>
		<td colspan="7" style="border:0;">&nbsp;</td>
	  </tr>
	  <tr>
		<td width="6%" style="border:0;">&nbsp;</td>
		<td colspan="6" style="border:0;padding-left:15px;"><strong>SESUDAH - DIALISIS</strong></td>
	  </tr>
	  <tr style="text-align:center;">
		<td>&nbsp;</td>
		<td width="10%">Jam</td>
		<td width="9%">Tensi</td>
		<td width="6%">Nadi</td>
		<td width="6%">Resp</td>
		<td width="6%">Suhu</td>
		<td>Keterangan</td>
	  </tr>      
	  <?php
	  if(isset($queTab5_exe)){
		while($tab5 = sqlsrv_fetch_array($queTab5_exe, SQLSRV_FETCH_ASSOC)){
			$seq = "";
			$jam = "";
			$tensi = "";
			$nadi = "";
			$resp = "";
			$suhu = "";
			$keterangan = "";

			if(isset($tab5)){
				$seq = $tab5['ID'];
				$jam = $tab5['Jam']->format('H:i');
				$tensi = $tab5['Tensi'];
				$nadi = $tab5['Nadi'];
				$resp = $tab5['Resp'];
				$suhu = $tab5['Suhu'];
				$keterangan = $tab5['Keterangan'];
			}

			echo "
				<tr>
					<td><input type='button' class='editRow4' value='Edit'></td>
					<td>".$jam."</td>
					<td>".$tensi."</td>
					<td>".$nadi."</td>
					<td>".$resp."</td>
					<td>".$suhu."</td>
					<td>".$keterangan."</td>
					<td hidden>".$seq."</td>
				</tr>
			";
		}
	  }
	  ?>
	  <tr>
		<td><input type="button" value="Add" onClick="addTab4();"></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	  </tr>
	</table>
	<table width="832" class="botTable">
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td width="30%">Pendarahan pada daerah tusukan</td>
			<td width="15px">:</td>
			<td width="15%">
				<input name="Pendarahan" type="radio" id="pendarahann" value='1' <?php getselect($form['Pendarahan'],'1'); ?>>
				<label for="pendarahann">Tidak</label>
			</td>
			<td>
				<input type="radio" name="Pendarahan" id="pendarahany" value='2' <?php getselect($form['Pendarahan'],'2'); ?>>
				<label for="pendarahany">Ya</label>
			</td>
		</tr>
		<tr>
			<td class="vtop">Bila, Ya tindakan yang diambil</td>
			<td class="vtop">:</td>
			<td colspan="2">
				<textarea maxlength="250" style='width:100%;' name="Tindakan"><?php echo $form['Tindakan']; ?></textarea>
			</td>
		</tr>
		<tr>
			<td class="vtop">Keluhan</td>
			<td class="vtop">:</td>
			<td colspan="2"><textarea maxlength="250" style='width:100%;' name="Keluhan_Pulang"><?php echo $form['Keluhan_Pulang']; ?></textarea></td>
		</tr>
		<tr hidden>
			<td class="vtop">(K.T)/V</td>
			<td class="vtop">:</td>
			<td colspan="2"><textarea maxlength="250" style='width:100%;' name="KTV"><?php echo $form['KTV']; ?></textarea></td>
		</tr>
		<tr>
			<td class="vtop">Lain-lain</td>
			<td class="vtop">:</td>
			<td colspan="2"><textarea maxlength="250" style='width:100%;' name="Lain"><?php echo $form['Lain']; ?></textarea></td>
		</tr>
	</table>
	<p>&nbsp;</p>
</form>


<script type="text/javascript">
	$(".hid1").hide();
	// $(".show").show();
	// $(".show").removeClass('show');


	$(document).ready(function()
	{
		$(".yes").change(function(){ 
			if(this.checked){
				// alert("check");
				var hid = $(this).closest('td').find('.hid');
				hid.show();
				hid.next().show();
				hid.val("");
			}
		});

		$(".no").change(function(){ 
			if(this.checked){
				// alert("check");
				var hid = $(this).closest('td').find('.hid');
				hid.hide();
				hid.next().hide();
				hid.val("");
			}
		});

		$(".xshort").attr('maxlength','4');
	});

	function addTab1(){
		var html = "";
		html = "<tr>";
		html = html + "<td>&nbsp;</td>";
		html = html + "<td><input type='text' class='short' name='inpt1[]' /></td>";
		html = html + "<td><textarea style='width:100%;' rows='1' name='inpt2[]'></textarea></td>";
		html = html + "<td><input type='text' name='inpt3[]' /></td>";
		html = html + "<td><input type='text' name='inpt4[]' /></td>";
		html = html + "<td hidden><input type='text' name='inptup2[]' /></td>";
		html = html + "</tr>";
		
		$('#table1 tr:last').before(html);
	}

	function addTab2(){
		var html = "";
		html = "<tr>";
		html = html + "<td>&nbsp;</td>";
		html = html + "<td><input type='text' class='short' name='inpt5[]' /></td>";
		html = html + "<td><input type='text' class='short' name='inpt6[]' /></td>";
		html = html + "<td><input type='text' class='xshort' name='inpt7[]' /></td>";
		html = html + "<td><input type='text' class='xshort' name='inpt8[]' /></td>";
		html = html + "<td><input type='text' class='xshort' name='inpt9[]' /></td>";
		html = html + "<td><textarea style='width:100%;' rows='1' name='inpt10[]'></textarea></td>";
		html = html + "<td hidden><input type='text' name='inptup3[]' /></td>";
		html = html + "</tr>";
		
		$('#table2 tr:last').before(html);
		$(".xshort").attr('maxlength','4');
	}

	function addTab3(){
		var html = "";
		html = "<tr>";
		html = html + "<td>&nbsp;</td>";
		html = html + "<td><input type='text' class='short' name='inpt11[]' /></td>";
		html = html + "<td><input type='text' class='short' name='inpt12[]' /></td>";
		html = html + "<td><input type='text' class='xshort' name='inpt13[]' /></td>";
		html = html + "<td><input type='text' class='xshort' name='inpt14[]' /></td>";
		html = html + "<td><input type='text' class='xshort' name='inpt15[]' /></td>";
		html = html + "<td hidden><input type='text' class='xshort' name='inpt16[]' /></td>";
		html = html + "<td><input type='text' class='xshort' name='inpt17[]' /></td>";
		html = html + "<td><input type='text' class='xshort' name='inpt18[]' /></td>";
		html = html + "<td><input type='text' class='xshort' name='inpt19[]' /></td>";
		html = html + "<td><input type='text' class='xshort' name='inpt20[]' /></td>";
		html = html + "<td><input type='text' class='xshort' name='inpt21[]' /></td>";
		html = html + "<td><input type='text' class='short' name='inpt22[]' /></td>";
		html = html + "<td><input type='text' class='short' name='inpt23[]' /></td>";
		html = html + "<td hidden><input type='text' name='inptup4[]' /></td>";
		html = html + "</tr>";
		
		$('#table3 tr:last').before(html);
		$(".xshort").attr('maxlength','4');
	}

	function addTab4(){
		var html = "";
		html = "<tr>";
		html = html + "<td>&nbsp;</td>";
		html = html + "<td><input type='text' class='short' name='inpt24[]' /></td>";
		html = html + "<td><input type='text' class='short' name='inpt25[]' /></td>";
		html = html + "<td><input type='text' class='xshort' name='inpt26[]' /></td>";
		html = html + "<td><input type='text' class='xshort' name='inpt27[]' /></td>";
		html = html + "<td><input type='text' class='xshort' name='inpt28[]' /></td>";
		html = html + "<td><textarea style='width:100%;' rows='1' name='inpt29[]'></textarea></td>";
		html = html + "<td hidden><input type='text' name='inptup5[]' /></td>";
		html = html + "</tr>";
		
		$('#table4 tr:last').before(html);
		$(".xshort").attr('maxlength','4');
	}

	$(".editRow1").click(function(){
		var array11 = ["","input","area","input","input","input"];
		var array12 = ["","1[]' class='short'","2[]'","3[]'","4[]'","up2[]'"];

		var idx = 0;
		$(this).closest('tr').find('td').each(function(){
			if(idx != 0){
				$(this).html(setinput(array11[idx], array12[idx], $(this).html()));
			}else{
				$(this).html('');
			}
			idx++;
		});
		$(".xshort").attr('maxlength','4');
	});

	$(".editRow2").click(function(){
		var array21 = ["","input","input","input","input","input","area","input"];
		var array22 = ["","5[]' class='short'","6[]' class='short'","7[]' class='xshort'","8[]' class='xshort'","9[]' class='xshort'","10[]'","up3[]'"];

		var idx = 0;
		$(this).closest('tr').find('td').each(function(){
			if(idx != 0){
				$(this).html(setinput(array21[idx], array22[idx], $(this).html()));
			}else{
				$(this).html('');
			}
			idx++;
		});
		$(".xshort").attr('maxlength','4');
	});

	$(".editRow3").click(function(){
		var array31 = ["","input","input","input","input","input","input","input","input","input","input","input","input","input","input"];
		var array32 = ["","11[]' class='short'","12[]' class='short'","13[]' class='xshort'","14[]' class='xshort'","15[]' class='xshort'","16[]' class='xshort'","17[]' class='xshort'","18[]' class='xshort'","19[]' class='xshort'","20[]' class='xshort'","21[]' class='xshort'","22[]' class='short'","23[]' class='short'","up4[]'"];

		var idx = 0;
		$(this).closest('tr').find('td').each(function(){
			if(idx != 0){
				$(this).html(setinput(array31[idx], array32[idx], $(this).html()));
			}else{
				$(this).html('');
			}
			idx++;
		});
		$(".xshort").attr('maxlength','4');
	});

	$(".editRow4").click(function(){
		var array41 = ["","input","input","input","input","input","area","input"];
		var array42 = ["","24[]' class='short'","25[]' class='short'","26[]' class='xshort'","27[]' class='xshort'","28[]' class='xshort'","29[]'","up5[]'"];

		var idx = 0;
		$(this).closest('tr').find('td').each(function(){
			if(idx != 0){
				$(this).html(setinput(array41[idx], array42[idx], $(this).html()));
			}else{
				$(this).html('');
			}
			idx++;
		});
		$(".xshort").attr('maxlength','4');
	});

	function setinput(type, no, val){
		if(type == "input"){
			var hasil = "<input type='text' name='inpt"+no+" value='"+val+"' >";
			return hasil;
		}else if(type == "area"){
			var hasil = "<textarea style='width:100%;' rows='1' name='inpt"+no+"[]'>"+val+"</textarea>";
			return hasil;
		}
	}

</script>
</body>
</html>