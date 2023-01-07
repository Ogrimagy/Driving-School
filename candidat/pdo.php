<?php
// fonction pour la création d'une connexion avec la BDD
/*public */function get_pdo(): PDO {
	$nom_bdd = "auto_ecole";
    $server = "localhost"; 
    $user = "root"; 
    $password = "";
	
	return new PDO("mysql:host=$server;dbname=$nom_bdd", $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}

// fonction pour la vérification du texte à afficher
function h(?string $value): string {
	if($value === null){
		return '';
	}
	return htmlentities($value);// htmlentities permet d'échapper le code html, on l'utilise ici pour verifier les données stockées dans la bd et qui sont entrées par l'utilisateur
}

// fonction pour la vérification des inputs des utilisateurs
function test_input($data){
	$data = trim($data);// strip extra space, tab, newline, etc...
	$data = stripslashes($data);// remove backslashes
	$data = htmlspecialchars($data);// escape html code
	return $data;
}

?>