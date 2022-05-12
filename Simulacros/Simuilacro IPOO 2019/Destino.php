<?php

class Destino {
  private $nombreDestino;
  private $descripcion;

  public function __construct($nombreDestino, $descripcion) {
    $this->nombreDestino = $nombreDestino;
    $this->descripcion = $descripcion;
  }


  public function getNombreDestino() {
    return $this->nombreDestino;
  }
  public function getDescripcion() {
    return $this->descripcion;
  }


  public function setNnombreDestino($nombreDestino) {
    $this->nombreDestino = $nombreDestino;
  }
  public function setDescripcion($descripcion) {
    $this->descripcion = $descripcion;
  }


  public function __toString() {
    $string = ""
      . "\n\n\n------------ DESTINO ------------"
      . "\nNombre de Destino: " . $this->getNombreDestino()
      . "\nDescripcion: " . $this->getDescripcion()
      . "\n--------------------------------";
    return $string;
  }
}
