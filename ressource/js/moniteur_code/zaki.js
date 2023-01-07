    
    var a=0;
    var m=0;
    var j=0;

function verifier_justif(){
	var justification = document.getElementById("subject").value;
	if(justification == ""){
		document.getElementById("err_case").textContent = "La justification doit etre renseignée.";
	}
    else if (justification.length < 10) {
        document.getElementById("err_case").textContent = "Votre justification est trop courte!.";
    }
	else{
		document.getElementById("err_case").textContent = "";
        if (document.getElementById("err_naiss1").textContent == ""){
            document.getElementById("err_submit").textContent = "";
        }
	}
}
 function verifier_dates(){
    var date_absence = document.getElementById("date_absen").value;
    var currentDate = new Date();

    if (date_absence=="") {
        document.getElementById("err_naiss1").textContent = "La date d'absence doit etre spécifiée.";
        document.getElementById("date_absen").className = "erreurChamp";
        
    }
    else{
        date_absence = date_absence.split("-");// year

        var currYear = currentDate.getFullYear();
        var currMonth = currentDate.getMonth();
        var currDay = currentDate.getDate();

        if(currYear > date_absence[0] || currMonth > date_absence[1] || currDay > date_absence[2]){
            document.getElementById("err_naiss1").textContent = "Vous ne pouvez pas choisir une date antérieur!";
            document.getElementById("date_absen").className = "erreurChamp";

        }else{
            document.getElementById("err_naiss1").textContent = "";
            document.getElementById("date_absen").className = "correcte";
            setTimeout('document.getElementById("date_absen").className = ""', 800);
            if (document.getElementById("err_case").textContent == ""){
                document.getElementById("err_submit").textContent = "";
            }
        }
    }
}

function validateForm(){
    verifier_justif();
    verifier_dates();
    var justification = document.getElementById("err_case").textContent;
    var date_absence = document.getElementById("err_naiss1").textContent;

    if(justification != "" || date_absence != "") {
    	document.getElementById("err_submit").textContent = "Veuillez vérifier votre saisie.";	
    }
    else {
        document.getElementById("err_submit").textContent = "";
    	document.getElementById("formulaire").submit();
    	return true;
    }
}