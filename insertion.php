<?php
	header('content-type: text/html; charset=utf-8');
	require_once('db_connexion.php');
	
	try {
  

         $reslt=$connexion->query("SELECT * from role");
         if ($reslt->rowCount() == 0) {
         	$requete_sql="INSERT INTO `role` (`nom_role`) VALUES ('superviseur'),('gerant'),('moniteurcode'),('moniteurconduite')";
            $connexion->exec($requete_sql);
           echo "Insertion réussie dans la table « role ».<br>";
         }
		

        $requete_sql="INSERT INTO `agence` (`code_agence`, `adresse`, `Ville`) VALUES ('1', '13 rue mansoura', 'tlemcen')";
        $connexion->exec($requete_sql);
        echo "Insertion réussie dans la table « agence ».<br>";

		$requete_sql="INSERT INTO `employee`
		(`Nom`		,`Prenom`  ,`Naissance` ,`Ville`   ,`Telephone` ,`Genre`,`Email`			,`Password`,`code_agence`,`Nbr_c`,`id_role`,`id_superviseur`,`Photo` )VALUES
		('Mohammedi','Elhadi'  ,'1998-12-24','Japan'   ,'0552169046','M'	,'elhadi@gmail.com' ,'123456'  ,'1'			 ,'0'    ,'2'	   ,'1', LOAD_FILE('C:/xampp/htdocs/Projet-AutoEcole/ressource/img/elhadi.jpg')),
		('Halabi'   ,'Zaki'    ,'1999-03-25','Syria'   ,'0552169051','M'	,'zaki@gmail.com'   ,'123456'  ,'1'			 ,'0'    ,'3'	   ,'1', LOAD_FILE('C:/xampp/htdocs/Projet-AutoEcole/ressource/img/zaki.jpg')),
		('Benaser'  ,'Mohammed','1998-12-24','Monaco'  ,'0552169052','M'	,'med@gmail.com'    ,'123456'  ,'1'			 ,'0'    ,'3'	   ,'1', LOAD_FILE('C:/xampp/htdocs/Projet-AutoEcole/ressource/img/index.png')),
		('Cherif'   ,'Mounaim' ,'1985-10-09','Barca'   ,'0552169053','M'	,'mounaim@gmail.com','123456'  ,'1'			 ,'0'    ,'3'	   ,'1', LOAD_FILE('C:/xampp/htdocs/Projet-AutoEcole/ressource/img/index.png')),
		('Kouani'   ,'Saad'    ,'1991-11-12','Turin'   ,'0552169054','M'	,'saad@gmail.com'   ,'123456'  ,'1'			 ,'0'    ,'3'	   ,'1', LOAD_FILE('C:/xampp/htdocs/Projet-AutoEcole/ressource/img/index.png')),
		('Mokhtari' ,'Habib'   ,'1993-08-13','Miami'   ,'0552169055','M'	,'habib@gmail.com'  ,'123456'  ,'1'			 ,'0'    ,'4'	   ,'1', LOAD_FILE('C:/xampp/htdocs/Projet-AutoEcole/ressource/img/index.png')),
		('Bouklikha','Nazih'   ,'1978-01-07','Dublin'  ,'0552169056','M'	,'nazih@gmail.com'  ,'123456'  ,'1'			 ,'0'    ,'4'	   ,'1', LOAD_FILE('C:/xampp/htdocs/Projet-AutoEcole/ressource/img/nazih.jpg')),
		('Allam'    ,'Mehdi'   ,'1988-03-22','Chicago' ,'0552169057','M'	,'mehdi@gmail.com'  ,'123456'  ,'1'			 ,'0'    ,'4'	   ,'1',LOAD_FILE('C:/xampp/htdocs/Projet-AutoEcole/ressource/img/index.png')),
		('Bestaoui' ,'Imad'    ,'1994-08-05','Vegas'   ,'0552169058','M'	,'imad@gmail.com'   ,'123456'  ,'1'			 ,'0'    ,'4'	   ,'1', LOAD_FILE('C:/xampp/htdocs/Projet-AutoEcole/ressource/img/index.png'));";
        $connexion->exec($requete_sql);
        echo "Insertion réussie dans la table « employee ».<br>";
  


    	$requete_sql="INSERT INTO `candidat` 
		(`Nom`		,`Prenom`	,`Naissance` ,`Ville`	,`Telephone`,`Genre`,`Etat`	   ,`TypeV` ,`Email`			 ,`Password`,`ConfirmPW`,`niveau` ,`payee`,`restant`,`tarif`, `Photo` )VALUES
		('Leshaf'   ,'Redouane' ,'1999-05-12','Zambia'  ,'0552169038','M'	,'chomeur' ,'auto'  ,'redouane@gmail.com','123456'  ,'123456'	,'inscrit','0'    ,'0'      ,'0'    ,LOAD_FILE('C:/xampp/htdocs/Projet-AutoEcole/ressource/img/redouane.jpg')),
		('Korti'    ,'Mortada'  ,'1994-01-05','Oran'    ,'0552169039','M'	,'chomeur' ,'manuel','mortada@gmail.com' ,'123456'  ,'123456'	,'inscrit','0'    ,'0'      ,'0'    ,LOAD_FILE('C:/xampp/htdocs/Projet-AutoEcole/ressource/img/indexc.png')),
		('Rais'	    ,'Hachim'  	,'1999-03-02','Mozambic','0552169041','M'	,'chomeur' ,'manuel','hachim@gmail.com'  ,'123456'  ,'123456'	,'code'   ,'7000' ,'0'      ,'7000' ,LOAD_FILE('C:/xampp/htdocs/Projet-AutoEcole/ressource/img/indexc.png')),
		('Houta'	,'Ahlem'   	,'2000-06-23','NewYork' ,'0552169042','F'	,'etudiant','auto'  ,'Ahlem@gmail.com'   ,'123456'  ,'123456'	,'code'   ,'0'    ,'6000'   ,'6000' ,LOAD_FILE('C:/xampp/htdocs/Projet-AutoEcole/ressource/img/indexc.png')),
		('khalil'	,'Chahinez'	,'2000-09-15','Turin'   ,'0552169043','F'	,'etudiant','manuel','chahinez@gmail.com','123456'  ,'123456'	,'code'   ,'0'    ,'7000'   ,'7000' ,LOAD_FILE('C:/xampp/htdocs/Projet-AutoEcole/ressource/img/indexc.png')),
		('Lallam'	,'Sadjid'	,'2000-09-15','Antartica'   ,'0552164587','M'	,'etudiant','auto','sadjid@gmail.com','123456'  ,'123456'	,'code'   ,'0'    ,'7000'   ,'7000' ,LOAD_FILE('C:/xampp/htdocs/Projet-AutoEcole/ressource/img/indexc.png')),
		('Iles'	    ,'Djihane' 	,'2000-12-04','Mali'    ,'0552169044','F'	,'etudiant','auto'	,'djihane@gmail.com' ,'123456'  ,'123456'	,'creneau','7000' ,'0'      ,'7000' ,LOAD_FILE('C:/xampp/htdocs/Projet-AutoEcole/ressource/img/sabrina.jpg')),
		('Dib'	    ,'Alaa'    	,'2000-10-27','Nijer'   ,'0552169045','F'	,'etudiant','manuel','alaa@gmail.com'    ,'123456'  ,'123456'	,'creneau','0'    ,'8000'   ,'8000' ,LOAD_FILE('C:/xampp/htdocs/Projet-AutoEcole/ressource/img/tiffany.jpg')),
		('John'	    ,'Cena' 	,'2001-01-05','Mali'    ,'0552169058','M'	,'etudiant','auto'	,'John@gmail.com' 	 ,'123456'  ,'123456'	,'creneau','0'    ,'7000'   ,'7000' ,LOAD_FILE('C:/xampp/htdocs/Projet-AutoEcole/ressource/img/indexc.png')),
		('Soltani'	,'Yacine' 	,'2001-01-05','Spain'    ,'0552112486','M'	,'etudiant','manuel' ,'yacine@gmail.com' 	 ,'123456'  ,'123456'	,'creneau','0'    ,'7000'   ,'7000' ,LOAD_FILE('C:/xampp/htdocs/Projet-AutoEcole/ressource/img/indexc.png')),
		('Boudalia'	,'zoubir' 	,'1875-04-18','Mars'    ,'0552169047','M'	,'normal'  ,'manuel','zoubir@gmail.com'  ,'123456'  ,'123456'	,'circuit','8000' ,'0'      ,'8000' ,LOAD_FILE('C:/xampp/htdocs/Projet-AutoEcole/ressource/img/dali.jpg')),
		('Messi'	,'Lionel' 	,'1988-07-12','Jupiter' ,'0552169048','M'	,'chomeur' ,'auto'	,'messi@gmail.com' 	 ,'123456'  ,'123456'	,'circuit','0'    ,'8000'   ,'8000' ,LOAD_FILE('C:/xampp/htdocs/Projet-AutoEcole/ressource/img/indexc.png')),
		('Cristiano','Ronaldo' 	,'1985-02-12','Lisbone' ,'0552169049','M'	,'chomeur' ,'manuel','cris@gmail.com'    ,'123456'  ,'123456'	,'circuit','0'    ,'8000'   ,'8000' ,LOAD_FILE('C:/xampp/htdocs/Projet-AutoEcole/ressource/img/indexc.png')),
		('Mahi','Mohamed' 	,'1985-02-12','Kyoto' ,'0551469049','M'	,'chomeur' ,'auto','mahi@gmail.com'    ,'123456'  ,'123456'	,'circuit','0'    ,'8000'   ,'8000' ,LOAD_FILE('C:/xampp/htdocs/Projet-AutoEcole/ressource/img/indexc.png')),
		('Fella'	,'Amaria' 	,'1977-07-12','Panama'  ,'0552169050','F'	,'chomeur' ,'auto'	,'fella@gmail.com' 	 ,'123456'  ,'123456'	,'admis'  ,'0'    ,'0'       ,'0'   ,LOAD_FILE('C:/xampp/htdocs/Projet-AutoEcole/ressource/img/indexc.png')),
		('Bouklikha','Amine' ,'1977-07-12','Marseille'  ,'0752169050','F'	,'chomeur' ,'manuel','bouklikha@gmail.com' 	 ,'123456'  ,'123456'	,'admis'  ,'0'    ,'0'       ,'0'   ,LOAD_FILE('C:/xampp/htdocs/Projet-AutoEcole/ressource/img/indexc.png'));";

		$connexion->exec($requete_sql);
		echo "Insertion réussie dans la table « candidat ».<br>";

		$requete_sql="INSERT INTO `question` (`id_q`, `text_q`) VALUES
			(1, 'Que peut-on conduire avec la catégorie B?'),
			(2, 'Les différents types de signalisations verticales sont'),
			(3, 'Quelle est l’utilité de la distance de sécurité ?'),
			(4, 'De quels facteurs dépend la distance de sécurité?'),
			(5, 'La route à grande circulation perd sa priorité dans plusieurs cas, l’un de ces cas est'),
			(6, 'Quels sont les dangers liés à la conduite lorsqu’il commence à pleuvoir?'),
			(7, 'Quels sont les dangers particuliers de la conduite de nuit?'),
			(8, 'Parmi les manœuvres interdites sur autoroute on a'),
			(9, 'Par quoi est précédée une ligne continue?'),
			(10, 'Quelles sont les vitesses maximales autorisées sur autoroutes et en agglomération?'),
			(11, 'Les feux éclairant la route et qui permettent de voir sont'),
			(12, 'Quelles précautions doit-on prendre pour tourner à droite?'),
			(13, 'Quelle est la différence entre un ’stop’ et un ’céder le passage’?'),
			(14, 'Parmi les cas d’interdiction de dépassement, on a'),
			(15, 'De quel coté s’effectuent les dépassements en général?'),
			(16, 'Les cas de diminution de vitesse sont'),
			(17, 'Les trois types de stationnement sont'),
			(18, 'Parmi ces trois groupes des cas, quel groupe contient les cas de priorité à droite uniquement?'),
			(19, 'Quelle est la différence entre l’arrêt et le stationnement?'),
			(20, 'La forme et la couleur d’un panneau d’indication sont');";
		$connexion->exec($requete_sql);
		echo "Insertion réussie dans la table « question ».<br>";

		$requete_sql="INSERT INTO `reponse` (`id_r`, `text_r`, `juste`, `id_q`) VALUES
			(1, 'Les véhicules automobiles ayant un poids totale qui ne dépasse pas 3500kg', 'oui', 1),
			(2, 'Les motos', 'non', 1),
			(3, 'Les véhicules automobiles ayant un poids totale qui ne dépasse pas 4000kg', 'non', 1),
			(4, 'La ligne continue, la ligne de dissuasion, les flèches de rabattement, la ligne double ou mixte', 'non', 2),
			(5, 'Les panneaux de danger, de prescription absolue, d’indication, les feux tricolores', 'oui', 2),
			(6, 'Les balises rouges et les piquets mobiles', 'non', 2),
			(7, 'Elle permet d’éviter une collision en cas de ralentissement brusque ou d’arrêt subit du véhicule qui le précède', 'oui', 3),
			(8, 'Elle permet d’éviter une collision en cas de ralentissement brusque ou d’arrêt subit du véhicule qui le suit', 'non', 3),
			(9, 'Cette distance n’a aucune importance, elle peut être ignorée', 'non', 3),
			(10, 'Elle dépend de la vitesse et de la circulation', 'non', 4),
			(11, 'Elle dépend de l’état de la route et de la circulation', 'non', 4),
			(12, 'Elle dépend de la vitesse et de l’état de la route', 'oui', 4),
			(13, 'Au feu vert', 'non', 5),
			(14, 'Au stop', 'oui', 5),
			(15, 'A la sortie d’une agglomération', 'non', 5),
			(16, 'La poussière associée à l’eau et qui forment une fine couche de boue très glissante qui cause le dérapage', 'oui', 6),
			(17, 'La faible visibilité', 'non', 6),
			(18, 'Se sentir fatigué', 'non', 6),
			(19, 'Éblouissement par les feux de route d’usagers venant en face ou derrière et le buée sur les vitres', 'oui', 7),
			(20, 'Le dérapage', 'non', 7),
			(21, 'La faible visibilité et se sentir fatigué', 'non', 7),
			(22, 'La circulation sur la voie située au milieu pour les véhicules dont le poids totale ne dépasse pas 3500kg', 'non', 8),
			(23, 'La circulation sur la voie située à droite pour les véhicules de transport de personnes ou de marchandises dont la longueur dépasse 7 mètres ou dont le poids totale dépasse 2 tonnes', 'non', 8),
			(24, 'La circulation sur la voie située à gauche pour les véhicules de transport de personnes ou de marchandises dont la longueur dépasse 7 mètres ou dont le poids totale dépasse 2 tonnes', 'oui', 8),
			(25, 'Elle est précédée d’une ligne double ou mixte', 'non', 9),
			(26, 'Elle est précédée des flèches directionnelles', 'non', 9),
			(27, 'Elle est précédée d’une discontinue d’avertissement pouvant être complétée par des flèches de rabattement', 'oui', 9),
			(28, '120km par heure sur autoroute et 50km par heure en agglomération', 'oui', 10),
			(29, '130km par heure sur autoroute et 80km par heure en agglomération', 'non', 10),
			(30, '150km par heure sur autoroute et 30km par heure en agglomération', 'non', 10),
			(31, 'Feux de position, feux de brouillard arrière et feux rouges', 'non', 11),
			(32, 'Feux de route, feux de croisement et feux de brouillard avant', 'oui', 11),
			(33, 'Signal de détresse', 'non', 11),
			(34, 'S’assurer de l’absence des cas d’interdiction, signaler l’intention, ralentir, observer les règles de priorité, tourner en serrant à droite, redresse les roues et éteindre le clignotant', 'oui', 12),
			(35, 'S’assurer de l’absence des cas d’interdiction, ralentir, signaler l’intention, observer les règles de priorité, tourner en serrant à droite, redresse les roues et éteindre le clignotant', 'non', 12),
			(36, 'S’assurer de l’absence des cas d’interdiction, observer les règles de priorité, ralentir, signaler l’intention, tourner en serrant à droite, redresse les roues et éteindre le clignotant', 'non', 12),
			(37, 'Devant un panneau ’Stop’ l’arrêt n’est pas obligatoire, et cette obligation est nécessaire devant le panneau ’Céder le passage’', 'non', 13),
			(38, 'Devant un panneau ’Stop’ l’arrêt est obligatoire, et cette obligation n’est pas nécessaire devant le panneau ’Céder le passage’', 'oui', 13),
			(39, 'Devant un panneau ’Stop’ l’arrêt est obligatoire, et cette obligation est nécessaire devant le panneau ’Céder le passage’', 'non', 13),
			(40, 'La présence d’une ligne discontinue', 'non', 14),
			(41, 'La présence d’une ligne double dont la ligne discontinue est de votre coté', 'non', 14),
			(42, 'La présence d’une ligne continue ou d’une ligne double dont la ligne continue est de votre coté', 'oui', 14),
			(43, 'Le dépassement se fait en général par la gauche', 'oui', 15),
			(44, 'Le dépassement se fait en général par la droite', 'non', 15),
			(45, 'Le dépassement se fait en général par la gauche ou par la droite, il n’y a pas de coté meilleur que l’autre', 'non', 15),
			(46, 'Lorsque les conditions météorologiques sont mauvaises, dans les routes montantes, à l’approche des intersections', 'non', 16),
			(47, 'Lorsque les conditions météorologiques sont mauvaises, dans les virages, à l’approche des intersections', 'oui', 16),
			(48, 'Lorsque les conditions météorologiques sont mauvaises, dans les voies droites, à l’approche des intersections', 'non', 16),
			(49, 'En créneau(incliné), en épi(parallèle), en bataille(vertical)', 'non', 17),
			(50, 'En créneau(parallèle), en épi(incliné), en bataille(vertical)', 'oui', 17),
			(51, 'En créneau(vertical), en épi(incliné), en bataille(parallèle)', 'non', 17),
			(52, 'Intersection sans signalisation, intersection de 2 routes secondaires, devant le panneau ’Céder le passage’', 'non', 18),
			(53, 'Intersection sans signalisation, intersection de 2 routes secondaires, intersection avec feu jaune clignotant', 'oui', 18),
			(54, 'Intersection sans signalisation, intersection de 2 routes secondaires, dans une route prioritaire', 'non', 18),
			(55, 'L’arrêt signifie que le véhicule est immobilisé de façon temporaire et le stationnement signifie que le véhicule est immobilisé pendant une période de temps', 'oui', 19),
			(56, 'Le stationnement signifie que le véhicule est immobilisé de façon temporaire et l’arrêt signifie que le véhicule est immobilisé pendant une période de temps', 'non', 19),
			(57, 'La différence est dans les noms, mais ils sont les mêmes', 'non', 19),
			(58, 'Carré bleu', 'oui', 20),
			(59, 'Cercle bleu', 'non', 20),
			(60, 'Cercle blanc entourée du rouge', 'non', 20);";
		$connexion->exec($requete_sql);
		echo "Insertion réussie dans la table « reponse ».<br>";


		// ajout leçons
		$d1 = "2020-09-22 8:00:00";
		$d2 = "2020-09-22 9:00:00";
		$d3 = "2020-09-22 10:00:00";
		$d4 = "2020-09-22 11:00:00";
		$d5 = "2020-09-22 12:00:00";

		$d6 = "2020-09-22 14:00:00";
		$d7 = "2020-09-22 15:00:00";
		$d8 = "2020-09-22 16:00:00";
		$d9 = "2020-09-22 17:00:00";
		$d10 = "2020-09-22 18:00:00";

		$d11 = "2020-09-25 17:00:00";
		$d12 = "2020-09-25 18:00:00";

		$date1=date_create_from_format("Y-m-d H:i:s",$d1)->format("Y-m-d H:i:s");
		$date2=date_create_from_format("Y-m-d H:i:s",$d2)->format("Y-m-d H:i:s");
		$date3=date_create_from_format("Y-m-d H:i:s",$d3)->format("Y-m-d H:i:s");
		$date4=date_create_from_format("Y-m-d H:i:s",$d4)->format("Y-m-d H:i:s");
		$date5=date_create_from_format("Y-m-d H:i:s",$d5)->format("Y-m-d H:i:s");
		$date6=date_create_from_format("Y-m-d H:i:s",$d6)->format("Y-m-d H:i:s");
		$date7=date_create_from_format("Y-m-d H:i:s",$d7)->format("Y-m-d H:i:s");
		$date8=date_create_from_format("Y-m-d H:i:s",$d8)->format("Y-m-d H:i:s");
		$date9=date_create_from_format("Y-m-d H:i:s",$d9)->format("Y-m-d H:i:s");
		$date10=date_create_from_format("Y-m-d H:i:s",$d10)->format("Y-m-d H:i:s");
		$date11=date_create_from_format("Y-m-d H:i:s",$d11)->format("Y-m-d H:i:s");
		$date12=date_create_from_format("Y-m-d H:i:s",$d12)->format("Y-m-d H:i:s");

		$val = "1";


		$requete_sql=$connexion->prepare("INSERT INTO `leçon` (`id`, `nom`, `debut`, `fin`, `id_m`, `id_candidat`) VALUES (?,?,?,?,?,?)");
		$requete_sql->execute([1, 'code', $date1, $date2, 3, 3]);
		$requete_sql->execute([2, 'code', $date2, $date3, 3, 3]);
		$requete_sql->execute([3, 'code', $date3, $date4, 3, 3]);
		$requete_sql->execute([4, 'code', $date4, $date5, 3, 3]);
		$requete_sql->execute([6, 'code', $date6, $date7, 3, 3]);
		$requete_sql->execute([7, 'code', $date7, $date8, 3, 3]);
		$requete_sql->execute([8, 'code', $date8, $date9, 3, 3]);
		$requete_sql->execute([9, 'code', $date9, $date10, 3, 3]);
		$requete_sql->execute([10, 'code', $date11, $date12, 3, 3]);

		// Affectation moni
		$requete_sql="UPDATE candidat SET id_m = 3 WHERE id_c = 3";
		$connexion->exec($requete_sql);
		$requete_sql="UPDATE candidat SET id_m = 3 WHERE id_c = 4";
		$connexion->exec($requete_sql);
		$requete_sql="UPDATE employee SET Nbr_c = 2 WHERE id = 3";
		$connexion->exec($requete_sql);

		$requete_sql="UPDATE candidat SET id_m = 4 WHERE id_c = 5";
		$connexion->exec($requete_sql);
		$requete_sql="UPDATE candidat SET id_m = 4 WHERE id_c = 6";
		$connexion->exec($requete_sql);
		$requete_sql="UPDATE employee SET Nbr_c = 2 WHERE id = 4";
		$connexion->exec($requete_sql);


		$requete_sql="UPDATE candidat SET id_m = 7 WHERE id_c = 7";
		$connexion->exec($requete_sql);
		$requete_sql="UPDATE candidat SET id_m = 7 WHERE id_c = 11";
		$connexion->exec($requete_sql);
		$requete_sql="UPDATE employee SET Nbr_c = 2 WHERE id = 7";
		$connexion->exec($requete_sql);

		$requete_sql="UPDATE candidat SET id_m = 8 WHERE id_c = 8";
		$connexion->exec($requete_sql);
		$requete_sql="UPDATE candidat SET id_m = 8 WHERE id_c = 12";
		$connexion->exec($requete_sql);
		$requete_sql="UPDATE employee SET Nbr_c = 2 WHERE id = 8";
		$connexion->exec($requete_sql);

		// insertion resultat
		$d1 = "2020-09-25";
		$date1=date_create_from_format("Y-m-d",$d1)->format("Y-m-d");

		$requete_sql=$connexion->prepare("INSERT INTO `resultat` (`id_examen`, `nom_examen`, `note_examen`, `date_examen`, `operation_examen`, `id_c`) VALUES (?,?,?,?,?,?)");
		$requete_sql->execute([1, 'code', 'réussi', $date1, 0, 3]);
		$requete_sql->execute([2, 'code', 'echoué', $date1, 0, 4]);
		$requete_sql->execute([3, 'code', 'echoué', $date1, 0, 5]);
		$requete_sql->execute([4, 'code', 'réussi', $date1, 0, 6]);

		$requete_sql->execute([5, 'creneau', 'echoué', $date1, 0, 7]);
		$requete_sql->execute([6, 'creneau', 'réussi', $date1, 0, 8]);
		$requete_sql->execute([7, 'circuit', 'echoué', $date1, 0, 11]);
		$requete_sql->execute([8, 'circuit', 'réussi', $date1, 0, 12]);

		// insertion absence
		$d1 = "2020-09-17";
		$date1=date_create_from_format("Y-m-d",$d1)->format("Y-m-d");
		$requete_sql=$connexion->prepare("INSERT INTO `absence` (`Id_a`, `Id_c`, `Id_m`, `Date_abs`) VALUES (?,?,?,?)");
		$requete_sql->execute([1, null, 3 , $date1]);
		$requete_sql->execute([2, null, 3 , $date1]);
		$requete_sql->execute([3, null, 2 , $date1]);
		$requete_sql->execute([4, null, 8 , $date1]);

		$requete_sql="UPDATE employee SET nbr_abs = 2 WHERE id = 3";
		$connexion->exec($requete_sql);
		//$requete_sql="UPDATE employee SET nbr_abs = 1 WHERE id = 2";
		//$connexion->exec($requete_sql);
		$requete_sql="UPDATE employee SET nbr_abs = 1 WHERE id = 8";
		$connexion->exec($requete_sql);


		////////////////////////////////////////// insertion remise ////////////////////////////////////////
		$requete_sql=$connexion->prepare("INSERT INTO `remise` (`typev`, `niveau`, `etat`, `pourcentage`) VALUES (?,?,?,?)");
		// AUTO
		$requete_sql->execute(['auto', 'code', 'chomeur' , 10]);
		$requete_sql->execute(['auto', 'creneau', 'chomeur' , 10]);
		$requete_sql->execute(['auto', 'circuit', 'chomeur' , 10]);

		$requete_sql->execute(['auto', 'code', 'etudiant' , 8]);
		$requete_sql->execute(['auto', 'creneau', 'etudiant' , 10]);
		$requete_sql->execute(['auto', 'circuit', 'etudiant' , 10]);

		$requete_sql->execute(['auto', 'code', 'conducteur' , 5]);
		$requete_sql->execute(['auto', 'creneau', 'conducteur' , 8]);
		$requete_sql->execute(['auto', 'circuit', 'conducteur' , 8]);

		// MANUEL
		$requete_sql->execute(['manuel', 'code', 'chomeur' , 15]);
		$requete_sql->execute(['manuel', 'creneau', 'chomeur' , 15]);
		$requete_sql->execute(['manuel', 'circuit', 'chomeur' , 15]);

		$requete_sql->execute(['manuel', 'code', 'etudiant' , 10]);
		$requete_sql->execute(['manuel', 'creneau', 'etudiant' , 15]);
		$requete_sql->execute(['manuel', 'circuit', 'etudiant' , 15]);

		$requete_sql->execute(['manuel', 'code', 'conducteur' , 8]);
		$requete_sql->execute(['manuel', 'creneau', 'conducteur' , 10]);
		$requete_sql->execute(['manuel', 'circuit', 'conducteur' , 10]);
		////////////////////////////////////////////////////////////////////////////////////////////////////

      	//Clôture de la connexion
		$connexion = null;


	} catch (PDOException $e) {
		echo "Erreur ! " . $e->getMessage() . "<br/>";
	}

?>