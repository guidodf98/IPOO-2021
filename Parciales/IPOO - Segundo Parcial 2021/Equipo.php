<?php

class Equipo {
  private $nombre;
  private $nombreCapitan;
  private $cantJugadores;
  private $objCategoria;

  public function __construct($nombre, $nombreCapitan, $cantJugadores, $objCategoria) {
    $this->nombre = $nombre;
    $this->nombreCapitan = $nombreCapitan;
    $this->cantJugadores = $cantJugadores;
    $this->objCategoria = $objCategoria;
  }

  public function getNombre() {
    return $this->nombre;
  }
  public function getNombreCapitan() {
    return $this->nombreCapitan;
  }
  public function getCantJugadores() {
    return $this->cantJugadores;
  }
  public function getObjCategoria() {
    return $this->objCategoria;
  }

  /**
   * @return String
   */
  public function setNombre($nombre) {
    $this->nombre = $nombre;
  }
  public function setNombreCapitan($nombreCapitan) {
    $this->nombreCapitan = $nombreCapitan;
  }
  public function setCantJugadores($cantJugadores) {
    $this->cantJugadores = $cantJugadores;
  }
  public function setObjCategoria($objCategoria) {
    $this->objCategoria = $objCategoria;
  }

  public function __toString() {
    $string = ""
      . "\n\n\n------------ Equipo ------------"
      . "\nNombre: " . $this->getNombre()
      . "\nNombre del capitan: " . $this->getNombreCapitan()
      . "\nCantidad de jugadores: " . $this->getCantJugadores()
      . "\nCategoria: " . $this->getObjCategoria()->__toString()
      . "\n--------------------------------";
    return $string;
  }
}
