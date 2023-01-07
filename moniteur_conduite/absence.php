<!---------------------------------------------------- PHP pour recuperer id connecte ---------------------------------------------------->
<?php
session_start();

try{
    $nom_bdd = "auto_ecole";
    $server = "localhost"; $user = "root"; $password = "";
    //connexion au base de donnee
    $connexion = new PDO("mysql:host=$server;dbname=$nom_bdd", $user, $password);

    if(!isset($_SESSION['id'])) {
        header("Location:connection.php");

    }else{

        $id_s=$_SESSION['id'];
        $requete1="SELECT * from `employee` where id='$id_s'";
        $resultat1=$connexion->query($requete1);

        while($row=$resultat1->fetch()) {
            $id_m=$row['id'];
            $nom=$row['Nom'];
            $prenom=$row['Prenom'];
            $photo=$row['Photo'];
            $id=$row['id'];
        }
        if (isset($_POST['dec'])) {
            unset($_SESSION['id']);
            header("Location: ../page_connexion.html");
        }
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
    <title><?php echo $nom . " " . $prenom ?> :: Absence</title>
    <link rel="stylesheet" type="text/css" href="../ressource/css/ssss.css">
    <link rel="stylesheet" type="text/css" href="../ressource/css/moniteur_code/style_g.css">
    <link rel="stylesheet" type="text/css" href="../ressource/css/moniteur_code/style_ajouter.css">
    <link rel="stylesheet" type="text/css" href="../ressource/css/moniteur_code/style_l.css">
    <link rel="stylesheet" type="text/css" href="../ressource/css/style_global.css">
    <link rel="stylesheet" type="text/css" href="../ressource/css/style_menu_left.css">
    <link rel="stylesheet" type="text/css" href="../ressource/css/style_table.css">
    <link rel="stylesheet" type="text/css" href="../ressource/css/style_ajouter.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <script src="../ressource/js/moniteur_conduite/menu-left.js"></script>
    <script src="../ressource/js/moniteur_code/menu.js"></script>
    <script src="../ressource/js/moniteur_code/zaki.js"></script>
    <script src="../ressource/js/menu.js"></script>
    <script src="../ressource/js/notification.js"></script>
    <style>
        .causeArea {
            color: white;
            width: 98%;
        }
        .fa-check-circle {
            color: #4CAF50;
        }
    </style>
</head>
<body onload="removeLoader()">
    <div id="loading" class="loader"></div>
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

    <!----------------------------------------------------------------------------------------------------------------------------------------->
    <!-----------------------------------------------------------declarer un absence----------------------------------------------------->

    <div>
        <form id="formulaire" method="post" action="traitement_absence.php" onsubmit="event.preventDefault();"  autocomplete="off">
            <?php
                $absence = isset($_GET["absence"]) ? $_GET["absence"] : "";

                if ($absence == "envoyer") {
                    ?>
                        <div align="center">
                            <legend><i class="fa fa-check-circle fa-5x"></i></legend>
                            <p class="notifSent">Votre absence a été notifiée.</p>
                        </div>
                    <?php
                }
                else {
                    ?>
                    <table width="100%">
                        <tr>
                            <td colspan="2">
                                <label id="title"> <h1>Formulaire d'absence</h1></label>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2" class="espace"></td>
                        </tr>
                        <!-------------------------------NBR jour + date D'absence--------------------------------------------->
                        <tr>
                            <td>
                                <label class="label">Nombre de jours <div class="stars">*<span class="champReq">Champ requis</span></div></label>
                            </td>
                            <td>
                                <label  class="label">Date d'absence <div class="stars">*<span class="champReq">Champ requis</span></div></label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select id="etat" name="nbrjour">
                                    <option value="1" selected>1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </td>
                            <td>
                                <input type="date" id="date_absen" name="date_absence"  onChange="verifier_dates()"  min='2020-09-16' required>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <div class="fixed-size"><label id="err_naiss1"></label></div>
                            </td>
                        </tr>    
                        <!-------------------------------------------------------------------------------->



                        <tr>
                            <td colspan="2" class="espace"></td>
                        </tr>



                        <!----------------------------------------- la case  D'absence --------------------------------------------------->
                        <tr>
                            <td colspan="2">
                                <label for="case_absence" class="label">Cause d'absence <div class="stars">*<span class="champReq">Champ requis</span></div></label>
                                <input type="hidden" id="id_moni" name="id_m" value="<?php echo $id_m; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <textarea class="causeArea" id="subject" name="subject" placeholder="Ecrivez quelque chose.." style="height:170px " onkeyup="verifier_justif()" onchange="verifier_justif()" ></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="fixed-size"><label id="err_case"></label></div>
                            </td>
                        </tr>

                        <!------------------------------------------------------------------------------------------------>

                        <tr>
                            <td colspan="2" class="espace"></td>
                        </tr>

                        <!----------------------------------------- la case  D'absence --------------------------------------------------->
                        <tr>
                            <td colspan="2" class="center-cell">
                                <label id="err_submit"></label>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">
                                <input class="btEffacer" type="reset" id="annuler" name="annuler" value="Effacer" onclick="initialiser()">
                            </td>
                            <td align="left">
                                <button class="btValider" id="validerabsence" name="absence" onclick="validateForm()"><span>Valider</span></button>
                            </td>
                        </tr>
                        <!------------------------------------------------------------------------------------------------>
                    </table>
                <?php }
                ?>
        </form>

    </div>

    <!----------------------------------------------------------------------------------------------------------------------------------------->


    <!-------------------------------------------------Php date absence-------------------------------------------->

    <!------------------------------------------------------------------------------------------------------------>
</body>
</html>