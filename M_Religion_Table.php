<?php
include "koneksi.php";
if (isset($_GET['katakunci1']))
{
    // $katakunci1 = $_GET['katakunci1'];
    $katakunci1 = str_replace("%20", " ", $_GET['katakunci1']);

    // $katakunci2 = $_GET['katakunci2'];
    $katakunci2 = str_replace("%20", " ", $_GET['katakunci2']);
    
    $query = "SELECT * FROM M_Religion WHERE Religion_Id like '%". $katakunci1 ."%' AND Name like '%". $katakunci2 ."%'";
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
            <td>Kode Agama</td>
            <td>Nama Agama</td>
            <td>Aktif</td>
            </tr>";
            while($rs = sqlsrv_fetch_array($sql)){
                echo "
                <tr id='".$rs['Religion_Id']."|".$rs['Name']."|".$rs['Active']."' >
                <td>".$rs['Religion_Id']."</td>
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
        var religionid = res[0];
        var name = res[1];
        var statrel = res[2];
        $("#religionid").val(religionid);
        $("#name").val(name);
        if (statrel=="X"){
            radiobtn = document.getElementById("aktif");
            radiobtn.checked = true;
        } else if(statrel==" "){
            radiobtn = document.getElementById("nonaktif");
            radiobtn.checked = true;
        }

        $("#tampiltabel").empty();
        $("#upData").prop("disabled",false);
        modal.style.display = "none";
    })
</script>
