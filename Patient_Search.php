<link href="css/customStyle.css" rel="stylesheet">

<div id="myModal" class="modala">

  <div class="modala-content">
    <div class="modala-header">
      <span class="close">&times;</span>
      <h2>Filter Data Dokter</h2>
    </div>
    <div class="modala-body">
      <br>
      <h4>Saring data pasien yang dimaksud berdasarkan :</h4>
      <br>
      <table>
        <tr>
          <td>Nomor Pasien</td>
          <td> : </td>
          <td><input type="text" id="katakunci1" name="katakunci"></td>
        </tr>
        <tr>
          <td>Nama Pasien</td>
          <td> : </td>
          <td><input type="text" id="katakunci2" name="katakunci"></td>
        </tr>
        <tr>
          <td>Tanggal Lahir</td>
          <td> : </td>
          <td><input type="text" id="katakunci3" name="katakunci3"></td>
        </tr>
        <tr>
          <td colspan="3" align="right"><button id="saringtabel">Saring</button></td>
        </tr>
      </table>
      <br>
      <div id="tampiltabel">
        <!-- div untuk menampilkan tabel -->
      </div>
      <br>
    </div>
  </div>
</div>
<script>

// Get the modal
$(document).ready(function(){
  $("#saringtabel").click(function()
  {
    $("#tampiltabel").empty();
    $("#tampiltabel").html("<h2>Please Wait. . . .</h2>");
    $("#tampiltabel").load('Patient_Search_Table.php?katakunci1='+$("#katakunci1").val()+'&katakunci2='+$("#katakunci2").val()+'&katakunci3='+$("#katakunci3").val());
  });
});

function handle(e) {
  if (e.keyCode == 13) {
    $("#tampiltabel").empty();
    $("#tampiltabel").html("<h2>Please Wait. . . .</h2>");
    $("#tampiltabel").load('Patient_Search_Table.php?katakunci1='+$("#katakunci1").val()+'&katakunci2='+$("#katakunci2").val()+'&katakunci3='+$("#katakunci3").val());
  }
}

var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
