<?php

class Partido {
  private $idPartido;
  private $fecha;
  private $cantGolesE1;
  private $cantGolesE2;
  private $objEquipo1;
  private $objEquipo2;


  public function __construct($idPartido, $fecha, $cantGolesE1, $cantGolesE2, $objEquipo1, $objEquipo2) {
    $this->idPartido = $idPartido;
    $this->fecha = $fecha;
    $this->cantGolesE1 = $cantGolesE1;
    $this->cantGolesE2 = $cantGolesE2;
    $this->objEquipo1 = $objEquipo1;
    $this->objEquipo2 = $objEquipo2;
  }


  public function getIdPartido() {
    return $this->idPartido;
  }
  public function getFecha() {
    return $this->fecha;
  }
  public function getCantGolesE1() {
    return $this->cantGolesE1;
  }
  public function getCantGolesE2() {
    return $this->cantGolesE2;
  }
  public function getobjEquipo1() {
    return $this->objEquipo1;
  }
  public function getobjEquipo2() {
    return $this->objEquipo2;
  }


  public function setIdPartido($idPartido) {
    $this->idPartido = $idPartido;
  }
  public function setFecha($fecha) {
    $this->fecha = $fecha;
  }
  public function setCantGolesE1($cantGolesE1) {
    $this->cantGolesE1 = $cantGolesE1;
  }
  public function setCantGolesE2($cantGolesE2) {
    $this->cantGolesE2 = $cantGolesE2;
  }
  public function setObjEquipo1($objEquipo1) {
    $this->objEquipo1 = $objEquipo1;
  }
  public function setObjEquipo2($objEquipo2) {
    $this->objEquipo2 = $objEquipo2;
  }


  public function __toString() {
    $string = ""
      . "\n\n\n------------ Partido ------------"
      . "\Id de partido: " . $this->getIdPartido()
      . "\nFecha: " . $this->getFecha()
      . "\nCantidad de goles equipo 1: " . $this->getCantGolesE1()
      . "\nCantidad de goles equipo 2: " . $this->getCantGolesE2()
      . "\nEquipo 1: " . $this->getobjEquipo1()->__toString()
      . "\nEquipo 2: " . $this->getobjEquipo2()->__toString()
      . "\n--------------------------------";
    return $string;
  }
}
