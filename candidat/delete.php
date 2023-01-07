<?php
	session_start();
	header('content-type: text/html; charset=utf-8');

	include 'events.php';
	include 'eventValidator.php';
	include 'pdo.php';

	$index = 0;
	$event_id = 0;
	$id = 0;
    try{
        //Création d'une connexion avec le SGBD
        $connexion = get_pdo();

        if(!isset($_SESSION['id_c'])){
        	header("Location:page_connexion.php");
        }
        else{
        	$id = $_SESSION['id_c'];
        	if(isset($_GET['evi'])){
        		$index = intval($_GET['evi']);
        		if(is_int($index)){
        			$event_id = intval($_SESSION['event_id'][$index]);// affecter l'id d'évènement en question dans $event_id
        		}
        	}

        	$requete = $connexion->prepare("SELECT * FROM candidat where id_c=?");// utiliser prepare avec le marqueur ? pour éviter l'INJECTION SQL
        	$requete->execute(array($id));
        	
        	while($tuple=$requete->fetch()){
            	$prenom = $tuple['Prenom'];
            	$nom = $tuple['Nom'];
            	$niveau = $tuple['niveau'];
            	$mail = $tuple['Email'];
            	$typeV = $tuple['TypeV'];
            	$id_m = $tuple['id_m'];
        	}
    	}
    	//Clôture de la connexion
		$connexion = null;
    }catch (PDOException $e) {
        die('Erreur ! '.$e->getMessage());
    }
?>
<?php 
	$pdo = get_pdo();
	$events = new Events($pdo);
	
	if(!isset($event_id)){// si l'id d'évènement n'est pas spécifié, faire une redirection vers la page candidat
		echo '<script type="text/javascript">alert("ID d\'évènement non spécifié");</script>';
		//header('Location:candidat.php');
	}
	else{
		try{
			$event = $events->find($event_id);// trouver l'évènement


            $eventQuery = $pdo->query("SELECT * FROM Leçon WHERE id = ". $event_id);

            $qRes = $eventQuery->fetch(PDO::FETCH_ASSOC);


            $eventType = $qRes["nom"];
            $dateDebut = $qRes["debut"];

            $dateDebut = $event->getDebut();

            $dateMoment = date('U');
            $nameN = "Une de vos séances a été annulée !";
            $messageN = "La séance de " . ucfirst($eventType) . " du " . $dateDebut->format('d-m-Y') . " à " . $dateDebut->format('H') . "h a été annulée par le candidat " . $nom . " " . $prenom . ".<br>";
            $notifSent = $pdo->query("INSERT INTO notification (`name`,`message`,`status`,`date`,`id_employee`,`id_candidat`) VALUES('$nameN', '$messageN', '0', '$dateMoment', '$id_m', '0')");

			$events->delete($event);

            

			header("Location:candidat.php");
		}
		catch(Exception $e){
			echo '<script type="text/javascript">alert("Evènement introuvable !");</script>';
		}	
	}	
?>