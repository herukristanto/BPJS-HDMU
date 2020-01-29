<?php
include "koneksi.php";
if (isset($_GET['katakunciserviceID']))
{
    // $katakunciserviceID = $_GET['katakunciserviceID'];
    $katakunciserviceID = str_replace("%20", " ", $_GET['katakunciserviceID']);
    
    $query = "SELECT Service_Id, Descp FROM M_Service WHERE Service_Id like '%". $katakunciserviceID ."%'";
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
            <td>Kode Service</td>
            <td>Deskripsi</td>
            </tr>";
            while($rs1 = sqlsrv_fetch_array($sql)){
                echo "
                <tr id='".$rs1['Service_Id']."|".$rs1['Descp']."' >
                <td>".$rs1['Service_Id']."</td>
                <td>".$rs1['Descp']."</td>
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
        var id1 = $(this).attr('id');
        var res1 = id1.split("|");
        var serviceid1 = res1[0];
        var deskripsi1 = res1[1];

        document.getElementById('serviceid').value = '';
        document.getElementById('deskripsi').value = '';
        document.getElementById('harga').value = '';

        $("#serviceid").val(serviceid1);
        $("#deskripsi").val(deskripsi1);

        modal.style.display = "none";
    })
</script>
