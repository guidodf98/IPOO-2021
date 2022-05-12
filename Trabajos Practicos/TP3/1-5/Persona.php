<?php

class Persona {
  private $dni;
  private $nombre;
  private $apellido;

  public function __construct($dni, $nombre, $apellido) {
    $this->dni = $dni;
    $this->nombre = $nombre;
    $this->apellido = $apellido;
  }


  public function getDni() {
    return $this->dni;
  }
  public function getNombre() {
    return $this->nombre;
  }
  public function getApellido() {
    return $this->apellido;
  }


  public function setDni($dni) {
    $this->dni = $dni;
  }
  public function setNombre($nombre) {
    $this->nombre = $nombre;
  }
  public function setApellido($apellido) {
    $this->apellido = $apellido;
  }


  public function __toString() {
    $string = "";
    $string = $string . "\n\n\n------------ CLIENTE ------------";
    $string = $string . "\nDni: " . $this->getDni();
    $string = $string . "\nNombre: " . $this->getNombre();
    $string = $string . "\nApellido: " . $this->getApellido();

    $string = $string . "\n--------------------------------";
    return $string;
  }
}
