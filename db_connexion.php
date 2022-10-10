<?php
	/* DATABASE CONFIGURATION */
	define('DB_SERVER', 'localhost');
	define('DB_DATABASE', 'auto_ecole');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');

	$dbhost = DB_SERVER; // set the hostname
	$dbname = DB_DATABASE ; // set the database name
	$dbuser = DB_USERNAME ; // set the mysql username
	$dbpass = DB_PASSWORD;  // set the mysql password

	try{
		$connexion = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

	}catch (PDOException $e) {
		echo "Erreur ! " . $e->getMessage() . "<br/>";
	}
?>