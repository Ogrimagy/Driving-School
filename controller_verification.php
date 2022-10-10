<?php
	header('content-type: text/html; charset=utf-8');
    session_start();

    try{

        require_once('db_connexion.php');    

        $email=$_POST['email'];
   		$mot_passe=$_POST['password'];

        $requete="SELECT * from candidat where Email='$email' AND Password='$mot_passe'";
        $resultat=$connexion->query($requete);

        $requete1="SELECT * from employee where Email='$email' AND Password='$mot_passe'";
        $resultat1=$connexion->query($requete1);

        if( $resultat ->rowCount() > 0){
            while($row=$resultat->fetch()) {
                $id=$row['id_c'];
            }
            $_SESSION['id_c']=$id;
            header("Location:candidat/candidat.php");
        } else if ($resultat1 ->rowCount() > 0){
            while($row=$resultat1->fetch()) {
                $id=$row['id'];
                $id_role=$row['id_role'];
            }
            $_SESSION['id']=$id;
            if($id_role == '1'){
                header("Location: superviseur/superviseur.php");
            }else if($id_role == '2'){
                header("Location: gerant/gerant.php");
            }else if($id_role == '3'){
                header("Location: moniteur_code/moniteur_code.php");
            }else if($id_role == '4'){
                header("Location: moniteur_conduite/moniteur_conduite.php");
            }
        }
        else
            echo "<script>if(confirm(\"Adresse email ou Mot de passe invalide\")){document.location.href='page_connexion.html'};</script>";

    }catch (PDOException $e) {
        echo "Erreur ! " . $e->getMessage() . "<br/>";
    }
 ?>