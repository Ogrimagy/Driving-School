<!---------------------------------------------------- PHP pour recuperer id connecte ---------------------------------------------------->
<?php
    session_start();
    require_once('../db_connexion.php');
    if(isset($_POST['candidat'])) {

        $id_g=$_POST['id_g'];
        $requete1="SELECT * FROM `employee` WHERE id='$id_g'";
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
    <title>Page gérant</title>
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
            <a class="active" href="gerant.php">Gérant</a>
            <a class="buttonLink">
                <form method="POST">    
                    <button class="deco" name="dec">Se deconnecter</button>     
                </form>
            </a>
            <?php
            }
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


    <!----------------------------------------------------- DIV ABSENCE HISTORIQUE ------------------------------------------------------>
    <center>
        <div class="newpage">
            <?php
            if(isset($_POST['candidat'])) {
                $id_c=$_POST['id_c'];
                $nbr_abs=$_POST['nbr_abs'];
                $requete2="SELECT * FROM `candidat` WHERE id_c='$id_c'";
                $resultat2=$connexion->query($requete2);
                while($row=$resultat2->fetch()) {
                    $nom_c=$row['Nom'];
                    $prenom_c=$row['Prenom'];
                }
            ?>

            <h1>Liste d'absence de <?php echo $nom_c; ?> <?php echo $prenom_c; }?></h1>
            <table class="modTable">
                <tr class="modRow" >
                    <th class="modTh">Date</th>
                    <th class="modTh">Niveau</th>
                </tr>
                <?php
                    $resultat=$connexion->query("SELECT * FROM `absence` WHERE Id_c='$id_c'");
                    while ($row=$resultat->fetch()) {
                        $id_a=$row['Id_a'];
                        $date_abs=$row['Date_abs'];
                        $niv=$row['Niveau'];
                ?>
                <tr class="modTr">
                    <td class="modTd"><?php echo $date_abs;?></td>
                    <td class="modTd"><?php echo $niv;?></td>

                    <td class="buttonSized">
                        <form method="POST">
                            <input type="hidden" name="id_abs" value="<?php  echo $id_a; ?>">
                            <input type="hidden" name="id_c" value="<?php  echo $id_c; ?>">
                            <input type="hidden" name="nbr_abs" value="<?php  echo $nbr_abs; ?>">
                            <button name="supprimer" class="supprim"><i class="las la-minus"></i></button>
                        </form>
                    </td>
                </tr>
                <?php
                    }
                    if (isset($_POST['supprimer'])) {
                        $id_a=$_POST['id_abs'];
                        $id_c=$_POST['id_c'];
                        $nbr_abs=$_POST['nbr_abs'];

                        $nbr_abs=$nbr_abs-1;

                        $requete="UPDATE `candidat` SET nbr_abs='$nbr_abs' WHERE id_c='$id_c'";
                        $connexion->query($requete);

                        $requete="DELETE FROM `absence` WHERE Id_a='$id_a'";
                        $connexion->query($requete);

                        echo "<script>if(confirm(\"Vous avez supprimer un ligne avec succès.\")){document.location.href='gerant.php'};</script>";
                    }
                ?>
            </table>
        </div>
    </center>
    <!-------------------------------------------------- FIN DIV ABSENCE HISTORIQUE ----------------------------------------------------->
    

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