<?php

	include("db_connexion.php");

	if(isset($_POST["ad_email"])){
		
		$searchVal = trim($_POST["ad_email"]);
		$dao = new DAO();
		echo $dao->searchEmail($searchVal);
	}

	else if(isset($_POST["phone"])){

		$searchVal = trim($_POST["phone"]);
		$dao = new DAO();
		echo $dao->searchPhone($searchVal);
	}

	class DAO{
		
		public function dbConnect(){
			
			$dbhost = DB_SERVER; // set the hostname
			$dbname = DB_DATABASE ; // set the database name
			$dbuser = DB_USERNAME ; // set the mysql username
			$dbpass = DB_PASSWORD;  // set the mysql password

			try {
				$dbConnection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
				return $dbConnection;

			}
			catch (PDOException $e) {
				echo 'Connection failed: ' . $e->getMessage();
			}
		
		}
		
		public function searchEmail($searchVal){		
			
			try {
				
				$dbConnection = $this->dbConnect();

				$stmt = $dbConnection->prepare("SELECT * FROM `candidat` WHERE `Email` = :searchVal");			
				$stmt->bindParam(':searchVal', $searchVal , PDO::PARAM_STR);		
				$stmt->execute();

				$stmt1 = $dbConnection->prepare("SELECT * FROM `employee` WHERE `Email` = :searchVal");			
				$stmt1->bindParam(':searchVal', $searchVal , PDO::PARAM_STR);		
				$stmt1->execute();
				
				if ( $stmt -> rowCount() > 0)
					$result = true ;
				else if ( $stmt1 -> rowCount() > 0)
					$result = true ;
				return $result ;

			}
			catch (PDOException $e) {
				echo 'Connection failed: ' . $e->getMessage();
			}
		}

		public function searchPhone($searchVal){		
			
			try {
				
				$dbConnection = $this->dbConnect();

				$stmt = $dbConnection->prepare("SELECT * FROM `candidat` WHERE `Telephone` = :searchVal");			
				$stmt->bindParam(':searchVal', $searchVal , PDO::PARAM_STR);		
				$stmt->execute();

				$stmt1 = $dbConnection->prepare("SELECT * FROM `employee` WHERE `Telephone` = :searchVal");			
				$stmt1->bindParam(':searchVal', $searchVal , PDO::PARAM_STR);		
				$stmt1->execute();
				
				if ( $stmt -> rowCount() > 0)
					$result = true ;
				else if ( $stmt1 -> rowCount() > 0)
					$result = true ;
				return $result ;

			}
			catch (PDOException $e) {
				echo 'Connection failed: ' . $e->getMessage();
			}
		}
		
	}

?>