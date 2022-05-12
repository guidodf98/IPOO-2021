<?php

class Persona {
  private $tipoDoc;
  private $numDoc;
  private $nombre;
  private $apellido;
  private $telefono;

  public function __construct($tipoDoc, $numDoc, $nombre, $apellido, $telefono) {
    $this->tipoDoc = $tipoDoc;
    $this->numDoc = $numDoc;
    $this->nombre = $nombre;
    $this->apellido = $apellido;
    $this->telefono = $telefono;
  }

  public function getTipoDoc() {
    return $this->tipoDoc;
  }
  public function getNumDoc() {
    return $this->numDoc;
  }
  public function getNombre() {
    return $this->nombre;
  }
  public function getApellido() {
    return $this->apellido;
  }
  public function getTelefono() {
    return $this->telefono;
  }

  public function setTipoDoc($tipoDoc) {
    $this->tipoDoc = $tipoDoc;
  }
  public function setNumDoc($numDoc) {
    $this->numDoc = $numDoc;
  }
  public function setNombre($nombre) {
    $this->nombre = $nombre;
  }
  public function setApellido($apellido) {
    $this->apellido = $apellido;
  }
  public function setTelefono($telefono) {
    $this->telefono = $telefono;
  }

  public function __toString() {
    $string = "";
    $string = $string . "\n| Tipo de Documento: " . $this->getTipoDoc();
    $string = $string . "\n| Numero de Documento: " . $this->getNumDoc();
    $string = $string . "\n| Nombre: " . $this->getNombre();
    $string = $string . "\n| Apellido: " . $this->getApellido();
    $string = $string . "\n| Telefono: " . $this->getTelefono();
    return $string;
  }
}
