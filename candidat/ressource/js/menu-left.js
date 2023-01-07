$panels = ["divText", "divNotification", "divProfile", "divTest", "divChoix", "divCalendrier", "divResultat", "divRecu", "divText1", "divSignal", "divPanneau", "divIntersection", "divFeux", "divCroisement", "divDepassement", "divArret", "divVitesse"];
$panelDisplay = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];


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
		document.getElementById("divSignal").style.marginLeft = "0px";
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


function openPanel(open,test) {

	if (test) prompt("hello");

	$index = null;
	for (i = 0; i < $panels.length; i++) {
		if ($panels[i] == open) {
			$index = i;
			break;
		}
	}

	$operation = 0;
	if ($panelDisplay[$index] == 0) {
		$operation = 1;
	}
	else {
		$operation = 0;
	}


	if ($operation) {
		for (j = 0; j < $panels.length; j++) {
		
	  		if ($panels[j] == open){
	  			setTimeout('document.getElementById("'+open+'").style.opacity = "1"', 1);
				document.getElementById(open).style.opacity = "0.5";
				document.getElementById(open).style.display = "block";
				$panelDisplay[$index] = 1;
			}
			else {
				document.getElementById($panels[j]).style.display = "none";
				$panelDisplay[j] = 0;
			}
		}
		if (open == "divCalendrier") {
			closeNav();
		}
	}
	else {
		document.getElementById(open).style.display = "none";
		$panelDisplay[$index] = 0;
	}

}

function afficherListeCour() {
	document.getElementById("sidePanel").className = "wideSidebar"

	$liste = document.getElementById("cours");
	$liste.style.visibility = "visible"
	$liste.style.height = "330px";
	$liste.style.opacity = "1"
}

function cacherListeCour() {
	document.getElementById("sidePanel").className = "sidebar"
	$liste = document.getElementById("cours");
	$liste.style.visibility = "hidden"
	$liste.style.height = "0";
	$liste.style.opacity = "0"
}

function afficherTest(){
	window.location.href="test.php";
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