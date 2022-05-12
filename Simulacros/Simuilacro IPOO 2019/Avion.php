<?php

class Avion {
  private $numeroAvion;
  private $plazasEconomicas;
  private $plazasEjecutivas;

  public function __construct($numeroAvion, $plazasEconomicas, $plazasEjecutivas) {
    $this->numeroAvion = $numeroAvion;
    $this->plazasEconomicas = $plazasEconomicas;
    $this->plazasEjecutivas = $plazasEjecutivas;
  }

  
  public function getNumeroAvion() {
    return $this->numeroAvion;
  }
  public function getPlazasEconomicas() {
    return $this->plazasEconomicas;
  }
  public function getPlazasEjecutivas() {
    return $this->plazasEjecutivas;
  }


  public function setNumeroAvion($numeroAvion) {
    $this->numeroAvion = $numeroAvion;
  }
  public function setPlazasEconomicas($plazasEconomicas) {
    $this->plazasEconomicas = $plazasEconomicas;
  }
  public function setPlazasEjecutivas($plazasEjecutivas) {
    $this->plazasEjecutivas = $plazasEjecutivas;
  }


  public function __toString() {
    $string = "";
    $string = $string . "\n\n\n------------ AVION ------------";
    $string = $string . "\nNumero de Avion: " . $this->getNumeroAvion();
    $string = $string . "\nPlazas Economicas: " . $this->getPlazasEconomicas();
    $string = $string . "\nPlazas Ejecutivas: " . $this->getPlazasEjecutivas();

    $string = $string . "\n--------------------------------";
    return $string;
  }



}
