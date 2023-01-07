$n = 0; $l = 0; $r = 0; $r2 = 0; $t = 0; $t2 = 0; $t3 = 0; ; $liste = 0;

function removeLoader() {
	$loader = document.getElementById("loading");
	$loader.style.display = "none";
}

function closeNav() {
	$menu = document.getElementById("sidePanel").style.marginLeft;
	if ( $menu == "-260px"){
		document.getElementById("sidePanel").style.marginLeft = "0px";
		document.getElementById("divNotification").style.marginLeft = "0px";
		document.getElementById("divProfile").style.marginLeft = "0px";
		document.getElementById("divResultatCreno").style.margin = "100px calc(11% + 200px) auto";
		document.getElementById("divResultatCircuit").style.margin = "100px calc(11% + 200px) auto";
		document.getElementById("divText").style.margin = "100px calc(11% + 200px) auto";
		document.getElementById("divText2").style.margin = "100px calc(11% + 200px) auto";
		document.getElementById("divText3").style.margin = "100px calc(11% + 200px) auto";
		document.getElementById("listeCandidatCond").style.margin = "100px calc(11% + 200px) auto";;
		document.getElementById("arrows").style.transform = "rotate(0deg)";
		
	}else {
		document.getElementById("sidePanel").style.marginLeft = "-260px";
		document.getElementById("divNotification").style.marginLeft = "-260px";
		document.getElementById("divProfile").style.marginLeft = "-260px";
		document.getElementById("divResultatCreno").style.margin = "100px 13% auto";
		document.getElementById("divResultatCircuit").style.margin = "100px 13% auto";
		document.getElementById("divText").style.margin = "100px 13% auto";
		document.getElementById("divText2").style.margin = "100px 13% auto";
		document.getElementById("divText3").style.margin = "100px 13% auto";
		document.getElementById("listeCandidatCond").style.margin = "100px 13% auto";
		document.getElementById("arrows").style.transform = "rotate(180deg)";
	}  
}

function afficherNotification() {
	if ( $n == 0){
		$n = 1; $l = 0; $r = 0; $r2 = 0; $t = 0; $t2 = 0; $t3 = 0; $liste = 0;
		setTimeout('document.getElementById("divNotification").style.opacity = "1"', 1);
		document.getElementById("divNotification").style.opacity = "0.5";
		document.getElementById("divNotification").style.display = "block";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divResultatCreno").style.display = "none";
		document.getElementById("divResultatCircuit").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";
		document.getElementById("listeCandidatCond").style.display = "none";
		
	}else{
		$n = 0;
		document.getElementById("divNotification").style.display = "none";
	}
}

function afficherProfile() {
	if ( $l == 0){
		$n = 0; $l = 1; $r = 0; $r2 = 0; $t = 0; $t2 = 0; $t3 = 0; $liste = 0;
		setTimeout('document.getElementById("divProfile").style.opacity = "1"', 1);
		document.getElementById("divProfile").style.opacity = "0.5";
		document.getElementById("divProfile").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divResultatCreno").style.display = "none";
		document.getElementById("divResultatCircuit").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";
		document.getElementById("listeCandidatCond").style.display = "none";
		
	}else{
		$l = 0;
		document.getElementById("divProfile").style.display = "none";
	}
}

function resultatCreno() {
	if ( $r == 0){
		$n = 0; $l = 0; $r = 1; $r2 = 0; $t = 0; $t2 = 0; $t3 = 0; $liste = 0;
		setTimeout('document.getElementById("divResultatCreno").style.opacity = "1"', 1);
		document.getElementById("divResultatCreno").style.opacity = "0.5";
		document.getElementById("divResultatCreno").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divResultatCircuit").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";
		document.getElementById("listeCandidatCond").style.display = "none";
		
	}else{
		$r = 0;
		document.getElementById("divResultatCreno").style.display = "none";
	}
}

function resultatCircuit() {
	if ( $r2 == 0){
		$n = 0; $l = 0; $r = 0; $r2 = 1; $t = 0; $t2 = 0; $t3 = 0; $liste = 0;
		setTimeout('document.getElementById("divResultatCircuit").style.opacity = "1"', 1);
		document.getElementById("divResultatCircuit").style.opacity = "0.5";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divResultatCircuit").style.display = "block";
		document.getElementById("divResultatCreno").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";
		document.getElementById("listeCandidatCond").style.display = "none";
		
	}else{
		$r2 = 0;
		document.getElementById("divResultatCircuit").style.display = "none";
	}
}

function textSuperviseur() {
	if ( $t == 0){
		$n = 0; $l = 0; $r = 0; $r2 = 0; $t = 1; $t2 = 0; $t3 = 0; $liste = 0;
		setTimeout('document.getElementById("divText").style.opacity = "1"', 1);
		document.getElementById("divText").style.opacity = "0.5";
		document.getElementById("divText").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divResultatCreno").style.display = "none";
		document.getElementById("divResultatCircuit").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";
		document.getElementById("listeCandidatCond").style.display = "none";
		
	}else{
		$t = 0;
		document.getElementById("divText").style.display = "none";
	}
}

function textGerant() {
	if ( $t2 == 0){
		$n = 0; $l = 0; $r = 0; $r2 = 0; $t = 0; $t2 = 1; $t3 = 0; $liste = 0;
		setTimeout('document.getElementById("divText2").style.opacity = "1"', 1);
		document.getElementById("divText2").style.opacity = "0.5";
		document.getElementById("divText2").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divResultatCreno").style.display = "none";
		document.getElementById("divResultatCircuit").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText3").style.display = "none";
		document.getElementById("listeCandidatCond").style.display = "none";
		
	}else{
		$t2 = 0;
		document.getElementById("divText2").style.display = "none";
	}
}

function textCandidat() {
	if ( $t3 == 0){
		$n = 0; $l = 0; $r = 0; $r2 = 0; $t = 0; $t2 = 0; $t3 = 1; $liste = 0;
		setTimeout('document.getElementById("divText3").style.opacity = "1"', 1);
		document.getElementById("divText3").style.opacity = "0.5";
		document.getElementById("divText3").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divResultatCreno").style.display = "none";
		document.getElementById("divResultatCircuit").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("listeCandidatCond").style.display = "none";
		
	}else{
		$t3 = 0;
		document.getElementById("divText3").style.display = "none";
	}
}

function listeCanCond() {
	if ( $liste  == 0){
		$n = 0; $l = 0; $r = 0; $r2 = 0; $t = 0; $t2 = 0; $t3 = 0; $liste = 1;
		setTimeout('document.getElementById("listeCandidatCond").style.opacity = "1"', 1);
		document.getElementById("listeCandidatCond").style.opacity = "0.5";
		document.getElementById("listeCandidatCond").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divResultatCreno").style.display = "none";
		document.getElementById("divResultatCircuit").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		
	}else{
		$liste = 0;
		document.getElementById("listeCandidatCond").style.display = "none";
	}
}

function afficherListeText() {
	$liste = document.getElementById("text");
	$liste.style.visibility = "visible"
	$liste.style.height = "115px";
	$liste.style.opacity = "1"
}

function cacherListeText() {
	$liste = document.getElementById("text");
	$liste.style.visibility = "hidden"
	$liste.style.height = "0";
	$liste.style.opacity = "0"
}

function afficherListeResultat() {
	$liste = document.getElementById("resultat");
	$liste.style.visibility = "visible"
	$liste.style.height = "90px";
	$liste.style.opacity = "1"
}

function cacherListeResultat() {
	$liste = document.getElementById("resultat");
	$liste.style.visibility = "hidden"
	$liste.style.height = "0";
	$liste.style.opacity = "0"
}