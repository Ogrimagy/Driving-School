<?php
    header('content-type: text/html; charset=utf-8');
	require_once('db_connexion.php');

	try{
		$requete_sql="INSERT INTO `employee`
		(`Nom`		,`Prenom`  ,`Naissance` ,`Ville`   ,`Telephone` ,`Genre`,`Email`			,`Password`,`code_agence`,`Nbr_c`,`id_role`,`Photo` )VALUES
        ('Mezouar'  ,'Yassine' ,'1996-06-06','Zimbabwe','0541082689','M'	,'yassine@gmail.com','123456'  ,'1'			 ,'0'    ,'1'	   ,LOAD_FILE('C:/xampp/htdocs/Projet-AutoEcole/ressource/img/yassine.jpg'))";
        $connexion->exec($requete_sql);
             
		//------------------------------- Contraint de la table candidat ------------------------------//
		$requete_sql="ALTER TABLE candidat add constraint mc_fk foreign key(id_m) references employee(id) on delete set null on update cascade;
		ALTER TABLE candidat ADD CONSTRAINT niveau_candidat CHECK(niveau in('inscrit','code','creneau','circuit','admis'));
		";
		$connexion->exec($requete_sql);
		echo "Contraint candidat créée avec succès.<br>";


		//---------------------------------- contraint table employee --------------------------------//
		$requete_sql="ALTER TABLE employee add constraint sup_fk foreign key(id_superviseur) references employee(id) on delete set null on update cascade;
		ALTER TABLE employee ADD CONSTRAINT fk_g_gerant Foreign Key(code_agence) REFERENCES agence(code_agence);
		ALTER TABLE employee ADD CONSTRAINT fk_g_role Foreign Key(id_role) REFERENCES role(id_role);
		";
		$connexion->exec($requete_sql);
		echo "Contraint employee est créer avec succès.<br>";


		//-------------------------------- Contraint table lecon --------------------------------//
		$requete_sql="ALTER TABLE leçon add constraint can_id foreign key(id_candidat) references candidat(id_c) on delete cascade on update cascade;
		ALTER TABLE leçon add constraint mon_id foreign key(id_m) references employee(id) on delete cascade on update cascade";
		$connexion->exec($requete_sql);
		echo "Contraint lecon est créer avec succès.<br>";


		//-------------------------------- Contraint table resultat --------------------------------//
		$requete_sql="ALTER TABLE resultat add constraint fk_resultat foreign key(id_c) references candidat(id_c) on delete cascade on update cascade;

		ALTER TABLE resultat ADD CONSTRAINT note_rasultat check(note_examen in('réussi','echoué'));
		";
		$connexion->exec($requete_sql);
		echo "contraint resultat est créer avec succès.<br>";

		//------------------------ Contraintes table reponse------------------------//
		$requete_sql="	ALTER TABLE reponse ADD CONSTRAINT fk_reponse  Foreign Key(id_q) REFERENCES question(id_q) on delete cascade on update cascade;
		";
		$connexion->exec($requete_sql);
		echo "contraint reponse est créer avec succès.<br>";

		//------------------------ Contraintes table absence------------------------//
		$requete_sql="ALTER TABLE absence add constraint abc_fk foreign key(id_c) references candidat(id_c) on delete cascade on update cascade;
		ALTER TABLE absence add constraint abm_fk foreign key(id_m) references employee(id) on delete cascade on update cascade;
		";
		$connexion->exec($requete_sql);
		echo "contraint absence est créer avec succès.<br>";

		//------------------------ Contraintes table paiement------------------------//
		$requete_sql="ALTER TABLE paiement add constraint cp_fk foreign key(id_c) references candidat(id_c) on delete cascade on update cascade;
		";
		$connexion->exec($requete_sql);
		echo "contraint paiement est créer avec succès.<br>";

		//------------------------ Contraintes table voiture------------------------//
		$requete_sql="ALTER TABLE voiture add constraint voit_mon_fk foreign key(id_emp) references employee(id) on delete set null on update cascade;
		";
		$connexion->exec($requete_sql);
		echo "contraint voiture est créer avec succès.<br>";
	} catch (PDOException $e) {
		echo "Erreur ! " . $e->getMessage() . "<br/>";
	}

?>