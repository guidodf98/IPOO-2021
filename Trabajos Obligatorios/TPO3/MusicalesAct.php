<?php

class MusicalesAct extends Funciones {
  private $director;
  private $cantPersonas;

  public function __construct($nombre, $horaInicio, $duracion, $precio, $director, $cantPersonas) {
    parent::__construct($nombre, $horaInicio, $duracion, $precio);
    $this->director = $director;
    $this->cantPersonas = $cantPersonas;
  }

  public function getDirector() {
    return $this->director;
  }

  public function getCantPersonas() {
    return $this->cantPersonas;
  }

  public function setDirector($director) {
    $this->director = $director;
  }

  public function setCantPersonas($cantPersonas) {
    $this->cantPersonas = $cantPersonas;
  }

  public function __toString() {
    $string = "\n\n\n------------ Actividad Musicales ------------" .
      parent::__toString() .
      "Director: " . $this->getDirector() .
      "Cantidad de personas: " . $this->getCantPersonas();
    return $string;
  }
  
  public function darCostos() {
    return (parent::darCosto() * 1.12);
  }
}
