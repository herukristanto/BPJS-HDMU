<?php
  include "koneksi.php";

  $que = "select * from M_PayType";
  $que_execute = sqlsrv_query($conn4,$que);
  echo "<select id='payType' onchange='Payment(this);'>";
  while($payType = sqlsrv_fetch_array($que_execute, SQLSRV_FETCH_ASSOC)){
    echo "<option value='".$payType['Pay_Id']."'>".$payType['Payment']."</option>";
  }
  echo "</select>";
?>
