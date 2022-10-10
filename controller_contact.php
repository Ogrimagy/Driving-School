<?php
   header('content-type: text/html; charset=utf-8');
   
   	try {

   		
   		$nom=$_POST['nom'];
	    $prenom=$_POST['prenom'];
		$email=$_POST['mail'];
		$ville=$_POST['ville'];
		$msg=$_POST['subject'];
	    $to= 'aecole023@gmail.com';

	    if(isset($_POST['btn-send'])){
	        $sujet = $nom . " " . $prenom . " vous a envoyer un message!" ;

	        $message = "<p>Vous avez reçu un message de la part de " . $nom . " " . $prenom . " (Localisation: " . $ville . "):</p></br>";
	        $message .= $msg . "</p><br/>";
	        $message .= "</br></br>E-mail de contact: " . $email;

	        $headers = "From: Auto-École <aecole023@gmail.com>\r\n";
	        $headers .= "Reply-To: ". $email . "\r\n";
	        $headers .= "Content-type: text/html; charset=UTF-8\r\n";

	        mail($to, $sujet, $message, $headers);

	        header("Location: page_contact.php?message=envoyer");
		}

	} catch (PDOException $e) {
        echo "Erreur ! " . $e->getMessage() . "<br/>";
    }
?>