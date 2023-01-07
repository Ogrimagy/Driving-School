<?php
	include 'validator.php';

	class EventValidator extends Validator{

		// fonction qui retourne un tableau ou un booléen
		public function validates(array $data){
			parent::validates($data);// appeler la méthode parent validates de la classe Validator pour passer les données
			//$this->validate('titre_e', 'typeName');
			$this->validate('date_e', 'date');
			$this->validate('start', 'time');
			//$this->validate('start', 'beforeTime', 'end');// la fonction va vérifier si le temps de début et le temps de fin sont valide. Mais aussi, elle va vérifier si le temps de début est inférieur au temps de fin
			return $this->errors;// retourner un tableau d'erreur
		}
	}
?>