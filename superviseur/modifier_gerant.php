<!---------------------------------------------------- PHP pour recuperer id connecte ---------------------------------------------------->
<?php
    session_start();
    require_once('../db_connexion.php');
    if(isset($_POST['modifier_g'])) {
        $id_s=$_POST['id_s'];
        $requete1="SELECT * FROM `employee` WHERE id='$id_s'";
        $resultat1=$connexion->query($requete1);

        while($row=$resultat1->fetch()) {
            $id=$row['id'];
            $nom=$row['Nom'];
            $prenom=$row['Prenom'];
            $photo=$row['Photo'];
        }
        if(isset($_POST['modifier_g'])) {
            $finder=$_POST['id_g'];
            $rq="SELECT * FROM `employee` WHERE id='$finder'";
            $res=$connexion->query($rq);
            while($row=$res->fetch()) {
                $dpNom=$row['Nom'];
                $dpPre=$row['Prenom'];
            }
        }

?>
<!---------------------------------------------------------------------------------------------------------------------------------------->

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title><?php echo ucfirst($dpNom) . " " . ucfirst($dpPre) ?> :: Modification</title>
    <link rel="stylesheet" type="text/css" href="../ressource/css/style_global.css">
    <link rel="stylesheet" type="text/css" href="../ressource/css/style_menu_left.css">
    <link rel="stylesheet" type="text/css" href="../ressource/css/style_ajouter.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <style type="text/css">
        .typeMod {
            text-align: center;
        }
        .vMod {
            color: #6DAD70;
        }
    </style>
    <script src="../ressource/js/superviseur/ajoutEmploye.js"></script>
    <script src="../ressource/js/menu.js"></script>
    <script src="../ressource/js/notification.js"></script>
    <script src="../ressource/js/superviseur/menu-left.js"></script>
    <script src="../ressource/js/superviseur/ajoutEmploye.js"></script>
    <script>
        function afficherDivMod() {
            setTimeout('document.getElementById("divMod").style.opacity = "1"', 1);
            document.getElementById("divMod").style.opacity = "0.5";
            document.getElementById("divMod").style.display = "block";
        }
    </script>
</head>
 
<body onload="removeLoader();afficherDivMod()">
    <div id="loading" class="loader"></div>
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
            <?php }
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
    <!------------------------------------------------------- FIN STYLE DE PAGE --------------------------------------------------------->


    <!----------------------------------------------------- DIV Mofifier Employee ------------------------------------------------------->
    <center>
        <div id="divMod" class="contain">
            <form id="formulaire" style="margin-left: 0%" method="post" autocomplete="off">
                <table class="table" width="100%">
                    <?php
                        if(isset($_POST['modifier_g'])) {
                            $id_g=$_POST['id_g'];
                            $resultat=$connexion->query("SELECT * FROM `employee` where id='$id_g'");
                            while ($row=$resultat->fetch()) {
                    ?>

                    <tr><td colspan="2"><label id="title"><h2>Modification :: <?php echo ucfirst($dpNom) . " " . ucfirst($dpPre) ?> </h2></label>
                        <div class="typeMod">Role: <span class="vMod">Gérant</span></div></td></tr>
                        <tr></tr><tr></tr>

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
                            <input type="text" id="nom" name="nom" maxlength="30" value="<?php echo $row['Nom']; ?>" onfocusOut="verifier_nom()" required autocomplete="off">
                        </td>
                        <td>
                            <input type="text" id="prenom" name="prenom" maxlength="30" value="<?php echo $row['Prenom']; ?>" onfocusOut="verifier_prenom()" required autocomplete="chrome-off">
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
                            <input type="date" id="naissance" name="naissance" min="1950-01-01" value="<?php echo $row['Naissance']; ?>" onfocusOut="verifier_dates()" required>
                        </td>
                        <td>
                            <input type="text" id="ville" name="ville" value="<?php echo $row['Ville']; ?>" onfocusOut="verifier_ville()" required>
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
                            <input type="text" id="ad_email" name="ad_email" placeholder="exemple: ab_D.1@doM1n.xYz" value="<?php echo $row['Email']; ?>" onfocusOut="verifier_mail()" required>
                        </td>
                        <td>
                            <input type="text" id="phone" name="phone" maxlength="10" value="<?php echo $row['Telephone']; ?>" onfocusOut="verifier_tel()" required autocomplete="chrome-off">
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

                    <!-------------------------------------- Choix ----------------------------------->
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

                    <!-----------------------------------Valider + effacer---------------------------->
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
                                <input type="hidden" name="id_g" value="<?php echo $row['id']; ?>">
                                <button class="btValider" id="valider" name="valider" onclick="validateForm()"><span>Valider</span></button>
                            </th>
                        </tr>
                        <!---------------------------------------------------------------------------->

                    <!--------------------------------le traitement de php --------------------------->
                    <?php

                            }
                            }
                            if (isset($_POST['valider'])) {
                                $id=$_POST['id_g'];
                                $nom=$_POST['nom'];
                                $prenom=$_POST['prenom'];
                                $naissance=$_POST['naissance'];
                                $ville=$_POST['ville'];
                                $phone=$_POST['phone'];
                                $email=$_POST['ad_email'];
                                $role=$_POST['etat'];
                                $r=$connexion->query("UPDATE `employee` SET Nom='$nom', Prenom='$prenom', Naissance='$naissance', Ville='$ville', Email='$email', Telephone='$phone', id_role='$role' WHERE id='$id'");
                                 $message="Votre compte a changé.il est devenu :"."</br>"."le nom est :".$nom.""."</br>"."le prenom :".$prenom."" ."</br>"." la date naissence :".$naissance." "."</br>"."la ville:".$ville.""."</br>"."  le telephone:".$phone.""."</br>"."email:".$email;
                                  $date_m=date('U');
                                  $req="INSERT INTO notification (`name`,`message`,`status`,`date`,`id_employee`) VALUES('Modification Donnée','$message','0','$date_m','$id')";
                                $resultat=$connexion->query($req);
                                echo "<script>if(confirm(\"Votre gérant: ".$nom." ".$prenom." est modifier avec succée.\")){document.location.href='superviseur.php'};</script>";
                                
                            }
                    ?>
                </table>
            </form>
        </div>
    </center>
    <!----------------------------------------------------- Fin DIV Ajout EMPLOYE ------------------------------------------------------->

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