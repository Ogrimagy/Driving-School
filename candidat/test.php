<?php 
	session_start();
	header('content-type: text/html; charset=utf-8');

	include 'pdo.php';

    try{
        //Création d'une connexion avec le SGBD
        $pdo = get_pdo();

        if(!isset($_SESSION['id_c'])){
        	header("Location:page_connexion.php");
        }
        else{
        	$id_c = $_SESSION['id_c'];
        	$requete = $pdo->prepare("SELECT * FROM candidat where id_c=?");// utiliser prepare avec le marqueur ? pour éviter l'INJECTION SQL
        	$requete->execute(array($id_c));
        	
        	while($tuple=$requete->fetch()){
            	$prenom = $tuple['Prenom'];
            	$nom = $tuple['Nom'];
            	$niveau = $tuple['niveau'];
            	$mail = $tuple['Email'];
            	$photo=$tuple['Photo'];
            	$id_moniDP=$tuple['id_m'];
        	}
    	}
    	//Clôture de la connexion
		$pdo = null;
    }catch (PDOException $e) {
        die('Erreur ! '.$e->getMessage());
    }
?>

<?php
	$q = array("", "", "", "", "", "", "", "", "", "");// tableau pour stocker les questions
	$answers = array(
			array("", "", ""), 
			array("", "", ""), 
			array("", "", ""), 
			array("", "", ""), 
			array("", "", ""), 
			array("", "", ""), 
			array("", "", ""), 
			array("", "", ""), 
			array("", "", ""), 
			array("", "", "")
	);// tableau qui contient les réponses
	$answerIds = array(
			array(0, 0, 0), 
			array(0, 0, 0), 
			array(0, 0, 0), 
			array(0, 0, 0), 
			array(0, 0, 0), 
			array(0, 0, 0), 
			array(0, 0, 0), 
			array(0, 0, 0), 
			array(0, 0, 0), 
			array(0, 0, 0)
	);// tableau qui contient les id des réponses
	
	$cpt1=0;// compteur pour parcourir les tableaux de answers afin de les remplir ou lire leur contenu
	// générer des nombres aléatoires entre 1 et 20 pour les utiliser dans la récupération de 10 questions à partir du BDD
	$tmp = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0);// tableau temporaire pour stocker les nombres aléatoires
	$randomNums = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0);// tableau principale pour stocker les nombres aléatoires
	$i = 1;
	$j = 1;

	// générer le premier nombre
	$tmp[0] = rand($j, 20);
	$randomNums[0] = $tmp[0];

	// le reste des nombres
	while ($i < 10) {// on boucle 9 fois
		$tmp[$i] = rand($j, 20);// on affecte un nombre aléatoire à la case correspondante
		while (in_array($tmp[$i], $randomNums)) {// tant que la case temporaire actuelle contienne une valeur éxistante dans le tableau principale
			$tmp[$i] = rand($j, 20);// on regénère un autre nombre en appelant la fonction rand
			//echo "boucle.<br>";// affichage pour tester si la génération passe bien
		}
		$randomNums[$i] = $tmp[$i];// stocker le nouveau nombre aléatoire dans la tableau principale
		$i++;// on passe à la case suivante
	}

	try{
		//Création d'une connexion avec le SGBD
		$pdo = get_pdo();

		// récupération des questions
		for ($cpt=0; $cpt < 10; $cpt++) { 
			$requete = $pdo->prepare("SELECT * FROM question where id_q = :id_q");
			$requete->execute(array('id_q' => $randomNums[$cpt]));

			while ($row=$requete->fetch()) {
				$q[$cpt]=$row['text_q'];
			}
		}

		// récupération des réponses
		for ($cpt=0; $cpt < 10; $cpt++) { 
			$requete = $pdo->prepare("SELECT * FROM reponse where id_q = :id_q");
			$requete->execute(array('id_q' => $randomNums[$cpt]));

			$cpt1 = 0;
			while ($row=$requete->fetch()) {
				$answers[$cpt][$cpt1] = $row['text_r'];// pour le premier tour de boucle on obtient $answers[0][0] c.à.d premier choix de la première question. la derniere valeur sera $answers[9][2]
				$answerIds[$cpt][$cpt1] = $row['id_r'];
				$cpt1++;
			}
		}

		//Clôture de la connexion
		$pdo = null;
	}catch (PDOException $e) {
		die('Erreur ! '.$e->getMessage());
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
	<title>Test</title>
	<link rel="stylesheet" type="text/css" href="ressource/css/style_global.css">
	<link rel="stylesheet" type="text/css" href="ressource/css/style_test.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script type="text/javascript" src="ressource/js/test.js"></script>
</head>
<body>
  <div id="mainBox">

	<div id="top">

		<div class="imgNav">
			<a class="pImage"><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($photo).'"/>'; ?></a>
		</div>
		<div class="leftNav"> 
			<a>
				<?php echo $nom; ?>
				<?php echo $prenom; ?>
				<?php echo " <span class='nivT'><span class='niveau'>|</span> Niveau: <span class='niveau'>" . $niveau; echo "</span></span>"; ?>
				<?php
					if ($id_moniDP != null){
						$pdo = get_pdo();
						$req=$pdo->query("SELECT * FROM employee WHERE id=$id_moniDP");
						$req=$req->fetch();
						$dispMN= $req['Nom'];
						$dispMP= $req['Prenom'];
						$nomComplet = $dispMN . " " . $dispMP;
					}
					else {
						$nomComplet = "Non assigné";
					}
				?>
				<?php echo " <span class='nivT'><span class='niveau'>|</span> Moniteur: <span class='niveau'>" . $nomComplet; echo "</span></span>"; ?>
			</a>
			<a>
				
			</a>
		</div>

		<div class="topnav" id="myTopnav">

			<a href="candidat.php" class="active">Candidat</a>
			<?php
				$pdo = get_pdo();
				$resultat=$pdo->query("SELECT * FROM notification WHERE status='0' AND id_candidat='$id_c'");
				
				if ($resultat->rowCount()>0) {
			?>
					<a href="candidat.php?open=divNotification&vu=<?php echo $id_c?>" onclick="openPanelAdd('divNotification');notificationVu(<?php echo $id_c?>)"><i class="fa fa-bell"><span id="nbNotif"><?php echo $resultat->rowCount(); ?></span></i></a>
		   <?php
				} else {
			?>
					<a href="candidat.php?open=divNotification"><i class="fa fa-bell"><span id="nbNotif"></span></i></a>
			<?php
				}  
		    ?>
			<a class="buttonLink">
				<form method="POST">
					<button class="deco" name="dec">Se deconnecter</button>		
				</form>
			</a>
			<?php
	            if (isset($_POST['dec'])) {
	                unset($_SESSION['id_c']);
	                header("Location: page_connexion.php");
	            }
	        ?>
			<a href="javascript:void(0);" class="icon" onclick="myFunction()">
				<i class="fa fa-bars"></i>
			</a>
		</div>
	</div>
	<div id="main">
		<?php 
			$rep = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0);// tableau qui contient les id des réponses du candidat
			$juste = array("", "", "", "", "", "", "", "", "", "");// tableau qui contient les valeurs "oui" ou "non"
			$choixJuste = array("", "", "", "", "", "", "", "", "", "");// tableau qui contient les choix justes
			$erreur = array("", "", "", "", "", "", "", "", "", "");// tabelau qui contient les questions dont le choix du candidat est faux
			$noteTest = 0;// variable pour stocker la note du test
			$msg = "";
			$compt = 0;// compteur de boucle

			if($_SERVER["REQUEST_METHOD"] == "POST" OR $_SERVER["REQUEST_METHOD"] == "post") {

				if(!empty($_POST["rep"])){
					$taille = count($_POST["rep"]);
					$resultat = "";
					if($taille === 10){
						$k = 0;
						foreach ($_POST["rep"] as $choice) {
							$rep[$k] = test_input($choice);
							try{
								$rep[$k] = intval($rep[$k]);
							}
							catch(Exception $e){ die('Erreur ! '.$e->getMessage()); }
							$k++;
						}

						try{

							//Création d'une connexion avec le SGBD
							$pdo = get_pdo();

							// vérification de la validité des réponses du candidat
							while ($compt < 10) {// effectuer l'opération pour les 10 réponses
								$reqVerif=$pdo->prepare("SELECT * FROM reponse where id_r = :id");// utiliser prepare avec un marqueur nominatif (:id) pour éviter l'INJECTION SQL
								$reqVerif->execute(array('id' => $rep[$compt]));// le marqueur sera remplacé par $rep[$compt] au moment d'éxécution
			
								while ($rowVerif=$reqVerif->fetch()) {
									$juste[$compt] = $rowVerif['juste'];// affecter la valeur du champ 'juste' à la case en question
								}

								$compt++;
							}

							// récupére les questions dont le candidat a répondu(après validation, les questions seront changées et pour ceci on fait ce traitement)
							$qids = array(0,0,0,0,0,0,0,0,0,0);
							for ($i=0; $i < 10; $i++) { 
								$requete = $pdo->prepare("SELECT * FROM reponse where id_r=:id AND juste='non'");
								$requete->execute(array('id' => $rep[$i]));
								while($row=$requete->fetch()){
									$qids[$i]=$row['id_q'];
								}

								$requete = $pdo->prepare("SELECT * FROM question where id_q=:id");
								$requete->execute(array('id' => $qids[$i]));
								while($row=$requete->fetch()){
									$erreur[$i] = $row['text_q'];
								}
								
								// récupérer les réponses justes
								$requete = $pdo->prepare("SELECT * FROM reponse where id_q=:id AND juste='oui'");
								$requete->execute(array('id' => $qids[$i]));

								while($row=$requete->fetch()){
									$choixJuste[$i] = $row['text_r'];
								}
							}
							
							// calcul de la note du test
							for ($count=0; $count < 10; $count++) { 
								if ($juste[$count] == "oui") {
									$noteTest = $noteTest + 1;
								}
							}
							
							
							// préparer le message du résultat
							if($noteTest >= 9){
								$resultat = "réussi";
								$dateExam = date('Y-m-d');
								$requeteverification=$pdo->prepare("SELECT * FROM resultat WHERE (nom_examen=:nom_examen AND date_examen=:date_examen AND id_c=:id)");
								$requeteverification->execute(array('nom_examen' => "QCM Code", 'date_examen' => $dateExam, 'id' => $id_c));
								$nbResult = $requeteverification->rowCount();

								if($nbResult < 1){
									$requeteinsertion=$pdo->prepare("INSERT INTO resultat(nom_examen, note_examen, date_examen, id_c) VALUES(:nom_examen, :note_examen, :date_examen, :id)");
									$requeteinsertion->execute(array('nom_examen' => "QCM Code", 'note_examen' => $resultat, 'date_examen' => $dateExam, 'id' => $id_c));
									// Notif bravo
									$message="Bravo pour votre résultat au test QCM, veuillez vous préparer à passer l'examen de Code qui sera prochainement programmé.";
						            $date_m=date('U');
						            $resultat2=$pdo->prepare("INSERT INTO notification (`name`,`message`,`status`,`date`,`id_candidat`) VALUES(?, ?, ?, ?, ?)");
						            $resultat2->execute(['Planification d\'examen', $message, 0, $date_m, $id_c]);

								}

								$msg = '<p class="alert alert-success">Vous avez réussi dans ce test ! Votre note est ' . $noteTest . '/10<br/>';
								if($noteTest < 10){
									$msg .= 'Vos erreurs:<br/>';
								}
								
								for ($i=0; $i < count($erreur); $i++) {// parcourir le tableau des questions avec choix faux
									if($erreur[$i] != ""){// si la case actuelle n'est pas vide
										$msg .= $erreur[$i];// concaténer le message de résultat avec la question avec choix faux
										$msg .= '<br/>&nbsp&nbsp&nbsp&nbsp';
										$msg .= $choixJuste[$i];// concaténer le message une autre foix avec le choix juste de la question fausse
										$msg .= '<br/>';// ajouter un retour à la ligne
									}
								}
								$msg .= '</p>';
							}else{
								$resultat = "echoué";
								$dateExam = date('Y-m-d');
								$requeteverification=$pdo->prepare("SELECT * FROM resultat WHERE (nom_examen=:nom_examen AND date_examen=:date_examen AND id_c=:id)");
								$requeteverification->execute(array('nom_examen' => "QCM Code", 'date_examen' => $dateExam, 'id' => $id_c));
								$nbResult = $requeteverification->rowCount();
								if($nbResult < 1){
									$requeteinsertion=$pdo->prepare("INSERT INTO resultat(nom_examen, note_examen, date_examen, id_c) VALUES(:nom_examen, :note_examen, :date_examen, :id)");
									$requeteinsertion->execute(array('nom_examen' => "QCM Code", 'note_examen' => $resultat, 'date_examen' => $dateExam, 'id' => $id_c));
								}

								$msg = '<p class="alert alert-danger">Vous avez échoué dans ce test ! Votre note est ' . $noteTest . '/10</p>';
							}

							// insertion du résultat du candidat
							/*$dateExam = date('Y-m-d');
							$requeteverification=$pdo->prepare("SELECT * FROM resultat WHERE (nom_examen=:nom_examen AND date_examen=:date_examen AND id_c=:id)");
							$requeteverification->execute(array('nom_examen' => "QCM Code", 'date_examen' => $dateExam, 'id' => $id_c));
							$nbResult = $requeteverification->rowCount();

							if($nbResult < 1){
								$requeteinsertion=$pdo->prepare("INSERT INTO resultat(nom_examen, note_examen, date_examen, id_c) VALUES(:nom_examen, :note_examen, :date_examen, :id)");
								$requeteinsertion->execute(array('nom_examen' => "QCM Code", 'note_examen' => $resultat, 'date_examen' => $dateExam, 'id' => $id_c));
							}*/
							

							//Clôture de la connexion
							$pdo = null;
						}catch(PDOException $e) {
							die('Erreur ! '.$e->getMessage());
						}
					}
					else if($taille < 10){
						echo '<script type="text/javascript">
							alert("Vous devez répondre à toutes les questions");
							window.location.href = "test.php";
						</script>';
						//header("Location:test.php");
					}
				}
			}
		?>
		<div id="note" class="part">
			<?php 
				if(!empty($msg)){ 
						echo $msg;
						echo '<script type="text/javascript">document.getElementById("test_part").style.display="none";</script>';
						if($noteTest < 9){
			?>
							<script type="text/javascript">
									/*if(confirm("Voulez vous demander des séances supplémmentaires ? oui ou non")) { 
										window.location.replace("candidat.php");
									}*/
							</script>
			<?php
						}
				} 
			?>
		</div>
		<div class="part lesQuestion" id="test_part">
			<?php if($niveau == "code" || $niveau == "inscrit"){ ?>
			<style>
				.infoTest {
					text-align: center;
					padding: 25px;
					background-color: #D15454;
					border-style: none;
					border-radius: 10px;
					width: 85%;
					margin: auto auto 30px;
					font-size: 1rem;
					font-family: "Raleway", sans-serif;
				}
				.boldedN {
					font-weight: bold;
				}
			</style>
			<div class="infoTest"><span class="boldedN">Notice:</span> Ce test permet de savoir si vous êtes apte à passer l'examen de Code, si vous obtenez un score égale ou supérieur à <span class="">9,</span> une séance d'examen Code sera prochainement programmé.</div>
			<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" autocomplete="off" id="form" name="form">
				<?php for ($i=0; $i < 10; $i++) { ?>
					<div class="question"><p><?php echo "<span class='niveau'>• </span>Question " . ($i+1) . ": " . $q[$i]; ?></p></div>
					<table>
						<?php for ($j=0; $j < 3; $j++) { ?>
							<tr>
								<td>
									<input type="radio" name="rep[<?php echo $i;?>]" value="<?php echo $answerIds[$i][$j];?>"><?php echo $answers[$i][$j];?>
								</td>
							</tr>
						<?php } ?>
					</table>
					<br>
				<?php } ?>
				<div id="submit" class="part">
					<center><button class="validerTest" id="valid_btn" name="valid_btn" onclick="validate()"><span>Valider</span></button></center>
				</div>
			</form>
			<?php 
				} 
				else{
			?>
					<p class="alert alert-danger">Seulement les candidats du niveau 'inscrit' ou niveau 'code' sont autorisés à passer ce test</p>
			<?php	
				}
			?>
		</div>	
	</div>
  </div>
</body>
</html>