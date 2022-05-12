<?php

class Categoria {
  private $idCategoria;
  private $descripcion;

  public function __construct($idCategoria, $descripcion) {
    $this->idCategoria = $idCategoria;
    $this->descripcion = $descripcion;
  }

  public function getIdCategoria() {
    return $this->idCategoria;
  }
  public function getDescripcion() {
    return $this->descripcion;
  }

  public function setIdCategoria($idCategoria) {
    $this->idCategoria = $idCategoria;
  }
  public function setDescripcion($descripcion) {
    $this->descripcion = $descripcion;
  }

  public function __toString() {
    $string = ""
      . "\n\n\n------------ Partido ------------"
      . "\nId de categoria: " . $this->getIdCategoria()
      . "\nDescripcion: " . $this->getDescripcion()
      . "\n--------------------------------";
    return $string;
  }
}
