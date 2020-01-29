<?php
	include "koneksi.php";

	$param = $_GET['kode'];

	$que = "Select * from V_Service where Service_Id = '".$param."'";
	$que_exe = sqlsrv_query($conn, $que);
	$rs = sqlsrv_fetch_array($que_exe, SQLSRV_FETCH_ASSOC);

	if(is_null($rs)){
		echo "
			<script>				
				alert('Kode servis tidak ditemukan.');
				parent.document.getElementById('scode').value = '';
				parent.document.getElementById('sdesc').value = '';		
			</script>
		";
	}else{
		echo "
			<script>				
				function setDesc(elem, desc){
					parent.document.getElementById(elem).value = desc;
				}

				var sdate = Date.parse('".$rs['Valid_From']->format('Y-m-d')."');
				var edate = Date.parse('".$rs['Valid_to']->format('Y-m-d')."');

				var dateObj = new Date();
				var month = dateObj.getUTCMonth() + 1; //months from 1-12
				var day = dateObj.getUTCDate();
				var year = dateObj.getUTCFullYear();

				var today = year + '-' + month + '-' + day;
				today = Date.parse(today);

				if(today >= sdate && today <= edate){
					setDesc('sdesc',\"".$rs['Descp']."\");
					setDesc('type',\"".$rs['Stock']."\");
					setDesc('currstock',\"".$rs['Curr_Stock']."\");
					setDesc('unit',\"".$rs['Unit']."\");
					setDesc('startd',\"".$rs['Valid_From']->format('Y-m-d')."\");
					setDesc('endd',\"".$rs['Valid_to']->format('Y-m-d')."\");
				}else{
					alert('Kode servis sudah tidak valid.');
					setDesc('scode','');
					parent.document.getElementById('scode').focus();
				}

				

			</script>
		";
	}

?>