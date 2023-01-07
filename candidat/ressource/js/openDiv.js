$panels = ["divNotification", "divProfile", "divAddEvent"];
$panelDisplay = [0, 0, 0];


function openPanelAdd(open) {

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