<?php
	include "koneksi.php";
	date_default_timezone_set("Asia/Bangkok");
	ini_set("memory_limit", "-1");

	if($_POST){
		$index = array("Pat_No", "Pat_Name", "DOB", "Sex", "Doctor_Id", "Doctor_Name", "Tgl_Datang", "Alergi", "Keluhan_Datang", "Cara_Datang", "Status_Pat", "Tgl_Dtng1", "Frekwensi", "Surat_Persetujuan", "HbsAg", "HIV", "HCV", "Kesadaran", "Kulit", "Hub_Sirkulasi1", "Cat_Sirkulasi1", "Mata", "E_Muka", "E_Tangan", "E_Perut", "E_Paru", "E_MKaki", "E_PKaki", "AB_Telinga", "AB_Mata", "AB_Gigi", "AB_Tangan", "AB_Kaki", "Keistimewaan", "Dosis_Awal", "Lanjutkan", "Protamin", "Dialiser", "Total_Vol", "Priming_Vol", "Sisa_Priming", "Dialisat", "Priming", "Bilas", "Transfusi", "Infus", "Sonde", "Minum", "Total_Intake", "Makan", "Urine", "CMS", "UF", "Total_Output", "Balance", "BB_Standart", "BB_Dial", "BB_Datang", "BB_Tarik", "BB_Pulang", "Tinggi", "Hub_Sirkulasi2", "Cat_Sirkulasi2", "Dial_Ke", "Kode_Mesin", "No_Kamar", "CONNA", "COND", "Jam_Mulai", "Jam_Selesai", "Pendarahan", "Tindakan", "Keluhan_Pulang", "KTV", "Lain");

		$patientno = $_POST['Pat_No'];
		$caseno = $_POST['Case_No'];
		$dokterid = $_POST['Doctor_Id'];
		
		if($_POST['mode'] == 'insert'){
			$que = "insert into F_HD01_01(Case_No, Pat_No, Pat_Name, DOB, Sex, Doctor_Id, Doctor_Name, Tgl_Datang, Alergi, Keluhan_Datang, Cara_Datang, Status_Pat, Tgl_Dtng1, Frekwensi, Surat_Persetujuan, HbsAg, HIV, HCV, Kesadaran, Kulit, Hub_Sirkulasi1, Cat_Sirkulasi1, Mata, E_Muka, E_Tangan, E_Perut, E_Paru, E_MKaki, E_PKaki, AB_Telinga, AB_Mata, AB_Gigi, AB_Tangan, AB_Kaki, Keistimewaan, Dosis_Awal, Lanjutkan, Protamin, Dialiser, Total_Vol, Priming_Vol, Sisa_Priming, Dialisat, Priming, Bilas, Transfusi, Infus, Sonde, Minum, Total_Intake, Makan, Urine, CMS, UF, Total_Output, Balance, BB_Standart, BB_Dial, BB_Datang, BB_Tarik, BB_Pulang, Tinggi, Hub_Sirkulasi2, Cat_Sirkulasi2, Dial_Ke, Kode_Mesin, No_Kamar, CONNA, COND, Jam_Mulai, Jam_Selesai, Pendarahan, Tindakan, Keluhan_Pulang, KTV, Lain) values('".$_POST['Case_No']."'";

			foreach ($index as $value) {
				if(isset($_POST[$value])){
					if($value == "Tgl_Dtng1" && $_POST[$value] != ""){
						$tgl1 = DateTime::createFromFormat('d/m/Y', $_POST['Tgl_Dtng1']);
    					$tgl = $tgl1->format('Y/m/d');

    					$que = $que.", '".$tgl."'";
					}else{
						$que = $que.", '".$_POST[$value]."'";
					}
				}else{
					$que = $que.", ''";
				}
			}

			$que .= ")";
			$que_exe = sqlsrv_query($conn,$que);
			// echo $que;
		}else if($_POST['mode'] == 'update'){
			$que = "UPDATE F_HD01_01 SET ";

			foreach ($index as $value) {
				if(isset($_POST[$value])){
					
					if($value == "Tgl_Dtng1"){
						$tgl1 = DateTime::createFromFormat('d/m/Y', $_POST['Tgl_Dtng1']);
    					$tgl = $tgl1->format('Y/m/d');

						$que = $que.$value."='".$tgl."'";
    				}else{
						$que = $que.$value."='".$_POST[$value]."'";
    				}

				}else{
					$que = $que.$value."=''";
				}

				if($value != 'Lain'){
					$que = $que.", ";
				}
			}

			$que = $que." where case_no = '".$_POST['Case_No']."'";
			$que_exe = sqlsrv_query($conn,$que);
			echo $que;
		}

		$values2 = "";
		if (isset($_POST['inpt1'])) {
			$rs1 = $_POST['inpt1'];
			$rs2 = $_POST['inpt2'];
			$rs3 = $_POST['inpt3'];
			$rs4 = $_POST['inpt4'];
			$rsup2 = $_POST['inptup2'];
			$idx = 0;
			foreach ($rs1 as $key=>$value) {
				if($rsup2[$key] == ''){
					$values2 = $values2." insert into F_HD01_02 (Case_No, Jam, Instruksi, Dokter, Perawat) values(".$_POST['Case_No'].",'".$value."','".$rs2[$key]."','".$rs3[$key]."','".$rs4[$key]."');";
				}else{
					$values2 = $values2." update F_HD01_02 set
					jam = '".$value."',
					Instruksi = '".$rs2[$key]."',
					Dokter = '".$rs3[$key]."',
					Perawat = '".$rs4[$key]."'
					where Case_No = ".$_POST['Case_No']." and ID = ".$rsup2[$key].";";
				}
			}
			echo "<br>".$values2;
			$values2_exe = sqlsrv_query($conn,$values2);
		}

		$values3 = "";
		if (isset($_POST['inpt5'])) {
		    $rs5 = $_POST['inpt5'];
		    $rs6 = $_POST['inpt6'];
		    $rs7 = $_POST['inpt7'];
		    $rs8 = $_POST['inpt8'];
		    $rs9 = $_POST['inpt9'];
		    $rs10 = $_POST['inpt10'];
		    $rsup3 = $_POST['inptup3'];
		    $idx = 0;
		    foreach ($rs5 as $key=>$value) {
		    	if($rsup3[$key] == ''){
		    		$values3 = $values3." insert into F_HD01_03 (Case_No, Jam, Tensi, Nadi, Resp, Suhu, Keterangan) values(".$_POST['Case_No'].",'".$value."','".$rs6[$key]."','".$rs7[$key]."','".$rs8[$key]."','".$rs9[$key]."','".$rs10[$key]."');";
		    	}else{
			    	$values3 = $values3." update F_HD01_03 set
						jam = '".$value."',
						Tensi = '".$rs6[$key]."',
						Nadi = '".$rs7[$key]."',
						Resp = '".$rs8[$key]."',
						Suhu = '".$rs9[$key]."',
						Keterangan = '".$rs10[$key]."'
						where Case_No = ".$_POST['Case_No']." and ID = ".$rsup3[$key].";";
		    	}
			}
			echo "<br>".$values3;
			$values3_exe = sqlsrv_query($conn,$values3);
		}

		$values4 = "";
		if (isset($_POST['inpt11'])) {
		    $rs11 = $_POST['inpt11'];
		    $rs12 = $_POST['inpt12'];
		    $rs13 = $_POST['inpt13'];
		    $rs14 = $_POST['inpt14'];
		    $rs15 = $_POST['inpt15'];
		    $rs16 = $_POST['inpt16'];
		    $rs17 = $_POST['inpt17'];
		    $rs18 = $_POST['inpt18'];
		    $rs19 = $_POST['inpt19'];
		    $rs20 = $_POST['inpt20'];
		    $rs21 = $_POST['inpt21'];
		    $rs22 = $_POST['inpt22'];
		    $rs23 = $_POST['inpt23'];
		    $rsup4 = $_POST['inptup4'];
		    $idx = 0;
		    foreach ($rs11 as $key=>$value) {
		    	if($rsup4[$key] == ''){
		    		$values4 = $values4." insert into F_HD01_04 (Case_No, Jam, Tensi, Nadi, Resp, TMP, EBF, QB, UFG, UFR, UF, VP, CUM_B_V, Keterangan) values(".$_POST['Case_No'].",'".$value."','".$rs12[$key]."','".$rs13[$key]."','".$rs14[$key]."','".$rs15[$key]."','".$rs16[$key]."','".$rs17[$key]."','".$rs18[$key]."','".$rs19[$key]."','".$rs20[$key]."','".$rs21[$key]."','".$rs22[$key]."','".$rs23[$key]."');";
		    	}else{
		    		$values4 = $values4." update F_HD01_04 set
					Jam = '".$value."',
					Tensi = '".$rs12[$key]."',
					Nadi = '".$rs13[$key]."',
					Resp = '".$rs14[$key]."',
					TMP = '".$rs15[$key]."',
					EBF = '".$rs16[$key]."',
					QB = '".$rs17[$key]."',
					UFG = '".$rs18[$key]."',
					UFR = '".$rs19[$key]."',
					UF = '".$rs20[$key]."',
					VP = '".$rs21[$key]."',
					CUM_B_V = '".$rs22[$key]."',
					Keterangan = '".$rs23[$key]."'
					where Case_No = ".$_POST['Case_No']." and ID = ".$rsup4[$key].";";
		    	}
			}
			echo "<br>".$values4;
			$values4_exe = sqlsrv_query($conn,$values4);
		}

		$values5 = "";
		if (isset($_POST['inpt24'])) {
		    $rs24 = $_POST['inpt24'];
		    $rs25 = $_POST['inpt25'];
		    $rs26 = $_POST['inpt26'];
		    $rs27 = $_POST['inpt27'];
		    $rs28 = $_POST['inpt28'];
		    $rs29 = $_POST['inpt29'];
		    $rsup5 = $_POST['inptup5'];
		    $idx = 0;
		    foreach ($rs5 as $key=>$value) {
		    	if($rsup5[$key] == ''){
		    		$values5 = $values5." insert into F_HD01_05 (Case_No, Jam, Tensi, Nadi, Resp, Suhu, Keterangan) values(".$_POST['Case_No'].",'".$value."','".$rs25[$key]."','".$rs26[$key]."','".$rs27[$key]."','".$rs28[$key]."','".$rs29[$key]."');";
		    	}else{
		    		$values5 = $values5." update F_HD01_05 set
					jam = '".$value."',
					Tensi = '".$rs25[$key]."',
					Nadi = '".$rs26[$key]."',
					Resp = '".$rs27[$key]."',
					Suhu = '".$rs28[$key]."',
					Keterangan = '".$rs29[$key]."'
					where Case_No = ".$_POST['Case_No']." and ID = ".$rsup5[$key].";";
				}
			}
			echo "<br>".$values5;
			$values5_exe = sqlsrv_query($conn,$values5);
		}
	}

	header('Location: F_HD01.php?patno='.$patientno.'&caseno='.$caseno.'&doctorid='.$dokterid);




	// foreach($_POST as $key => $value){
	// 	echo '"'.$key.'"=>"'.$value.'", ';
	// }
?>