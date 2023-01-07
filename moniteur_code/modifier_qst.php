<?php
      $nom_bdd = "auto_ecole";
$server = "localhost"; $user = "root"; $password = "";
     if (isset($_POST['modifier'])) {
     $connexion = new PDO("mysql:host=$server;dbname=$nom_bdd", $user, $password);
       $nvqst=$_POST['NVQST'];
       $nqst=$_POST['NBRQST']; 
       $nvrps1=$_POST['rps1'];
       $nvrps2=$_POST['rps2'];
       $nvrps3=$_POST['rps3'];
      $q="UPDATE question set text_q='$nvqst' where id_q='$nqst'";
      $resultat1=$connexion->query($q);
       $q1="UPDATE reponse set text_r='$nvrps1' where id_q='$nqst' and juste='oui'";
       $resultat2=$connexion->query($q1);
       $q2="UPDATE reponse set text_r='$nvrps2' where id_q='$nqst' and juste='non'";
       $resultat3=$connexion->query($q2);
       $q3="UPDATE reponse set text_r='$nvrps3' where id_q='$nqst' and juste='non'";
       $resultat4=$connexion->query($q3);
       header("location:moniteur_code.php");
     }

 ?>