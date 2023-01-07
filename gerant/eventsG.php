<?php 
include 'eventG.php';
class Events {

	private $pdo;

	public function __construct(PDO $pdo){
		$this->pdo = $pdo;
	}

	public function getEventsBetween(DateTimeInterface $start, DateTimeInterface $end): array {
		$st = $start->format('Y-m-d 00:00:00');
		$fn = $end->format('Y-m-d 23:59:59');
    	try{
        	$requete = $this->pdo->prepare("SELECT * FROM Leçon WHERE ((debut BETWEEN :deb AND :fn)) ORDER BY debut ASC");
        	$requete->execute(array('deb' => $st, 'fn' => $fn));
		$requete->setFetchMode(PDO::FETCH_CLASS, Event::class);
        	$results = $requete->fetchAll();
        	return $results;
    	}catch (PDOException $e) {
        	die('Erreur ! '.$e->getMessage());
    	}
		
	}

	public function getEventsBetweenByDay(DateTimeInterface $start, DateTimeInterface $end): array {
		$events = $this->getEventsBetween($start, $end);
		$days = [];
		foreach($events as $event){
			$date = $event->getDebut()->format('Y-m-d');
			if(!isset($days[$date])){
				$days[$date] = [$event];
			}
			else{
				$days[$date][] = $event;
			}
		}
		return $days;
	}

	public function find(int $id): Event{
	$requete = $this->pdo->prepare("SELECT * FROM Leçon WHERE id = :id");
        $requete->execute(array('id' => $id));
	$requete->setFetchMode(PDO::FETCH_CLASS, Event::class);
        $result = $requete->fetch();
        if($result === false){
        	throw new Exception("Aucun résultat n'a été trouvé");
        }
        return $result;
	}
}

?>