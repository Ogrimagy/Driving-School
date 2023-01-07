<?php

class Event {
	// les propriétées de l'objet Event
	
	private $id;
	private $nom;
	private $debut;
	private $fin;
	private $moniId;
	private $candId;

	// getters

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

	// setters

	public function setNom(string $nom){
		$this->nom = $nom;
	}

	public function setDebut(string $debut){
		$this->debut = $debut;
	}

	public function setFin(string $fin){
		$this->fin = $fin;
	}

	public function setMoniId(int $id){
		$this->moniId = $id;
	}

	public function setCandId(int $id){
		$this->candId = $id;
	}
}

?>