<!---------------------------------------------------- PHP pour recuperer id connecte ---------------------------------------------------->
<?php
    session_start();
    require_once('../db_connexion.php');
    if(isset($_POST['update'])) {
        $id_g=$_POST['id_g'];
        $id_mo=$_POST['id_mo'];

        if ($id_mo != NULL) {
            echo "<script>if(confirm(\"Veuillez supprimer votre moniteur avant d'ajouter un autre.\")){document.location.href='gerant.php'};</script>";
        }

        $requete1="SELECT * from `employee` where id='$id_g'";
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
    <title>Page Gérant</title>
    <link rel="stylesheet" type="text/css" href="../ressource/css/style_global.css">
    <link rel="stylesheet" type="text/css" href="../ressource/css/style_menu_left.css">
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


    <!------------------------------------------------------- DIV Ajout Moniteur -------------------------------------------------------->
    <center>
        <div class="newpage">
            <?php
                if(isset($_POST['update'])) {
                    $id_c=$_POST['id_c'];

                    $requete2="SELECT * FROM `Candidat` WHERE id_c='$id_c'";
                    $resultat2=$connexion->query($requete2);

                    while($row=$resultat2->fetch()) {
                        $nom_c=$row['Nom'];
                        $prenom_c=$row['Prenom'];
                    }
                
            ?>
            <h1>Ajouter un moniteur de code pour <?php echo $nom_c; ?> <?php echo $prenom_c; }?></h1>
            <table class="modTable">
                <tr class="modRow" >
                    <th class="modTh"></th>
                    <th class="modTh">Nom et Prénom</th>
                    <th class="modTh">Nbr Candidat</th>
                </tr>
                <?php
                    $resultat=$connexion->query("SELECT * FROM `employee` WHERE id_role='3'");
                    while ($row=$resultat->fetch()) {
                        $photo=$row['Photo'];
                        $nom=$row['Nom'];
                        $prenom=$row['Prenom'];
                        $nbr_c=$row['Nbr_c'];
                ?>
                <tr class="modTr">
                    <td class="modTd"><?php echo '<img class="cadre" src="data:image/jpeg;base64,'.base64_encode($photo).'"/>'; ?></td>
                    <td class="modTd"><?php echo $nom; ?> <?php echo $prenom;?></td>
                    <td class="modTd"><?php echo $nbr_c;?></td>
                    <td class="buttonSized">
                        <form method="POST">
                            <input type="hidden" name="id_c" value="<?php echo $id_c; ?>">
                            <input type="hidden" name="nom_m" value="<?php echo $nom; ?>">
                            <input type="hidden" name="prenom_m" value="<?php echo $prenom; ?>">
                            <input type="hidden" name="id_m" value="<?php echo $row['id']; ?>">
                            <input type="hidden" name="nbr_c" value="<?php echo $row['Nbr_c']; ?>">
                            <button name="add" class="modifier"><i class="las la-plus"></i></button>
                        </form>
                    </td>
                    <?php
                        if (isset($_POST['add'])) {
                            $id_c=$_POST['id_c'];
                            $id_m=$_POST['id_m'];
                            $nom_m=$_POST['nom_m'];
                            $prenom_m=$_POST['prenom_m'];
                            $nbr_c=$_POST['nbr_c'];
                            $nbr_c=$nbr_c+1;

                            $requete="UPDATE `Candidat` SET id_m='$id_m' WHERE id_c='$id_c'";
                            $connexion->query($requete);

                            $requete1="UPDATE `employee` SET Nbr_c='$nbr_c' WHERE id='$id_m'";
                            $connexion->query($requete1);

                            echo "<script>if(confirm(\"Vous avez affecter le moniteur ".$nom_m." ".$prenom_m." avec sucées.\")){document.location.href='gerant.php'};</script>";
                        }
                        }// close while loop
                    ?>
                </tr>
            </table>
        </div>
    </center>
    <!----------------------------------------------------- Fin DIV Ajout Moniteur ------------------------------------------------------->


	<!---------------------------------------------------------- Footer ------------------------------------------------------------------>
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
    <!-------------------------------------------------------- FIN FOOTER ---------------------------------------------------------------->

</body>
</html>