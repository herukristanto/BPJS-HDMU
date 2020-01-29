<?php
include "koneksi.php";
if (isset($_GET['katakunci']))
{
    // $katakunci = $_GET['katakunci'];
    $katakunci = str_replace("%20", " ", $_GET['katakunci']);

    $query = "SELECT P.Service_Id, S.Descp, P.Price, P.Valid_From, P.Valid_To FROM M_Service S, M_Price P WHERE P.Service_Id=S.Service_Id AND P.Service_Id LIKE '%".$katakunci."%' order by P.Service_Id;";
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $sql = sqlsrv_query( $conn, $query , $params, $options );
    $row_count = sqlsrv_num_rows( $sql );
    if ($row_count == 0) {
        echo "Data tidak ditemukan..";
    } else {
        if ($sql){
            echo "
            <table id=\"myTable\">
            <tr>
            <td>Kode Service</td>
            <td>Deskripsi</td>
            <td>Harga</td>
            <td>Valid From</td>
            <td>Valid To</td>
            </tr>";
            while($rs = sqlsrv_fetch_array($sql)){
                $result = $rs['Valid_From']->format('d/m/Y');
                $result2 = $rs['Valid_To']->format('d/m/Y');
                echo "
                <tr>
                <td>".$rs['Service_Id']."</td>
                <td>".$rs['Descp']."</td>
                <td>".number_format($rs['Price'],0,",",".")."</td>
                <td>".$result."</td>
                <td>".$result2."</td>
                </tr>
                ";
            }
        }
        echo"</table>";
    }
}
?>

<script>
    // $('tr').dblclick(function(){
    //     var id = $(this).attr('id');
    //     var res = id.split("|");
    //     var serviceid = res[0];
    //     var deskripsi = res[1];
    //     var price = res[2];
    //     var validfrom = res[3];
    //     var validto = res[4];


    //     $("#serviceid").val(serviceid);
    //     $("#deskripsi").val(deskripsi);
    //     $("#harga").val(price);
    //     $("#datepicker").val(validfrom);
    //     $("#datepicker1").val(validto);

    //     modal.style.display = "none";

    //     $("#tampiltabel").empty();
    //     $("#upData").prop("disabled",false);

    // })
    $('#myTable tr').dblclick(function(){
        var harga = $(this).find("td:eq(2)").text();
        harga = harga.replace(".", "");

        $("#serviceid").val($(this).find("td:eq(0)").text());
        $("#deskripsi").val($(this).find("td:eq(1)").text());
        $("#harga").val(harga);
        $("#datepicker").val($(this).find("td:eq(3)").text());
        $("#datepicker1").val($(this).find("td:eq(4)").text());

        modal.style.display = "none";

        $("#tampiltabel").empty();
        $("#katakunci").val("");
        $("#upData").prop("disabled",false);
    })
</script>
