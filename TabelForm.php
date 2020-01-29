<script>
function editForm(r)
{
    var idx = r.parentNode.rowIndex;
    var id = document.getElementsByName("formlist")[0].rows[idx].cells[0].innerHTML;
    var name = document.getElementsByName("formlist")[0].rows[idx].cells[1].innerHTML;

    parent.document.getElementById("formid").value = id;
    parent.document.getElementById("formid").readOnly = true;
    parent.document.getElementById("formname").value = name;
    parent.document.getElementById("OK").innerHTML = "Update";
}

function delForm(r)
{
    var idx = r.parentNode.rowIndex;
    var id = document.getElementsByName("formlist")[0].rows[idx].cells[0].innerHTML;

    if(confirm("Anda yakin ingin menghapus user " + id + " ?"))
    {
        window.location = "FormDel.php?id=" + id;
    }
}
</script>

<?php
include "koneksi.php";
if (isset($_GET['katakunci']))
{
    // $katakunci = $_GET['katakunci'];
    $katakunci = str_replace("%20", " ", $_GET['katakunci']);
    
    $query = "SELECT * FROM M_Form WHERE Form_Id LIKE '%".$katakunci."%' order by Form_Id";
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $sql = sqlsrv_query( $conn, $query , $params, $options );
    $row_count = sqlsrv_num_rows( $sql );
    if ($row_count == 0) {
        echo "Data tidak ditemukan..";
    } else {
        if ($sql){
            echo "
            <table id='myTable' name=\"formlist\" cellspacing=\"0\" cellpadding=\"0\">
            <tr>
            <td width=\"130\">Form ID</td>
            <td width=\"200\">Form Name</td>
            <td colspan=\"4\">Action</td>
            </tr>";
            while($rs = sqlsrv_fetch_array($sql)){
                echo "
                <tr>
                        <td>".$rs['Form_Id']."</td>
                        <td>".$rs['Form_Name']."</td>
                        <td width='100px'
                            align='center'
                            style='cursor:pointer;'
                            onclick='editForm(this);'><font color='#0000EE'>Edit</font></td>
                        <td width='100px'
                            align='center'
                            style='cursor:pointer;'
                            onclick='delForm(this);'><font color='#0000EE'>Delete</font></td>
                    </tr>
                ";
            }
        }
        echo"</table>";
    }
}
?>
