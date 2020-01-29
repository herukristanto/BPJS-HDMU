<?php echo '<link rel="stylesheet" type="text/css" href="css/customStyle.css">'; ?>

<div id="myModal" class="modala">
  <div class="modala-content">

    <div class="modala-header">
      <span class="close">&times;</span>
      <h2>Find Session</h2>
	</div>

    <div class="modala-body">
      <table width="316" border="0">
        <tr>
          <td width="200">User</td>
          <td width="20">:</td>
          <td width="188"><label for="User"></label>
          <input type="text" name="srcuser" id="srcuser" class="key2" /></td>
        </tr>
        <tr>
          <td width="200">Terminal</td>
          <td width="20">:</td>
          <td width="188"><label for="Term"></label>
          <input type="text" name="srcterm" id="srcterm" class="key2" /></td>
        </tr>
      </table>
	  <span id="tab2"></span>
    </div>

  </div>
</div>

<script>
var modal = document.getElementById('myModal');
var btn = document.getElementById("Search");				// Get the button that opens the modal
var span = document.getElementsByClassName("close")[0];		// Get the <span> element that closes the modal

btn.onclick = function() {					// When the user clicks the button, open the modal
    modal.style.display = "block";
}

span.onclick = function() {					// When the user clicks on <span> (x), close the modal
	$("#srcuser").val('');
	$("#srcterm").val('');
	$("#tab2").empty();
    modal.style.display = "none";
}

window.onclick = function(event) {			// When the user clicks anywhere outside of the modal, close it
    if (event.target == modal) {
		$("#srcuser").val('');
		$("#srcterm").val('');
		$("#tab2").empty();
		modal.style.display = "none";
    }
}

$('.key2').bind("enterKey",function(e){		//Function "enterKey"
  var url = 'SearchUserCollection.php?usercollection=' + $("#srcuser").val()+ "&terminal=" + $("#srcterm").val();
  url = url.replace(" ","%20");

  $("#tab2").empty();
  $("#tab2").html("<h2>Please Wait. . . .</h2>");
	$("#tab2").load(url);
});

$('.key2').keyup(function(e){				//Trigger for "enter" key event.
	if(e.keyCode == 13){
		$(this).trigger("enterKey");
	}
});

</script>
