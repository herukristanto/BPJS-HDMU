<?php
    include "koneksi.php";
    date_default_timezone_set("Asia/Bangkok");

    $katakunci1 = str_replace("%20", " ", $_GET['katakunci1']);
    $katakunci2 = str_replace("%20", " ", $_GET['katakunci2']);
    $today = date("Y-m-d");

    $que = "select * from V_Service where Service_Id like '%".$katakunci1."%' AND Descp like '%".$katakunci2."%' AND Valid_From <= '".$today."' AND Valid_To >= '".$today."' order by Service_Id";

    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $que_exe = sqlsrv_query($conn,$que,$params,$options);
    $row = sqlsrv_num_rows($que_exe);

    if($row == 0){
        echo "
        <br>
        <h4>Data Tidak Ditemukan</h4>
        ";
    }else{
        echo "
        <table id='myTable' class='myTable1'>
            <tr>
                <td>Kode Service</td>
                <td>Deskripsi</td>
                <td colspan='4' hidden></td>
            </tr>";
        while($hasil = sqlsrv_fetch_array($que_exe, SQLSRV_FETCH_ASSOC)){
            if(is_null($hasil['Price'])){
                $hasil['Price'] = 0;
            }
            echo "
            <tr>
                <td>".$hasil['Service_Id']."</td>
                <td>".$hasil['Descp']."</td>
                <td hidden>".$hasil['Stock']."</td>
                <td hidden>".$hasil['Curr_Stock']."</td>                
                <td hidden>".$hasil['Price']."</td>
                <td hidden>".$hasil['Unit']."</td>
            </tr>";
        }
        echo "
        </table>
        ";

        echo "
            <script>
                $('.myTable1 tr').dblclick(function(){
                    $('#scode').val($(this).find('td:eq(0)').text());
                    $('#sdesc').val($(this).find('td:eq(1)').text());
                    $('#sdescp').val($(this).find('td:eq(1)').text());
                    $('#scurstock').val($(this).find('td:eq(3)').text());
                    $('#sprice').val($(this).find('td:eq(4)').text());
                    $('#sunit').val($(this).find('td:eq(5)').text());
                    
                    $('#spotstock').val($(this).find('td:eq(2)').text());
                    var stock = $(this).find('td:eq(2)').text();
                    if(stock == 'X'){
                        $('#sdoctor').val('');
                        $('#sdoctor').attr('readonly', true);
                    }else{
                        $('#sdoctor').attr('readonly', false);
                    }

                    $('#katakunci1').val('');
                    $('#katakunci2').val('');
                    $('#TabSrv').empty();
                    modal.style.display = 'none';
                });
            </script>
        ";
    }
?>
