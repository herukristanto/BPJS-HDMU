<?php
include "koneksi.php";
if (isset($_GET['katakunci1']))
{
    // $katakunci1 = $_GET['katakunci1'];
    $katakunci1 = str_replace("%20", " ", $_GET['katakunci1']);

    // $katakunci2 = $_GET['katakunci2'];
    $katakunci2 = str_replace("%20", " ", $_GET['katakunci2']);

    $query = "SELECT * FROM M_Insurance WHERE INS_NO like '%". $katakunci1 ."%' AND Name like '%". $katakunci2 ."%'";
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
            <td>Nomor Asuransi</td>
            <td>Nama Asuransi</td>
            <td>Alamat</td>
            <td>Telepon</td>
            <td>Kontak</td>
            <td>Aktif</td>
            </tr>";
            while($rs = sqlsrv_fetch_array($sql)){
                echo "
                <tr id='".$rs['INS_NO']."|".$rs['Name']."|".$rs['Address']."|".$rs['Telp']."|".$rs['Contact']."|".$rs['Active']."' >
                <td>".$rs['INS_NO']."</td>
                <td>".$rs['Name']."</td>
                <td>".$rs['Address']."</td>
                <td>".$rs['Telp']."</td>
                <td>".$rs['Contact']."</td>
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
        var kodeasuransi = res[0];
        var namaasuransi = res[1];
        var alamat = res[2];
        var telp = res[3];
        var kontak = res[4];
        var statasuransi = res[5];
        $("#kodeasuransi").val(kodeasuransi);
        $("#namaasuransi").val(namaasuransi);
        $("#alamat").val(alamat);
        $("#telp").val(telp);
        $("#kontak").val(kontak);
        $("#statasuransi").val(statasuransi);
        if (statasuransi=="X"){
            radiobtn = document.getElementById("aktif");
            radiobtn.checked = true;
        } else if(statasuransi==" "){
            radiobtn = document.getElementById("nonaktif");
            radiobtn.checked = true;
        }
        modal.style.display = "none";

        $("#tampiltabel").empty();
        $("#upData").prop("disabled",false);
    });
</script>
