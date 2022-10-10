<?php
	header('content-type: text/html; charset=utf-8');
	require_once('db_connexion.php');
	
	try {


		//Création de la table candidat
		$requete_sql = "CREATE TABLE IF NOT EXISTS candidat(
		    id_c INT(11) Primary Key AUTO_INCREMENT,
		    Nom VARCHAR(15) NOT NULL,
		    Prenom VARCHAR(15) NOT NULL,
		    Naissance Date NOT NULL,
		    Ville VARCHAR(30) NOT NULL default 'tlemcen',
		    Telephone VARCHAR(10) NOT NULL UNIQUE,
		    Genre VARCHAR(10) NOT NULL default 'M',
		    Etat VARCHAR(10) NOT NULL default 'normal',
		    TypeV VARCHAR(15) NOT NULL default 'auto',
		    Email VARCHAR(30) NOT NULL UNIQUE,
		    Password VARCHAR(30) NOT NULL,
		    ConfirmPW VARCHAR(30) NOT NULL,
		    Photo LONGBLOB,
		    niveau  VARCHAR(30) NOT NULL default 'inscrit',
		    categorie VARCHAR(20) NOT NULL default 'B',
		    payee DECIMAL(10,2) default 0,
		    restant DECIMAL(10,2) default 0,
		    tarif DECIMAL(10,2) default 0,
		    note_test int(11) default 0,
		    nbr_abs INT (3) default 0,
		    id_m int(11),
		    remise tinyint(1) default 0

		)";
		$connexion->exec($requete_sql);
		echo "Table « candidat » est créer avec succès.<br>";
    

		//Création de la table employee
		$requete_sql = "CREATE TABLE IF NOT EXISTS employee(
			id int(11) Primary key AUTO_INCREMENT,
			Nom VARCHAR(15) NOT NULL,
			Prenom VARCHAR(15) NOT NULL,
			Naissance Date NOT NULL,
			Genre VARCHAR(10) NOT NULL,
			Telephone VARCHAR(10) NOT NULL UNIQUE,
			Email VARCHAR(30) NOT NULL UNIQUE,
			Ville VARCHAR(30) NOT NULL default 'tlemcen',
			Password VARCHAR(30) NOT NULL,
			Photo LONGBLOB,
			salaire DECIMAL(10,2) default 0,
			nbr_abs INT (3) default 0,
			Nbr_c INT (3) default 0,
			code_agence VARCHAR(10) default 1,
			id_role int(11) DEFAULT 0,
			id_superviseur int(11)
			
		)";
		$connexion->exec($requete_sql);
		echo "Table « employee » est créer avec succès.<br>";


        //Création de la table agence
		$requete_sql = "CREATE TABLE IF NOT EXISTS agence(
		    code_agence VARCHAR(10) Primary key,
		    adresse VARCHAR(30) NOT NULL,
		    Ville VARCHAR(30) NOT NULL
        )";
        $connexion->exec($requete_sql);
		echo "Table « agence » est créer avec succès.<br>";


        //Création de la table role
        $requete_sql="CREATE TABLE IF NOT EXISTS role(
            id_role INT Primary key AUTO_INCREMENT,
            nom_role VARCHAR(20)
		)";
		$connexion->exec($requete_sql);
		echo "Table « role » est créer avec succès.<br>";

       
	    //Création de la table leçon 
		$requete_sql = "CREATE TABLE IF NOT EXISTS leçon(
			id INT Primary key AUTO_INCREMENT,
			nom VARCHAR(8) NOT NULL, /*-- code ou conduite --*/
			debut DATETIME NOT NULL,
			fin DATETIME NOT NULL,
			id_m int(11),
			id_planificateur int(11) DEFAULT 0,
			id_candidat int(11) DEFAULT 0
		)";
	 	$connexion->exec($requete_sql);
		echo "Table « leçon » est créer avec succès.<br>";


		//Création de la table resultat
		$requete_sql1= "CREATE TABLE IF NOT EXISTS resultat(
			id_examen INT  Primary key AUTO_INCREMENT,
			nom_examen VARCHAR(20),
			note_examen VARCHAR(20),
			date_examen date,
			operation_examen INT,
			id_c INT
		)";
		$connexion->exec($requete_sql1);
		echo "Table « resultat » est créer avec succès.<br>";
		

		//Création de la table absence
		$requete_sql="CREATE TABLE IF NOT EXISTS absence(
			Id_a INT(5) Primary key AUTO_INCREMENT,
			Id_c INT(5),
			Id_m INT(5),
			Date_abs DATE NOT NULL,
			Niveau VARCHAR(30) NOT NULL
		)";
		$connexion->exec($requete_sql);
		echo "Table « absence » est créer avec succès.<br>";


        //Création de la table question
		$requete_sql="CREATE TABLE IF NOT EXISTS question (
			id_q int(11)  Primary key AUTO_INCREMENT,
			text_q varchar(230) DEFAULT NULL
		)";
        $connexion->exec($requete_sql);
		echo "Table « question » est créer avec succès.<br>";
		

		//Création de la table reponce
		$requete_sql="CREATE TABLE IF NOT EXISTS reponse (
			id_r int(11) NOT NULL,
			text_r varchar(230) DEFAULT NULL,
			juste varchar(3) DEFAULT NULL,
			id_q int(11) DEFAULT NULL
		)";
        $connexion->exec($requete_sql);
		echo "Table « reponse » est créer avec succès.<br>";


		//Création de la table pwdReset
		$requete_sql="CREATE TABLE pwdReset(
			pwdResetId int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
	    	pwdResetEmail TEXT NOT NULL,
	    	pwdResetSelector TEXT NOT NULL,
		   	pwdResetToken LONGTEXT,
		    pwdResetExpires TEXT NOT NULL
		)";
		$connexion->exec($requete_sql);
		echo "Table « pwdReset » est créer avec succès.<br>";


		//Création de la table paiement
		$requete_sql1= "CREATE TABLE IF NOT EXISTS paiement(
			id_p INT(20)  Primary key AUTO_INCREMENT,
			Montant DECIMAL(10,2),
			date_paiment date ,
			heur time,
			id_c INT(11) 
		)";
		$connexion->exec($requete_sql1);
		echo "Table « paiement » est créer avec succès.<br>";


		//Création de la table notification
		$requete_sql="CREATE TABLE IF NOT EXISTS notification(
			id_n int(11) Primary key AUTO_INCREMENT,
			name text DEFAULT NULL,
			message varchar(200),
			status int,
			date TEXT,
			id_candidat int(11) default 0,
			id_employee int(11) default 0
		)";
		$connexion->exec($requete_sql);
		echo "Table « notification » est créer avec succès.<br>";


		//Création de la table voiture
		$requete_sql="CREATE TABLE IF NOT EXISTS voiture(
			matricule int(15) NOT NULL,
			marque varchar(30),
			modele varchar(30) NOT NULL,
			disponible varchar(3) DEFAULT 'oui',
			transmission varchar(15) DEFAULT 'manuel',
			id_emp int(11) default NULL
		)";
		$connexion->exec($requete_sql);
		echo "Table « voiture » est créer avec succès.<br>";


		//Création de la table remise
		$requete_sql="CREATE TABLE IF NOT EXISTS remise(
			typev VARCHAR(15) NOT NULL,
			niveau  VARCHAR(30) NOT NULL,
		    etat VARCHAR(10) NOT NULL,
		    pourcentage int(11) NOT NULL 
		)";
		$connexion->exec($requete_sql);
		echo "Table « remise » est créer avec succès.<br>";

		//Clôture de la connexion
		$connexion = null;


	} catch (PDOException $e) {
		echo "Erreur ! " . $e->getMessage() . "<br/>";
	}

?>

 