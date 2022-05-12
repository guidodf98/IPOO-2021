<?php

class Pasajero {
  private $numeroPasaporte;
  private $numeroDoc;
  private $nacionalidad;
  private $nombre;
  private $apellido;

  public function __construct($numeroPasaporte, $numeroDoc, $nacionalidad, $nombre, $apellido) {
    $this->numeroPasaporte = $numeroPasaporte;
    $this->numeroDoc = $numeroDoc;
    $this->nacionalidad = $nacionalidad;
    $this->nombre = $nombre;
    $this->apellido = $apellido;
  }

  
  public function getNumeroPasaporte() {
    return $this->numeroPasaporte;
  }
  public function getNumeroDoc() {
    return $this->numeroDoc;
  }
  public function getNacionalidad() {
    return $this->nacionalidad;
  }
  public function getNombre() {
    return $this->nombre;
  }
  public function getApellido() {
    return $this->apellido;
  }


  public function setNumeroPasaporte($numeroPasaporte) {
    $this->numeroPasaporte = $numeroPasaporte;
  }
  public function setNumeroDoc($numeroDoc) {
    $this->numeroDoc = $numeroDoc;
  }
  public function setNacionalidad($nacionalidad) {
    $this->nacionalidad = $nacionalidad;
  }
  public function setNombre($nombre) {
    $this->nombre = $nombre;
  }
  public function setApellido($apellido) {
    $this->apellido = $apellido;
  }


  public function __toString() {
    $string = "";
    $string = $string . "\n\n\n------------ PASAJERO ------------";
    $string = $string . "\nNumero de Pasaporte: " . $this->getNumeroPasaporte();
    $string = $string . "\nNumero de Documento: " . $this->getNumeroDoc();
    $string = $string . "\nNacionalidad: " . $this->getNacionalidad();
    $string = $string . "\nNombre: " . $this->getNombre();
    $string = $string . "\nApellido: " . $this->getApellido();

    $string = $string . "\n--------------------------------";
    return $string;
  }



}
