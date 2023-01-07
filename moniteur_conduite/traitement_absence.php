<?php
    try {

        $nom_bdd = "auto_ecole";
        $server = "localhost"; $user = "root"; $password = "";
        //connexion au base de donnee
        $connexion = new PDO("mysql:host=$server;dbname=$nom_bdd", $user, $password);

        $id_m = $_POST['id_m'];
        $to='aecole023@gmail.com';
        $nbrj=$_POST['nbrjour'];
        $dateabs=$_POST['date_absence'];
        $cause=$_POST['subject'];

        $requete="SELECT * FROM employee where id='$id_m'";
        $resultat=$connexion->query($requete);
        if ($row=$resultat->fetch()) {
            $nom=$row['Nom'];
            $prenom=$row['Prenom'];
            $gmail=$row['Email'];
        }

        $sujet = "Notification d'absence de " . $nom . " " . $prenom . "." ;

        $message = "<p>Le moniteur de conduite " . $nom . " " . $prenom . " sera absent le " .$dateabs. " pour une durée de " . $nbrj . " jour(s).</p></br>";
        $message .= "<p>Cause: \"" . $cause . "\"</p></br>";
        $message .= "</br></br>E-mail de contact: " . $gmail;

        $headers = "From: Auto-École <aecole023@gmail.com>\r\n";
        $headers .= "Reply-To: ". $gmail . "\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";

        mail($to, $sujet, $message, $headers);

        $message1="Le moniteur de conduite : ".$nom." ".$prenom." sera absent le ". $dateabs ." pour ".$nbrj." jour(s), cause : <br>\"".$cause."\"";
        $date_m=date('U');
        $resultat2=$connexion->query("INSERT INTO notification (`name`,`message`,`status`,`date`,`id_employee`) VALUES('Notification d\'absence','$message1','0','$date_m', '2')");

        $mesCandidats = null;
        $i = 0;

        $resultat=$connexion->query("SELECT * FROM `candidat` WHERE id_m=$id_m");
        while ($row=$resultat->fetch()) {
            $mesCandidats[$i] = $row['id_c'];
            $i = $i + 1;
        }

        foreach ($mesCandidats as $nextID) {
            $message2="Votre moniteur de conduite, ".$nom." ".$prenom." sera absent le ". $dateabs ." pour ".$nbrj." jour(s).";
            $date_m=date('U');
            $resultat2=$connexion->query("INSERT INTO notification (`name`,`message`,`status`,`date`,`id_candidat`) VALUES('Notification d\'absence','$message2','0','$date_m', '$nextID')");
        }

        header("Location:absence.php?absence=envoyer");

    } catch (PDOException $e) {
        echo "Erreur ! " . $e->getMessage() . "<br/>";
    }
?>