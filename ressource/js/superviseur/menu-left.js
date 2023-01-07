$n = 0; $s = 0; $f = 0 ; $a = 0; $r = 0; $m = 0; $m2 = 0; $m3 = 0; $p = 0; $p2 = 0; $p3 = 0; $p4 = 0; $t = 0; $t2 = 0; $t3 = 0;

function removeLoader() {
	$loader = document.getElementById("loading");
	$loader.style.display = "none";
}

function closeNav() {
	$menu = document.getElementById("sidePanel").style.marginLeft;
	if ( $menu == "-260px"){
		document.getElementById("sidePanel").style.marginLeft = "0";
		document.getElementById("divNotification").style.marginLeft = "0px";
		document.getElementById("divStatistique").style.marginLeft = "0px";
		document.getElementById("divProfile").style.marginLeft = "0px";
		document.getElementById("divAjouter").style.marginLeft = "0px";
		document.getElementById("divRemise").style.marginLeft = "0px";
		document.getElementById("divModifier").style.margin = "100px calc(11% + 200px) auto";
		document.getElementById("divModifier2").style.margin = "100px calc(11% + 200px) auto";
		document.getElementById("divModifier3").style.margin = "100px calc(11% + 200px) auto";
		document.getElementById("divPaiementx").style.margin = "100px calc(11% + 200px) auto";
		document.getElementById("divPaiementx2").style.margin = "100px calc(11% + 200px) auto";
		document.getElementById("divPaiementx3").style.margin = "100px calc(11% + 200px) auto";
		document.getElementById("divPaiementx4").style.margin = "100px calc(11% + 200px) auto";
		document.getElementById("divText").style.margin = "100px calc(11% + 200px) auto";
		document.getElementById("divText2").style.margin = "100px calc(11% + 200px) auto";
		document.getElementById("divText3").style.margin = "100px calc(11% + 200px) auto";
		document.getElementById("arrows").style.transform = "rotate(0deg)";
		
	}else {
		document.getElementById("sidePanel").style.marginLeft = "-260px";
		document.getElementById("divNotification").style.marginLeft = "-260px";
		document.getElementById("divStatistique").style.marginLeft = "-260px";
		document.getElementById("divProfile").style.marginLeft = "-260px";
		document.getElementById("divAjouter").style.marginLeft = "-260px";
		document.getElementById("divRemise").style.marginLeft = "-260px";
		document.getElementById("divModifier").style.margin = "100px 13% auto";
		document.getElementById("divModifier2").style.margin = "100px 13% auto";
		document.getElementById("divModifier3").style.margin = "100px 13% auto";
		document.getElementById("divPaiementx").style.margin = "100px 13% auto";
		document.getElementById("divPaiementx2").style.margin = "100px 13% auto";
		document.getElementById("divPaiementx3").style.margin = "100px 13% auto";
		document.getElementById("divPaiementx4").style.margin = "100px 13% auto";
		document.getElementById("divText").style.margin = "100px 13% auto";
		document.getElementById("divText2").style.margin = "100px 13% auto";
		document.getElementById("divText3").style.margin = "100px 13% auto";
		document.getElementById("arrows").style.transform = "rotate(180deg)";
	}  
}

function afficherNotification() {
	if ( $n == 0 ){
		$n = 1; $s = 0; $f = 0; $a = 0; $r = 0; $m = 0; $m2 = 0; $m3 = 0; $p = 0; $p2 = 0; $p3 = 0; $p4 = 0; $t = 0; $t2 = 0; $t3 = 0;
		setTimeout('document.getElementById("divNotification").style.opacity = "1"', 1);
		document.getElementById("divNotification").style.opacity = "0.5";
		document.getElementById("divNotification").style.display = "block";
		document.getElementById("divStatistique").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divAjouter").style.display = "none";
		document.getElementById("divRemise").style.display = "none";
		document.getElementById("divModifier").style.display = "none";
		document.getElementById("divModifier2").style.display = "none";
		document.getElementById("divModifier3").style.display = "none";
		document.getElementById("divPaiementx").style.display = "none";
		document.getElementById("divPaiementx2").style.display = "none";
		document.getElementById("divPaiementx3").style.display = "none";
		document.getElementById("divPaiementx4").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";
		
	}else{
		$n = 0;
		document.getElementById("divNotification").style.display = "none";
	}
}

function afficherStatistique() {
	if ( $s == 0 ){
		$n = 0; $s = 1; $f = 0; $a = 0; $r = 0; $m = 0; $m2 = 0; $m3 = 0; $p = 0; $p2 = 0; $p3 = 0; $p4 = 0; $t = 0; $t2 = 0; $t3 = 0;
		setTimeout('document.getElementById("divStatistique").style.opacity = "1"', 1);
		document.getElementById("divStatistique").style.opacity = "0.5";
		document.getElementById("divStatistique").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divAjouter").style.display = "none";
		document.getElementById("divRemise").style.display = "none";
		document.getElementById("divModifier").style.display = "none";
		document.getElementById("divModifier2").style.display = "none";
		document.getElementById("divModifier3").style.display = "none";
		document.getElementById("divPaiementx").style.display = "none";
		document.getElementById("divPaiementx2").style.display = "none";
		document.getElementById("divPaiementx3").style.display = "none";
		document.getElementById("divPaiementx4").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";
		
	}else{
		$s = 0;
		document.getElementById("divStatistique").style.display = "none";
	}
}

function modifierProfile() {
	if ( $f == 0 ){
		$n = 0; $s = 0; $f = 1; $a = 0; $r = 0; $m = 0; $m2 = 0; $m3 = 0; $p = 0; $p2 = 0; $p3 = 0; $p4 = 0; $t = 0; $t2 = 0; $t3 = 0;
		setTimeout('document.getElementById("divProfile").style.opacity = "1"', 1);
		document.getElementById("divProfile").style.opacity = "0.5";
		document.getElementById("divProfile").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divStatistique").style.display = "none";
		document.getElementById("divAjouter").style.display = "none";
		document.getElementById("divRemise").style.display = "none";
		document.getElementById("divModifier").style.display = "none";
		document.getElementById("divModifier2").style.display = "none";
		document.getElementById("divModifier3").style.display = "none";
		document.getElementById("divPaiementx").style.display = "none";
		document.getElementById("divPaiementx2").style.display = "none";
		document.getElementById("divPaiementx3").style.display = "none";
		document.getElementById("divPaiementx4").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";
		
	}else{
		$f = 0;
		document.getElementById("divProfile").style.display = "none";
	}
}

function ajouterEmployer() {
	if ( $a == 0 ){
		$n = 0; $s = 0; $f = 0; $a = 1; $r = 0; $m = 0; $m2 = 0; $m3 = 0; $p = 0; $p2 = 0; $p3 = 0; $p4 = 0; $t = 0; $t2 = 0; $t3 = 0;
		setTimeout('document.getElementById("divAjouter").style.opacity = "1"', 1);
		document.getElementById("divAjouter").style.opacity = "0.5";
		document.getElementById("divAjouter").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divStatistique").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divRemise").style.display = "none";
		document.getElementById("divModifier").style.display = "none";
		document.getElementById("divModifier2").style.display = "none";
		document.getElementById("divModifier3").style.display = "none";
		document.getElementById("divPaiementx").style.display = "none";
		document.getElementById("divPaiementx2").style.display = "none";
		document.getElementById("divPaiementx3").style.display = "none";
		document.getElementById("divPaiementx4").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";
		
	}else{
		$a = 0;
		document.getElementById("divAjouter").style.display = "none";	
	}
}

function ajouterRemise() {
	if ( $r == 0 ){
		$n = 0; $s = 0; $f = 0; $a = 0; $r = 1; $m = 0; $m2 = 0; $m3 = 0; $p = 0; $p2 = 0; $p3 = 0; $p4 = 0; $t = 0; $t2 = 0; $t3 = 0;
		setTimeout('document.getElementById("divRemise").style.opacity = "1"', 1);
		document.getElementById("divRemise").style.opacity = "0.5";
		document.getElementById("divRemise").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divStatistique").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divAjouter").style.display = "none";
		document.getElementById("divModifier").style.display = "none";
		document.getElementById("divModifier2").style.display = "none";
		document.getElementById("divModifier3").style.display = "none";
		document.getElementById("divPaiementx").style.display = "none";
		document.getElementById("divPaiementx2").style.display = "none";
		document.getElementById("divPaiementx3").style.display = "none";
		document.getElementById("divPaiementx4").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";
		
	}else{
		$r = 0;
		document.getElementById("divAjouter").style.display = "none";	
	}
}

function modifierGerant() {
	if ( $m == 0){
		$n = 0; $s = 0; $f = 0; $a = 0; $r = 0; $m = 1; $m2 = 0; $m3 = 0; $p = 0; $p2 = 0; $p3 = 0; $p4 = 0; $t=0; $t2=0; $t3=0;
		setTimeout('document.getElementById("divModifier").style.opacity = "1"', 1);
		document.getElementById("divModifier").style.opacity = "0.5";
		document.getElementById("divModifier").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divStatistique").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divAjouter").style.display = "none";
		document.getElementById("divRemise").style.display = "none";
		document.getElementById("divModifier2").style.display = "none";
		document.getElementById("divModifier3").style.display = "none";
		document.getElementById("divPaiementx").style.display = "none";
		document.getElementById("divPaiementx2").style.display = "none";
		document.getElementById("divPaiementx3").style.display = "none";
		document.getElementById("divPaiementx4").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";
		
	}else{
		$m = 0;
		document.getElementById("divModifier").style.display = "none";
	}
}

function modifierMoniCode() {
	if ( $m2 == 0){
		$n = 0; $s = 0; $f = 0; $a = 0; $r = 0; $m = 0; $m2 = 1; $m3 = 0; $p = 0; $p2 = 0; $p3 = 0; $p4 = 0; $t = 0; $t2 = 0; $t3 = 0;
		setTimeout('document.getElementById("divModifier2").style.opacity = "1"', 1);
		document.getElementById("divModifier2").style.opacity = "0.5";
		document.getElementById("divModifier2").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divStatistique").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divAjouter").style.display = "none";
		document.getElementById("divRemise").style.display = "none";
		document.getElementById("divModifier").style.display = "none";
		document.getElementById("divModifier3").style.display = "none";
		document.getElementById("divPaiementx").style.display = "none";
		document.getElementById("divPaiementx2").style.display = "none";
		document.getElementById("divPaiementx3").style.display = "none";
		document.getElementById("divPaiementx4").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";
		
	}else{
		$m2 = 0;
		document.getElementById("divModifier2").style.display = "none";
	}
}

function modifierMoniCond() {
	if ( $m3 == 0){
		$n = 0; $s = 0; $f = 0; $a = 0; $r = 0; $m = 0; $m2 = 0; $m3 = 1; $p = 0; $p2 = 0; $p3 = 0; $p4 = 0; $t=0; $t2=0; $t3=0;
		setTimeout('document.getElementById("divModifier3").style.opacity = "1"', 1);
		document.getElementById("divModifier3").style.opacity = "0.5";
		document.getElementById("divModifier3").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divStatistique").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divAjouter").style.display = "none";
		document.getElementById("divRemise").style.display = "none";
		document.getElementById("divModifier").style.display = "none";
		document.getElementById("divModifier2").style.display = "none";
		document.getElementById("divPaiementx").style.display = "none";
		document.getElementById("divPaiementx2").style.display = "none";
		document.getElementById("divPaiementx3").style.display = "none";
		document.getElementById("divPaiementx4").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";
		
	}else{
		$m3 = 0;
		document.getElementById("divModifier3").style.display = "none";
	}
}

function payerCandidat() {
	if ( $p == 0){
		$n = 0; $s = 0; $f = 0; $a = 0; $r = 0; $m = 0; $m2 = 0; $m3 = 0; $p = 1; $p2 = 0; $p3 = 0; $p4 = 0; $t = 0; $t2 = 0; $t3 = 0;
		setTimeout('document.getElementById("divPaiementx").style.opacity = "1"', 1);
		document.getElementById("divPaiementx").style.opacity = "0.5";
		document.getElementById("divPaiementx").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divStatistique").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divAjouter").style.display = "none";
		document.getElementById("divRemise").style.display = "none";
		document.getElementById("divModifier").style.display = "none";
		document.getElementById("divModifier2").style.display = "none";
		document.getElementById("divModifier3").style.display = "none";
		document.getElementById("divPaiementx2").style.display = "none";
		document.getElementById("divPaiementx3").style.display = "none";
		document.getElementById("divPaiementx4").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";
		
	}else{
		$p = 0;
		document.getElementById("divPaiementx").style.display = "none";	
	}
}

function payerGerant() {
	if ( $p2 == 0){
		$n = 0; $s = 0; $f = 0; $a = 0; $r = 0; $m = 0; $m2 = 0; $m3 = 0; $p = 0; $p2 = 1; $p3 = 0; $p4 = 0; $t = 0; $t2 = 0; $t3 = 0;
		setTimeout('document.getElementById("divPaiementx2").style.opacity = "1"', 1);
		document.getElementById("divPaiementx2").style.opacity = "0.5";
		document.getElementById("divPaiementx2").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divStatistique").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divAjouter").style.display = "none";
		document.getElementById("divRemise").style.display = "none";
		document.getElementById("divModifier").style.display = "none";
		document.getElementById("divModifier2").style.display = "none";
		document.getElementById("divModifier3").style.display = "none";
		document.getElementById("divPaiementx").style.display = "none";
		document.getElementById("divPaiementx3").style.display = "none";
		document.getElementById("divPaiementx4").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";

	}else{
		$p2 = 0;
		document.getElementById("divPaiementx2").style.display = "none";
	}
}

function payerMoniCode() {
	if ( $p3 == 0){
		$n = 0; $s = 0; $f = 0; $a = 0; $r = 0; $m = 0; $m2 = 0; $m3 = 0; $p = 0; $p2 = 0; $p3 = 1; $p4 = 0; $t = 0; $t2 = 0; $t3 = 0;
		setTimeout('document.getElementById("divPaiementx3").style.opacity = "1"', 1);
		document.getElementById("divPaiementx3").style.opacity = "0.5";
		document.getElementById("divPaiementx3").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divStatistique").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divAjouter").style.display = "none";
		document.getElementById("divRemise").style.display = "none";
		document.getElementById("divModifier").style.display = "none";
		document.getElementById("divModifier2").style.display = "none";
		document.getElementById("divModifier3").style.display = "none";
		document.getElementById("divPaiementx").style.display = "none";
		document.getElementById("divPaiementx2").style.display = "none";
		document.getElementById("divPaiementx4").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";
		
	}else{
		$p3 = 0;
		document.getElementById("divPaiementx3").style.display = "none";
	}
}

function payerMoniCond() {
	if ( $p4 == 0){
		$n = 0; $s = 0; $f = 0; $a = 0; $r = 0; $m = 0; $m2 = 0; $m3 = 0; $p = 0; $p2 = 0; $p3 = 0; $p4 = 1; $t = 0; $t2 = 0; $t3 = 0;
		setTimeout('document.getElementById("divPaiementx4").style.opacity = "1"', 1);
		document.getElementById("divPaiementx4").style.opacity = "0.5";
		document.getElementById("divPaiementx4").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divStatistique").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divAjouter").style.display = "none";
		document.getElementById("divRemise").style.display = "none";
		document.getElementById("divModifier").style.display = "none";
		document.getElementById("divModifier2").style.display = "none";
		document.getElementById("divModifier3").style.display = "none";
		document.getElementById("divPaiementx").style.display = "none";
		document.getElementById("divPaiementx2").style.display = "none";
		document.getElementById("divPaiementx3").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";
		document.getElementById("divText4").style.display = "none";
		
	}else{
		$p4 = 0;
		document.getElementById("divPaiementx4").style.display = "none";
	}
}

function textGerant(){
	if ( $t == 0){
		$n = 0; $s = 0; $f = 0; $a = 0; $r = 0; $r = 0; $m = 0; $m2 = 0; $m3 = 0; $p = 0; $p2 = 0; $p3 = 0; $p4 = 0; $t = 1; $t2 = 0; $t3 = 0;
		setTimeout('document.getElementById("divText").style.opacity = "1"', 1);
		document.getElementById("divText").style.opacity = "0.5";
		document.getElementById("divText").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divStatistique").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divAjouter").style.display = "none";
		document.getElementById("divRemise").style.display = "none";
		document.getElementById("divModifier").style.display = "none";
		document.getElementById("divModifier2").style.display = "none";
		document.getElementById("divModifier3").style.display = "none";
		document.getElementById("divPaiementx").style.display = "none";
		document.getElementById("divPaiementx2").style.display = "none";
		document.getElementById("divPaiementx3").style.display = "none";
		document.getElementById("divPaiementx4").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";
		
	}else{
		$t = 0;
		document.getElementById("divText").style.display = "none";
	}
}

function textMoniCode(){
	if ( $t2 == 0){
		$n = 0; $s = 0; $f = 0; $a = 0; $r = 0; $m = 0; $m2 = 0; $m3 = 0; $p = 0; $p2 = 0; $p3 = 0; $p4 = 0; $t = 0; $t2 = 1; $t3 = 0;
		setTimeout('document.getElementById("divText2").style.opacity = "1"', 1);
		document.getElementById("divText2").style.opacity = "0.5";
		document.getElementById("divText2").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divStatistique").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divAjouter").style.display = "none";
		document.getElementById("divRemise").style.display = "none";
		document.getElementById("divModifier").style.display = "none";
		document.getElementById("divModifier2").style.display = "none";
		document.getElementById("divModifier3").style.display = "none";
		document.getElementById("divPaiementx").style.display = "none";
		document.getElementById("divPaiementx2").style.display = "none";
		document.getElementById("divPaiementx3").style.display = "none";
		document.getElementById("divPaiementx4").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText3").style.display = "none";
		
	}else{
		$t2 = 0;
		document.getElementById("divText2").style.display = "none";
	}
}

function textMoniCond(){
	if ( $t3 == 0){
		$n = 0; $s = 0; $f = 0; $a = 0; $r = 0; $m = 0; $m2 = 0; $m3 = 0; $p = 0; $p2 = 0; $p3 = 0; $p4 = 0; $t = 0; $t2 = 0; $t3 = 1;
		setTimeout('document.getElementById("divText3").style.opacity = "1"', 1);
		document.getElementById("divText3").style.opacity = "0.5";
		document.getElementById("divText3").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divStatistique").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divAjouter").style.display = "none";
		document.getElementById("divRemise").style.display = "none";
		document.getElementById("divModifier").style.display = "none";
		document.getElementById("divModifier2").style.display = "none";
		document.getElementById("divModifier3").style.display = "none";
		document.getElementById("divPaiementx").style.display = "none";
		document.getElementById("divPaiementx2").style.display = "none";
		document.getElementById("divPaiementx3").style.display = "none";
		document.getElementById("divPaiementx4").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		
	}else{
		$t3 = 0;
		document.getElementById("divText3").style.display = "none";
	}
}

function afficherListeGerer() {
	$liste = document.getElementById("type_employe");
	$liste.style.visibility = "visible"
	$liste.style.height = "115px";
	$liste.style.opacity = "1"
}

function cacherListeGerer() {
	$liste = document.getElementById("type_employe");
	$liste.style.visibility = "hidden"
	$liste.style.height = "0";
	$liste.style.opacity = "0"
}

function afficherListePayer() {
	$liste = document.getElementById("payer");
	$liste.style.visibility = "visible"
	$liste.style.height = "155px";
	$liste.style.opacity = "1"
}

function cacherListePayer() {
	$liste = document.getElementById("payer");
	$liste.style.visibility = "hidden"
	$liste.style.height = "0";
	$liste.style.opacity = "0"
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