<?php

class Funciones1 {
  private $nombre;
  private $horaInicio;
  private $duracion;
  private $precio;

  public function __construct($nombre, $horaInicio, $duracion, $precio) {
    $this->nombre = $nombre;
    $this->horaInicio = $horaInicio;
    $this->duracion = $duracion;
    $this->precio = $precio;
  }

  public function getNombre() {
    return $this->nombre;
  }
  public function getHoraInicio() {
    return $this->horaInicio;
  }
  public function getDuracion() {
    return $this->duracion;
  }
  public function getPrecio() {
    return $this->precio;
  }
  public function setNombre($nombre) {
    $this->nombre = $nombre;
  }
  public function setHoraInicio($horaInicio) {
    $this->horaInicio = $horaInicio;
  }
  public function setDuracion($duracion) {
    $this->duracion = $duracion;
  }
  public function setPrecio($precio) {
    $this->precio = $precio;
  }
  public function __toString() {
    $resultado = '';
    $resultado = $resultado . "\nNombre: " . $this->nombre;
    $resultado = $resultado . "\nHora Inicio: " . $this->getHoraInicio()["hora"] . ":" . $this->getHoraInicio()["minuto"];
    $resultado = $resultado . "\nDuracion: " . $this->getDuracion()["hora"] . ":" . $this->getDuracion()["minuto"];
    $resultado = $resultado . "\nPrecio: $" . $this->precio;
    return $resultado;
  }
}
