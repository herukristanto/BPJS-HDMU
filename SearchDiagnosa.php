<?php echo '<link rel="stylesheet" type="text/css" href="css/customStyle.css">'; ?>

<div id="myModal" class="modala">
  <div class="modala-content">

    <div class="modala-header">
      <span class="close">&times;</span>
      <h2>Search Diagnosa</h2>
	</div>

    <div class="modala-body">
      <table border="0">
        <tr>
          <td width="120">Group</td>
          <td width="9">:</td>
          <td width="188"><input type="text" name="srcGroup" id="srcGroup" class="key1" /></td>
        </tr>
        <tr>
          <td>Kode Diagnosa</td>
          <td>:</td>
          <td><input type="text" name="srcKode" id="srcKode" class="key1"/></td>
        </tr>
        <tr>
          <td>Deskripsi</td>
          <td>:</td>
          <td><input type="text" name="srcDesc" id="srcDesc" class="key1"/></td>
        </tr>
      </table>
	   <span id="tab1"></span>
    </div>

  </div>
</div>

<script>
var modal = document.getElementById('myModal');
var btn = document.getElementById("SrcDiag");				// Get the button that opens the modal
var span = document.getElementsByClassName("close")[0];		// Get the <span> element that closes the modal

btn.onclick = function() {					// When the user clicks the button, open the modal
	modal.style.display = "block";
	$("#srcGroup").focus();
}

span.onclick = function() {					// When the user clicks on <span> (x), close the modal
	$("#srcGroup").val('');
	$("#srcKode").val('');
	$("#srcDesc").val('');
	$("#tab1").empty();
    modal.style.display = "none";
}

window.onclick = function(event) {			// When the user clicks anywhere outside of the modal, close it
    if (event.target == modal) {
		$("#srcGroup").val('');
		$("#srcKode").val('');
		$("#srcDesc").val('');
		$("#tab1").empty();
        modal.style.display = "none";
    }
}

$('.key1').bind("enterKey",function(e){		//Function "enterKey"
	$("#tab1").empty();
  $("#tab1").html("<h2>Please Wait. . . .</h2>");
	$("#tab1").load('SearchDiagTable.php?grup=' + $("#srcGroup").val() + "&kode=" + $("#srcKode").val() + "&desc=" + $("#srcDesc").val());
});

$('.key1').keyup(function(e){				//Trigger for "enter" key event.
	if(e.keyCode == 13){
		$(this).trigger("enterKey");
	}
});

</script>
