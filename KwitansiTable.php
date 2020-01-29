<?php
  include "koneksi.php";

	$que = "SELECT Bill_Id, sum(Amount) as Amount FROM T_Billing where pat_no = '".$patno."' and (bill_id not in (select bill_id from T_POS where reference_no = '') and bill_id is not null and bill_id <> '' and status = 'X') group by Bill_Id";

  if(isset($_GET['inv'])){
    $inv = $_GET['inv'];

    if($inv == 's'){
      $que = "SELECT Bill_Id, sum(Amount) as Amount FROM T_Billing where pat_no = '".$patno."' and (bill_id not in (select bill_id from T_POS where reference_no = '') and bill_id is not null and bill_id <> '' and status = 'X') and Bill_Id like 'S%' group by Bill_Id";
    }
  }

  $sql = sqlsrv_query($conn,$que);

	echo "
	<table id='myTable' width='794' border='1' style='margin-top:10px;' name='tabInv'>
  		<tr>
    		<td width='101'><div align='center'>Nomor Invoice</div></td>
    		<td width='148'><div align='center'>Jumlah Tagihan</div></td>
    		<td width='158'><div align='center'>Jumlah Penyesuaian</div></td>
    		<td width='175'><div align='center'>Jumlah Pembayaran</div></td>
    		<td width='178'><div align='center'>Sisa Tagihan</div></td>
  		</tr>
	";

	$jmltagihan = 0;
  $countRow = 0;
  while($hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)){
    $countRow = $countRow + 1;
    $jmltagihan = $jmltagihan + $hasil['Amount'];
    echo "
    <tr class='RowKW'>
  	<td>".$hasil['Bill_Id']."</td>
  	<td>".$hasil['Amount']."</td>
  	<td contenteditable='true' onkeypress='hitung(1,this, event);'></td>
  	<td contenteditable='true' onkeypress='hitung(2,this, event);'></td>
  	<td>".$hasil['Amount']."</td>
    </tr>";
  }
	echo "</table>";
  echo "<input type='text' id='countRow' value='".$countRow."' style='display:none;' />";

	echo '<script>
		function hitung(flag,x,e){
		  if(e.keyCode == "13"){
			e.preventDefault();
			var table = document.getElementsByName("tabInv")[0];
			var rowIndex = x.parentNode.rowIndex;
			var row = table.rows[rowIndex];
			var amt = row.cells[1].innerHTML;

			var dis = row.cells[2].innerHTML;
			if(dis == "" || dis == "<br>"){
			  dis = 0;
			}

			var pay = row.cells[3].innerHTML;
			if(pay == "" || pay == "<br>"){
			  pay = 0;
			}

			if(flag == "2"){
				updateTotal();
			}

			var sisa = parseInt(amt) - parseInt(dis) - parseInt(pay);
			row.cells[4].innerHTML = sisa;
		  }
		}

    function updateTotal(){
      var count = document.getElementById("countRow").value;
      var table = document.getElementsByName("tabInv")[0];
      var allPay = 0;
      for (i = 1; i <= count; i++) {
		if(table.rows[i].cells[3].innerHTML == "<br>"){
			table.rows[i].cells[3].innerHTML = "";
		}

        if(table.rows[i].cells[3].innerHTML != ""){
          allPay = allPay + parseInt(table.rows[i].cells[3].innerHTML);
        }
      }
      document.getElementById("TAmt").value = allPay;
  	  document.getElementById("TBayar").value = "0";
  	  document.getElementById("Kembali").value = "0";
    }
	</script>';
?>
