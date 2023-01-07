<?php 

class Month{

	public $days = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
	private $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
	public $month;
	public $year;

	// constructeur de Month
	public function __construct(?int $month = null, ?int $year = null){// les paramètres peuvent etre null(null <==> pas de params)

		if($month === null){
			$this->month = intval(date('m'));// affecter le mois actuel après conversion
		}
		else{
			if(is_int($month) && $month >= 1 && $month <= 12){
				$this->month = $month;
				//throw new Exception("Le mois $month n'est pas valide");
			}
			else{
				$this->month = intval(date('m'));// affecter le mois actuel après conversion
			}
		}

		if($year === null){
			$this->year = intval(date('Y'));// affecter l'année actuelle après conversion
		}
		else{
			if(is_int($year) && $year > 1970){
				$this->year = $year;
				//throw new Exception("L'année est inférieur à 1970"); 
			}
			else{
				$this->year = intval(date('Y'));// affecter l'année actuelle après conversion
			}	
		}

	}

	// méthode qui retourne le premier jour du mois
	public function getFirstDay(): DateTimeInterface {// car DateTimeImmutable implémente l'interface DateTimeInterface
		return new DateTimeImmutable("{$this->year}-{$this->month}-01");// DateTimeImmutable retourne l'objet original immodifiable meme si on appelle la fonction modify sur cet objet
	}

	// méthode qui retourne le mois et l'année
	public function toString(): string {// ...: string c.à.d la fct retourne une chaine de caractères
		return $this->months[$this->month - 1] . ' ' . $this->year;
	}

	// méthode qui retourne le nombre de semaines du mois
	public function getWeeks(): int {
		$start = $this->getFirstDay();// début de mois
		$end = $start->modify('+1 month -1 day');// prendre une copie de start et la modifie
		$startWeek = intval($start->format('W'));
		$endWeek = intval($end->format('W'));
		if($endWeek === 1){
			$endWeek = intval($end->modify('- 7 days')->format('W')) + 1;
		}
		$weeks = $endWeek - $startWeek + 1;//le nombre de semaines du mois
		if($weeks < 0){// ce cas est pour janvier car sa semaine début peut etre une semaine de l'année passée
			$weeks = intval($end->format('W'));// expl: pour jan 2017, weeks vaut 5
		}
		return $weeks;
	}

	// méthode qui vérifie si le jour est dans le mois en cours
	public function withinMonth(DateTimeInterface $date): bool {
		return $this->getFirstDay()->format('Y-m') === $date->format('Y-m');
	}

	// méthode qui retourne le mois prochain
	public function nextMonth(): Month {
		$month = $this->month + 1;
		$year = $this->year;
		if($month > 12){
			$month = 1;
			$year += 1;
		}
		return new Month($month, $year);
	}

	// méthode qui retourne le mois précédent
	public function previousMonth(): Month {
		$month = $this->month - 1;
		$year = $this->year;
		if($month < 1){
			$month = 12;
			$year -= 1;
		}
		return new Month($month, $year);
	}
}

?>