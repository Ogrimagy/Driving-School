$n = 0; $l = 0; $e = 0; $h = 0; $d = 0; $r = 0; $p = 0; $t = 0; t1 = 0;

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
		document.getElementById("divTest").style.marginLeft = "0px";
		document.getElementById("divChoix").style.marginLeft = "0px";
		document.getElementById("divCalendrier").style.marginLeft = "0px";
		document.getElementById("divResultat").style.marginLeft = "0px";
		document.getElementById("divRecu").style.marginLeft = "0px";
		document.getElementById("divText").style.margin = "100px calc(11% + 200px) auto";
		document.getElementById("divText1").style.margin = "100px calc(11% + 200px) auto";
		document.getElementById("arrows").style.transform = "rotate(0deg)";
		
	}else {
		document.getElementById("sidePanel").style.marginLeft = "-260px";
		document.getElementById("divNotification").style.marginLeft = "-260px";
		document.getElementById("divProfile").style.marginLeft = "-260px";
		document.getElementById("divTest").style.marginLeft = "-260px";
		document.getElementById("divChoix").style.marginLeft = "-260px";
		document.getElementById("divCalendrier").style.marginLeft = "-260px";
		document.getElementById("divResultat").style.marginLeft = "-260px";
		document.getElementById("divRecu").style.marginLeft = "-260px";
		document.getElementById("divText").style.margin = "100px 13% auto";
		document.getElementById("divText1").style.margin = "100px 13% auto";
		document.getElementById("arrows").style.transform = "rotate(180deg)";
	}  
}

function afficherNotification() {
	if ( $n == 0 ){
		$n = 1; $l = 0; $e = 0; $h = 0; $d = 0; $r = 0; $p = 0; $t = 0; t1 = 0;
		setTimeout('document.getElementById("divNotification").style.opacity = "1"', 1);
		document.getElementById("divNotification").style.opacity = "0.5";
		document.getElementById("divNotification").style.display = "block";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divTest").style.display = "none";
		document.getElementById("divChoix").style.display = "none";
		document.getElementById("divCalendrier").style.display = "none";
		document.getElementById("divResultat").style.display = "none";
		document.getElementById("divRecu").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText1").style.display = "none";
		
	}else{
		$n = 0;
		document.getElementById("divNotification").style.display = "none";
	}
}

function afficherProfile() {
	if ( $l == 0 ){
		$n = 0; $l = 1; $e = 0; $h = 0; $d = 0; $r = 0; $p = 0; $t = 0; t1 = 0;
		setTimeout('document.getElementById("divProfile").style.opacity = "1"', 1);
		document.getElementById("divProfile").style.opacity = "0.5";
		document.getElementById("divProfile").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divTest").style.display = "none";
		document.getElementById("divChoix").style.display = "none";
		document.getElementById("divCalendrier").style.display = "none";
		document.getElementById("divResultat").style.display = "none";
		document.getElementById("divRecu").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText1").style.display = "none";
		
	}else{
		$l = 0;
		document.getElementById("divProfile").style.display = "none";
	}
}

function passerTest() {
	if ( $e == 0 ){
		$n = 0; $l = 0; $e = 1; $h = 0; $d = 0; $r = 0; $p = 0; $t = 0; t1 = 0;
		setTimeout('document.getElementById("divTest").style.opacity = "1"', 1);
		document.getElementById("divTest").style.opacity = "0.5";
		document.getElementById("divTest").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divChoix").style.display = "none";
		document.getElementById("divCalendrier").style.display = "none";
		document.getElementById("divResultat").style.display = "none";
		document.getElementById("divRecu").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText1").style.display = "none";
		
	}else{
		$e = 0;
		document.getElementById("divTest").style.display = "none";
	}
}

function choisirMoniteur() {
	if ( $h == 0 ){
		$n = 0; $l = 0; $e = 0; $h = 1; $d = 0; $r = 0; $p = 0; $t = 0; t1 = 0;
		setTimeout('document.getElementById("divChoix").style.opacity = "1"', 1);
		document.getElementById("divChoix").style.opacity = "0.5";
		document.getElementById("divChoix").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divTest").style.display = "none";
		document.getElementById("divCalendrier").style.display = "none";
		document.getElementById("divResultat").style.display = "none";
		document.getElementById("divRecu").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText1").style.display = "none";
		
	}else{
		$h = 0;
		document.getElementById("divChoix").style.display = "none";
	}
}

function afficherCalendrier() {
	if ( $d == 0 ){
		$n = 0; $l = 0; $e = 0; $h = 0; $d = 1; $r = 0; $p = 0; $t = 0; t1 = 0;
		setTimeout('document.getElementById("divCalendrier").style.opacity = "1"', 1);
		document.getElementById("divCalendrier").style.opacity = "0.5";
		document.getElementById("divCalendrier").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divTest").style.display = "none";
		document.getElementById("divChoix").style.display = "none";
		document.getElementById("divResultat").style.display = "none";
		document.getElementById("divRecu").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText1").style.display = "none";
		
	}else{
		$d = 0;
		document.getElementById("divCalendrier").style.display = "none";
	}
}

function afficherResultat() {
	if ( $r == 0 ){
		$n = 0; $l = 0; $e = 0; $h = 0; $d = 0; $r = 1; $p = 0; $t = 0; t1 = 0;
		setTimeout('document.getElementById("divResultat").style.opacity = "1"', 1);
		document.getElementById("divResultat").style.opacity = "0.5";
		document.getElementById("divResultat").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divTest").style.display = "none";
		document.getElementById("divChoix").style.display = "none";
		document.getElementById("divCalendrier").style.display = "none";
		document.getElementById("divRecu").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText1").style.display = "none";
		
	}else{
		$r = 0;
		document.getElementById("divResultat").style.display = "none";	
	}
}

function afficherRecu() {
	if ( $p == 0 ){
		$n = 0; $l = 0; $e = 0; $h = 0; $d = 0; $r = 0; $p = 1; $t = 0; t1 = 0;
		setTimeout('document.getElementById("divRecu").style.opacity = "1"', 1);
		document.getElementById("divRecu").style.opacity = "0.5";
		document.getElementById("divRecu").style.display = "block";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divTest").style.display = "none";
		document.getElementById("divChoix").style.display = "none";
		document.getElementById("divCalendrier").style.display = "none";
		document.getElementById("divResultat").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText1").style.display = "none";
		
	}else{
		$p = 0;
		document.getElementById("divRecu").style.display = "none";	
	}
}

function textGerant() {
	if ( $t == 0 ){
		$n = 0; $l = 0; $e = 0; $h = 0; $d = 0; $r = 0; $p = 0; $t = 1; t1 = 0;
		setTimeout('document.getElementById("divText").style.opacity = "1"', 1);
		document.getElementById("divText").style.opacity = "0.5";
		document.getElementById("divNotification").style.display = "none";
		document.getElementById("divProfile").style.display = "none";
		document.getElementById("divTest").style.display = "none";
		document.getElementById("divChoix").style.display = "none";
		document.getElementById("divText").style.display = "block";
		document.getElementById("divCalendrier").style.display = "none";
		document.getElementById("divResultat").style.display = "none";
		document.getElementById("divRecu").style.display = "none";
		document.getElementById("divText1").style.display = "none";
		
	}else{
		$t = 0;
		document.getElementById("divText").style.display = "none";	
	}
}

function textMoniteur() {
	if ( $r == 0 ){
		$n = 0; $l = 0; $e = 0; $h = 0; $d = 0; $r = 0; $p = 0; $t = 0; t1 = 1;
		setTimeout('document.getElementById("divText1").style.opacity = "1"', 1);
		document.getElementById("divText1").style.opacity = "0.5";
		document.getElementById("divText1").style.display = "block";
		document.getElementById("divCalendrier").style.display = "none";
		document.getElementById("divResultat").style.display = "none";
		document.getElementById("divRecu").style.display = "none";
		document.getElementById("divText").style.display = "none";
		
	}else{
		$t1 = 0;
		document.getElementById("divText").style.display = "none";	
	}
}

function afficherListeText() {
	$liste = document.getElementById("text");
	$liste.style.visibility = "visible"
	$liste.style.height = "90px";
	$liste.style.opacity = "1"
}

function cacherListeText() {
	$liste = document.getElementById("text");
	$liste.style.visibility = "hidden"
	$liste.style.height = "0";
	$liste.style.opacity = "0"
}