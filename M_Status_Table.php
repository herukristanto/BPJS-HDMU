<?php
include "koneksi.php";
if (isset($_GET['katakunci1']))
{
    // $katakunci1 = $_GET['katakunci1'];
    $katakunci1 = str_replace("%20", " ", $_GET['katakunci1']);

    // $katakunci2 = $_GET['katakunci2'];
    $katakunci2 = str_replace("%20", " ", $_GET['katakunci2']);
    $query = "SELECT * FROM M_Status WHERE Status_Id like '%". $katakunci1 ."%' AND Name like '%". $katakunci2 ."%'";
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
            <td>Kode Status</td>
            <td>Deskripsi</td>
            <td>Aktif</td>
            </tr>";
            while($rs = sqlsrv_fetch_array($sql)){
                echo "
                <tr id='".$rs['Status_Id']."|".$rs['Name']."|".$rs['Active']."' >
                <td>".$rs['Status_Id']."</td>
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
        var statusid = res[0];
        var namestatus = res[1];
        var statstatus = res[2];
        $("#statusid").val(statusid);
        $("#namestatus").val(namestatus);
        if (statstatus=="X"){
            radiobtn = document.getElementById("aktif");
            radiobtn.checked = true;
        } else if(statstatus==" "){
            radiobtn = document.getElementById("nonaktif");
            radiobtn.checked = true;
        }

        $("#tampiltabel").empty();
        $("#upData").prop("disabled",false);
        modal.style.display = "none";
    })
</script>
