<!---------------------------------------------------- PHP pour recuperer id connecte ---------------------------------------------------->
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
			$id_m=$_SESSION['id'];
			$requete1="SELECT * from `employee` where id='$id_m'";
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
<!---------------------------------------------------------------- FIN PHP --------------------------------------------------------------->


<!--------------------------------------------------------------- HTML CODE -------------------------------------------------------------->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
	<title><?php echo $nom . " " . $prenom ?> :: Moniteur Conduite</title>
	<link rel="stylesheet" type="text/css" href="../ressource/css/style_global.css">
	<link rel="stylesheet" type="text/css" href="../ressource/css/style_menu_left.css">
	<link rel="stylesheet" type="text/css" href="../ressource/css/style_table.css">
	<link rel="stylesheet" type="text/css" href="../ressource/css/style_ajouter.css">

	<link rel="stylesheet" type="text/css" href="../ressource/css/moniteur_code/style_l.css">

	<link rel="stylesheet" type="text/css" href="../ressource/css/moniteur_code/ssss.css">
        <link rel="stylesheet" type="text/css" href="../ressource/css/moniteur_code/style_g.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
	<script src="../ressource/js/menu.js"></script>
	<script src="../ressource/js/notification.js"></script>
	<script src="../ressource/js/superviseur/ajoutEmploye.js"></script>
	<script src="../ressource/js/moniteur_conduite/menu-left.js"></script>
	<script src="../ressource/js/jquery.js"></script><!-- verification des donnes -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script><!-- Modifier l'image de profile-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script><!-- Modifier l'image de profile-->
</head>
<?php
	$divSelect = isset($_GET["open"]) ? $_GET["open"] : "";
	$notifVu = isset($_GET["vu"]) ? $_GET["vu"] : "";
	if ($divSelect != ""){
		$myServerData = $divSelect . "();";

	}
	else{
		$myServerData = "listeCanCond();";
	}
	if ($notifVu != "") {
		$vuData = "notificationVu(" . $notifVu . ")";
	}
	else {
		$vuData = "";
	}

?>
<body onload="removeLoader();<?php echo $myServerData . $vuData; ?>">
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
			<a class="active" href="moniteur_conduite.php">Moniteur De Conduite</a>
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
		<a onclick="resultatCreno()"><i class="las la-clipboard"></i> Résultats d'examen</a>
		<a onclick="listeCanCond()"><i class="la la-list-ul"></i> Liste des candidats</a>
		<a onclick="window.location.href='absence.php'"><i class="la la-calendar-times-o"></i> Notifier une absence</a>
		<div onmouseover="afficherListeText()" onmouseout="cacherListeText()">
			<a><i class="las la-comment"></i> Contact</a>
			<div id="text" class="ids">
				<a onclick="textSuperviseur()"><i class="las la-sms"></i> Superviseur</a>
				<a onclick="textGerant()"><i class="las la-sms"></i> Gerant</a>
				<a onclick="textCandidat()"><i class="las la-sms"></i> Candidats</a>
			</div>
		</div>
		
	</div>
	<!----------------------------------------------------- FIN STYLE DE PAGE ---------------------------------------------------------->


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
								echo "<script>if(confirm(\" Votre photo de profil est modifier avec succées.\")){document.location.href='moniteur_conduite.php'};</script>";
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

							echo "<script>if(confirm(\" Opération reussite\")){document.location.href='moniteur_conduite.php'};</script>";
						}

					} catch (PDOException $e) {
						echo "Erreur ! " . $e->getMessage() . "<br/>";
					}
				?>
			</table>
		</form>
	</div>
	<!------------------------------------------------------- DIV FIN PROFILE ----------------------------------------------------------->
	

	<!--------------------------------------------------------- DIV RESULTAT ------------------------------------------------------------>
	<div id="divResultatCreno" class="sub_liste">
		<h1>Saisir un résultat d'examen</h1>
		<table class="modTable">
                <tr class="modRow" >
                    <th></th>
                    <th class="modTh">Nom et Prénom</th>
                    <th class="modTh">Niveau</th>
                    <th class="modTh">Date Examen</th>

                    <th class="modTh">Note Examen</th>
                </tr>

                <?php
                try {
                    $resultat=$connexion->query("SELECT * FROM `candidat` where id_m=$id_m;");
                    while ($row=$resultat->fetch()) {
                     
                        $id_c=$row['id_c'];
                        $nom=$row['Nom'];
                        $prenom=$row['Prenom'];
                        $niveau=$row['niveau'];
                        if ($niveau == 'creneau') $niveau = 'Créneau';
                        $photo=$row['Photo'];
                        ?>

                        <tr class="modTr">
                            <td class="modTd"><?php echo '<img class="cadre" src="data:image/jpeg;base64,'.base64_encode($photo).'"/>'; ?></td>
                            <td class="modTd"><?php echo ucfirst($nom);?> <?php echo ucfirst($prenom);?></td>
                            <td class="modTd"><?php echo ucfirst($niveau);?></td>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="id_c" value="<?php echo $id_c; ?>">
									<input type="hidden" name="nom_c" value="<?php echo $nom_c; ?>">
									<input type="hidden" name="prenom_c" value="<?php echo $prenom_c; ?>">
                                    <input class="ab" type="date" name="date_e" value="<?php echo date("Y-m-d");?>">
                                </td>
                                <td>
                                    <select id="result" name="result">
                                        <option value="réussi" selected>Réussi</option>
                                        <option value="echoué">Echoué</option>
                                    </select>
                                </td>
                                <td class="buttonSized">
                                    <button name="add_result" class="modifier"><i class="las la-plus"></i></button>
                                </form>
                            </td>
                            <td class="buttonSized">
                                <form method="POST" action="resultat_<?php if ($niveau =='Créneau') echo 'creno'; else echo 'circuit'; ?>.php">
                                    <input type="hidden" name="id_m" value="<?php echo $id; ?>">
                                    <input type="hidden" name="id_c" value="<?php echo $id_c; ?>">
                                    <button name="rs_<?php if ($niveau =='Créneau') echo 'creno'; else echo 'circuit'; ?>" class="info"><i class="las la-info"></i></button>
                                </form>
                            </td>

                            <?php
                            if (isset($_POST['add_result'])) {
                                $id_c=$_POST['id_c'];
                                $date_e=$_POST['date_e'];
                                $note=$_POST['result'];
                                $fNiveau=$connexion->query("SELECT * FROM `candidat` where id_c=$id_c;");
                                $fNiveau=$fNiveau->fetch();
                                $nom_c=$fNiveau['Nom'];
                            	$prenom_c=$fNiveau['Prenom'];
                            	$fNiveau=$fNiveau['niveau'];


                                $resultat1=$connexion->query("SELECT * FROM `resultat` WHERE id_c='$id_c' AND nom_examen='$fNiveau' AND note_examen='réussi'");
	                            $resultat2=$connexion->query("SELECT * FROM `resultat` WHERE id_c='$id_c' AND nom_examen='$fNiveau' AND date_examen='$date_e'");
	                            if ($resultat1->rowCount() != 0) {
	                                echo "<script>if(confirm(\"Le candidat ".$nom_c." ".$prenom_c." a déjà réussi dans son examen de " . $fNiveau. "\")){document.location.href='moniteur_conduite.php'};</script>";
	                            } else if ($resultat2->rowCount() != 0) {
	                                echo "<script>if(confirm(\"Le candidat ".$nom_c." ".$prenom_c." a déjà été examiné le ".$date_e.".\")){document.location.href='moniteur_conduite.php'};</script>";
	                            } else {
	                                $requete1="INSERT INTO `resultat`(`nom_examen` , `note_examen`  , `date_examen`, `id_c` )
	                                VALUES   ('$fNiveau'       , '$note'        , '$date_e'    , '$id_c');";
	                                $connexion->query($requete1);
	                                $afficherNiv = $fNiveau;
	                                if ($afficherNiv == "creneau")
	                                	$afficherNiv = "Créneau";

	                                if ($note == "réussi") {
	                                	$messageN="Bravo! vous avez réussi votre examen de " . ucfirst($afficherNiv) . ".";
							            $date_m=date('U');
							            $resultat2=$connexion->query("INSERT INTO notification (`name`,`message`,`status`,`date`,`id_candidat`) VALUES('Résultat d\'examen','$messageN','0','$date_m', '$id_c')");
	                                }
	                                else {
	                                	$messageN="Vous avez échoué votre examen de " . ucfirst($afficherNiv) . ".";
							            $date_m=date('U');
							            $resultat2=$connexion->query("INSERT INTO notification (`name`,`message`,`status`,`date`,`id_candidat`) VALUES('Résultat d\'examen','$messageN','0','$date_m', '$id_c')");
	                                }
	                                echo "<script>if(confirm(\"Résultat validé\")){document.location.href='moniteur_conduite.php'};</script>";
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
	<!--------------------------------------------------- FIN DIV RESULTAT CRENO ------------------------------------------------------->


	<!--------------------------------------------------- DIV RESULTAT CIRCUIT --------------------------------------------------------->
	<div id="divResultatCircuit" class="sub_liste">

	</div>
	<!-------------------------------------------------- FIN DIV RESULTAT CIRCUIT ------------------------------------------------------>

	<!---------------------------------------------------- DIV LISTE CANDIDATS --------------------------------------------------------->
	<div id="listeCandidatCond" class="contain">
		<div class="liste">
			<label id="title"><h1>Liste des Candidats</h1></label>
			<table class="modTable" width="100%">
				<tr class="div8 modRow" >
				<th>
				</th>
				<th>
					<u>Nom et Prénom</u>
				</th>
				<th>
					<u>Date de naissance</u>
				</th>
				<th>
					<u>Genre</u>
				</th>
				<th>
					<u>Type Voiture</u>
				</th>
				<th>
					<u>Téléphone</u>
				</th>
				<th>
					<u>E-mail</u>
				</th>
				</tr> 
				<?php

				$nom_bdd = "auto_ecole";
				$server = "localhost"; $user = "root"; $password = "";
				$connexion = new PDO("mysql:host=$server;dbname=$nom_bdd", $user, $password);

				$resultat=$connexion->query("SELECT * FROM `candidat` WHERE id_m=$id_m");
				while ($row=$resultat->fetch()) {

					$nom=$row['Nom'];
					$prenom=$row['Prenom'];
					$genre=$row['Genre'];
					$datenaiss=$row['Naissance'];
					$typeV=$row['TypeV'];
					$tlfn=$row['Telephone'];
					$Gmail=$row['Email'];
					$photo = $row['Photo'];



					?>              
					<tr class="modTr">
					<td class="modTd"><?php echo '<img class="cadre" src="data:image/jpeg;base64,'.base64_encode($photo).'"/>'; ?></td>
					<td  class="div7">
						<?php echo ucfirst($nom);?>
						<?php echo ucfirst($prenom);?>
					</td>
					<td  class="div7">
						<?php echo $datenaiss;?>
					</td>
					<td class="div7">
						<?php echo $genre;?>
					</td>
					<td class="div7">
						<?php echo ucfirst($typeV);?>
					</td>
					<td class="div7">
						<?php echo $tlfn;?>
					</td>
					<td class="div7">
						<?php echo $Gmail;?>
					</td>
					</tr>
					<?php
				}
				?>
			</table>
		</div>
	</div>
	<!---------------------------------------------------- FIN DIV LISTE CANDIDATS ----------------------------------------------------->

	<!--------------------------------------------------------- DIV Text --------------------------------------------------------------->
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
	<!------------------------------------------------------- FIN DIV Text ------------------------------------------------------------->


	<!--------------------------------------------------------- DIV Text2 --------------------------------------------------------------->
	<div id="divText2" class="sub_liste">
		<h1>Contacter les Gerants</h1>
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
	<!------------------------------------------------------- FIN DIV Text2 ------------------------------------------------------------->


	<!--------------------------------------------------------- DIV Text3 --------------------------------------------------------------->
	<div id="divText3" class="sub_liste">
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
					$resultat=$connexion->query("SELECT * FROM `candidat` WHERE id_m='$id'");
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
	<!------------------------------------------------------- FIN DIV Text3 ------------------------------------------------------------->


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