$r = 0; $lc = 0; $lp = 0; $pt = 0; $md = 0; $da = 0;$n=0; $cSup = 0; $cGer=0; $cCan=0;

function removeLoader() {
	$loader = document.getElementById("loading");
	$loader.style.display = "none";
}

function closeNav() {
	$menu = document.getElementById("sidePanel").style.marginLeft;
	if ( $menu == "-260px"){
		document.getElementById("sidePanel").style.marginLeft = "0";
		document.getElementById("resultatexaman").style.marginLeft = "0px";
		document.getElementById("listecandidat").style.margin = "100px calc(11% + 200px) auto";
		document.getElementById("candidatpret").style.margin = "100px calc(11% + 200px) auto";
		document.getElementById("notification").style.margin = "100px calc(11% + 200px) auto";
		document.getElementById("test").style.margin = "100px calc(11% + 200px) auto";
		document.getElementById("modifier").style.margin = "100px calc(11% + 200px) auto";
		
		document.getElementById("arrows").style.transform = "rotate(0deg)";
		
	}else {
		document.getElementById("sidePanel").style.marginLeft = "-260px";
		document.getElementById("resultatexaman").style.marginLeft = "-260px";
		document.getElementById("listecandidat").style.margin = "100px 13% auto";
		document.getElementById("candidatpret").style.margin = "100px 13% auto";
		document.getElementById("notification").style.margin = "100px 13% auto";
		document.getElementById("test").style.margin = "100px 13% auto";
		document.getElementById("modifier").style.margin = "100px 13% auto";
		
		document.getElementById("arrows").style.transform = "rotate(180deg)";
	}  
}



function resultat() {
	if ( $r == 0 ){
		document.getElementById("resultatexaman").style.opacity = "0.5";
		document.getElementById("resultatexaman").style.display = "block";
		document.getElementById("listecandidat").style.display = "none";
		document.getElementById("candidatpret").style.display = "none";
		document.getElementById("test").style.display = "none";
		document.getElementById("modifier").style.display = "none";
		
		document.getElementById("notification").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";
		$r = 1; 
		$lc = 0; 
		$lp = 0; 
		$pt = 0; 
		$md = 0; 
		$da = 0;
		$n=0;
		$cCan=0;$cGer=0;$cSup=0;
		setTimeout('document.getElementById("resultatexaman").style.opacity = "1"', 1);

	}else{
		document.getElementById("resultatexaman").style.display = "none";
	$r = 0;
	}
}

function liste() {
	if ( $lc == 0){
		document.getElementById("listecandidat").style.opacity = "0.5";
		document.getElementById("listecandidat").style.display = "block";
		document.getElementById("resultatexaman").style.display = "none";
		document.getElementById("candidatpret").style.display = "none";
		document.getElementById("test").style.display = "none";
		document.getElementById("modifier").style.display = "none";
		
		document.getElementById("notification").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";

		$lc = 1; 
		$r = 0; 
		$lp = 0; 
		$pt = 0; 
		$md = 0; 
		$da = 0;
		$n=0;
		$cCan=0;$cGer=0;$cSup=0;
		setTimeout('document.getElementById("listecandidat").style.opacity = "1"', 1);

	}else{
		document.getElementById("listecandidat").style.display = "none";
		
		$lc = 0;
	}
}

function candidatpret() {
	if ( $lp == 0){
		document.getElementById("candidatpret").style.opacity = "0.5";
		document.getElementById("candidatpret").style.display = "block";
		document.getElementById("resultatexaman").style.display = "none";
		document.getElementById("listecandidat").style.display = "none";
		document.getElementById("test").style.display = "none";
		document.getElementById("modifier").style.display = "none";
		
		document.getElementById("notification").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";
		$lp = 1; 
		$r = 0; 
		$lc = 0; 
		$pt = 0; 
		$md = 0; 
		$da = 0;
		$n=0;
		$cCan=0;$cGer=0;$cSup=0;
		setTimeout('document.getElementById("candidatpret").style.opacity = "1"', 1);

	}else{
		document.getElementById("candidatpret").style.display = "none";
		
		$lp = 0;
	}
}

function test() {
	if ( $pt == 0){
		document.getElementById("test").style.opacity = "0.5";
		document.getElementById("test").style.display = "block";
		document.getElementById("resultatexaman").style.display = "none";
		document.getElementById("listecandidat").style.display = "none";
		document.getElementById("candidatpret").style.display = "none";
		document.getElementById("modifier").style.display = "none";
		
	    document.getElementById("notification").style.display = "none";
	    document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";
		$pt = 1; 
		$r = 0; 
		$lc = 0; 
		$lp = 0; 
		$md = 0; 
		$da = 0;
		$n=0;
		$cCan=0;$cGer=0;$cSup=0;
		setTimeout('document.getElementById("test").style.opacity = "1"', 1);

	}else{
		document.getElementById("test").style.display = "none";
		
		$pt = 0;
	}
}

function modifiertest() {
	if ( $md == 0){
		document.getElementById("modifier").style.opacity = "0.5";
		document.getElementById("modifier").style.display = "block";
		document.getElementById("resultatexaman").style.display = "none";
		document.getElementById("listecandidat").style.display = "none";
		document.getElementById("candidatpret").style.display = "none";
		document.getElementById("test").style.display = "none";
		
		document.getElementById("notification").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";
		$md = 1; 
		$r = 0; 
		$lc = 0; 
		$lp = 0; 
		$pt = 0; 
		$da = 0;
		$n=0;
		$cCan=0;$cGer=0;$cSup=0;
		setTimeout('document.getElementById("modifier").style.opacity = "1"', 1);

	}else{
		document.getElementById("modifier").style.display = "none";
		
		$md = 0;
	}
}

function absence() {
	window.location.href ="absence.php";
	
}

function afficherNotification(){
	if ( $n == 0){
		$n=1; $da = 0; $r = 0; $lc = 0; $lp = 0; $pt = 0; $md = 0;$cCan=0;$cGer=0;$cSup=0;
    	setTimeout('document.getElementById("notification").style.opacity = "1"', 1);
		document.getElementById("notification").style.opacity = "0.5";
		document.getElementById("notification").style.display = "block";
		document.getElementById("resultatexaman").style.display = "none";
		document.getElementById("listecandidat").style.display = "none";
		document.getElementById("candidatpret").style.display = "none";
		document.getElementById("test").style.display = "none";
		document.getElementById("modifier").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";
	}else{
		$n = 0;
		document.getElementById("notification").style.display = "none";
	}
}

function contactSup(){
	if ( $cSup == 0){
		cSup=1;cGer=0;$cCan=0;$n=0; $da = 0; $r = 0; $lc = 0; $lp = 0; $pt = 0; $md = 0;
    	setTimeout('document.getElementById("divText").style.opacity = "1"', 1);
		document.getElementById("divText").style.opacity = "0.5";
		document.getElementById("divText").style.display = "block";
		document.getElementById("resultatexaman").style.display = "none";
		document.getElementById("listecandidat").style.display = "none";
		document.getElementById("candidatpret").style.display = "none";
		document.getElementById("test").style.display = "none";
		document.getElementById("modifier").style.display = "none";
		document.getElementById("notification").style.display = "none";
		document.getElementById("divText2").style.display = "none";
		document.getElementById("divText3").style.display = "none";
	}else{
		$cSup = 0;
		document.getElementById("divText").style.display = "none";
	}
}

function contactGer(){
	if ( $cGer == 0){
		$cGer=1;$cSup=0;$cCan=0;$n=0; $da = 0; $r = 0; $lc = 0; $lp = 0; $pt = 0; $md = 0;
    	setTimeout('document.getElementById("divText2").style.opacity = "1"', 1);
		document.getElementById("divText2").style.opacity = "0.5";
		document.getElementById("divText2").style.display = "block";
		document.getElementById("resultatexaman").style.display = "none";
		document.getElementById("listecandidat").style.display = "none";
		document.getElementById("candidatpret").style.display = "none";
		document.getElementById("test").style.display = "none";
		document.getElementById("modifier").style.display = "none";
		document.getElementById("notification").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText3").style.display = "none";
	}else{
		$cGer = 0;
		document.getElementById("divText2").style.display = "none";
	}
}

function contactCan(){
	if ( $cCan == 0){
		$cCan=1;$cGer=0;$cSup=0;$n=0; $da = 0; $r = 0; $lc = 0; $lp = 0; $pt = 0; $md = 0;
    	setTimeout('document.getElementById("divText3").style.opacity = "1"', 1);
		document.getElementById("divText3").style.opacity = "0.5";
		document.getElementById("divText3").style.display = "block";
		document.getElementById("resultatexaman").style.display = "none";
		document.getElementById("listecandidat").style.display = "none";
		document.getElementById("candidatpret").style.display = "none";
		document.getElementById("test").style.display = "none";
		document.getElementById("modifier").style.display = "none";
		document.getElementById("notification").style.display = "none";
		document.getElementById("divText").style.display = "none";
		document.getElementById("divText2").style.display = "none";
	}else{
		$cCan = 0;
		document.getElementById("divText3").style.display = "none";
	}
}



function afficherListeGerer() {
	$liste = document.getElementById("type_employe");
	$liste.style.visibility = "visible"
	$liste.style.height = "80px";
	$liste.style.opacity = "1"
}

function cacherListeGerer() {
	$liste = document.getElementById("type_employe");
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

