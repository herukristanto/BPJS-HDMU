<?php
include "koneksi.php";
if (isset($_GET['katakunci1']))
{
   $katakunci1 = $_GET['katakunci1'];
   $katakunci2 = $_GET['katakunci2'];
   $query = "SELECT * FROM M_Group_Diag WHERE Group_Id like '%". $katakunci1 ."%' AND Group_Desc like '%". $katakunci2 ."%'";
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
        <td>Group ID</td>
        <td>Desc</td>
        </tr>";
        while($rs = sqlsrv_fetch_array($sql)){
            echo "
            <tr id='".$rs['Group_Id']."|".$rs['Group_Desc']."' >
            <td>".$rs['Group_Id']."</td>
            <td>".$rs['Group_Desc']."</td>
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
        var Group_Id = res[0];
        var Desc = res[1];
        $("#group_id").val(Group_Id);
        $("#desc").val(Desc);
        
        modal.style.display = "none";

        $("#tampiltabel").empty();
        $("#upData").prop( "disabled", false );

    })
</script>
