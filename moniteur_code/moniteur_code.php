<!-------------------------------------------------- Press CTRL+K+T then Press CTRL+K+2 -------------------------------------------------->
<!---------------------------------------------------- PHP pour recuperer id connecte ---------------------------------------------------->
<?php
session_start();
include("../db_connexion.php");
    $dbhost = DB_SERVER; // set the hostname
    $dbname = DB_DATABASE ; // set the database name
    $dbuser = DB_USERNAME ; // set the mysql username
    $dbpass = DB_PASSWORD;  // set the mysql password
    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    try{
        require_once('../db_connexion.php');
        if(!isset($_SESSION['id'])) {
            header("Location:../page_connexion.html");
        }else{
            $id_c=$_SESSION['id'];
            $requete1="SELECT * FROM `employee` WHERE id='$id_c'";
            $resultat1=$connexion->query($requete1);
            
            while($row=$resultat1->fetch()) {
                $id=$row['id'];
                $nom=$row['Nom'];
                $prenom=$row['Prenom'];
                $naissance=$row['Naissance'];
                $ville=$row['Ville'];
                $email=$row['Email'];
                $phone=$row['Telephone'];
                $pw=$row['Password'];
                $photo=$row['Photo'];
            }
        }

        if (isset($_POST['dec'])) {
            unset($_SESSION['id']);
            header("Location: ../page_connexion.html");
        }
    }catch (PDOException $e) {
        echo "Erreur ! " . $e->getMessage() . "<br/>";
    }
    ?>
    <!---------------------------------------------------------------- FIN PHP --------------------------------------------------------------->

    <!--------------------------------------------------------------- HTML CODE -------------------------------------------------------------->
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
        <title><?php echo $nom . " " . $prenom ?> :: Moniteur Code</title>

        <link rel="stylesheet" type="text/css" href="../ressource/css/style_table.css">
        <link rel="stylesheet" type="text/css" href="../ressource/css/moniteur_code/ssss.css">
        <link rel="stylesheet" type="text/css" href="../ressource/css/moniteur_code/style_g.css">
        <link rel="stylesheet" type="text/css" href="../ressource/css/moniteur_code/style_ajouter.css">
        
        <link rel="stylesheet" type="text/css" href="../ressource/css/moniteur_code/style_l.css">
        <link rel="stylesheet" type="text/css" href="../ressource/css/moniteur_code/style_menu_left.css">


        <link rel="stylesheet" type="text/css" href="../ressource/css/style_global.css">
        <link rel="stylesheet" type="text/css" href="../ressource/css/style_menu_left.css">
        <link rel="stylesheet" type="text/css" href="../ressource/css/style_table.css">
        <link rel="stylesheet" type="text/css" href="../ressource/css/style_ajouter.css">


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
        
        
        <script src="../ressource/js/moniteur_code/menu.js"></script>
        <script src="../ressource/js/moniteur_code/menu-left.js"></script>
        <script src="../ressource/js/notification.js"></script>
        <script src="../ressource/js/moniteur_code/ajouter.js"></script>
        <script src="../ressource/js/jquery.js"></script>
        
    </head>
    <?php
        $divSelect = isset($_GET["open"]) ? $_GET["open"] : "";
        $notifVu = isset($_GET["vu"]) ? $_GET["vu"] : "";
        if ($divSelect != ""){
            $myServerData = $divSelect . "();";

        }
        else{
            $myServerData = "liste();";
        }
        if ($notifVu != "") {
            $vuData = "notificationVu(" . $notifVu . ")";
        }
        else {
            $vuData = "";
        }

    ?>
    <body onload="removeLoader();<?php echo $myServerData . $vuData; ?>">
        <!----------------------------------------- loading --------------------------------------------->
        <div id="loading" class="loader"></div>
        <!------------------------------------------------------------------------------------------->
        <!-------------------------------------------- border --------------------------------------------->
        <div id="sidePanel" class="sidebar">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i id="arrows" class="las la-angle-double-left"></i></a>
            
            <a onclick="resultat()"><i class="la la-clipboard"></i> Résultat d'examen</a>
            <a onclick="liste()"><i class="la la-list-ul"></i> Liste des candidats</a>
            <a onclick="candidatpret()"><i class="la la-check-square"></i> Candidats prêts à passer l'examen</a>
            <div onmouseover="afficherListeGerer()" onmouseout="cacherListeGerer()">
                <a><i class="la la-edit"></i> Gérer Test QCM</a>
                <div class="ids" id="type_employe">
                    <a onclick="test()"><i class="la la-edit"></i>Ajouter Des Questions</a>
                    <a onclick="modifiertest()"><i class="la la-edit"></i>Modifier Des Questions</a>
                </div>
            </div>
            <a onclick="absence()"><i class="la la-calendar-times-o"></i> Notifier une absence</a>
            <div onmouseover="afficherListeText()" onmouseout="cacherListeText()">
			<a><i class="las la-comment"></i> Contact</a>
			<div id="text" class="ids">
				<a onclick="contactSup()"><i class="las la-sms"></i> Superviseur</a>
				<a onclick="contactGer()"><i class="las la-sms"></i> Gerant</a>
				<a onclick="contactCan()"><i class="las la-sms"></i> Candidats</a>
			</div>
		</div>
        </div>
        <form method="POST">
            <div class="right-menu">

                <div class="imgNav">
                    <a class="pImage"><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($photo).'"/>'; ?></a>
                </div>

                <div class="leftNav"> 

                    <a class="nameNav">

                        <?php echo $nom;?>
                        <?php echo $prenom;?>
                    </a>
                </div>

                <div class="topnav" id="myTopnav">
                    
                    <a class="active" href="moniteur_code.php">Moniteur De Code</a>
                    <a  href="profile.php">Profil</a>
                    <?php
                        $resultat=$connexion->query("SELECT * FROM notification WHERE status='0' AND id_employee='$id'");
                        
                        if ($resultat->rowCount()>0) {
                    ?>
                            <a href="#" onclick="afficherNotification();notificationVu(<?php echo $id?>)"><i class="fa fa-bell"><span id="nbNotif"><?php echo $resultat->rowCount(); ?></span></i></a>
                   <?php
                        } else {
                    ?>
                            <a href="#" onclick="afficherNotification()"><i class="fa fa-bell"><span class="nbNotif"></span></i></a>
                    <?php
                        }  
                    ?>
                    <a class="buttonLink">
                        <button class="deco" name="dec">Se deconnecter</button>     
                    </form>
                </a>
                
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                    <i class="fa fa-bars"></i>
                </a>
            </div>

        </div>
        <!----------------------------------------------------------------------------------------------------------------------------------------->




        
        <!----------------------------------------------------- DIV RESULTAT CODE ---------------------------------------------------------->
    <div id="resultatexaman" class="contain">
        <div class="liste">
            <h1>Saisir un résultat d'examen</h1>
            <table class="modTable">
                <tr class="modRow" >
                    <th class="modTh"></th>
                    <th class="modTh">Nom et Prénom</th>
                    <th class="modTh">Date Examen</th>
                    <th class="modTh">Note Examen</th>
                </tr>

                <?php
                    try {
                        $resultat=$connexion->query("SELECT * FROM `candidat` WHERE id_m='$id'");
                        while ($row=$resultat->fetch()) {
                            $photo=$row['Photo'];
                            $id_c=$row['id_c'];
                            $nom_c=$row['Nom'];
                            $prenom_c=$row['Prenom'];
                ?>

                <tr class="modTr">
                    <td class="modTd"><?php echo '<img class="cadre" src="data:image/jpeg;base64,'.base64_encode($photo).'"/>'; ?></td>
                    <td class="modTd"><?php echo $nom_c;?> <?php echo $prenom_c;?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="id_c" value="<?php echo $id_c; ?>">
                            <input type="hidden" name="nom_c" value="<?php echo $nom_c; ?>">
                            <input type="hidden" name="prenom_c" value="<?php echo $prenom_c; ?>">
                            <input class="ab" type="date" name="date_e" value="<?php echo date("Y-m-d");?>">
                    </td>
                    <td>
                            <select id="result" name="result">
                                <option value="réussi" selected>Réussi</option>
                                <option value="echoué">Echoué</option>
                            </select>
                    </td>
                    <td class="buttonSized">
                            <button name="add_result" class="modifier"><i class="las la-plus"></i></button>
                        </form>
                    </td>
                    <td class="buttonSized">
                        <form method="POST" action="resultat_code.php">
                            <input type="hidden" name="id_m" value="<?php echo $id; ?>">
                            <input type="hidden" name="id_c" value="<?php echo $id_c; ?>">
                            <button name="details" class="supprim"><i class="las la-history"></i></button>
                        </form>
                    </td>

                    <?php
                        if (isset($_POST['add_result'])) {
                            $id_c=$_POST['id_c'];
                            $nom_c=$_POST['nom_c'];
                            $prenom_c=$_POST['prenom_c'];
                            $rq=$_POST['remarque'];
                            $date_e=$_POST['date_e'];
                            $note=$_POST['result'];

                            $resultat1=$connexion->query("SELECT * FROM `resultat` WHERE id_c='$id_c' AND nom_examen='code' AND note_examen='réussi'");
                            $resultat2=$connexion->query("SELECT * FROM `resultat` WHERE id_c='$id_c' AND nom_examen='code' AND date_examen='$date_e'");
                            if ($resultat1->rowCount() != 0) {
                                echo "<script>if(confirm(\"Le candidat ".$nom_c." ".$prenom_c." a déjà réussi dans son examen de code.\")){document.location.href='moniteur_code.php'};</script>";
                            } else if ($resultat2->rowCount() != 0) {
                                echo "<script>if(confirm(\"Le candidat ".$nom_c." ".$prenom_c." a déjà été examiné le ".$date_e.".\")){document.location.href='moniteur_code.php'};</script>";
                            } else {
                                $requete1="INSERT INTO `resultat`(`nom_examen` , `note_examen`  , `date_examen`, `id_c` )
                                                        VALUES   ('code'       , '$note'        , '$date_e'    , '$id_c');";
                                $connexion->query($requete1);
                                echo "<script>if(confirm(\"Le candidat ".$nom_c." ".$prenom_c." a ".$note." dans son examen de code le ".$date_e.".\")){document.location.href='moniteur_code.php'};</script>";
                                if ($note == "réussi") {
                                	$messageN="Bravo! vous avez réussi votre examen de Code.";
						            $date_m=date('U');
						            $resultat2=$connexion->query("INSERT INTO notification (`name`,`message`,`status`,`date`,`id_candidat`) VALUES('Résultat d\'examen','$messageN','0','$date_m', '$id_c')");
                                }
                                else {
                                	$messageN="Vous avez échoué votre examen de Code.";
						            $date_m=date('U');
						            $resultat2=$connexion->query("INSERT INTO notification (`name`,`message`,`status`,`date`,`id_candidat`) VALUES('Résultat d\'examen','$messageN','0','$date_m', '$id_c')");
                                }

                                break;
                            }
                        }
                        } // close while loop
                        }catch (PDOException $e) {
                            echo "Erreur ! " . $e->getMessage() . "<br/>";
                        }
                    ?>
                </tr>
            </table>
        </div>
    </div>
    <!--------------------------------------------------- FIN DIV RESULTAT CODE -------------------------------------------------------->
    
    <!----------------------------------------------------- DIV NOTIFICATION --------------------------------------------------------->
    <div id="notification" class="contain">
        <div class="liste">
            <h1>Notification</h1>
            <?php
            $resultat1=$connexion->query("SELECT * FROM notification WHERE id_employee='$id'");
            if (! $resultat1->fetch())
                echo "<span class='niveau'>Aucune notification.</span>";
            $resultat1=$connexion->query("SELECT * FROM notification WHERE id_employee='$id'");
            while ($row=$resultat1->fetch()){
                $id_notif = $row['id_n'];
                $date=$row['date'];
                $nom=$row['name'];
                $message=$row['message'];  
                ?>
                <div class="notifComplete" id="divNotif<?php echo $id_notif?>">
                    <div class="dateNotif">
                        <?php 
                        $currDate = date('U');
                        $elapsed = $currDate - $date;
                        if ($elapsed < 60)
                            echo "Il y'a " . $elapsed . " secondes.";
                        elseif ($elapsed < 3600) {
                            if ($elapsed < 120)
                                echo "Il y'a 1 minute.";
                            else
                                echo "Il y'a " . round($elapsed / 60) . " minutes.";
                        }
                        else if ($elapsed < (3600*24)) {
                            if ($elapsed < (3600*2))
                                echo "Il y'a 1 heure.";
                            else
                                echo "Il y'a " . round($elapsed / 3600) . " heures.";
                        }
                        else
                            if ($elapsed < (3600*48))
                                echo "Il y'a 1 jour.";
                            else
                                echo "Il y'a " . round($elapsed / (3600*24)) . " jours.";
                            ?>
                        </div>
                        <div class="nomNotif"><?php echo $nom; ?></div>
                        <div class="fermerNotif" onclick="fermerNotif(<?php echo $id_notif ?>);supprimerNotif(<?php echo $id_notif ?>)"><i class="fa fa-times-circle"></i></div>
                        <div class="messageNotif"><b class="greendot">•</b> <?php echo $message; ?></div>
                    </div>

                    <?php
                }
                ?>
            </div>
        </div>
        <!----------------------------------------------------- FIN DIV NOTIFICATION --------------------------------------------------------->
        
        <!---------------------------------------------------------Modifier QST---------------------------------------------------->
        <div id="modifier">
           <form id="formulaire" method="post" action="modifier_qst.php" autocomplete="off">
            
               <table width="100%">
                <!-------------------------------Titre de formulaire----------------------------------->
                <tr>
                    <td colspan="3">
                        <label id="title"> <h1>Modifier Question et Réponse</h1>
                        </td>
                    </tr>
                    <!------------------------------------------------------------------>

                    <!-------------------------------Numero de QST----------------------------------->

                    <tr>
                        <td>
                            <label>N° Question</label>
                        </td>
                        <td  colspan="2" class="center-cell">
                            <input type="number" name="NBRQST" min="1" max="20" step="1" class="number">
                        </td>
                    </tr>
                    <!------------------------------------------------------------------>


                    <!-------------------------------LA QST----------------------------------->

                    <tr>
                        <td>
                            <label>Question :</label>
                        </td>
                        <td colspan="2">
                            <input type="text" name="NVQST">
                        </td>
                    </tr>
                    <!------------------------------------------------------------------>

                    <!-------------------------------BONNE de RPNS----------------------------------->
                    <tr>
                        <td>
                            <label>Bonne Réponse</label>
                        </td>
                        <td>
                            <input type="text" name="rps1" id="rps1">
                        </td>
                        <td>
                            <a onclick="ajouterps1()"><i class="la la-chevron-circle-down"></i></a>
                            
                        </td>
                    </tr>
                    <!------------------------------------------------------------------>


                    <!------------------------------- RPNS 1----------------------------------->
                    <tr id="a1">
                        <td>
                            <label>Autre réponse</label>
                        </td>
                        <td>
                            <input type="text" name="rps2" id="rps2">
                        </td>
                        <td>
                            <a onclick="ajouterps2()"><i class="la la-chevron-circle-down"></i></a>
                            
                            <a onclick="supprimerrps1()"><i class="la la-chevron-circle-up"></i></a>
                        </td>
                    </tr>
                    <!------------------------------------------------------------------>


                    <!------------------------------- RPNS 2----------------------------------->
                    <tr id="a2">
                        <td>
                            <label>Autre réponse</label>
                        </td>
                        <td>
                            <input type="text" name="rps3" id="rps3">
                        </td>
                        <td>
                            <a onclick="supprimerrps2()"><i class="la la-chevron-circle-up"></i></a>
                        </td>
                    </tr>
                    <!------------------------------------------------------------------>
                    <tr>
                        <td colspan="3" class="espace_2"></td>
                    </tr>

                    <!------------------------------- Button pour modifier ----------------------------------->
                    <tr>
                        <td colspan="3"  class="center-cell">
                           <button type="submit" name="modifier" class="VMQST">Modifier la question</button>
                       </td>
                   </tr>
                   <!------------------------------------------------------------------>
               </table>
           </form>
       </div>
       <!-------------------------------------------------------------------------------------------------------------------------------->





       <!--------------------------------------------------------DIV prepare de test ----------------------------------------------->
       <div id="test">

           <form id="formulaire" method="post" action="ajouter_qst.php" autocomplete="off">
            <table width="100%">
             <!-------------------------------Titre de formulaire----------------------------------->
             <tr>
               <td colspan="5">
                   <label id="title"><h1>Ajouter des questions</h1></label>
               </td>
           </tr>
           <!--------------------------------------------------------------------->
           <!------------------------------- QST 1------------------------------------------------>
           <tr>
             <td>
              <label>Question :</label>
          </td>
          <td colspan="2">
              <input type="text" name="Qst1">
          </td>
          <td>
          </td>
      </tr>
      <!----------------------------------------------------------------------->
      <!-------------------------------Bonne RPNS------------------------------------------------>
      <tr>
        <td>
            <label>Bonne Réponse</label>
        </td>
        <td>
            <input type="text" name="rps11" id="rps11">
        </td>
        <td>
            <a onclick="ajouterps11()"><i class="la la-chevron-circle-down"></i></a>
        </td>
    </tr>
    <!----------------------------------------------------------------------->
    <!-------------------------------RPNS 1 ------------------------------------------------>
    <tr id="a11">
        <td>
            <label>Autre réponse</label>
        </td>
        <td>
            <input type="text" name="rps12" id="rps12">
        </td>
        <td>
            <a onclick="ajouterps12()"><i class="la la-chevron-circle-down"></i></a>
            <a onclick="supprimerrps11()"><i class="la la-chevron-circle-up"></i></a>
        </td>
    </tr>
    <!----------------------------------------------------------------------->
    <!-------------------------------RPNS 2 ------------------------------------------------>
    <tr id="a12">
        <td>
            <label>Autre réponse</label>
        </td>
        <td>
            <input type="text" name="rps13" id="rps13">
        </td>
        <td>
            <a onclick="supprimerrps12()"><i class="la la-chevron-circle-up"></i></a>
        </td>
    </tr>
    <!----------------------------------------------------------------------->
    <!-------------------------------NV QST ------------------------------------------------>
    <tr>
       <td colspan="5">
          <a class="NQST" onclick="ajouterQST1()">Nouvelle Question</a>
      </td>
  </tr>
  <!----------------------------------------------------------------------->
</table>
<br>
<div id="nqst1">
    <table width="100%">
        <!------------------------------- titre de QST 2------------------------------------------------>
        <tr>
            <td colspan="5" id="title">
                <h1>Question 2:</h1>
            </td>
        </tr>
        <!----------------------------------------------------------------------->
        <!------------------------------- QST 2------------------------------------------------>
        <tr>
            <td>
                <label>Question :</label>
            </td>
            <td colspan="2">
               <input type="text" name="Qst2">
           </td>
           <td>
           </td>
       </tr>
       <!----------------------------------------------------------------------->
       <!------------------------------- Bonne RPS------------------------------------------------>
       <tr>
        <td>
            <label>Bonne Réponse</label>
        </td>
        <td>
            <input type="text" name="rps21" id="rps21">
        </td>
        <td>
            <a onclick="ajouterps21()"><i class="la la-chevron-circle-down"></i></a>
        </td>
    </tr>
    <!----------------------------------------------------------------------->
    <!------------------------------- RPS 1------------------------------------------------>
    <tr id="a21">
        <td>
            <label>Autre réponse</label>
        </td>
        <td>
            <input type="text" name="rps22" id="rps22">
        </td>
        <td>
            <a onclick="ajouterps22()"><i class="la la-chevron-circle-down"></i></a>
            
            <a onclick="supprimerrps21()"><i class="la la-chevron-circle-up"></i></a>
        </td>
    </tr>
    <!----------------------------------------------------------------------->
    <!------------------------------- RPS 2------------------------------------------------>
    <tr id="a22">
        <td>
            <label>Autre réponse</label>
        </td>
        <td>
            <input type="text" name="rps23" id="rps23">
        </td>
        <td>
            <a onclick="supprimerrps22()"><i class="la la-chevron-circle-up"></i></a>
        </td>
    </tr>
    <!----------------------------------------------------------------------->
    <!-------------------------------NV QST------------------------------------------------>
    <tr>
        <td colspan="5">
            <a class="NQST" onclick="ajouterQST2()">Nouvelle Question</a>
            <a class="SQST" onclick="supprimerQST2()">Supprimer Question</a>
        </td>
    </tr>
    <!----------------------------------------------------------------------->
</table>
</div><br>
<div id="nqst2">
    <table width="100%">
        <!------------------------------- titre de QST 3------------------------------------------------>
        <tr>
            <td colspan="5" id="title">
                <h1>Question 3:</h1>
            </td>
        </tr>
        <!----------------------------------------------------------------------->
        <!------------------------------- QST 3------------------------------------------------>
        <tr>
            <td>
                <label>Question :</label>
            </td>
            <td colspan="2">
               <input type="text" name="Qst3">
           </td>
           <td>
           </td>
       </tr>
       <!----------------------------------------------------------------------->
       
       <!------------------------------- Bonne RPS------------------------------------------------>
       <tr>
        <td>
            <label>Bonne Réponse</label>
        </td>
        <td>
            <input type="text" name="rps31" id="rps31">
        </td>
        <td>
            <a onclick="ajouterps31()"><i class="la la-chevron-circle-down"></i></a>
        </td>
    </tr>
    <!----------------------------------------------------------------------->
    <!------------------------------- RPS 1------------------------------------------------>
    <tr id="a31">
        <td>
            <label>Autre réponse</label>
        </td>
        <td>
            <input type="text" name="rps32" id="rps32">
        </td>
        <td>
            <a onclick="ajouterps32()"><i class="la la-chevron-circle-down"></i></a>
            
            <a onclick="supprimerrps31()"><i class="la la-chevron-circle-up"></i></a>
        </td>
    </tr>
    <!----------------------------------------------------------------------->
    <!------------------------------- RPS 2------------------------------------------------>
    <tr id="a32">
        <td>
            <label>Autre réponse</label>
        </td>
        <td>
            <input type="text" name="rps33" id="rps33">
        </td>
        <td>
            <a onclick="supprimerrps32()"><i class="la la-chevron-circle-up"></i></a>
        </td>
    </tr>
    <!----------------------------------------------------------------------->
    <!-------------------------------NV QST------------------------------------------------>
    <tr>
        <td colspan="5">
            <a class="NQST" onclick="ajouterQST3()">Nouvelle Question</a>
            <a class="SQST" onclick="supprimerQST3()">Supprimer Question</a>
        </td>
    </tr>
    <!----------------------------------------------------------------------->
</table>
</div><br>
<div id="nqst3">
    <table width="100%">
        <!------------------------------- titre de QST 4------------------------------------------------>
        <tr>
            <td colspan="5" id="title">
                <h1>Question 4:</h1>
            </td>
        </tr>
        <!----------------------------------------------------------------------->
        <!------------------------------- QST 4------------------------------------------------>
        <tr>
            <td>
                <label>Question :</label>
            </td>
            <td colspan="2">
               <input type="text" name="Qst4">
           </td>
           <td>
           </td>
       </tr>
       <!----------------------------------------------------------------------->
       
       <!------------------------------- Bonne RPS------------------------------------------------>
       <tr>
        <td>
            <label>Bonne Réponse</label>
        </td>
        <td>
            <input type="text" name="rps41" id="rps41">
        </td>
        <td>
            <a onclick="ajouterps41()"><i class="la la-chevron-circle-down"></i></a>
        </td>
    </tr>
    <!----------------------------------------------------------------------->
    <!------------------------------- RPS 1------------------------------------------------>
    <tr id="a41">
        <td>
            <label>Autre réponse</label>
        </td>
        <td>
            <input type="text" name="rps42" id="rps42">
        </td>
        <td>
            <a onclick="ajouterps42()"><i class="la la-chevron-circle-down"></i></a>
            
            <a onclick="supprimerrps41()"><i class="la la-chevron-circle-up"></i></a>
        </td>
    </tr>
    <!----------------------------------------------------------------------->
    <!------------------------------- RPS 2------------------------------------------------>
    <tr id="a42">
        <td>
            <label>Autre réponse</label>
        </td>
        <td>
            <input type="text" name="rps43" id="rps43">
        </td>
        <td>
            <a onclick="supprimerrps42()"><i class="la la-chevron-circle-up"></i></a>
        </td>
    </tr>
    <!----------------------------------------------------------------------->
    <!-------------------------------NV QST------------------------------------------------>
    <tr>
        <td colspan="5">
            <a class="NQST" onclick="ajouterQST4()">Nouvelle Question</a>
            <a class="SQST" onclick="supprimerQST4()">Supprimer Question</a>
        </td>
    </tr>
    <!----------------------------------------------------------------------->
</table>
</div><br>
<div id="nqst4">
    <table width="100%">
        <!------------------------------- titre de QST 5------------------------------------------------>
        <tr>
            <td colspan="5" id="title">
                <h1>Question 5:</h1>
            </td>
        </tr>
        <!----------------------------------------------------------------------->
        <!------------------------------- QST 5------------------------------------------------>
        <tr>
            <td>
                <label>Question :</label>
            </td>
            <td colspan="2">
               <input type="text" name="Qst5">
           </td>
           <td>
           </td>
       </tr>
       <!----------------------------------------------------------------------->
       
       <!------------------------------- Bonne RPS------------------------------------------------>
       <tr>
        <td>
            <label>Bonne Réponse</label>
        </td>
        <td>
            <input type="text" name="rps51" id="rps51">
        </td>
        <td>
            <a onclick="ajouterps51()"><i class="la la-chevron-circle-down"></i></a>
        </td>
    </tr>
    <!----------------------------------------------------------------------->
    <!------------------------------- RPS 1------------------------------------------------>
    <tr id="a51">
        <td>
            <label>Autre réponse</label>
        </td>
        <td>
            <input type="text" name="rps52" id="rps52">
        </td>
        <td>
            <a onclick="ajouterps52()"><i class="la la-chevron-circle-down"></i></a>
            
            <a onclick="supprimerrps51()"><i class="la la-chevron-circle-up"></i></a>
        </td>
    </tr>
    <!----------------------------------------------------------------------->
    <!------------------------------- RPS 2------------------------------------------------>
    <tr id="a52">
        <td>
            <label>Autre réponse</label>
        </td>
        <td>
            <input type="text" name="rps53" id="rps53">
        </td>
        <td>
            <a onclick="supprimerrps52()"><i class="la la-chevron-circle-up"></i></a>
        </td>
    </tr>
    <!----------------------------------------------------------------------->
    <!-------------------------------NV QST + SPR QST------------------------------------------------>
    <tr>
        <td colspan="5">
            <a class="NQST" onclick="ajouterQST5()">Nouvelle Question</a>
            <a class="SQST" onclick="supprimerQST5()">Supprimer Question</a>
        </td>
    </tr>
    <!----------------------------------------------------------------------->
</table>
</div><br>
<div id="nqst5">
    <table width="100%">
        <!------------------------------- titre de QST 6------------------------------------------------>
        <tr>
            <td colspan="5" id="title">
                <h1>Question 6:</h1>
            </td>
        </tr>
        <!----------------------------------------------------------------------->
        <!------------------------------- QST 6------------------------------------------------>
        <tr>
            <td>
                <label>Question :</label>
            </td>
            <td colspan="2">
               <input type="text" name="Qst6">
           </td>
           <td>
           </td>
       </tr>
       <!----------------------------------------------------------------------->
       
       <!------------------------------- Bonne RPS------------------------------------------------>
       <tr>
        <td>
            <label>Bonne Réponse</label>
        </td>
        <td>
            <input type="text" name="rps61" id="rps61">
        </td>
        <td>
            <a onclick="ajouterps61()"><i class="la la-chevron-circle-down"></i></a>
        </td>
    </tr>
    <!----------------------------------------------------------------------->
    <!------------------------------- RPS 1------------------------------------------------>
    <tr id="a61">
        <td>
            <label>Autre réponse</label>
        </td>
        <td>
            <input type="text" name="rps62" id="rps62">
        </td>
        <td>
            <a onclick="ajouterps62()"><i class="la la-chevron-circle-down"></i></a>
            
            <a onclick="supprimerrps61()"><i class="la la-chevron-circle-up"></i></a>
        </td>
    </tr>
    <!----------------------------------------------------------------------->
    <!------------------------------- RPS 2------------------------------------------------>
    <tr id="a62">
        <td>
            <label>Autre réponse</label>
        </td>
        <td>
            <input type="text" name="rps63" id="rps63">
        </td>
        <td>
            <a onclick="supprimerrps62()"><i class="la la-chevron-circle-up"></i></a>
        </td>
    </tr>
    <!----------------------------------------------------------------------->
    <!-------------------------------NV QST + SPR QST------------------------------------------------>
    <tr>
        <td colspan="5">
            <a class="NQST" onclick="ajouterQST6()">Nouvelle Question</a>
            <a class="SQST" onclick="supprimerQST6()">Supprimer Question</a>
        </td>
    </tr>
    <!----------------------------------------------------------------------->
</table>
</div><br>
<div id="nqst6">
    <table width="100%">
        <!------------------------------- titre de QST 7------------------------------------------------>
        <tr>
            <td colspan="5" id="title">
                <h1>Question 7:</h1>
            </td>
        </tr>
        <!----------------------------------------------------------------------->
        <!------------------------------- QST 7------------------------------------------------>
        <tr>
            <td>
                <label>Question :</label>
            </td>
            <td colspan="2">
               <input type="text" name="Qst7">
           </td>
           <td>
           </td>
       </tr>
       <!----------------------------------------------------------------------->
       
       <!------------------------------- Bonne RPS------------------------------------------------>
       <tr>
        <td>
            <label>Bonne Réponse</label>
        </td>
        <td>
            <input type="text" name="rps71" id="rps71">
        </td>
        <td>
            <a onclick="ajouterps71()"><i class="la la-chevron-circle-down"></i></a>
        </td>
    </tr>
    <!----------------------------------------------------------------------->
    <!------------------------------- RPS 1------------------------------------------------>
    <tr id="a71">
        <td>
            <label>Autre réponse</label>
        </td>
        <td>
            <input type="text" name="rps72" id="rps72">
        </td>
        <td>
            <a onclick="ajouterps72()"><i class="la la-chevron-circle-down"></i></a>
            
            <a onclick="supprimerrps71()"><i class="la la-chevron-circle-up"></i></a>
        </td>
    </tr>
    <!----------------------------------------------------------------------->
    <!------------------------------- RPS 2------------------------------------------------>
    <tr id="a72">
        <td>
            <label>Autre réponse</label>
        </td>
        <td>
            <input type="text" name="rps73" id="rps73">
        </td>
        <td>
            <a onclick="supprimerrps72()"><i class="la la-chevron-circle-up"></i></a>
        </td>
    </tr>
    <!----------------------------------------------------------------------->
    <!-------------------------------NV QST + SPR QST------------------------------------------------>
    <tr>
        <td colspan="5">
            <a class="NQST" onclick="ajouterQST7()">Nouvelle Question</a>
            <a class="SQST" onclick="supprimerQST7()">Supprimer Question</a>
        </td>
    </tr>
    <!----------------------------------------------------------------------->
</table>
</div><br>
<div id="nqst7">
    <table width="100%">
        <!------------------------------- titre de QST 8------------------------------------------------>
        <tr>
            <td colspan="5" id="title">
                <h1>Question 8:</h1>
            </td>
        </tr>
        <!----------------------------------------------------------------------->
        <!------------------------------- QST 8------------------------------------------------>
        <tr>
            <td>
                <label>Question :</label>
            </td>
            <td colspan="2">
               <input type="text" name="Qst8">
           </td>
           <td>
           </td>
       </tr>
       <!----------------------------------------------------------------------->
       
       <!------------------------------- Bonne RPS------------------------------------------------>
       <tr>
        <td>
            <label>Bonne Réponse</label>
        </td>
        <td>
            <input type="text" name="rps81" id="rps81">
        </td>
        <td>
            <a onclick="ajouterps81()"><i class="la la-chevron-circle-down"></i></a>
        </td>
    </tr>
    <!----------------------------------------------------------------------->
    <!------------------------------- RPS 1------------------------------------------------>
    <tr id="a81">
        <td>
            <label>Autre réponse</label>
        </td>
        <td>
            <input type="text" name="rps82" id="rps82">
        </td>
        <td>
            <a onclick="ajouterps82()"><i class="la la-chevron-circle-down"></i></a>
            
            <a onclick="supprimerrps81()"><i class="la la-chevron-circle-up"></i></a>
        </td>
    </tr>
    <!----------------------------------------------------------------------->
    <!------------------------------- RPS 2------------------------------------------------>
    <tr id="a82">
        <td>
            <label>Autre réponse</label>
        </td>
        <td>
            <input type="text" name="rps83" id="rps83">
        </td>
        <td>
            <a onclick="supprimerrps82()"><i class="la la-chevron-circle-up"></i></a>
        </td>
    </tr>
    <!----------------------------------------------------------------------->
    <!-------------------------------NV QST + SPR QST------------------------------------------------>
    <tr>
        <td colspan="5">
            <a class="NQST" onclick="ajouterQST8()">Nouvelle Question</a>
            <a class="SQST" onclick="supprimerQST8()">Supprimer Question</a>
        </td>
    </tr>
    <!----------------------------------------------------------------------->
</table>
</div><br>
<div id="nqst8">
    <table width="100%">
        <!------------------------------- titre de QST 9------------------------------------------------>
        <tr>
            <td colspan="5" id="title">
                <h1>Question 9:</h1>
            </td>
        </tr>
        <!----------------------------------------------------------------------->
        <!------------------------------- QST 9------------------------------------------------>
        <tr>
            <td>
                <label>Question :</label>
            </td>
            <td colspan="2">
               <input type="text" name="Qst9">
           </td>
           <td>
           </td>
       </tr>
       <!----------------------------------------------------------------------->
       
       <!------------------------------- Bonne RPS------------------------------------------------>
       <tr>
        <td>
            <label>Bonne Réponse</label>
        </td>
        <td>
            <input type="text" name="rps91" id="rps91">
        </td>
        <td>
            <a onclick="ajouterps91()"><i class="la la-chevron-circle-down"></i></a>
        </td>
    </tr>
    <!----------------------------------------------------------------------->
    <!------------------------------- RPS 1------------------------------------------------>
    <tr id="a91">
        <td>
            <label>Autre réponse</label>
        </td>
        <td>
            <input type="text" name="rps92" id="rps92">
        </td>
        <td>
            <a onclick="ajouterps92()"><i class="la la-chevron-circle-down"></i></a>
            
            <a onclick="supprimerrps91()"><i class="la la-chevron-circle-up"></i></a>
        </td>
    </tr>
    <!----------------------------------------------------------------------->
    <!------------------------------- RPS 2------------------------------------------------>
    <tr id="a92">
        <td>
            <label>Autre réponse</label>
        </td>
        <td>
            <input type="text" name="rps93" id="rps93">
        </td>
        <td>
            <a onclick="supprimerrps92()"><i class="la la-chevron-circle-up"></i></a>
        </td>
    </tr>
    <!----------------------------------------------------------------------->
    <!-------------------------------NV QST + SPR QST------------------------------------------------>
    <tr>
        <td colspan="5">
            <a class="NQST" onclick="ajouterQST9()">Nouvelle Question</a>
            <a class="SQST" onclick="supprimerQST9()">Supprimer Question</a>
        </td>
    </tr>
    <!----------------------------------------------------------------------->
</table>
</div><br>
<div id="nqst9">
    <table width="100%">
        <!------------------------------- titre de QST 10------------------------------------------------>
        <tr>
            <td colspan="5" id="title">
                <h1>Question 10:</h1>
            </td>
        </tr>
        <!----------------------------------------------------------------------->
        <!------------------------------- QST 10------------------------------------------------>
        <tr>
            <td>
                <label>Question :</label>
            </td>
            <td colspan="2">
               <input type="text" name="Qst10">
           </td>
           <td>
           </td>
       </tr>
       <!----------------------------------------------------------------------->
       
       <!------------------------------- Bonne RPS------------------------------------------------>
       <tr>
        <td>
            <label>Bonne Réponse</label>
        </td>
        <td>
            <input type="text" name="rps101" id="rps101">
        </td>
        <td>
            <a onclick="ajouterps101()"><i class="la la-chevron-circle-down"></i></a>
        </td>
    </tr>
    <!----------------------------------------------------------------------->
    <!------------------------------- RPS 1------------------------------------------------>
    <tr id="a101">
        <td>
            <label>Autre réponse</label>
        </td>
        <td>
            <input type="text" name="rps102" id="rps102">
        </td>
        <td>
            <a onclick="ajouterps102()"><i class="la la-chevron-circle-down"></i></a>
            
            <a onclick="supprimerrps101()"><i class="la la-chevron-circle-up"></i></a>
        </td>
    </tr>
    <!----------------------------------------------------------------------->
    <!------------------------------- RPS 2------------------------------------------------>
    <tr id="a102">
        <td>
            <label>Autre réponse</label>
        </td>
        <td>
            <input type="text" name="rps103" id="rps103">
        </td>
        <td>
            <a onclick="supprimerrps102()"><i class="la la-chevron-circle-up"></i></a>
        </td>
    </tr>
    <!----------------------------------------------------------------------->
    <!-------------------------------NV QST + SPR QST------------------------------------------------>
    <tr>
        <td colspan="5">
         
            <a class="SQST" onclick="supprimerQST10()">Supprimer Question</a>
        </td>
    </tr>
    <!----------------------------------------------------------------------->
</table>
</div>

<br>
<div>
    <table>
       <!-------------------------------Valider QST------------------------------------------------>
       <tr>
        <td colspan="5">
           <label id="title"><button class="VQST" id="VQST" name="VQST">Valider les questions</button></label> 
       </td>
   </tr>
   <!----------------------------------------------------------------------->
</table>
</div>
</form>
</div>
<!----------------------------------------------------------------------------------------------------------------------------------->







<!----------------------------------------------------------------------------------------------------------------------------------------->



<!--------------------------------------------------------DIV Liste candidat------------------------------------------------------------>
<div id="listecandidat">
   <label id="title"><h1>Liste des Candidats</h1></label>
   <table class="modTable" width="100%">
       <tr class="div8 modRow" >
       		<th>
       		</th>
           	<th>
               <u>Nom et Prénom</u>
           	</th>
	        <th>
	            <u>Date de naissance</u>
	        </th>
	        <th>
	            <u>Genre</u>
	        </th>
	        <th>
	            <u>Type Voiture</u>
	        </th>
	        <th>
	            <u>Téléphone</u>
	        </th>
	        <th>
	         	<u>E-mail</u>
	     	</th>
 		</tr> 
 <?php

 $nom_bdd = "auto_ecole";
 $server = "localhost"; $user = "root"; $password = "";
 $connexion = new PDO("mysql:host=$server;dbname=$nom_bdd", $user, $password);
 
 $resultat=$connexion->query("SELECT * FROM `candidat` WHERE  id_m=$id;");
 while ($row=$resultat->fetch()) {
    
    $nom=$row['Nom'];
    $prenom=$row['Prenom'];
    $genre=$row['Genre'];
    $datenaiss=$row['Naissance'];
    $typeV=$row['TypeV'];
    $tlfn=$row['Telephone'];
    $categorie=$row['categorie'];
    $Gmail=$row['Email'];
    $photo = $row['Photo'];
    


    ?>              
    <tr class="modTr">
    	<td class="modTd"><?php echo '<img class="cadre" src="data:image/jpeg;base64,'.base64_encode($photo).'"/>'; ?></td>
        <td  class="div7">
            <?php echo ucfirst($nom);?>
            <?php echo ucfirst($prenom);?>
        </td>
        <td  class="div7">
            <?php echo $datenaiss;?>
        </td>
        <td class="div7">
            <?php echo $genre;?>
        </td>
        <td class="div7">
            <?php echo ucfirst($typeV);?>
        </td>
        <td class="div7">
            <?php echo $tlfn;?>
        </td>
        <td class="div7">
            <?php echo $Gmail;?>
        </td>
    </tr>
    <?php
}
?>

</table>

</div>

<!------------------------------------------------------------------------------------------------------------------>
<!--------------------------------------------------------DIV candidat pret ------------------------------------------------------------>
<div id="candidatpret">
 <label id="title"> <h1>Candidats prêts à passer l'examen</h1></label>
 <table class="modTable" width="100%">
   <tr class="div8 modRow" >
      <th class="modTh">Nom et Prénom</th>
      <th class="modTh">
        <u>Date de naissance</u>
    </th> 
    <th class="modTh">
        <u>Genre</u>
    </th>
    <th class="modTh">
        <u>Type de voiture</u>
    </th>
    <th class="modTh">
        <u>Téléphone</u>
    </th>
    <th class="modTh">
     <u>E-mail</u>
 </th>
 <th class="modTh">
    <u>Note</u>
</th>

</tr> 
<?php

$nom_bdd = "auto_ecole";
$server = "localhost"; $user = "root"; $password = "";
$connexion = new PDO("mysql:host=$server;dbname=$nom_bdd", $user, $password);


$resultat=$connexion->query("SELECT * FROM `candidat`,resultat WHERE candidat.id_c=resultat.id_c and nom_examen='QCM Code' and note_examen='Réussi' ");
while ($row=$resultat->fetch()) {
    ?>              
    <tr class="modTr">
     <td class="modTd"><?php echo $row['Nom'];?> <?php echo $row['Prenom'];?></td>
    <td class="modTd">
        <?php echo $row['Naissance'];?>
    </td>
    <td class="modTd">
        <?php echo $row['Genre'];?>
    </td>
    <td class="modTd">
        <?php echo ucfirst($row['TypeV']);?>
    </td>
    <td class="modTd">
        <?php echo $row['Telephone'];?>
    </td>
    <td class="modTd">
        <?php echo $row['Email'];?>
    </td>
    <td class="modTd">
        <?php echo $row['note_examen'];  ?>
    </td>
</tr>
<?php
}


?>
</table>

</div>
	<!--------------------------------------------------------- DIV Text --------------------------------------------------------------->
	<div id="divText" class="sub_liste">
		<h1>Contacter le superviseur</h1>
		<table class="modTable">
			<tr class="modRow" >
				<th class="modTh"></th>
				<th class="modTh">Nom et Prénom</th>
				<th class="modTh">E-mail</th>
				<th class="modTh">Téléphone</th>
			</tr>

			<?php
				try {
					$resultat=$connexion->query("SELECT * FROM `employee` WHERE id_role='1'");
					while ($row=$resultat->fetch()) {
						$photo=$row['Photo'];
						$nom=$row['Nom'];
						$prenom=$row['Prenom'];
						$email=$row['Email'];
						$telephone=$row['Telephone'];
			?>

			<tr class="modTr">
				<td class="modTd"><?php echo '<img class="cadre" src="data:image/jpeg;base64,'.base64_encode($photo).'"/>'; ?></td>
				<td class="modTd"><?php echo $nom;?> <?php echo $prenom;?></td>
				<td class="modTd"><?php echo $email;?></td>
				<td class="modTd"><?php echo $telephone;?></td>
				<?php
					} // close while loop
					}catch (PDOException $e) {
						echo "Erreur ! " . $e->getMessage() . "<br/>";
					}
				?>
			</tr>
		</table>
	</div>
	<!------------------------------------------------------- FIN DIV Text ------------------------------------------------------------->


	<!--------------------------------------------------------- DIV Text2 --------------------------------------------------------------->
	<div id="divText2" class="sub_liste">
		<h1>Contacter les Gerants</h1>
		<table class="modTable">
			<tr class="modRow" >
				<th class="modTh"></th>
				<th class="modTh">Nom et Prénom</th>
				<th class="modTh">E-mail</th>
				<th class="modTh">Téléphone</th>
			</tr>

			<?php
				try {
					$resultat=$connexion->query("SELECT * FROM `employee` WHERE id_role='2'");
					while ($row=$resultat->fetch()) {
						$photo=$row['Photo'];
						$nom=$row['Nom'];
						$prenom=$row['Prenom'];
						$email=$row['Email'];
						$telephone=$row['Telephone'];
			?>

			<tr class="modTr">
				<td class="modTd"><?php echo '<img class="cadre" src="data:image/jpeg;base64,'.base64_encode($photo).'"/>'; ?></td>
				<td class="modTd"><?php echo $nom;?> <?php echo $prenom;?></td>
				<td class="modTd"><?php echo $email;?></td>
				<td class="modTd"><?php echo $telephone;?></td>
				<?php
					} // close while loop
					}catch (PDOException $e) {
						echo "Erreur ! " . $e->getMessage() . "<br/>";
					}
				?>
			</tr>
		</table>
	</div>
	<!------------------------------------------------------- FIN DIV Text2 ------------------------------------------------------------->


	<!--------------------------------------------------------- DIV Text3 --------------------------------------------------------------->
	<div id="divText3" class="sub_liste">
		<h1>Contacter mes candidats</h1>
		<table class="modTable">
			<tr class="modRow" >
				<th class="modTh"></th>
				<th class="modTh">Nom et Prénom</th>
				<th class="modTh">E-mail</th>
				<th class="modTh">Téléphone</th>
			</tr>

			<?php
				try {
					$resultat=$connexion->query("SELECT * FROM `candidat` WHERE id_m='$id'");
					while ($row=$resultat->fetch()) {
						$photo=$row['Photo'];
						$nom=$row['Nom'];
						$prenom=$row['Prenom'];
						$email=$row['Email'];
						$telephone=$row['Telephone'];
			?>

			<tr class="modTr">
				<td class="modTd"><?php echo '<img class="cadre" src="data:image/jpeg;base64,'.base64_encode($photo).'"/>'; ?></td>
				<td class="modTd"><?php echo $nom;?> <?php echo $prenom;?></td>
				<td class="modTd"><?php echo $email;?></td>
				<td class="modTd"><?php echo $telephone;?></td>
				<?php
					} // close while loop
					}catch (PDOException $e) {
						echo "Erreur ! " . $e->getMessage() . "<br/>";
					}
				?>
			</tr>
		</table>
	</div>
	<!------------------------------------------------------- FIN DIV Text3 ------------------------------------------------------------->

<!------------------------------------------------------------------------------------------------------------------> 
</body>
</html>