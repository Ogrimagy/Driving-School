<?php
	if (isset($_POST['absence'])) {
		$to='aecole023@gmail.com';
		$nbrj=$_POST['nbrjour'];
		$dateabs=$_POST['date_absence'];
		$cause=$_POST['subject'];
		$id_m=$_POST["id"];

		$requete="SELECT * FROM employee where id='$id_m'";
		$resultat=$connexion->query($requete);
		if ($row=$resultat->fetch()) {
			$nom=$row['Nom'];
			$prenom=$row['Prenom'];
			$gmail=$row['Email'];
		}
        $sujet = "Notification d'absence de " . $nom . " " . $prenom . "." ;

        $message = "<p>Le moniteur de code " . $nom . " " . $prenom . " sera absent le " .$dateabs. " pour une durée de " . $nbrj . " jour(s).</p></br>";
        $message .= "<p>Cause: \"" . $cause . "\"</p></br>";
        $message .= "</br></br>E-mail de contact: " . $gmail;

        $headers = "From: Auto-École <aecole023@gmail.com>\r\n";
        $headers .= "Reply-To: ". $gmail . "\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";

        mail($to, $sujet, $message, $headers);

		$message1="Le moniteur de code : ".$nom." ".$prenom." sera absent le ".$dateabs." pour ".$nbrj." jour(s), cause : <br>\"".$cause."\"";
		$date_m=date('U');
		$resultat2=$connexion->query("INSERT INTO notification (`name`,`message`,`status`,`date`,`id_employee`) VALUES('Notification d\'absence','$message1','0','$date_m', '2')");
		header("Location: page_contact.php?message=envoyer");
	}else{
		echo "Something went wrong!";
	}
?>