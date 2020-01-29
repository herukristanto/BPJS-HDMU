<?php
    include "koneksi.php";
			
	$usercollection = "";
	$terminal = "";
	$cond1 = "";

	if(isset($_GET['usercollection']))
	{
		$usercollection = str_replace("%20", " ", $_GET['usercollection']);
	}
	if(isset($_GET['terminal']))
	{
		$terminal = str_replace("%20", " ", $_GET['terminal']);
	}
	
	//=========== setting condition for selection ===========
	if($usercollection <> ''){
		$cond1 = "where User_Id like '%".$usercollection."%'";
	}

	if($cond1 <> ''){
		if($terminal <> ''){
			$cond1 = $cond1." and Terminal_Id like '%".$terminal."%' AND End_Date IS NULL order by End_Date desc";
		}else{
			$cond1 = $cond1." AND End_Date IS NULL order by End_Date desc";
		}
	}else{
		if($terminal <> ''){
			$cond1 = "where Terminal_Id like '%".$terminal."%' AND End_Date IS NULL order by End_Date desc";
		}else{
			$cond1 = "where End_Date IS NULL order by End_Date desc";
		}
	}	
	//========================================================
	
	if($cond1 <> ''){
	$que = "SELECT * FROM V_Collection ".$cond1;
	$sql = sqlsrv_query($conn,$que);
		
	echo "
	<table id='myTable' style='margin-top:10px;'>
  	<tr>
    	<td><div align='center'>User Id</div></td>
		<td><div align='center'>Nama</div></td>
    	<td><div align='center'>Date Open</div></td>
		<td><div align='center'>Jam Open</div></td>
    	<td><div align='center'>Terminal</div></td>
    	<td><div align='center'>Session</div></td>
  	</tr>
	";	
	
    while($hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)){
	
      echo "
	  <tr class='srcRowCase'>
	  	<td>".$hasil['User_Id']."</td>
		<td>".$hasil['Name']."</td>
		<td>".$hasil['Start_Date']->format('d/m/Y')."</td>
		<td>".$hasil['Start_Time']."</td>
	  	<td>".$hasil['Terminal_Id']."</td>
		<td>".$hasil['Session_Id']."</td>
	  </tr>";
    }
	
	echo "</table>";
	
	echo '<script>
	$( ".srcRowCase" ).dblclick(function() {
		$("#user_id").val($(this).find("td").eq(0).text());
		$("#Userid").val($(this).find("td").eq(0).text());
		$("#Nama").val($(this).find("td").eq(1).text());
		$("#Tglopen").val($(this).find("td").eq(2).text());
		$("#Jamopen").val($(this).find("td").eq(3).text());
		$("#Terminal").val($(this).find("td").eq(4).text());
		$("#Session").val($(this).find("td").eq(5).text());
		modal.style.display = "none";
		$("#srcuser").val("");
		$("#tab2").empty();
	});
	
	document.getElementById("closed").disabled = false;
	</script>';
	
	}
?>