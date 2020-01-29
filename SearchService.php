<link href="css/customStyle.css" rel="stylesheet">

<div id="myModal" class="modala">

  <div class="modala-content">
    <div class="modala-header">
      <span class="close" id="close1">&times;</span>
      <h2>Search Master Service</h2>
    </div>
    <div class="modala-body">
      <br>
      <table>
        <tr>
          <td>Kode Service</td>
          <td width="15px">:</td>
          <td><input type="text" class="key" id="katakunci1" name="katakunci"></td>
          <td></td>
        </tr>
        <tr>
          <td>Deskripsi</td>
          <td>:</td>
          <td><input type="text" class="key" id="katakunci2" name="katakunci"></td>
          <td><button type="button" class="btn" id="saringtabel">Search</button></td>
        </tr>
      </table>
      <div id="TabSrv"></div>
      <br>
    </div>
  </div>
</div>
<script>

// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span1 = document.getElementById("close1");

// When the user clicks the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
  document.getElementById("katakunci1").focus();
}

// When the user clicks on <span> (x), close the modal
span1.onclick = function() {
  document.getElementById('katakunci1').value='';
  document.getElementById('katakunci2').value='';
  $("#TabSrv").empty();
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
// dipindah ke SearchServiceDoctor.php
// window.onclick = function(event) {
//   if (event.target == modal) {
//     document.getElementById('katakunci1').value='';
//     document.getElementById('katakunci2').value='';
//     $("#TabSrv").empty();
//     modal.style.display = "none";
//   }
// }

$(document).ready(function(){
  $("#saringtabel").click(function()
  {
    var url = 'SearchServiceTable.php?katakunci1='+$("#katakunci1").val()+'&katakunci2='+$("#katakunci2").val();
    url = url.replace(" ","%20");

    $("#TabSrv").empty();
    $("#TabSrv").html("<h2>Please Wait. . . .</h2>");
    $("#TabSrv").load(url);
  });
});

$('.key').keyup(function(e){       //Trigger for "enter" key event.
  if(e.keyCode == 13){
    $("#saringtabel").trigger("click");
  }
});

// $('.key').bind("enterKey",function(e){   //Function "enterKey"
//   $("#TabSrv").empty();
//   $("#TabSrv").html("<h2>Please Wait. . . .</h2>");
//   $("#TabSrv").load('SearchServiceTable.php?katakunci1='+$("#katakunci1").val()+'&katakunci2='+$("#katakunci2").val());
// });

</script>
