<!------------------------------------------------------------------ PHP ---------------------------------------------------------------->
<?php
	session_start();
	include("../db_connexion.php");
	include 'pdo.php';
	include 'eventValidator.php';
	include 'events.php';
	$dbhost = DB_SERVER; // set the hostname
    $dbname = DB_DATABASE ; // set the database name
    $dbuser = DB_USERNAME ; // set the mysql username
    $dbpass = DB_PASSWORD;  // set the mysql password
    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    $index = 0;
	$event_id = 0;
	$id = 0;

	try{
		require_once('../db_connexion.php');
		if(!isset($_SESSION['id_c'])) {
			header("Location:../page_connexion.html");

		}else{
        	if(isset($_GET['evi'])){
        		$index = intval($_GET['evi']);
        		if(is_int($index)){
        			$event_id = intval($_SESSION['event_id'][$index]);// affecter l'id d'évènement en question dans $event_id
        		}
        	}

			$id=$_SESSION['id_c'];
			$requete="SELECT * FROM `candidat` WHERE id_c='$id'";
			$resultat=$connexion->query($requete);

			while($row=$resultat->fetch()) {
				$id=$row['id_c'];
				$nom=$row['Nom'];
				$prenom=$row['Prenom'];
				$id_m=$row['id_m'];
				$niveau=$row['niveau'];
				$photo=$row['Photo'];
				$mail = $row['Email'];
				$naissance=$row['Naissance'];
				$ville=$row['Ville'];
				$email=$row['Email'];
				$phone=$row['Telephone'];
				$pw=$row['Password'];
			}
		}

		if (isset($_POST['dec'])) {
	        unset($_SESSION['id_c']);
	        header("Location: ../page_connexion.html");
	    }
	}catch (PDOException $e) {
		echo "Erreur ! " . $e->getMessage() . "<br/>";
	}
?>
<!---------------------------------------------------------------- FIN PHP --------------------------------------------------------------->

<!--------------------------------------------------------------- HTML CODE -------------------------------------------------------------->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
	<title>Page candidat</title>
	<link rel="stylesheet" type="text/css" href="../ressource/css/style_ajouter.css">
	<link rel="stylesheet" type="text/css" href="ressource/css/style_global.css">
	<link rel="stylesheet" type="text/css" href="ressource/css/style_menu_left.css">
	<link rel="stylesheet" type="text/css" href="ressource/css/style_table.css">
	<link rel="stylesheet" type="text/css" href="ressource/css/style_candidat.css">
	<link rel="stylesheet" type="text/css" href="ressource/css/style_contexte_calendrier.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
	<script type="text/javascript" src="ressource/js/add.js"></script>
	<script src="ressource/js/menu.js"></script>
	<script src="ressource/js/notification.js"></script>
	<script src="ressource/js/menu-left.js"></script>
	<script src="ressource/js/openDiv.js"></script>
	<script src="../ressource/js/jquery.js"></script><!-- verification des donnes -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script><!-- Modifier l'image de profile-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script><!-- Modifier l'image de profile-->
    <script type="text/javascript">
		function deleteE(){ if(confirm("Voulez vous supprimer cet évènement ?")){ window.location.href = "delete.php?evi=<?php echo $event_id; ?>"; } }
	</script>
</head>
<body onload="removeLoader();openPanelAdd('divAddEvent')">
	<?php include 'header.php'; ?>
	  		<?php 
				$pdo = get_pdo();
				$events = new Events($pdo);
				$errors = [];
				$par = "";
				if(!isset($event_id)){// si l'id d'évènement n'est pas spécifié, faire une redirection vers la page candidat
					echo '<script type="text/javascript">alert("ID d\'évènement non spécifié");</script>';
					header("Location: candidat.php");
				}
				else{
					// essayer de trouver l'évènement avec son id. Si une exception occure(cet id ne se trouve pas dans la BDD ...), faire une redirection ou afficher un message d'information ou d'erreur
					try{
						$event = $events->find($event_id);// trouver l'évènement
					}catch(Exception $e){
						echo $e;
						echo '<script type="text/javascript">alert("Evènement introuvable !");</script>';
					}
				}
				
				$data = [
					"titre_e" 	=> $event->getNom(),
					"date_e"  	=> $event->getDebut()->format('Y-m-d'),
					"start"	  	=> $event->getDebut()->format('H:i:s'),
					"end"	  	=> $event->getFin()->format('H:i:s'),
					"id_m"		=> $event->getMoniId(),
					"id_can"  	=> $event->getCandId()	
				];

				if($_SERVER['REQUEST_METHOD'] === 'POST'){// si les données sont postées
					$data['titre_e'] = strval($_POST['titre_e']);
					$data['date_e'] = $_POST['date_e'];
					$data['start'] = $_POST['start'].':00:00';
					$data['end'] = ($_POST['start']+1).':00:00';
					$data['id_m'] = $event->getMoniId();
					$data['id_can'] = $event->getCandId();

					$validator = new EventValidator();
					$errors = $validator->validates($data);// passer comme paramètre tous les données postées
					if(empty($errors)){// si tous les données sont valides
						$pdo = get_pdo();

						$nomL=$data['titre_e'];
						$date=$data['date_e'];
						$deb = date_create_from_format('Y-m-d H:i:s', $data['date_e'] . ' ' .$data['start']);
						$fin = date_create_from_format('Y-m-d H:i:s', $data['date_e'] . ' ' .$data['end']);

						// faire une vérification si les dates données par l'utilisateur sont des dates antérieures
						$debTimeStamp = $deb->getTimestamp();// le timeStamp est le nombre de secondes depuis 1970
						$dateActuelTimeStamp = date_create_from_format('Y-m-d H:i', date('Y-m-d H:i'))->getTimestamp();

						$nbrL = 0;// nombre des leçons
						$nbrMconduite = 0;// nombre des moniteurs de conduite
						$nbrVoiture = 0;// nombre des voitures
						
						if($debTimeStamp < $dateActuelTimeStamp){
							
							$par = '<p class="alert alert-danger">Vous ne pouvez pas choisir une date antérieure !</p>';
						}
						else{
							if((intval($deb->format('H')) >= 8 && intval($deb->format('H')) <= 11) || (intval($deb->format('H')) >= 14 && intval($deb->format('H')) <= 17)){
								if($id_m != null && $id_m != 0){
									
									$requete = $pdo->prepare("SELECT * FROM Leçon WHERE ((debut BETWEEN ? AND ?) AND id_m = ? AND id_candidat <> ?)");
									$requete->execute(array(($deb->format('Y-m-d'))." 08:00:00", ($deb->format('Y-m-d'))." 17:00:00", $id_m, $id));
									$nbrL = $requete->rowCount();

									if($nbrL === 8){
										$par = '<p class="alert alert-danger">L\'emploi du temps de votre moniteur est plein pour le jour choisi!</p>';
									}
									else if($nbrL < 8){
										$requete = $pdo->prepare("SELECT * FROM Leçon WHERE debut = ? AND fin = ? AND id_m = ? AND id_candidat <> ?");
										$requete->execute(array($deb->format('Y-m-d H:i:s'), $fin->format('Y-m-d H:i:s'), $id_m, $id));
										$nbrL = $requete->rowCount();

										if($nbrL === 1){
											$par = '<p class="alert alert-danger">Votre moniteur a une séance avec un autre candidat dans cette horaire!</p>';
										}
										else if($nbrL < 1){
											if($nomL === "code" && $niveau === "code"){
												$requete = $pdo->prepare("SELECT * FROM Leçon WHERE debut = ? AND fin = ? AND nom = 'code' AND id_candidat = ?");
												$requete->execute(array($deb->format('Y-m-d H:i:s'), $fin->format('Y-m-d H:i:s'), $id));
												$nbrL = $requete->rowCount();

												if($nbrL === 1){
													$par = '<p class="alert alert-danger">Votre leçon existe déja dans cet horaire!</p>';
												}
												else if($nbrL < 1){
													$events->hydrate($event, $data);
													$events->update($event);// modifier l'évènement
													$msg_success = '<p class="alert alert-success">Leçon de code modifiée avec succès, vous pouvez retourner à votre profil</p>';
													$par = $msg_success;

													$dateMoment = date('U');
													$nameN = "Une de vos séances a été modifiée !";
													$messageN = "Une séance de Code a été modifié par le candidat " . $nom . " " . $prenom . ".<br>";
													$messageN .= "Nouvelle date: " . $deb->format('d-m-Y') . " à " . $deb->format('H') . "h.";
													$notifSent = $pdo->query("INSERT INTO notification (`name`,`message`,`status`,`date`,`id_employee`,`id_candidat`) VALUES('$nameN', '$messageN', '0', '$dateMoment', '$id_m', '0')");


												}
												else{
													die();
												}
											}
											else if($nomL === "conduite" && ($niveau === "creneau" || $niveau === "circuit")){
												$requete = $pdo->prepare("SELECT * FROM Leçon WHERE debut = ? AND fin = ? AND nom = ? AND id_candidat = ?");
												$requete->execute(array($deb->format('Y-m-d H:i:s'), $fin->format('Y-m-d H:i:s'), $niveau, $id));
												$nbrL = $requete->rowCount();

												if($nbrL === 1){
													$par = '<p class="alert alert-danger">Votre leçon existe déja dans cet horaire!</p>';
												}
												else if($nbrL < 1){
													$requete2 = $pdo->prepare("SELECT * FROM voiture WHERE transmission = :trans AND id_emp = :id_m");
													$requete2->execute(array('trans' => $typeV, 'id_m' => $id_m));
													$nbrVoiture = $requete2->rowCount();

													if($nbrVoiture < 1){
														$par = '<p class="alert alert-danger">Vous ne pouvez pas ajouter cette leçon, il n\'y a pas de voitures suffisantes!</p>';
													}
													else{
														$events->hydrate($event, $data);
														$events->update($event);// modifier l'évènement
														$msg_success = '<p class="alert alert-success">Leçon de conduite modifiée avec succès, vous pouvez retourner à votre profil</p>';
														$par = $msg_success;

														$dateMoment = date('U');
														$nameN = "Une de vos séances a été modifiée !";
														$messageN = "Une séance de Conduite a été modifié par le candidat " . $nom . " " . $prenom . ".<br>";
														$messageN .= "Nouvelle date: " . $deb->format('d-m-Y') . " à " . $deb->format('H') . "h.";
														$notifSent = $pdo->query("INSERT INTO notification (`name`,`message`,`status`,`date`,`id_employee`,`id_candidat`) VALUES('$nameN', '$messageN', '0', '$dateMoment', '$id_m', '0')");
													}
												}
												else{
													die();
												}
											}
											else{
												$par = '<p class="alert alert-danger">Votre niveau actuel est: ' . $niveau . ' et vous essayer d\'ajouter une leçon de ' . $nomL . '</p>';
											}
										}
										else{
											die();
										}
									}
									else{
										die();
									}
								}
								else{
									$par = '<p class="alert alert-danger">Vous n\'avez pas encore de moniteur!</p>';
								}
							}
							else{
								$par = '<p class="alert alert-danger">Horaire invalide ! les horaires d\'entrainement: 8h->12h, 14h->18h</p>';
							}	
						}
					}
				}
			?>

			<?php 
				//if(!empty($errors)){
			?>
				<!--<div><p class="alert alert-danger">Corriger vos erreurs</p></div>-->
			<?php 
				//}
			?>

	<!--------------------------------------------------------- STYLE DE PAGE ----------------------------------------------------------->
	<div id="loading" class="loader"></div>
	<div class="right-menu">
		<div class="imgNav">
			<a class="pImage"><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($photo).'"/>'; ?></a>
		</div>
		<div class="leftNav"> 
			<a>
				<?php echo $nom; ?>
				<?php echo $prenom; ?>
				<?php echo " <span class='nivT'><span class='niveau'>|</span> Niveau: <span class='niveau'>" . $niveau; echo "</span></span>"; ?>
				<?php
					if ($id_m != null){
						$req=$connexion->query("SELECT * FROM employee WHERE id=$id_m");
						$req=$req->fetch();
						$dispMN= $req['Nom'];
						$dispMP= $req['Prenom'];
						$nomComplet = $dispMN . " " . $dispMP;
					}
					else {
						$nomComplet = "Non assigné";
					}
				?>
				<?php echo " <span class='nivT'><span class='niveau'>|</span> Moniteur: <span class='niveau'>" . $nomComplet; echo "</span></span>"; ?>
			</a>
		</div>
		<div class="topnav" id="myTopnav">
			<a href="candidat.php" class="active">Candidat</a>
			<a href="#" onclick="openPanelAdd('divProfile')">Profil</a>
			<?php
				$resultat=$connexion->query("SELECT * FROM notification WHERE status='0' AND id_candidat='$id'");
				
				if ($resultat->rowCount()>0) {
			?>
					<a href="#" onclick="openPanelAdd('divNotification');notificationVu(<?php echo $id?>)"><i class="fa fa-bell"><span id="nbNotif"><?php echo $resultat->rowCount(); ?></span></i></a>
		   <?php
				} else {
			?>
					<a href="#" onclick="openPanelAdd('divNotification')"><i class="fa fa-bell"><span class="badge badge badge-pill badge-danger"></span></i></a>
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
		<a href="candidat.php?open=divCalendrier"><i class="las la-calendar"></i> Calendrier</a>
		<div onmouseover="afficherListeCour()" onmouseout="cacherListeCour()">
			<a><i class="las la-file-alt"></i> Cours de Code</a>
			<div id="cours" class="ids">
				<a href="candidat.php?open=divSignal" class="smallTitle"><i class="las la-sms"></i> Les signalisations</a>
				<a href="candidat.php?open=divPanneau" class="smallTitle"><i class="las la-sms"></i> Les panneaux et les panonceaux</a>
				<a href="candidat.php?open=divIntersection" class="smallTitle" ><i class="las la-sms"></i> Les intersections</a>
				<a href="candidat.php?open=divFeux" class="smallTitle"><i class="las la-sms"></i> Feux et tournants</a>
				<a href="candidat.php?open=divCroisement" class="smallTitle"><i class="las la-sms"></i> Les croisements</a>
				<a href="candidat.php?open=divDepassement" class="smallTitle"><i class="las la-sms"></i> Les Dépassements</a>
				<a href="candidat.php?open=divArret" class="smallTitle"><i class="las la-sms"></i> L'arrêt et le stationnement</a>
				<a href="candidat.php?open=divVitesse" class="smallTitle"><i class="las la-sms"></i> Réglementation de vitesse & choix des voies</a>
			</div>
		</div>
		<a href="test.php"><i class="las la-file"></i> Passer un test</a>
		<a href="candidat.php?open=divResultat"><i class="las la-clipboard"></i> Resultat</a>	
	</div>
	<!------------------------------------------------------- FIN STYLE DE PAGE --------------------------------------------------------->


	<!------------------------------------------------------- DIV NOTIFICATION ---------------------------------------------------------->
	<div id="divNotification" class="contain">
		<div class="liste">
			<h1>Notification</h1>
			<?php
			   	$resultat1=$connexion->query("SELECT * FROM notification WHERE id_candidat='$id'");
			   	if (! $resultat1->fetch())
			   		echo "<span class='niveau'>Aucune notification.</span>";
			   	$resultat1=$connexion->query("SELECT * FROM notification WHERE id_candidat='$id'");
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


	<!--------------------------------------------------------- DIV PROFILE ------------------------------------------------------------->
	<div id="divProfile" class="contain">
		<form id="formulaire" method="post" enctype="multipart/form-data">
			<table class="table" width="100%">
				<tr><td colspan="2"><label id="title"><h2>Mon Profil :</h2></label></td></tr>

				<!------------------------------------ Code Script ------------------------------->
		       	<script type="text/javascript">
					$(document).ready(function(){  
						$('#insert').click(function(){  
						var image_name = $('#image').val();  
						if(image_name == ''){  
							alert("Selectionner une image svp!");  
							return false;

						} else {
							var extension = $('#image').val().split('.').pop().toLowerCase();  
							if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1) {
								alert('Invalide Image File!');  
								$('#image').val('');  
								return false;  
							}
						}  
						});  
					});
				</script>
				<script type="text/javascript">

			        $(document).ready(function() {
			            $('#ad_email').blur(function(e) {
			                var value = $(this).val();
			                liveEmailSearch(value);
			            });
			        });
			        function liveEmailSearch(val){
			            $.post('../controller_db.php',{'ad_email': val}, function(data){
			                if(data == true){
			                    $('#err_mail').html("Quelqu'un a déjà cette adresse e-mail. Essayez avec une autre adresse.");
			                    document.getElementById("ad_email").className = "erreurChamp";
			                }
			            }).fail(function(xhr, ajaxOptions, thrownError) {               
			                alert(thrownError);                              
			            });
			        }

			        $(document).ready(function() {
			            $('#phone').blur(function(e) {
			                var value1 = $(this).val();
			                livePhoneSearch(value1);
			            });
			        });
			        function livePhoneSearch(val){
			            $.post('../controller_db.php',{'phone': val}, function(data){
			                if(data == true){
			                    $('#err_phone').html("Quelqu'un a déjà ce numéro. Essayez avec un autre numéro.");
			                    document.getElementById("phone").className = "erreurChamp";
			                }
			            }).fail(function(xhr, ajaxOptions, thrownError) {                
			                alert(thrownError);                                 
			            });
			        }
			    </script>
			    <!---------------------------------- FIN Code Script ----------------------------->

			    <!-------------------------------------- Photo  ---------------------------------->
			    <tr>
			    	<th colspan="2">
			    		<label class="label">Photo <div class="stars">*<span class="champReq">Champ requis</span></div></label>
			    	</th>
			    </tr>
			    <tr>
					<td colspan="2" align="center">
						<input type="submit" style="display: none" name="insert" id="insert" value="Insert"/>
						<input type="file" class="cursor" name="image" id="image" style="height: unset; width: 40%" />
						<label for="insert" class="cursor"><i class="las la-sync"></i> </label>
					</td>
				</tr>
				<!-------------------------------------------------------------------------------->

				<!----------------------------------- Nom + Prenom  ------------------------------>
				<tr>
					<td>
						<label for="nom" class="label">Nom <div class="stars">*<span class="champReq">Champ requis</span></div></label>
					</td>
					<td>
						<label for="prenom" class="label">Prénom <div class="stars">*<span class="champReq">Champ requis</span></div></label>
					</td>
				</tr>

				<tr>
					<td>
						<input type="text" id="nom" name="nom" maxlength="30" onfocusOut="verifier_nom()" value="<?php echo $nom ?>" required autocomplete="off">
					</td>
					<td>
						<input type="text" id="prenom" name="prenom" maxlength="30" onfocusOut="verifier_prenom()" value="<?php echo $prenom ?>" required autocomplete="chrome-off">
					</td>
				</tr>

				<tr>
					<td>
						<div class="fixed-size"><label id="err_nom"></label></div>
					</td>
					<td>
						<div class="fixed-size"><label id="err_prenom"></label></div>
					</td>
				</tr>
				<!-------------------------------------------------------------------------------->

				<!------------------------------ Naissance + Ville ------------------------------->
				<tr>
					<td>
						<label for="naissance" class="label">Naissance <div class="stars">*<span class="champReq">Champ requis</span></div></label>
					</td>
					<td>
                        <label for="ville" class="label">Ville <div class="stars">*<span class="champReq">Champ requis</span></div></label>
                    </td>
				</tr>

				<tr>
					<td>
						<input type="date" id="naissance" name="naissance" min="1950-01-01" onfocusOut="verifier_dates()" value="<?php echo $naissance ?>" required>
					</td>
					<td>
                        <input type="text" id="ville" name="ville" onfocusOut="verifier_ville()" value="<?php echo $ville ?>" required>
                    </td>
				</tr>

				<tr>
					<td>
						<div class="fixed-size"><label id="err_naiss"></label></div>
					</td>
					<td>
                        <div class="fixed-size"><label id="err_ville"></label></div>
                    </td>
				</tr>
				<!-------------------------------------------------------------------------------->

				<!--------------------------------- Email + Tel ---------------------------------->
				<tr>
					<td>
						<label for="ad_email" class="label">Adresse email <div class="stars">*<span class="champReq">Champ requis</span></div></label>
					</td>
					<td>
						<label for="phone" class="label">Téléphone <div class="stars">*<span class="champReq">Champ requis</span></div></label>
					</td>
				</tr>

				<tr>
					<td >
						<input type="email" id="ad_email" name="ad_email" placeholder="exemple: ab_D.1@doM1n.xYz" onfocusOut="verifier_mail()" value="<?php echo $email ?>" required>
					</td>
					<td>
						<input type="tel" id="phone" name="phone" maxlength="10" onfocusOut="verifier_tel()" value="<?php echo $phone ?>" required autocomplete="chrome-off">
					</td>
				</tr>

				<tr>
					<td>
						<div class="fixed-size"><label id="err_mail"></label></div>
					</td>
					<td>
						<div class="fixed-size"><label id="err_phone"></label></div>
					</td>
				</tr>
				<!-------------------------------------------------------------------------------->


				<!----------------------------------- mot de passe ------------------------------->
				<tr>
					<th colspan="2" class="center-cell">
						<label for="mot_passe" class="label">Mot de Passe <div class="stars">*<span class="champReq">Champ requis</span></div></label>
					</th>
				</tr>

				<tr>
					<th colspan="2" class="center-cell">
						<input type="password" id="mot_passe" name="mot_passe" value="<?php echo $pw ?>" oninput="verifier_pw()" size="35" required>
					</th>
				</tr>

				<tr>
					<th colspan="2" class="center-cell">
						<label id="err_pw"></label>
					</th>
				</tr>
				<!-------------------------------------------------------------------------------->

				<!---------------------------------Valider + effacer------------------------------>
				<tr>
					<th colspan="2" class="center-cell">
						<label id="err_submit"></label>
					</th>
				</tr>

				<tr>
					<th align="center" colspan="2">
						<button class="btValider" id="valider" name="valider" onclick="validateForm()"><span>Valider</span></button>
					</th>
				</tr>
				<!-------------------------------------------------------------------------------->

				<!--------------------------------le traitement de php --------------------------->
				<?php
					try {
						if(isset($_POST["insert"])){  
							$file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));  
							$query = "UPDATE candidat SET Photo ='$file' where id_c='$id'";  
							if(mysqli_query($connect, $query)) {
								echo "<script>if(confirm(\" Votre photo de profil est modifier avec succès.\")){document.location.href='candidat.php'};</script>";
							}

						} else if (isset($_POST['valider'])) {
							$nom=$_POST['nom'];
                            $prenom=$_POST['prenom'];
                            $naissance=$_POST['naissance'];
							$ville=$_POST['ville'];
							$email=$_POST['ad_email'];
							$phone=$_POST['phone'];
							$mot_passe=$_POST['mot_passe'];
							$requete="UPDATE candidat SET Nom='$nom', Prenom='$prenom', Naissance='$naissance', Ville='$ville', Email='$email', Telephone='$phone', Password='$mot_passe' WHERE id_c='$id'";
							$connexion->exec($requete);

							echo "<script>if(confirm(\" Profil modifier avec succès.\")){document.location.href='candidat.php'};</script>";
						}

					} catch (PDOException $e) {
						echo "Erreur ! " . $e->getMessage() . "<br/>";
					}
				?>
			</table>
		</form>
	</div>
	<!------------------------------------------------------- DIV FIN PROFILE ----------------------------------------------------------->


	<!--------------------------------------------------------- DIV PROFILE ------------------------------------------------------------->
	<div id="divAddEvent" class="contain">
		<div class="liste">
			<h1>Editer l'évènement <small><?php echo h($event->getNom()); ?></small></h1>
			<div id="event_container">
			<?php include 'header.php'; ?>
			<?php 
				if(!empty($errors)){
			?>
				<div><p class="alert alert-danger">Corriger vos erreurs</p></div>
			<?php 
				}
				else{
					echo '<div id="success">' . $par . '</div>';
				}
			?>
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"].'?evi='.$event_id);?>" method="POST" id="event_form">
				<table class="table" width="100%">
					<tr>
						<td class="tdInf">
							<label for="titre_e">Type<div class="stars">*<span class="champReq">Champ requis</span></div></label>
						</td>
					</tr>
					<tr>
						<td class="tdInf">
							<select id="titre_e" name="titre_e" class="form-control">
								<option value="code" selected>Code</option>
								<option value="conduite" <?php if(isset($data['titre_e']) && $data['titre_e'] == "conduite"){echo "selected";}?>>Conduite</option>
							</select>
							<?php 
								if(isset($errors['titre_e'])){
							?>
								<small class="form-text"><?php echo $errors['titre_e']; ?></small>
							<?php
								}
							?>
						</td>
					</tr>
					<tr>
						<td class="tdInf">
							<label for="date_e">Date<div class="stars">*<span class="champReq">Champ requis</span></div></label>
						</td>
					</tr>
					<tr>
						<td class="tdInf">
							<input id="date_e" type="date" name="date_e" class="form-control" required value="<?php echo isset($data['date_e'])?h($data['date_e']):''; ?>">
							<?php 
								if(isset($errors['date_e'])){
							?>
								<small class="form-text"><?php echo $errors['date_e']; ?></small>
							<?php
								}
							?>
						</td>
					</tr>
					<tr>
						<td class="tdInf">
							<label for="start">Début<div class="stars">*<span class="champReq">Champ requis</span></div></label>
						</td>
					</tr>
					<tr>
						<td class="tdInf">
							<select id="start" name="start" class="form-control">
								<optgroup label="Matin">
									<option value="08" selected>08:00</option>
									<option value="09" <?php if(isset($data['start']) && $data['start'] == "09:00:00"){echo "selected";} ?>>09:00</option>
									<option value="10" <?php if(isset($data['start']) && $data['start'] == "10:00:00"){echo "selected";} ?>>10:00</option>
									<option value="11" <?php if(isset($data['start']) && $data['start'] == "11:00:00"){echo "selected";} ?>>11:00</option>
								</optgroup>
								<optgroup label="Aprés-midi">
									<option value="14" <?php if(isset($data['start']) && $data['start'] == "14:00:00"){echo "selected";} ?>>14:00</option>
									<option value="15" <?php if(isset($data['start']) && $data['start'] == "15:00:00"){echo "selected";} ?>>15:00</option>
									<option value="16" <?php if(isset($data['start']) && $data['start'] == "16:00:00"){echo "selected";} ?>>16:00</option>
									<option value="17" <?php if(isset($data['start']) && $data['start'] == "17:00:00"){echo "selected";} ?>>17:00</option>
								</optgroup>
							</select>
							<?php 
								if(isset($errors['start'])){
							?>
								<small class="form-text"><?php echo $errors['start']; ?></small>
							<?php
								}
							?>
						</td>
					</tr>
					<tr>
						<td>
							<button class="btModEv" type="button" id="send" onclick="validateForm()"><span>Modifier l'évènement</span></button>
						</td>
					</tr>
					<tr>
						<td>
							<button class="btSupEv" type="button" id="delete" name="delete" onclick="deleteE()"><span>Supprimer l'évènement</span></button>
						</td>
					</tr>
			</form>
		</div>
		</div>
	</div>
	<!------------------------------------------------------- DIV FIN PROFILE ----------------------------------------------------------->




	<!------------------------------------------------------------ Footer --------------------------------------------------------------->
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