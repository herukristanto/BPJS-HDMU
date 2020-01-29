<script>
function editUser(r)
{
    var idx = r.parentNode.rowIndex;
    var id = document.getElementsByName("userlist")[0].rows[idx].cells[0].innerHTML;
    var name = document.getElementsByName("userlist")[0].rows[idx].cells[1].innerHTML;

    parent.document.getElementById("userid").value = id;
    parent.document.getElementById("userid").readOnly = true;
    parent.document.getElementById("username").value = name;
    parent.document.getElementById("OK").innerHTML = "Update";
}

function editForm(r)
{
    var idx = r.parentNode.rowIndex;
    var id = document.getElementsByName("userlist")[0].rows[idx].cells[0].innerHTML;

    window.top.location.href = "UserFormEdit.php?ID=" + id;
}

function delUser(r)
{
    var idx = r.parentNode.rowIndex;
    var id = document.getElementsByName("userlist")[0].rows[idx].cells[0].innerHTML;

    if(confirm("Anda yakin ingin menghapus user " + id + " ?"))
    {
        window.location = "UserDel.php?id=" + id;
    }
}

function resetPass(r)
{
    var idx = r.parentNode.rowIndex;
    var id = document.getElementsByName("userlist")[0].rows[idx].cells[0].innerHTML;

    if(confirm("Reset password untuk user id " + id + " ?"))
    {
        window.location = "UserResetPass.php?id=" + id;
    }
}
</script>

<?php
include "koneksi.php";
if (isset($_GET['katakunci']))
{
    $katakunci = $_GET['katakunci'];
    $query = "SELECT * FROM M_User WHERE User_Id LIKE '%".$katakunci."%' OR Name LIKE '%".$katakunci."%' order by User_Id";
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $sql = sqlsrv_query( $conn, $query , $params, $options );
    $row_count = sqlsrv_num_rows( $sql );
    if ($row_count == 0) {
        echo "Data tidak ditemukan..";
    } else {
        if ($sql){
            echo "
            <table id='myTable' width=\"680\" name=\"userlist\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
            <tr>
            <td>User ID</td>
            <td>User Name</td>
            <td align=\"center\" colspan=\"4\">Action</td>
            </tr>";
            while($rs = sqlsrv_fetch_array($sql)){
                echo "
                <tr>
                  <td>".$rs['User_Id']."</td>
                  <td>".$rs['Name']."</td>
                  <td width='100px'
                  align='center'
                  style='cursor:pointer;'
                  onclick='editUser(this);'><font color='#0000EE'>Edit Data</font></td>
                  <td width='100px'
                  align='center'
                  style='cursor:pointer;'
                  onclick='editForm(this);'><font color='#0000EE'>Edit Form</font></td>
                  <td width='100px'
                  align='center'
                  style='cursor:pointer;'
                  onclick='delUser(this);'><font color='#0000EE'>Delete</font></td>
                  <td width='100px'
                  align='center'
                  style='cursor:pointer;'
                  onclick='resetPass(this);'><font color='#0000EE'>Reset Pass</font></td>
                </tr>
                ";
            }
        }
        echo"</table>";
    }
}
?>
