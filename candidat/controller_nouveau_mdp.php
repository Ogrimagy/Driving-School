<?php
	header('content-type: text/html; charset=utf-8');

    if ( isset($_POST["mot_passe"]) && isset($_POST["confirm_pw"]) )   {

        $selectionneur = $_POST["selectionneur"];
        $validation = $_POST["validation"];
        $mot_passe = $_POST["mot_passe"];
        $mot_passe_confirme = $_POST["confirm_pw"];

        $date = date("U");

        require('db_connexion.php');

        $requete = $connexion->prepare("SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExpires >= $date");

        if (!$requete->execute([$selectionneur])) {

            die("Requete SQL#1 echoué");

        } else {

            $resultat = $requete->fetch();

            if ( !$resultat ) {
                header("Location: page_nouveau_mdp.php?token=mauvais");
                exit();
            } else {

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
                } elseif ($tokenCheck === true) {

                    $tokenEmail = $resultat["pwdResetEmail"];
                    $originalTable = "candidat";

                    /////////////////////////////////////////////////////////////////////////////////////////////
                    $requete = $connexion->prepare("SELECT * from candidat where Email=?");
                    if (!$requete->execute([$tokenEmail])) {
                        die("Requete SQLEmail#1 echoué");
                    }
                    $resultat2 = $requete->fetch();

                    if ( !$resultat2 ) {
                        $requete = $connexion->prepare("SELECT * from employee where Email=?");
                        if (!$requete->execute([$tokenEmail])) {
                            die("Requete SQLEmail#2 echoué");
                        }
                        $resultat2 = $requete->fetch();
                        $originalTable = "employee";
                    }
                    /////////////////////////////////////////////////////////////////////////////////////////////

                    $requete = $connexion->prepare("UPDATE $originalTable SET Password=?,ConfirmPW=? WHERE Email=?");
                    if (!$requete->execute([$mot_passe, $mot_passe, $tokenEmail])) {
                        die("Requete SQLUpdate echoué");
                    }

                    $requete = $connexion->prepare("DELETE from pwdReset WHERE pwdResetEmail=?");
                    if (!$requete->execute([$tokenEmail])) {
                        die("Requete SQLDelete echoué");
                    }

                    $connexion = null;

                    header("Location: page_nouveau_mdp.php?changement=complet");
                }
            }
        }
    } else {
        header("Location: page_accueil.html");
    }

 ?>