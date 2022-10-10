<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
	<title>Réinitialisation du mot de passe</title>
	<link rel="stylesheet" type="text/css" href="ressource/css/style_oublie.css">
    <link rel="stylesheet" type="text/css" href="ressource/css/style_global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <script src="ressource/js/nvMdp.js"></script>
    <script src="ressource/js/menu.js"></script> 
    <script src="ressource/js/jquery.js"></script><!-- verification des donnes -->
</head>
<body>
    <div  class="topnav" id="myTopnav">
        <a href="page_accueil.html">Accueil</a>
        <a class="active" href="page_connexion.html">Se connecter</a>
        <a href="page_inscription.html">S'inscrire</a>
        <a href="page_tarif.html">Tarifs</a>
        <a href="page_propos.html">À Propos</a>
        <a href="page_contact.php">Contact</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i></a>
    </div>

    <div class="container" align="center">
        <fieldset class="loginbox">
                <?php 
                    $selectionneur = isset($_GET["selectionneur"]) ? $_GET["selectionneur"] : "";
                    $validation = isset($_GET["validation"]) ? $_GET["validation"] : "";
                    $changement = isset($_GET["changement"]) ? $_GET["changement"] : "";
                    $token = isset($_GET["token"]) ? $_GET["token"] : "";

                    if ( $token == "mauvais" ) {

                        ?>
                            <legend><i class="fa fa-times-circle fa-5x"></i></legend>
                            <div align="left">
                            <p class="failInfo">Lien invalide ou expiré.</p>
                        <?php

                    } elseif ( $changement == "complet" ) {

                        ?>
                            <legend><i class="fa fa-check-circle fa-5x"></i></legend>
                            <div align="left">
                            <p class="successInfo">Changement réussi.</p>
                        <?php

                    } else {

                        if (empty($selectionneur) || empty($validation)) {
                            ?>

                                <legend><i class="fa fa-exclamation-circle fa-5x"></i></legend>
                                <h2>Lien de réinitialisation invalide !</h2>
                                
                            <?php
                        } else {
                            if (ctype_xdigit($selectionneur) !== false && ctype_xdigit($validation) !== false) {

                                $date = date("U");
                                require('db_connexion.php');
                                ///////////////////////////////////////////////////////////////////////////////////////
                                $requete = $connexion->prepare("SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExpires >= $date");
                                if (!$requete->execute([$selectionneur])) {
                                    die("Requete echoué");
                                }
                                $resultat = $requete->fetch();

                                if ( !$resultat ) {
                                    header("Location: page_nouveau_mdp.php?token=mauvais");
                                    exit();
                                }
                                ///////////////////////////////////////////////////////////////////////////////////////


                                ///////////////////////////////////////////////////////////////////////////////////////
                                $length = strlen($validation);
                                if ( $length % 2 != 0) {
                                    header("Location: page_nouveau_mdp.php?token=mauvais");
                                    exit();
                                }

                                $tokenBin = hex2bin($validation);
                                $tokenCheck = password_verify($tokenBin, $resultat["pwdResetToken"]);
                                if ($tokenCheck === false) {
                                   header("Location: page_nouveau_mdp.php?token=mauvais");
                                   exit();
                                }
                                ///////////////////////////////////////////////////////////////////////////////////////

                                ?>
                                    <legend><i class="fa fa-lock fa-5x"></i></legend>
                                    <div align="left">
                                    <form method="POST" action="controller_nouveau_mdp.php" id="rr" autocomplete="off">

                                        <input type="hidden" name="selectionneur" value="<?php echo $selectionneur; ?>">
                                        <input type="hidden" name="validation" value="<?php echo $validation; ?>">

                                        <input id="mot_passe" type="password" name="mot_passe" required placeholder="Entrer un nouveau mot de passe" oninput="verifier_pw()">
                                        <label id="err_pw"></label>

                                        <input id="confirm_pw" type="password" name="confirm_pw" required placeholder="Confirmer votre mot de passe" oninput="verifier_pw()">
                                        <label id="err_cpw"></label><br>

                                        <span class="unselectable" id="afficher" onclick="afficherLettre2()">
                                        <i id="eyeIcon" class="las la-eye-slash unselectable"></i>&nbsp;&nbsp;&nbsp;Afficher mot de passe</span><br>

                                        <input type="button" name="bouttonValider" id="bouttonValider" class="submitQ" onclick="validateForm()" value="Réinitialiser votre mot de passe" >

                                        <label class="subErr" id="err_submit"></label>

                                    </form>
                                <?php
                            }
                        }
                    }
                ?>
                
            </div>
        </fieldset>
    </div>

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