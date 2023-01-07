<?php
  
                  $nom_bdd = "auto_ecole";
                  $server = "localhost"; $user = "root"; $password = "";
                   //connexion au base de donnee
                $connexion = new PDO("mysql:host=$server;dbname=$nom_bdd", $user, $password);
               if (isset($_POST['valider'])) {
                
                	$nom_examan=$_post['nom_examan'];
                	$note_examan=$_post['note_examan'];
                	$catg=$_post['catgr'];
                	$type_v=$_post['typev'];
                	$gmail=$_post['ad_email'];
                	$r="SELECT * FROM candidat where categorie='$catg' and TypeV='$type_v' and Email='$gmail'";
                	$result=$connexion->query($r);
                	while ($row=$result->fetch()) {
                		$id=$row['id_candidat'];
                	}

                	 if ($result->rowCount()>0) {
                            $r1="INSERT INTO resultat (nom_examan,note_examan,operation_examen,id_candidat) values('$nom_examan','$note_examan','0','$id')";
                          $resultat1=$connexion->query($r1);
                           echo "<script>alert(\"la resultat a etre renseigner\")</script>";
                         }
                     else
                    {
                        echo "<script>alert(\"le candidat n'existe pas\")</script>";
                    }
                }

?>