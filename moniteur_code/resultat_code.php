<!---------------------------------------------------- PHP pour recuperer id connecte ---------------------------------------------------->
<?php
    session_start();
    require_once('../db_connexion.php');
    if(isset($_POST['details'])) {

        $id_m=$_POST['id_m'];
        $requete1="SELECT * FROM `employee` WHERE id='$id_m'";
        $resultat1=$connexion->query($requete1);

        while($row=$resultat1->fetch()) {
            $id=$row['id'];
            $nom=$row['Nom'];
            $prenom=$row['Prenom'];
            $photo=$row['Photo'];
        }
?>
<!---------------------------------------------------------------------------------------------------------------------------------------->

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Page moniteur de code</title>
    <link rel="stylesheet" type="text/css" href="../ressource/css/style_global.css">
    <link rel="stylesheet" type="text/css" href="../ressource/css/style_menu_left.css">
    <link rel="stylesheet" type="text/css" href="../ressource/css/style_ajouter.css">
    <link rel="stylesheet" type="text/css" href="../ressource/css/style_table.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <script src="../ressource/js/menu.js"></script>
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
            <a class="active" href="moniteur_code.php">Moniteur De Code</a>
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
    <!------------------------------------------------------- FIN STYLE DE PAGE --------------------------------------------------------->


    <!------------------------------------------------------- DIV Ajout Employee -------------------------------------------------------->
    <center>
        <div class="newpage">
            <?php
            if(isset($_POST['details'])) {
                $id_c=$_POST['id_c'];
                $requete2="SELECT * FROM `candidat` WHERE id_c='$id_c'";
                $resultat2=$connexion->query($requete2);
                while($row=$resultat2->fetch()) {
                    $nom_c=$row['Nom'];
                    $prenom_c=$row['Prenom'];
                }
            ?>

            <h1><?php echo $nom_c; ?> <?php echo $prenom_c; ?></h1>
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

                        echo "<script>if(confirm(\"Vous avez supprimer un ligne avec succès.\")){document.location.href='moniteur_code.php'};</script>";
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