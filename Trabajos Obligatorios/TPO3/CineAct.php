<?php

class CineAct extends Funciones {
  private $genero;
  private $paisOrigen;

  public function __construct($nombre, $horaInicio, $duracion, $precio, $genero, $paisOrigen) {
    parent::__construct($nombre, $horaInicio, $duracion, $precio);
    $this->$genero = $genero;
    $this->$paisOrigen = $paisOrigen;
  }

  public function getGenero() {
    return $this->genero;
  }

  public function getPaisOrigen() {
    return $this->paisOrigen;
  }

  public function setGenero($genero) {
    $this->genero = $genero;
  }

  public function setPaisOrigen($paisOrigen) {
    $this->paisOrigen = $paisOrigen;
  }

  public function __toString() {
    $string = "\n\n\n------------ Actividad Cine ------------" .
      parent::__toString().
      "Genero: " . $this->getGenero().
      "Pais de origen: " . $this->getPaisOrigen();

    return $string;
  }
  
  public function darCostos() {
    return (parent::darCosto() * 1.65);
  }
}
