<style>
  /* script untuk search form */
  /* The Modal (background) */
  .modalDoc {
      display: none; /* Hidden by default */
      position: fixed; /* Stay in place */
      z-index: 1; /* Sit on top */
      padding-top: 100px; /* Location of the box */
      left: 0;
      top: 0;
      width: 100%; /* Full width */
      height: 100%; /* Full height */
      overflow: auto; /* Enable scroll if needed */
      background-color: rgb(0,0,0); /* Fallback color */
      background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  }

  /* Modal Content */
  .modalDoc-content {
      position: relative;
      background-color: #fefefe;
      margin: auto;
      margin-bottom: 200px;
      padding: 0;
      border: 1px solid #888;
      width: 80%;
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
      -webkit-animation-name: animatetop;
      -webkit-animation-duration: 0.1s;
      animation-name: animatetop;
      animation-duration: 0.4s
  }

  .modalDoc-header {
      padding: 2px 16px;
      background-color: #5cb85c;
      color: white;
  }

  .modalDoc-body {padding: 2px 16px 30px; height: auto;}

  .modalDoc-footer {
      padding: 2px 16px;
      background-color: #5cb85c;
      color: white;
  }
</style>

<div id="myModalDoc" class="modalDoc">
  <div class="modalDoc-content">
    <div class="modalDoc-header">
      <span class="close" id="close2">&times;</span>
      <h2>Filter Data Dokter</h2>
    </div>
    <div class="modalDoc-body">
    </br>
      <table>
        <tr>
          <td>Kode Dokter</td>
          <td>:</td>
          <td><input type="text" class="key1" id="searchKey1" name="searchKey1"></td>
        </tr>
        <tr>
          <td>Nama Dokter</td>
          <td>:</td>
          <td>
            <input type="text" class="key1" id="searchKey2" name="searchKey2">
            <button type="button" class="btn" id="searchBut">Search</button>
          </td>
        </tr>
      </table>
      <div id="TabDoc"></div>
    </div>
  </div>
</div>
<script>

// Get the modal
var modalDoc = document.getElementById('myModalDoc');

// Get the button that opens the modal
var btnDoc = document.getElementById("dokSrc");

// Get the <span> element that closes the modal
var span2 = document.getElementById("close2");

// When the user clicks the button, open the modal
btnDoc.onclick = function() {
  modalDoc.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span2.onclick = function() {
  modalDoc.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modalDoc || event.target == modal) {
    //milik SearchService.php
    document.getElementById('katakunci1').value='';
    document.getElementById('katakunci2').value='';
    $("#TabSrv").empty();
    modal.style.display = "none";

    //milik SearchServiceDoctor.php

    modalDoc.style.display = "none";
  }
}

$(document).ready(function(){
  $("#searchBut").click(function()
  {
    var url = 'SearchServiceDoctorTable.php?katakunci1='+$("#searchKey1").val()+'&katakunci2='+$("#searchKey2").val();
    url = url.replace(" ","%20");

    $("#TabDoc").empty();
    $("#TabDoc").html("<h2>Please Wait. . . .</h2>");
    $("#TabDoc").load(url);
  });
});

$('.key1').keyup(function(e){       //Trigger for "enter" key event.
  if(e.keyCode == 13){
    $("#searchBut").trigger("click");
  }
});

// $('.key1').bind("enterKey",function(e){   //Function "enterKey"
//   $("#TabDoc").empty();
//   $("#TabDoc").html("<h2>Please Wait. . . .</h2>");
//   $("#TabDoc").load('SearchServiceDoctorTable.php?katakunci1='+$("#searchKey1").val()+'&katakunci2='+$("#searchKey2").val());
// });

</script>
