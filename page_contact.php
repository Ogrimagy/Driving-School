<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
	<title>Contactez Nous</title>
    <link rel="stylesheet" type="text/css" href="ressource/css/style_global.css">
    <link rel="stylesheet" type="text/css" href="ressource/css/style_contact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <script src="ressource/js/menu.js"></script>
</head>

<body>

    <div class="topnav" id="myTopnav">
        <a href="index.html">Accueil</a>
        <a href="page_connexion.html">Se connecter</a>
        <a href="page_inscription.html">S'inscrire</a>
        <a href="page_tarif.html">Tarifs</a>
        <a href="page_propos.html">À Propos</a>
        <a class="active" href="page_contact.php">Contact</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i></a>
    </div>

    <div class="container">
        <div class="toplevel" style="text-align:center">
            <h2>Contactez nous</h2>
            <p>Passez à notre bureau, appelez nous, ou laissez un message:</p>
        </div>
        <div class="row">
            <div class="column">
                <iframe width="100%" height="225px" src="https://maps.google.com/maps?q=/maps/place/Nouveau+Pôle+Universitaire+Abou+Bakr+Belkaid+Tlemcen%20Oran&z=10&output=embed"></iframe>
                <div class="coord">
                    <b class="info"><i class="las la-store-alt"></i> Agence:</b> Toxy<br><br>
                    <b class="info"><i class="las la-phone"></i> Tel:</b> 0658 42 03 83 - 0568 12 45 86<br><br>
                    <b class="info"><i class="las la-at"></i> E-mail:</b> aecole023@gmail.com<br><br>
                    <b class="info"><i class="las la-map-marked-alt"></i> Localisation:</b> Nouveau pôle universitaire Abour Bakr Belkaid, Tlemcen<br><br>
                    <b class="info"><i class="las la-business-time"></i> Horaires d’ouverture:</b> Auto Ecole disponible tout les jours, de 09h à 12h et 13h30 à 17h<br><br>
                </div>
            </div>
            <div class="column">
                <?php 
                    if (isset($_GET["message"])) {
                        if ($_GET["message"] == "envoyer") {
                            echo "<div class='msgSuccess'>Message envoyé!</div>";
                        }
                    }
                    else { ?>
                        <form action="Controller_contact.php" autocomplete="off" method="POST">
                            <label for="nom">Nom</label>
                            <input type="text" id="nom" name="nom" placeholder="Votre nom.." required>
                            <label for="prenom">Prénom</label>
                            <input type="text" id="prenom" name="prenom" placeholder="Votre prénom.." autocomplete="chrome-off" required>
                            <label for="ville">Ville</label>
                            <select id="ville" name="ville">
                                <option value="Tlemcen">Tlemcen</option>
                                <option value="Oran">Oran</option>
                                <option value="Alger">Alger</option>
                            </select>
                            <label for="mail">Adresse E-mail</label>
                            <input type="email" id="mail" name="mail" placeholder="Votre adresse e-mail.." required>
                            <label for="subject">Message</label>
                            <textarea id="subject" name="subject" placeholder="Ecrivez quelque chose.." style="height:170px" required></textarea>
                            <input type="submit" value="Envoyer" name="btn-send">
                        </form> <?php
                    }
                ?>
            </div>
        </div>
    </div>
    
    <!--------------------------------------------------------- Footer ------------------------------------------------------------------>
    <div class="footer">
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