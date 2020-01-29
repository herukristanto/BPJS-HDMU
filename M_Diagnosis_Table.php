<?php
include "koneksi.php";
if (isset($_GET['katakunci1']))
{
   // $katakunci1 = $_GET['katakunci1'];
   $katakunci1 = str_replace("%20", " ", $_GET['katakunci1']);

   // $katakunci2 = $_GET['katakunci2'];
   $katakunci2 = str_replace("%20", " ", $_GET['katakunci2']);

   $katakunci3 = str_replace("%20", " ", $_GET['katakunci3']);

   $query = "SELECT * FROM M_Diagnose WHERE Diag_Id like '%". $katakunci1 ."%' AND Diagnose like '%". $katakunci2 ."%' AND Diag_Grp like '%". $katakunci3 ."%'";
   $params = array();
   $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
   $sql = sqlsrv_query( $conn, $query , $params, $options );
   $row_count = sqlsrv_num_rows( $sql );
   if ($row_count == 0) {
    echo "Data tidak ditemukan..";
} else {
    if ($sql){
        echo "
        <table id=\"myTable\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
        <tr>
        <td>Grup Diagnosis</td>
        <td>ID Diagnosis</td>
        <td>Diagnose</td>
        <td>Aktif</td>
        </tr>";
        while($rs = sqlsrv_fetch_array($sql)){
            echo "
            <tr id='".$rs['Diag_Grp']."|".$rs['Diag_Id']."|".$rs['Diagnose']."|".$rs['Active']."' >
            <td>".$rs['Diag_Grp']."</td>
            <td>".$rs['Diag_Id']."</td>
            <td>".$rs['Diagnose']."</td>
            <td>".$rs['Active']."</td>
            </tr>
            ";
        }
    }
    echo"</table>";
}
}
?>

<script>
    $('tr').dblclick(function(){
        var id = $(this).attr('id');
        var res = id.split("|");
        var Diag_Grp = res[0];
        var Diag_Id = res[1];
        var Diagnose = res[2];
        var statdiag = res[3];
        $("#grup").val(Diag_Grp);
        $("#iddiag").val(Diag_Id);
        $("#diagnose").val(Diagnose);
        if (statdiag=="X"){
            radiobtn = document.getElementById("aktif");
            radiobtn.checked = true;
        } else if(statdiag==" "){
            radiobtn = document.getElementById("nonaktif");
            radiobtn.checked = true;
        }

        modal.style.display = "none";

        $("#tampiltabel").empty();
        $("#upData").prop( "disabled", false );

    })
</script>
