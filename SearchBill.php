<?php echo '<link rel="stylesheet" type="text/css" href="css/customStyle.css">'; ?>

<div id="myModal" class="modala">
  <div class="modala-content">

    <div class="modala-header">
      <span class="close">&times;</span>
      <h2>Search Invoice</h2>
	</div>

    <div class="modala-body">
      <table width="316" border="0">
        <tr>
          <td width="97">No. Invoice</td>
          <td width="9">:</td>
          <td width="188"><input type="text" name="srcInvno" id="srcInvno" class="key2" /></td>
        </tr>
        <tr>
          <td>No. Case</td>
          <td>:</td>
          <td><input type="text" name="srcCaseno" id="srcCaseno" class="key2"/></td>
        </tr>
      </table>
	  <span id="tab2"><?php include "SearchBillTable.php"; ?></span>
    </div>

  </div>
</div>

<script>
var modal = document.getElementById('myModal');
var btn = document.getElementById("SrcBill");				// Get the button that opens the modal
var span = document.getElementsByClassName("close")[0];		// Get the <span> element that closes the modal

btn.onclick = function() {					// When the user clicks the button, open the modal
    modal.style.display = "block";
}

span.onclick = function() {					// When the user clicks on <span> (x), close the modal
	$("#srcInvno").val('');
	$("#srcCaseno").val('');
	$("#tab2").empty();
    modal.style.display = "none";
}

window.onclick = function(event) {			// When the user clicks anywhere outside of the modal, close it
    if (event.target == modal) {
		$("#srcInvno").val('');
		$("#srcCaseno").val('');
		$("#tab2").empty();
        modal.style.display = "none";
    }
}

$('.key2').bind("enterKey",function(e){		//Function "enterKey"
  var url = 'SearchBillTable.php?invno=' + $("#srcInvno").val() + "&caseno=" + $("#srcCaseno").val();
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
