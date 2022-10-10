<?php
	header('content-type: text/html; charset=utf-8');
	session_start();

	try {

		require_once('db_connexion.php');

		$nom=$_POST['nom'];
		$prenom=$_POST['prenom'];
		$naissance=$_POST['naissance'];
		$ville=$_POST['ville'];
		$email=$_POST['ad_email'];
		$phone=$_POST['phone'];
		$typeV=$_POST['carType'];
		$etat=$_POST['etat'];
		$genre=$_POST['genre'];
		$mot_passe=$_POST['mot_passe'];
		$confirm_pw=$_POST['confirm_pw'];

		$requete="INSERT INTO `candidat` 
		(`Nom` , `Prenom` , `Naissance` , `Ville` , `Email` , `Telephone`, `TypeV` , `Etat` , `Genre` , `Password`  , `ConfirmPW`  ,`Photo`) VALUES 
		('$nom', '$prenom', '$naissance', '$ville', '$email', '$phone'   , '$typeV', '$etat', '$genre', '$mot_passe', '$confirm_pw', LOAD_FILE('C:/xampp/htdocs/Projet-AutoEcole/ressource/img/indexc.png'));";
		$resultat=$connexion->query($requete);

		$requete1="SELECT * from `candidat` where Email='$email' AND Password='$mot_passe'";
    	$resultat1=$connexion->query($requete1);
        if($resultat1->rowCount() > 0){
            while($row=$resultat1->fetch()) {
                $id=$row['id_c'];
            }
        	$_SESSION['id']=$id;
        	header("Location:candidat/candidat.php");
		}
	} catch (PDOException $e) {
		echo "Erreur ! " . $e->getMessage() . "<br/>";
	}
?>