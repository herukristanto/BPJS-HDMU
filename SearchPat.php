<?php echo '<link rel="stylesheet" type="text/css" href="css/customStyle.css">'; ?>

<div id="myModal" class="modala">
  <div class="modala-content">

    <div class="modala-header">
      <span class="close">&times;</span>
      <h2>Search Patient</h2>
	</div>

    <div class="modala-body">
      <table border="0">
        <tr>
          <td width="120">No. Pasien</td>
          <td width="9">:</td>
          <td width="188"><input type="text" name="srcPatno" id="srcPatno" class="key1" /></td>
        </tr>
        <tr>
          <td>Nama Pasien</td>
          <td>:</td>
          <td><input type="text" name="srcPatnam" id="srcPatnam" class="key1"/></td>
        </tr>
        <tr>
          <td>Tanggal Lahir</td>
          <td>:</td>
          <td><input type="text" name="srcDOB" id="srcDOB" class="key1"/></td>
        </tr>
      </table>
	  <span id="tab1"><?php include "SearchPatTable.php"; ?></span>
    </div>

  </div>
</div>

<script>
var modal = document.getElementById('myModal');
var btn = document.getElementById("Searchpat");				// Get the button that opens the modal
var span = document.getElementsByClassName("close")[0];		// Get the <span> element that closes the modal

btn.onclick = function() {					// When the user clicks the button, open the modal
    modal.style.display = "block";
}

span.onclick = function() {					// When the user clicks on <span> (x), close the modal
	$("#srcPatno").val('');
	$("#srcPatnam").val('');
	$("#srcDOB").val('');
	$("#tab1").empty();
    modal.style.display = "none";
}

window.onclick = function(event) {			// When the user clicks anywhere outside of the modal, close it
    if (event.target == modal) {
		$("#srcPatno").val('');
		$("#srcPatnam").val('');
		$("#srcDOB").val('');
		$("#tab1").empty();
        modal.style.display = "none";
    }
}

$('.key1').bind("enterKey",function(e){		//Function "enterKey"
  var url = 'SearchPatTable.php?patno=' + $("#srcPatno").val() + "&nama=" + $("#srcPatnam").val() + "&tgl=" + $("#srcDOB").val();
  url = url.replace(" ","%20");
  
	$("#tab1").empty();
  $("#tab1").html("<h2>Please Wait. . . .</h2>");
	$("#tab1").load(url);
});

$('.key1').keyup(function(e){				//Trigger for "enter" key event.
	if(e.keyCode == 13){
		$(this).trigger("enterKey");
	}
});

</script>
