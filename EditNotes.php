<style>
  .modala-content{
    width:50% !important;
  }
  textarea{
    width: 98%;
    margin-bottom: 10px;
  }
  h4{
    font-size: 18px;
    margin:5px;
  }
</style>
<link rel="stylesheet" type="text/css" href="css/customStyle.css">

<div id="myModal" class="modala">
  <form method="post" action="saveNotes.php" target="tableNotes" onsubmit="clsEditNote();">
    <input type="hidden" name="hidId" id="hidId" value="" />
    <input type="hidden" name="hidUser" value="<?php echo $_SESSION["username"]; ?>" />
    <input type="hidden" name="hidPatno" value="<?php echo $patno; ?>" />
    <input type="hidden" name="hidCaseno" id="hidCaseno" value="<?php echo $caseno; ?>" />

    <div class="modala-content">
      <div class="modala-header">
        <span class="close">&times;</span>
        <h2>Edit Notes</h2>
      </div>

      <div class="modala-body">
        <h4>notes :</h4>
        <textarea id="editNote" name="catatan" rows="9" maxlength="250"></textarea>
        <button type="submit" class="btn" id='upNote'>Save Notes</button>
        <button type="button" class="btn" id='closeNote'>Close</button>
      </div>
    </div>
  </form>
</div>

<script>
var modal = document.getElementById('myModal');
var span = document.getElementsByClassName("close")[0];   // Get the <span> element that closes the modal
var cls = document.getElementById('closeNote');           //button close


span.onclick = function() {         // When the user clicks on <span> (x), close the modal
  modal.style.display = "none";
}

cls.onclick = function() {
  modal.style.display = "none";
}

function clsEditNote(){
  parent.document.getElementById('tableNotes').contentDocument.write("<style>h3{font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif;}</style><h3>Please Wait . . .</h3>");
  modal.style.display = "none";
}

window.onclick = function(event) {      // When the user clicks anywhere outside of the modal, close it
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

function upNote(){
  
}
</script>