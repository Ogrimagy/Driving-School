<!---------------------------------------------------- PHP pour recuperer id connecte ---------------------------------------------------->
<?php
    session_start();
    require_once('../db_connexion.php');
    if(isset($_POST['modifier_ca'])) {
        $id_g=$_POST['id_g'];
        $requete1="SELECT * FROM `employee` WHERE id='$id_g'";
        $resultat1=$connexion->query($requete1);

        while($row=$resultat1->fetch()) {
            $id=$row['id'];
            $nom=$row['Nom'];
            $prenom=$row['Prenom'];
            $photo=$row['Photo'];
        }
?>
<!---------------------------------------------------------------------------------------------------------------------------------------->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Page gérant</title>
    <link rel="stylesheet" type="text/css" href="../ressource/css/style_global.css">
    <link rel="stylesheet" type="text/css" href="../ressource/css/style_menu_left.css">
    <link rel="stylesheet" type="text/css" href="../ressource/css/style_ajouter.css">
    <script src="../ressource/js/inscription.js"></script>
    <script src="../ressource/js/jquery.js"></script><!-- verification des donnes -->
</head>
<body onload="removeLoader()">
    <!--------------------------------------------------------- STYLE DE PAGE ----------------------------------------------------------->
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
            <a class="buttonLink">
                <form method="POST">    
                    <button class="deco" name="dec">Se deconnecter</button>     
                </form>
            </a>
            <?php
            }
                if (isset($_POST['dec'])) {
                    unset($_SESSION['id']);
                    header("Location: ../page_connexion.html");
                }
            ?>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
        </div>
    </div>
    <!------------------------------------------------------- FIN STYLE DE PAGE --------------------------------------------------------->


    <!----------------------------------------------------- DIV MODIFIER CANDIDAT ------------------------------------------------------->
    <center>
        <form id="formulaire" style="margin-left: 0%;" method="post" autocomplete="off">
            <table class="table" width="100%">
                
                    <?php
                        if(isset($_POST['modifier_ca'])) {
                            $id_c=$_POST['id_c'];
                            $resultat=$connexion->query("SELECT * FROM `candidat` where Id_c='$id_c'");
                            while ($row=$resultat->fetch()) {
                    ?>

                    <tr><td colspan="2"><label id="title"><h2>Modifier votre candidat suivant: </h2></label></td></tr>

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
                            <input type="text" id="nom" name="nom" size="35" maxlength="30" value="<?php echo $row['Nom']; ?>" onfocusOut="verifier_nom()" required>
                        </td>
                        <td>
                            <input type="text" id="prenom" name="prenom" size="35" maxlength="30" value="<?php echo $row['Prenom']; ?>" onfocusOut="verifier_prenom()" required>
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
                    <!-------------------------------------------------------------------------------------->


                    <!---------------------------------- Naissance + ville --------------------------------->
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
                            <input type="date" id="naissance" name="naissance" min="1950-01-01" value="<?php echo $row['Naissance']; ?>" onfocusOut="verifier_dates()" required>
                        </td>
                         <td>
                            <input type="text" id="ville" name="ville" size="35" value="<?php echo $row['Ville']; ?>" onfocusOut="verifier_ville()" required>
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
                    <!-------------------------------------------------------------------------------------->


                    <!--------------------------------------- Email + Tel ---------------------------------->
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
                            <input type="text" id="ad_email" name="ad_email" placeholder="exemple: ab_D.1@doM1n.xYz" value="<?php echo $row['Email']; ?>" onfocusOut="verifier_mail()" size="35" required>
                        </td>
                        <td>
                            <input type="text" id="phone" name="phone" size="35" maxlength="10" value="<?php echo $row['Telephone']; ?>" onfocusOut="verifier_tel()" required>
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
                    <!-------------------------------------------------------------------------------------->


                    <!-------------------------------Type véhicule + Etat ---------------------------------->
                    <tr>
                        <td>
                            <label class="label">Type de véhicule <div class="stars">*<span class="champReq">Champ requis</span></div></label>
                        </td>
                        <td>
                            <label for="etat" class="label">Etat <div class="stars">*<span class="champReq">Champ requis</span></div></label>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <select id="carType" name="carType">
                            	<?php
                            		$ty=$row['TypeV'];
                            	?>
                                <option <?php if ($ty == "auto" ) echo 'selected' ; ?> value="auto" selected>Voiture automatique</option>
                                <option <?php if ($ty == "manuel" ) echo 'selected' ; ?> value="manuel">Voiture manuel</option>
                            </select>
                        </td>
                        <td>
                            <select id="etat" name="etat">
                            	<?php
                            		$Et=$row['Etat'];
                            	?>
                                <option <?php if ($Et == "normal" ) echo 'selected' ; ?> value="normal">Normal</option>
                                <option <?php if ($Et == "etudiant" ) echo 'selected' ; ?> value="etudiant">Étudient</option>
                                <option <?php if ($Et == "chomeur" ) echo 'selected' ; ?> value="chomeur">chômeur</option>
                                <option <?php if ($Et == "conducteur" ) echo 'selected' ; ?> value="conducteur">Conducteur</option>
                            </select>
                        </td>
                    </tr>
                    <!-------------------------------------------------------------------------------------->


                    <!----------------------------------------- Genre -------------------------------------->
                    <tr>
                        <td>
                            <label class="label">Genre <div class="stars">*<span class="champReq">Champ requis</span></div></label>
                        </td>
                    </tr>

                    <?php
                		$rad=$row['Genre'];
                	?>

                    <tr>
                        <td>
                            <label class="container">Male
                                <input type="radio" id="male" name="genre"  <?php if ($rad == "M" ) echo 'checked' ; ?> value="M" >
                                <span class="checkmark"></span>
                            </label>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label class="container">Femelle
                                <input type="radio" id="female" name="genre" <?php if ($rad == "F" ) echo 'checked' ; ?> value="F">
                                <span class="checkmark"></span>
                            </label>
                        </td>
                    </tr>
                    <!------------------------------------------------------------------------------------->


                    <!---------------------------------- Valider + Annuler -------------------------------->
                    <tr>
                        <th colspan="2" class="center-cell">
                            <label id="err_submit"></label>
                        </th>
                    </tr>

                    <tr>
                        <th align="right">
                            <input class="btEffacer" type="reset" id="annuler" name="annuler" value="Annuler" onclick="initialiser()">
                        </th>
                        <th align="left">
                            <input type="hidden" name="id_c" value="<?php echo $row['id_c']; ?>">
                            <button class="btValider" id="valider" name="valider" onclick="validateForm()"><span>Valider</span></button>
                        </th>
                    </tr>
                    <!----------------------------------------------------------------------------------->

                    <?php
                            }
                            }
                            if (isset($_POST['valider'])) {
                            $id=$_POST['id_c'];
                            $nom=$_POST['nom'];
                            $prenom=$_POST['prenom'];
                            $naissance=$_POST['naissance'];
                            $ville=$_POST['ville'];
                            $email=$_POST['ad_email'];
                            $phone=$_POST['phone'];
                            $genre=$_POST['genre'];
                            $r=$connexion->query("UPDATE `candidat` SET Nom='$nom', Prenom='$prenom', Naissance='$naissance', Ville='$ville',Email='$email', Telephone='$phone', Genre='$genre' WHERE id_c='$id'");
                            echo "<script>if(confirm(\"Votre candidat: ".$nom." ".$prenom."  est modifier avec succées\")){document.location.href='gerant.php'};</script>";   
                        }
                    ?>

            </table>
        </form>
    </center>
    <!-------------------------------------------------- Fin DIV MODIFIER CANDIDAT ------------------------------------------------------>


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