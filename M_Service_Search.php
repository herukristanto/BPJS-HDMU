<link href="css/customStyle.css" rel="stylesheet">

<div id="myModal" class="modala">
  <div class="modala-content">
    <div class="modala-header">
      <span class="close">&times;</span>
      <h2>Filter Data Service</h2>
    </div>
    <div class="modala-body">
    </br>
      <table>
        <tr>
          <td>Kode service</td>
          <td> : </td>
          <td><input type="text" id="katakunci" name="katakunci"></td>
          <td><button type="button" class="btn" id="saringtabel">Saring</button></td>
        </tr>
      </table>
      <div id="tampiltabel"></div>
    </div>
  </div>
</div>

<script>

// Get the modal
$(document).ready(function(){
  $("#saringtabel").click(function()
  {
    var url = 'M_Service_Table.php?katakunci='+$("#katakunci").val();
    url = url.replace(" ","%20");

    $("#tampiltabel").empty();
    $("#tampiltabel").html("<h2>Please Wait. . . .</h2>");
    $("#tampiltabel").load(url);
  });

  $("input[name='katakunci']").bind("enterKey",function(e){		//Function "enterKey"
    var url = 'M_Service_Table.php?katakunci='+$("#katakunci").val();
    url = url.replace(" ","%20");

    $("#tampiltabel").empty();
    $("#tampiltabel").html("<h2>Please Wait. . . .</h2>");
    $("#tampiltabel").load(url);
  });

  $("input[name='katakunci']").keyup(function(e){				//Trigger for "enter" key event.
    if(e.keyCode == 13){
      $(this).trigger("enterKey");
    }
  });
});

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
  $("#tampiltabel").empty();
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    $("#tampiltabel").empty();
    modal.style.display = "none";
  }
}

</script>
