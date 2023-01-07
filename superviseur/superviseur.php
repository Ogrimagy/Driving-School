<!------------------------------------------------------------------ PHP ---------------------------------------------------------------->
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
			$id=$_SESSION['id'];
			$requete="SELECT * FROM `employee` WHERE id='$id'";
			$resultat=$connexion->query($requete);

			while($row=$resultat->fetch()) {
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
	<title><?php echo $nom . " " . $prenom ?> :: Superviseur</title>
	<link rel="stylesheet" type="text/css" href="../ressource/css/style_global.css">
	<link rel="stylesheet" type="text/css" href="../ressource/css/style_table.css">
	<link rel="stylesheet" type="text/css" href="../ressource/css/style_ajouter.css">
	<link rel="stylesheet" type="text/css" href="../ressource/css/style_menu_left.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
	<style type="text/css">
		.btRemise {
			color: white;
			font-family: 'Raleway', sans-serif;
			font-weight: 200;
			font-size: 15px;
			border-style: none;
			border-radius: 5px;
			padding: 3px;
			height: 35px;
			width: 200px;
			margin: 10px;
			background-color: #338BB7;
			transition: all 0.2s;
		}
		.btRemise:hover {
			cursor: pointer;
			background-color: #086a9c;
			transition: all 0.2s;
		}
	</style>
	<script src="../ressource/js/menu.js"></script>
	<script src="../ressource/js/notification.js"></script>
	<script src="../ressource/js/superviseur/menu-left.js"></script>
	<script src="../ressource/js/superviseur/ajoutEmploye.js"></script>
	<script src="../ressource/js/jquery.js"></script><!-- verification des donnes -->
	<script src="https://www.gstatic.com/charts/loader.js"></script><!-- Dessiner les statistiques -->
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
            $myServerData = "afficherStatistique();";
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
	<form method="POST">
	<div class="right-menu">
		<div class="imgNav">
			<a class="pImage"><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($photo).'"/>'; ?></a>
		</div>
		<div class="leftNav"> 
			<a>
				<?php echo $nom; ?>
				<?php echo $prenom; ?>
			</a>
		</div>
		<div class="topnav" id="myTopnav">
			<a class="active" href="superviseur.php">Superviseur</a>
			<a  href="profile.php">Profil</i></a>
			<?php
                $resultat=$connexion->query("SELECT * FROM notification WHERE status='0' AND id_employee='$id'");
                if ($resultat->rowCount()>0) {
            ?>
			<a  onclick="notificationVu(<?php echo $id?>);afficherNotification()"><i class="fa fa-bell"><span id="nbNotif"><?php echo $resultat->rowCount(); ?></span></i></a>
        	<?php
            	} else {
        	?>
			<a  onclick="afficherNotification()"><i class="fa fa-bell"><span class="nbNotif"></span></i></a>
        	<?php
            	}  
        	?>

			<a class="buttonLink">
					<button class="deco" name="dec">Se deconnecter</button>		
				</form>
			</a>
			<a href="javascript:void(0);" class="icon" onclick="myFunction()">
				<i class="fa fa-bars"></i>
			</a>
		</div>
	</div>

	<div id="sidePanel" class="sidebar">
		<br>
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i id="arrows" class="las la-angle-double-left"></i></a>
		<a onclick="afficherStatistique()"><i class="las la-chart-pie"></i> Statistique</a>
		<a onclick="ajouterEmployer()"><i class="las la-plus-circle"></i> Ajouter un employé</a>
		<div onmouseover="afficherListeGerer()" onmouseout="cacherListeGerer()">
			<a><i class="las la-address-book"></i> Gérer les employés</a>
			<div id="type_employe" class="ids">
				<a onclick="modifierGerant()"><i class="las la-list"></i> Gérant</a>
				<a onclick="modifierMoniCode()"><i class="las la-list"></i> Moniteur (Code)</a>
				<a onclick="modifierMoniCond()"><i class="las la-list"></i> Moniteur (Conduite)</a>
			</div>
		</div>
		<div onmouseover="afficherListePayer()" onmouseout="cacherListePayer()">
			<a><i class="las la-receipt"></i> Paiements</a>
			<div id="payer" class="ids">
				<a onclick="payerCandidat()"><i class="las la-receipt"></i> Candidat</a>
				<a onclick="payerGerant()"><i class="las la-receipt"></i> Gérant</a>
				<a onclick="payerMoniCode()"><i class="las la-receipt"></i> Moniteur (Code)</a>
				<a onclick="payerMoniCond()"><i class="las la-receipt"></i> Moniteur (Conduite)</a>
			</div>
		</div>
		<a onclick="ajouterRemise()"><i class="las la-hands-helping"></i>Ajouter des remises</a>
		<div onmouseover="afficherListeText()" onmouseout="cacherListeText()">
			<a><i class="las la-comment"></i> Contact</a>
			<div id="text" class="ids">
				<a onclick="textGerant()"><i class="las la-sms"></i> Gerant</a>
				<a onclick="textMoniCode()"><i class="las la-sms"></i> Moniteur (Code)</a>
				<a onclick="textMoniCond()"><i class="las la-sms"></i> Moniteur (Conduite)</a>
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
	<!----------------------------------------------------- FIN DIV NOTIFICATION -------------------------------------------------------->


	<!---------------------------------------------------- DIV MODIFIER PROFILE --------------------------------------------------------->
	<div id="divProfile" class="contain">
	
			
		
	</div>
	<!------------------------------------------------- FIN DIV MODIFIER PROFILE -------------------------------------------------------->


	<!------------------------------------------------------- DIV STATISTIQUE ----------------------------------------------------------->
	<div id="divStatistique" class="contain">
    	<div class="liste">
    		<h1>Statistiques basées sur les candidats</h1>
	    	<?php
			    $query = "SELECT Genre, count(*) as number FROM `candidat` GROUP BY Genre";
			    $result = mysqli_query($connect, $query);
			    $query1 = "SELECT Etat, count(*) as number FROM `candidat` GROUP BY Etat";
			    $result1 = mysqli_query($connect, $query1);
			    $query2 = "SELECT TypeV, count(*) as number FROM `candidat` GROUP BY TypeV";
			    $result2 = mysqli_query($connect, $query2);
			    $query3 = "SELECT Niveau, count(*) as number FROM `candidat` GROUP BY Niveau";
			    $result3 = mysqli_query($connect, $query3);
			?>
			<script type="text/javascript">
				google.charts.load('current', {'packages':['corechart']});  
		        google.charts.setOnLoadCallback(drawChart);
		        function drawChart() {
		            var data = google.visualization.arrayToDataTable([  
			            ['Genre', 'Number'],
			            <?php
			                while($row = mysqli_fetch_array($result)){  
			                    echo "['".$row["Genre"]."', ".$row["number"]."],";  
			                }
			            ?>
		        	]);
		            var options = {
		                title: 'Pourcentage Homme/Femme',
		                titleTextStyle: { color: '#FFF' },
		                legendTextStyle: { color: '#FFF' },
		                is3D:true,
		                backgroundColor: 'transparent'
		            };
		            var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
		            chart.draw(data, options);  
		        }

		        google.charts.setOnLoadCallback(drawChart1);
		        function drawChart1() {
		            var data = google.visualization.arrayToDataTable([  
			            ['Etat', 'Number'],
			            <?php
			                while($row = mysqli_fetch_array($result1)){  
			                    echo "['".ucfirst($row["Etat"])."', ".$row["number"]."],";  
			                }
			            ?>
		        	]);
		            var options = {
		                title: 'Situation sociale',
		                titleTextStyle: { color: '#FFF' },
		                legendTextStyle: { color: '#FFF' },
		                is3D:true,
		                backgroundColor: 'transparent'
		            };
		            var chart = new google.visualization.PieChart(document.getElementById('piechart1'));  
		            chart.draw(data, options);  
		        }

		        google.charts.setOnLoadCallback(drawChart2);
		        function drawChart2() {
		            var data = google.visualization.arrayToDataTable([  
			            ['TypeV', 'Number'],
			            <?php
			                while($row = mysqli_fetch_array($result2)){  
			                    echo "['".ucfirst($row["TypeV"])."', ".$row["number"]."],";  
			                }
			            ?>
		        	]);
		            var options = {
		                title: 'Types transmission',
		                titleTextStyle: { color: '#FFF' },
		                legendTextStyle: { color: '#FFF' },
		                is3D:true,
		                backgroundColor: 'transparent'
		            };
		            var chart = new google.visualization.PieChart(document.getElementById('piechart2'));  
		            chart.draw(data, options);  
		        }

		        google.charts.setOnLoadCallback(drawChart3);
		        function drawChart3() {
		            var data = google.visualization.arrayToDataTable([  
			            ['Niveau', 'Number'],
			            <?php
			                while($row = mysqli_fetch_array($result3)){  
			                    echo "['".ucfirst($row["Niveau"])."', ".$row["number"]."],";  
			                }
			            ?>
		        	]);
		            var options = {
		                title: 'Taux de progrès',
		                titleTextStyle: { color: '#FFF' },
		                legendTextStyle: { color: '#FFF' },
		                is3D:true,
		                backgroundColor: 'transparent'
		            };
		            var chart = new google.visualization.PieChart(document.getElementById('piechart3'));  
		            chart.draw(data, options);  
		        }
	    	</script>
	    	<table align="center">
	    		<tr>
	    			<th>
	    				<div id="piechart"></div>
	    			</th>
	    			<th>
	    				<div id="piechart1"></div>
	    			</th>
	    		</tr>
	    		<tr>
	    			<th>
	    				<div id="piechart2"></div>
	    			</th>
	    			<th>
	    				<div id="piechart3"></div>
	    			</th>
	    		</tr>
	    	</table>
    	</div>
    </div>
    <!----------------------------------------------------- FIN DIV STATISTIQUE --------------------------------------------------------->


    <!----------------------------------------------------- DIV AJOUT EMPLOYE ----------------------------------------------------------->
	<div id="divAjouter" class="contain">
		<form id="formulaire" method="post" autocomplete="off">
			<table class="table" width="100%">
				<tr><td colspan="2"><label id="title"><h2>Ajout d'un employé</h2></label></td></tr>
				<tr><td colspan="2"><div><progress id="progression_inscription" value="0" max="105" style="width: 95%;">Progression inscription</progress></div></td></tr>

				<!------------------------------------ Code Script ------------------------------->
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
			                    $('#err_mail').html("Quelqu'un a déjà cette adresse e-mail. Essayez avec un autre nom.");
			                    document.getElementById("ad_email").className = "erreurChamp";
			                    progression(4, -15);
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
			                    progression(5, -15);
			                }
			            }).fail(function(xhr, ajaxOptions, thrownError) {                
			                alert(thrownError);                                 
			            });
			        }
			    </script>
			    <!---------------------------------- FIN Code Script ----------------------------->

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
						<input type="text" id="nom" name="nom" maxlength="30" onfocusOut="verifier_nom()" required autocomplete="off">
					</td>
					<td>
						<input type="text" id="prenom" name="prenom" maxlength="30" onfocusOut="verifier_prenom()" required autocomplete="chrome-off">
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
						<input type="date" id="naissance" name="naissance" min="1950-01-01" onfocusOut="verifier_dates()" required>
					</td>
					<td>
                        <input type="text" id="ville" name="ville" onfocusOut="verifier_ville()" required>
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
						<input type="email" id="ad_email" name="ad_email" placeholder="exemple: ab_D.1@doM1n.xYz" onfocusOut="verifier_mail()" required>
					</td>
					<td>
						<input type="tel" id="phone" name="phone" maxlength="10" onfocusOut="verifier_tel()" required autocomplete="chrome-off">
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

				<!------------------------------------ Choix ------------------------------------->
				<tr>
					<td>
						<label for="choix" class="label">Choix<div class="stars">*<span class="champReq">Champ requis</span></div></label>
					</td>
				</tr>
				<tr>
					<td>
						<select id="etat" name="etat">
							<option value="2" selected>Gérant</option>
							<option value="3">Moniteur de code</option>
							<option value="4">Moniteur de conduite</option>
							<option value="1">Superviseur</option>
						</select>
					</td>
				</tr>
				<!-------------------------------------------------------------------------------->

				<!------------------------------------- Genre ------------------------------------>
				<tr>
					<td>
						<label class="label">Genre <div class="stars">*<span class="champReq">Champ requis</span></div></label>
					</td>
				</tr>

				<tr>
					<td>
						<label class="container">Male
							<input type="radio" id="male" name="genre" value="M" checked>
							<span class="checkmark"></span>
						</label>
					</td>
				</tr>

				<tr>
					<td>
						<label class="container">Femelle
							<input type="radio" id="female" name="genre" value="F">
							<span class="checkmark"></span>
						</label>
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
						<input type="password" id="mot_passe" name="mot_passe" oninput="verifier_pw()" size="35" required>
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
					<th align="right">
						<input class="btEffacer" type="reset" id="annuler" name="annuler" value="Effacer" onclick="initialiser()">
					</th>
					<th align="left">
						<button class="btValider" id="valider" name="valider" onclick="validateForm()"><span>Valider</span></button>
					</th>
				</tr>
				<!-------------------------------------------------------------------------------->

				<!--------------------------------le traitement de php --------------------------->
				<?php
					if (isset($_POST['valider'])) {
						try {
							$role=$_POST['etat'];
							$nom=$_POST['nom'];
							$prenom=$_POST['prenom'];
							$naissance=$_POST['naissance'];
							$ville=$_POST['ville'];
							$email=$_POST['ad_email'];
							$phone=$_POST['phone'];
							$genre=$_POST['genre'];
							$mot_passe=$_POST['mot_passe'];
							$requete="INSERT INTO `employee`
							(`Nom` , `Prenom` , `Naissance` , `Ville` , `Email` , `Telephone`, `Genre` , `Password`  , `id_role`, `Photo`) VALUES 
							('$nom', '$prenom', '$naissance', '$ville', '$email', '$phone'   , '$genre', '$mot_passe', '$role'  , LOAD_FILE('C:/xampp/htdocs/Projet-AutoEcole/ressource/img/index.png'));";
							$connexion->exec($requete);
							if($id_role == '2')
								echo "<script>alert(\"Votre gérant ".$nom."  ".$prenom." est créer avec sucées.\")</script>";
							else if($id_role == '3')
								echo "<script>alert(\"Votre moniteur de code ".$nom."  ".$prenom." est créer avec sucées.\")</script>";
							else if($id_role == '4')
								echo "<script>alert(\"Votre moniteur de conduite ".$nom."  ".$prenom." est créer avec sucées.\")</script>";
							else if($id_role == '1')
								echo "<script>alert(\"Votre Superviseur ".$nom."  ".$prenom." est créer avec sucées.\")</script>";

						} catch (PDOException $e) {
							echo "Erreur ! " . $e->getMessage() . "<br/>";
						}
					}
				?>
			</table>
		</form>
	</div>
	<!--------------------------------------------------- FIN DIV AJOUT EMPLOYE --------------------------------------------------------->


	<!-------------------------------------------------------- DIV REMISE -------------------------------------------------------------->
	<style type="text/css">
		.tRemise td{
			border-radius: 5px;
			width: 20px !important;
			font-size: 1.2rem;
		}
		.tRemise .mod1:hover, .tRemise .mod:hover{
			background-color: #70B373;
		}
		.mod,.ajout,.mod1{
			border: 1px solid black;
			text-align: center;
		}
		.mod1{
			background-color: #338BB7;
			font-family: 'Raleway', sans-serif;
		}
		.mod{
			background-color: #338BB7;
			font-family: 'Raleway', sans-serif;
		}
		.mod input, .mod1 input {
			color: white;
			width: 40px;
			background-color: rgba(76, 175, 80, 0);
			border-style: none;
			padding: 2px;
			font-family: 'Raleway', sans-serif;
			font-size: 1.25rem;
		}
		.rSize {
			font-size: 1.5rem;
		}
		.modTh .niveau .rSize td{
			color: white !important;
			font-weight: bold;
		}
	</style>
	<div id="divRemise" class="contain">
		<div class="liste">
			<h1>Ajouter des remises</h1>
			<center>
			  	<form method="POST" action="">
			  		<table class="tRemise" width="60%">
				  		<tr>
					  		<td></td>
					  		<td></td>
					  		<td class="modTh rSize" align="center">Chomeur</td>
					  		<td class="modTh rSize" align="center">Etudiant</td>
					  		<td class="modTh rSize" align="center">Conducteur</td>
					  	</tr>
					  	<tr>
					  		<td class="mod1" rowspan="3">Auto</td>
					  		<td class="mod1">Code</td>
					  		<td class="mod1">
					  			<?php 
									$tabR = $connexion->query("SELECT * FROM `remise` WHERE typev='auto' AND niveau='code' AND etat='chomeur';");
									$tabResR = $tabR->fetch();
									$valRemise =$tabResR['pourcentage'];
								?>
					  			<input type="number" name="auto_co_cho" value="<?php echo $valRemise; ?>" min="1" max="70" class="mod2">%
					  		</td>
					  		<td class="mod1">
					  			<?php 
									$tabR = $connexion->query("SELECT * FROM `remise` WHERE typev='auto' AND niveau='code' AND etat='etudiant';");
									$tabResR = $tabR->fetch();
									$valRemise =$tabResR['pourcentage'];
								?>
					  			<input type="number" name="auto_co_et" value="<?php echo $valRemise; ?>" min="1" max="70" class="mod2">%
					  		</td>
					  		<td class="mod1">
					  			<?php 
									$tabR = $connexion->query("SELECT * FROM `remise` WHERE typev='auto' AND niveau='code' AND etat='conducteur';");
									$tabResR = $tabR->fetch();
									$valRemise =$tabResR['pourcentage'];
								?>
		                       <input type="number" name="auto_co_co" value="<?php echo $valRemise; ?>" min="1" max="70" class="mod2">%
					  		</td>
					  	</tr>
					  	<tr>
					  		<td class="mod1">Créneau</td>
					  		<td class="mod1">
					  			<?php 
									$tabR = $connexion->query("SELECT * FROM `remise` WHERE typev='auto' AND niveau='creneau' AND etat='chomeur';");
									$tabResR = $tabR->fetch();
									$valRemise =$tabResR['pourcentage'];
								?>
					  			<input type="number" name="auto_cre_cho" value="<?php echo $valRemise; ?>" min="1" max="70" class="mod2">%
					  		</td>
					  		<td class="mod1">
					  			<?php 
									$tabR = $connexion->query("SELECT * FROM `remise` WHERE typev='auto' AND niveau='creneau' AND etat='etudiant';");
									$tabResR = $tabR->fetch();
									$valRemise =$tabResR['pourcentage'];
								?>
					  			<input type="number" name="auto_cre_et" value="<?php echo $valRemise; ?>" min="1" max="70" class="mod2">%
					  		</td>
					  		<td class="mod1">
					  			<?php 
									$tabR = $connexion->query("SELECT * FROM `remise` WHERE typev='auto' AND niveau='creneau' AND etat='conducteur';");
									$tabResR = $tabR->fetch();
									$valRemise =$tabResR['pourcentage'];
								?>
					  			<input type="number" name="auto_cre_co" value="<?php echo $valRemise; ?>" min="1" max="70" class="mod2">%
					  		</td>
					  	</tr>
					  	<tr>
					  		<td class="mod1">Circuit</td>
					  		<td class="mod1">
					  			<?php 
									$tabR = $connexion->query("SELECT * FROM `remise` WHERE typev='auto' AND niveau='circuit' AND etat='chomeur';");
									$tabResR = $tabR->fetch();
									$valRemise =$tabResR['pourcentage'];
								?>
					  			<input type="number" name="auto_cir_cho" value="<?php echo $valRemise; ?>" min="1" max="70" class="mod2">%
					  		</td>
					  		<td class="mod1">
					  			<?php 
									$tabR = $connexion->query("SELECT * FROM `remise` WHERE typev='auto' AND niveau='circuit' AND etat='etudiant';");
									$tabResR = $tabR->fetch();
									$valRemise =$tabResR['pourcentage'];
								?>
					  			<input type="number" name="auto_cir_et" value="<?php echo $valRemise; ?>" min="1" max="70" class="mod2">%
					  		</td>
					  		<td class="mod1">
					  			<?php 
									$tabR = $connexion->query("SELECT * FROM `remise` WHERE typev='auto' AND niveau='circuit' AND etat='conducteur';");
									$tabResR = $tabR->fetch();
									$valRemise =$tabResR['pourcentage'];
								?>
					  			<input type="number" name="auto_cir_co" value="<?php echo $valRemise; ?>" min="1" max="70" class="mod2">%
					  		</td>
					  	</tr>
					  	<tr>
					  		<td class="mod" rowspan="3">Manuel</td>
					  		<td class="mod">Code</td>
					  		<td class="mod">
					  			<?php 
									$tabR = $connexion->query("SELECT * FROM `remise` WHERE typev='manuel' AND niveau='code' AND etat='chomeur';");
									$tabResR = $tabR->fetch();
									$valRemise =$tabResR['pourcentage'];
								?>
					  			<input type="number" name="manu_co_cho" value="<?php echo $valRemise; ?>" min="1" max="70" class="mod2">%
					  		</td>
					  		<td class="mod">
					  			<?php 
									$tabR = $connexion->query("SELECT * FROM `remise` WHERE typev='manuel' AND niveau='code' AND etat='etudiant';");
									$tabResR = $tabR->fetch();
									$valRemise =$tabResR['pourcentage'];
								?>
					  			<input type="number" name="manu_co_et" value="<?php echo $valRemise; ?>" min="1" max="70" class="mod2">%
					  		</td>
					  		<td class="mod">
					  			<?php 
									$tabR = $connexion->query("SELECT * FROM `remise` WHERE typev='manuel' AND niveau='code' AND etat='conducteur';");
									$tabResR = $tabR->fetch();
									$valRemise =$tabResR['pourcentage'];
								?>
					  			<input type="number" name="manu_co_co" value="<?php echo $valRemise; ?>" min="1" max="70" class="mod2">%
					  		</td>
					  	</tr>
					  	<tr>
					  		<td class="mod">Créneau</td>
					  		<td class="mod">
					  			<?php 
									$tabR = $connexion->query("SELECT * FROM `remise` WHERE typev='manuel' AND niveau='creneau' AND etat='chomeur';");
									$tabResR = $tabR->fetch();
									$valRemise =$tabResR['pourcentage'];
								?>
					  			<input type="number" name="manu_cre_cho" value="<?php echo $valRemise; ?>" min="1" max="70" class="mod2">%
					  		</td>
					  		<td class="mod">
					  			<?php 
									$tabR = $connexion->query("SELECT * FROM `remise` WHERE typev='manuel' AND niveau='creneau' AND etat='etudiant';");
									$tabResR = $tabR->fetch();
									$valRemise =$tabResR['pourcentage'];
								?>
					  			<input type="number" name="manu_cre_et" value="<?php echo $valRemise; ?>" min="1" max="70" class="mod2">%
					  		</td>
					  		<td class="mod">
					  			<?php 
									$tabR = $connexion->query("SELECT * FROM `remise` WHERE typev='manuel' AND niveau='creneau' AND etat='conducteur';");
									$tabResR = $tabR->fetch();
									$valRemise =$tabResR['pourcentage'];
								?>
					  			<input type="number" name="manu_cre_co" value="<?php echo $valRemise; ?>" min="1" max="70" class="mod2">%
					  		</td>
					  	</tr>
					  	<tr>
					  		<td class="mod">Circuit</td>
					  		<td class="mod">
					  			<?php 
									$tabR = $connexion->query("SELECT * FROM `remise` WHERE typev='manuel' AND niveau='circuit' AND etat='chomeur';");
									$tabResR = $tabR->fetch();
									$valRemise =$tabResR['pourcentage'];
								?>
					  			<input type="number" name="manu_cir_cho" value="<?php echo $valRemise; ?>" min="1" max="70" class="mod2">%
					  		</td>
					  		<td class="mod">
					  			<?php 
									$tabR = $connexion->query("SELECT * FROM `remise` WHERE typev='manuel' AND niveau='circuit' AND etat='etudiant';");
									$tabResR = $tabR->fetch();
									$valRemise =$tabResR['pourcentage'];
								?>
					  			<input type="number" name="manu_cir_et" value="<?php echo $valRemise; ?>" min="1" max="70" class="mod2">%
					  		</td>
					  		<td class="mod">
					  			<?php 
									$tabR = $connexion->query("SELECT * FROM `remise` WHERE typev='manuel' AND niveau='circuit' AND etat='conducteur';");
									$tabResR = $tabR->fetch();
									$valRemise =$tabResR['pourcentage'];
								?>
					  			<input type="number" name="manu_cir_co" value="<?php echo $valRemise; ?>" min="1" max="70" class="mod2">%
					  		</td>
					  	</tr>
					</table>
					<button class="btValider" name="appliquerRemise" ><span>Appliquer</span></button>
				</form>
			</center>
			<?php
                if (isset($_POST['appliquerRemise'])) {
	                $auto_code_cho=$_POST['auto_co_cho'];
	                $auto_code_et=$_POST['auto_co_et'];      
	                $auto_code_co=$_POST['auto_co_co'];      
	                $auto_creno_cho=$_POST['auto_cre_cho'];   
	                $auto_creno_et=$_POST['auto_cre_et'];
	                $auto_creno_co=$_POST['auto_cre_co'];
	                $auto_circuit_cho=$_POST['auto_cir_cho'];
	                $auto_circuit_et=$_POST['auto_cir_et'];
	                $auto_circuit_co=$_POST['auto_cir_co'];

	                $manuel_code_cho=$_POST['manu_co_cho'];
	                $manuel_code_et=$_POST['manu_co_et'];
	                $manuel_code_co=$_POST['manu_co_co'];
	                $manuel_creno_cho=$_POST['manu_cre_cho'];
	                $manuel_creno_et=$_POST['manu_cre_et'];
	                $manuel_creno_co=$_POST['manu_cre_co'];
	                $manuel_circuit_cho=$_POST['manu_cir_cho'];
	                $manuel_circuit_et=$_POST['manu_cir_et'];
	                $manuel_circuit_co=$_POST['manu_cir_co'];

	                $insertRemise=$connexion->prepare("UPDATE `remise` SET `pourcentage`=? WHERE `typev`=? AND `niveau`=? AND `etat`=?");
	                $insertRemise->execute([$auto_code_cho, 'auto', 'code', 'chomeur' ]);
	                $insertRemise->execute([$auto_code_et, 'auto', 'code', 'etudiant' ]);
	                $insertRemise->execute([$auto_code_co, 'auto', 'code', 'conducteur' ]);
	                $insertRemise->execute([$auto_creno_cho, 'auto', 'creneau', 'chomeur' ]);
	                $insertRemise->execute([$auto_creno_et, 'auto', 'creneau', 'etudiant' ]);
	                $insertRemise->execute([$auto_creno_co, 'auto', 'creneau', 'conducteur' ]);
	                $insertRemise->execute([$auto_circuit_cho, 'auto', 'circuit', 'chomeur' ]);
	                $insertRemise->execute([$auto_circuit_et, 'auto', 'circuit', 'etudiant' ]);
	                $insertRemise->execute([$auto_circuit_co, 'auto', 'circuit', 'conducteur' ]);
	                $insertRemise->execute([$manuel_code_cho, 'manuel', 'code', 'chomeur' ]);
	                $insertRemise->execute([$manuel_code_et, 'manuel', 'code', 'etudiant' ]);
	                $insertRemise->execute([$manuel_code_co, 'manuel', 'code', 'conducteur' ]);
	                $insertRemise->execute([$manuel_creno_cho, 'manuel', 'creneau', 'chomeur' ]);
	                $insertRemise->execute([$manuel_creno_et, 'manuel', 'creneau', 'etudiant' ]);
	                $insertRemise->execute([$manuel_creno_co, 'manuel', 'creneau', 'conducteur' ]);
	                $insertRemise->execute([$manuel_circuit_cho, 'manuel', 'circuit', 'chomeur' ]);
	                $insertRemise->execute([$manuel_circuit_et, 'manuel', 'circuit', 'etudiant' ]);
	                $insertRemise->execute([$manuel_circuit_co, 'manuel', 'circuit', 'conducteur' ]);
	                echo "<script>window.location.href='superviseur.php?open=ajouterRemise'</script>";
                 }
            ?>

			<?php
				$test1=$connexion->query("SELECT * FROM `candidat` where tarif>'0' AND etat!='normal' AND remise=0 Order by Nom ASC");
				if ($test1->rowCount() > 0) {		
			?>
				<form method="POST" method="">
					<button name="remise" class="btRemise">Appliquer les remises</button>
				</form>
				<table class="modTable">
					<tr class="modRow" >
						<th class="modTh"></th>
						<th class="modTh">Nom et Prénom</th>
						<th class="modTh">Etat</th>
						<th class="modTh">Niveau</th>
						<th class="modTh">Type de voiture</th>
						<th class="modTh">Tarif</th>
						<th class="modTh">Tarif avec remise</th>
					</tr>

					<?php
						$resultat=$connexion->query("SELECT * FROM `candidat` where tarif>'0' AND etat!='normal' AND remise=0 Order by Nom ASC");
						while ($row=$resultat->fetch()) {
							$id_can=$row['id_c'];
							$photo=$row['Photo'];
							$nom=$row['Nom'];
							$prenom=$row['Prenom'];
							$niveau=$row['niveau'];
							$catg=$row['categorie'];
							$etat=$row['Etat'];
							$typev=$row['TypeV'];
							$tarif=$row['tarif'];
					?>

					<tr class="modTr">
						<td class="modTd"><?php echo '<img class="cadre" src="data:image/jpeg;base64,'.base64_encode($photo).'"/>'; ?></td>
						<td class="modTd"><?php echo ucfirst($nom);echo " ";echo ucfirst($prenom); ?></td>
						<td class="modTd"><?php echo ucfirst($etat); ?></td>
						<td class="modTd"><?php echo ucfirst($niveau); ?></td>
						<td class="modTd"><?php echo ucfirst($typev); ?></td>
						<td class="modTd"><?php echo $tarif; ?> DA</td>
						<?php 
							if ($etat != 'normal') {
								$res = $connexion->query("SELECT * FROM `remise` WHERE typev='$typev' AND niveau='$niveau' AND etat='$etat';");
								$res = $res->fetch();
								$pct =$res['pourcentage'];
							}
						?>
						<td class="modTd"><span class="niveau"><?php echo ($tarif-($tarif*$pct)/100); ?> DA</span></td>
					</tr>

					<?php
					
						if (isset($_POST['remise'])) {

							$resultat=$connexion->query("SELECT * FROM `candidat` where tarif>'0' AND etat!='normal' AND remise=0");
							while ($rowR=$resultat->fetch()){

								$currTarif=$rowR['tarif'];
								$currRestant=$rowR['restant'];
								$niveauR=$row['niveau'];
								$typevR=$row['TypeV'];
								$etatR=$row['Etat'];

								$idc_remise=$rowR['id_c'];

								$resR = $connexion->query("SELECT * FROM `remise` WHERE typev='$typevR' AND niveau='$niveauR' AND etat='$etatR';");
								$resR = $resR->fetch();
								$pctR =$resR['pourcentage'];

								$nvTarif = ($currTarif-($currTarif*$pctR)/100);
								$nvRestant = ($currRestant-($currTarif*$pctR)/100);
								if ($nvRestant < 0) {
									$resRemise=$connexion->query("UPDATE `candidat` SET tarif='$nvTarif', restant=0, remise=1 where id_c='$idc_remise'");

									$message="Vous avez reçu un Réduction de " . ($currTarif*$pctR)/100 . " DA !";
									$date_m=date('U');
									$resultat2=$connexion->query("INSERT INTO notification (`name`,`message`,`status`,`date`,`id_candidat`) VALUES('Réduction de prix','$message','0','$date_m','$idc_remise')");
									echo "<script>if(confirm(\"Remises appliquées\")){document.location.href='superviseur.php'};</script>";
								}
								else {
									$resRemise=$connexion->query("UPDATE `candidat` SET tarif='$nvTarif', restant='$nvRestant', remise=1 where id_c='$idc_remise'");

									$message="Vous avez reçu un Réduction de " . ($currTarif*$pctR)/100 . " DA !";
									$date_m=date('U');
									$resultat2=$connexion->query("INSERT INTO notification (`name`,`message`,`status`,`date`,`id_candidat`) VALUES('Réduction de prix','$message','0','$date_m','$idc_remise')");
									echo "<script>if(confirm(\"Remises appliquées\")){document.location.href='superviseur.php'};</script>";
								}
							}
						}
						}
					?>
				</table>
			<?php
				}
				else {
					echo "<br><span class='niveau'>Les remises ont dejà été appliqué et/ou aucun autre candidat n'est éligible pour une remise.</span><br>";
				}
			?>
		</div>
	</div>
	<!------------------------------------------------------ FIN DIV REMISE ------------------------------------------------------------->


	<!--------------------------------------------------------- DIV PAIMENT ------------------------------------------------------------->
	<div id="divPaiementx" class="sub_liste">
		<?php
		///////////////and resultat.date_examen=(SELECT max(date_examen) from candidat,resultat where candidat.id_c=resultat.id_c)
		        //////////////////////////////////////////remplir les frait de permis/////////////////////////
                 require_once('../db_connexion.php');
                 $requete1="SELECT * from candidat,resultat where candidat.id_c=resultat.id_c and date_examen=(select MAX(date_examen) FROM resultat)";
						$resultat1=$connexion->query($requete1);
						while ($row=$resultat1->fetch()){
							$id_ca=$row['id_c'];
                            $nom_c=$row['Nom'];
							$prenom=$row['Prenom'];
							$typev=$row['TypeV'];
							$niveau=$row['niveau'];
							$payee=$row['payee'];
							$tarif=$row['tarif'];
							$restant1=$row['restant'];
							$catg=$row['categorie'];
							$note=$row['note_examen'];
						    $nom=$row['nom_examen'];
						  
						   
						    $res=$connexion->query("SELECT * from resultat where id_c='$id_ca' and operation_examen='0'");

                           if ($res->rowCount() >0) {
                           
                   if($nom!="test" && $note=="réussi")       
                     {

                     }

                  else  if ($nom=="test" && $note=="echoué") {
                    	
                     /*	if ($tarif=='6000') {

                     		$a=$payee-6000;
                     		if ($a=='0') {
                     			$requete="UPDATE `candidat` SET payee='0.00',restant='1000',tarif='1000' where id_c='$id_ca' and niveau='code'  and categorie='B' and payee='6000' and restant='0' and tarif='6000' and TypeV='auto'";
					            $resultat=$connexion->query($requete);
                     		}else if($a>'0'){
                     		$b=1000-$a;	  
                     		   	 $requete="UPDATE `candidat` SET payee='$a',restant='$b',tarif='1000' where id_c='$id_ca' and niveau='code'  and categorie='B' and restant='0' and payee>'6000' and tarif='6000' and TypeV='auto'";
					            $resultat=$connexion->query($requete);
                     		  }
                     	}else if ($tarif=='7000') {
                     		$za=$payee-7000;
                     		 echo $tarif;
                     		 echo $za;
                     		  if ($za=='0') {
                     		  	$requete="UPDATE `candidat` SET payee='0',restant='1500',tarif='1500' where id_c='$id_ca' and TypeV='manuel' and restant='0' and payee='7000' and tarif='7000' and niveau='code'";
					         	$resultat=$connexion->query($requete);
                     		  }
                     		  else if($za>'0'){
                     		    $ec=1500-$za;
                     		   	$requete="UPDATE `candidat` SET payee='$za',restant='$ec',tarif='1500' where id_c='$id_ca' and TypeV='manuel' and restant='0'  and payee>'7000' and tarif='7000' and niveau='code' and categorie='B'";
					         	$resultat=$connexion->query($requete);
                     		  }
                     	}else if ($tarif=='1000') {
                     		$result=$connexion->query("UPDATE resultat SET operation_examen='1' where id_c='$id_ca'");
                     		$ss=$payee-1000;
                     		
                     		   if ($ss=='0') {
                     		   	$requete="UPDATE `candidat` SET payee='0.00',restant='1000',tarif='1000' where id_c='$id_ca' and niveau='code' and restant='0' and payee='1000' and tarif='1000' and categorie='B' and TypeV='auto'";
					           $resultat=$connexion->query($requete);
                     		 
                     		   }else if($ss>'0'){
                     		    $se=1000-$ss;
                     		    $requete="UPDATE `candidat` SET payee='$ss',restant='$se',tarif='1000' where id_c='$id_ca' and niveau='code' and restant='0' and payee>'1000' and tarif='1000' and categorie='B' and TypeV='auto'";
					           $resultat=$connexion->query($requete);
                     		   }
                     	}else if ($tarif=='1500') {
                     		$result=$connexion->query("UPDATE resultat SET operation_examen='1' where id_c='$id_ca'");
                     		 $aa=$payee-1500;
                     	    
                     	       if ($aa=='0') {
                     	       $requete="UPDATE `candidat` SET payee='0.00',restant='1500',tarif='1500' where id_c='$id_ca' and TypeV='manuel' and restant='0' and payee='1500' and tarif='1500' and niveau='code' and categorie='B'";
					         	 $resultat=$connexion->query($requete);
                     	       }
                     	         
                     	     else if ($aa>'0') {
                     	     
                     	     	 $l=1500-$aa;
                     	      $requete="UPDATE `candidat` SET payee='$aa',restant='$l',tarif='1500' where id_c='$id_ca' and TypeV='manuel' and restant='0' and payee>'1500' and tarif='1500' and niveau='code' and categorie='B'";
					         	 $resultat=$connexion->query($requete);
                     	    }
                     	}
                     		*/
                     	
                     		

                     		

                     
                     	  
                     	
                     }else if ($nom=="test" && $note=="réussi") {
                     	$requete="UPDATE `candidat` SET restant='0' where id_c='$id_ca' and niveau='code' and restant='0' and categorie='B' and TypeV='auto'";
					            $resultat=$connexion->query($requete);

                        $requete="UPDATE `candidat` SET restant='0' where id_c='$id_ca' and TypeV='manuel' and niveau='code' and restant='0' and categorie='B'";
					            $resultat=$connexion->query($requete);
                     } else{

                     		//////////////// voiture boite auto ///////////////
                if ($typev=='auto') {
                     	  	 $message="tu est echoue dans l'examen . il faut payee 3000 DA dans les plus bref dellaits";
                             $date_m=date('U');
                              $resultat2=$connexion->query("INSERT INTO notification (`name`,`message`,`status`,`date`,`id_candidat`) VALUES('$nom_c','$message','0','$date_m','$id_ca')");
                        if ($tarif=='6000') 
                        {
                     		$w=$payee-6000;
                     		   
                     		if ($w=='0') {
                     			 $requete="UPDATE `candidat` SET payee='0.00',restant='3000',tarif='3000' where id_c='$id_ca' and restant='0' and niveau='code' and tarif='6000'  and categorie='B' and TypeV='auto'";
					        $resultat=$connexion->query($requete);
                     		}else if($w>'0'){
                     				$we=3000-$w;
                     		 $requete="UPDATE `candidat` SET payee='$w',restant='$we',tarif='3000' where id_c='$id_ca' and restant='0' and niveau='code' and tarif='6000'  and categorie='B' and TypeV='auto'";
                     		
					        $resultat=$connexion->query($requete);
                     		}
                     	}
                     	else if ($tarif=='7000') 
                     	{
                     		$x=$payee-7000;
                     		
                     		if ($x=='0') {
                     			$requete="UPDATE `candidat` SET payee='0.00',restant='3000',tarif='3000' where id_c='$id_ca' and restant='0' and niveau='creneau'  and tarif='7000' and categorie='B' and TypeV='auto'";
					        $resultat=$connexion->query($requete);
					        $requete="UPDATE `candidat` SET payee='0.00',restant='3000',tarif='3000' where id_c='$id_ca' and restant='0' and niveau='circuit'  and tarif='7000' and categorie='B' and TypeV='auto'";
					        $resultat=$connexion->query($requete);
                     		}else if($x>'0')
                     		{
                              $xe=3000-$x;
                     		
                     		$requete="UPDATE `candidat` SET payee='$x',restant='$xe',tarif='3000' where id_c='$id_ca' and restant='0' and niveau='creneau'  and tarif='7000' and categorie='B' and TypeV='auto'";
					        $resultat=$connexion->query($requete);
					        $requete="UPDATE `candidat` SET payee='$x',restant='$xe',tarif='3000' where id_c='$id_ca' and restant='0' and niveau='circuit'  and tarif='7000' and categorie='B' and TypeV='auto'";
					        $resultat=$connexion->query($requete);
                     		}
                     	}
                        else if ($tarif=='3000')
                         {
                        	$result=$connexion->query("UPDATE resultat SET operation_examen='1' where id_c='$id_ca'");
                     		$v=$payee-3000;
                     		
                     		if ($v=='0') {
                     		$requete="UPDATE `candidat` SET payee='0.00',restant='3000',tarif='3000' where id_c='$id_ca' and restant='0' and niveau='code' and $tarif='3000' and categorie='B' and TypeV='auto'";
					        $resultat=$connexion->query($requete);
					        $requete="UPDATE `candidat` SET payee='0.00',restant='3000',tarif='3000' where id_c='$id_ca' and restant='0' and niveau='creneau' and $tarif='3000' and categorie='B' and TypeV='auto'";
					        $resultat=$connexion->query($requete);
					         $requete="UPDATE `candidat` SET payee='0.00',restant='3000',tarif='3000' where id_c='$id_ca' and restant='0' and niveau='circuit' and $tarif='3000' and categorie='B' and TypeV='auto'";
					        $resultat=$connexion->query($requete);
					          $result=$connexion->query("UPDATE resultat SET operation_examen='1' where id_c='$id_ca'");
                     		}
                     		else if ($v>'0'){
                     			$ve=3000-$v;
                     		$requete="UPDATE `candidat` SET payee='$v',restant='$ve',tarif='3000' where id_c='$id_ca' and restant='0' and niveau='code' and $tarif='3000' and categorie='B' and TypeV='auto'";
					        $resultat=$connexion->query($requete);
					        $requete="UPDATE `candidat` SET payee='$v',restant='$ve',tarif='3000' where id_c='$id_ca' and restant='0' and niveau='creneau' and $tarif='3000' and categorie='B' and TypeV='auto'";
					        $resultat=$connexion->query($requete);
					         $requete="UPDATE `candidat` SET payee='$v',restant='$ve',tarif='3000' where id_c='$id_ca' and restant='0' and niveau='circuit' and $tarif='3000' and categorie='B' and TypeV='auto'";
					        $resultat=$connexion->query($requete);
					          $result=$connexion->query("UPDATE resultat SET operation_examen='1' where id_c='$id_ca'");
					        }
                     	}
                     	 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                 }
            else if ($typev=='manuel') {
            	 ///////////////////////////////////////////////////////////////////// voiture boite manuel ////////////////////////////////////////////////////////////////////////////////
                     	   $message="tu est echoue dans l'examen . il faut payee 4000 DA dans les plus bref dellaits ";
                           $date_m=date('U');
                           $resultat2=$connexion->query("INSERT INTO notification (`name`,`message`,`status`,`date`,`id_candidat`) VALUES('$nom_c','$message','0','$date_m','$id_ca')");


                           if ($tarif=='7000') 
                        {
                        	$po=$payee-7000;
                        	
                        	if ($po=='0') {
                        		$requete="UPDATE `candidat` SET payee='0.00',restant='4000',tarif='4000' where id_c='$id_ca' and restant='0' and niveau='code' and tarif='7000' and TypeV='manuel' and categorie='B'";
					        $resultat=$connexion->query($requete);
                        	}
                        	else if ($po>'0'){
                               $poo=4000-$po;
                               $requete="UPDATE `candidat` SET payee='$po',restant='$poo',tarif='4000' where id_c='$id_ca' and restant='0' and niveau='code' and tarif='7000' and TypeV='manuel' and categorie='B'";
					        $resultat=$connexion->query($requete);
                        	}
                        	
                          }

                        else if ($tarif=='8000') {
                        	$dee=$payee-8000;
                        	
                        	if ($dee=='0') {
                        		$requete="UPDATE `candidat` SET payee='0.00',restant='4000',tarif='4000' where id_c='$id_ca' and restant='0' and niveau='creneau' and tarif='8000' and categorie='B' and TypeV='manuel' ";
					        $resultat=$connexion->query($requete);
					         $requete="UPDATE `candidat` SET payee='0.00',restant='4000',tarif='4000' where id_c='$id_ca' and restant='0' and niveau='circuit' and tarif='8000' and categorie='B' and TypeV='manuel'";
					        $resultat=$connexion->query($requete);
                        	}else if ($dee>'0') {
                        	
                        		$deee=4000-$dee;
                        	$requete="UPDATE `candidat` SET payee='$dee',restant='$deee',tarif='4000' where id_c='$id_ca' and restant='0' and niveau='creneau' and tarif='8000' and categorie='B' and TypeV='manuel' ";
					        $resultat=$connexion->query($requete);
					          $requete="UPDATE `candidat` SET payee='$dee',restant='$deee',tarif='4000' where id_c='$id_ca' and restant='0' and niveau='circuit' and tarif='8000' and categorie='B' and TypeV='manuel'";
					        $resultat=$connexion->query($requete);
					        }
                        }
                        else if ($tarif=='4000') {
                            $result=$connexion->query("UPDATE resultat SET operation_examen='1' where id_c='$id_ca'");
                        	$nn=$payee-4000;
                        	 
                            if ($nn=='0') {
                            	$requete="UPDATE `candidat` SET payee='0.00',restant='4000',tarif='4000' where id_c='$id_ca' and restant='0' and niveau='code' and tarif='4000' and TypeV='manuel' and categorie='B'";
					        $resultat=$connexion->query($requete);
					         $requete="UPDATE `candidat` SET payee='0.00',restant='4000',tarif='4000' where id_c='$id_ca' and restant='0' and niveau='creneau' and tarif='4000' and categorie='B' and TypeV='manuel' ";
					        $resultat=$connexion->query($requete);
					         $requete="UPDATE `candidat` SET payee='0.00',restant='4000',tarif='4000' where id_c='$id_ca' and restant='0' and niveau='circuit' and tarif='4000' and categorie='B' and TypeV='manuel' ";
					        $resultat=$connexion->query($requete);
					        
                            }
                            else if($nn>'0'){
                            	$nne=4000-$nn;
                        	 $requete="UPDATE `candidat` SET payee='$nn',restant='$nne',tarif='4000' where id_c='$id_ca' and restant='0' and niveau='code' and tarif='4000' and TypeV='manuel' and categorie='B'";
                           
					        $resultat=$connexion->query($requete);
					         $requete="UPDATE `candidat` SET payee='$nn',restant='$nne',tarif='4000' where id_c='$id_ca' and restant='0' and niveau='creneau' and tarif='4000' and categorie='B' and TypeV='manuel' ";
					        $resultat=$connexion->query($requete);
					         $requete="UPDATE `candidat` SET payee='$nn',restant='$nne',tarif='4000' where id_c='$id_ca' and restant='0' and niveau='circuit' and tarif='4000' and categorie='B' and TypeV='manuel' ";
					        $resultat=$connexion->query($requete);
					         
					       }

                        }
                     	  }
                     	   /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                    }

					 }else{
					 	 $requete="UPDATE `candidat` SET payee='$payee',restant='0',tarif='$tarif' where id_c='$id_ca' and restant='0' ";
					        $resultat=$connexion->query($requete);
					 }        
					   
                 }

		?>
		<h1>Paiements des candidats</h1>
		<table class="modTable">
			<tr class="modRow" >
				<th class="modTh"></th>
				<th class="modTh">Nom et Prénom</th>
				<th class="modTh">Type Voiture</th>
				<th class="modTh">Niveau</th>
				<th class="modTh">Résultat exam</th>
				<th class="modTh">Payée</th>
				<th class="modTh">Restant</th>
				<th class="modTh">Tarif</th>
			</tr>
			<?php
				require_once('../db_connexion.php');
					$resultat=$connexion->query("SELECT  candidat.id_c, candidat.Nom, candidat.Prenom, candidat.TypeV, candidat.Photo, candidat.niveau, candidat.payee, candidat.restant, candidat.tarif, candidat.categorie from candidat  Order by Nom ASC");

					while ($row=$resultat->fetch()){
					  	$photo=$row['Photo'];
					    $id_con=$row['id_c'];
				        $nom=$row['Nom'];
						$prenom=$row['Prenom'];
						$typev=$row['TypeV'];
						$niveau=$row['niveau'];
						$payee=$row['payee'];
						$restant=$row['restant'];
						$m=$row['tarif'];
                     
                    $resultat1=$connexion->query("SELECT * FROM `resultat` WHERE id_c='$id_con' and date_examen=(SELECT MAX(date_examen) from resultat) AND nom_examen='$niveau'");
						while ($row=$resultat1->fetch()) {
							$note=$row['note_examen'];
							$n=$row['nom_examen'];
						}
						if ($resultat1->rowCount() == 0) {
							$note = "/";
							$n="";
						}
			?>

			<tr class="modTr">
				<td class="modTd"><?php echo '<img class="cadre" src="data:image/jpeg;base64,'.base64_encode($photo).'"/>'; ?></td>
				<td class="modTd"><?php echo ucfirst($nom); echo " "; echo ucfirst($prenom);?></td>
				<td class="modTd"><?php echo ucfirst($typev);?></td>
				<td class="modTd"><?php echo ucfirst($niveau);?></td>
				<td class="modTd"><?php echo ucfirst($note) ?></td>
				<td class="modTd"><?php echo $payee;?>DA</td>
				<td class="modTd"><?php echo $restant;?>DA </td>
				<td class="modTd"><?php echo $m; ?>DA</td>

				<td>
					<form method="POST">
						<input type="hidden" name="id_c" value="<?php  echo  $id_con; ?>">
						<input type="text" name="solde" size="8%" >
				</td>
				<td class="buttonSized">
						<button name="payer_c" class="payer"><i class="las la-coins"></i></button>
					</form>
				</td>

				<td class="buttonSized">
					<form method="POST" action="historique.php">
						<input type="hidden" name="id" value="<?php  echo $id; ?>">
						<input type="hidden" name="id_c" value="<?php  echo  $id_con; ?>">
						<button name="historique_p"  class="supprim"><i class="las la-history"></i></button>
					</form>
				</td>
			</tr>
			<?php
			} // close while loop
                   

					if (isset($_POST['payer_c'])){
						$id_cc=$_POST['id_c'];
						$solde=$_POST['solde'];
                        
                       	if ($solde>='0') {
                        	
                       
						$requete="SELECT * from `candidat` where id_c='$id_cc'";
						$resultat=$connexion->query($requete);
						while ($row=$resultat->fetch()){
							$id_ccccc=$row['id_c'];
							$nom=$row['Nom'];
							$prenom=$row['Prenom'];
							$typev=$row['TypeV'];
							$niveau=$row['niveau'];
							$payee=$row['payee'];
							$restant=$row['restant'];
							$catg=$row['categorie'];
                            $tarif=$row['tarif'];
						    $prix_p=$solde+$payee;
						    $prix_r=$restant-$solde;
					       
                            $date = date('Y-m-d');
                            $heure = date('H:i');
                            
		                    if ($prix_r<'0') {
		                    	
			                    $requete="UPDATE `candidat` SET payee='$prix_p', restant='0', niveau='$niveau' WHERE id_c='$id_ccccc'";
							    $resultat=$connexion->query($requete);
	                              
							      
						        $resultat1=$connexion->query("INSERT INTO `paiement` (`Montant`,`date_paiment`,`heur`,`id_c`) VALUES ('$solde','$date','$heure','$id_ccccc')");
	                           	$nini=-$prix_r;
	                            $titreNotif = "Mise à jour paiement";
	                            $message="Votre paiement de " . $solde . " DA a bien été reçu. Le surplus de " . -$prix_r . " DA sera déduit du prix de la prochaine étape.<br>Le prix de l\'étape actuelle, qui est de ".$tarif." DA a été totalement payé.";
	                            $date_m=date('U');
	                            $resultat2=$connexion->query("INSERT INTO notification (`name`,`message`,`status`,`date`,`id_candidat`) VALUES('$titreNotif','$message','0','$date_m','$id_ccccc')");

	                            echo "<script>if(confirm(\"".$nom." ".$prenom." vous a payé ".$solde." DA dont ".-$prix_r." DA sera ajouté à la prochaine étape.\")){document.location.href='superviseur.php'};</script>";

		                    }else{
		                    	$resultat1=$connexion->query("INSERT INTO `paiement` (`Montant`,`date_paiment`,`heur`,`id_c`) VALUES ('$solde','$date','$heure','$id_ccccc')");
			                    $requete="UPDATE `candidat` SET payee='$prix_p', restant='$prix_r', niveau='$niveau' WHERE id_c='$id_ccccc'";
							    $resultat=$connexion->query($requete);
                              	$titreNotif = "Mise à jour paiement";
                              	$message="Votre paiement de " . $solde . " DA a bien été reçu. Somme restante à payer : " . ($restant-$solde) . " DA<br>Montant total : ".$tarif." DA<br>";
                                $date_m=date('U');
                                $resultat2=$connexion->query("INSERT INTO notification (`name`,`message`,`status`,`date`,`id_candidat`) VALUES('$titreNotif','$message','0','$date_m','$id_ccccc')");
		            
						 		echo "<script>if(confirm(\"".$nom." ".$prenom." vous a payé ".$solde." DA avec succès\")){document.location.href='superviseur.php'};</script>";
                       		}
						}
					} 
					else{
					 	echo "<script>if(confirm(\"Erreur! le montant ne peut pas être negatif.\")){document.location.href='superviseur.php'};</script>";
					}	
                }    
			?>
		</table>
	</div>
	<!------------------------------------------------------- Fin DIV PAIMENT ----------------------------------------------------------->


	<!-------------------------------------------------------- DIV PAIMENT 2 ------------------------------------------------------------>
	<div id="divPaiementx2" class="sub_liste">
		<h1>Paiements des gérant</h1>
		<table class="modTable">
			<tr class="modRow" >
				<th class="modTh"></th>
				<th class="modTh">Nom et Prénom</th>
				<th class="modTh">Nombre d'absence</th>
				<th class="modTh">Salaire</th>
				<th class="modTh"></th>
			</tr>

			<?php
				try {
					$resultat=$connexion->query("SELECT * FROM employee,role WHERE employee.id_role=role.id_role AND nom_role='gerant'  Order by Nom ASC");
					while ($row=$resultat->fetch()) {
						$photo=$row['Photo'];
						$nom=$row['Nom'];
						$prenom=$row['Prenom'];
						$salaire=$row['salaire'];
						$nbr_abs=$row['nbr_abs'];
			?>

			<tr class="modTr">
				<td class="modTd"><?php echo '<img class="cadre" src="data:image/jpeg;base64,'.base64_encode($photo).'"/>'; ?></td>
				<td class="modTd"><?php echo $nom;?> <?php echo $prenom;?></td>
				<td class="modTd"><?php echo $nbr_abs;?></td>
				<td class="modTd"><?php echo $salaire;?> DA</td>
				<td class="modTd">
					<form method="POST">
						<input type="hidden" name="id_g" value="<?php  echo $row['id']; ?>">
						<input class="ab" type="text" name="montant" size="8%">
				</td>
				<td class="buttonSized">
						<button name="payer_g" class="payer"><i class="las la-coins"></i></button>
						
				</td>
				<td class="buttonSized">
						<button name="elenver_g" class="supprim"><i class="las la-undo"></i></button>
					</form>
				</td>
				<?php

					if (isset($_POST['payer_g'])){
						$id_g=$_POST['id_g'];
						$montant=$_POST['montant'];

						if ($montant >0 ) {
							$requete="SELECT * FROM `employee` WHERE id='$id_g'";
							$resultat=$connexion->query($requete);
							while ($row=$resultat->fetch()){
								$id_gg=$row['id'];
								$nom=$row['Nom'];
								$prenom=$row['Prenom'];
								$salaire=$row['salaire'];
							}

							$prix=$montant+$salaire;
							

							$requete="UPDATE `employee` SET salaire='$prix' WHERE id='$id_gg'";
							$resultat=$connexion->query($requete);
							$titreNotif = "Mise à jour salaire";
							$message="Votre salaire à été mis à jour, votre nouveau salaire est :".$prix." DA";
	                        $date_m=date('U');
	                        $resultat2=$connexion->query("INSERT INTO notification (`name`,`message`,`status`,`date`,`id_employee`) VALUES('$titreNotif ','$message','0','$date_m','$id_gg')");

							echo "<script>if(confirm(\" Le nouveau salaire de ".$nom." ".$prenom." est ".$prix ."DA \")){document.location.href='superviseur.php'};</script>";
						}
						else {
							echo "<script>if(confirm(\" Erreur! le montant ne peut pas être negatif. \")){document.location.href='superviseur.php'};</script>";
						}

						

					}else if (isset($_POST['elenver_g'])){
						$id_g=$_POST['id_g'];

						$requete="SELECT * FROM `employee` WHERE id='$id_g'";
						$resultat=$connexion->query($requete);
						while ($row=$resultat->fetch()){
							$id_gg=$row['id'];
							$nom=$row['Nom'];
							$prenom=$row['Prenom'];
                            $salaire=$row['salaire'];
						}

						$requete="UPDATE `employee` SET salaire='0' WHERE id='$id_gg'";
						$resultat=$connexion->query($requete);
                    	echo "<script>if(confirm(\"Le salaire de ".$nom." ".$prenom." a été remis à zéro.\")){document.location.href='superviseur.php'};</script>";
					}
					
					} // close while loop
				}catch (PDOException $e) { 
					echo "Erreur ! " . $e->getMessage() . "<br/>";
				}
			?>
			</tr>
		</table>
	</div>
	<!------------------------------------------------------ Fin DIV PAIMENT 2 ---------------------------------------------------------->


	<!-------------------------------------------------------- DIV PAIMENT 3 ------------------------------------------------------------>
	<div id="divPaiementx3" class="sub_liste">
		<h1>Paiements des moniteurs de Code</h1>
		<table class="modTable">
			<tr class="modRow" >
				<th class="modTh"></th>
				<th class="modTh">Nom et Prénom</th>
				<th class="modTh">Nombre d'absence</th>
				<th class="modTh">Nombre de candidat</th>
				<th class="modTh">Salaire</th>
				<th class="modTh"></th>
			</tr>

			<?php
				try {
					require_once('../db_connexion.php');
					$resultat=$connexion->query("SELECT * FROM employee,role WHERE employee.id_role=role.id_role AND nom_role='moniteurcode'  Order by Nom ASC");
					while ($row=$resultat->fetch()) {
						$photo=$row['Photo'];
						$nom=$row['Nom'];
						$prenom=$row['Prenom'];
						$salaire=$row['salaire'];
						$nbr_abs=$row['nbr_abs'];
						$nbr_c=$row['Nbr_c'];
			?>

			<tr class="modTr">
				<td class="modTd"><?php echo '<img class="cadre" src="data:image/jpeg;base64,'.base64_encode($photo).'"/>'; ?></td>
				<td class="modTd"><?php echo $nom;?> <?php echo $prenom;?></td>
				<td class="modTd"><?php echo $nbr_abs;?></td>
				<td class="modTd"><?php echo $nbr_c;?></td>
				<td class="modTd"><?php echo $salaire;?> DA</td>
				<td class="modTd">
					<form method="POST">
						<input type="hidden" name="id_code" value="<?php  echo $row['id']; ?>">
						<input class="ab" type="text" name="montant" size="8%">
				</td>
				<td class="buttonSized">
						<button name="payer_code" class="payer"><i class="las la-coins"></i></button>
						
				</td>
				<td class="buttonSized">
						<button name="elenver_code" class="supprim"><i class="las la-undo"></i></button>
					</form>
				</td>
					
				<?php

					if (isset($_POST['payer_code'])){
						$id_code=$_POST['id_code'];
						$montant=$_POST['montant'];
						if ($montant >0 ) {
							$requete="SELECT * FROM `employee` WHERE id='$id_code'";
							$resultat=$connexion->query($requete);
							while ($row=$resultat->fetch()){
								$nom=$row['Nom'];
								$prenom=$row['Prenom'];
								$salaire=$row['salaire'];
							}

							$prix=$montant+$salaire;
							
							$requete="UPDATE `employee` SET salaire='$prix' WHERE id= '$id_code'";
							$resultat=$connexion->query($requete);
	                        $titreNotif = "Mise à jour salaire";
							$message="Votre salaire à été mis à jour, votre nouveau salaire est :".$prix." DA";
	                        $date_m=date('U');
	                        $resultat2=$connexion->query("INSERT INTO notification (`name`,`message`,`status`,`date`,`id_employee`) VALUES('$titreNotif','$message','0','$date_m','$id_code')");

							echo "<script>if(confirm(\"Le nouveau salaire de ".$nom." ".$prenom." est ".$prix ." DA\")){document.location.href='superviseur.php'};</script>";
						}
						else {
							echo "<script>if(confirm(\" Erreur! le montant ne peut pas être negatif. \")){document.location.href='superviseur.php'};</script>";
						}

					}else if (isset($_POST['elenver_code'])){
						$id_code=$_POST['id_code'];

						$requete="SELECT * FROM `employee` WHERE id='$id_code'";
						$resultat=$connexion->query($requete);
						while ($row=$resultat->fetch()){
							$nom=$row['Nom'];
							$prenom=$row['Prenom'];
                            $salaire=$row['salaire'];
						}
                    	
						$requete="UPDATE `employee` SET salaire='0' WHERE id='$id_code'";
						$resultat=$connexion->query($requete);
                       
                        echo "<script>if(confirm(\"Le salaire de ".$nom." ".$prenom." a été remis à zéro.\")){document.location.href='superviseur.php'};</script>";
					}
					} // close while loop
				}catch (PDOException $e) { 
					echo "Erreur ! " . $e->getMessage() . "<br/>";
				}
			?>
			</tr>
		</table>
	</div>
	<!------------------------------------------------------ Fin DIV PAIMENT 3 ---------------------------------------------------------->


	<!-------------------------------------------------------- DIV PAIMENT 4 ------------------------------------------------------------>
	<div id="divPaiementx4" class="sub_liste">
		<h1>Paiements des moniteurs de Conduite</h1>
		<table class="modTable">
			<tr class="modRow" >
				<th class="modTh"></th>
				<th class="modTh">Nom et Prénom</th>
				<th class="modTh">Nombre d'absence</th>
				<th class="modTh">Nombre de candidat</th>
				<th class="modTh">Salaire</th>
				<th class="modTh"></th>
			</tr>

			<?php
				try {
					require_once('../db_connexion.php');
					$resultat=$connexion->query("SELECT * FROM employee,role WHERE employee.id_role=role.id_role AND nom_role='moniteurconduite'  Order by Nom ASC");
					while ($row=$resultat->fetch()) {
						$photo=$row['Photo'];
						$nom=$row['Nom'];
						$prenom=$row['Prenom'];
					    $salaire=$row['salaire'];
					    $nbr_abs=$row['nbr_abs'];
						$nbr_c=$row['Nbr_c'];
			?>

			<tr class="modTr">
				<td class="modTd"><?php echo '<img class="cadre" src="data:image/jpeg;base64,'.base64_encode($photo).'"/>'; ?></td>
				<td class="modTd"><?php echo $nom;?> <?php echo $prenom;?></td>
				<td class="modTd"><?php echo $nbr_abs;?></td>
				<td class="modTd"><?php echo $nbr_c;?></td>
				<td class="modTd"><?php echo $salaire;?> DA</td>
				<td class="modTd">
					<form method="POST">
						<input type="hidden" name="id_cond" value="<?php  echo $row['id']; ?>">
						<input class="ab" type="text" name="montant" size="8%">
				</td>
				<td class="buttonSized">
						<button name="payer_cond" class="payer"><i class="las la-coins"></i></button>
				</td>
				<td class="buttonSized">
						<button name="elenver_cond" class="supprim"><i class="las la-undo"></i></button>
					</form>
				</td>
				<?php

					if (isset($_POST['payer_cond'])){
						$id_cond=$_POST['id_cond'];
						$montant=$_POST['montant'];

						if ($montant > 0) {

							$requete="SELECT * FROM `employee` WHERE id='$id_cond'";
							$resultat=$connexion->query($requete);
							while ($row=$resultat->fetch()){
								$nom=$row['Nom'];
								$prenom=$row['Prenom'];
								$salaire=$row['salaire'];
							}

							$prix=$montant+$salaire;
							
							$requete="UPDATE `employee` SET salaire='$prix' WHERE id='$id_cond'";
							$resultat=$connexion->query($requete);
							$titreNotif = "Mise à jour salaire";
							$message="Votre salaire à été mis à jour, votre nouveau salaire est :".$prix." DA";
	                        $date_m=date('U');
	                        $resultat2=$connexion->query("INSERT INTO notification (`name`,`message`,`status`,`date`,`id_employee`) VALUES('$titreNotif','$message','0','$date_m','$id_cond')");

							echo "<script>if(confirm(\"Le nouveau salaire de ".$nom." ".$prenom." est ".$prix." DA\")){document.location.href='superviseur.php'};</script>";
						}
						else {
							echo "<script>if(confirm(\" Erreur! le montant ne peut pas être negatif. \")){document.location.href='superviseur.php'};</script>";
						}

					}else if (isset($_POST['elenver_cond'])){
						$id_cond=$_POST['id_cond'];
						
						$requete="SELECT * from `employee` where id='$id_cond'";
						$resultat=$connexion->query($requete);
						while ($row=$resultat->fetch()){
							$nom=$row['Nom'];
							$prenom=$row['Prenom'];
							$salaire=$row['salaire'];
						}

						$requete="UPDATE `employee` SET salaire='0' WHERE id='$id_cond'";
						$resultat=$connexion->query($requete);
                        echo "<script>if(confirm(\"Le salaire de ".$nom." ".$prenom." a été remis à zéro.\")){document.location.href='superviseur.php'};</script>";
					}
					} // close while loop
				}catch (PDOException $e) { 
					echo "Erreur ! " . $e->getMessage() . "<br/>";
				}
			?>
			</tr>
		</table>
	</div>
	<!------------------------------------------------------ Fin DIV PAIMENT 4 ---------------------------------------------------------->


	<!-------------------------------------------------- DIV SUPPRIMER/MODIFIER --------------------------------------------------------->
	<div id="divModifier" class="sub_liste">
		<h1>Modifier ou Supprimer un gérant</h1>
		<table class="modTable">
			<tr class="modRow" >
				<th class="modTh"></th>
				<th class="modTh">Nom et Prénom</th>
				<th class="modTh">Date De Naissance</th>
				<th class="modTh">Ville</th>
			</tr>

			<?php
				try {
					$resultat=$connexion->query("SELECT * FROM `employee` WHERE id_role='2'  Order by Nom ASC");
					while ($row=$resultat->fetch()) {
						$photo=$row['Photo'];
						$nom=$row['Nom'];
						$prenom=$row['Prenom'];
						$naissance=$row['Naissance'];
						$ville=$row['Ville'];
			?>

			<tr class="modTr">
				<td class="modTd"><?php echo '<img class="cadre" src="data:image/jpeg;base64,'.base64_encode($photo).'"/>'; ?></td>
				<td class="modTd"><?php echo $nom;?> <?php echo $prenom;?></td>
				<td class="modTd"><?php echo $naissance;?></td>
				<td class="modTd"><?php echo $ville;?></td>

				<!-------------------------- Envoyer id de Gerant pour modifier --------------------------->
				<td class="buttonSized">
					<form method="POST" action="modifier_gerant.php">
						<input type="hidden" name="id_s" value="<?php echo $id; ?>">
						<input type="hidden" name="id_g" value="<?php  echo $row['id']; ?>">
						<button name="modifier_g" class="modifier"><i class="las la-user-edit"></i></button>
					</form>
				</td> 

				<!-------------------------- Envoyer id de Gerant pour supprimer -------------------------->
				<td class="buttonSized">
					<form method="POST">
						<input type="hidden" name="nom_g" value="<?php echo $row['Nom'];?>">
						<input type="hidden" name="prenom_g" value="<?php echo $row['Prenom'];?>">
						<input type="hidden" name="id_g" value="<?php echo $row['id'];?>">
						<button id="supprim" name="supprim_g" class="supprim"><i class="las la-user-times"></i></button>
					</form>
				</td>

				<?php
			        if (isset($_POST['supprim_g'])) {
			            $id=$_POST['id_g'];
			            $nom=$_POST['nom_g'];
			            $prenom=$_POST['prenom_g'];

			            $requete="DELETE FROM `employee` WHERE id='$id'";
			            $connexion->query($requete);

			            echo "<script>if(confirm(\"Le gérant: ".$nom." ".$prenom." a été supprimé avec succès.\")){document.location.href='superviseur.php'};</script>";
			        }
					} // close while loop
					}catch (PDOException $e) {
						echo "Erreur ! " . $e->getMessage() . "<br/>";
					}
				?>
			</tr>
		</table>
	</div>
	<!------------------------------------------------ FIN DIV SUPPRIMER/MODIFIER ------------------------------------------------------->


	<!------------------------------------------------- DIV SUPPRIMER/MODIFIER 2 -------------------------------------------------------->
	<div id="divModifier2" class="sub_liste">
		<h1>Modifier ou Supprimer un moniteur de code</h1>
		<table class="modTable">
			<tr class="modRow" >
				<th class="modTh"></th>
				<th class="modTh">Nom et Prénom</th>
				<th class="modTh">Date De Naissance</th>
				<th class="modTh">Ville</th>
			</tr>

			<?php
				try {
					$resultat=$connexion->query("SELECT * FROM `employee` WHERE id_role='3'  Order by Nom ASC");
					while ($row=$resultat->fetch()) {
						$photo=$row['Photo'];
						$nom=$row['Nom'];
						$prenom=$row['Prenom'];
						$naissance=$row['Naissance'];
						$ville=$row['Ville'];
			?>

			<tr class="modTr">
				<td class="modTd"><?php echo '<img class="cadre" src="data:image/jpeg;base64,'.base64_encode($photo).'"/>'; ?></td>
				<td class="modTd"><?php echo $nom;?> <?php echo $prenom;?></td>
				<td class="modTd"><?php echo $naissance;?></td>
				<td class="modTd"><?php echo $ville;?></td>

				<!-------------------------- Envoyer id de moniteur de code pour modifier --------------------------->
				<td class="buttonSized">
					<form method="POST" action="modifier_m_code.php">
						<input type="hidden" name="id_s" value="<?php echo $id; ?>">
						<input type="hidden" name="id_code" value="<?php  echo $row['id']; ?>">
						<button name="modifier_m_code" class="modifier"><i class="las la-user-edit"></i></button>
					</form>
				</td> 

				<!-------------------------- Envoyer id de moniteur de code pour supprimer -------------------------->
				<td class="buttonSized">
					<form method="POST">
						<input type="hidden" name="nom_code" value="<?php echo $row['Nom'];?>">
						<input type="hidden" name="prenom_code" value="<?php echo $row['Prenom'];?>">
						<input type="hidden" name="id_code" value="<?php echo $row['id'];?>">
						<button id="supprim" name="supprim_m_code" class="supprim"><i class="las la-user-times"></i></button>
					</form>
				</td>

				<?php
			        if (isset($_POST['supprim_m_code'])) {
			            $id=$_POST['id_code'];
			            $nom=$_POST['nom_code'];
			            $prenom=$_POST['prenom_code'];

			            $requete="DELETE FROM `employee` WHERE id='$id'";
			            $connexion->query($requete);

			            echo "<script>if(confirm(\"Le moniteur de code: ".$nom." ".$prenom." a été supprimé avec succès.\")){document.location.href='superviseur.php'};</script>";
			        }
					} // close while loop
					}catch (PDOException $e) {
						echo "Erreur ! " . $e->getMessage() . "<br/>";
					}
				?>
			</tr>
		</table>
	</div>
	<!----------------------------------------------- FIN DIV SUPPRIMER/MODIFIER 2 ------------------------------------------------------>


	<!------------------------------------------------- DIV SUPPRIMER/MODIFIER 3 -------------------------------------------------------->
	<div id="divModifier3" class="sub_liste">
		<h1>Modifier ou Supprimer un moniteur de conduite</h1>
		<table class="modTable">
			<tr class="modRow" >
				<th class="modTh"></th>
				<th class="modTh">Nom et Prénom</th>
				<th class="modTh">Date De Naissance</th>
				<th class="modTh">Ville</th>
			</tr>

			<?php
				try {
					$resultat=$connexion->query("SELECT * FROM `employee` WHERE id_role='4'  Order by Nom ASC");
					while ($row=$resultat->fetch()) {
						$photo=$row['Photo'];
						$nom=$row['Nom'];
						$prenom=$row['Prenom'];
						$naissance=$row['Naissance'];
						$ville=$row['Ville'];
			?>

			<tr class="modTr">
				<td class="modTd"><?php echo '<img class="cadre" src="data:image/jpeg;base64,'.base64_encode($photo).'"/>'; ?></td>
				<td class="modTd"><?php echo $nom;?> <?php echo $prenom;?></td>
				<td class="modTd"><?php echo $naissance;?></td>
				<td class="modTd"><?php echo $ville;?></td>

				<!-------------------------- Envoyer id de moniteur de conduite pour modifier --------------------------->
				<td class="buttonSized">
					<form method="POST" action="modifier_m_conduite.php">
						<input type="hidden" name="id_s" value="<?php echo $id; ?>">
						<input type="hidden" name="id_cond" value="<?php  echo $row['id']; ?>">
						<button name="modifier_m_cond" class="modifier"><i class="las la-user-edit"></i></button>
					</form>
				</td> 

				<!-------------------------- Envoyer id de moniteur de conduite pour supprimer -------------------------->
				<td class="buttonSized">
					<form method="POST">
						<input type="hidden" name="nom_cond" value="<?php echo $row['Nom'];?>">
						<input type="hidden" name="prenom_cond" value="<?php echo $row['Prenom'];?>">
						<input type="hidden" name="id_cond" value="<?php echo $row['id'];?>">
						<button name="supprim_m_cond" class="supprim"><i class="las la-user-times"></i></button>
					</form>
				</td>

				<?php
			        if (isset($_POST['supprim_m_cond'])) {
			            $id=$_POST['id_cond'];
			            $nom=$_POST['nom_cond'];
			            $prenom=$_POST['prenom_cond'];

			            $requete="DELETE FROM `employee` WHERE id='$id'";
			            $connexion->query($requete);

			            echo "<script>if(confirm(\"Le moniteur de conduite: ".$nom." ".$prenom." a été supprimé avec succès.\")){document.location.href='superviseur.php'};</script>";
			    	}
					} // close while loop
					}catch (PDOException $e) { 
						echo "Erreur ! " . $e->getMessage() . "<br/>";
					}
				?>
			</tr>
		</table>
	</div>
	<!----------------------------------------------- FIN DIV SUPPRIMER/MODIFIER 3 ------------------------------------------------------>

	<!--------------------------------------------------------- DIV Text2 --------------------------------------------------------------->
	<div id="divText" class="sub_liste">
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



	<!--------------------------------------------------------- Footer ------------------------------------------------------------------>
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