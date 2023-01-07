function fermerNotif(num) {
	var id = "divNotif" + num;
	var notif = document.getElementById(id);
	var hauteur = notif.offsetHeight * (-1);
	notif.style.marginTop = hauteur - 5 + "px";
	notif.style.backgroundColor = "#B74E4E";
	notif.style.borderColor = "#B74E4E";
	setTimeout(function(){notif.style.opacity = "0.9"}, 10);
	setTimeout(function(){notif.style.opacity = "0.8"}, 25);
	setTimeout(function(){notif.style.opacity = "0.7"}, 40);
	setTimeout(function(){notif.style.opacity = "0.6"}, 55);
	setTimeout(function(){notif.style.opacity = "0.5"}, 70);
	setTimeout(function(){notif.style.opacity = "0.4"}, 85);
	setTimeout(function(){notif.style.opacity = "0.3"}, 100);
	setTimeout(function(){notif.style.opacity = "0.2"}, 115);
	setTimeout(function(){notif.style.opacity = "0.1"}, 130);
	setTimeout(function(){notif.style.opacity = "0"}, 145);
	setTimeout(function(){notif.style.display = "none"}, 500);
}

function notificationVu(idUtil) {
	document.getElementById("nbNotif").textContent = "";
	$.ajax({
		type: "POST",
		url: 'notification.php',
		data:{param1: idUtil, action:'notifVu'},
		success:function(html) {
		}
	});
}

function supprimerNotif(idNotif) {
	$.ajax({
		type: "POST",
		url: 'notification.php',
		data:{param1: idNotif, action:'notifSupp'},
		success:function(html) {
		}
	});
}
