//CUSTOM SCRIPT

//----------Change active navigation----------
$(document).ready(function() {
	var url = window.location.pathname;									//get whole path current file address.
	var filename = url.substring(url.lastIndexOf('/')+1);
	var txtLink = "a[href='"+filename+"']";
	var li1st = $(txtLink).closest('li');
		li1st.addClass('active');
	var li2nd = li1st.closest('ul');
		if(li2nd.prop("class") == "dropdown-menu"){
			li2nd.closest('li').addClass('active');
		}

	if(filename.substring(0,4) == "main"){
		$(".defMain").addClass('active');
	}
});
//--------------------------------------------

//-----------------------------------only allow number in-----------------------------------
$(document).ready(function() {
	$(".numberonly").keydown(function (e) {
		if ($.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1 ||
			(e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
			(e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
			(e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
			(e.keyCode >= 35 && e.keyCode <= 39)) {
			return;
  	}
  	if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
  		e.preventDefault();
  	}
  });
});
//-------------------------------------------------------------------------------------------

//-------canceling enter button submit except 'letit' class-------
$(document).ready(function() {
  $('input').keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});
//-------------------------------------------

//-------close page and back to main_mstr.php-------
$(".closeMstr").on('click', function () {
  $(location).attr("href","main_mstr.php");
});
//--------------------------------------------------

//---------------goto certain page---------------
function goto(path){
	window.location.href = path;
}
//-----------------------------------------------

//-------set focus to certain element with parameter ID-------
function setFoc(elID){
	document.getElementById(elID).focus();
}
//------------------------------------------------------------

//--------------------check if date is valid--------------------
function isValidDate(strDate) {
	var patternDot = /^([0-9]{2})\.([0-9]{2})\.([0-9]{4})$/;

	if (patternDot.test(strDate)){
		strDate = strDate.replace(/\./g,"/");
	}

	var pattern =/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/;

	if(pattern.test(strDate)){
		var day = [0,31,28,31,30,31,30,31,31,30,31,30,31];
		var tahun = Number(strDate.substring(6,10));
		var bulan = Number(strDate.substring(3,5));
		var tanggal = Number(strDate.substring(0,2));

		if( tahun % 4 == 0){		//Tahun kabisat
			day[2] = 29
		}

		if( tanggal > day[bulan] || bulan > 12){
			alert("Tanggal yang dimasukan tidak valid");
			return false;
		}
		else{
			return true;
		}
	}else{
		alert("Format tanggal harus sesuai dd/mm/yyyy");
		return false;
	}
}
//--------------------------------------------------------------

//--------------------check if time is valid--------------------
function isValidTime(strTime){
	var pattern = /^(?:2[0-3]|[0-1][0-9])\:([0-5][0-9])$/;
	if(pattern.test(strTime) == false){
		alert("Jam yang dimasukan tidak valid");
		return false;
	}
}

//--------------------------------------------------------------
