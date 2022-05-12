<?php

class Cliente {
  private $nombre;
  private $apellido;
  private $deBaja;
  private $tipoDocumento;
  private $numeroDocumento;

  public function __construct($nombre, $apellido, $deBaja, $tipoDocumento, $numeroDocumento) {
    $this->nombre = $nombre;
    $this->apellido = $apellido;
    $this->deBaja = $deBaja;
    $this->tipoDocumento = $tipoDocumento;
    $this->numeroDocumento = $numeroDocumento;
  }

  public function getNombre() {
    return $this->nombre;
  }
  public function getApellido() {
    return $this->apellido;
  }
  public function getDeBaja() {
    return $this->deBaja;
  }
  public function getTipoDocumento() {
    return $this->tipoDocumento;
  }
  public function getNumeroDocumento() {
    return $this->numeroDocumento;
  }

  public function setNombre($nombre) {
    $this->nombre = $nombre;
  }
  public function setApellido($apellido) {
    $this->apellido = $apellido;
  }
  public function setDeBaja($deBaja) {
    $this->deBaja = $deBaja;
  }
  public function setTipoDocumento($tipoDocumento) {
    $this->tipoDocumento = $tipoDocumento;
  }
  public function setNumeroDocumento($numeroDocumento) {
    $this->numeroDocumento = $numeroDocumento;
  }

  public function __toString() {
    $string = "";
    $string = $string . "\nNombre: " . $this->getNombre();
    $string = $string . "\nApellido: " . $this->getApellido();
    $string = $string . "\nEsta dado de baja: ";
    if ($this->getDeBaja()) {
      $string = $string . "Si";
    } else {
      $string = $string . "No";
    }
    $string = $string . "\nTipo de documento: " . $this->getTipoDocumento();
    $string = $string . "\nNumero de documento: " . $this->getNumeroDocumento();
    return $string;
  }
}
