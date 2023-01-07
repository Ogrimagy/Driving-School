  var a=0;
  var m=0;
  var j=0;
function verifier_justif(){
	var justification = document.getElementById("subject").value;
	var justifPattern = /^[a-zA-Z0-9]+$/;
	if(justification == ""){
		document.getElementById("err_case").textContent = "La justification doit etre renseignée";
	}
	else if(!justifPattern.test(justification)){
		document.getElementById("err_case").textContent = "La justification accepte des les lettres(a-zA-Z) et les chiffres(0-9)";
	}
	else{
		document.getElementById("err_case").textContent = "";
	}
}
 function verifier_dates(){
            var date_absence = document.getElementById("date_absen").value;
            var currentDate = new Date();

            if (date_absence=="") {
                document.getElementById("err_naiss1").textContent = "La date d'absence doit etre spécifiée";
                document.getElementById("date_absen").className = "erreurChamp";
                
            }
            
        }

function validateForm(){
var justification = document.getElementById("subject").value;
 var date_absence = document.getElementById("date_absen").value;
var justifPattern = /^[a-zA-Z0-9]+$/;
 
if(justification == null || a<0 || j<0 || m<0 || (!justifPattern.test(justification)) ){
    		 document.getElementById("err_submit").textContent = "veuillez vérifier votre saisi";
    		return false;
    	}
    	else
    	{
   
    		document.getElementById("err_submit").submit();
    		return true;
    	}
}