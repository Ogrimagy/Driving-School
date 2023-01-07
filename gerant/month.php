<?php 

class Month{

	public $days = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
	private $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
	public $month;
	public $year;

	
	public function __construct(?int $month = null, ?int $year = null){// les paramètres peuvent etre null(null <==> pas de params)

		if($month === null){
			$this->month = intval(date('m'));
		}
		else{
			if(is_int($month) && $month >= 1 && $month <= 12){
				$this->month = $month;
			}
			else{
				$this->month = intval(date('m'));
			}
		}

		if($year === null){
			$this->year = intval(date('Y'));
		}
		else{
			if(is_int($year) && $year > 1970){
				$this->year = $year;
			}
			else{
				$this->year = intval(date('Y'));
			}	
		}

	}

	
	public function getFirstDay(): DateTimeInterface {
		return new DateTimeImmutable("{$this->year}-{$this->month}-01");
	}

	public function toString(): string {
		return $this->months[$this->month - 1] . ' ' . $this->year;
	}

	
	public function getWeeks(): int {
		$start = $this->getFirstDay();
		$end = $start->modify('+1 month -1 day');
		$startWeek = intval($start->format('W'));
		$endWeek = intval($end->format('W'));
		if($endWeek === 1){
			$endWeek = intval($end->modify('- 7 days')->format('W')) + 1;
		}
		$weeks = $endWeek - $startWeek + 1;
		if($weeks < 0){
			$weeks = intval($end->format('W'));
		}
		return $weeks;
	}

	
	public function withinMonth(DateTimeInterface $date): bool {
		return $this->getFirstDay()->format('Y-m') === $date->format('Y-m');
	}

	
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