<!---------------------------------------------------- PHP pour recuperer id connecte ---------------------------------------------------->
<?php
    session_start();
    require_once('../db_connexion.php');
    if(isset($_POST['rs_circuit'])) {
        $id_m=$_POST['id_m'];
        $requete1="SELECT * FROM `employee` WHERE id='$id_m'";
        $resultat1=$connexion->query($requete1);

        while($row=$resultat1->fetch()) {
            $id=$row['id'];
            $nom=$row['Nom'];
            $prenom=$row['Prenom'];
            $photo=$row['Photo'];
        }
    }
    if(isset($_POST['rs_circuit'])) {
        $finder=$_POST['id_c'];
        $rq="SELECT * FROM `candidat` WHERE id_c='$finder'";
        $res=$connexion->query($rq);
        while($row=$res->fetch()) {
            $dpNom=$row['Nom'];
            $dpPre=$row['Prenom'];
    }
?>
<!---------------------------------------------------------------------------------------------------------------------------------------->

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title><?php echo ucfirst($dpNom) . " " . ucfirst($dpPre) ?> :: Historique</title>
    <link rel="stylesheet" type="text/css" href="../ressource/css/style_global.css">
    <link rel="stylesheet" type="text/css" href="../ressource/css/style_menu_left.css">
    <link rel="stylesheet" type="text/css" href="../ressource/css/style_table.css">
    <link rel="stylesheet" type="text/css" href="../ressource/css/moniteur_code/style_g.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <script src="../ressource/js/menu.js"></script>
    <script src="../ressource/js/moniteur_conduite/menu-left.js"></script>
    <script src="../ressource/js/notification.js"></script>
</head>
 
<body onload="removeLoader()">
    <!--------------------------------------------------------- STYLE DE PAGE ----------------------------------------------------------->
    <div class="right-menu">
        <div class="imgNav">
            <a class="pImage"><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($photo).'"/>'; ?></a>
        </div>
        <div class="leftNav"> 
            <a class="nameNav">
                <?php echo $nom; ?>
                <?php echo $prenom; ?>
            </a>
        </div>
        <div class="topnav" id="myTopnav">
            <a class="active" href="moniteur_conduite.php">Moniteur de conduite</a>
            <a href="moniteur_conduite.php?open=afficherProfile">Profil</a>
            <?php
                $resultat=$connexion->query("SELECT * FROM notification WHERE status='0' AND id_employee='$id'");
                
                if ($resultat->rowCount()>0) {
            ?>
                    <a href="moniteur_conduite.php?open=afficherNotification&vu=<?php echo $id?>" onclick="afficherNotification();notificationVu(<?php echo $id?>)"><i class="fa fa-bell"><span id="nbNotif"><?php echo $resultat->rowCount(); ?></span></i></a>
           <?php
                } else {
            ?>
                    <a href="moniteur_conduite.php?open=afficherNotification" onclick="afficherNotification()"><i class="fa fa-bell"><span class="nbNotif"></span></i></a>
            <?php
                }  
            ?>
            <a class="buttonLink">
                <form method="POST">    
                    <button class="deco" name="dec">Se deconnecter</button>     
                </form>
            </a>
            <?php }
                if (isset($_POST['dec'])) {
                    unset($_SESSION['id']);
                    header("Location: ../page_connexion.html");
                }
            ?>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
        </div>
    </div>
    <div id="sidePanel" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i id="arrows" class="las la-angle-double-left"></i></a>
        <a href="moniteur_conduite.php?open=resultatCreno" onclick="resultatCreno()"><i class="las la-clipboard"></i> Résultats d'examen</a>
        <a href="moniteur_conduite.php?open=listeCanCond" onclick="listeCanCond()"><i class="la la-list-ul"></i> Liste des candidats</a>
        <a onclick="window.location.href='absence.php'"><i class="la la-calendar-times-o"></i> Notifier une absence</a>
        <!--<div onmouseover="afficherListeText()" onmouseout="cacherListeText()">
            <a><i class="las la-comment"></i> Contact</a>
            <div id="text" class="ids">
                <a href="moniteur_conduite.php?open=textSuperviseur"><i class="las la-sms"></i> Superviseur</a>
                <a href="moniteur_conduite.php?open=textGerant"><i class="las la-sms"></i> Gerant</a>
                <a href="moniteur_conduite.php?open=textCandidat"><i class="las la-sms"></i> Candidats</a>
            </div>
        </div>-->

    </div>
    <!------------------------------------------------------- FIN STYLE DE PAGE --------------------------------------------------------->


    <!------------------------------------------------------- DIV Ajout Employee -------------------------------------------------------->
    <center>
        <div class="newpage">
            <?php
            if(isset($_POST['rs_circuit'])) {
                $id_c=$_POST['id_c'];
                $requete2="SELECT * FROM `candidat` WHERE id_c='$id_c'";
                $resultat2=$connexion->query($requete2);
                while($row=$resultat2->fetch()) {
                    $nom_c=$row['Nom'];
                    $prenom_c=$row['Prenom'];
                }
            ?>

            <h1><?php echo ucfirst($nom_c); ?> <?php echo ucfirst($prenom_c); ?></h1>
            <table class="modTable">
                <tr class="modRow" >
                    <th class="modTh">Niveau</th>
                    <th class="modTh">Date</th>
                    <th class="modTh">Note</th>
                </tr>
                <?php
                    $resultat=$connexion->query("SELECT * FROM `resultat` WHERE id_c='$id_c'");
                    while ($row=$resultat->fetch()) {
                        $id_ex=$row['id_examen'];
                        $niv_ex=$row['nom_examen'];
                        $date_ex=$row['date_examen'];
                        $note_ex=$row['note_examen'];
                ?>
                <tr class="modTr">
                    <td class="modTd"><?php echo ucfirst($niv_ex);?></td>
                    <td class="modTd"><?php echo $date_ex;?></td>
                    <td class="modTd"><?php echo ucfirst($note_ex);?></td>
                    <td class="buttonSized">
                        <form method="POST">
                            <input type="hidden" name="id_exam" value="<?php  echo $id_ex;?>">
                            <button name="supprimer" class="supprim"><i class="las la-minus"></i></button>
                        </form>
                    </td>
                </tr>
                <?php
                }
                    }
                    if (isset($_POST['supprimer'])) {
                        $id_ex=$_POST['id_exam'];

                        $requete="DELETE FROM `resultat` WHERE id_examen='$id_ex'";
                        $connexion->query($requete);

                        echo "<script>if(confirm(\"Vous avez supprimer un ligne avec succès.\")){document.location.href='moniteur_conduite.php'};</script>";
                    }
                ?>
            </table>
        </div>
    </center>
    <!----------------------------------------------------- Fin DIV Ajout EMPLOYE ------------------------------------------------------->
    

    <!---------------------------------------------------------- Footer ----------------------------------------------------------------->
    <div class="foooter">
        <footer id="footer">
            <div id="footer-content">
                <center>
                    <a href="#">à propos</a>
                    <a href="#">centre d'assistance</a>
                    <a href="#">conditions</a>
                    <a href="#">blog</a>
                    <a href="#">© 2020 TOXY</a>
                </center>
            </div>
        </footer>
    </div>
    <!-------------------------------------------------------- FIN FOOTER --------------------------------------------------------------->

</body>
</html>