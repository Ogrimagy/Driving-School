<!------------------------------------------------------------------ PHP ---------------------------------------------------------------->
<?php
	session_start();
	include 'pdo.php';
	include("../db_connexion.php");
	
	$dbhost = DB_SERVER; // set the hostname
    $dbname = DB_DATABASE ; // set the database name
    $dbuser = DB_USERNAME ; // set the mysql username
    $dbpass = DB_PASSWORD;  // set the mysql password
    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	try{
		require_once('../db_connexion.php');
		if(!isset($_SESSION['id_c'])) {
			header("Location:../page_connexion.html");

		}else{
			$id=$_SESSION['id_c'];
			$requete="SELECT * FROM `candidat` WHERE id_c='$id'";
			$resultat=$connexion->query($requete);

			while($row=$resultat->fetch()) {
				$id=$row['id_c'];
				$nom=$row['Nom'];
				$prenom=$row['Prenom'];
				$id_m=$row['id_m'];
				$niv=$row['niveau'];
				$photo=$row['Photo'];
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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
	<script src="ressource/js/menu.js"></script>
	<script src="ressource/js/notification.js"></script>
	<script src="ressource/js/menu-left.js"></script>
	<script src="../ressource/js/jquery.js"></script><!-- verification des donnes -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script><!-- Modifier l'image de profile-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script><!-- Modifier l'image de profile-->
    <script type="text/javascript">
    	function verifier_nom(){
	var nom = document.getElementById("nom").value;
	var pattern = /^[a-zA-Z]{3,30}$/;
 
	if(nom == ""){
       	document.getElementById("err_nom").textContent = "Le nom doit être renseigné";
        document.getElementById("nom").className = "erreurChamp";

    }else if(!pattern.test(nom)){
		document.getElementById("err_nom").textContent = "Le nom contient au moins 3 caractères alphabétiques";
        document.getElementById("nom").className = "erreurChamp";

	}else{
		document.getElementById("err_nom").textContent = "";
        document.getElementById("nom").className = "correcte";
        setTimeout('document.getElementById("nom").className = ""', 800);
	}
}

function verifier_prenom(){
	var prenom = document.getElementById("prenom").value;
	var pattern = /^[a-zA-Z]{3,30}$/;

	if(prenom == ""){
        document.getElementById("err_prenom").textContent = "Le prénom doit être renseigné";
        document.getElementById("prenom").className = "erreurChamp";

	}else if(!pattern.test(prenom)){
		document.getElementById("err_prenom").textContent = "Le prénom contient au moins 3 caractères alphabétiques";
        document.getElementById("prenom").className = "erreurChamp";

	}else{
		document.getElementById("err_prenom").textContent = "";
        document.getElementById("prenom").className = "correcte";
        setTimeout('document.getElementById("prenom").className = ""', 800);
	}
}

function verifier_dates(){
	var date_naissance = document.getElementById("naissance").value;
	var currentDate = new Date();

	if(date_naissance == ""){
		document.getElementById("err_naiss").textContent = "La date naissance doit être spécifiée";
        document.getElementById("naissance").className = "erreurChamp";

	}else{
		date_naissance = date_naissance.split("-")[0];// year
		currentDate = currentDate.getFullYear();
		var difference = currentDate - date_naissance;
		age = currentDate - date_naissance;
		if(difference < 18){
			document.getElementById("err_naiss").textContent = "Vous n'avez pas l'age autorisé (18 ans)";
            document.getElementById("naissance").className = "erreurChamp";
		}else{
			document.getElementById("err_naiss").textContent = "";
            document.getElementById("naissance").className = "correcte";
            setTimeout('document.getElementById("naissance").className = ""', 800);
		}
	}
}

function verifier_ville(){
	var ville = document.getElementById("ville").value;
	var pattern = /^[a-zA-Z]{4,30}$/;

	if(ville == ""){
		document.getElementById("err_ville").textContent = "Le nom de la ville doit être renseigné";
        document.getElementById("ville").className = "erreurChamp";

	}else if (!pattern.test(ville)){
		document.getElementById("err_ville").textContent = "Le nom de la ville contient au moins 4 caractères alphabétiques";
        document.getElementById("ville").className = "erreurChamp";

	}else{
		document.getElementById("err_ville").textContent = "";
        document.getElementById("ville").className = "correcte";
        setTimeout('document.getElementById("ville").className = ""', 800);
	}
}

function verifier_mail(){
	var pattern = /^[a-zA-Z0-9._]+@[a-zA-Z]+\.[a-zA-Z]{2,3}$/;
	var mail = document.getElementById("ad_email").value;

	if(mail == ""){
		document.getElementById("err_mail").textContent = "L'adresse e-mail doit être renseignée";
        document.getElementById("ad_email").className = "erreurChamp";

	}else if(!pattern.test(mail)){
		document.getElementById("err_mail").textContent = "L'email accepte les caractères alpha-numériques, les points et les '_'(expl: ab_D.1@doM1n.xYz)";
        document.getElementById("ad_email").className = "erreurChamp";
		
	}else{
		document.getElementById("err_mail").textContent = "";
        document.getElementById("ad_email").className = "correcte";
        setTimeout('document.getElementById("ad_email").className = ""', 800);
	}
}

function verifier_tel(){
	var tel = document.getElementById("phone").value;
	var pattern = /[0][5-7][0-9]{8}$/;

	if(tel == ""){
		document.getElementById("err_phone").textContent = "Le numéro de téléphone doit être renseigné";
        document.getElementById("phone").className = "erreurChamp";

	}else if(!pattern.test(tel)){
		document.getElementById("err_phone").textContent = "05/06/07 + 8 chiffres";
        document.getElementById("phone").className = "erreurChamp";

	}else{
		document.getElementById("err_phone").textContent = "";
        document.getElementById("phone").className = "correcte";
        setTimeout('document.getElementById("phone").className = ""', 800);
	}

}

function verifier_pw(){
	var pattern = /^[a-zA-Z0-9_]{4,}$/;
	var mdp = document.getElementById("mot_passe").value;
	var mdpC = document.getElementById("confirm_pw").value;

    if(mdp != ""){
		if(!pattern.test(mdp)){
			document.getElementById("err_pw").textContent = "Le mot de passe contient au moins 4 caractères alpha-numériques('_' est autorisé)";
            document.getElementById("mot_passe").className = "erreurChamp";

		}else {

			document.getElementById("err_pw").textContent = "";
            document.getElementById("mot_passe").className = "";
		}
	}else {
		document.getElementById("err_pw").textContent = "Le mot de passe doit être renseigné";
	}
}
    </script>
</head>
<?php
		$divSelect = isset($_GET["open"]) ? $_GET["open"] : "";
		$notifVu = isset($_GET["vu"]) ? $_GET["vu"] : "";
		if ($divSelect != ""){
			?>
				<script>
    				var myServerData = <?=json_encode($divSelect)?>;
				</script>
			<?php
		}
		else{
			?>
			<script>
				var myServerData = "divCalendrier";
			</script>
		<?php
		}
		if ($notifVu != "") {
            $vuData = "notificationVu(" . $notifVu . ")";
        }
        else {
            $vuData = "";
        }

		?>
<body onload="removeLoader();openPanel(myServerData); <?php echo $vuData;?> ;">
	
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
				<?php echo " <span class='nivT'><span class='niveau'>|</span> Niveau: <span class='niveau'>" . $niv; echo "</span></span>"; ?>
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
			<a href="#" onclick="openPanel('divProfile')">Profil</a>
			<?php
				$resultat=$connexion->query("SELECT * FROM notification WHERE status='0' AND id_candidat='$id'");
				
				if ($resultat->rowCount()>0) {
			?>
					<a href="#" onclick="openPanel('divNotification');notificationVu(<?php echo $id?>)"><i class="fa fa-bell"><span id="nbNotif"><?php echo $resultat->rowCount(); ?></span></i></a>
		   <?php
				} else {
			?>
					<a href="#" onclick="openPanel('divNotification')"><i class="fa fa-bell"><span id="nbNotif"></span></i></a>
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
		<a onclick="openPanel('divCalendrier')"><i class="las la-calendar"></i> Calendrier</a>
		<div onmouseover="afficherListeCour()" onmouseout="cacherListeCour()">
			<a><i class="las la-file-alt"></i> Cours de Code</a>
			<div id="cours" class="ids">
				<a class="smallTitle" onclick="openPanel('divSignal')"><i class="las la-sms"></i> Les signalisations</a>
				<a class="smallTitle" onclick="openPanel('divPanneau')"><i class="las la-sms"></i> Les panneaux et les panonceaux</a>
				<a class="smallTitle" onclick="openPanel('divIntersection')"><i class="las la-sms"></i> Les intersections</a>
				<a class="smallTitle" onclick="openPanel('divFeux')"><i class="las la-sms"></i> Feux et tournants</a>
				<a class="smallTitle" onclick="openPanel('divCroisement')"><i class="las la-sms"></i> Les croisements</a>
				<a class="smallTitle" onclick="openPanel('divDepassement')"><i class="las la-sms"></i> Les Dépassements</a>
				<a class="smallTitle" onclick="openPanel('divArret')"><i class="las la-sms"></i> L'arrêt et le stationnement</a>
				<a class="smallTitle" onclick="openPanel('divVitesse')"><i class="las la-sms"></i> Réglementation de vitesse & choix des voies</a>
			</div>
		</div>
		<a onclick="afficherTest()"><i class="las la-file"></i> Passer un test</a>
		<a onclick="openPanel('divResultat')"><i class="las la-clipboard"></i> Resultat</a>
		<div onmouseover="afficherListeText()" onmouseout="cacherListeText()">
			<a><i class="las la-comment"></i> Contact</a>
			<div id="text" class="ids">
				<a onclick="openPanel('divChoix')"><i class="las la-sms"></i> Gérant</a>
				<a onclick="openPanel('divRecu')"><i class="las la-sms"></i> Moniteur</a>
			</div>
		</div>		
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
							$query = "UPDATE candidat SET Photo ='$file' where id_c='$id'";  
							if(mysqli_query($connect, $query)) {
								echo "<script>if(confirm(\" Votre photo de profil est modifier avec succées.\")){document.location.href='candidat.php'};</script>";
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

							echo "<script>if(confirm(\" Profil modifier avec succées.\")){document.location.href='candidat.php'};</script>";
						}

					} catch (PDOException $e) {
						echo "Erreur ! " . $e->getMessage() . "<br/>";
					}
				?>
			</table>
		</form>
	</div>
	<!------------------------------------------------------- DIV FIN PROFILE ----------------------------------------------------------->


	<!--------------------------------------------------------- DIV CALENDRIER ---------------------------------------------------------->
	<div id="divCalendrier" class="contain">
		<div class="liste">
			<h1>Mon Calendrier</h1>
			<?php 
						include 'header.php';
						include 'month.php';
						include 'events.php';
					?>
					<?php
						$pdo = get_pdo();
						$events = new Events($pdo);
						$month = new Month($_GET['month'] ?? null, $_GET['year'] ?? null);// créer un mois avec les params passées dans l'URL. s'il n y a pas de params, le mois sera le mois actuel
						$start = $month->getFirstDay();
						$start = $start->format('N') === '0'?$start:$month->getFirstDay()->modify('last sunday');// récupérer le 1er jour
						$weeks = $month->getWeeks();
						$end = $start->modify('+' . (6 + 7 * ($weeks -1)) . 'days');// date de fin d'évenement
						$events = $events->getEventsBetweenByDay($start, $end, $id);
					?>
					<div id="header" class="d-flex flex-row align-items-center justify-content-between">
						<h1 class="monthHeader"><?php echo $month->toString(); ?></h1>
						<div id="prevnxt">
							<a href="candidat.php?month=<?php echo $month->previousMonth()->month; ?>&year=<?php echo $month->previousMonth()->year;?>" class="btn btn-primary">&lt</a>
							<a href="candidat.php?month=<?php echo $month->nextMonth()->month; ?>&year=<?php echo $month->nextMonth()->year;?>" class="btn btn-primary">&gt</a>
						</div>
					</div>
					
					<table class="calendar_table calendar_table-<?php echo $weeks; ?>weeks" width="100%" height="100%">
						<?php for($i = 0; $i < $weeks; $i++){// $i varie entre 0 et le nombre de semaine - 1 et il représente le nbr de semaines?>
							<tr>
								<?php foreach($month->days as $k => $day){//$k travaille comme un compteur qui varie entre 0 et 6 
									$date = $start->modify("+" . ($k + $i * 7) . " days");
									$eventsForDay = $events[$date->format('Y-m-d')] ?? [];// prendre les évènements du jour
									$isToday = date('Y-m-d') === $date->format('Y-m-d');
								?>
								<td class="<?php echo $month->withinMonth($date)?'':'calendar_othermonth'; ?> <?php echo $isToday?'is-today':''; ?>">
									<?php if($i === 0){// afficher le nom du jour pour la première ligne(semaine) uniquement ?>
										<span class="calendar_weekday"><?php echo $day; ?></span>
										<br>
									<?php } ?>
									<span class="calendar_day"><a href="add.php?date=<?php echo $date->format('Y-m-d'); ?>"><?php echo $date->format('d');//créer une copie du jour et la mettre à jour pour qu'elle s'adapte au jour correspondant ?></a></span>
									<?php foreach($eventsForDay as $event){ ?>
									<br>
									<span class="calendar_event">
										<?php echo $event->getDebut()->format('H:i'); ?> - <a href="edit.php?evi=<?php echo isset($_SESSION['id_c'])?$_SESSION['event_id'][$event->getId()]:'';?>" class="event_link"><?php echo ucfirst(h($event->getNom())); ?></a>
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
					<a href="add.php" class="calendar_btn">+</a>
					<?php $pdo = null; ?>
		</div>
	</div>
	<!------------------------------------------------------- FIN DIV CALENDRIER -------------------------------------------------------->


	<!---------------------------------------------------------- DIV SIGNAL --------------------------------------------------------------->
	<div id="divSignal" class="contain">
		<div class="liste listeCour">
			<h1>Les signalisations</h1>
			<hr>
					<p>Le Code de la route prévoit un grand nombre d’outils de signalisation pour aider le conducteur dans ses déplacements. Tous ces signes sont aussi appelés <b><i>"indices formels"</i></b> et donnent aux conducteurs des informations claires et précises.</p>
					<hr>
					<h1 class="titles collapsible">La signalisation verticale</h1>
					<p>La signalisation verticale est l'ensemble des signes dressés en hauteur le long de la route : <b><i>panneaux</i></b>, <b><i>panonceaux</i></b>, <b><i>balises</i></b> et <b><i>bornes</i></b>.</p>
					<p class="titles">Les panneaux: la forme, la couleur et les symboles</p>
					<p>Pour comprendre le sens des panneaux, il faut d'abord remarquer leurs formes :</p>
					<ul>
						<li><p>Triangulaire = danger</p></li>
						<li><p>Rond = Ordre : Interdiction ou Obligation</p></li>
						<li><p>Carré = Indication</p></li>
						<li><p>Rectangulaire = Localisation</p></li>
						<li><p>Flèche = Direction</p></li>
					</ul>
					<p>La couleur joue aussi un rôle fondamental dans la lecture des panneaux.</p>
					<p>Ces 2 tableaux récapitulatifs vous montrent comment s'articulent les formes et les couleurs des panneaux :</p>
					<img src="ressource/img/signalisation_verticale_panneaux.png" alt="les formes et les couleurs des panneaux">
					<img src="ressource/img/signalisation_verticale_panneaux_2.png" alt="les formes et les couleurs des panneaux">
					<p>Enfin, des symboles au centre des panneaux précisent leur sens.</p>
					<img src="ressource/img/danger_cavalier.png">
					<p>Pour plus de détails sur les panneaux, veuillez consulter la section <b><i>"les panneaux et les panonceaux"</i></b>.</p>
					<p class="titles">Les balises et bornes :</p>
					<p>Les balises permettent au conducteur de se guider et d'être averti des différents dangers pouvant survenir sur la route.</p>
					<p>N.B: <strong>1</strong>-Les balises de guidage de couleur verte font partie des éléments de signalisation permanents. De manière générale, elles sont implantées par les gestionnaires de voirie pour signaler la présence de voies divergentes aux usagers. <strong>2</strong>-Les délinéateurs sont des dispositifs particuliers de balisage continu, qui interviennent en complément des marques sur chaussées, pour permettre un guidage latéral tout au long d’un itinéraire suivi. Cela permet d’assurer la meilleure lisibilité possible de la route.</p>
					<p>Voici un croquis récapitulant les différentes balises :</p>
					<img src="ressource/img/balises.png" alt="les balises">
					<p>Voilà également un récapitulatif des différentes catégories de routes sur lesquelles vous pouvez rouler :</p>
					<img src="ressource/img/cat_route.png" alt="categories de routes">
					<p>La lettre en majuscule indique la première lettre de la catégorie de routes : N pour Nationale ou C pour Communales par exemple. Et le numéro vous sert à identifier la route sur une carte routière.</p>
					<p>Ces lettres et numéros sont souvent rappelés au bord des routes sur des bornes ou des petits panneaux, qui indiquent sur quelle catégorie de routes vous circulez :</p>
					<img src="ressource/img/bornes.png" alt="les bornes">
					<hr>
					<h1 class="titles collapsible">La signalisation horizontale</h1>
					<p>La signalisation horizontale est l'ensemble des indications peintes et dessinées au sol. Elle comprend <b><i>les lignes</i></b>, <b><i>les flèches</i></b>, <b><i>les indications de voies spécialisées</i></b> et <b><i>quelques marquages spécifiques</i></b>.<br><br>Tous ces marquages au sol permettent d'identifier les différentes parties de la route et de savoir où vous devez rouler et où vous ne devez pas rouler.</p>
					<h4 class="titles">Les lignes :</h4>
					<p>Commençons par les lignes situées au milieu de la chaussée. Ces lignes vous indiquent votre position sur la chaussée. Selon le type de lignes, le dépassement et le changement de direction sont autorisés ou interdits.</p>
					<img src="ressource/img/lignes_1.png" alt="les lignes">
					<p class="titles">La ligne continue :</p>
					<p>Il est strictement interdit de la franchir. Tout chevauchement est également formellement interdit.<br><br>Franchir signifie que la totalité de la voiture est de l'autre côté de la ligne.<br>Le chevauchement désigne le fait que seulement une partie de la voiture est de l'autre côté de la ligne.</p>
					<p class="titles">La ligne de dissuasion :</p>
					<p>Les lignes de dissuasion, quant à elles, ont deux rôles selon le type de route où on les retrouve :</p>
					<ol>
						<li><p>1) Située sur des routes sinueuses, en pentes, ou empruntées par des véhicules lents, elle signifie qu'il est dangereux d'opérer un dépassement des véhicules qui roulent normalement. Le dépassement des véhicules lents est cependant autorisé.</p></li>
						<li><p>2) Sur autoroute, la ligne de dissuasion sert à interdire le rabattement des usagers situés sur la voie tout à gauche qui voudraient emprunter une sortie qu'ils n'auraient pas anticipé. En revanche, elle n'interdit pas le dépassement pour les véhicules situés sur les voies de droite ou du milieu.</p></li>
					</ol>
					<p class="titles">Les flèches de rabattement :</p>
					<p>Sur des routes à double sens de circulation, lorsque les flèches sont dans votre sens, cela signifie que la ligne discontinue va bientôt devenir continue.<br><br>Trois flèches apparaissent alors et vous devez avoir fini votre dépassement AVANT la 3<sup>ème</sup> flèche.</p>
					<p class="titles">La ligne double ou mixte :</p>
					<p>Sur des routes à double sens de circulation, une ligne discontinue peut être accolée à une ligne continue. Si la ligne discontinue est de votre côté, vous pouvez franchir la ligne. Si c'est la ligne continue qui est de votre côté, alors vous ne pouvez pas la franchir.</p>
					<img src="ressource/img/lignes_2.png" alt="La ligne double ou mixte">
					<p class="titles">Avertissement :</p>
					<p>Avant que la ligne discontinue passe en ligne continue, les pointillés se rapprochent et se resserrent. Cela s'appelle une ligne d'annonce de ligne continue. Ces lignes d'annonce ont les mêmes spécificités que les lignes de dissuasion : même longueur de trait et même espacement entre chaque trait.</p>
					<p class="titles">Les lignes de rives :</p>
					<p>Ce sont les lignes situées sur la droite au bord de la route.<br><br>Elles sont très utiles la nuit ou par mauvais temps pour bien se diriger et suivre la route.<br><br>Lorsque les lignes de rive sont discontinues, il est possible de s'arrêter sur l'accotement ou d'y stationner si l'espace est suffisant et que vous n'empiétez pas sur la route.<br>Lorsqu'elles sont continues, il est interdit de s'arrêter ou de stationner sur l'accotement.</p>
					<p class="titles">La ligne discontinue :</p>
					<p>Elle sépare les deux voies de circulation et vous permet d'effectuer un dépassement ou de changer de direction.<br><br>Les lignes discontinues sont des multiples de 13 mètres, c'est-à-dire qu'1 ligne discontinue + l'intervalle est égale à 13 mètres.<br><br>A 50 km/h, je parcours en 1 seconde environ 15 m soit 1 ligne discontinue + 1 intervalle.<br>A 90 km/h, je parcours en 1 seconde environ 27 m soit 2 lignes discontinues + 2 intervalles.</p>
					<h4 class="titles">Les flèches directionnelles :</h4>
					<p>Parfois, sur des routes assez larges avec plusieurs voies et hors agglomération, des flèches directionnelles marquées au sol vous renseignent sur la voie à prendre selon la direction que vous suivez.</p>
					<img src="ressource/img/marquagesol.png" alt="les flèches directionnelles">
					<p>Ainsi à cette intersection, si vous tournez à gauche, vous devez prendre la voie de gauche.<br><br>Si vous continuez tout droit, vous pouvez aller sur la voie du milieu ou de droite.<br><br><b><i>Attention</i></b>, vous devez toujours prendre la voie la plus à droite possible. Donc s'il n'y a pas de voiture, vous devez prendre la voie la plus à droite. Si les voies sont encombrées, vous pouvez prendre la voie du milieu.<br><br>Si vous tournez à droite, vous devez prendre la voie la plus à droite.</p>
					<h4 class="titles">Les voies réservées :</h4>
					<p class="titles">Les voies des bus :</p>
					<p>Elles sont séparées des autres voies par une ligne continue ou discontinue aux traits larges et rapprochés. La conduite, le stationnement et l'arrêt sont strictement interdits dans ces voies.</p>
					<img src="ressource/img/voisbus.png" alt="les voies des bus">
					<p>Vous pouvez néanmoins franchir la ligne quand elle est discontinue pour changer de direction.</p>
					<img src="ressource/img/voisbus2.png" alt="les voies des bus">
					<p>Dans ce cas, attention, les bus à votre droite sont prioritaires. Vous devez les laisser passer avant de tourner à droite.</p>
					<p class="titles">Les pistes et bandes cyclables :</p>
					<p>Elles sont quant à elles exclusivement réservées aux vélos à 2 ou 3 roues. Vous ne pouvez pas circuler dessus, vous y arrêter ni stationner.<br><br>Les pistes cyclables sont séparées par un terre-plein et peuvent être à double sens de circulation pour les vélos.</p>
					<img src="ressource/img/voiesvelo.png" alt="les voies des vélos">
					<p>Les bandes cyclables sont seulement séparées par une ligne continue ou discontinue du reste de la chaussée.</p>
					<img src="ressource/img/voiesvelo2.png" alt="les voies des vélos">
					<p class="titles">Les voies pour véhicules lents :</p>
					<p>Elles permettent aux véhicules lents ou lourds dans des descentes ou des montées de ne pas gêner la circulation des autres véhicules et usagers.<br><br>Elles sont délimitées par une ligne discontinue aux larges traits rapprochés.<br><br>Hors agglomération, les voies pour véhicules lents doivent être empruntées par tous les véhicules qui ne dépassent pas les 60 km/h.</p>
					<img src="ressource/img/vehiculeslents.png" alt="les voies pour les véhicules lents">
					<h4 class="titles">Les autres marquages au sol :</h4>
					<p class="titles">Les passages piétons :</p>
					<p>Les passages pour les piétons sont constitués de larges bandes blanches allant de part et d'autre de la chaussée à traverser. Les piétons sont prioritaires dès qu'ils sont engagés sur le passage ou qu'ils ont l'intention de s'y engager.<br><br>Leur intention est perçue quand ils vous regardent ou quand leur corps est engagé et tourné vers le passage piétons : jambe en l'air par exemple.<br><br>L'arrêt et le stationnement sont interdits sur le passage mais aussi 5 mètres avant celui-ci pour ne pas masquer la visibilité des piétons.</p>
					<img src="ressource/img/passagepietons.png" alt="les passages piétons">
					<p class="titles">Les arrêts de bus :</p>
					<p>Une ligne en zigzag jaune indique un arrêt de bus sur la chaussée. Vous pouvez rouler sur ce marquage mais l'arrêt et le stationnement y sont interdits.</p>
					<img src="ressource/img/arretbus.png" alt="les arrêts de bus">
					<p class="titles">Les zébras :</p>
					<p>Les zébras délimitent un espace plus large entre deux voies. Vous ne pouvez pas le traverser. L'arrêt et le stationnement y sont aussi interdits.</p>
					<img src="ressource/img/zebras.png" alt="les zébras">
					<p class="titles">Les voies de détresse :</p>
					<p>Sur les chaussées à risque, souvent dans des pentes dangereuses, des voies de détresse symbolisées par un damier rouge et blanc sont présentes.<br><br>Si vos freins ne répondent plus ou que vous êtes en difficulté majeure, empruntez ces voies qui se terminent par un bac en gravier ou en sable. Elles vous permettront de ralentir et de vous arrêter pour éviter l'accident.<br><br>L'arrêt et le stationnement y sont aussi interdits.</p>
					<img src="ressource/img/voiesdetresse.png" alt="les voies de détresse">
					<p>Les voies de détresse sont indiquées par ce panneau :</p>
					<img src="ressource/img/voiesdetresse2.png" alt="les voies de détresse" id="detresse">
					<hr>
					<h1 class="titles collapsible">La signalisation temporaire</h1>
					<p>La signalisation temporaire de couleur jaune intervient dans des zones où la circulation est modifiée comme quand il y a <b><i>des travaux</i></b> ou <b><i>des accidents</i></b>.<br><br><b><i>Tous les types de paneaux de signalisation verticale (danger, interdiction, obligation, indication et direction) peuvent avoir leur version en signalisation temporaire</i></b>.<br><br>Très important, cette signalisation prévaut sur la signalisation normale et permanente.</p>
					<h4 class="titles">Les panneaux de danger :</h4>
					<p>Tous les panneaux de danger temporaire sont sur fond jaune. Ils indiquent donc des dangers dus à des travaux en cours ou à des accidents.</p>
					<img src="ressource/img/danger_temp_gravillon.png" alt="projection de gravillons" title="Projection de gravillons" id="gravillon">
					<img src="ressource/img/danger_temp_accident.png" alt="accident" title="Accident" id="accident">
					<p>En présence de ces panneaux, vous devez avant tout ralentir et redoubler de vigilance.<br><br>Ces panneaux peuvent aussi être présents lors de dangers sur des zones de circulation difficile comme dans des bouchons par exemple.</p>
					<img src="ressource/img/danger_temp_bouchon.png" alt="bouchon" title="bouchon" id="bouchon">
					<h4 class="titles">Interdiction et Obligation :</h4>
					<p>Les panneaux d'interdiction et d'obligation sont l'exception au niveau de la couleur. Ils ne sont pas jaunes et restent les mêmes. Néanmoins, la différence est qu'ils sont posés sur le sol.</p>
					<img src="ressource/img/obligation.png" alt="obligation" title="obligation">
					<img src="ressource/img/interdiction.png" alt="interdiction" title="interdiction">
					<p>Il faut alors tenir compte de ces panneaux posés sur le sol car ils annulent ceux qui sont plantés sur des poteaux.</p>
					<h4 class="titles">Les panneaux d'indication :</h4>
					<p>Également de couleur jaune, les panneaux d'indication temporaire signalent un chantier, une zone de travaux, une réduction du nombre de voies de circulation ou bien encore un changement de trajectoire de la chaussée.</p>
					<img src="ressource/img/reduction.png" alt="réduction du nombre de voies" title="Réduction du nombre de voies" id="reduction">
					<img src="ressource/img/affectation.png" alt="indication du nombre et du sens des voies" title="Indication du nombre et du sens des voies" id="affectation">
					<h4 class="titles">Déviation :</h4>
					<p>En raison de travaux, les itinéraires peuvent être modifiés. Ainsi, des déviations sont mises en place. Les panneaux de déviation sont également de couleur jaune.<br><br>Il peut y avoir une seule déviation. Dans ce cas, vous trouverez ces panneaux</p>
					<img src="ressource/img/dev_1.png" alt="annonce de direction de déviation" title="Annonce de direction de déviation" id="dev_1">
					<img src="ressource/img/dev_2.png" alt="tourner à droite pour suivre la déviation" title="Tourner à droite pour suivre la déviation" id="dev_2">
					<p>Parfois, plusieurs itinéraires et déviations sont mis en place. Dans ce cas, vous devez bien identifier le numéro de déviation. Si vous allez comme dans le cas ci-dessous à Épenon ou Frozay, vous devrez suivre la déviation numéro 2.</p>
					<img src="ressource/img/dev_3.png" alt="déviation spécifique numérotée" title="Déviation spécifique numérotée" id="dev_3">
					<img src="ressource/img/dev_4.png" alt="déviation numérotée" title="Déviation numérotée" id="dev_4">
					<h4 class="titles">Les autres signalisations temporaires :</h4>
					<p class="titles">Balises rouges :</p>
					<p>Des balises peuvent interdire l'accès à une voie comme sur l'autoroute par exemple. Ce sont des plots posés au milieu de la voie.</p>
					<img src="ressource/img/balises_rouges.png" alt="balises rouges" title="Balises rouges">
					<p class="titles">Piquets mobiles :</p>
					<p>Sur des chantiers qui condamnent une voie, la circulation est alors alternée.<br><br>Des membres du personnel du chantier se chargent de réguler la circulation avec des panneaux verts (vous passez) et des panneaux rouges (vous vous arrêtez).</p>
					<img src="ressource/img/piquets_mobiles.png" alt="piquets mobiles" title="Piquets mobiles">
					<p class="titles">Feux tricolores :</p>
					<p>Des feux tricolores de couleur jaune peuvent aussi être posés sur la chaussée. Ils régulent la circulation..<br><br><b><i>Attention</i></b>, il n'y aura pas de feu vert en bas mais un feu jaune clignotant car il annonce un danger en zone de travaux.</p>
					<img src="ressource/img/feux_tricolores.png" alt="feux tricolores" title="Feux tricolores">
					<p class="titles">Marquages au sol :</p>
					<p>Suite à des modifications de trajectoire, des lignes continues ou discontinues jaunes peuvent être dessinées au sol.</p>
					<img src="ressource/img/marquages_au_sol.png" alt="marquages au sol" title="Marquages au sol">
					<p>Dans ce cas, ce sont les lignes jaunes qu'il faut suivre car elles annulent et remplacent les lignes blanches.</p>
					<hr>
					<h1 class="titles collapsible">La signalisation de la vitesse</h1>
					<p>Divers panneaux de limitation de vitesse jalonnent les routes. Il s'agit de connaître leur signification et savoir quand ils prennent effet.</p>
					<p class="titles">Les panneaux d'interdiction :</p>
					<p>Soit pour rappeler les limitations en cours,</p>
					<img src="ressource/img/limitation_encours.png">
					<p>Soit pour signaler une diminution de la limitation de la vitesse en cas de danger par exemple, comme un virage dans le cas ci-contre.</p>
					<img src="ressource/img/diminution_limitation.png">
					<p>Les panneaux prennent effet à hauteur du panneau et cessent soit au prochain panneau de fin d'interdiction soit au panneau de fin de limitation de la vitesse correspondant.</p>
					<img src="ressource/img/fin_interdiction.png" id="fin_interdiction">
					<img src="ressource/img/fin_interdiction_3.png">
					<p>En l'absence de panneau de fin de limitation, ils cessent à la prochaine intersection, à savoir le prochain croisement entre deux rues ou deux routes.</p>
					<img src="ressource/img/fin_interdiction_4.png">
					<p class="titles">Les panneaux de zone de vitesse :</p>
					<p>Les panneaux de zone limitent la vitesse dans un espace plus grand : plusieurs rues.</p>
					<img src="ressource/img/limitation_zone_1.png">
					<p>Il faut attendre le panneau de fin de zone et non la prochaine intersection pour que la limitation de vitesse soit levée.</p>
					<img src="ressource/img/limitation_zone_2.png">
					<p>Le panneau d'entrée d'agglomération signifie aussi une limitation à 50 km/h.<br><br>D'autres panneaux dans la ville pourront ensuite changer cette limitation (30 km/h ou 70 km/h).</p>
					<img src="ressource/img/limitation_zone_3.png">
					<p>Le panneau de sortie d'agglomération vous affranchit de la limitation à 50 km/h. Si vous arrivez sur une route séparée par une ligne seulement par exemple, alors vous pourrez rouler à 80 km/h.</p>
					<img src="ressource/img/limitation_zone_4.png">
					<p>A noter, si le panneau de limitation de vitesse est sur le même support, cette limitation s'appliquera dans toutes les rues de la ville (sauf apparition d'un nouveau panneau).</p>
					<img src="ressource/img/limitation_zone_5.png" id="limitation_zone_5">
					<p class="titles">Les panneaux d'obligation de vitesse :</p>
					<p>Il y a aussi des panneaux d'obligation de vitesse minimum ainsi que les panneaux de fin d'obligation de vitesse minimum correspondants.</p>
					<img src="ressource/img/debut_obligation.png" id="debut_obligation">
					<img src="ressource/img/fin_obligation.png" id="fin_obligation">
					<p>Sachez qu'il existe une vitesse minimum fixée à 80 km/h pour emprunter la voie la plus à gauche de l'autoroute, qu'il y ait deux ou plus de deux voies.</p>
					<img src="ressource/img/obligation_autoroute.png">
					<p class="titles">Les panneaux de danger :</p>
					<p>D'autres panneaux, comme les panneaux de danger triangulaires vous inciteront à réduire fortement votre vitesse en raison de dangers ou d'obstacles prévisibles.</p>
					<img src="ressource/img/sig_vitesse_danger.png" id="sig_vitesse_danger">
					<p>De manière générale, évitez de rouler à une vitesse excessive, inadaptée par rapport à la situation. Vous devez toujours être maître de votre véhicule.</p>
					<img src="ressource/img/sig_vitesse_danger_2.png">
		</div>
	</div>

	<!-------------------------------------------------------- FIN DIV Cour ------------------------------------------------------------->

	<!---------------------------------------------------------- DIV Panneau --------------------------------------------------------------->
	<div id="divPanneau" class="contain">
		<div class="liste">
			<h1>Les panneaux et les panonceaux</h1>
			<hr>
			<img src="ressource/img/panneau_1.png">
			<img src="ressource/img/panneau_2.png">
			<img src="ressource/img/panneau_3.png">
			<img src="ressource/img/panneau_4.png">
			<img src="ressource/img/panneau_5.png">
			<img src="ressource/img/panneau_6.png">
			<img src="ressource/img/panneau_7.png">
			<img src="ressource/img/panneau_8.png">
			<img src="ressource/img/panneau_9.png">
			<img src="ressource/img/panneau_10.png">
			<img src="ressource/img/panneau_11.png">
			<img src="ressource/img/panneau_12.png">
			<img src="ressource/img/panneau_13.png">
			<img src="ressource/img/panneau_14.png">
			<img src="ressource/img/panneau_15.png">
			<img src="ressource/img/panneau_16.png">
			<img src="ressource/img/panneau_17.png">
		</div>
	</div>
	
	<!-------------------------------------------------------- FIN DIV Cour ------------------------------------------------------------->

	<!---------------------------------------------------------- DIV Intersection --------------------------------------------------------------->
	<div id="divIntersection" class="contain">
		<div class="liste">
			<h1>Les intersections</h1>
			<hr>
			<p>Sur la route se trouvent de nombreuses intersections, c'est-à-dire des croisements entre deux ou plusieurs routes.<br><br>Pour conduire en toute sécurité, vous devez :</p>
			<ul>
				<li><p>connaître parfaitement les règles de priorité, c'est-à-dire savoir qui doit passer et dans quel ordre selon les situations ;</p></li>
				<li><p>tenir compte de l'environnement et de l'attitude des autres usagers.</p></li>
			</ul>
			<p>Les intersections sont par nature des zones potentiellement dangereuses et il convient d'anticiper l'approche de ces zones en essayant de recueillir le plus d'informations.<br><br>Ainsi, hors agglomération, des balises vous signalent les intersections. Ouvrez donc l'œil !</p>
			<img src="ressource/img/intersection_1.png">
			<h1 class="titles collapsible">Les intersections sans panneau</h1>
			<p>En l'absence de panneau, la règle à appliquer est celle de la priorité à droite. Les véhicules qui sont à votre droite sont donc prioritaires sur vous et passent en premier. Vous devez les laisser passer.<br><br>En revanche, les véhicules à votre gauche doivent vous laisser passer.<br><br>Différents cas de figure sont possibles selon que vous allez tout droit ou que vous tournez.<br><br>Voilà 4 exemples où vous êtes la voiture bleue :</p>
			<p class="cases">1-Je vais tout droit donc je laisse passer la voiture jaune à ma droite et passe avant la voiture rouge à ma gauche.</p>
			<img src="ressource/img/intersection_2.png">
			<p class="cases">2-Je vais à gauche donc je laisse passer la voiture jaune directement à ma droite et aussi la voiture rouge qui se trouve en face car une fois que j'aurai tourné, celle-ci sera bien à ma droite.</p>
			<img src="ressource/img/intersection_3.png">
			<p class="cases">3-Le véhicule d'en face veut tourner à sa gauche donc je suis à sa droite quand il tourne. C'est moi qui suis prioritaire en allant tout droit.</p>
			<img src="ressource/img/intersection_4.png">
			<p class="cases">4-Cas le plus délicat : la voiture rouge est à la droite de la jaune. La voiture jaune est à la droite de la bleue. La voiture bleue est donc prioritaire sur la rouge mais doit laisser passer la jaune.</p>
			<img src="ressource/img/intersection_5.png">
			<p>Dans ce cas, la voiture jaune avance jusqu'à la voiture rouge et la laisse passer. La voiture rouge passe avant la voiture jaune en premier puis avance jusqu'à la voiture bleue et la laisse passer. La voiture bleue passe en troisième et enfin la voiture rouge avance et finit en dernier son tournant.</p>
			<img src="ressource/img/intersection_6.png">
			<p>Rappel : il est interdit d'effectuer un dépassement dans une priorité à droite sauf d'un 2 roues (cyclistes et motos).<br><br>Pour détecter la présence d’une intersection sans panneau, votre regard doit balayer le plus souvent possible les bords droits de la route pour discerner les indices informels, c'est-à-dire tous les indices issus de l'expérience et du bon sens.<br><br>Accordez-donc de l'importance à ces éléments de l'environnement :</p>
			<ul>
				<li><p>arrondi de trottoir ;</p></li>
				<li><p>interruption de la file de véhicule en stationnement ;</p></li>
				<li><p>raie de lumière dans une zone d’ombre ;</p></li>
				<li><p>interruption des bâtiments ;</p></li>
				<li><p>sortie ou entrée d’un véhicule.</p></li>
			</ul>
			<p>En cas de doute sur le régime de priorité d'une intersection, partez du principe que vous devez céder le passage et ralentissez.</p>
			<h1 class="titles collapsible">Les intersections avec panneau</h1>
			<p>Dans la majorité des cas, un panneau donne la règle de la priorité qu'il faut appliquer.</p>
			<p class="titles">Panneau de priorité à droite :</p>
			<p>Il y a donc le panneau de priorité à droite. Il est de forme triangulaire signalant ainsi un danger car les intersections à priorité à droite sont dangereuses. Ces intersections demandent une bonne anticipation de la part du conducteur. Vous devez bien analyser l'environnement avant de prendre la décision de passer ou de vous arrêter. Dans tous les cas, vous devez ralentir.</p>
			<img src="ressource/img/intersection_7_prioritedroite.png" id="prioritedroite">
			<p>Les règles sont donc les mêmes que celles énoncées plus haut quand il n'y a pas de panneau.</p>
			<img src="ressource/img/intersection_8.png">
			<p class="titles">Panneau Cédez le passage :</p>
			<p>Il y a aussi les panneaux de "Cédez le passage" complétés par le marquage au sol d'une ligne blanche en pointillé.<br><br>La ligne marquera toute la largeur de la chaussée si elle est à sens unique, la moitié de la voie en cas de rue à double sens.</p>
			<img src="ressource/img/intersection_9.png">
			<img src="ressource/img/intersection_10.png">
			<p>Vous devez vous arrêter et donc céder le passage à droite et à gauche si des usagers arrivent ou sont présents sur les voies.</p>
			<img src="ressource/img/intersection_11.png">
			<p>En revanche, vous n'êtes pas obligé de marquer l'arrêt si aucune voiture n'est présente. Vous êtes alors autorisé à passer.</p>
			<img src="ressource/img/intersection_12.png">
			<p>Néanmoins, vous devez toujours ralentir à l'approche d'un Cédez le passage pour être prêt à vous arrêter à tout moment.<br><br>Les panneaux Cédez le passage peuvent être annoncés plus tôt que l'intersection avec un panonceau indiquant la distance où se trouvera le Cédez le passage.</p>
			<img src="ressource/img/intersection_13_cedezpassage.png" id="intersection_13_cedezpassage">
			<p>Si votre véhicule et celui d'en face sont concernés par un Cédez le passage et que vous désirez tourner à gauche, alors c'est de nouveau la priorité à droite qui s'applique car vous avez les mêmes obligations. Vous devez donc laisser passer la voiture d'en face qui va tout droit.</p>
			<img src="ressource/img/intersection_14.png">
			<p><b><i>Attention</i></b>, regardez bien des deux côtés de la chaussée avant de passer l'intersection, car des véhicules peuvent effectuer des dépassements et donc se trouver sur votre voie à la hauteur de l'intersection.</p>
			<img src="ressource/img/intersection_15.png">
			<p class="titles">Panneau Stop :</p>
			<p>Les panneaux Stop imposent l'arrêt complet devant le panneau et la ligne blanche continue marquée au sol même s'il n'y a aucun véhicule. L'arrêt doit être complet et absolu au sens où vos roues ne doivent plus bouger. Vous cédez le passage à gauche et à droite également.</p>
			<img src="ressource/img/intersection_16.png">
			<p>Dans une rue à double sens, la ligne blanche continue occupe la moitié de la largeur de la chaussée.<br>Dans une rue à sens unique, la ligne blanche continue occupe toute la largeur de la chaussée.</p>
			<img src="ressource/img/intersection_17.png" id="i17">
			<img src="ressource/img/intersection_18.png" id="i18">
			<p>Les panneaux Stop peuvent être annoncés plus tôt que l'intersection avec un panonceau indiquant la distance où se trouvera le Stop.</p>
			<img src="ressource/img/intersection_19_stop.png" id="intersection_19_stop">
			<p>Arrêtez-vous bien devant la ligne blanche continue et non à hauteur des panneaux. Souvent, les panneaux sont situés un peu avant la ligne continue donc allez bien jusqu'à la ligne continue marquée au sol pour vous y arrêter.</p>
			<p>Si vous tournez à gauche et que le véhicule en face a aussi un Stop, c'est encore une fois la priorité à droite qui s'applique car vous avez les mêmes obligations. Dans ce cas ci-dessous, vous cédez le passage car vous tournez à gauche.</p>
			<img src="ressource/img/intersection_20.png">
			<p class="titles">Panneau de priorité ponctuelle :</p>
			<p>Les panneaux de priorité ponctuelle vous donnent donc la priorité sur les véhicules de gauche et de droite mais seulement à la prochaine intersection. Ces derniers auront un Cédez le passage ou un Stop et vous laisseront donc passer.</p>
			<img src="ressource/img/intersection_21_priorite_ponctuelle.png" id="priorite_ponctuelle">
			<img src="ressource/img/intersection_22.png">
			<p>Si vous tournez à gauche et que le véhicule en face a aussi un panneau de priorité ponctuelle, c'est encore une fois la priorité à droite qui s'applique car vous avez les mêmes obligations. Dans ce cas, vous cédez le passage.</p>
			<p class="titles">Panneau de route prioritaire :</p>
			<p>Le panneau de route à caractère prioritaire vous informe que vous avez la priorité à toutes les intersections. Il est répété à chaque intersection pour le rappeler aux véhicules qui auraient rejoint la route prioritaire après vous par exemple.</p>
			<img src="ressource/img/intersection_23_prioritaire.png" id="prioritaire">
			<p>Il est implanté tous les 5 km sur route et tous les kilomètres en agglomération.</p>
			<img src="ressource/img/intersection_24.png" id="i24">
			<img src="ressource/img/intersection_25.png" id="i25">
			<p>Les autres usagers auront un Cédez le passage ou un Stop.</p>
			<img src="ressource/img/intersection_26.png">
			<p>Le panneau peut se trouver au-dessus d'un panneau d'agglomération, ce qui signifie que pendant toute la traversée de la ville, vous circulez sur une route prioritaire à toutes les intersections.</p>
			<img src="ressource/img/intersection_27_prioritaireagg.png" id="prioritaireagg">
			<p>Un panonceau peut aussi se rajouter au panneau et précise à une intersection quelle voie reste prioritaire. Ce sera celle représentée par un trait en gras.</p>
			<img src="ressource/img/intersection_28_prioritairepan.png" id="prioritairepan">
			<p>Dans le premier croquis ci-dessous, je continue sur la route prioritaire en tournant à gauche donc je passe en premier devant les autres véhicules.</p>
			<img src="ressource/img/intersection_29.png">
			<p>Dans le second croquis ci-dessous, je ne suis pas prioritaire car je quitte la voie prioritaire, comme l'indique le tracé en gras du panonceau.<br><br>La voiture de droite, elle, reste sur la voie prioritaire car elle tourne à sa gauche. Elle est de plus à ma droite donc je la laisse passer.<br><br>Je suis néanmoins prioritaire par rapport au véhicule d'en face car il a un Stop.</p>
			<img src="ressource/img/intersection_30.png">
			<p>La fin du caractère prioritaire de la route est signalée par ce panneau spécial barré d'un trait noir. S'il est au-dessus du panneau d'agglomération cela signifie que vous perdez la priorité à toutes les intersections de la ville. La priorité à droite doit alors être respectée.</p>
			<img src="ressource/img/intersection_31_finpriorite.png" id="i31">
			<img src="ressource/img/intersection_32_finprioriteagg.png" id="i32">
			<p class="titles">Cas particuliers :</p>
			<p>Lorsque le trafic est dense et que les intersections sont encombrées, ne vous engagez pas dans l'intersection si vous risquez de bloquer les véhicules de votre droite et de votre gauche désirant passer même si vous êtes prioritaire.</p>
			<img src="ressource/img/intersection_33.png">
			<p>Vous ne devez pas bloquer la circulation même si les autres usagers ont des panneaux Stop ou des Cédez le passage.<br><br>Il peut arriver de trouver des intersections avec des routes en bitume et des chemins de terre. Vous devez respecter la règle de la priorité à droite même si ces chemins sont en terre car les routes du domaine public sont parfois en terre. C’est souvent le cas pour les chemins ruraux et les chemins forestiers.<br><br>Ne les confondez donc pas avec des routes privées.</p>
			<img src="ressource/img/intersection_34.png">
			<p>Les routes du domaine public susceptibles d'être en terre sont les suivantes :</p>
			<ul>
				<li><p>chemin rural ;</p></li>
				<li><p>route communale ;</p></li>
				<li><p>rue portant un nom.</p></li>
			</ul>
			<p>En revanche, vous n'êtes jamais prioritaire quand vous sortez d'un lieu privé comme un garage, une maison, un parking ou une station-service. Vous devez céder le passage à droite comme à gauche.</p>
			<img src="ressource/img/intersection_35.png" id="i35">
			<img src="ressource/img/intersection_36.png" id="i36">
			<p>Pour bien identifier et repérer la nature de l'intersection, balayez du regard le plus souvent possible les bords droits de la route pour discerner les indices formels, c'est-à-dire tous les panneaux et marquages au sol.<br><br>En cas de doute sur le régime de priorité d'une intersection, partez du principe que vous devez céder le passage et ralentissez.</p>
			<hr>
			<h1 class="titles collapsible">Intersections : allure, analyse et décision</h1>
			<p class="titles">Allure et analyse :</p>
			<p>Voilà la procédure pour aborder correctement une intersection :</p>
			<ul>
				<li><p>en amont, vérifiez s'il y a ou s'il n'y a pas de panneau ou marquage au sol indiquant l'intersection et déduisez alors le régime de priorité qui s'applique.</p></li>
				<li><p>à l’approche de l’intersection, ralentissez selon la visibilité ;</p></li>
				<li><p>à hauteur de l'intersection, regardez au sol ou à hauteur de panneau pour vérifier s’il y a un marquage au sol ou un panneau qui vous indiquerait un Stop, un Cédez le passage ou un sens unique.</p></li>
			</ul>
			<img src="ressource/img/analyse_intersection_1.png">
			<p>Voilà un croquis qui vous récapitule les étapes importantes à réaliser à l'approche d'une intersection avec STOP :</p>
			<img src="ressource/img/analyse_intersection_2.png">
			<p>1) contrôles arrières puis freinage fort pour casser l'allure mais suffisamment progressif pour ne pas bloquer les roues ;</p>
			<p>2) freinage dégressif sans lâcher complètement le frein pour étaler le freinage. S'il y a besoin, rétrogradez et passez en seconde vitesse ;<br><br>Ne rétrogradez pas immédiatement et attendez d'avoir bien ralenti avant de rétrograder pour ne pas consommer plus de carburant.</p>
			<p>3) dans les derniers mètres, roulez ainsi très lentement pour vous arrêter facilement au point désiré, c'est-à-dire juste devant la ligne de Stop marquée au sol. Freinez doucement afin d'éviter les à-coups.</p>
			<p class="titles">Prendre la bonne décision : franchir, céder le passage ou s'arrêter :</p>
			<p>Lorsque vous conduisez, vous devez certes connaître les règles mais aussi et surtout vous adapter aux circonstances.<br><br>S'il convient de prendre votre priorité lorsque la situation le permet, il s'agit d'être très prudent car les autres usagers ne respectent pas toujours les règles.<br><br>C'est pour cette unique raison, à savoir le non-respect des règles des autres usagers, que vous devez être très prudent et ralentir lorsque vous passez une intersection.</p>
			<p>Quatre cas de figure sont possibles :<br><br>1)Vous avez la priorité. Vous passez SI :</p>
			<ul>
				<li><p>il n’y a pas d'autre usagers sur la route ;</p></li>
				<li><p>on vous cède clairement le passage.</p></li>
			</ul>
			<p><b><i>Attention</i></b>, vérifiez toujours, si cela est possible, où regarde le conducteur dans une intersection. Le regard du conducteur est primordial. Il ne vous a peut-être pas vu et s'apprête à franchir l'intersection bien qu'il ne soit pas prioritaire. Dans ce cas, ralentissez fortement pour pouvoir réagir rapidement au cas où il s'engagerait.</p>
			<img src="ressource/img/analyse_intersection_3.png">
			<p>2)Vous n’avez pas la priorité : vous cédez le passage ou vous vous arrêtez.</p>
			<img src="ressource/img/analyse_intersection_4.png">
			<p><b><i>Attention</i></b>, parfois, dans des intersections, une voiture peut en cacher une autre comme lorsqu'une voiture effectue un dépassement à hauteur d'intersection.</p>
			<img src="ressource/img/analyse_intersection_5.png">
			<p>3)Vous devez céder le passage mais il n'y a aucun usager donc vous pouvez passer si la signalisation vous l'autorise. Ainsi, si le panneau de Cédez le passage ne vous oblige pas à vous arrêter, faites attention car en cas de panneau Stop, vous devez absolument vous arrêter avant de passer, même s'il n'y a aucun autre usager sur les voies.</p>
			<img src="ressource/img/analyse_intersection_6.png">
			<p>4)La situation n’est pas claire avec le ou les autres usagers. Pour ne pas prendre de risque, faites jouer la courtoisie et cédez le passage ou acceptez la courtoisie de l’autre véhicule et passez.</p>
			<img src="ressource/img/analyse_intersection_7.png">
			<hr>
			<h1 class="titles collapsible">Les carrefours à sens giratoire et les ronds-points</h1>
			<p class="titles">Définitions :</p>
			<p>Les carrefours à sens giratoire et les ronds-points sont des places comportant un terre-plein central infranchissable, ceinturées par une chaussée à sens unique sur laquelle débouchent plusieurs routes. En ce sens ce sont des intersections.<br><br>Vous tournez toujours vers la droite dans le sens inverse des aiguilles d'une montre.</p>
			<img src="ressource/img/carrefour_et_rp_1.png">
			<p>Du point de vue de leur forme, les carrefours à sens giratoire et les ronds-points sont identiques.<br><br>La différence entre un rond-point et un carrefour à sens giratoire réside dans le régime de priorité.</p>
			<p>1) Rond-point : c'est la priorité à droite qui s'applique. Dans ce cas, il n’y a pas de marquage au sol ou de panneau. Les voitures qui entrent dans le rond-point sont prioritaires sur les véhicules déjà engagés dans l'anneau. Ce sont donc aux véhicules déjà engagés dans le rond-point de s'arrêter à chaque intersection.</p>
			<img src="ressource/img/carrefour_et_rp_2.png">
			<p>2) Carrefour à sens giratoire : vous devez céder le passage aux véhicules venant de la gauche, déjà insérés dans le carrefour, et contourner l'obstacle par la droite : des marquages et des panneaux "Cédez le passage" aux entrées de l'anneau sont présents. Vous êtes en revanche prioritaire lorsque vous circulez dans l'anneau. Vous ne devez donc pas marquer d'arrêt lorsque vous passez devant une sortie que vous n'empruntez pas.</p>
			<img src="ressource/img/carrefour_et_rp_3.png">
			<p>En amont du carrefour, vous verrez un panneau de danger vous signalant la présence du carrefour et un panonceau de distance peut vous préciser la distance exacte à laquelle il se situe.</p>
			<img src="ressource/img/carrefour_et_rp_4.png">
			<p><b><i>Attention</i></b>, confondre les deux peut s'avérer extrêmement dangereux car le régime de priorité change.<br><br>Notez que pendant longtemps seuls existaient les ronds-points et que de nombreux conducteurs ont pris l'habitude de céder le passage à droite, ralentissant ainsi la circulation à l'intérieur de l'anneau en voulant céder le passage. Ils s'insèrent également dans le carrefour sans céder le passage.<br><br>Même si ces pratiques tendent à disparaître avec le temps, assurez-vous toujours qu'on vous cède le passage avant de vous insérer dans un rond-point ou quand vous circulez dans un carrefour à sens giratoire.<br><br>De même, ralentissez à l'approche d'un carrefour à sens giratoire et ne cédez pas à la pression que les autres automobilistes pourraient vous faire subir en klaxonnant ou en se rapprochant de vous à l'arrière.</p>
			<p class="titles">Choisir sa position et circuler dans un carrefour à sens giratoire ou un rond-point :</p>
			<p>Tout le problème est de savoir où se placer avant d’entrer dans le carrefour à sens giratoire ou rond-point lorsqu'il y a plusieurs voies.<br><br>Principe : la grande couronne est utilisée pour prendre les sorties de droite et en face et la petite couronne pour les sorties de gauche ou effectuer un demi-tour.<br><br>Notez que dans un carrefour à sens giratoire ou un rond-point, le placement en entrant dans l'anneau est le même.<br><br>Prenons l'exemple d'un carrefour à sens giratoire standard à 4 branches et 2 voies :</p>
			<p class="cases">si je vais à droite et prends la première sortie, j'allume mon clignotant avant de m'engager dans le carrefour en empruntant la voie de droite dans l'anneau. Je maintiens mon clignotant allumé tout au long du déplacement jusqu'à la sortie du carrefour.</p>
			<img src="ressource/img/carrefour_et_rp_5.png">
			<p class="cases">si je vais tout droit, j'emprunte la voie de droite et allume mon clignotant juste avant la deuxième sortie et après la première ;</p>
			<img src="ressource/img/carrefour_et_rp_6.png">
			<p class="cases">si je vais à gauche ou effectue un demi-tour, je me place dans la voie de gauche et allume mon clignotant à gauche avant de m'engager dans le carrefour. Puis j'allumerai mon clignotant à droite avant la sortie pour signaler que je quitte le carrefour ;</p>
			<img src="ressource/img/carrefour_et_rp_7.png">
			<p class="cases">si vous ne savez pas quelle sortie prendre, dans le doute, restez sur la voie de droite.<br><br><b><i>Attention</i></b>, sachez que vous n'êtes jamais obligé d'aller dans la voie de gauche pour faire un demi-tour même si c'est conseillé. Ce fut la règle pendant longtemps et c’est encore aujourd’hui de cette manière que la plupart des conducteurs procèdent.</p>
			<img src="ressource/img/carrefour_et_rp_8.png">
			<p class="cases">Certains carrefours possèdent 3 voies et plus de 4 sorties donc profitez-en pour vous répartir sur les voies de la manière suivante :</p>
			<img src="ressource/img/carrefour_et_rp_9.png">
			<p>N'oubliez pas de céder le passage aux cyclistes dans ces ronds-points s'ils circulent sur des bandes cyclables sur la bordure extérieure de l'anneau.<br><br><b><i>Attention</i></b>, certains carrefours sont équipés de feux tricolores à l'entrée ou à l'intérieur. Bien entendu, ce sont ces feux qui régissent les règles de priorité.</p>
			<br>
			<p>Pour terminer, voici un récapitulatif de la marche à suivre à l'approche d'un carrefour à sens giratoire :</p>
			<ul>
				<li><p>détectez l’intersection et identifiez le régime de priorité : Cédez le passage (carrefour à sens giratoire) ou priorité à droite (rond-point) ;</p></li>
				<li><p>ralentissez bien en avance ;</p></li>
				<li><p>choisissez votre voie d’entrée : à droite ou à gauche. Si vous allez à gauche, effectuez un changement de voie ;</p></li>
				<li><p>contrôles : effectuez des contrôles dans les rétroviseurs intérieur et extérieurs avant l’entrée et dans les angles morts ;</p></li>
				<li><p>insérez-vous dès que possible.</p></li>
			</ul>
			<p class="titles">Sortir d'un carrefour à sens giratoire ou d'un rond-point : position, allure et contrôle :</p>
			<p>Quand vous êtes à l’intérieur du rond-point, la sortie des autres usagers est particulièrement dangereuse. C’est l’application des règles de sécurité qui permettront une sortie sans danger :</p>
			<p>1. Les contrôles indirects : effectuez des contrôles dans les rétroviseurs intérieur et extérieurs avant chaque sortie à droite ou/et à gauche suivant votre position et la sortie choisie.<br><br>2. Les contrôles directs : avant de sortir, vérifiez bien votre angle mort gauche et droit. Une voiture peut venir de la gauche et couper votre trajectoire : la fameuse queue de poisson qui est l'accident le plus répandu dans un rond-point ou un carrefour à sens giratoire.</p>
			<img src="ressource/img/carrefour_et_rp_10.png">
			<p>De même, une moto ou un cycliste peut vous doubler ou circuler sur votre droite. Soyez donc très prudent lors de votre sortie.</p>
			<img src="ressource/img/carrefour_et_rp_11.png">
			<p>3. Les clignotants :</p>
			<ul>
				<li><p>à gauche dès l’entrée si vous allez à gauche ou pour un demi-tour ;</p></li>
				<li><p>à droite une fois passée la sortie juste avant celle où vous allez sortir.</p></li>
			</ul>
			<p>Dans tous les cas, les clignotants sont précédés des « contrôles » (rétroviseurs intérieur et extérieurs + angles morts).</p>
			<img src="ressource/img/carrefour_et_rp_12.png">
			<p>Si vous avez raté votre sortie, n'hésitez pas à refaire un tour complet du carrefour plutôt que de freiner brutalement ou de mettre un coup de volant.<br><br>Naturellement, les marches arrières sont interdites dans les ronds-points et carrefours à sens giratoire.</p>
		</div>
	</div>
	
	<!-------------------------------------------------------- FIN DIV Cour ------------------------------------------------------------->

	<!---------------------------------------------------------- DIV Feux --------------------------------------------------------------->
	<div id="divFeux" class="contain">
		<div class="liste">
			<h1>Feux et tournants</h1>
			<hr>
			<h1 class="titles collapsible">Les feux</h1>
			<p>Les feux sont des appareils lumineux de signalisation, rouge, orange (ou jaune) et vert, qui régulent la circulation routière. La plupart du temps, l'ordre de passage aux intersections est régi justement par ces feux.</p>
			<img src="ressource/img/feux_1.png">
			<p>Il existe plusieurs sortes de feux avec un système de couleur spécifique qu'il faut connaître pour savoir quand vous avez le droit de passer et quand vous devez vous arrêter.</p>
			<p class="titles">Les feux ronds :</p>
			<p>Les feux les plus communs sont les feux tricolores ronds. Un panneau les signale toujours hors agglomération et parfois en agglomération s'ils peuvent surprendre le conducteur.</p>
			<img src="ressource/img/feux_2.png" id="feux_2">
			<img src="ressource/img/feux_3.png" id="feux_3">
			<p>Une ligne "d'effet des feux" est souvent marquée au sol pour savoir où vous devez vous arrêter. Une zone pour deux-roues leur est parfois réservée devant vous. La ligne peut être aussi avancée pour laisser de la place aux véhicules encombrants, comme des bus, pour bien effectuer leur manoeuvre.<br><br>S'il n'y en a pas, arrêtez-vous toujours un peu avant le feu pour bien le voir.</p>
			<img src="ressource/img/feux_4.png" id="feux_4">
			<img src="ressource/img/feux_5.png" id="feux_5">
			<p>Lorsque le feu est vert, vous pouvez passer. Les autres véhicules, ainsi que les piétons, ont un feu rouge. Faites attention à eux néanmoins. Vous êtes prioritaire mais ils ne respectent pas toujours les règles.<br>Ne vous engagez pas si vous allez rester bloqué dans l'intersection en cas de bouchon.</p>
			<img src="ressource/img/feux_6.png" id="feux_6">
			<p>Lorsque le feu est jaune vous devez vous arrêter sauf en cas de danger imminent.<br><br>Par exemple, si une voiture vous suit de trop près et si vous freinez brutalement, elle risque de vous heurter et provoquer un accident.<br><br>Le feu jaune s'allume 3 à 5 secondes avant le feu rouge pour l'annoncer.</p>
			<img src="ressource/img/feux_7.png" id="feux_7">
			<img src="ressource/img/feux_8.png">
			<p>Lorsque le feu est rouge, vous devez impérativement vous arrêter. Vous ne devez pas empiéter sur la ligne d'effet au sol.</p>
			<img src="ressource/img/feux_9.png" id="feux_9">
			<p>Au dos de certains feux tricolores, notamment dans les intersections, une croix apparaît derrière le feu. Quand celle-ci est rouge, cela signifie que le feu est rouge. Cette croix permet aux usagers en face dans une intersection de savoir si le feu est rouge ou vert. Elle peut aussi servir aux piétons qui voudraient traverser.<br><br>Les feux des piétons sont bicolores.<br><br>Ils sont de couleur verte quand le feu pour les véhicules est rouge.<br>Ils sont de couleur rouge quand le feu pour les véhicules est vert ou jaune.</p>
			<img src="ressource/img/feux_10.png" id="feux_10">
			<p><b><i>Attention</i></b> aux piétons quand vous tournez à gauche ou à droite même si vous avez un feu vert. Les piétons qui traversent dans la rue dans laquelle vous tournez sont prioritaires sur vous. Ils ont souvent en même temps un feu vert pour piéton. Vous devez absolument les laisser passer.</p>
			<img src="ressource/img/feux_11.png">
			<p class="titles">Les feux en forme de flèche :</p>
			<p>Il existe aussi des feux en forme de flèche.<br><br>Les flèches peuvent être unidirectionnelles, c'est-à-dire qu'elles indiquent une seule direction : à gauche, à droite ou tout droit.<br><br>Elles peuvent aussi être bidirectionnelles et indiquer deux directions. Tout droit et tourner à droite par exemple.</p>
			<img src="ressource/img/feux_12.png" id="feux_12">
			<img src="ressource/img/feux_13.png" id="feux_13">
			<p>Ces feux fonctionnent comme les feux ronds avec les trois couleurs : vert, jaune et rouge. Ils sont souvent complétés par un marquage au sol fléché également.</p>
			<img src="ressource/img/feux_14.png">
			<p>Parfois, une flèche supplémentaire de couleur jaune complète des feux ronds normaux et indique une direction supplémentaire.<br>Quand le feu jaune clignote, il autorise les véhicules à passer même si le feu rond est rouge. Attention, vous n'avez pas la priorité, vous devez laisser passer les piétons et tous les véhicules qui se trouveraient sur les voies après le feu.</p>
			<img src="ressource/img/feux_15.png">
			<p class="titles">Les feux clignotants et en panne :</p>
			<p>Les feux sont parfois clignotants ou en panne.<br><br>Lorsqu’ils clignotent, cela signifie que les intersections ne sont plus réglées par les feux. Dans ce cas, c’est le feu jaune du milieu qui clignote.<br><br>Il arrive également que les feux soient en panne. Ils ne fonctionnent plus et n’émettent plus aucune lumière. C’est pour cette raison qu’il y a souvent des panneaux de priorité au-dessous des feux.<br><br>Les panneaux sous les feux règlent alors le régime de priorité uniquement si les feux clignotent ou ne fonctionnent pas.</p>
			<img src="ressource/img/feux_16.png" id="feux_16">
			<p>S'il n'y a pas de panneaux, alors c'est la règle de la priorité à droite qu'il faut appliquer.<br><br>Parfois, un feu jaune clignotant remplace le feu vert.</p>
			<img src="ressource/img/feux_17.png" id="feux_17">
			<p><b><i>Attention</i></b>, cela ne signifie pas que le feu est en panne. Il passera aussi au jaune du milieu et au rouge ensuite.<br><br>Le feu jaune clignotant signale un danger à l’intersection. Dans ce cas, même s’il clignote, vous devez céder le passage aux piétons et respecter les panneaux de signalisation qui sont au-dessous du feu et, sinon, les règles de priorité. Vous devez également ralentir et vous préparer à vous arrêter.<br><br>En cas de panne de signalisation ou en cas de trafic dense, des agents règlent la circulation. Dans ce cas, Il faut absolument regarder leurs signes car ils annulent et précèdent les feux ainsi que les panneaux.<br><br>Ne pas s’arrêter à une injonction d’un policier est considéré comme un refus d’obtempérer.<br><br>Le croquis ci-dessous vous rappelle la hiérarchie des indications à respecter.</p>
			<img src="ressource/img/feux_18.png">
			<p>L’agent peut adopter 5 positions que vous devez connaître.</p>
			<p class="cases">De profil, vous êtes autorisé à passer.</p>
			<img src="ressource/img/feux_19.png" id="feux_19">
			<p class="cases">De face avec un bras levé, vous devez vous arrêter. Il peut alors préciser l'endroit où vous devez vous arrêter en faisant un signe.</p>
			<img src="ressource/img/feux_20.png" id="feux_20">
			<p class="cases">De face ou de dos, vous devez vous arrêter. L'arrêt est obligatoire.</p>
			<img src="ressource/img/feux_21.png" id="feux_21">
			<p class="cases">S'il agite son bras de haut en bas, vous devez ralentir.</p>
			<img src="ressource/img/feux_22.png" id="feux_22">
			<p class="cases">S'il fait des gestes circulaires avec son bras, cela veut dire que vous devez circuler et accélérer pour libérer la voie.</p>
			<img src="ressource/img/feux_23.png" id="feux_23">
			<p class="titles">Les feux spécifiques :</p>
			<p>Il existe aussi des feux spécifiques pour certaines catégories de véhicules ou d'usagers.<br><br>Ainsi, sur les voies des bus, il y a des feux qui les concernent uniquement. Attention de ne pas vous tromper.<br><br>De même sur les pistes cyclables, il y a parfois des feux qui régulent la circulation des cyclistes.<br><br>Dans les deux cas, un logo est inscrit dans le feu.</p>
			<img src="ressource/img/feux_24.png" id="feux_24">
			<p>Un feu supplémentaire pour les cyclistes existe parfois à côté d'un feu tricolore rond. Ne vous trompez pas ! Ce n'est pas une flèche qui vous autorise à passer. Le feu ne concerne que les cyclistes. Le logo d'un vélo est également représenté.</p>
			<img src="ressource/img/feux_25.png" id="feux_25">
			<p>Vous pouvez aussi trouver des feux clignotants isolés.<br><br>Les feux jaunes clignotants isolés signalent un danger. Ils sont présents par exemple aux abords des écoles ou des passages piétons pour attirer l'attention du conducteur et l'invitent à ralentir.</p>
			<img src="ressource/img/feux_26.png">
			<p>Les feux rouges clignotants isolés imposent l'arrêt. On peut les retrouver devant une voie de tramway, devant un passage à niveaux, un pont mobile ou devant un tunnel. L'arrêt est obligatoire même en l'absence de barrière.</p>
			<img src="ressource/img/feux_27.png">
			<hr>
			<h1 class="titles collapsible">Les tournants</h1>
			<p>Pour changer de direction, vous devez prendre des précautions. Vous devez vous assurer que :</p>
			<ul>
				<li><p>vous pouvez tourner car il n'y a pas d'interdiction comme par exemple un panneau sens interdit ;</p></li>
				<li><p>personne ne vous suit de trop près ou veut vous doubler par la gauche en regardant dans vos rétroviseurs.</p></li>
			</ul>
			<p>Si ces deux conditions sont remplies, alors ralentissez, allumez votre clignotant et placez-vous pour préparer votre tournant afin de ne gêner personne.</p>
			<h4 class="titles">Tourner à droite en agglomération (allure, contrôle, indicateur et trajectoire) :</h4>
			<img src="ressource/img/tournant_1.png">
			<p>1) contrôle intérieur : vérifiez s’il y a des véhicules derrière vous avant de ralentir ;</p>
			<p>2) adapter son allure : ralentissez pour ne pas prendre le tournant trop rapidement et perdre le contrôle de la trajectoire ;</p>
			<p>3) contrôle extérieur droit + angle mort : vérifiez qu’il n’y a personne sur le côté droit comme un cycliste sur une bande cyclable par exemple ;</p>
			<p>4) indicateur : mettez votre clignotant + contrôlez vers l’avant (voie d’en face) ;</p>
			<p>5) action : préparez votre main droite en avance puis tournez les roues. Le regard se porte sur le bord du trottoir le plus loin possible à mesure que la voiture avance.</p>
			<p>Lorsque vous tournez à droite, faites bien attention aux voies réservées aux bus ou aux cyclistes qui pourraient se trouver sur le bord droit de la chaussée.<br><br>Vous ne serez donc pas prioritaire et vous devez céder le passage à la fois aux bus et aux cyclistes.</p>
			<img src="ressource/img/tournant_2.png" id="tournant_2">
			<img src="ressource/img/tournant_3.png" id="tournant_3">
			<p>Faites aussi attention aux piétons qui sont également prioritaires dans la rue dans laquelle vous tournez.<br><br>Vous devez les laisser passer et anticiper votre freinage à l'approche du passage piéton situé à l'intersection.</p>
			<img src="ressource/img/tournant_4.png">
			<h4 class="titles">Tourner à gauche en agglomération (allure, contrôle, indicateur et trajectoire) :</h4>
			<p class="titles">Tournant à gauche classique :</p>
			<img src="ressource/img/tournant_5.png">
			<p>1) contrôle intérieur : vérifiez s’il y a des véhicules derrière avant de ralentir. Vérifiez qu’il n’y a personne sur le côté extérieur gauche + angle mort ;</p>
			<p>2) adapter allure : ralentissez pour ne pas prendre le tournant trop rapidement et perdre le contrôle de la trajectoire ;</p>
			<p>3) indicateur : Allumez votre clignotant gauche ;</p>
			<p>4) placement sur la voie : placez-vous à gauche à proximité de la ligne médiane ;</p>
			<p>5) contrôles extérieurs : à gauche et en face ;</p>
			<p>6) action : tournez en passant derrière le « policier » (point au centre de l’intersection). Vous ne devez pas couper la route mais contourner le centre de l'intersection comme s'il y avait un rond-point. Passez donc derrière pour ne pas couper la voie de gauche. N’oubliez pas les contrôles.</p>
			<br>
			<p>Lors d'un tournant à gauche, vous devez céder le passage aux voitures à votre droite mais vous devez également céder le passage aux piétons et anticiper votre freinage à l'approche du passage piéton situé à l'intersection.</p>
			<img src="ressource/img/tournant_6.png">
			<p class="titles">Tournant à l'indonésienne :</p>
			<p>Mais il peut aussi arriver que vous tourniez devant le véhicule venant en face. On appelle cela tourner "à l'indonésienne".<br><br>Cela est possible en raison de voies spéciales appelées voies de stockage. Elles permettent de changer de direction sans gêner les autres usagers qui souhaiteraient aller tout droit.</p>
			<img src="ressource/img/tournant_7.png">
			<p>Dans une intersection où vous tournez à gauche, ne vous arrêtez jamais en biais avec les roues déjà tournées vers la gauche. En effet, si une voiture vous percutait par derrière, votre voiture avancerait et se retrouverait alors dans la voie de gauche à sens inverse.<br><br>Beaucoup d'accidents mortels surviennent à cause de cette erreur car si une voiture arrive en face à pleine vitesse, le choc sera extrêmement violent.<br><br>Gardez ainsi toujours vos roues droites à l'arrêt avant de tourner, comme dans le dessin ci-dessous.</p>
			<img src="ressource/img/tournant_8.png">
		</div>
	</div>
	
	<!-------------------------------------------------------- FIN DIV Cour ------------------------------------------------------------->

	<!---------------------------------------------------------- DIV Croisement --------------------------------------------------------------->
	<div id="divCroisement" class="contain">
		<div class="liste">
			<h1>Les croisements</h1>
			<hr>
			<h1 class="titles collapsible">Les croisements</h1>
			<p>Nous croisons sans cesse des véhicules en sens inverse lorsque nous roulons. Sachez que les collisions frontales sont responsables de 22 % des tués sur route. Quelles sont donc les règles ?</p>
			<p class="titles">Sur routes planes :</p>
			<p>Sur routes planes (c'est-à-dire qui restent au même niveau, sans montée ni descente), il faut bien serrer à droite lorsque vous croisez un autre véhicule pour ne pas risquer de l'accrocher.</p>
			<img src="ressource/img/croisement_1.png">
			<p>Si un obstacle est de votre côté de la chaussée, comme une voiture en stationnement, des travaux ou des objets gênants, c'est à vous de céder le passage. Le véhicule qui arrive en face est prioritaire et vous devez le laissez passer.</p>
			<img src="ressource/img/croisement_2.png">
			<p>Si la chaussée est étroite, c'est le plus gros véhicule qui doit laisser passer le plus petit. Un véhicule de plus de 2 m de large et de plus de 7 m de long doit ralentir puis s'arrêter voire se garer pour faciliter le passage.</p>
			<img src="ressource/img/croisement_3.png">
			<p><b><i>Attention</i></b>, en agglomération, les bus bénéficient d'une facilité de passage. C'est aux autres véhicules plus petits de leur faciliter le passage. Il faut également laisser passer les véhicules de secours, d'urgence ou de police lorsqu'ils utilisent leur gyrophare.</p>
			<img src="ressource/img/croisement_4.png">
			<p>Lors de la traversée d'un pont étroit ou d'une chaussée étroite, une signalisation spécifique avec des panneaux peut régler les priorités.<br><br>Deux panneaux existent : un panneau d'interdiction et un panneau d'indication.<br><br>Panneau d'interdiction : La flèche noire indique que vous êtes prioritaire et la flèche rouge indique que vous devez céder le passage.<br><br>Panneau d'indication : La flèche blanche indique que vous êtes prioritaire et la flèche rouge indique que vous devez céder le passage.</p>
			<img src="ressource/img/croisement_5.png">
			<p><b><i>Attention</i></b>, si un véhicule est déjà engagé alors que vous êtes prioritaire, vous ne devez pas forcer le passage. Vous devez le laissez passer.</p>
			<img src="ressource/img/croisement_6.png">
			<p class="titles">Dans les descentes :</p>
			<p>Lorsque le croisement est difficile mais possible comme en montagne ou dans de fortes pentes étroites, c'est toujours au véhicule qui descend de s'arrêter le premier.</p>
			<img src="ressource/img/croisement_7.png">
			<p>Dans les descentes où le croisement est impossible, c'est :</p>
			<p class="cases">au véhicule unique de reculer pour laisser passer une caravane ou un véhicule avec une remorque ;</p>
			<img src="ressource/img/croisement_8.png">
			<p class="cases">au véhicule léger de reculer face à un véhicule lourd ;</p>
			<img src="ressource/img/croisement_9.png">
			<p class="cases">au véhicule qui descend de s'arrêter et de reculer si les véhicules sont du même gabarit.</p>
			<img src="ressource/img/croisement_10.png">
			<p class="cases">Attention, s'il y a un espace d'évitement pour pouvoir s'arrêter, alors c'est au véhicule qui a l'espace de son côté de s'arrêter et de laisser passer, qu'il monte ou qu'il descende.</p>
			<img src="ressource/img/croisement_11.png">
			<p class="cases">Entre un camion et un autocar ou bus, ce sera toujours au camion de reculer, qu'il monte ou qu'il descende.</p>
			<img src="ressource/img/croisement_12.png">
		</div>
	</div>
	
	<!-------------------------------------------------------- FIN DIV Cour ------------------------------------------------------------->

	<!---------------------------------------------------------- DIV TEST --------------------------------------------------------------->
	<div id="divDepassement" class="contain">
		<div class="liste">
			<h1>Les Dépassements</h1>
			<hr>
			<h1 class="titles collapsible">Les dépassements</h1>
			<h4 class="titles">Règles générales :</h4>
			<p>Tous les dépassements s'effectuent par la gauche.</p>
			<img src="ressource/img/depassement_1.png">
			<p>3 exceptions doivent néanmoins être soulignées. Il est possible de dépasser par la droite :</p>
			<p class="cases">un usager (véhicule, moto, vélo) qui veut tourner à gauche avec signalement (clignotant) ;</p>
			<img src="ressource/img/depassement_2.png">
			<p class="cases">des véhicules lorsque la circulation est en file ininterrompue comme dans les bouchons par exemple ;</p>
			<img src="ressource/img/depassement_3.png">
			<p class="cases">les tramways.</p>
			<img src="ressource/img/depassement_4.png">
			<p class="cases">Attention, il est toutefois interdit de dépasser un tramway quand il est à l'arrêt et que les voyageurs descendent. Désormais, dans les grandes villes, les tramways ont leur propre voie et lorsqu'ils s'arrêtent, les autres usagers ont souvent des feux rouge ou des passages piétons qui les obligent à s'arrêter. Mais cela n'a pas été toujours le cas et dans certaines villes, les tramways circulent encore sur des voies non délimitées. C'est pour cela que lorsque les tramways sont à l'arrêt, vous ne devez pas les dépasser par la droite car des piétons peuvent descendre et se retrouver sur la chaussée.</p>
			<img src="ressource/img/depassement_5.png">
			<h4 class="titles">Autorisation de dépassement :</h4>
			<p>Il est possible de dépasser quand deux conditions fondamentales sont remplies :</p>
			<p class="cases">la signalisation le permet : aucune interdiction n'est mentionnée ;</p>
			<img src="ressource/img/depassement_6.png">
			<p class="cases">la visibilité est suffisante. Dans une route à double sens à deux voies, il faut au minimum 500 m de visibilité quand je roule à 90 km/h. Il faut à la fois voir en face donc ne pas trop coller le véhicule de devant et savoir s'il est possible de se rabattre après le dépassement.</p>
			<img src="ressource/img/depassement_7.png">
			<p>D'autres conditions doivent ensuite être prises en compte :</p>
			<ul>
				<li><p>j'ai une réserve de vitesse suffisante sans dépasser les limitations ;</p></li>
				<li><p>l'écart de vitesse entre ma voiture et celle que je veux doubler est de 20 km/h minimum ;</p></li>
				<li><p>je ne suis pas déjà en train de me faire dépasser. Vérifier dans son rétroviseur intérieur, extérieur gauche et tourner la tête pour vérifier son angle mort ;</p></li>
				<li><p>il n'y a aucun usager en face dans les routes à double sens à deux ou trois voies ;</p></li>
				<li><p>la route le permet parce qu'elle est à sens unique.</p></li>
			</ul>
			<p>Vous pouvez dépasser plusieurs véhicules d'affilée si vous ne gênez pas la circulation, comme dans les voies à sens unique par exemple.</p>
			<p class="cases"><b><i>Cas particuliers :</i></b></p>
			<p>Le dépassement est possible dans un virage ou au sommet d'une côte si vous n'empruntez pas la voie de gauche en sens inverse.</p>
			<img src="ressource/img/depassement_8.png">
			<p>Il est aussi possible de dépasser un deux-roues dans un virage, au sommet d'une côte et à proximité d'une intersection où vous n'avez pas la priorité.</p>
			<img src="ressource/img/depassement_9.png" id="depassement_9">
			<img src="ressource/img/depassement_10.png" id="depassement_10">
			<h4 class="titles">Interdiction de dépassement :</h4>
			<p>Le dépassement peut être interdit :</p>
			<p class="titles">Par les panneaux :</p>
			<p class="cases">Panneau d’interdiction de dépasser pour les voitures ou les camions ;</p>
			<img src="ressource/img/depassement_11.png" id="depassement_11">
			<img src="ressource/img/depassement_12.png" id="depassement_12">
			<p class="cases">Panneau de priorité à droite. Il est interdit de dépasser dans des intersections où vous n'avez pas la priorité ;</p>
			<img src="ressource/img/depassement_13.png">
			<p class="cases">II est également interdit de dépasser sur des passages à niveau lorsqu'il n'y a pas de barrières.</p>
			<img src="ressource/img/depassement_14.png">
			<p><b><i>Attention</i></b>, vous pouvez effectuer un dépassement aux intersections où vous êtes prioritaire et sur un passage à niveau avec barrières mais cela est déconseillé car très risqué. C'est pourquoi il faut toujours tenir compte de l'environnement.</p>
			<p class="titles">Par l'environnement :</p>
			<p>Il est interdit de dépasser :</p>
			<ul>
				<li><p>à proximité d'un virage ou d'un sommet de côte, sauf s'il y a plusieurs voies et que vous n'empruntez pas la voie de gauche ;</p></li>
				<li><p>quand il y a une mauvaise visibilité : brouillard, fortes pluies, neige ;</p></li>
				<li><p>à proximité d'un passage piéton car il manque de visibilité.</p></li>
			</ul>
			<img src="ressource/img/depassement_15.png" id="depassement_15">
			<img src="ressource/img/depassement_16.png" id="depassement_16">
			<p class="titles">Par le marquage au sol :</p>
			<p>Pour pouvoir dépasser, il faut que les lignes qui séparent les voies soient en pointillé ou que les pointillés soient de votre côté dans le cas de lignes mixtes.</p>
			<img src="ressource/img/depassement_17.png" id="depassement_17">
			<img src="ressource/img/depassement_18.png" id="depassement_18">
			<p>Une ligne blanche continue interdit tout dépassement car on ne peut franchir ni même chevaucher une telle ligne.</p>
			<img src="ressource/img/depassement_19.png">
			<p><b><i>Exception</i></b> : Depuis le décret du 2 Juillet 2015, il est désormais possible de chevaucher une ligne blanche pour dépasser un cycliste, lorsque la visibilité du conducteur est suffisante.<br><br>Dans les routes à double sens à deux voies, il arrive souvent que le dépassement alterne dans les deux directions. Les lignes passent donc de pointillé à continue.<br><br>3 flèches de rabattement signalent le passage en ligne continue. A la troisième flèche, le conducteur doit obligatoirement être déjà rabattu.<br><br></p>
			<img src="ressource/img/depassement_20.png">
			<p>Il existe aussi des lignes de dissuasion qui se trouvent sur des routes sinueuses ou étroites et en montagne. Le dépassement est autorisé mais il est considéré comme dangereux. Vous risquez une amende selon les situations.</p>
			<img src="ressource/img/depassement_21.png">
			<p>Vous pouvez néanmoins dépasser les véhicules très lents comme des tracteurs, par exemple, sans risque.<br><br>Les lignes de dissuasion annoncent la plupart du temps le changement en une ligne continue.</p>
			<h4 class="titles">Précautions et obligations :</h4>
			<p>Il n'y a pas de distance minimale de sécurité latérale entre les véhicules lors des dépassements. Toutefois, il s'agit de toujours prendre de la marge pour ne pas accrocher le véhicule.</p>
			<img src="ressource/img/depassement_22.png">
			<p>Il vous faut donc bien anticiper le dépassement et se décaler bien avant dans la voie de gauche pour ne pas accrocher ou être trop près du véhicule que vous voulez dépasser.<br><br>De plus, si vous êtes trop près du véhicule de devant, votre champ visuel est grandement restreint :</p>
			<img src="ressource/img/depassement_23.png">
			<p>Pour les autres usagers de la route, à savoir deux-roues, trois-roues, piéton, cavalier, vélo, animal, je dois laisser au minimum :</p>
			<p class="cases">1,50 m si je circule hors agglomération ;</p>
			<img src="ressource/img/depassement_24.png">
			<p class="cases">1 m si je circule en agglomération.</p>
			<img src="ressource/img/depassement_25.png">
			<p>Je ralentis aussi pour effectuer ce genre de dépassement pour prévenir tout changement imprévu de direction de l'usager que je veux dépasser.<br><br>C'est pourquoi, je ne dois pas rester seulement dans ma file si elle n'est pas assez large. Il faut donc aller dans la voie de gauche s'il n'y a pas d'interdiction comme une ligne blanche continue.</p>
			<img src="ressource/img/depassement_26.png">
			<p>Il est aussi possible de dépasser un deux-roues dans un virage, au sommet d'une côte et à proximité d'une intersection où vous n'avez pas la priorité. Mais la plus grande prudence s'impose et il faut laisser une distance latérale de sécurité suffisante.</p>
			<hr>
			<h1 class="titles collapsible">Manœuvre de dépassement</h1>
			<p>Le dépassement se réalise en plusieurs étapes incontournables qu'il s'agit de bien maîtriser.</p>
			<p class="titles">Les contrôles :</p>
			<p>Avant de dépasser, il convient de procéder à tous les contrôles : rétroviseur intérieur, rétroviseurs extérieurs et angle mort en tournant la tête pour être sûr que la voie est libre.</p>
			<img src="ressource/img/depassement_27.png">
			<img src="ressource/img/depassement_28.png">
			<img src="ressource/img/depassement_29.png">
			<img src="ressource/img/depassement_30.png">
			<img src="ressource/img/depassement_31.png">
			<p>Avant de déboîter, j'allume le clignotant gauche pour avertir les autres usagers de ma manœuvre.</p>
			<img src="ressource/img/depassement_32.png">
			<p>Je déboîte de façon progressive en gardant une distance de sécurité derrière le véhicule que je dépasse pour ne pas l'accrocher.</p>
			<p class="titles">Le dépassement :</p>
			<p>J'accélère progressivement (sans dépasser les limitations de vitesse) et de manière continue tout au long du dépassement pour occuper le moins longtemps la voie de gauche.</p>
			<img src="ressource/img/depassement_33.png">
			<p>Puis je dépasse largement le véhicule en maintenant l'accélération ou en continuant à accélérer si besoin.</p>
			<img src="ressource/img/depassement_34.png">
			<p class="titles">Le rabattement :</p>
			<p>Quand je vois le véhicule dépassé dans le rétroviseur intérieur, je peux me rabattre sans ralentir. J'allume mon clignotant droit juste avant de commencer le rabattement.</p>
			<img src="ressource/img/depassement_35.png">
			<p>Je contrôle ensuite avec mon rétroviseur extérieur droit et l'angle mort pour être certain par exemple qu'une moto ne serait pas au milieu de la voie.</p>
			<img src="ressource/img/depassement_36.png">
			<p>Puis une fois retourné dans la voie de droite, je vérifie encore une dernière fois ce qui se passe derrière moi en utilisant le rétroviseur intérieur pour vérifier où se situe exactement la voiture que je viens de dépasser.</p>
			<img src="ressource/img/depassement_37.png">
			<p>De nuit, quand je suis à hauteur du véhicule que je dépasse, je change de feux. Je passe des feux de croisement aux feux de route dans le cas où après le dépassement, il n'y aurait pas d'autres véhicules devant moi.</p>
			<img src="ressource/img/depassement_38.png" id="depassement_38">
			<img src="ressource/img/depassement_39.png" id="depassement_39">
			<p class="titles">Être dépassé :</p>
			<p>Quand je suis dépassé :</p>
			<ul>
				<li><p>je serre le plus à droite possible ;</p></li>
				<li><p>je n'accélère pas ;</p></li>
				<li><p>je stabilise mon allure ;</p></li>
				<li><p>je peux ralentir pour faciliter le rabattement du véhicule après le dépassement.</p></li>
			</ul>
			<img src="ressource/img/depassement_40.png">
		</div>
	</div>
	
	<!-------------------------------------------------------- FIN DIV Cour ------------------------------------------------------------->

	<!---------------------------------------------------------- DIV TEST --------------------------------------------------------------->
	<div id="divArret" class="contain">
		<div class="liste">
			<h1>L'arrêt et le stationnement</h1>
			<hr>
			<h1 class="titles collapsible">L'arrêt</h1>
			<p>Pour bien identifier et avoir une vision claire des notions qui vont apparaître dans ce chapitre, voici un croquis qui identifie bien le nom des différentes parties de la route. Il vous sera très utile.</p>
			<img src="ressource/img/arret_1.png">
			<p class="titles">Définitions :</p>
			<p>Distinguons donc bien l'arrêt du stationnement.<br><br>On parle d'arrêt quand le véhicule est immobilisé de façon temporaire. L'arrêt sert ainsi à faire monter ou descendre des passagers et permet le chargement ou le déchargement du véhicule. Il y a donc arrêt quand une portière est ouverte par exemple.</p>
			<img src="ressource/img/arret_2.png">
			<p>Attention, s'arrêter pour faire des courses, même très rapides, est considéré comme un stationnement.</p>
			<p class="titles">Où s'arrêter en agglomération ? :</p>
			<p>En agglomération, l'arrêt s'effectue toujours dans le sens de la marche.</p>
			<p class="cases">Sur une voie à sens unique, il peut se faire à droite ou à gauche.</p>
			<img src="ressource/img/arret_3.png">
			<p class="cases">En revanche, sur une voie à double sens, il ne peut se faire qu'à droite.</p>
			<img src="ressource/img/arret_4.png">
			<p class="cases">Votre véhicule arrêté ne doit jamais faire franchir une ligne blanche continue aux autres usagers qui vous doubleraient.</p>
			<img src="ressource/img/arret_5.png">
			<p class="titles">Où s'arrêter hors agglomération ? :</p>
			<p>Hors agglomération, il faut se garer sur l'accotement, c'est-à-dire l'espace situé sur les côtés de la chaussée. Ainsi, vous ne gênez pas les autres véhicules qui continuent de circuler.</p>
			<img src="ressource/img/arret_6.png">
			<p class="cases">On parle d'accotement meuble quand le sol de l'accotement n'est pas stable ou stabilisé comme quand il est en terre par exemple.</p>
			<img src="ressource/img/arret_7.png">
			<p class="cases">Si vous ne pouvez pas vous arrêter sur l'accotement à votre droite dans le sens de la circulation, vous pouvez traverser la route, si la signalisation vous le permet (ligne discontinue) et vous placer sur l'accotement de gauche tout en restant dans votre sens initial de circulation.</p>
			<img src="ressource/img/arret_8.png">
			<p class="titles">Règles de l'arrêt :</p>
			<p><b style="color: #4CAF50">L'arrêt est</b> autorisé :</p>
			<ul>
				<li><p>devant les portes des garages privés et des entrées carrossables (entrée des voitures au bas d'un immeuble) ;</p></li>
				<li><p>sur les emplacements livraison (uniquement pour le chargement et déchargement de marchandises) ;</p></li>
				<li><p>en double file le long d'un trottoir ou devant des voitures stationnées le long du trottoir ;</p></li>
				<li><p>sur des places réservées à des voitures électriques pour leur recharge ;</p></li>
				<li><p>dans les zones de rencontre et les aires piétonnes.</p></li>
			</ul>
			<p><b style="color: #4CAF50">L'arrêt est</b> interdit :</p>
			<ul>
				<li><p>sur les passages piétons ;</p></li>
				<li><p>sur les voies réservées : voies de bus, chemins pour piétons, bandes et pistes cyclables et en bordure de celles-ci ;</p></li>
				<li><p>entre la chaussée et une ligne continue s'il n'y a pas assez de place entre mon véhicule et la ligne. Dans ce cas, les véhicules devront chevaucher ou franchir la ligne, ce qui est formellement interdit.</p></li>
				<li><p>devant des voitures stationnées en épi ou en bataille ;</p></li>
				<li><p>près de feux tricolores ou d'un panneau de signalisation si mon véhicule gêne leur visibilité ;</p></li>
				<li><p>sur et sous un pont ;</p></li>
				<li><p>près d'une intersection, d'un virage, d'un sommet de côte ou d'un passage à niveau ;</p></li>
				<li><p>dans un tunnel ;</p></li>
				<li><p>sur les bandes et emplacements réservés aux bus, taxis et véhicules d'autopartage ;</p></li>
				<li><p>sur les emplacements réservés aux handicapés : G.I.C. (grand invalide civil) ;</p></li>
				<li><p>sur la bande d'arrêt d'urgence.</p></li>
			</ul>
			<p>L'arrêt sur la bande d'arrêt d'urgence (BAU) n'est autorisé en effet qu'en cas de nécessité absolue : accident, panne, crevaison, surchauffe du moteur, voyant rouge sur le tableau de bord ou le malaise d'un voyageur. Vous devez alors allumer vos feux de détresse, mettre votre gilet de sécurité et vous tenir derrière les glissières de sécurité.<br><br>Sur autoroute, ne disposez pas le triangle de présignalisation car cela est beaucoup trop dangereux.</p>
			<img src="ressource/img/arret_9.png">
			<p class="titles">La signalisation de l'arrêt :</p>
			<p>Des panneaux de signalisation et des marquages au sol indiquent également que l'arrêt est interdit sur certaines voies.</p>
			<p class="cases">Le panneau rond à croix rouge interdit tout stationnement et arrêt. Il peut être complété par un panonceau qui indique de quel côté l'arrêt est interdit (flèches latérales) ou la distance pendant laquelle l'arrêt est interdit. L'interdiction d'arrêt prend effet à hauteur du panneau et cesse :<br><br><ul><li><p>soit à la prochaine intersection (s'il n'y a pas de panonceau) ;</p></li><li><p>soit au prochain panneau avec la flèche vers le bas ;</p></li><li><p>soit après la distance indiquée sur le panonceau.</p></li></ul></p>
			<img src="ressource/img/arret_10.png" id="arret_10">
			<img src="ressource/img/arret_11.png" id="arret_11">
			<p class="cases">Attention, le panneau de fin d'interdiction ne concerne pas l'arrêt et le stationnement. Même s'il apparaît, il ne met pas fin aux interdictions d'arrêt ni de stationnement. Ce panneau ne concerne que les voitures en circulation, c'est-à-dire qui roulent.</p>
			<img src="ressource/img/arret_12.png" id="arret_12">
			<p>Enfin, le marquage au sol situé sur le trottoir peut aussi vous renseigner :</p>
			<p class="cases">la ligne jaune continue interdit l'arrêt et le stationnement. Son effet cesse à la prochaine intersection ou si elle disparaît du trottoir ;</p>
			<img src="ressource/img/arret_13.png">
			<p class="cases">la ligne jaune discontinue vous autorise à vous arrêter. Elle interdit seulement le stationnement.</p>
			<img src="ressource/img/arret_14.png">
			<hr>
			<h1 class="titles collapsible">Le stationnement</h1>
			<img src="ressource/img/statio_1.png">
			<p class="titles">Définition :</p>
			<p>On parle de stationnement lors de l'immobilisation du véhicule sur la route en dehors des circonstances qui caractérisent l'arrêt, à savoir la montée ou la descente de personnes et le chargement ou déchargement du véhicule.<br><br>Même un arrêt de quelques minutes sera considéré comme un stationnement s'il ne concerne pas ces deux actions.</p>
			<p class="titles">Stationnement en et hors agglomération :</p>
			<p>Le conducteur peut alors quitter le véhicule pour une durée plus longue que l'arrêt, sans toutefois dépasser 7 jours sur le même emplacement de parking ou sur la chaussée. Au-delà de 7 jours, le stationnement est considéré comme abusif et fait l'objet d'une amende de 35 €.<br><br>En agglomération, le stationnement s'effectue toujours dans le sens de la marche. Sur une voie à sens unique, il peut se faire à droite ou à gauche. En revanche, sur une voie à double sens, il ne peut se faire qu'à droite.<br><br>Dans la rue ou les parkings, un marquage spécifique en pointillé blanc montre la façon de se garer. Voici les trois possibilités :</p>
			<p class="cases">en créneau : la voiture est garée le long du trottoir en marche arrière ou en marche avant ;</p>
			<img src="ressource/img/statio_2.png">
			<p class="cases">en épi : la voiture est de biais par rapport à la chaussée. L'orientation des lignes vous indique si l'on doit se garer en avant ou en arrière ;</p>
			<img src="ressource/img/statio_3.png">
			<p class="cases">en bataille : la voiture est garée de façon perpendiculaire avec le trottoir. Pensez à vous garer en arrière, cela vous facilitera la sortie de la place.</p>
			<img src="ressource/img/statio_4.png">
			<p>Hors agglomération, le stationnement se fait sur l'accotement, comme pour l'arrêt.</p>
			<img src="ressource/img/statio_5.png">
			<p class="titles">Interdiction de stationnement :</p>
			<p>Le stationnement est interdit dans tous les cas où l'arrêt est interdit (voir fiche Arrêt). Et plus spécifiquement, le stationnement est aussi interdit :</p>
			<ul>
				<li><p>devant les portes des garages privés et des entrées carrossables (entrée des voitures au bas d'un immeuble) ;</p></li>
				<li><p>sur les emplacements livraison ;</p></li>
				<li><p>en double file le long d'un trottoir ou devant des voitures stationnées en créneau, en épi et en bataille ;</p></li>
				<li><p>sur des places réservées à des voitures électriques pour leur recharge ;</p></li>
				<li><p>dans les zones de rencontre et les aires piétonnes.</p></li>
			</ul>
			<p class="titles">La signalisation du stationnement :</p>
			<p>La signalisation verticale vous renseigne pour savoir si vous avez le droit de stationner. Différents panneaux existent.<br><br>Le panneau d'interdiction de stationner seulement (1 barre de couleur rouge) et le panneau d'interdiction d'arrêt et de stationnement (2 barres de couleur rouge) prennent effet à hauteur du panneau et jusqu'à la prochaine intersection,</p>
			<img src="ressource/img/statio_6.png" id="statio_6">
			<img src="ressource/img/statio_7.png" id="statio_7">
			<p>sauf indication contraire marquée par des panonceaux qui indiquent le début et la fin de la zone où le stationnement est interdit.</p>
			<img src="ressource/img/statio_8.png" id="statio_8">
			<p>Il existe aussi des panneaux de zone à stationnement interdit. C'est une zone d'une ou de plusieurs rues, parfois l'agglomération entière, où le stationnement est interdit. Il faut attendre le panneau de fin de zone à stationnement interdit ou le panneau de sortie d'agglomération pour que l'interdiction soit levée. L'interdiction se maintient donc après la prochaine intersection.</p>
			<img src="ressource/img/statio_9.png" id="statio_9">
			<img src="ressource/img/statio_10.png" id="statio_10">
			<p>Certains panonceaux peuvent compléter le panneau d'interdiction de stationner. Il convient de bien lire le panonceau car il peut signifier :</p>
			<p class="cases">Soit l'interdiction s'applique qu'à une catégorie de véhicules.</p>
			<img src="ressource/img/statio_11.png">
			<p class="cases">Soit le stationnement est réservé à une catégorie de véhicules ou d'usagers.</p>
			<img src="ressource/img/statio_12.png">
			<p>Dans les agglomérations, en raison du grand nombre de voitures, le stationnement est réglementé. Il est soit payant, soit à durée limitée soit alterné.</p>
			<p class="cases">Le stationnement est payant lorsque vous voyez un panneau avec le dessin d'un horodateur. Le marquage au sol du mot "PAYANT" collé aux pointillés des places de stationnement vous informe aussi. Dans ce cas, vous devez prendre un ticket à l'horodateur, que vous placerez derrière votre pare-brise, en payant le prix de la durée de votre stationnement. Le prix varie en fonction des villes.</p>
			<img src="ressource/img/statio_13.png" id="statio_13">
			<p class="cases">Les panneaux de zone bleue vous indiquent que le stationnement est gratuit mais limité dans la durée. Le contrôle de la durée se fait grâce à un disque que vous devez mettre derrière votre pare-brise en marquant l'heure d'arrivée. Le stationnement est limité à 1 h 30. Passé ce délai, je dois quitter ma place. Le stationnement est limité entre 9 h et 11 h 30 le matin et entre 14 h 30 et 19 h l'après-midi.<br><br>Comme son nom l'indique, le marquage au sol est souvent de couleur bleue.</p>
			<img src="ressource/img/statio_14.png" id="statio_14">
			<p>Un non-paiement ou un dépassement du temps payé à l'horodateur ou indiqué sur votre disque vous place en infraction. Vous risquez alors une amende.<br><br>En zone payante, le prix de l'amende pour non-paiement du stationnement ou dépassement du temps dépend désormais des villes dans lesquelles vous stationnez. Le prix varie de 10 € à 60 € selon les municipalités.<br><br>En zone bleue, le prix de l'amende pour dépassement du temps est de 35 €.<br><br><br><br>Dans certaines rues, le stationnement est alterné. Cela signifie que vous ne pouvez vous garer que d'un côté de la rue et que le côté du stationnement varie en fonction du jour dans le mois.<br><br>Soit vous trouverez les panneaux ci-dessous qui vous indiquent de quel côté il est interdit de se garer selon la période.</p>
			<p class="cases">La première quinzaine du mois (du 1<sup>er</sup> au 15), le stationnement est interdit de ce côté de la rue. Vous trouverez donc de ce côté le panneau suivant :</p>
			<img src="ressource/img/statio_15.png">
			<p class="cases">La deuxième quinzaine du mois, (du 16 au 30 ou 31), il est interdit de se garer de ce côté de la rue et vous trouverez donc ce panneau :</p>
			<img src="ressource/img/statio_16.png">
			<p>Attention, ces panneaux peuvent se trouver des deux côtés de la rue, pairs ou impairs.</p>
			<p class="cases">Soit vous trouverez ce panneau de zone de stationnement alterné qui vous indique que vous devez toujours vous garer du côté impair de la rue la première quinzaine du mois, soit du 1<sup>er</sup> au 15, et du côté pair la deuxième quinzaine du mois, soit du 16 au 30 ou 31.<br><br>Souvenez-vous du premier jour de chaque période pour retenir. A partir du 1<sup>er</sup>, nombre impair, vous vous garez du côté impair de la rue et à partir du 16, nombre pair, ce sera du côté pair !</p>
			<img src="ressource/img/statio_17.png" id="statio_17">
			<img src="ressource/img/statio_18.png">
			<hr>
			<h1 class="titles collapsible">Le stationnement en épi et en bataille</h1>
			<p class="titles">Rappel des règles de priorité et de conduite lors des manoeuvres :</p>
			<p>Toutes les manœuvres pour s’arrêter ou stationner répondent à plusieurs règles :</p>
			<ul>
				<li><p>vérifier que le stationnement (ou l’arrêt) est possible (autorisé, non gênant, non dangereux) ;</p></li>
				<li><p>contrôler vers l’arrière avant de ralentir puis s’arrêter ;</p></li>
				<li><p>s’arrêter au niveau de la place et non après si je suis suivi pour indiquer mon intention aux autres (pour que les véhicules suivants ne nous collent pas et nous empêchent de manœuvrer) ;</p></li>
				<li><p>céder le passage aux véhicules voulant passer quand cela leur est possible.</p></li>
			</ul>
			<p>De même, toutes les manœuvres se font de la manière suivante :</p>
			<ul>
				<li><p>l’allure du véhicule est TOUJOURS très lente et régulière que ce soit à l’entrée ou à la sortie ;</p></li>
				<li><p>le volant se braque (tourner dans un sens) et contre braque (tourner dans l’autre sens) de manière rapide et régulière (sans précipitation toutefois) ;</p></li>
				<li><p>chaque conducteur utilise des repères qui lui sont propres (nous verrons ici des repères valables pour tous mais à adapter pour plus de facilité) ;</p></li>
				<li><p>pendant toute la manœuvre, le conducteur regarde en vision directe vers l’arrière et à travers les vitres. Il utilise les rétroviseurs de manière ponctuelle et non l’inverse.</p></li>
			</ul>
			<p class="titles">Stationner en épi :</p>
			<img src="ressource/img/statio_19.png">
			<p class="cases">Pour se garer en épi en marche avant :</p>
			<ul>
				<li><p>Faites les contrôles intérieurs et extérieurs. ;</p></li>
				<li><p>Mettez votre clignotant ;</p></li>
				<li><p>Commencez à tourner le volant vers la droite quand l'avant de votre voiture est au niveau du feu arrière gauche de la voiture verte dans le croquis ci-dessus.</p></li>
			</ul>
			<p class="cases"><b><i>ATTENTION</i></b>: en se garant en marche avant, le danger sera beaucoup plus important en sortant car la visibilité sera beaucoup plus réduite.</p>
			<p class="cases">Pour se garer en épi en marche arrière:</p>
			<ul>
				<li><p>Faites les contrôles intérieurs et extérieurs ;</p></li>
				<li><p>Mettez votre clignotant puis reculez jusqu'au repère : ici, le feu avant droit de la voiture verte dans le croquis ci-dessus que vous voyez directement à travers la vitre passager arrière droite ;</p></li>
				<li><p>Puis, commencez à braquer au repère et enfin contre-braquez quand la voiture est quasi parallèle à la voiture repère.</p></li>
			</ul>
			<p class="cases">Pour finir, si besoin, faites une marche avant puis une marche arrière pour vous positionner entre les voitures à égale distance de chacune d'elles.</p>
			<p class="titles">Stationner en bataille avec et sans véhicule témoin :</p>
			<img src="ressource/img/statio_20.png">
			<p class="cases">Pour se garer en bataille, à côté d'autres voitures :</p>
			<ul>
				<li><p>Effectuez les contrôles d'usage (extérieurs et intérieurs) ;</p></li>
				<li><p>Allumez votre clignotant puis reculez jusqu'au repère : ici, le feu arrière gauche de la voiture jaune dans le croquis ci-dessus que vous voyez directement à travers la vitre passager arrière droite ;</p></li>
				<li><p>Commencez à braquer au repère et tournez comme si vous contourniez un obstacle figuré par le point rouge ;</p></li>
				<li><p>Enfin, remettez les roues droites tout en reculant quand la voiture est quasiment parallèle à la voiture repère.</p></li>
			</ul>
			<p class="cases">Pour finir, si besoin, faites une marche avant puis une marche arrière pour se positionner entre les voitures à égale distance de chacune d'elles.<br>Pour se garer en bataille, quand il n'y a pas de voiture, il faut se fier aux lignes au sol délimitant les emplacements de parking.</p>
			<ul>
				<li><p>Effectuez les contrôles d'usage (extérieurs et intérieurs) ;</p></li>
				<li><p>Mettez votre clignotant puis reculez jusqu'au repère : la 3<sup>ème</sup> ligne au niveau de la moitié de la vitre du passager avant ;</p></li>
				<li><p>Commencez à braquer au repère puis remettez les roues droites tout en reculant quand la voiture est quasiment aux lignes en pointillé au sol.</p></li>
			</ul>
			<p class="cases">Pour finir, si besoin, faites une marche avant puis une marche arrière pour bien vous entre les lignes, à égale distance de chacune d'elle.</p>
			<hr>
			<h1 class="titles collapsible">Arrêt et stationnement de nuit</h1>
			<p class="titles">Arrêt de nuit :</p>
			<p>En agglomération, si vous vous arrêtez sur la chaussée, vous devez toujours garder vos feux allumés, qu'il y ait de l'éclairage ou pas.<br>Ces mêmes règles s'appliquent aussi hors agglomération.</p>
			<img src="ressource/img/arret_nuit_1.png" id="arret_nuit_1">
			<img src="ressource/img/arret_nuit_2.png" id="arret_nuit_2">
			<p class="titles">Stationnement de nuit :</p>
			<p>En agglomération, si l'éclairage public est suffisant et fonctionne toute la nuit, vous pouvez éteindre vos feux quand vous stationnez.</p>
			<img src="ressource/img/statio_nuit_1.png">
			<p>Vous pouvez également éteindre vos feux dans les parkings, éclairés ou non, et sur les emplacements délimités par des pointillés dédiés au stationnement.<br><br><br><br>En revanche, si l'éclairage est faible voire inexistant, alors vous devez stationner avec vos feux de position allumés. En cas de pluie ou de brouillard, c'est la même chose. Vous devez laisser vos feux de position allumés.</p>
			<img src="ressource/img/statio_nuit_2.png">
			<p>Si vous devez laisser vos feux allumés, il faut alors bien distinguer le stationnement longue durée et le stationnement court.<br><br>En effet, un stationnement peut durer seulement 10 minutes. Vous devez dans ce cas laisser vos feux allumés si vous stationnez sur la chaussée à un emplacement non délimité par des pointillés.<br><br>Mais si vous devez rester toute la nuit, alors vous ne devez pas stationner sur ce genre d'emplacement. Il faudra trouver un autre emplacement où vous pouvez en effet éteindre vos feux.<br><br>Si vous devez rester toute la nuit stationnée, il ne faut pas s'arrêter sur la chaussée car il faudrait alors garder les feux allumés et la batterie de votre voiture se déchargerait.<br><br><br><br>Hors agglomération, sur l'accotement, vous pouvez stationner sans feux allumés, qu'il y ait de l'éclairage ou pas.</p>
			<img src="ressource/img/statio_nuit_3.png" id="statio_nuit_3">
			<img src="ressource/img/statio_nuit_4.png" id="statio_nuit_4">
			<p>En cas de force majeure, si vous êtes garé sur la chaussée, alors vous devez laisser vos feux de position allumés ou votre plaque d'immatriculation, car le stationnement de nuit sur la chaussée est considéré comme dangereux. Vous risquez alors 135 € d'amende et un retrait de 3 points sur votre permis.</p>
			<img src="ressource/img/statio_nuit_5.png">
			<p>Rappelez-vous : dans tous les cas, le principe général reste la sécurité. Dès que votre véhicule arrêté ou stationné sur la chaussée peut constituer un danger pour les autres véhicules circulant, vous devez allumer vos feux de position afin d'être facilement repérable par les autres usagers.</p>
		</div>
	</div>
	
	<!-------------------------------------------------------- FIN DIV Cour ------------------------------------------------------------->

	<!---------------------------------------------------------- DIV TEST --------------------------------------------------------------->
	<div id="divVitesse" class="contain">
		<div class="liste">
			<h1>Réglementation de vitesse & choix des voies</h1>
			<hr>
			<h1 class="titles collapsible">La réglementation de la vitesse</h1>
			<p>Selon le type de routes sur lesquelles vous roulez, la vitesse est réglementée et limitée de façon différente. Les limitations changent en fonction du temps qu'il fait : pluie, neige ou brouillard.</p>
			<p class="titles">La vitesse en agglomération :</p>
			<p class="cases">En agglomération, la vitesse est limitée à 50 km/h quel que soit le temps : qu’il fasse beau ou qu’il pleuve.</p>
			<img src="ressource/img/reg_vitesse_1.png">
			<p class="titles">La vitesse hors agglomération :</p>
			<p class="cases">Sur les routes où une seule ligne (continue ou discontinue) vous sépare des autres véhicules, la vitesse est dorénavant limitée à 80 km/h, depuis le 1er Juillet 2018.<br>Les jeunes conducteurs en période probatoire sont aussi limités à 80 km/h.</p>
			<img src="ressource/img/reg_vitesse_2.png">
			<p class="cases">En cas de pluie, la vitesse reste limitée à 80 km/h.</p>
			<img src="ressource/img/reg_vitesse_3.png">
			<img src="ressource/img/reg_vitesse_4.png">
			<p><b><i>Exception</i></b> : sur les routes séparées par une ligne médiane, lorsqu’il y a deux voies de circulation dans le même sens, la vitesse est relevée à 90 km/h, uniquement du côté où il y a deux voies.</p>
			<p class="cases">Sur les routes à deux chaussées séparées par un terre-plein central et les autoroutes urbaines, c’est-à-dire à proximité des villes, la vitesse est limitée à 110 km/h.</p>
			<img src="ressource/img/reg_vitesse_5.png">
			<p class="cases">En cas de pluie, la vitesse est abaissée et elle est limitée à 100 km/h.<br>Attention, lorsque sur autoroute la vitesse est limitée à 110 km/h, la vitesse est aussi abaissée à 100 km/h en cas de pluie.</p>
			<img src="ressource/img/reg_vitesse_6.png">
			<p><b><i>ATTENTION</i></b> : la limitation ne dépend pas de la classification de la route.<br><br>Une route nationale n’est pas automatiquement limitée à 80 km/h.<br>Une route départementale n’est pas automatiquement limitée à 110 km/h.</p>
			<p class="cases">Sur les autoroutes enfin, la vitesse est limitée à 120 km/h.</p>
			<img src="ressource/img/reg_vitesse_7.png">
			<p class="cases">En cas de pluie, la vitesse est abaissée et elle est limitée à 110 km/h.</p>
			<img src="ressource/img/reg_vitesse_8.png">
			<p class="cases">Sachez que la neige et la grêle sont aussi considérées comme des temps de pluie.</p>
			<img src="ressource/img/reg_vitesse_9.png">
			<p class="cases">Par temps de brouillard, quand la visibilité est inférieure à 50 m, alors la vitesse est limitée à 50 km/h quelle que soit la route, que vous soyez en agglomération,</p>
			<img src="ressource/img/reg_vitesse_10.png">
			<p class="cases">ou sur une autoroute.</p>
			<img src="ressource/img/reg_vitesse_11.png">
			<p>Si vous êtes en période probatoire, c’est-à-dire que vous avez votre permis depuis moins de 3 ans ou moins de 2 ans pour ceux qui ont suivi la conduite accompagnée, les vitesses sont limitées comme s’il pleuvait. A savoir, 80 km/h sur route comme les autres usagers, 100 km/h sur routes à deux chaussée séparées ou autoroutes urbaines, et 110 km/h sur autoroute.</p>
			<hr>
			<h1 class="titles collapsible">Choix des voies de circulation</h1>
			<p>Ce chapitre concerne les règles fondamentales de la conduite. Même si certaines paraissent évidentes, il faut bien les avoir assimilées.<br><br>Il est très important de savoir où vous devez rouler sur la chaussée.<br><br>Dans la circulation, chaque véhicule occupe une place précise suivant la direction qu’il prend mais aussi suivant la signalisation et la réglementation.<br><br>Seul un bon placement sur les voies permet aux usagers qui suivent, dépassent ou croisent votre véhicule, d’anticiper votre position et de ne pas entrer en conflit avec vous.<br><br>RAPPEL : chaque changement de position (de voie) implique avant la manœuvre l’application des consignes de sécurité : CONTRÔLES et CLIGNOTANTS.</p>
			<p class="titles">Le changement de voie :</p>
			<p>Vous allez apprendre à choisir votre voie et à bien vous placer dans le flux de circulation, mais savez-vous changer de voie ?<br><br>Passer de la voie de droite vers la voie de gauche ou inversement est risqué et demande une compétence spécifique.<br><br>Le croquis ci-dessous vous récapitule les étapes du changement de voie :</p>
			<img src="ressource/img/choix_voies_1.png">
			<p class="titles">Le placement sans marquage au sol et sans panneau :</p>
			<p>En marche normale, vous devez toujours circuler à droite et vous replacer à droite après un écart (dépassement d'un deux-roues par exemple), près du bord de la chaussée.<br><br>Pour aller à gauche, placez-vous dans la voie de gauche de la chaussée, après avoir effectué vos contrôles et allumé votre clignotant,</p>
			<img src="ressource/img/placement_1.png">
			<p>ou à proximité de la ligne médiane s'il n'y a qu'une voie dans votre sens de circulation.</p>
			<img src="ressource/img/placement_2.png">
			<p>Dans ce cas, s'il y a assez de place, les autres véhicules pourront vous dépasser par la droite.<br><br><br>Cas particulier : dans une intersection en T, on peut se placer à droite pour aller à gauche afin de se replacer sur la voie la plus à droite (attention : sauf si marquage contraire).<br><br>Hors agglomération, même s'il y a plusieurs voies, vous devez aussi rouler le plus à droite possible.<br><br>Les voies de gauche sont destinées aux dépassements.</p>
			<img src="ressource/img/placement_3.png">
			<p class="titles">Le placement avec marquage au sol :</p>
			<p>Les voies peuvent aussi comporter des flèches directionnelles marquées au sol. Je suis ces flèches et emprunte ces voies en mettant mon clignotant selon la direction que je veux prendre.</p>
			<img src="ressource/img/placement_4.png">
			<p>Si deux voies ont les mêmes flèches, je me mets toujours le plus à droite, que j'aille tout droit, que je tourne à gauche ou à droite.</p>
			<p class="cases">Ici, je me positionne à droite complètement car je peux aller tout droit. La flèche au sol est bi-directionnelle.</p>
			<img src="ressource/img/placement_5.png">
			<p class="cases">Ici, je me positionne au milieu pour aller à gauche car la flèche au sol est bi-directionnelle.</p>
			<img src="ressource/img/placement_6.png">
			<p>Lorsqu’il y a plusieurs fléchages identiques et si jamais la voie la plus à droite est encombrée, alors placez-vous dans la voie qui est libre.<br><br>Reprenons l'exemple du dessus. Si je veux aller tout droit et que la voix complètement à droite est bouchée, alors je me positionne au milieu pour aller tout droit.</p>
			<img src="ressource/img/placement_7.png">
			<p>Les fléchages « doublés » permettent le dépassement, le déstockage ou la présélection vers la future voie de gauche.<br><br><br>Cas particulier : Les flèches de rabattement.<br><br>Généralement au nombre de trois, ces flèches indiquent au conducteur qu’il doit se rabattre le plus rapidement possible sur la voie indiquée par la flèche. Elles indiquent soit la suppression de la voie sur laquelle le véhicule roule, soit la fin d'autorisation de dépassement dans une voie à double sens de circulation comme dans le cas de figure ci-dessous.</p>
			<img src="ressource/img/placement_8.png">
			<p>On doit les considérer comme un signal de danger car il va falloir se rabattre rapidement avant l'arrivée de la 3<sup>ème</sup> flèche. Si tel n'est pas le cas, le risque est d’avoir des véhicules circulant à contre-sens sur votre future voie.</p>
			<p class="titles">Le placement avec panneau :</p>
			<p>Le marquage est le même que celui au sol mais il est visible de beaucoup plus loin.<br><br>Ces panneaux sont très importants car lorsqu’il y a beaucoup de circulation, les marquages au sol sont cachés par les autres véhicules.<br><br>Seuls les panneaux permettent au conducteur de savoir où se positionner pour ne pas rater sa direction et ne pas gêner les autres.</p>
			<img src="ressource/img/placement_9.png" id="placement_9">
			<p>Ces flèches peuvent alors apparaître sous la forme de feux lumineux, comme dans les péages ou sur les ponts. La flèche verte vous indique que la voie est libre. La croix rouge vous signale que la voie est interdite. Une flèche orange de rabattement vous invite à changer de voie car celle-ci va bientôt être fermée.</p>
			<img src="ressource/img/placement_10.png">
			<p>Voici un croquis vous montrant comment vous positionner sur une voie à sens unique si vous allez tout droit, à gauche ou à droite, dans une intersection régie par des panneaux de priorité (ici, un Cédez-le-passage).</p>
			<img src="ressource/img/placement_11.png">
			<p>1) Pour aller tout droit, restez au centre de votre voie.<br><br>2) Pour tourner à gauche, positionnez-vous légèrement à gauche de la voix, près de la ligne discontinue.<br><br>3) Pour aller à droite, restez aussi au centre de votre voie pour prendre un virage large et ne pas heurter le bord droit de la chaussée, souvent un trottoir dans une agglomération.</p>
		</div>
	</div>
	
	<!-------------------------------------------------------- FIN DIV Cour ------------------------------------------------------------->

	<!---------------------------------------------------------- DIV TEST --------------------------------------------------------------->
	<div id="divTest" class="contain">
		<div class="liste">
			<h1>divTest</h1>
		</div>
	</div>
	<!--------------------------------------------------------- DIV FIN TEST ------------------------------------------------------------>
	

	<!--------------------------------------------------------- DIV RESULTAT ------------------------------------------------------------>
	<div id="divResultat" class="contain">
		<div class="liste">
			<h1>Mes résultats</h1>	
				<div class="table">
					<table id="result_table" class="modTable">
						<tr class="modRow"><th class="modTh"><p>Date d’examen</p></th><th class="modTh"><p>Type d’examen</p></th><th class="modTh"><p>Note d’examen</p></th></tr>
						<?php 

							try{
								$pdo = get_pdo();
								// récupération de tous les résultats du candidat
								$requete = $pdo->prepare("SELECT * FROM resultat WHERE id_c = :id");
								$requete->execute(array('id' => $id));

								while($tuple=$requete->fetch()){
									$nom_ex=$tuple['nom_examen'];
									$note=$tuple['note_examen'];
									$date_ex=$tuple['date_examen'];
						
						?>
						<tr class="modRow"><td class="modTd"><p><?php echo $date_ex; ?></p></td><td class="modTd"><p><?php echo ucfirst($nom_ex); ?></p></td><td class="modTd"><p><?php echo ucfirst($note); ?></p></td></tr>
						<?php
								}		
							
								$pdo = null;
							}catch(PDOException $e){
								die('Erreur ! '.$e->getMessage());
							}
						?>
					</table>
				</div>
		</div>
	</div>
	<!------------------------------------------------------- FIN DIV RESULTAT ---------------------------------------------------------->


	<!----------------------------------------------------------- DIV Recu -------------------------------------------------------------->
	<div id="divRecu" class="contain">
		<div class="liste">
			<h1>Contacter mon moniteur</h1>
			<?php
				$precheck=$connexion->query("SELECT * FROM `employee` WHERE id='$id_m'");
				$precheck = $precheck->fetch();
				if ($precheck) {


			?>

		<table class="modTable">
			<tr class="modRow" >
				<th class="modTh"></th>
				<th class="modTh">Nom et Prénom</th>
				<th class="modTh">E-mail</th>
				<th class="modTh">Téléphone</th>
			</tr>

			<?php
				try {
					$resultat=$connexion->query("SELECT * FROM `employee` WHERE id='$id_m'");
					while ($row=$resultat->fetch()) {
						$nom=$row['Nom'];
						$prenom=$row['Prenom'];
						$email=$row['Email'];
						$telephone=$row['Telephone'];
						$photo=$row['Photo'];
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
		<?php
			}
			else {
				echo "<span class='niveau'>Aucun moniteur ne vous a été assigné.</span>";
			}
		?>
		</div>
	</div>
	<!--------------------------------------------------------- FIN DIV Recu ------------------------------------------------------------>


	<!--------------------------------------------------------- DIV CHOIX --------------------------------------------------------------->
	<div id="divChoix" class="contain">
		<div class="liste">
			<h1>Contacter le gérant</h1>
		<table class="modTable">
			<tr class="modRow" >
				<th class="modTh"></th>
				<th class="modTh">Nom et Prénom</th>
				<th class="modTh">E-mail</th>
				<th class="modTh">Téléphone</th>
			</tr>

			<?php
				try {
					$resultat=$connexion->query("SELECT * FROM `employee` WHERE id_role='2'");
					while ($row=$resultat->fetch()) {
						$nom=$row['Nom'];
						$prenom=$row['Prenom'];
						$email=$row['Email'];
						$telephone=$row['Telephone'];
						$photo=$row['Photo'];
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
	<!------------------------------------------------------- DIV FIN CHOIX ------------------------------------------------------------->


	<!----------------------------------------------------------- DIV TEXT -------------------------------------------------------------->
	<div id="divText" class="sub_liste">
		<h1>Contacter le gérant</h1>
		<table class="modTable">
			<tr class="modRow" >
				<th class="modTh"></th>
				<th class="modTh">Nom et Prénom</th>
				<th class="modTh">E-mail</th>
				<th class="modTh">Téléphone</th>
			</tr>

			<?php
				try {
					$resultat=$connexion->query("SELECT * FROM `employee` WHERE id_role='2'");
					while ($row=$resultat->fetch()) {
						$nom=$row['Nom'];
						$prenom=$row['Prenom'];
						$email=$row['Email'];
						$telephone=$row['Telephone'];
						$photo=$row['Photo'];
			?>

			<tr class="modTr">
				<td class="modTd"><?php echo '<img class="cadre" src="data:image/jpeg;base64,'.base64_encode($photo).'"/>'; ?></td>
				<td class="modTd"><?php echo $nom;?> <?php echo $prenom;?></td>
				<td class="modTd"><?php echo $email;?></td>
				<td class="modTd"><?php echo $telephone;?></td>
				<td class="buttonSized">
					<form method="POST">
						<button id="message" name="message" class="message"><i class="las la-comment-dots"></i></button>
					</form>
				</td>

				<?php
					} // close while loop
					}catch (PDOException $e) {
						echo "Erreur ! " . $e->getMessage() . "<br/>";
					}
				?>
			</tr>
		</table>
	</div>
	<!--------------------------------------------------------- FIN DIV TEXT ------------------------------------------------------------>


	<!---------------------------------------------------------- DIV TEXT1 -------------------------------------------------------------->
	<div id="divText1" class="sub_liste">
		<h1>Contacter le moniteur</h1>
		<table class="modTable">
			<tr class="modRow" >
				<th class="modTh"></th>
				<th class="modTh">Nom et Prénom</th>
				<th class="modTh">E-mail</th>
				<th class="modTh">Téléphone</th>
			</tr>

			<?php
				try {
					$resultat=$connexion->query("SELECT * FROM `employee` WHERE id='$id_m'");
					while ($row=$resultat->fetch()) {
						$nom=$row['Nom'];
						$prenom=$row['Prenom'];
						$email=$row['Email'];
						$telephone=$row['Telephone'];
						$photo=$row['Photo'];
			?>

			<tr class="modTr">
				<td class="modTd"><?php echo '<img class="cadre" src="data:image/jpeg;base64,'.base64_encode($photo).'"/>'; ?></td>
				<td class="modTd"><?php echo $nom;?> <?php echo $prenom;?></td>
				<td class="modTd"><?php echo $email;?></td>
				<td class="modTd"><?php echo $telephone;?></td>
				<td class="buttonSized">
					<form method="POST">
						<button id="message" name="message" class="message"><i class="las la-comment-dots"></i></button>
					</form>
				</td>

				<?php
					} // close while loop
					}catch (PDOException $e) {
						echo "Erreur ! " . $e->getMessage() . "<br/>";
					}
				?>
			</tr>
		</table>
	</div>
	<!-------------------------------------------------------- FIN DIV TEXT1 ------------------------------------------------------------>


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