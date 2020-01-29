<?php
include "koneksi.php";
if (isset($_GET['katakunci1']))
{
   // $katakunci1 = $_GET['katakunci1'];
   $katakunci1 = str_replace("%20", " ", $_GET['katakunci1']);

   // $katakunci2 = $_GET['katakunci2'];
   $katakunci2 = str_replace("%20", " ", $_GET['katakunci2']);

   $query = "SELECT * FROM M_Doctor WHERE Doctor_Id like '%". $katakunci1 ."%' AND Name like '%". $katakunci2 ."%'";
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
        <td>Kode Dokter</td>
        <td>Nama Dokter</td>
        <td>Aktif</td>
        </tr>";
        while($rs = sqlsrv_fetch_array($sql)){
            echo "
            <tr id='".$rs['Doctor_Id']."|".$rs['Name']."|".$rs['Active']."' >
            <td>".$rs['Doctor_Id']."</td>
            <td>".$rs['Name']."</td>
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
        var iddok = res[0];
        var namadok = res[1];
        var statdok = res[2];
        $("#iddok").val(iddok);
        $("#namadok").val(namadok);
        if (statdok=="X"){
            radiobtn = document.getElementById("aktif");
            radiobtn.checked = true;
        } else if(statdok==" "){
            radiobtn = document.getElementById("nonaktif");
            radiobtn.checked = true;
        }
        modal.style.display = "none";

        $("#tampiltabel").empty();
        $("#upData").prop( "disabled", false );

    })
</script>
