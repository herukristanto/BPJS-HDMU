<?php
include "koneksi.php";
if (isset($_GET['katakunci1']))
{
    $katakunci1 = str_replace("%20", " ", $_GET['katakunci1']);
    $katakunci2 = str_replace("%20", " ", $_GET['katakunci2']);
    $query = "SELECT * FROM M_Doctor WHERE Doctor_Id like '%". $katakunci1 ."%' AND Name like '%". $katakunci2 ."%' and Active = 'X'";
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $sql = sqlsrv_query( $conn, $query , $params, $options );
    $row_count = sqlsrv_num_rows( $sql );
    
    if ($row_count == 0) {
        echo "Data tidak ditemukan..";
    } else {
        if ($sql){
            echo "
            <table id='myTable' class='myTable2'>
                <tr>
                    <td>Kode Dokter</td>
                    <td>Nama Dokter</td>
                </tr>";
            while($rs = sqlsrv_fetch_array($sql)){
                echo "
                <tr>
                    <td>".$rs['Doctor_Id']."</td>
                    <td>".$rs['Name']."</td>
                </tr>
                ";
            }
        }
        echo"</table>";

        echo "
            <script>
                $('.myTable2 tr').dblclick(function(){
                    $('#sdoctor').val($(this).find('td:eq(0)').text());

                    $('#searchKey1').val('');
                    $('#searchKey2').val('');
                    $('#TabDoc').empty();
                    modalDoc.style.display = 'none';
                });
            </script>
        ";
    }
}
?>
