<?php
	header('content-type: text/html; charset=utf-8');

	if($_POST['action'] == 'notifVu') {
  		require('../db_connexion.php');
  		$idUtil = $_POST['param1'];
  		$requete = $connexion->prepare("UPDATE notification SET status = '1' WHERE status='0' AND id_employee =?");
  		if (!$requete->execute([$idUtil])) {
            die("Requete SQL status notif echoué");
        } 
	}
	if($_POST['action'] == 'notifSupp') {
  		require('../db_connexion.php');
  		$idNotif = $_POST['param1'];
  		$requete = $connexion->prepare("DELETE FROM notification WHERE id_n=?");
  		if (!$requete->execute([$idNotif])) {
            die("Requete SQL supprimer notif echoué");
        } 
	}

?>