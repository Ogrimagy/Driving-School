<?php 
	// classe générale pour la validation
	class Validator{
		
		private $data;
		protected $errors = [];// tableau des erreurs

		public function __construct(array $data = []){// on utilise ce constructeur juste pour l'initialisation
			$this->data = $data;
		}

		// fonction qui retourne un tableau ou un booléen
		public function validates(array $data){
			$this->errors = [];
			$this->data = $data;
			return $this->errors;
		}

		public function validate(string $field, string $method/*, ...$params*/): bool {// ...$params veut dire des paramètres supplémentaires
			if(!isset($this->data[$field])){// si le champ n'existe pas
				$this->errors[$field] = "Le champ " . $field . " n'est pas rempli";
				return false;
			}
			else{
				return call_user_func([$this, $method], $field/*, ...$params*/);// appeler la methode $method sur l'objet en cours $this
			}
		}

		// fonction qui vérifie la longueur du titre
		public function typeName(string $field): bool {
			if($field !== "code" && $field !== "conduite"){
				$this->errors[$field] = "Le type doit etre 'code' ou 'conduite'";
				return false;
			}
			return true;
		}

		// createFromFormat(format, paramètre) crée une date au format "format" en utilisant "paramètre". sinn elle retourne false
		public function date(string $field): bool {
			if(DateTime::createFromFormat('Y-m-d', $this->data[$field]) === false){// si la date n'est pas valide
				$this->errors[$field] = "La date ne semble pas valide";
				return false;
			}
			return true;
		}

		// createFromFormat(format, paramètre) crée une date au format "format" en utilisant "paramètre". sinn elle retourne false
		public function time(string $field): bool {
			if(DateTime::createFromFormat('H:i:s', $this->data[$field]) === false){// si la date n'est pas valide
				$this->errors[$field] = "Le temps ne semble pas valide";
				return false;
			}
			return true;
		}

		// fonction qui vérifie si le temps de début est inférieur au temps de fin
		public function beforeTime(string $startField, string $endField){
			if($this->time($startField) && $this->time($endField)){// s'il s'agit d'un temps de début et d'un temps de fin au bon format
				$start = DateTime::createFromFormat('H:i', $this->data[$startField]);
				$end = DateTime::createFromFormat('H:i', $this->data[$endField]);
				if($start->getTimestamp() > $end->getTimestamp()){
					$this->errors[$startField] = "Le temps de début doit etre inférieur au temps de fin";
					return false;
				}
				return true;
			}
			return false;
		}
	}
	
?>