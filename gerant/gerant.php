<!---------------------------------------------------- PHP pour recuperer id connecte --------------------------------------------------->
<?php
	session_start();
	include("../db_connexion.php");
	$dbhost = DB_SERVER; // set the hostname
    $dbname = DB_DATABASE ; // set the database name
    $dbuser = DB_USERNAME ; // set the mysql username
    $dbpass = DB_PASSWORD;  // set the mysql password
    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	try{
	    require_once('../db_connexion.php');
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
</head>
<?php
		$divSelect = isset($_GET["open"]) ? $_GET["open"] : "";
		if ($divSelect != ""){
			$myServerData = $divSelect . "()";
		}
		else{
			$myServerData = "afficherCalendrier()";
		}
	?>
<body onload="removeLoader();<?php echo $myServerData; ?>">
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
			<a class="active" href="#">Gérant</a>
			<a href="#" onclick="afficherProfile()">Profil</a>
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
		<a onclick="afficherCalendrier()"><i class="las la-calendar"></i> Calendrier</a>
		<div onmouseover="afficherListeAbsence()" onmouseout="cacherListeAbsence()">
			<a><i class="las la-calendar-times"></i> Ajouter une absence</a>
			<div id="absence" class="ids">
				<a onclick="absenceCandidat()"><i class="las la-calendar-times"></i>  Candidat</a>
				<a onclick="absenceMoniteurCode()"><i class="las la-calendar-times"></i> Moniteur de code</a>
				<a onclick="absenceMoniteurCond()"><i class="las la-calendar-times"></i> Moniteur de conduite</a>
			</div>
		</div>
		<div onmouseover="afficherListeUpdate()" onmouseout="cacherListeUpdate()">
			<a><i class="las la-folder-plus"></i> Affecter un moniteur</a>
			<div id="update" class="ids">
				<a onclick="updateCode()"><i class="las la-folder-plus"></i>  Code</a>
				<a onclick="updateCreno()"><i class="las la-folder-plus"></i> Créneau</a>
				<a onclick="updateCircuit()"><i class="las la-folder-plus"></i> Circuit</a>
			</div>
		</div>
		<div onmouseover="afficherListeCandidat()" onmouseout="cacherListeCandidat()">
			<a><i class="las la-address-book"></i> Gérer les Candidats </a>
			<div id="candidat" class="ids">
				<a onclick="gererInscrit()"><i class="las la-list"></i> Nouveau</a>
				<a onclick="gererCode()"><i class="las la-list"></i>  Code</a>
				<a onclick="gererCreno()"><i class="las la-list"></i> Créneau</a>
				<a onclick="gererCircuit()"><i class="las la-list"></i> Circuit</a>
				<a onclick="gererAdmis()"><i class="las la-list"></i> Hors Cycle 	</a>
			</div>
		</div>
		<div onmouseover="afficherListeText()" onmouseout="cacherListeText()">
			<a><i class="las la-comment"></i> Contact</a>
			<div id="text" class="ids">
				<a onclick="textSuperviseur()"><i class="las la-sms"></i> Superviseur</a>
				<a onclick="textMoniCode()"><i class="las la-sms"></i> Moniteur (Code)</a>
				<a onclick="textMoniCond()"><i class="las la-sms"></i> Moniteur (Conduite)</a>
				<a onclick="textCandidat()"><i class="las la-sms"></i> Candidat</a>
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
			   	$nomNotif=$row['name'];
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
					<div class="nomNotif"><?php echo $nomNotif; ?></div>
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
							$query = "UPDATE employee SET Photo ='$file' where id='$id'";  
							if(mysqli_query($connect, $query)) {
								echo "<script>if(confirm(\" Votre photo de profile est modifier avec succées.\")){document.location.href='gerant.php'};</script>";
							}

						} else if (isset($_POST['valider'])) {
							$nom=$_POST['nom'];
                            $prenom=$_POST['prenom'];
                            $naissance=$_POST['naissance'];
							$ville=$_POST['ville'];
							$email=$_POST['ad_email'];
							$phone=$_POST['phone'];
							$mot_passe=$_POST['mot_passe'];
							$requete="UPDATE employee SET Nom='$nom', Prenom='$prenom', Naissance='$naissance', Ville='$ville', Email='$email', Telephone='$phone', Password='$mot_passe' WHERE id='$id'";
							$connexion->exec($requete);

							echo "<script>if(confirm(\" Profile modifier avec succées.\")){document.location.href='gerant.php'};</script>";
						}

					} catch (PDOException $e) {
						echo "Erreur ! " . $e->getMessage() . "<br/>";
					}
				?>
			</table>
		</form>
	</div>
	<!------------------------------------------------------- DIV FIN PROFILE ----------------------------------------------------------->


	<!-------------------------------------------------------- DIV CALENDRIER ----------------------------------------------------------->
	<div id="divCalendrier" class="contain">
		<div class="liste">
			<h1>Calendrier</h1>
			<?php 
						include 'header.php';
						include 'month.php';
						include 'eventsG.php';
						include 'pdo.php';
					?>
					<?php
						$pdo = get_pdo();
						$events = new Events($pdo);
						$month = new Month($_GET['month'] ?? null, $_GET['year'] ?? null);
						$start = $month->getFirstDay();
						$start = $start->format('N') === '0'?$start:$month->getFirstDay()->modify('last sunday');
						$weeks = $month->getWeeks();
						$end = $start->modify('+' . (6 + 7 * ($weeks -1)) . 'days');// date de fin d'évenement
						$events = $events->getEventsBetweenByDay($start, $end);
					?>
					<div id="header" class="d-flex flex-row align-items-center justify-content-between">
						<h1 class="monthHeader"><?php echo $month->toString(); ?></h1>
						<div id="prevnxt">
							<a href="gerant.php?month=<?php echo $month->previousMonth()->month; ?>&year=<?php echo $month->previousMonth()->year;?>" class="btn btn-primary">&lt</a>
							<a href="gerant.php?month=<?php echo $month->nextMonth()->month; ?>&year=<?php echo $month->nextMonth()->year;?>" class="btn btn-primary">&gt</a>
						</div>
					</div>
					
					<table class="calendar_table calendar_table-<?php echo $weeks; ?>weeks" width="100%" height="100%">
						<?php for($i = 0; $i < $weeks; $i++){?>
							<tr>
								<?php foreach($month->days as $k => $day){ 
									$date = $start->modify("+" . ($k + $i * 7) . " days");
									$eventsForDay = $events[$date->format('Y-m-d')] ?? [];
									$isToday = date('Y-m-d') === $date->format('Y-m-d');
								?>
								<td class="<?php echo $month->withinMonth($date)?'':'calendar_othermonth'; ?> <?php echo $isToday?'is-today':''; ?>">
									<?php if($i === 0){ ?>
										<span class="calendar_weekday"><?php echo $day; ?></span>
										<br>
									<?php } ?>
									<span class="calendar_day"><?php echo $date->format('d'); ?></span>
									<?php foreach($eventsForDay as $event){ ?>
									<br>
									<span class="calendar_event">
										<?php
											$idFinder = $event->getId();
											$req=$connexion->query("SELECT * FROM leçon WHERE id=$idFinder");
											$req=$req->fetch();
											$sendidc= $req['id_candidat'];
											$sendidm= $req['id_m'];
										?>
										<?php echo $event->getDebut()->format('H:i'); ?> - <a href="lesson.php?evi=<?php echo isset($_SESSION['id'])?$_SESSION['event_id'][$event->getId()]:'';          echo "&idc=".$sendidc."&idm=".$sendidm;      ?>" class="event_link"><?php echo ucfirst(h($event->getNom())); ?></a>
										<?php $_SESSION['event_id'][$event->getId()] = $event->getId(); ?>	
									</span>
									
									<?php 
										}
									?>
								</td>
								<?php } ?>
							</tr>
						<?php }?>
					</table>
<?php $pdo = null; ?>
		</div>
	</div>
	<!------------------------------------------------------ DIV FIN CALENDRIER --------------------------------------------------------->


	<!--------------------------------------------------------- DIV ABSENCE ------------------------------------------------------------->
	<div id="divAbsence" class="sub_liste">
		<h1>Ajouter l'absence d'un candidat</h1>
		<table class="modTable">
			<tr class="modRow" >
				<th class="modTh"></th>
				<th class="modTh">Nom et Prénom</th>
				<th class="modTh">Nbr Absence</th>
				<th class="modTh">Ajouter Absence</th>
			</tr>

			<?php
				try {
					$resultat=$connexion->query("SELECT * FROM `candidat`");
					while ($row=$resultat->fetch()) {
						$photo=$row['Photo'];
						$nom=$row['Nom'];
						$prenom=$row['Prenom'];
						$nbr_abs=$row['nbr_abs'];
			?>

			<tr class="modTr">
				<td class="modTd"><?php echo '<img class="cadre" src="data:image/jpeg;base64,'.base64_encode($photo).'"/>'; ?></td>
				<td class="modTd"><?php echo $nom;?> <?php echo $prenom;?></td>
				<td class="modTd"><?php echo $nbr_abs;?></td>

				<td>
					<form method="POST">
						<input type="hidden" name="nom_c" value="<?php  echo $row['Nom']; ?>">
						<input type="hidden" name="prenom_c" value="<?php  echo $row['Prenom']; ?>">
						<input type="hidden" name="id_c" value="<?php  echo $row['id_c']; ?>">
						<input type="hidden" name="niveau" value="<?php  echo $row['niveau']; ?>">
						<input type="hidden" name="Nbr_a" value="<?php  echo $row['nbr_abs']; ?>">
						<input class="ab" type="date" name="date_a" value="<?php echo date("Y-m-d");?>">
				</td>
				<td class="buttonSized">
						<button name="a_c" class="modifier"><i class="las la-plus"></i></button>
					</form>
				</td>
				<td class="buttonSized">
					<form method="POST" action="absence_candidat.php">
						<input type="hidden" name="id_g" value="<?php echo $id; ?>">
						<input type="hidden" name="id_c" value="<?php  echo $row['id_c']; ?>">
						<input type="hidden" name="nbr_abs" value="<?php  echo $row['nbr_abs']; ?>">
						<button name="candidat" class="supprim"><i class="las la-history"></i></button>
					</form>
				</td>

				<?php
			        if (isset($_POST['a_c'])) {
			            $id_c=$_POST['id_c'];
			            $nom=$_POST['nom_c'];
			            $prenom=$_POST['prenom_c'];
			            $date_abs=$_POST['date_a'];
			            $niv=$_POST['niveau'];
			            $nbr_abs=$_POST['Nbr_a'];

			            $resultat1=$connexion->query("SELECT * FROM `absence` WHERE Id_c='$id_c' AND Date_abs='$date_abs'");
						if ($resultat1->rowCount() != 0) {
							echo "<script>if(confirm(\"Erreur! Le candidat ".$nom." ".$prenom." a déja absenter le ".$date_abs.".\")){document.location.href='gerant.php'};</script>";
			        	} else {
			        		$nbr_abs=$nbr_abs+1;

				            $requete="UPDATE `candidat` SET Nbr_abs='$nbr_abs' WHERE id_c='$id_c'";
				            $connexion->query($requete);

				            $requete1="INSERT INTO `absence` (`Id_c` , `Date_abs`  , `Niveau`)
													VALUES   ('$id_c', '$date_abs' , '$niv');";
				            $connexion->query($requete1);

				            echo "<script>if(confirm(\"Le candidat ".$nom." ".$prenom." a absenter le ".$date_abs.".\")){document.location.href='gerant.php'};</script>";
				            break;
			        	}
			    	}
					} // close while loop
				}catch (PDOException $e) {
					echo "Erreur ! " . $e->getMessage() . "<br/>";
				}
				?>
			</tr>
		</table>
	</div>
	<!------------------------------------------------------- FIN DIV ABSENCE ----------------------------------------------------------->


	<!-------------------------------------------------------- DIV ABSENCE2 ------------------------------------------------------------->
	<div id="divAbsence2" class="sub_liste">
		<h1>Ajouter l'absence d'un moniteur de code</h1>
		<table class="modTable">
			<tr class="modRow" >
				<th class="modTh"></th>
				<th class="modTh">Nom et Prénom</th>
				<th class="modTh">Nbr Absence</th>
				<th class="modTh">Ajouter Absence</th>
			</tr>

			<?php
				try {
					$resultat=$connexion->query("SELECT * FROM `employee` WHERE id_role='3'");
					while ($row=$resultat->fetch()) {
						$photo=$row['Photo'];
						$nom=$row['Nom'];
						$prenom=$row['Prenom'];
						$nbr_abs=$row['nbr_abs'];
			?>

			<tr class="modTr">
				<td class="modTd"><?php echo '<img class="cadre" src="data:image/jpeg;base64,'.base64_encode($photo).'"/>'; ?></td>
				<td class="modTd"><?php echo $nom;?> <?php echo $prenom;?></td>
				<td class="modTd"><?php echo $nbr_abs;?></td>

				<td>
					<form method="POST">
						<input type="hidden" name="nom_c" value="<?php  echo $row['Nom']; ?>">
						<input type="hidden" name="prenom_c" value="<?php  echo $row['Prenom']; ?>">
						<input type="hidden" name="id_m" value="<?php  echo $row['id']; ?>">
						<input type="hidden" name="Nbr_a" value="<?php  echo $row['nbr_abs']; ?>">
						<input class="ab" type="date" name="date_a" value="<?php echo date("Y-m-d");?>">
				</td>
				<td class="buttonSized">
						<button name="a_code" class="modifier"><i class="las la-plus"></i></button>
					</form>
				</td>
				<td class="buttonSized">
					<form method="POST" action="absence_moniteur_code.php">
						<input type="hidden" name="id_g" value="<?php echo $id; ?>">
						<input type="hidden" name="id_m" value="<?php  echo $row['id']; ?>">
						<input type="hidden" name="nbr_abs" value="<?php  echo $row['nbr_abs']; ?>">
						<button name="mcode" class="supprim"><i class="las la-history"></i></button>
					</form>
				</td>

				<?php
			        if (isset($_POST['a_code'])) {
			        	$id_m=$_POST['id_m'];
			            $nom=$_POST['nom_c'];
			            $prenom=$_POST['prenom_c'];
			            $date_abs=$_POST['date_a'];
			            $nbr_abs=$_POST['Nbr_a'];

			            $resultat1=$connexion->query("SELECT * FROM `absence` WHERE Id_m='$id_m' AND Date_abs='$date_abs'");
						if ($resultat1->rowCount() != 0) {
							echo "<script>if(confirm(\"Erreur! Le moniteur de code ".$nom." ".$prenom." a déja absenter le ".$date_abs.".\")){document.location.href='gerant.php'};</script>";
						} else {
							$nbr_abs=$nbr_abs+1;

				            $requete="UPDATE `employee` SET Nbr_abs='$nbr_abs' WHERE id='$id_m'";
				            $connexion->query($requete);

				            $requete1="INSERT INTO `absence`(`Id_m` , `Date_abs` )
													VALUES  ('$id_m', '$date_abs');";
				            $connexion->query($requete1);

				            echo "<script>if(confirm(\"Le moniteur de code ".$nom." ".$prenom." a absenter le ".$date_abs.".\")){document.location.href='gerant.php'};</script>";
				            break;
						}
			    	}
					} // close while loop
				}catch (PDOException $e) {
					echo "Erreur ! " . $e->getMessage() . "<br/>";
				}
				?>
			</tr>
		</table>
	</div>
	<!------------------------------------------------------ FIN DIV ABSENCE2 ----------------------------------------------------------->


	<!-------------------------------------------------------- DIV ABSENCE3 ------------------------------------------------------------->
	<div id="divAbsence3" class="sub_liste">
		<h1>Ajouter l'absence d'un moniteur de conduite</h1>
		<table class="modTable">
			<tr class="modRow" >
				<th class="modTh"></th>
				<th class="modTh">Nom et Prénom</th>
				<th class="modTh">Nbr Absence</th>
				<th class="modTh">Ajouter Absence</th>
			</tr>

			<?php
				try {
					$resultat=$connexion->query("SELECT * FROM `employee` WHERE id_role='4'");
					while ($row=$resultat->fetch()) {
						$photo=$row['Photo'];
						$nom=$row['Nom'];
						$prenom=$row['Prenom'];
						$nbr_abs=$row['nbr_abs'];
			?>

			<tr class="modTr">
				<td class="modTd"><?php echo '<img class="cadre" src="data:image/jpeg;base64,'.base64_encode($photo).'"/>'; ?></td>
				<td class="modTd"><?php echo $nom;?> <?php echo $prenom;?></td>
				<td class="modTd"><?php echo $nbr_abs;?></td>

				<td>
					<form method="POST">
						<input type="hidden" name="nom_c" value="<?php  echo $row['Nom']; ?>">
						<input type="hidden" name="prenom_c" value="<?php  echo $row['Prenom']; ?>">
						<input type="hidden" name="id_m" value="<?php  echo $row['id']; ?>">
						<input type="hidden" name="Nbr_a" value="<?php  echo $row['nbr_abs']; ?>">
						<input class="ab" type="date" name="date_a" value="<?php echo date("Y-m-d");?>">
				</td>
				<td class="buttonSized">
						<button name="a_cond" class="modifier"><i class="las la-plus"></i></button>
					</form>
				</td>
				<td class="buttonSized">
					<form method="POST" action="absence_moniteur_cond.php">
						<input type="hidden" name="id_g" value="<?php echo $id; ?>">
						<input type="hidden" name="id_m" value="<?php  echo $row['id']; ?>">
						<input type="hidden" name="nbr_abs" value="<?php  echo $row['nbr_abs']; ?>">
						<button name="mcond" class="supprim"><i class="las la-history"></i></button>
					</form>
				</td>

				<?php
			        if (isset($_POST['a_cond'])) {
			        	$id_m=$_POST['id_m'];
			            $nom=$_POST['nom_c'];
			            $prenom=$_POST['prenom_c'];
			            $date_abs=$_POST['date_a'];
			            $nbr_abs=$_POST['Nbr_a'];

			            $resultat1=$connexion->query("SELECT * FROM `absence` WHERE Id_m='$id_m' AND Date_abs='$date_abs'");
						if ($resultat1->rowCount() != 0) {
							echo "<script>if(confirm(\"Erreur! Le moniteur de conduite ".$nom." ".$prenom." a déja absenter le ".$date_abs.".\")){document.location.href='gerant.php'};</script>";
						} else {
							$nbr_abs=$nbr_abs+1;

				            $requete="UPDATE `employee` SET Nbr_abs='$nbr_abs' WHERE id='$id_m'";
				            $connexion->query($requete);

				            $requete1="INSERT INTO `absence`(`Id_m` , `Date_abs` )
													VALUES  ('$id_m', '$date_abs');";
				            $connexion->query($requete1);

				            echo "<script>if(confirm(\"Le moniteur de conduite ".$nom." ".$prenom." a absenter le ".$date_abs.".\")){document.location.href='gerant.php'};</script>";
				            break;
						}			            
			    	}
					} // close while loop
				}catch (PDOException $e) {
					echo "Erreur ! " . $e->getMessage() . "<br/>";
				}
				?>
			</tr>
		</table>
	</div>
	<!------------------------------------------------------ FIN DIV ABSENCE3 ----------------------------------------------------------->


	<!------------------------------------------------------ DIV UPDATE CODE ------------------------------------------------------------>
	<div id="divUpdateCode" class="sub_liste">
		<h1>Affecter un moniteur pour un candidat</h1>
		<h3>Niveau : <span class="niveau">Code</span></h3>
		<table class="modTable">
			<tr class="modRow" >
				<th class="modTh"></th>
				<th class="modTh">Nom et Prénom</th>
				<th class="modTh">Moniteur actuel</th>
			</tr>

			<?php
				try {
					$resultat=$connexion->query("SELECT * FROM `candidat` WHERE Niveau='code'");
					while ($row=$resultat->fetch()) {
						$photo=$row['Photo'];
						$id_c=$row['id_c'];
						$nom_c=$row['Nom'];
						$prenom_c=$row['Prenom'];
						$Id_mo=$row['id_m'];

						$resultat1=$connexion->query("SELECT * FROM `employee` WHERE id='$Id_mo'");
						while ($row=$resultat1->fetch()) {
							$id_m=$row['id'];
							$nom_m=$row['Nom'];
							$prenom_m=$row['Prenom'];
							$nbr_c=$row['Nbr_c'];
						}
						if($Id_mo == NULL){
							$nom_m = NULL;
							$prenom_m = NULL;
						}
			?>

			<tr class="modTr">
				<td class="modTd"><?php echo '<img class="cadre" src="data:image/jpeg;base64,'.base64_encode($photo).'"/>'; ?></td>
				<td class="modTd"><?php echo $nom_c;?> <?php echo $prenom_c;?></td>
				<td class="modTd"><?php echo $nom_m;?> <?php echo $prenom_m;?></td>
				<td class="buttonSized">
					<form method="POST" action="update_m_code.php">
						<input type="hidden" name="id_g" value="<?php echo $id; ?>">
						<input type="hidden" name="id_c" value="<?php  echo $id_c; ?>">
						<input type="hidden" name="id_mo" value="<?php echo $Id_mo; ?>">
						<button name="update" class="modifier"><i class="las la-plus"></i></button>
					</form>
				</td>
				<td class="buttonSized">
					<form method="POST">
						<input type="hidden" name="id_mo" value="<?php  echo $id_m; ?>">
						<input type="hidden" name="nom_mo" value="<?php  echo $nom_m; ?>">
						<input type="hidden" name="prenom_mo" value="<?php  echo $prenom_m; ?>">
						<input type="hidden" name="id_c" value="<?php  echo $id_c; ?>">
						<input type="hidden" name="nbr_c" value="<?php  echo $nbr_c; ?>">
						<input type="hidden" name="vide" value="<?php echo $Id_mo; ?>">
						<button name="supprimer_code" class="supprim"><i class="las la-minus"></i></button>
					</form>
				</td>
				<?php
					if (isset($_POST['supprimer_code'])) {
						$id_mo=$_POST['id_mo'];
						$nom_mo=$_POST['nom_mo'];
						$prenom_mo=$_POST['prenom_mo'];
						$id_c=$_POST['id_c'];
						$nbr_c=$_POST['nbr_c'];
						$vide=$_POST['vide'];

						if ($vide == '0') {
							echo "<script>if(confirm(\"Erreur! Rien à détacher.\")){document.location.href='gerant.php'};</script>";
						} else {
							$nbr_c=$nbr_c-1;
							$requete="UPDATE `employee` SET Nbr_c='$nbr_c' WHERE id='$id_mo'";
				            $connexion->query($requete);
				            $requete1="UPDATE `candidat` SET id_m=NULL WHERE id_c='$id_c'";
				            $connexion->query($requete1);
				            echo "<script>if(confirm(\"Vous avez détacher le moniteur ".$nom_mo." ".$prenom_mo." avec succées.\")){document.location.href='gerant.php'};</script>";
				        }
					}
					} // close while loop
					}catch (PDOException $e) { 
						echo "Erreur ! " . $e->getMessage() . "<br/>";
					}
				?>
			</tr>
		</table>
	</div>
	<!----------------------------------------------------- FIN DIV UPDATE CODE --------------------------------------------------------->


	<!------------------------------------------------------- DIV UPDATE CRENO ---------------------------------------------------------->
	<div id="divUpdateCreno" class="sub_liste">
		<h1>Affecter un moniteur pour un candidat</h1>
		<h3>Niveau : <span class="niveau">Créneau</span></h3>
		<table class="modTable">
			<tr class="modRow" >
				<th class="modTh"></th>
				<th class="modTh">Nom et Prénom</th>
				<th class="modTh">Moniteur actuel</th>
			</tr>

			<?php
				try {
					$resultat=$connexion->query("SELECT * FROM `candidat` WHERE Niveau='creneau'");
					while ($row=$resultat->fetch()) {
						$photo=$row['Photo'];
						$id_c=$row['id_c'];
						$nom_c=$row['Nom'];
						$prenom_c=$row['Prenom'];
						$Id_mo=$row['id_m'];

						$resultat1=$connexion->query("SELECT * FROM `employee` WHERE id='$Id_mo'");
						while ($row=$resultat1->fetch()) {
							$id_m=$row['id'];
							$nom_m=$row['Nom'];
							$prenom_m=$row['Prenom'];
							$nbr_c=$row['Nbr_c'];
						}
						if($Id_mo == NULL){
							$nom_m = NULL;
							$prenom_m = NULL;
						}
			?>

			<tr class="modTr">
				<td class="modTd"><?php echo '<img class="cadre" src="data:image/jpeg;base64,'.base64_encode($photo).'"/>'; ?></td>
				<td class="modTd"><?php echo $nom_c;?> <?php echo $prenom_c;?></td>
				<td class="modTd"><?php echo $nom_m;?> <?php echo $prenom_m;?></td>
				<td class="buttonSized">
					<form method="POST" action="update_m_cond.php">
						<input type="hidden" name="id_g" value="<?php echo $id; ?>">
						<input type="hidden" name="id_c" value="<?php  echo $id_c; ?>">
						<input type="hidden" name="id_mo" value="<?php  echo $Id_mo; ?>">
						<button name="update" class="modifier"><i class="las la-plus"></i></button>
					</form>
				</td>
				<td class="buttonSized">
					<form method="POST">
						<input type="hidden" name="id_mo" value="<?php echo $id_m; ?>">
						<input type="hidden" name="nom_mo" value="<?php  echo $nom_m; ?>">
						<input type="hidden" name="prenom_mo" value="<?php  echo $prenom_m; ?>">
						<input type="hidden" name="id_c" value="<?php echo $id_c; ?>">
						<input type="hidden" name="nbr_c" value="<?php echo $nbr_c; ?>">
						<input type="hidden" name="vide" value="<?php echo $Id_mo; ?>">
						<button name="supprimer_creno" class="supprim"><i class="las la-minus"></i></button>
					</form>
				</td>
				<?php
					if (isset($_POST['supprimer_creno'])) {
						$id_mo=$_POST['id_mo'];
						$nom_mo=$_POST['nom_mo'];
						$prenom_mo=$_POST['prenom_mo'];
						$id_c=$_POST['id_c'];
						$nbr_c=$_POST['nbr_c'];
						$vide=$_POST['vide'];

						if ($vide == '0') {
							echo "<script>if(confirm(\"Erreur! Rien à détacher.\")){document.location.href='gerant.php'};</script>";
						} else {
							$nbr_c=$nbr_c-1;
							$requete="UPDATE `employee` SET Nbr_c='$nbr_c' WHERE id='$id_mo'";
				            $connexion->query($requete);
				            $requete1="UPDATE `candidat` SET id_m=NULL WHERE id_c='$id_c'";
				            $connexion->query($requete1);
				            echo "<script>if(confirm(\"Vous avez détacher le moniteur ".$nom_mo." ".$prenom_mo." avec succées.\")){document.location.href='gerant.php'};</script>";
			        	}
					}
					} // close while loop
					}catch (PDOException $e) { 
						echo "Erreur ! " . $e->getMessage() . "<br/>";
					}
				?>
			</tr>
		</table>
	</div>
	<!----------------------------------------------------- FIN DIV UPDATE CRENO -------------------------------------------------------->


	<!------------------------------------------------------ DIV UPDATE CIRCUIT --------------------------------------------------------->
	<div id="divUpdateCircuit" class="sub_liste">
		<h1>Affecter un moniteur pour un candidat</h1>
		<h3>Niveau : <span class="niveau">Circuit</span></h3>
		<table class="modTable">
			<tr class="modRow" >
				<th class="modTh"></th>
				<th class="modTh">Nom et Prénom</th>
				<th class="modTh">Moniteur actuel</th>
			</tr>

			<?php
				try {
					$resultat=$connexion->query("SELECT * FROM `candidat` WHERE Niveau='circuit'");
					while ($row=$resultat->fetch()) {
						$photo=$row['Photo'];
						$id_c=$row['id_c'];
						$nom_c=$row['Nom'];
						$prenom_c=$row['Prenom'];
						$Id_mo=$row['id_m'];

						$resultat1=$connexion->query("SELECT * FROM `employee` WHERE id='$Id_mo'");
						while ($row=$resultat1->fetch()) {
							$id_m=$row['id'];
							$nom_m=$row['Nom'];
							$prenom_m=$row['Prenom'];
							$nbr_c=$row['Nbr_c'];
						}
						if($Id_mo == '0'){
							$nom_m = NULL;
							$prenom_m = NULL;
						}
			?>

			<tr class="modTr">
				<td class="modTd"><?php echo '<img class="cadre" src="data:image/jpeg;base64,'.base64_encode($photo).'"/>'; ?></td>
				<td class="modTd"><?php echo $nom_c;?> <?php echo $prenom_c;?></td>
				<td class="modTd"><?php echo $nom_m;?> <?php echo $prenom_m;?></td>
				<td class="buttonSized">
					<form method="POST" action="update_m_cond.php">
						<input type="hidden" name="id_g" value="<?php echo $id; ?>">
						<input type="hidden" name="id_c" value="<?php  echo $id_c; ?>">
						<input type="hidden" name="id_mo" value="<?php  echo $Id_mo; ?>">
						<button name="update" class="modifier"><i class="las la-plus"></i></button>
					</form>
				</td>
				<td class="buttonSized">
					<form method="POST">
						<input type="hidden" name="id_mo" value="<?php echo $id_m; ?>">
						<input type="hidden" name="nom_mo" value="<?php  echo $nom_m; ?>">
						<input type="hidden" name="prenom_mo" value="<?php  echo $prenom_m; ?>">
						<input type="hidden" name="id_c" value="<?php echo $id_c; ?>">
						<input type="hidden" name="nbr_c" value="<?php echo $nbr_c; ?>">
						<input type="hidden" name="vide" value="<?php echo $Id_mo; ?>">
						<button name="supprimer_circuit" class="supprim"><i class="las la-minus"></i></button>
					</form>
				</td>
				<?php
					if (isset($_POST['supprimer_circuit'])) {
						$id_mo=$_POST['id_mo'];
						$nom_mo=$_POST['nom_mo'];
						$prenom_mo=$_POST['prenom_mo'];
						$id_c=$_POST['id_c'];
						$nbr_c=$_POST['nbr_c'];
						$vide=$_POST['vide'];

						if ($vide == '0') {
							echo "<script>if(confirm(\"Erreur! Rien à détacher.\")){document.location.href='gerant.php'};</script>";

						} else {
							$nbr_c=$nbr_c-1;
							$requete="UPDATE `employee` SET Nbr_c='$nbr_c' WHERE id='$id_mo'";
				            $connexion->query($requete);
				            $requete1="UPDATE `candidat` SET id_m=NULL WHERE id_c='$id_c'";
				            $connexion->query($requete1);
				            echo "<script>if(confirm(\"Vous avez détacher le moniteur ".$nom_mo." ".$prenom_mo." avec succées.\")){document.location.href='gerant.php'};</script>";
						}
					}
					} // close while loop
					}catch (PDOException $e) { 
						echo "Erreur ! " . $e->getMessage() . "<br/>";
					}
				?>
			</tr>
		</table>
	</div>
	<!---------------------------------------------------- FIN DIV UPDATE CIRCUIT ------------------------------------------------------->


	<!-------------------------------------------------------- DIV NOUVEAU -------------------------------------------------------------->
	<div id="divInscrit" class="sub_liste">
		<h1>Modifier, supprimer, ou promouvoir un candidat vers le niveau suivant</h1>
		<h3>Niveau : <span class="niveau">Inscrit</span></h3>
		<table class="modTable">
			<tr class="modRow" >
				<th class="modTh"></th>
				<th class="modTh">Nom et Prénom</th>
				<th class="modTh">Date De Naissance</th>
				<th class="modTh">Ville</th>
			</tr>

			<?php
				try {
					$resultat=$connexion->query("SELECT * FROM `candidat` WHERE niveau='inscrit'");
					while ($row=$resultat->fetch()) {
						$photo=$row['Photo'];
						$id_c=$row['id_c'];
						$nom_c=$row['Nom'];
						$prenom_c=$row['Prenom'];
						$naissance=$row['Naissance'];
						$ville=$row['Ville'];
						$payee=$row['payee'];

			?>

			<tr class="modTr">
				<td class="modTd"><?php echo '<img class="cadre" src="data:image/jpeg;base64,'.base64_encode($photo).'"/>'; ?></td>
				<td class="modTd"><?php echo $nom_c;?> <?php echo $prenom_c;?></td>
				<td class="modTd"><?php echo $naissance;?></td>
				<td class="modTd"><?php echo $ville;?></td>

				<!------------------------- Envoyer id de candidat pour augmenter --------------------------->
				<td class="buttonSized">
					<form method="POST">
						<input type="hidden" name="id_c" value=" <?php echo $id_c; ?>">
						<input type="hidden" name="nom_c" value="<?php echo $nom_c;?>">
						<input type="hidden" name="prenom_c" value="<?php echo $prenom_c;?>">
						<button name="augmenter_inscrit" class="info"><i class="las la-chevron-up"></i></button>
					</form>
				</td>
				<!------------------------------------------------------------------------------------------->

				<!-------------------------- Envoyer id de candidat pour modifier --------------------------->
				<td class="buttonSized">
					<form method="POST" action="modifier_c.php">
						<input type="hidden" name="id_g" value="<?php echo $id; ?>">
						<input type="hidden" name="id_c" value="<?php  echo $id_c; ?>">
						<button class="modifier" name="modifier_ca"><i class="las la-user-edit"></i></button>
					</form>
				</td>
				<!------------------------------------------------------------------------------------------->

				<!-------------------------- Envoyer id de candidat pour supprimer -------------------------->
				<td class="buttonSized">
					<form method="POST">
						<input type="hidden" name="nom_c" value="<?php echo $nom_c;?>">
						<input type="hidden" name="prenom_c" value="<?php echo $prenom_c;?>">
						<input type="hidden" name="id_c" value="<?php echo $id_c;?>">
						<button name="supprim_inscrit" class="supprim"><i class="las la-user-times"></i></button>
					</form>
				</td>

				<?php
				    try {
				    	if (isset($_POST['augmenter_inscrit'])) {
							$id=$_POST['id_c'];
							$nom=$_POST['nom_c'];
				            $prenom=$_POST['prenom_c'];
                             
                            $e=6000-$payee;
                            $f=7000-$payee;

							$requete="UPDATE `candidat` SET niveau='code', payee='$payee', restant='$e', tarif='6000' WHERE id_c='$id' and TypeV='auto'";
		            		$connexion->query($requete);
							$requete="UPDATE `candidat` SET niveau='code', payee='$payee', restant='$f', tarif='7000' WHERE id_c='$id' and TypeV='manuel'";
		            		$connexion->query($requete);

			            	echo "<script>if(confirm(\"Votre candidat ".$nom." ".$prenom." est augmenter vers le code avec succées.\")){document.location.href='gerant.php'};</script>";

						} else if (isset($_POST['supprim_inscrit'])) {
				            $id=$_POST['id_c'];
				            $nom=$_POST['nom_c'];
				            $prenom=$_POST['prenom_c'];
				            $requete="DELETE FROM candidat WHERE id_c='$id'";
				            $connexion->query($requete);
				            echo "<script>if(confirm(\"Votre candidat: ".$nom."  ".$prenom." est supprimer avec succées.\")){document.location.href='gerant.php'};</script>";
				        }
				    }catch (PDOException $e) {
				        echo "Erreur ! " . $e->getMessage() . "<br/>";
				    }
				?>
			</tr>
			<?php  
					} // close while loop
				}catch (PDOException $e) {
					echo "Erreur ! " . $e->getMessage() . "<br/>";
			}?>
		</table>
	</div>
	<!------------------------------------------------------ Fin DIV NOUVEAU ------------------------------------------------------------>


	<!--------------------------------------------------------- DIV CODE  --------------------------------------------------------------->
	<div id="divCode" class="sub_liste">
		<h1>Modifier, supprimer, ou promouvoir un candidat vers le niveau suivant</h1>
		<h3>Niveau : <span class="niveau">Code</span></h3>
		<table class="modTable">
			<tr class="modRow" >
				<th class="modTh"></th>
				<th class="modTh">Nom et Prénom</th>
				<th class="modTh">Resultat Examen</th>
				<th class="modTh">Payé</th>
			</tr>

			<?php
				try {
					$resultat=$connexion->query("SELECT * FROM `candidat` WHERE niveau='code'");
					while ($row=$resultat->fetch()) {
						$id_c=$row['id_c'];
						$id_m=$row['id_m'];
						$photo=$row['Photo'];
						$nom_c=$row['Nom'];
						$prenom_c=$row['Prenom'];
						$rst=$row['restant'];
						$payee=$row['payee'];

						if ($rst == 0) {
							$resu = "oui";
						}else{
							$resu = "non";
						}

						$resultat1=$connexion->query("SELECT * FROM `resultat` WHERE id_c='$id_c' AND nom_examen='code'");
						while ($row=$resultat1->fetch()) {
							$note=$row['note_examen'];
						}
						if ($resultat1->rowCount() == 0) {
							$note = "non examiné";
						}
			?>

			<tr class="modTr">
				<td class="modTd"><?php echo '<img class="cadre" src="data:image/jpeg;base64,'.base64_encode($photo).'"/>'; ?></td>
				<td class="modTd"><?php echo $nom_c;?> <?php echo $prenom_c;?></td>
				<td class="modTd"><?php echo $note;?></td>
				<td class="modTd"><?php echo $resu;?></td>

				<!------------------------- Envoyer id de candidat pour augmenter --------------------------->
				<td class="buttonSized">
					<form method="POST">
						<input type="hidden" name="id_c" value=" <?php echo $id_c; ?>">
						<input type="hidden" name="nom_c" value="<?php echo $nom_c;?>">
						<input type="hidden" name="prenom_c" value="<?php echo $prenom_c;?>">
						<input type="hidden" name="id_m" value="<?php echo $id_m;?>">
						<input type="hidden" name="rst" value="<?php echo $rst;?>">
						<input type="hidden" name="note" value="<?php echo $note;?>">
						<button name="augmenter_code" class="info"><i class="las la-chevron-up"></i></button>
					</form>
				</td>
				<!------------------------------------------------------------------------------------------->

				<!-------------------------- Envoyer id de candidat pour modifier --------------------------->
				<td class="buttonSized">
					<form method="POST" action="modifier.php">
						<input type="hidden" name="id_g" value="<?php echo $id; ?>">
						<input type="hidden" name="id_c" value="<?php  echo $id_c; ?>">
						<button class="modifier" name="modifier_c"><i class="las la-user-edit"></i></button>
					</form>
				</td> 
				<!------------------------------------------------------------------------------------------->

				<!-------------------------- Envoyer id de candidat pour supprimer -------------------------->
				<td class="buttonSized">
					<form method="POST">
						<input type="hidden" name="nom_c" value="<?php echo $nom_c;?>">
						<input type="hidden" name="prenom_c" value="<?php echo $prenom_c;?>">
						<input type="hidden" name="id_c" value="<?php echo $id_c;?>">
						<input type="hidden" name="id_m" value="<?php echo $id_m;?>">
						<button name="supprim_code" class="supprim"><i class="las la-user-times"></i></button>
					</form>
				</td>
				<!------------------------------------------------------------------------------------------->

				<?php
				    try {
				    	if (isset($_POST['augmenter_code'])) {
							$id=$_POST['id_c'];
							$nom=$_POST['nom_c'];
				            $prenom=$_POST['prenom_c'];
							$typev=$POST['typev'];
							$id_m=$_POST['id_m'];
							$resu=$_POST['rst'];
							$note=$_POST['note'];

							if ($resu != 0){
								echo "<script>if(confirm(\"Votre candidat ".$nom." ".$prenom." n'a pas compléter le paiement.\")){document.location.href='gerant.php'};</script>";

							} else if ($note != "réussi") {
								echo "<script>if(confirm(\"Votre candidat ".$nom." ".$prenom." n'a pas encore examiné.\")){document.location.href='gerant.php'};</script>";

							} else {
								$ka=$payee-7000;
								$ke=$payee-6000;
	                            $a=8000-$ka;//ila khalass aktar m 7000da drahmah n9sohom mli moraha
	                            $b=7000-$ke;

	                           	if ($ka=='0') {
									$requete="UPDATE `candidat` SET niveau='creneau', payee='0.00', restant='8000', tarif='8000', id_m=NULL WHERE id_c='$id' and TypeV='manuel'";
			            			$connexion->query($requete);
	                           	} else if ($ke=='0') {
	                             	$requete="UPDATE `candidat` SET niveau='creneau', payee='0.00', restant='7000', tarif='7000', id_m=NULL WHERE id_c='$id' and TypeV='auto'";
			            			$connexion->query($requete);
	                            } else if ($ka>'0') {
	                           		$requete="UPDATE `candidat` SET niveau='creneau', payee='$ka', restant='$a', tarif='8000', id_m=NULL WHERE id_c='$id' and TypeV='manuel'";
			            			$connexion->query($requete);
	                            } else if($ke>'0') {
									$requete="UPDATE `candidat` SET niveau='creneau', payee='$ke', restant='$b', tarif='7000', id_m=NULL WHERE id_c='$id' and TypeV='auto'";
			            			$connexion->query($requete);
	                         	}

	                         	//--- decrementer le nbr des candidats pour l'employe ---//
								$resultat2=$connexion->query("SELECT * FROM `employee` WHERE id='$id_m'");
								while ($row=$resultat2->fetch()) {
									$nbr_c=$row['Nbr_c'];
								}
								if ($nbr_c != '0') {
									$nbr_c=$nbr_c-1;
									$requete="UPDATE `employee` SET Nbr_c='$nbr_c' WHERE id='$id_m'";
						            $connexion->query($requete);
					        	}
					            //-------------------------------------------------------//

					            echo "<script>if(confirm(\"Votre candidat ".$nom." ".$prenom." est augmenter vers le créneau avec succées.\")){document.location.href='gerant.php'};</script>";
					            break;
							}

						} else if (isset($_POST['supprim_code'])) {
				            $id=$_POST['id_c'];
				            $id_m=$_POST['id_m'];
				            $nom=$_POST['nom_c'];
				            $prenom=$_POST['prenom_c'];
				            //--- decrementer le nbr des candidats pour l'employe ---//
							$resultat2=$connexion->query("SELECT * FROM `employee` WHERE id='$id_m'");
							while ($row=$resultat2->fetch()) {
								$nbr_c=$row['Nbr_c'];
							}
							if ($nbr_c != '0') {
								$nbr_c=$nbr_c-1;
								$requete="UPDATE `employee` SET Nbr_c='$nbr_c' WHERE id='$id_m'";
					            $connexion->query($requete);
				        	}
				            //-------------------------------------------------------//
			            	$requete="DELETE FROM candidat WHERE id_c='$id'";
				            $connexion->query($requete);  
				            echo "<script>if(confirm(\"votre candidat: ".$nom."  ".$prenom." est supprimer avec succées.\")){document.location.href='gerant.php'};</script>";
				            break;
				        }
				    }catch (PDOException $e) {
				        echo "Erreur ! " . $e->getMessage() . "<br/>";
				    }
				?>
			</tr>
			<?php  
					} // close while loop
				}catch (PDOException $e) {
					echo "Erreur ! " . $e->getMessage() . "<br/>";
			}?>
		</table>
	</div>
	<!--------------------------------------------------------- Fin DIV CODE ------------------------------------------------------------>


	<!---------------------------------------------------------- DIV CRENO -------------------------------------------------------------->
	<div id="divCreno" class="sub_liste">
		<h1>Modifier, supprimer, ou promouvoir un candidat vers le niveau suivant</h1>
		<h3>Niveau : <span class="niveau">Créneau</span></h3>
		<table class="modTable">
			<tr class="modRow" >
				<th class="modTh"></th>
				<th class="modTh">Nom et Prénom</th>
				<th class="modTh">Resultat Examen</th>
				<th class="modTh">Payé</th>
			</tr>

			<?php
				try {
					$resultat=$connexion->query("SELECT * FROM `candidat` WHERE niveau='creneau'");
					while ($row=$resultat->fetch()) {
						$id_c=$row['id_c'];
						$id_m=$row['id_m'];
						$photo=$row['Photo'];
						$nom_c=$row['Nom'];
						$prenom_c=$row['Prenom'];
						$rst=$row['restant'];
                        $payee=$row['payee'];
						if ($rst == 0) {
							$resu = "oui";
						}else{
							$resu = "non";
						}

						$resultat1=$connexion->query("SELECT * FROM `resultat` WHERE id_c='$id_c' AND nom_examen='creneau'");
						while ($row=$resultat1->fetch()) {
							$note=$row['note_examen'];
						}
						if ($resultat1->rowCount() == 0) {
							$note = "non examiné";
						}
			?>

			<tr class="modTr">
				<td class="modTd"><?php echo '<img class="cadre" src="data:image/jpeg;base64,'.base64_encode($photo).'"/>'; ?></td>
				<td class="modTd"><?php echo $nom_c;?> <?php echo $prenom_c;?></td>
				<td class="modTd"><?php echo $note;?></td>
				<td class="modTd"><?php echo $resu;?></td>

				<!------------------------- Envoyer id de candidat pour augmenter --------------------------->
				<td class="buttonSized">
					<form method="POST">
						<input type="hidden" name="id_c" value=" <?php echo $id_c; ?>">
						<input type="hidden" name="nom_c" value="<?php echo $nom_c;?>">
						<input type="hidden" name="prenom_c" value="<?php echo $prenom_c;?>">
						<input type="hidden" name="id_m" value=" <?php echo $id_m; ?>">
						<input type="hidden" name="rst" value="<?php echo $rst;?>">
						<input type="hidden" name="note" value="<?php echo $note;?>">
						<button name="augmenter_creno" class="info"><i class="las la-chevron-up"></i></button>
					</form>
				</td>
				<!------------------------------------------------------------------------------------------->

				<!-------------------------- Envoyer id de candidat pour modifier --------------------------->
				<td class="buttonSized">
					<form method="POST" action="modifier.php">
						<input type="hidden" name="id_g" value="<?php echo $id; ?>">
						<input type="hidden" name="id_c" value="<?php  echo $id_c; ?>">
						<button class="modifier" name="modifier_c"><i class="las la-user-edit"></i></button>
					</form>
				</td>
				<!------------------------------------------------------------------------------------------->

				<!-------------------------- Envoyer id de candidat pour supprimer -------------------------->
				<td class="buttonSized">
					<form method="POST">
						<input type="hidden" name="nom_c" value="<?php echo $nom_c;?>">
						<input type="hidden" name="prenom_c" value="<?php echo $prenom_c;?>">
						<input type="hidden" name="id_c" value="<?php echo $id_c;?>">
						<input type="hidden" name="id_m" value="<?php echo $id_m;?>">
						<button name="supprim_creno" class="supprim"><i class="las la-user-times"></i></button>
					</form>
				</td>
				<!------------------------------------------------------------------------------------------->

				<?php
				    try {
				    	if (isset($_POST['augmenter_creno'])) {
							$id=$_POST['id_c'];
							$nom=$_POST['nom_c'];
				            $prenom=$_POST['prenom_c'];
							$typev=$POST['typev'];
							$id_m=$_POST['id_m'];
							$resu=$_POST['rst'];
							$note=$_POST['note'];

							if ($resu != 0){
								echo "<script>if(confirm(\"Votre candidat ".$nom." ".$prenom." n'a pas compléter le paiement.\")){document.location.href='gerant.php'};</script>";

							} else if ($note != "réussi") {
								echo "<script>if(confirm(\"Votre candidat ".$nom." ".$prenom." n'a pas encore examiné.\")){document.location.href='gerant.php'};</script>";

							} else {
								$la=$payee-8000;
								$lz=$payee-7000;
	                            $c=8000-$la;//ila khalass aktar m 7000da drahmah n9sohom mli moraha
	                            $d=7000-$lz;
	                            if ($la=='0') {
	                           
								$requete="UPDATE `candidat` SET niveau='circuit', payee='0.00', restant='8000', tarif='8000', id_m=NULL WHERE id_c='$id' AND TypeV='manuel'";
			            		    $connexion->query($requete);
	                            }else if ($lz=='0') {
	                               	$requete="UPDATE `candidat` SET niveau='circuit', payee='0.00',restant='7000', tarif='7000', id_m=NULL WHERE id_c='$id' AND TypeV='auto'";
			            		    $connexion->query($requete);
	                            } else if ($la>'0') {
	                            	$requete="UPDATE `candidat` SET niveau='circuit', payee='$la', restant='$c', tarif='8000', id_m=NULL WHERE id_c='$id' AND TypeV='manuel'";
			            			$connexion->query($requete);
	                            }elseif ($lz>'0') {
	                            	$requete="UPDATE `candidat` SET niveau='circuit', payee='$lz', restant='$d', tarif='7000', id_m=NULL WHERE id_c='$id' AND TypeV='auto'";
			            			$connexion->query($requete);
	                            }

	                            //--- decrementer le nbr des candidats pour l'employe ---//
								$resultat2=$connexion->query("SELECT * FROM `employee` WHERE id='$id_m'");
								while ($row=$resultat2->fetch()) {
									$nbr_c=$row['Nbr_c'];
								}
								if ($nbr_c != '0') {
									$nbr_c=$nbr_c-1;
									$requete="UPDATE `employee` SET Nbr_c='$nbr_c' WHERE id='$id_m'";
						            $connexion->query($requete);
					        	}
					            //-------------------------------------------------------//

					            echo "<script>if(confirm(\"Votre candidat ".$nom." ".$prenom." est augmenter vers le circuit avec succées.\")){document.location.href='gerant.php'};</script>";
					            break;
				        	}

				        } else if (isset($_POST['supprim_creno'])) {
				            $id=$_POST['id_c'];
				            $id_m=$_POST['id_m'];
				            $nom=$_POST['nom_c'];
				            $prenom=$_POST['prenom_c'];
				            //--- decrementer le nbr des candidats pour l'employe ---//
							$resultat2=$connexion->query("SELECT * FROM `employee` WHERE id='$id_m'");
							while ($row=$resultat2->fetch()) {
								$nbr_c=$row['Nbr_c'];
							}
							if ($nbr_c != '0') {
								$nbr_c=$nbr_c-1;
								$requete="UPDATE `employee` SET Nbr_c='$nbr_c' WHERE id='$id_m'";
					            $connexion->query($requete);
				        	}
				            //-------------------------------------------------------//
			            	$requete="DELETE FROM candidat WHERE id_c='$id'";
				            $connexion->query($requete);  
				            echo "<script>if(confirm(\"votre candidat: ".$nom."  ".$prenom." est supprimer avec succées.\")){document.location.href='gerant.php'};</script>";
				            break;
				        }
				    }catch (PDOException $e) {
				        echo "Erreur ! " . $e->getMessage() . "<br/>";
				    }
				?>
			</tr>
			<?php  
					} // close while loop
				}catch (PDOException $e) {
					echo "Erreur ! " . $e->getMessage() . "<br/>";
			}?>
		</table>
	</div>
	<!-------------------------------------------------------- Fin DIV CRENO ------------------------------------------------------------>


	<!--------------------------------------------------------- DIV CIRCUIT ------------------------------------------------------------->
	<div id="divCircuit" class="sub_liste">
		<h1>Modifier, supprimer, ou promouvoir un candidat vers le niveau suivant</h1>
		<h3>Niveau : <span class="niveau">Circuit</span></h3>
		<table class="modTable">
			<tr class="modRow" >
				<th class="modTh"></th>
				<th class="modTh">Nom et Prénom</th>
				<th class="modTh">Resultat Examen</th>
				<th class="modTh">Payé</th>
			</tr>

			<?php
				try {
					$resultat=$connexion->query("SELECT * FROM `candidat` WHERE niveau='circuit'");
					while ($row=$resultat->fetch()) {
						$id_c=$row['id_c'];
						$id_m=$row['id_m'];
						$photo=$row['Photo'];
						$nom_c=$row['Nom'];
						$prenom_c=$row['Prenom'];
						$rst=$row['restant'];
                        $payee=$row['payee'];
						if ($rst == 0) {
							$resu = "oui";
						}else{
							$resu = "non";
						}

						$resultat1=$connexion->query("SELECT * FROM `resultat` WHERE id_c='$id_c' AND nom_examen='circuit'");
						while ($row=$resultat1->fetch()) {
							$note=$row['note_examen'];
						}
						if ($resultat1->rowCount() == 0) {
							$note = "non examiné";
						}
			?>

			<tr class="modTr">
				<td class="modTd"><?php echo '<img class="cadre" src="data:image/jpeg;base64,'.base64_encode($photo).'"/>'; ?></td>
				<td class="modTd"><?php echo $nom_c;?> <?php echo $prenom_c;?></td>
				<td class="modTd"><?php echo $note;?></td>
				<td class="modTd"><?php echo $resu;?></td>

				<!------------------------- Envoyer id de candidat pour augmenter --------------------------->
				<td class="buttonSized">
					<form method="POST">
						<input type="hidden" name="id_c" value=" <?php echo $id_c; ?>">
						<input type="hidden" name="nom_c" value="<?php echo $nom_c;?>">
						<input type="hidden" name="prenom_c" value="<?php echo $prenom_c;?>">
						<input type="hidden" name="id_m" value=" <?php echo $id_m; ?>">
						<input type="hidden" name="rst" value="<?php echo $rst;?>">
						<input type="hidden" name="note" value="<?php echo $note;?>">
						<button name="augmenter_circuit" class="info"><i class="las la-chevron-up"></i></button>
					</form>
				</td>
				<!------------------------------------------------------------------------------------------->

				<!-------------------------- Envoyer id de candidat pour modifier --------------------------->
				<td class="buttonSized">
					<form method="POST" action="modifier.php">
						<input type="hidden" name="id_g" value="<?php echo $id; ?>">
						<input type="hidden" name="id_c" value="<?php  echo $id_c; ?>">
						<button class="modifier" name="modifier_c"><i class="las la-user-edit"></i></button>
					</form>
				</td>
				<!------------------------------------------------------------------------------------------->

				<!-------------------------- Envoyer id de candidat pour supprimer -------------------------->
				<td class="buttonSized">
					<form method="POST">
						<input type="hidden" name="nom_c" value="<?php echo $nom_c;?>">
						<input type="hidden" name="prenom_c" value="<?php echo $prenom_c;?>">
						<input type="hidden" name="id_c" value="<?php echo $id_c;?>">
						<input type="hidden" name="id_m" value="<?php echo $id_m;?>">
						<button name="supprim_circuit" class="supprim"><i class="las la-user-times"></i></button>
					</form>
				</td>
				<!------------------------------------------------------------------------------------------->

				<?php
				    try {
				    	if (isset($_POST['augmenter_circuit'])) {
							$id=$_POST['id_c'];
							$nom=$_POST['nom_c'];
				            $prenom=$_POST['prenom_c'];
							$typev=$POST['typev'];
							$id_m=$_POST['id_m'];
							$resu=$_POST['rst'];
							$note=$_POST['note'];

							if ($resu != 0){
								echo "<script>if(confirm(\"Votre candidat ".$nom." ".$prenom." n'a pas compléter le paiement.\")){document.location.href='gerant.php'};</script>";

							} else if ($note != "réussi") {
								echo "<script>if(confirm(\"Votre candidat ".$nom." ".$prenom." n'a pas encore examiné.\")){document.location.href='gerant.php'};</script>";

							} else {
								$la=$payee-8000;
								$lz=$payee-7000;
	                            $c=8000-$la;//ila khalass aktar m 7000da drahmah n9sohom mli moraha
	                            $d=7000-$lz;
	                            if ($la=='0') {
	                           
								$requete="UPDATE `candidat` SET niveau='admis', payee='0.00', restant='0', tarif='0', id_m=NULL WHERE id_c='$id' AND TypeV='manuel'";
			            		     $connexion->query($requete);
	                            }else if ($lz=='0') {
	                               	$requete="UPDATE `candidat` SET niveau='admis', payee='0.00', restant='0', tarif='0', id_m=NULL WHERE id_c='$id' AND TypeV='auto'";
			            		    $connexion->query($requete);
	                            }
	                            else if ($la>'0') {
	                            	$requete="UPDATE `candidat` SET niveau='admis', payee='0', restant='0', tarif='0', id_m=NULL WHERE id_c='$id' AND TypeV='manuel'";
			            			$connexion->query($requete);
	                            }elseif ($lz>'0') {
	                            	$requete="UPDATE `candidat` SET niveau='admis', payee='0', restant='0', tarif='0', id_m=NULL WHERE id_c='$id' AND TypeV='auto'";
			            			$connexion->query($requete);
	                            }
									
	                            //--- decrementer le nbr des candidats pour l'employe ---//
								$resultat2=$connexion->query("SELECT * FROM `employee` WHERE id='$id_m'");
								while ($row=$resultat2->fetch()) {
									$nbr_c=$row['Nbr_c'];
								}
								if ($nbr_c != '0') {
									$nbr_c=$nbr_c-1;
									$requete="UPDATE `employee` SET Nbr_c='$nbr_c' WHERE id='$id_m'";
						            $connexion->query($requete);
					        	}
					            //-------------------------------------------------------//
					            echo "<script>if(confirm(\"Votre candidat ".$nom." ".$prenom." est augmenter vers le circuit avec succées.\")){document.location.href='gerant.php'};</script>";
					            break;
					        }

				        } else if (isset($_POST['supprim_circuit'])) {
				            $id=$_POST['id_c'];
				            $id_m=$_POST['id_m'];
				            $nom=$_POST['nom_c'];
				            $prenom=$_POST['prenom_c'];
				            //--- decrementer le nbr des candidats pour l'employe ---//
							$resultat2=$connexion->query("SELECT * FROM `employee` WHERE id='$id_m'");
							while ($row=$resultat2->fetch()) {
								$nbr_c=$row['Nbr_c'];
							}
							if ($nbr_c != '0') {
								$nbr_c=$nbr_c-1;
								$requete="UPDATE `employee` SET Nbr_c='$nbr_c' WHERE id='$id_m'";
					            $connexion->query($requete);
				        	}
				            //-------------------------------------------------------//
			            	$requete="DELETE FROM candidat WHERE id_c='$id'";
				            $connexion->query($requete);  
				            echo "<script>if(confirm(\"votre candidat: ".$nom."  ".$prenom." est supprimer avec succées.\")){document.location.href='gerant.php'};</script>";
				            break;
				        }
				    }catch (PDOException $e) {
				        echo "Erreur ! " . $e->getMessage() . "<br/>";
				    }
				?>
			</tr>
			<?php  
					} // close while loop
				}catch (PDOException $e) {
					echo "Erreur ! " . $e->getMessage() . "<br/>";
			}?>
		</table>
	</div>
	<!------------------------------------------------------- FIN DIV CIRCUIT ----------------------------------------------------------->


	<!---------------------------------------------------------- DIV ADMIS -------------------------------------------------------------->
	<div id="divAdmis" class="sub_liste">
		<h1>Candidats hors cycle (Formation achevé)</h1>
		<table class="modTable">
			<tr class="modRow" >
				<th class="modTh"></th>
				<th class="modTh">Nom et Prénom</th>
				<th class="modTh">Date De Naissance</th>
				<th class="modTh">Ville</th>
			</tr>

			<?php
				try {
					$resultat=$connexion->query("SELECT * FROM `candidat` WHERE niveau='admis'");
					while ($row=$resultat->fetch()) {
						$id_c=$row['id_c'];
						$id_m=$row['id_m'];
						$naissance=$row['Naissance'];
						$ville=$row['Ville'];
						$photo=$row['Photo'];
						$nom_c=$row['Nom'];
						$prenom_c=$row['Prenom'];
			?>

			<tr class="modTr">
				<td class="modTd"><?php echo '<img class="cadre" src="data:image/jpeg;base64,'.base64_encode($photo).'"/>'; ?></td>
				<td class="modTd"><?php echo $nom_c;?> <?php echo $prenom_c;?></td>
				<td class="modTd"><?php echo $naissance;?></td>
				<td class="modTd"><?php echo $ville;?></td>

				<!-------------------------- Envoyer id de candidat pour modifier --------------------------->
				<td class="buttonSized">
					<form method="POST" action="modifier.php">
						<input type="hidden" name="id_g" value="<?php echo $id; ?>">
						<input type="hidden" name="id_c" value="<?php  echo $id_c; ?>">
						<button class="modifier" name="modifier_c"><i class="las la-user-edit"></i></button>
					</form>
				</td> 
				<!------------------------------------------------------------------------------------------->

				<!-------------------------- Envoyer id de candidat pour supprimer -------------------------->
				<td class="buttonSized">
					<form method="POST">
						<input type="hidden" name="nom_c" value="<?php echo $nom_c;?>">
						<input type="hidden" name="prenom_c" value="<?php echo $prenom_c;?>">
						<input type="hidden" name="id_c" value="<?php echo $id_c;?>">
						<input type="hidden" name="id_m" value="<?php echo $id_m;?>">
						<button name="supprim_admis" class="supprim"><i class="las la-user-times"></i></button>
					</form>
				</td>

				<?php
                    if (isset($_POST['supprim_admis'])) {
			            $id=$_POST['id_c'];
			            $id_m=$_POST['id_m'];
			            $nom=$_POST['nom_c'];
			            $prenom=$_POST['prenom_c'];

		            	$requete="DELETE FROM candidat WHERE id_c='$id'";
			            $connexion->query($requete);  
			            echo "<script>if(confirm(\"votre candidat: ".$nom."  ".$prenom." est supprimer avec succées.\")){document.location.href='gerant.php'};</script>";
			            break;
			        }
				} // close while loop
                }catch (PDOException $e) { 
					echo "Erreur ! " . $e->getMessage() . "<br/>";
				}
				?>
		</table>
	</div>
	<!-------------------------------------------------------- FIN DIV ADMIS ------------------------------------------------------------>


	<!---------------------------------------------------------- DIV Text --------------------------------------------------------------->
	<div id="divText" class="sub_liste">
		<h1>Contacter le superviseur</h1>
		<table class="modTable">
			<tr class="modRow" >
				<th class="modTh"></th>
				<th class="modTh">Nom et Prénom</th>
				<th class="modTh">E-mail</th>
				<th class="modTh">Téléphone</th>
			</tr>

			<?php
				try {
					$resultat=$connexion->query("SELECT * FROM `employee` WHERE id_role='1'");
					while ($row=$resultat->fetch()) {
						$photo=$row['Photo'];
						$nom=$row['Nom'];
						$prenom=$row['Prenom'];
						$email=$row['Email'];
						$telephone=$row['Telephone'];
			?>

			<tr class="modTr">
				<td class="modTd"><?php echo '<img class="cadre" src="data:image/jpeg;base64,'.base64_encode($photo).'"/>'; ?></td>
				<td class="modTd"><?php echo $nom;?> <?php echo $prenom;?></td>
				<td class="modTd"><?php echo $email;?></td>
				<td class="modTd"><?php echo $telephone;?></td>
				<?php
					} // close while loop
					}catch (PDOException $e) {
						echo "Erreur ! " . $e->getMessage() . "<br/>";
					}
				?>
			</tr>
		</table>
	</div>
	<!-------------------------------------------------------- FIN DIV TEXT ------------------------------------------------------------->


	<!--------------------------------------------------------- DIV TEXT2 --------------------------------------------------------------->
	<div id="divText2" class="sub_liste">
		<h1>Contacter les moniteurs de code</h1>
		<table class="modTable">
			<tr class="modRow" >
				<th class="modTh"></th>
				<th class="modTh">Nom et Prénom</th>
				<th class="modTh">E-mail</th>
				<th class="modTh">Téléphone</th>
			</tr>

			<?php
				try {
					$resultat=$connexion->query("SELECT * FROM `employee` WHERE id_role='3'");
					while ($row=$resultat->fetch()) {
						$photo=$row['Photo'];
						$nom=$row['Nom'];
						$prenom=$row['Prenom'];
						$email=$row['Email'];
						$telephone=$row['Telephone'];
			?>

			<tr class="modTr">
				<td class="modTd"><?php echo '<img class="cadre" src="data:image/jpeg;base64,'.base64_encode($photo).'"/>'; ?></td>
				<td class="modTd"><?php echo $nom;?> <?php echo $prenom;?></td>
				<td class="modTd"><?php echo $email;?></td>
				<td class="modTd"><?php echo $telephone;?></td>
				<?php
					} // close while loop
					}catch (PDOException $e) {
						echo "Erreur ! " . $e->getMessage() . "<br/>";
					}
				?>
			</tr>
		</table>
	</div>
	<!------------------------------------------------------- FIN DIV TEXT2 ------------------------------------------------------------->


	<!--------------------------------------------------------- DIV TEXT3 --------------------------------------------------------------->
	<div id="divText3" class="sub_liste">
		<h1>Contacter les moniteurs de conduite</h1>
		<table class="modTable">
			<tr class="modRow" >
				<th class="modTh"></th>
				<th class="modTh">Nom et Prénom</th>
				<th class="modTh">E-mail</th>
				<th class="modTh">Téléphone</th>
			</tr>

			<?php
				try {
					$resultat=$connexion->query("SELECT * FROM `employee` WHERE id_role='4'");
					while ($row=$resultat->fetch()) {
						$photo=$row['Photo'];
						$nom=$row['Nom'];
						$prenom=$row['Prenom'];
						$email=$row['Email'];
						$telephone=$row['Telephone'];
			?>

			<tr class="modTr">
				<td class="modTd"><?php echo '<img class="cadre" src="data:image/jpeg;base64,'.base64_encode($photo).'"/>'; ?></td>
				<td class="modTd"><?php echo $nom;?> <?php echo $prenom;?></td>
				<td class="modTd"><?php echo $email;?></td>
				<td class="modTd"><?php echo $telephone;?></td>
				<?php
					} // close while loop
					}catch (PDOException $e) {
						echo "Erreur ! " . $e->getMessage() . "<br/>";
					}
				?>
			</tr>
		</table>

	</div>
	<!------------------------------------------------------- FIN DIV TEXT3 ------------------------------------------------------------->


	<!--------------------------------------------------------- DIV TEXT4 --------------------------------------------------------------->
	<style type="text/css">
		.listeCandidatC {
			margin-bottom: 200px !important;
		}
	</style>
	<div id="divText4" class="sub_liste listeCandidatC">
		<h1>Contacter les candidats</h1>
		<table class="modTable">
			<tr class="modRow" >
				<th class="modTh"></th>
				<th class="modTh">Nom et Prénom</th>
				<th class="modTh">E-mail</th>
				<th class="modTh">Téléphone</th>
			</tr>

			<?php
				try {
					$resultat=$connexion->query("SELECT * FROM `candidat`");
					while ($row=$resultat->fetch()) {
						$photo=$row['Photo'];
						$nom=$row['Nom'];
						$prenom=$row['Prenom'];
						$email=$row['Email'];
						$telephone=$row['Telephone'];
			?>

			<tr class="modTr">
				<td class="modTd"><?php echo '<img class="cadre" src="data:image/jpeg;base64,'.base64_encode($photo).'"/>'; ?></td>
				<td class="modTd"><?php echo $nom;?> <?php echo $prenom;?></td>
				<td class="modTd"><?php echo $email;?></td>
				<td class="modTd"><?php echo $telephone;?></td>
				<?php
					} // close while loop
					}catch (PDOException $e) {
						echo "Erreur ! " . $e->getMessage() . "<br/>";
					}
				?>
			</tr>
		</table>

	</div>
	<!------------------------------------------------------- FIN DIV TEXT4 ------------------------------------------------------------->


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