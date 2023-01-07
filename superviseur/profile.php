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
			     $id_m=$row['id'];
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
	<title><?php echo $nom . " " . $prenom ?> :: Mon profil</title>
	<link rel="stylesheet" type="text/css" href="../ressource/css/style_global.css">
	<link rel="stylesheet" type="text/css" href="../ressource/css/style_table.css">
	<link rel="stylesheet" type="text/css" href="../ressource/css/style_ajouter.css">
	<link rel="stylesheet" type="text/css" href="../ressource/css/style_menu_left.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
	<script src="../ressource/js/menu.js"></script>
	<script src="../ressource/js/notification.js"></script>
	<script src="../ressource/js/superviseur/menu-left.js"></script>
	<script src="../ressource/js/superviseur/ajoutEmploye.js"></script>
	<script src="../ressource/js/jquery.js"></script><!-- verification des donnes -->
	<script src="https://www.gstatic.com/charts/loader.js"></script><!-- Dessiner les statistiques -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script><!-- Modifier l'image de profile-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script><!-- Modifier l'image de profile-->
    <script>
    	function afficherProfile() {
	    	setTimeout('document.getElementById("divProfile").style.opacity = "1"', 1);
			document.getElementById("divProfile").style.opacity = "0.5";
			document.getElementById("divProfile").style.display = "block";
		}
    </script>
</head>
<body onload="removeLoader();afficherProfile()">
	<div id="loading" class="loader"></div>
	<!--------------------------------------------------------- STYLE DE PAGE ----------------------------------------------------------->
	
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
			<a href="superviseur.php?open=afficherNotification&vu=<?php echo $id?>"><i class="fa fa-bell"><span id="nbNotif"><?php echo $resultat->rowCount(); ?></span></i></a>
        	<?php
            	} else {
        	?>
			<a href="superviseur.php?open=afficherNotification"><i class="fa fa-bell"><span class="nbNotif"></span></i></a>
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
		<br>
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i id="arrows" class="las la-angle-double-left"></i></a>
		<a href="superviseur.php"><i class="las la-chart-pie"></i> Statistique</a>
		<a href="superviseur.php?open=ajouterEmployer" ><i class="las la-plus-circle"></i> Ajouter un employé</a>
		<div onmouseover="afficherListeGerer()" onmouseout="cacherListeGerer()">
			<a><i class="las la-address-book"></i> Gérer les employés</a>
			<div id="type_employe" class="ids">
				<a href="superviseur.php?open=modifierGerant"><i class="las la-list"></i> Gérant</a>
				<a href="superviseur.php?open=modifierMoniCode"><i class="las la-list"></i> Moniteur (Code)</a>
				<a href="superviseur.php?open=modifierMoniCond"><i class="las la-list"></i> Moniteur (Conduite)</a>
			</div>
		</div>
		<div onmouseover="afficherListePayer()" onmouseout="cacherListePayer()">
			<a><i class="las la-receipt"></i> Paiements</a>
			<div id="payer" class="ids">
				<a href="superviseur.php?open=payerCandidat"><i class="las la-receipt"></i> Candidat</a>
				<a href="superviseur.php?open=payerGerant"><i class="las la-receipt"></i> Gérant</a>
				<a href="superviseur.php?open=payerMoniCode"><i class="las la-receipt"></i> Moniteur (Code)</a>
				<a href="superviseur.php?open=payerMoniCond"><i class="las la-receipt"></i> Moniteur (Conduite)</a>
			</div>
		</div>
		<a href="superviseur.php?open=ajouterRemise"><i class="las la-hands-helping"></i>Ajouter des remises</a>		
	</div>
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

			
			</table>
		</form>
			<!--------------------------------le traitement de php --------------------------->
				<?php
					try {
						if(isset($_POST["insert"])){  
							$file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));  
							$query = "UPDATE employee SET Photo ='$file' where id='$id_m'";  
							if(mysqli_query($connect, $query)) {
								echo "<script>if(confirm(\" Votre photo de profil est modifier avec succées.\")){document.location.href='superviseur.php'};</script>";
							}

						} else if (isset($_POST['valider'])) {
							$nom=$_POST['nom'];
                            $prenom=$_POST['prenom'];
                            $naissance=$_POST['naissance'];
							$ville=$_POST['ville'];
							$email=$_POST['ad_email'];
							$phone=$_POST['phone'];
							$mot_passe=$_POST['mot_passe'];
							$requete="UPDATE employee SET Nom='$nom', Prenom='$prenom', Naissance='$naissance', Ville='$ville', Email='$email', Telephone='$phone', Password='$mot_passe' WHERE id='$id_m'";
							$connexion->exec($requete);

							echo "<script>if(confirm(\" Opération reussite\")){document.location.href='superviseur.php'};</script>";
						}

					} catch (PDOException $e) {
						echo "Erreur ! " . $e->getMessage() . "<br/>";
					}
				?>
   </div>


</body>
</html>