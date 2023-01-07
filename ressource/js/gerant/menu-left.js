$n = 0; $l = 0; $d = 0; $a = 0; $a2 = 0; $a3 = 0; $u = 0; $u2 = 0; $u3 = 0; $c = 0; $c1 = 0; $c2 = 0; $c3 = 0; $c4 = 0; $t = 0; $t2 = 0; $t3 = 0; $t4 = 0;

function removeLoader() {
	$loader = document.getElementById("loading");
	$loader.style.display = "none";
}

function closeNav() {
	$menu = document.getElementById("sidePanel").style.marginLeft;
	if ( $menu == "-260px"){
		document.getElementById("sidePanel").style.marginLeft = "0";
		document.getElementById("divNotification").style.marginLeft = "0px";
		document.getElementById("divProfile").style.marginLeft = "0px";
		document.getElementById("divCalendrier").style.marginLeft = "0px";
		document.getElementById("divAbsence").style.marginLeft = "100px calc(11% + 200px) auto";
		document.getElementById("divAbsence2").style.marginLeft = "100px calc(11% + 200px) auto";
		document.getElementById("divAbsence3").style.marginLeft = "100px calc(11% + 200px) auto";
		document.getElementById("divUpdateCode").style.margin = "100px calc(11% + 200px) auto";
		document.getElementById("divUpdateCreno").style.margin = "100px calc(11% + 200px) auto";
		document.getElementById("divUpdateCircuit").style.margin = "100px calc(11% + 200px) auto";
		document.getElementById("divInscrit").style.margin = "100px calc(11% + 200px) auto";
		document.getElementById("divCode").style.margin = "100px calc(11% + 200px) auto";
		document.getElementById("divCreno").style.margin = "100px calc(11% + 200px) auto";
		document.getElementById("divCircuit").style.margin = "100px calc(11% + 200px) auto";
		document.getElementById("divAdmis").style.margin = "100px calc(11% + 200px) auto";
		document.getElementById("divText").style.margin = "100px calc(11% + 200px) auto";
		document.getElementById("divText2").style.margin = "100px calc(11% + 200px) auto";
		document.getElementById("divText3").style.margin = "100px calc(11% + 200px) auto";
		document.getElementById("divText4").style.margin = "100px calc(11% + 200px) auto";
		document.getElementById("arrows").style.transform = "rotate(0deg)";
		
	}else {
		document.getElementById("sidePanel").style.marginLeft = "-260px";
		document.getElementById("divNotification").style.marginLeft = "-260px";
		document.getElementById("divProfile").style.marginLeft = "-260px";
		document.getElementById("divCalendrier").style.marginLeft = "-260px";
		document.getElementById("divAbsence").style.marginLeft = "100px 13% auto";
		document.getElementById("divAbsence2").style.marginLeft = "100px 13% auto";
		document.getElementById("divAbsence3").style.marginLeft = "100px 13% auto";
		document.getElementById("divUpdateCode").style.margin = "100px 13% auto";
		document.getElementById("divUpdateCreno").style.margin = "100px 13% auto";
		document.getElementById("divUpdateCircuit").style.margin = "100px 13% auto";
		document.getElementById("divInscrit").style.margin = "100px 13% auto";
		document.getElementById("divCode").style.margin = "100px 13% auto";
		document.getElementById("divCreno").style.margin = "100px 13% auto";
		document.getElementById("divCircuit").style.margin = "100px 13% auto";
		document.getElementById("divAdmis").style.margin = "100px 13% auto";
		document.getElementById("divText").style.margin = "100px 13% auto";
		document.getElementById("divText2").style.margin = "100px 13% auto";
		document.getElementById("divText3").style.margin = "100px 13% auto";
		document.getElementById("divText4").style.margin = "100px 13% auto";
		document.getElementById("arrows").style.transform = "rotate(180deg)";
	}  
}

function afficherNotification() {
	if ( $n == 0){
		$n = 1; $l = 0; $d = 0; $a = 0; $a2 = 0; $a3 = 0; $u = 0; $u2 = 0; $u3 = 0; $c = 0; $c1 = 0; $c2 = 0; $c3 = 0; $c4 = 0; $t = 0; $t2 = 0; $t3 = 0; $t4 = 0;
		setTimeout('document.getElementById("divNotification").style.opacity = "1"', 1);
		document.getElementById("divNotification").style.opacity = "0.5";
		document.getElementById("divNotification").style.display = "block";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divCalendrier").style.display = "none";
		document.getElementById("divAbsence").style.display = "none";
		document.getElementById("divAbsence2").style.display = "none";
		document.getElementById("divAbsence3").style.display = "none";
		document.getElementById("divUpdateCode").style.display = "none";
		document.getElementById("divUpdateCreno").style.display = "none";
		document.getElementById("divUpdateCircuit").style.display = "none";
		document.getElementById("divInscrit").style.display = "none";
		document.getElementById("divCode").style.display = "none";
		document.getElementById("divCreno").style.display = "none";
		document.getElementById("divCircuit").style.display = "none";
		document.getElementById("divAdmis").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";
		document.getElementById("divText4").style.display = "none";
		
	}else{
		$n = 0;
		document.getElementById("divNotification").style.display = "none";
	}
}

function afficherProfile() {
	if ( $l == 0){
		$n = 0; $l = 1; $d = 0; $a = 0; $a2 = 0; $a3 = 0; $u = 0; $u2 = 0; $u3 = 0; $c = 0; $c1 = 0; $c2 = 0; $c3 = 0; $c4 = 0; $t = 0; $t2 = 0; $t3 = 0; $t4 = 0;
		setTimeout('document.getElementById("divProfile").style.opacity = "1"', 1);
		document.getElementById("divProfile").style.opacity = "0.5";
		document.getElementById("divProfile").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divCalendrier").style.display = "none";
		document.getElementById("divAbsence").style.display = "none";
		document.getElementById("divAbsence2").style.display = "none";
		document.getElementById("divAbsence3").style.display = "none";
		document.getElementById("divUpdateCode").style.display = "none";
		document.getElementById("divUpdateCreno").style.display = "none";
		document.getElementById("divUpdateCircuit").style.display = "none";
		document.getElementById("divInscrit").style.display = "none";
		document.getElementById("divCode").style.display = "none";
		document.getElementById("divCreno").style.display = "none";
		document.getElementById("divCircuit").style.display = "none";
		document.getElementById("divAdmis").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";
		document.getElementById("divText4").style.display = "none";
		
	}else{
		$l = 0;
		document.getElementById("divProfile").style.display = "none";
	}
}

function afficherCalendrier() {
	if ( $d == 0){
		$n = 0; $l = 0; $d = 1; $a = 0; $a2 = 0; $a3 = 0; $u = 0; $u2 = 0; $u3 = 0; $c = 0; $c1 = 0; $c2 = 0; $c3 = 0; $c4 = 0; $t = 0; $t2 = 0; $t3 = 0; $t4 = 0;
		setTimeout('document.getElementById("divCalendrier").style.opacity = "1"', 1);
		document.getElementById("divCalendrier").style.opacity = "0.5";
		document.getElementById("divCalendrier").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divAbsence").style.display = "none";
		document.getElementById("divAbsence2").style.display = "none";
		document.getElementById("divAbsence3").style.display = "none";
		document.getElementById("divUpdateCode").style.display = "none";
		document.getElementById("divUpdateCreno").style.display = "none";
		document.getElementById("divUpdateCircuit").style.display = "none";
		document.getElementById("divInscrit").style.display = "none";
		document.getElementById("divCode").style.display = "none";
		document.getElementById("divCreno").style.display = "none";
		document.getElementById("divCircuit").style.display = "none";
		document.getElementById("divAdmis").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";
		document.getElementById("divText4").style.display = "none";
		closeNav();
	}else{
		$d = 0;
		document.getElementById("divCalendrier").style.display = "none";
	}
}

function absenceCandidat() {
	if ( $a == 0){
		$n = 0; $l = 0; $d = 0;  $a = 1; $a2 = 0; $a3 = 0; $u = 0; $u2 = 0; $u3 = 0; $c = 0; $c1 = 0; $c2 = 0; $c3 = 0; $c4 = 0; $t = 0; $t2 = 0; $t3 = 0; $t4 = 0;
		setTimeout('document.getElementById("divAbsence").style.opacity = "1"', 1);
		document.getElementById("divAbsence").style.opacity = "0.5";
		document.getElementById("divAbsence").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divCalendrier").style.display = "none";
		document.getElementById("divAbsence2").style.display = "none";
		document.getElementById("divAbsence3").style.display = "none";
		document.getElementById("divUpdateCode").style.display = "none";
		document.getElementById("divUpdateCreno").style.display = "none";
		document.getElementById("divUpdateCircuit").style.display = "none";
		document.getElementById("divInscrit").style.display = "none";
		document.getElementById("divCode").style.display = "none";
		document.getElementById("divCreno").style.display = "none";
		document.getElementById("divCircuit").style.display = "none";
		document.getElementById("divAdmis").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";
		document.getElementById("divText4").style.display = "none";
		
	}else{
		$a = 0;
		document.getElementById("divAbsence").style.display = "none";
	}
}

function absenceMoniteurCode() {
	if ( $a2 == 0){
		$n = 0; $l = 0; $d = 0;  $a = 0; $a2 = 1; $a3 = 0; $u = 0; $u2 = 0; $u3 = 0; $c = 0; $c1 = 0; $c2 = 0; $c3 = 0; $c4 = 0; $t = 0; $t2 = 0; $t3 = 0; $t4 = 0;
		setTimeout('document.getElementById("divAbsence2").style.opacity = "1"', 1);
		document.getElementById("divAbsence2").style.opacity = "0.5";
		document.getElementById("divAbsence2").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divCalendrier").style.display = "none";
		document.getElementById("divAbsence").style.display = "none";
		document.getElementById("divAbsence3").style.display = "none";
		document.getElementById("divUpdateCode").style.display = "none";
		document.getElementById("divUpdateCreno").style.display = "none";
		document.getElementById("divUpdateCircuit").style.display = "none";
		document.getElementById("divInscrit").style.display = "none";
		document.getElementById("divCode").style.display = "none";
		document.getElementById("divCreno").style.display = "none";
		document.getElementById("divCircuit").style.display = "none";
		document.getElementById("divAdmis").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";
		document.getElementById("divText4").style.display = "none";
		
	}else{
		$a2 = 0;
		document.getElementById("divAbsence2").style.display = "none";
	}
}

function absenceMoniteurCond() {
	if ( $a3 == 0){
		$n = 0; $l = 0; $d = 0;  $a = 0; $a2 = 0; $a3 = 1; $u = 0; $u2 = 0; $u3 = 0; $c = 0; $c1 = 0; $c2 = 0; $c3 = 0; $c4 = 0; $t = 0; $t2 = 0; $t3 = 0; $t4 = 0;
		setTimeout('document.getElementById("divAbsence3").style.opacity = "1"', 1);
		document.getElementById("divAbsence3").style.opacity = "0.5";
		document.getElementById("divAbsence3").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divCalendrier").style.display = "none";
		document.getElementById("divAbsence").style.display = "none";
		document.getElementById("divAbsence2").style.display = "none";
		document.getElementById("divUpdateCode").style.display = "none";
		document.getElementById("divUpdateCreno").style.display = "none";
		document.getElementById("divUpdateCircuit").style.display = "none";
		document.getElementById("divInscrit").style.display = "none";
		document.getElementById("divCode").style.display = "none";
		document.getElementById("divCreno").style.display = "none";
		document.getElementById("divCircuit").style.display = "none";
		document.getElementById("divAdmis").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";
		document.getElementById("divText4").style.display = "none";
		
	}else{
		$a3 = 0;
		document.getElementById("divAbsence3").style.display = "none";
	}
}

function updateCode() {
	if ( $u == 0){
		$n = 0; $l = 0; $d = 0; $a = 0; $a2 = 0; $a3 = 0; $u = 1; $u2 = 0; $u3 = 0; $c = 0; $c1 = 0; $c2 = 0; $c3 = 0; $c4 = 0; $t = 0; $t2 = 0; $t3 = 0; $t4 = 0;
		setTimeout('document.getElementById("divUpdateCode").style.opacity = "1"', 1);
		document.getElementById("divUpdateCode").style.opacity = "0.5";
		document.getElementById("divUpdateCode").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divCalendrier").style.display = "none";
		document.getElementById("divAbsence").style.display = "none";
		document.getElementById("divAbsence2").style.display = "none";
		document.getElementById("divAbsence3").style.display = "none";
		document.getElementById("divUpdateCreno").style.display = "none";
		document.getElementById("divUpdateCircuit").style.display = "none";
		document.getElementById("divInscrit").style.display = "none";
		document.getElementById("divCode").style.display = "none";
		document.getElementById("divCreno").style.display = "none";
		document.getElementById("divCircuit").style.display = "none";
		document.getElementById("divAdmis").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";
		document.getElementById("divText4").style.display = "none";
		
	}else{
		$u = 0;
		document.getElementById("divUpdateCode").style.display = "none";
	}
}

function updateCreno() {
	if ( $u2 == 0){
		$n = 0; $l = 0; $d = 0; $a = 0; $a2 = 0; $a3 = 0; $u = 0; $u2 = 1; $u3 = 0; $c = 0; $c1 = 0; $c2 = 0; $c3 = 0; $c4 = 0; $t = 0; $t2 = 0; $t3 = 0; $t4 = 0;
		setTimeout('document.getElementById("divUpdateCreno").style.opacity = "1"', 1);
		document.getElementById("divUpdateCreno").style.opacity = "0.5";
		document.getElementById("divUpdateCreno").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divCalendrier").style.display = "none";
		document.getElementById("divAbsence").style.display = "none";
		document.getElementById("divAbsence2").style.display = "none";
		document.getElementById("divAbsence3").style.display = "none";
		document.getElementById("divUpdateCode").style.display = "none";
		document.getElementById("divUpdateCircuit").style.display = "none";
		document.getElementById("divInscrit").style.display = "none";
		document.getElementById("divCode").style.display = "none";
		document.getElementById("divCreno").style.display = "none";
		document.getElementById("divCircuit").style.display = "none";
		document.getElementById("divAdmis").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";
		document.getElementById("divText4").style.display = "none";
		
	}else{
		$u2 = 0;
		document.getElementById("divUpdateCreno").style.display = "none";
	}
}

function updateCircuit() {
	if ( $u3 == 0){
		$n = 0; $l = 0; $d = 0; $a = 0; $a2 = 0; $a3 = 0; $u = 0; $u2 = 0; $u3 = 1; $c = 0; $c1 = 0; $c2 = 0; $c3 = 0; $c4 = 0; $t = 0; $t2 = 0; $t3 = 0; $t4 = 0;
		setTimeout('document.getElementById("divUpdateCircuit").style.opacity = "1"', 1);
		document.getElementById("divUpdateCircuit").style.opacity = "0.5";
		document.getElementById("divUpdateCircuit").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divCalendrier").style.display = "none";
		document.getElementById("divAbsence").style.display = "none";
		document.getElementById("divAbsence2").style.display = "none";
		document.getElementById("divAbsence3").style.display = "none";
		document.getElementById("divUpdateCode").style.display = "none";
		document.getElementById("divUpdateCreno").style.display = "none";
		document.getElementById("divInscrit").style.display = "none";
		document.getElementById("divCode").style.display = "none";
		document.getElementById("divCreno").style.display = "none";
		document.getElementById("divCircuit").style.display = "none";
		document.getElementById("divAdmis").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";
		document.getElementById("divText4").style.display = "none";
		
	}else{
		$u3 = 0;
		document.getElementById("divUpdateCircuit").style.display = "none";
	}
}

function gererInscrit() {
	if ( $c == 0){
		$n = 0; $l = 0; $d = 0; $a = 0; $a2 = 0; $a3 = 0; $u = 0; $u2 = 0; $u3 = 0; $c = 1; $c1 = 0; $c2 = 0; $c3 = 0; $c4 = 0; $t = 0; $t2 = 0; $t3 = 0; $t4 = 0;
		setTimeout('document.getElementById("divInscrit").style.opacity = "1"', 1);
		document.getElementById("divInscrit").style.opacity = "0.5";
		document.getElementById("divInscrit").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divCalendrier").style.display = "none";
		document.getElementById("divAbsence").style.display = "none";
		document.getElementById("divAbsence2").style.display = "none";
		document.getElementById("divAbsence3").style.display = "none";
		document.getElementById("divUpdateCode").style.display = "none";
		document.getElementById("divUpdateCreno").style.display = "none";
		document.getElementById("divUpdateCircuit").style.display = "none";
		document.getElementById("divCode").style.display = "none";
		document.getElementById("divCreno").style.display = "none";
		document.getElementById("divCircuit").style.display = "none";
		document.getElementById("divAdmis").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";
		document.getElementById("divText4").style.display = "none";
		
	}else{
		$c = 0;
		document.getElementById("divInscrit").style.display = "none";
	}
}

function gererCode() {
	if ( $c1 == 0){
		$n = 0; $l = 0; $d = 0; $a = 0; $a2 = 0; $a3 = 0; $u = 0; $u2 = 0; $u3 = 0; $c = 0; $c1 = 1; $c2 = 0; $c3 = 0; $c4 = 0; $t = 0; $t2 = 0; $t3 = 0; $t4 = 0;
		setTimeout('document.getElementById("divCode").style.opacity = "1"', 1);
		document.getElementById("divCode").style.opacity = "0.5";
		document.getElementById("divCode").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divCalendrier").style.display = "none";
		document.getElementById("divAbsence").style.display = "none";
		document.getElementById("divAbsence2").style.display = "none";
		document.getElementById("divAbsence3").style.display = "none";
		document.getElementById("divUpdateCode").style.display = "none";
		document.getElementById("divUpdateCreno").style.display = "none";
		document.getElementById("divUpdateCircuit").style.display = "none";
		document.getElementById("divInscrit").style.display = "none";
		document.getElementById("divCreno").style.display = "none";
		document.getElementById("divCircuit").style.display = "none";
		document.getElementById("divAdmis").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";
		document.getElementById("divText4").style.display = "none";
		
	}else{
		$c1 = 0;
		document.getElementById("divCode").style.display = "none";
	}
}

function gererCreno() {
	if ( $c2 == 0){
		$n = 0; $l = 0; $d = 0; $a = 0; $a2 = 0; $a3 = 0; $u = 0; $u2 = 0; $u3 = 0; $c = 0; $c1 = 0; $c2 = 1; $c3 = 0; $c4 = 0; $t = 0; $t2 = 0; $t3 = 0; $t4 = 0;
		setTimeout('document.getElementById("divCreno").style.opacity = "1"', 1);
		document.getElementById("divCreno").style.opacity = "0.5";
		document.getElementById("divCreno").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divCalendrier").style.display = "none";
		document.getElementById("divAbsence").style.display = "none";
		document.getElementById("divAbsence2").style.display = "none";
		document.getElementById("divAbsence3").style.display = "none";
		document.getElementById("divUpdateCode").style.display = "none";
		document.getElementById("divUpdateCreno").style.display = "none";
		document.getElementById("divUpdateCircuit").style.display = "none";
		document.getElementById("divInscrit").style.display = "none";
		document.getElementById("divCode").style.display = "none";
		document.getElementById("divCircuit").style.display = "none";
		document.getElementById("divAdmis").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";
		document.getElementById("divText4").style.display = "none";

	}else{
		$c2 = 0;
		document.getElementById("divCreno").style.display = "none";
	}
}

function gererCircuit() {
	if ( $c3 == 0){
		$n = 0; $l = 0; $d = 0; $a = 0; $a2 = 0; $a3 = 0; $u = 0; $u2 = 0; $u3 = 0; $c = 0; $c1 = 0; $c2 = 0; $c3 = 1; $c4 = 0; $t = 0; $t2 = 0; $t3 = 0; $t4 = 0;
		setTimeout('document.getElementById("divCircuit").style.opacity = "1"', 1);
		document.getElementById("divCircuit").style.opacity = "0.5";
		document.getElementById("divCircuit").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divCalendrier").style.display = "none";
		document.getElementById("divAbsence").style.display = "none";
		document.getElementById("divAbsence2").style.display = "none";
		document.getElementById("divAbsence3").style.display = "none";
		document.getElementById("divUpdateCode").style.display = "none";
		document.getElementById("divUpdateCreno").style.display = "none";
		document.getElementById("divUpdateCircuit").style.display = "none";
		document.getElementById("divInscrit").style.display = "none";
		document.getElementById("divCode").style.display = "none";
		document.getElementById("divCreno").style.display = "none";
		document.getElementById("divAdmis").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";
		document.getElementById("divText4").style.display = "none";
		
	}else{
		$c3 = 0;
		document.getElementById("divCircuit").style.display = "none";
	}
}

function gererAdmis() {
	if ( $c4 == 0){
		$n = 0; $l = 0; $d = 0; $a = 0; $a2 = 0; $a3 = 0; $u = 0; $u2 = 0; $u3 = 0; $c = 0; $c1 = 0; $c2 = 0; $c3 = 0; $c4 = 1; $t = 0; $t2 = 0; $t3 = 0; $t4 = 0;
		setTimeout('document.getElementById("divAdmis").style.opacity = "1"', 1);
		document.getElementById("divAdmis").style.opacity = "0.5";
		document.getElementById("divAdmis").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divCalendrier").style.display = "none";
		document.getElementById("divAbsence").style.display = "none";
		document.getElementById("divAbsence2").style.display = "none";
		document.getElementById("divAbsence3").style.display = "none";
		document.getElementById("divUpdateCode").style.display = "none";
		document.getElementById("divUpdateCreno").style.display = "none";
		document.getElementById("divUpdateCircuit").style.display = "none";
		document.getElementById("divInscrit").style.display = "none";
		document.getElementById("divCode").style.display = "none";
		document.getElementById("divCreno").style.display = "none";
		document.getElementById("divCircuit").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";
		document.getElementById("divText4").style.display = "none";
		
	}else{
		$c4 = 0;
		document.getElementById("divAdmis").style.display = "none";
	}
}

function textSuperviseur(){
	if ( $t == 0){
		$n = 0; $l = 0; $d = 0; $a = 0; $a2 = 0; $a3 = 0; $u = 0; $u2 = 0; $u3 = 0; $c = 0; $c1 = 0; $c2 = 0; $c3 = 0; $c4 = 0; $t = 1; $t2 = 0; $t3 = 0; $t4 = 0;
		setTimeout('document.getElementById("divText").style.opacity = "1"', 1);
		document.getElementById("divText").style.opacity = "0.5";
		document.getElementById("divText").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divCalendrier").style.display = "none";
		document.getElementById("divAbsence").style.display = "none";
		document.getElementById("divAbsence2").style.display = "none";
		document.getElementById("divAbsence3").style.display = "none";
		document.getElementById("divUpdateCode").style.display = "none";
		document.getElementById("divUpdateCreno").style.display = "none";
		document.getElementById("divUpdateCircuit").style.display = "none";
		document.getElementById("divInscrit").style.display = "none";
		document.getElementById("divCode").style.display = "none";
		document.getElementById("divCreno").style.display = "none";
		document.getElementById("divCircuit").style.display = "none";
		document.getElementById("divAdmis").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";
		document.getElementById("divText4").style.display = "none";
	}else{
		$t = 0;
		document.getElementById("divText").style.display = "none";
	}
}

function textMoniCode(){
	if ( $t2 == 0){
		$n = 0; $l = 0; $d = 0; $a = 0; $a2 = 0; $a3 = 0; $u = 0; $u2 = 0; $u3 = 0; $c = 0; $c1 = 0; $c2 = 0; $c3 = 0; $c4 = 0; $t = 0; $t2 = 1; $t3 = 0; $t4 = 0;
		setTimeout('document.getElementById("divText2").style.opacity = "1"', 1);
		document.getElementById("divText2").style.opacity = "0.5";
		document.getElementById("divText2").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divCalendrier").style.display = "none";
		document.getElementById("divAbsence").style.display = "none";
		document.getElementById("divAbsence2").style.display = "none";
		document.getElementById("divAbsence3").style.display = "none";
		document.getElementById("divUpdateCode").style.display = "none";
		document.getElementById("divUpdateCreno").style.display = "none";
		document.getElementById("divUpdateCircuit").style.display = "none";
		document.getElementById("divInscrit").style.display = "none";
		document.getElementById("divCode").style.display = "none";
		document.getElementById("divCreno").style.display = "none";
		document.getElementById("divCircuit").style.display = "none";
		document.getElementById("divAdmis").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText3").style.display = "none";
		document.getElementById("divText4").style.display = "none";
		
	}else{
		$t2 = 0;
		document.getElementById("divText2").style.display = "none";
	}
}

function textMoniCond(){
	if ( $t3 == 0){
		$n = 0; $l = 0; $d = 0; $a = 0; $a2 = 0; $a3 = 0; $u = 0; $u2 = 0; $u3 = 0; $c = 0; $c1 = 0; $c2 = 0; $c3 = 0; $c4 = 0; $t = 0; $t2 = 0; $t3 = 1; $t4 = 0;
		setTimeout('document.getElementById("divText3").style.opacity = "1"', 1);
		document.getElementById("divText3").style.opacity = "0.5";
		document.getElementById("divText3").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divCalendrier").style.display = "none";
		document.getElementById("divAbsence").style.display = "none";
		document.getElementById("divAbsence2").style.display = "none";
		document.getElementById("divAbsence3").style.display = "none";
		document.getElementById("divUpdateCode").style.display = "none";
		document.getElementById("divUpdateCreno").style.display = "none";
		document.getElementById("divUpdateCircuit").style.display = "none";
		document.getElementById("divInscrit").style.display = "none";
		document.getElementById("divCode").style.display = "none";
		document.getElementById("divCreno").style.display = "none";
		document.getElementById("divCircuit").style.display = "none";
		document.getElementById("divAdmis").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText4").style.display = "none";
		
	}else{
		$t3 = 0;
		document.getElementById("divText3").style.display = "none";
	}
}

function textCandidat(){
	if ( $t4 == 0){
		$n = 0; $l = 0; $d = 0; $a = 0; $a2 = 0; $a3 = 0; $u = 0; $u2 = 0; $u3 = 0; $c = 0; $c1 = 0; $c2 = 0; $c3 = 0; $c4 = 0; $t = 0; $t2 = 0; $t3 = 0; $t4 = 1; 
		setTimeout('document.getElementById("divText4").style.opacity = "1"', 1);
		document.getElementById("divText4").style.opacity = "0.5";
		document.getElementById("divText4").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divCalendrier").style.display = "none";
		document.getElementById("divAbsence").style.display = "none";
		document.getElementById("divAbsence2").style.display = "none";
		document.getElementById("divAbsence3").style.display = "none";
		document.getElementById("divUpdateCode").style.display = "none";
		document.getElementById("divUpdateCreno").style.display = "none";
		document.getElementById("divUpdateCircuit").style.display = "none";
		document.getElementById("divInscrit").style.display = "none";
		document.getElementById("divCode").style.display = "none";
		document.getElementById("divCreno").style.display = "none";
		document.getElementById("divCircuit").style.display = "none";
		document.getElementById("divAdmis").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";
		
	}else{
		$t4 = 0;
		document.getElementById("divText4").style.display = "none";
	}
}

function afficherListeAbsence() {
	$liste = document.getElementById("absence");
	$liste.style.visibility = "visible"
	$liste.style.height = "115px";
	$liste.style.opacity = "1"
}

function cacherListeAbsence() {
	$liste = document.getElementById("absence");
	$liste.style.visibility = "hidden"
	$liste.style.height = "0";
	$liste.style.opacity = "0"
}

function afficherListeCandidat() {
	$liste = document.getElementById("candidat");
	$liste.style.visibility = "visible"
	$liste.style.height = "200px";
	$liste.style.opacity = "1"
}

function cacherListeCandidat() {
	$liste = document.getElementById("candidat");
	$liste.style.visibility = "hidden"
	$liste.style.height = "0";
	$liste.style.opacity = "0"
}

function afficherListeText() {
	$liste = document.getElementById("text");
	$liste.style.visibility = "visible"
	$liste.style.height = "155px";
	$liste.style.opacity = "1"
}

function cacherListeText() {
	$liste = document.getElementById("text");
	$liste.style.visibility = "hidden"
	$liste.style.height = "0";
	$liste.style.opacity = "0"
}

function afficherListeUpdate() {
	$liste = document.getElementById("update");
	$liste.style.visibility = "visible"
	$liste.style.height = "115px";
	$liste.style.opacity = "1"
}

function cacherListeUpdate() {
	$liste = document.getElementById("update");
	$liste.style.visibility = "hidden"
	$liste.style.height = "0";
	$liste.style.opacity = "0"
}