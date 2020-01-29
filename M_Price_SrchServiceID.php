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
          <td>Kode Service</td>
          <td> : </td>
          <td><input type="text" id="katakunci" name="katakunci"></td>
          <td><button type="button" class="btn" id="saringtabel">Saring</button></td>
        </tr>
      </table>
      <div id="tampiltabel">
      </div>
    </div>
  </div>
</div>
<!-- <script type="text/javascript" src="Script/jquery-1.10.1.min.js"></script> -->
<script>

// Get the modalserviceID
$(document).ready(function(){
  $("#saringtabel").click(function()
  {
    var url = 'M_Price_Table_ServiceID.php?katakunciserviceID='+$("#katakunci").val();
    url = url.replace(" ","%20");

  	$("#tampiltabel").empty();
    $("#tampiltabel").html("<h2>Please Wait. . . .</h2>");
    $("#tampiltabel").load(url);
  });

  $("input[name='katakunci']").bind("enterKey",function(e){		//Function "enterKey"
    var url = 'M_Price_Table_ServiceID.php?katakunciserviceID='+$("#katakunci").val();
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

// Get the button that opens the modalserviceID
var btn = document.getElementById("myBtn");

// Get the <span> element that closeserviceIDs the modalserviceID
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modalserviceID
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), closeserviceID the modalserviceID
span.onclick = function() {
  $("#tampiltabel").empty();
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modalserviceID, closeserviceID it
window.onclick = function(event) {
  if (event.target == modalserviceID) {
    $("#tampiltabel").empty();
    modal.style.display = "none";
  }
}
</script>
