<!---------------------------------------------------- PHP pour recuperer id connecte --------------------------------------------------->
<?php
	session_start();
	include("../db_connexion.php");
	include 'pdo.php';
	$dbhost = DB_SERVER; // set the hostname
    $dbname = DB_DATABASE ; // set the database name
    $dbuser = DB_USERNAME ; // set the mysql username
    $dbpass = DB_PASSWORD;  // set the mysql password
    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	try{
	    require_once('../db_connexion.php');
	    $connexion = get_pdo();
		if(!isset($_SESSION['id'])) {
			header("Location:../page_connexion.html");
		}else{
			$id_g=$_SESSION['id'];
			$requete1="SELECT * FROM `employee` WHERE id='$id_g'";
			$resultat1=$connexion->query($requete1);
			
			while($row=$resultat1->fetch()) {
				$id=$row['id'];
				$nom=$row['Nom'];
				$prenom=$row['Prenom'];
				$naissance=$row['Naissance'];
				$ville=$row['Ville'];
				$email=$row['Email'];
				$phone=$row['Telephone'];
				$pw=$row['Password'];
				$photo=$row['Photo'];
			}

			if(isset($_GET['evi'])){
        		$index = intval($_GET['evi']);
        		if(is_int($index)){
        			$event_id = intval($_SESSION['event_id'][$index]);
        		}
        	}


		}

		if (isset($_POST['dec'])) {
	        unset($_SESSION['id']);
	        header("Location: ../page_connexion.html");
	    }
	}catch (PDOException $e) {
		echo "Erreur ! " . $e->getMessage() . "<br/>";
	}
?>
<!---------------------------------------------------------------- FIN PHP -------------------------------------------------------------->

<!--------------------------------------------------------------- HTML CODE ------------------------------------------------------------->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
	<title>Page gérant</title>
	<link rel="stylesheet" type="text/css" href="../ressource/css/style_global.css">
	<link rel="stylesheet" type="text/css" href="../ressource/css/style_menu_left.css">
	<link rel="stylesheet" type="text/css" href="../ressource/css/style_table.css">
	<link rel="stylesheet" type="text/css" href="../ressource/css/style_ajouter.css">
	<link rel="stylesheet" type="text/css" href="../ressource/css/gerant/cal_gerant.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
	<script src="../ressource/js/menu.js"></script>
	<script src="../ressource/js/superviseur/ajoutEmploye.js"></script>
	<script src="../ressource/js/notification.js"></script>
	<script src="../ressource/js/gerant/menu-left.js"></script>
	<script src="../ressource/js/jquery.js"></script><!-- verification des donnes -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script><!-- Modifier l'image de profile-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script><!-- Modifier l'image de profile-->
    <script type="text/javascript">
    	function afficherLessonCalendrierz() {
				setTimeout('document.getElementById("divLessonCal").style.opacity = "1"', 1);
				document.getElementById("divLessonCal").style.opacity = "0.5";
				document.getElementById("divLessonCal").style.display = "block";
		}
    </script>
</head>
<body onload="removeLoader();afficherLessonCalendrierz()">
	<!--------------------------------------------------------- STYLE DE PAGE ----------------------------------------------------------->
	<div id="loading" class="loader"></div>
	<div class="right-menu">
		<div class="imgNav">
			<a class="pImage"><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($photo).'"/>'; ?></a>
		</div>
		<div class="leftNav"> 
			<a class="nameNav">
				<?php echo $nom; ?>
				<?php echo $prenom; ?>
			</a>
		</div>
		<div class="topnav" id="myTopnav">
			<a class="active" href="gerant.php">Gérant</a>
			<a href="gerant.php?open=afficherProfile">Profil</a>
			<?php
				$resultat=$connexion->query("SELECT * FROM notification WHERE status='0' AND id_employee='$id'");
				
				if ($resultat->rowCount()>0) {
			?>
					<a href="#" onclick="afficherNotification();notificationVu(<?php echo $id?>)"><i class="fa fa-bell"><span id="nbNotif"><?php echo $resultat->rowCount(); ?></span></i></a>
		   <?php
				} else {
			?>
					<a href="#" onclick="afficherNotification()"><i class="fa fa-bell"><span class="nbNotif"></span></i></a>
			<?php
				}  
		    ?>
			<a class="buttonLink">
				<form method="POST">	
					<button class="deco" name="dec">Se deconnecter</button>		
				</form>
			</a>
			<a href="javascript:void(0);" class="icon" onclick="myFunction()">
				<i class="fa fa-bars"></i>
			</a>
		</div>
	</div>
	<div id="sidePanel" class="sidebar">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i id="arrows" class="las la-angle-double-left"></i></a>
		<a href="gerant.php?open=afficherCalendrier"><i class="las la-calendar"></i> Calendrier</a>
		<div onmouseover="afficherListeAbsence()" onmouseout="cacherListeAbsence()">
			<a><i class="las la-calendar-times"></i> Ajouter une absence</a>
			<div id="absence" class="ids">
				<a href="gerant.php?open=absenceCandidat"><i class="las la-calendar-times"></i>  Candidat</a>
				<a href="gerant.php?open=absenceMoniteurCode"><i class="las la-calendar-times"></i> Moniteur de code</a>
				<a href="gerant.php?open=absenceMoniteurCond"><i class="las la-calendar-times"></i> Moniteur de conduite</a>
			</div>
		</div>
		<div onmouseover="afficherListeUpdate()" onmouseout="cacherListeUpdate()">
			<a><i class="las la-folder-plus"></i> Affecter un moniteur</a>
			<div id="update" class="ids">
				<a href="gerant.php?open=updateCode"><i class="las la-folder-plus"></i>  Code</a>
				<a href="gerant.php?open=updateCreno"><i class="las la-folder-plus"></i> Créneau</a>
				<a href="gerant.php?open=updateCircuit"><i class="las la-folder-plus"></i> Circuit</a>
			</div>
		</div>
		<div onmouseover="afficherListeCandidat()" onmouseout="cacherListeCandidat()">
			<a><i class="las la-address-book"></i> Gérer les Candidats </a>
			<div id="candidat" class="ids">
				<a href="gerant.php?open=gererInscrit"><i class="las la-list"></i> Nouveau</a>
				<a href="gerant.php?open=gererCode"><i class="las la-list"></i>  Code</a>
				<a href="gerant.php?open=gererCreno"><i class="las la-list"></i> Créneau</a>
				<a href="gerant.php?open=gererCircuit"><i class="las la-list"></i> Circuit</a>
				<a href="gerant.php?open=gererAdmis"><i class="las la-list"></i> Admis</a>
			</div>
		</div>
		<div onmouseover="afficherListeText()" onmouseout="cacherListeText()">
			<a><i class="las la-comment"></i> Contact</a>
			<div id="text" class="ids">
				<a href="gerant.php?open=textSuperviseur"><i class="las la-sms"></i> Superviseur</a>
				<a href="gerant.php?open=textMoniCode"><i class="las la-sms"></i> Moniteur (Code)</a>
				<a href="gerant.php?open=textMoniCond"><i class="las la-sms"></i> Moniteur (Conduite)</a>
				<a href="gerant.php?open=textCandidat"><i class="las la-sms"></i> Candidat</a>
			</div>
		</div>
	</div>
	<!------------------------------------------------------- FIN STYLE DE PAGE --------------------------------------------------------->


	<!------------------------------------------------------- DIV NOTIFICATION ---------------------------------------------------------->
	<div id="divNotification" class="contain">
		<div class="liste">
			<h1>Notification</h1>
			<?php
			   	$resultat1=$connexion->query("SELECT * FROM notification WHERE id_employee='$id'");
			   	if (! $resultat1->fetch())
			   		echo "<span class='niveau'>Aucune notification.</span>";
			   	$resultat1=$connexion->query("SELECT * FROM notification WHERE id_employee='$id'");
			   	while ($row=$resultat1->fetch()){
			   	$id_notif = $row['id_n'];
			   	$date=$row['date'];
			   	$nom=$row['name'];
			   	$message=$row['message'];  
	        ?>
		    	<div class="notifComplete" id="divNotif<?php echo $id_notif?>">
					<div class="dateNotif">
						<?php 
							$currDate = date('U');
							$elapsed = $currDate - $date;
							if ($elapsed < 60)
								echo "Il y'a " . $elapsed . " secondes.";
							elseif ($elapsed < 3600) {
								if ($elapsed < 120)
									echo "Il y'a 1 minute.";
								else
									echo "Il y'a " . round($elapsed / 60) . " minutes.";
							}
							else if ($elapsed < (3600*24)) {
								if ($elapsed < (3600*2))
									echo "Il y'a 1 heure.";
								else
									echo "Il y'a " . round($elapsed / 3600) . " heures.";
							}
							else
								if ($elapsed < (3600*48))
									echo "Il y'a 1 jour.";
								else
									echo "Il y'a " . round($elapsed / (3600*24)) . " jours.";
						?>
					</div>
					<div class="nomNotif"><?php echo $nom; ?></div>
					<div class="fermerNotif" onclick="fermerNotif(<?php echo $id_notif ?>);supprimerNotif(<?php echo $id_notif ?>)"><i class="fa fa-times-circle"></i></div>
					<div class="messageNotif"><b class="greendot">•</b> <?php echo $message; ?></div>
				</div>

			<?php
				}
			?>
		</div>
	</div>
	<!----------------------------------------------------- DIV FIN NOTIFICATION -------------------------------------------------------->


	<!------------------------------------------------------- DIV lesson  ---------------------------------------------------------->
	<div id="divLessonCal" class="contain">
		<div class="liste">
			<?php 
				include 'eventsG.php';
				include 'header.php';

				$pdo = get_pdo();
				$events = new Events($pdo);
				if(!isset($event_id)){
					echo '<script type="text/javascript">alert("ID d\'évènement non spécifié");</script>';
				}
				else{
					try{
						$event = $events->find($event_id);
					}catch(Exception $e){
						echo '<script type="text/javascript">alert("Evènement introuvable !");</script>';
					}
				}
			?>
			<h1>Type: <span class='niveau'><?php echo ucfirst(h($event->getNom())); ?></span></h1>
			<p>Date: <span class='niveau'><?php echo $event->getDebut()->format('d/m/Y'); ?></span></p>
			<p>Heure début: <span class='niveau'><?php echo $event->getDebut()->format('H:i'); ?></span> &nbsp&nbsp&nbsp&nbsp|&nbsp&nbsp&nbsp&nbsp Heure fin: <span class='niveau'><?php echo $event->getFin()->format('H:i'); ?></span></p>
			<?php
				$mGetter = $_GET['idm'];
				$req=$connexion->query("SELECT * FROM employee WHERE id=$mGetter");
				$req=$req->fetch();
				$dispMN= $req['Nom'];
				$dispMP= $req['Prenom'];

				$cGetter = $_GET['idc'];
				$req=$connexion->query("SELECT * FROM candidat WHERE id_c=$cGetter");
				$req=$req->fetch();
				$dispCN= $req['Nom'];
				$dispCP= $req['Prenom'];
			?>
			<p>Moniteur: <span class='niveau'><?php echo $dispMN. " " .$dispMP; ?></span> &nbsp&nbsp&nbsp&nbsp|&nbsp&nbsp&nbsp&nbsp Candidat: <span class='niveau'><?php echo $dispCN. " " .$dispCP; ?></span></p>
		</div>
	</div>
	<!----------------------------------------------------- DIV FIN lesson -------------------------------------------------------->



	<!---------------------------------------------------------- Footer ----------------------------------------------------------------->
	<div class="foooter">
		<footer id="footer">
	        <div id="footer-content">
	            <center>
	                <a href="#">à propos</a>
	                <a href="#">centre d'assistance</a>
	                <a href="#">conditions</a>
	                <a href="#">blog</a>
	                <a href="#">© 2020 TOXY</a>
	            </center>
	        </div>
	    </footer>
    </div>
	<!-------------------------------------------------------- FIN FOOTER --------------------------------------------------------------->

</body>
</html>
<!----------------------------------------------------------- FIN HTML CODE ------------------------------------------------------------->