<?php
	header('content-type: text/html; charset=utf-8');
    if (isset($_POST["oublie-verif-valide"])) {

        $selectionneur = bin2hex(random_bytes(8));
        $token = random_bytes(32);

        $url = "http://localhost/Projet-Autoecole/page_nouveau_mdp.php?selectionneur=" . $selectionneur . "&validation=" . bin2hex($token);
        $expiration = date("U") + 900;

        require('db_connexion.php');

        $emailUtil = $_POST["emailOublie"];

        $requete = $connexion->prepare("DELETE FROM pwdReset WHERE pwdResetEmail=?");

        if (!$requete->execute([$emailUtil])) {
            die("Requete SQL#1 echoué");
        }

        $requete = null;

        $existe = 2;

        ///////////////////////////////////////////////////////////////////////////////////////////
        $requete = $connexion->prepare("SELECT * from candidat where Email=?");
        if (!$requete->execute([$emailUtil])) {
            die("Requete SQLVerif#1 echoué");
        }
        $resultat = $requete->fetch();
        if ( !$resultat ) $existe--;
        $resultat = null;
        $requete = null;
        ///////////////////////////////////////////////////////////////////////////////////////////


        ///////////////////////////////////////////////////////////////////////////////////////////
        $requete = $connexion->prepare("SELECT * from employee where Email=?");
        if (!$requete->execute([$emailUtil])) {
            die("Requete SQLVerif#2 echoué");
        }
        $resultat = $requete->fetch();
        if ( !$resultat ) $existe--;
        $resultat = null;
        $requete = null;
        ///////////////////////////////////////////////////////////////////////////////////////////


        if ( $existe == 0 ) {
            header("Location: page_oublie.php?reinitialisation=inconnu");
            exit();
        }



        $requete = $connexion->prepare("INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);");
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);

        if(!$requete->execute([$emailUtil, $selectionneur, $hashedToken, $expiration])) {
            die("Requete SQL#2 echoué");
        }

        $requete = null;

        $to = $emailUtil;

        $sujet = "Reinitialiser votre mot de passe (Auto-Ecole)";

        $message = "<p>Nous avons reçu une demande de réinitialisation de mot de passe. Le lien pour réinitialiser votre mot de passe est ci-dessous. Si vous n'avez pas fait de damande de réinitialisation, vous pouvez ignorer cet E-mail.</p>";
        $message .= "<p>Voici votre lien de réinitialisation: </br>";
        $message .= "<a href='" . $url . "'>" . $url . "</a></p>";

        $headers = "From: Auto-Ecole <aecole023@gmail.com>\r\n";
        $headers .= "Reply-To: aecole023@gmail.com\r\n";
        $headers .= "Content-type: text/html\r\n";

        mail($to, $sujet, $message, $headers);
        $connexion = null;
        header("Location: page_oublie.php?reinitialisation=valide");
        exit();

    } else {
        $connexion = null;
        header("Location: page_connexion.html");
        exit();
    }

 ?>