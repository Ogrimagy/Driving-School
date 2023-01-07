<?php
// fonction pour la création d'une connexion avec la BDD
/*public */function get_pdo(): PDO {
	$nom_bdd = "auto_ecole";
    $server = "localhost"; 
    $user = "root"; 
    $password = "";
	
	return new PDO("mysql:host=$server;dbname=$nom_bdd", $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}


function h(?string $value): string {
	if($value === null){
		return '';
	}
	return htmlentities($value);
}


function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

?>