<?php
include "koneksi.php";
$katakunci1 = $_GET['katakunci1'];
$katakunci2 = $_GET['katakunci2'];
$katakunci3 = $_GET['katakunci3'];

$query = "SELECT * FROM M_Patient WHERE PAT_NO like '%". $katakunci1 ."%' AND Name like '%". $katakunci2 ."%' AND DOB like '%". $katakunci3 ."%'";
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
            <td>Nomor Patient</td>
            <td>Nama</td>
            <td>Tanggal Lahir</td>
            <td>Jenis Kelamin</td>
            <td>No. Telp</td>
            </tr>";
            while($rs = sqlsrv_fetch_array($sql)){
                $result = $rs['DOB']->format('d-m-Y');
                echo "
                <tr id='".$rs['PAT_NO']."|".$rs['Name']."|".$result."|".$rs['Sex']."|".$rs['Telp']."' >
                <td>".$rs['PAT_NO']."</td>
                <td>".$rs['Name']."</td>
                <td>".$result."</td>
                <td>".$rs['Sex']."</td>
                <td>".$rs['Telp']."</td>
                </tr>
                ";
            }
        }
        echo"</table>";
    }
?>

<script>
    $('tr').dblclick(function(){
        var id = $(this).attr('id');
        var res = id.split("|");
        var nopasien = res[0];
        var nama = res[1];
        var tgllahir = res[2];
        var jk = res[3];
        var telp = res[4];
        $("#nopasien").val(nopasien);
        $("#nama").val(nama);
        $("#tgllahir").val(tgllahir);
        if (jk=="M"){
            radiobtn = document.getElementById("lakilaki");
            radiobtn.checked = true;
        } else if(jk=="F"){
            radiobtn = document.getElementById("perempuan");
            radiobtn.checked = true;
        }
        $("#telp").val(telp);
        modal.style.display = "none";
    })
</script>