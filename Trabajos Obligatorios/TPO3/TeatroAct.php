<?php

class TeatroAct extends Funciones {

  public function __construct($nombre, $horaInicio, $duracion, $precio) {
    parent::__construct($nombre, $horaInicio, $duracion, $precio);
  }

  public function __toString() {
    $string = "\n\n\n------------ Actividad Teatro ------------" .
      parent::__toString();
    return $string;
  }

  public function darCostos() {
    return (parent::darCosto() * 1.45);
  }
}
