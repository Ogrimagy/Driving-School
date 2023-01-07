<?php

class Event {
	
	
	private $id;
	private $nom;
	private $debut;
	private $fin;
	private $moniId;
	private $candId;

	

	public function getId(): int {
		return $this->id;
	}

	public function getNom(): string {
		return $this->nom;
	}

	public function getDebut(): DateTimeInterface {
		return new DateTimeImmutable($this->debut);
	}

	public function getFin(): DateTimeInterface {
		return new DateTimeImmutable($this->fin);
	}

	public function getMoniId(): int {
		return intval($this->moniId);
	}

	public function getCandId(): int {
		return intval($this->candId);
	}
}

?>