<?php
	include "koneksi.php";
	date_default_timezone_set("Asia/Bangkok");
	ini_set("memory_limit", "-1");

	
	if($_POST){
		$index = array("alergi", "riwayat", "obat", "polanapas", "warnakulit", "catnafas", "polamakan", "tenggorok", "catnutrisi", "bab", "bak", "cateliminasi", "keluhnyeri", "skalanyeri", "lokasi", "catnyeri", "mobilitas", "motorik", "catmobilitas", "polatidur", "obattidur", "cattidur", "penampilan", "kebersihan", "catkebersihan", "psikologi", "pengaruh", "catpsikologi", "hidtot1", "hidtot2", "hidtot3", "catjatuh", "butuhedu", "catedukasi", "nilai2", "catspirit", "temuan");

		$indextab = array("a11","a12","a13","a21","a22","a23","a31","a32","a33","a41","a42","a43","a51","a52","a53","a61","a62","a63");

		if($_POST['mode'] == 'insert'){
			$que = "INSERT INTO F_HD02_01 (case_no, alergi, riwayat, obat, polanapas, warnakulit, catnafas, polamakan, tenggorok, catnutrisi, bab, bak, cateliminasi, keluhnyeri, skalanyeri, lokasi, catnyeri, mobilitas, motorik, catmobilitas, polatidur, obattidur, cattidur, penampilan, kebersihan, catkebersihan, psikologi, pengaruh, catpsikologi, hidtot1, hidtot2, hidtot3, catjatuh, butuhedu, catedukasi, nilai2, catspirit, temuan) VALUES('".$_POST['case_no']."',";

			foreach ($index as $value) {
				$que = $que."'".$_POST[$value]."'";
				if($value != 'temuan'){
					$que = $que.",";
				}
			}

			$que = $que.");";
			$que_exe = sqlsrv_query($conn,$que);

			$que2 = "INSERT INTO F_HD02_02 (case_no, a11, a12, a13, a21, a22, a23, a31, a32, a33, a41, a42, a43, a51, a52, a53, a61, a62, a63) VALUES('".$_POST['case_no']."',";

			foreach ($indextab as $value) {
				$que2 = $que2."'".$_POST[$value]."'";
				if($value != 'a63'){
					$que2 = $que2.",";
				}
			}
			$que2 = $que2.");";

			$que2_exe = sqlsrv_query($conn1,$que2);

		}else if($_POST['mode'] == 'update'){
			$que = "UPDATE F_HD02_01 SET ";

			foreach ($index as $value) {
				$que = $que.$value."='".$_POST[$value]."'";
				if($value != 'temuan'){
					$que = $que.", ";
				}
			}

			$que = $que." where case_no = '".$_POST['case_no']."'";
			$que_exe = sqlsrv_query($conn,$que);

			$que2 = "UPDATE F_HD02_02 SET ";

			foreach ($indextab as $value) {
				$que2 = $que2.$value."='".$_POST[$value]."'";
				if($value != 'a63'){
					$que2 = $que2.", ";
				}
			}

			$que2 = $que2." where case_no = '".$_POST['case_no']."'";
			$que2_exe = sqlsrv_query($conn1,$que2);

		}
	}
	echo "<script>
				alert('Save data berhasil.');
				window.location.href = 'F_HD02.php?patno=".$_POST['pat_no']."&caseno=".$_POST['case_no']."&doctorid=".$_POST['doc_id']."';
			</script>";
?>
