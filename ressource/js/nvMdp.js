var eye = 0;

function verifier_pw(){
	var pattern = /^[a-zA-Z0-9_]{4,}$/;
	var mdp = document.getElementById("mot_passe").value;
	var mdpC = document.getElementById("confirm_pw").value;

    if(mdp != ""){
		if(!pattern.test(mdp)){
			document.getElementById("err_pw").textContent = "Le mot de passe doit contenir au moins 4 caractères alpha-numériques ('_' est autorisé)";
			document.getElementById("err_pw").style.display = "block";
            document.getElementById("mot_passe").className = "erreurChamp";

		}else {

			document.getElementById("err_pw").textContent = "";
			document.getElementById("err_pw").style.display = "none";
            document.getElementById("mot_passe").className = "";
			if(mdpC != ""){
				if(!pattern.test(mdpC)){
					document.getElementById("err_cpw").textContent = "Le mot de passe doit contenir au moins 4 caractères alpha-numériques ('_' est autorisé)";
					document.getElementById("err_cpw").style.display = "block";
                    document.getElementById("confirm_pw").className = "erreurChamp";

				}else{
					if(mdp != mdpC){
						document.getElementById("err_cpw").textContent = "Le mot de passe et sa confirmation doivent etre égaux";
						document.getElementById("err_cpw").style.display = "block";
                        document.getElementById("mot_passe").className = "erreurChamp";
                        document.getElementById("confirm_pw").className = "erreurChamp";

					}else{
						document.getElementById("err_cpw").textContent = "";
						document.getElementById("err_cpw").style.display = "none";
                        document.getElementById("mot_passe").className = "correcte";
                        document.getElementById("confirm_pw").className = "correcte";
                        document.getElementById("err_submit").style.display = "none";
                        setTimeout('document.getElementById("mot_passe").className = ""', 800);
                        setTimeout('document.getElementById("confirm_pw").className = ""', 800);
					}
				}
			}
			else{
				document.getElementById("err_cpw").textContent = "Veuillez confirmer votre mot de passe";
				document.getElementById("err_cpw").style.display = "block";
			}
		}

	}else {
		document.getElementById("err_pw").textContent = "Le mot de passe doit être renseigné";
		document.getElementById("err_pw").style.display = "block";
	}
}


function afficherLettre2() {
    var x = document.getElementById("mot_passe");
    if (x.type === "password") {
       x.type = "text";
    } else {
        x.type = "password";
    }
    
     var x = document.getElementById("confirm_pw");
    if (x.type === "password") {
       x.type = "text";
    } else {
        x.type = "password";
    }

    var z = document.getElementById("eyeIcon");
    if (eye == 0) {
        z.className = "las la-eye unselectable";
        eye = 1;
    }
    else{
        z.className = "las la-eye-slash unselectable";
        eye = 0
    }
}


function validateForm(){

	var mdpPattern = /^[a-zA-Z0-9_]{4,}$/;

	var pw = document.getElementById("mot_passe").value;
	var cpw = document.getElementById("confirm_pw").value;

	if(pw == "" || cpw == "" || pw != cpw || (!mdpPattern.test(pw)) || (!mdpPattern.test(cpw))){

		document.getElementById("err_submit").textContent = "Veuillez completer le formulaire selon les demandes.";
		document.getElementById("err_submit").style.display = "block";
	}
	else {
		document.getElementById("err_submit").textContent = "";
		document.getElementById("err_submit").style.display = "none";
		document.getElementById("rr").submit();
	}
}