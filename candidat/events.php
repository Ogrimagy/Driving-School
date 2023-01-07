<?php 
include 'event.php';
class Events {

	private $pdo;
	public $id_c;

	public function __construct(PDO $pdo){
		$this->pdo = $pdo;
	}

	// fonction qui retourne un tableau d'évènements(Event []) compris entre $start et $end
	public function getEventsBetween(DateTimeInterface $start, DateTimeInterface $end, int $id_candidat): array {
		$st = $start->format('Y-m-d 00:00:00');
		$fn = $end->format('Y-m-d 23:59:59');
		$id_c = $id_candidat;
    	try{
        	$requete = $this->pdo->prepare("SELECT * FROM Leçon WHERE (Leçon.id_candidat = '$id_c' AND (debut BETWEEN :deb AND :fn)) ORDER BY debut ASC");// ORDER BY debut ASC permettre de trier les évènement dans l'affichage par ordre ascendant(croissant)
        	$requete->execute(array('deb' => $st, 'fn' => $fn));
			$requete->setFetchMode(PDO::FETCH_CLASS, Event::class);// faire un fetch à base de classe(renvoyer un objet) et envoyer le résultat à la classe Event
        	$results = $requete->fetchAll();
        	return $results;
			//$connexion = null;
    	}catch (PDOException $e) {
        	die('Erreur ! '.$e->getMessage());
    	}
		
	}

	// fonction qui retourne un tableau d'évènements compris entre $start et $end indexé par jour
	public function getEventsBetweenByDay(DateTimeInterface $start, DateTimeInterface $end, int $id_candidat): array {
		$events = $this->getEventsBetween($start, $end, $id_candidat);
		$days = [];
		foreach($events as $event){
			$date = $event->getDebut()->format('Y-m-d');// prendre uniquement la date, sans temps
			if(!isset($days[$date])){// s'il n ya pas d'évènement, créer un tableau avec un seul évènement
				$days[$date] = [$event];
			}
			else{// s'il existe des évènements dans le tableau, alors ajouter cet évènement au tableau
				$days[$date][] = $event;
			}
		}
		return $days;// retourner les jours
	}

	// récupérer un évènement par son id
	public function find(int $id): Event{
		$requete = $this->pdo->prepare("SELECT * FROM Leçon WHERE id = :id");
        $requete->execute(array('id' => $id));
		$requete->setFetchMode(PDO::FETCH_CLASS, Event::class);// faire un fetch à base de classe(renvoyer un objet) et envoyer le résultat à la classe Event
        $result = $requete->fetch();
        if($result === false){
        	throw new Exception("Aucun résultat n'a été trouvé");
        }
        return $result;
	}

	// fonction qui remplit les données d'un évènement avant de le créer ou le modifier au niveau de la BDD
	public function hydrate(Event $event, array $data){
		$event->setNom($data['titre_e']);
		$event->setDebut(DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $data['date_e'] . ' ' . $data['start'])->format('Y-m-d H:i:s'));
		$event->setFin(DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $data['date_e'] . ' ' . $data['end'])->format('Y-m-d H:i:s'));
		$event->setMoniId($data['id_m']);
		$event->setCandId($data['id_can']);
		return $event;
	}

	// créer un évènement
	public function create(Event $event): bool {
		$requete = $this->pdo->prepare("INSERT INTO Leçon (nom, debut, fin, id_m, id_candidat) VALUES (:nom, :deb, :fin, :id_m, :id)");
		return $requete->execute(array(
			'nom'  	=> $event->getNom(), 
			'deb'  	=> $event->getDebut()->format('Y-m-d H:i:s'), 
			'fin'  	=> $event->getFin()->format('Y-m-d H:i:s'),
			'id_m'	=> $event->getMoniId(),
			'id'	=> $event->getCandId()
		));// retourner true si la requete est éxécutée sans problème. false sinon.
	}

	// mettre à jour un évènement
	public function update(Event $event): bool {
		$requete = $this->pdo->prepare("UPDATE Leçon SET nom = :nom, debut = :deb, fin = :fin WHERE id = :id");
		return $requete->execute(array(
			'nom' => $event->getNom(), 
			'deb' => $event->getDebut()->format('Y-m-d H:i:s'), 
			'fin' => $event->getFin()->format('Y-m-d H:i:s'),
			'id'  => $event->getId()
		));
	}

	// supprimer un évènement
	public function delete(Event $event): bool {
		$requete = $this->pdo->prepare("DELETE FROM Leçon WHERE id = :id");
		return $requete->execute(array('id' => $event->getId()));
	}
}

?>