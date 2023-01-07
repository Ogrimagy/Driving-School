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
    <script src="ressource/js/inscription.js"></script>
    <script src="ressource/js/menu.js"></script> 
    <script src="ressource/js/afficherMdp.js"></script>
    <script src="ressource/js/jquery.js"></script><!-- verification des donnes -->
</head>
<body>
    <div  class="topnav" id="myTopnav">
        <a href="page_accueil.html">Accueil</a>
        <a class="active" href="page_connexion.html">Se connecter</a>
        <a href="page_inscription.html">S'inscrire</a>
        <a href="page_tarif.html">Tarifs</a>
        <a href="page_propos.html">À Propos</a>
        <a href="page_contact.html">Contact</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i></a>
    </div>

    <div class="container" align="center">
        <fieldset class="loginbox">
            <legend><i class="fa fa-envelope fa-5x"></i></legend>
            <h2>Réinitialiser votre mot de passe</h2>
                <?php 
                    if (isset($_GET["reinitialisation"])) {
                        if ($_GET["reinitialisation"] == "valide") {
                            echo '<div align="left">';
                            echo "<p class='reinValide'>E-mail envoyé.</p>";
                        }
                    } else { ?>
                        <h4>Un E-mail vous sera envoyé avec les instructions nécéssaire pour réinitialiser votre de mot de passe</h4>
                        <form method="POST" action="controller_oublie.php" id="rr" autocomplete="off">
                            <input type="text" id="ad_email" name="emailOublie" required="email" placeholder="Entrer votre adresse E-mail...">
                            <div class="btConex fade-in"><center><input type="submit" name="oublie-verif-valide" value="Envoyez moi un E-mail"></center></div>
                        </form> <?php
                    }
                    if (isset($_GET["reinitialisation"])) {
                        if ($_GET["reinitialisation"] == "inconnu") {
                            ?>
                            <h4>Un E-mail vous sera envoyé avec les instructions nécéssaire pour réinitialiser votre de mot de passe</h4>
                            <form method="POST" action="controller_oublie.php" id="rr" autocomplete="off">
                                <input type="text" id="ad_email" name="emailOublie" required="email" placeholder="Entrer votre adresse E-mail...">
                                <div class="btConex fade-in"><center><input type="submit" name="oublie-verif-valide" value="Envoyez moi un E-mail"></center></div>
                            </form> <?php
                            echo "<p class='reinInconnu'>Cet E-mail n'est associé à aucun compte!</p>";
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