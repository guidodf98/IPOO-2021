<?php
class Teatro {
  private $nombre;
  private $direccion;
  private $funciones;

  public function __construct($nombre, $direccion, $funciones) {
    $this->nombre = $nombre;
    $this->direccion = $direccion;
    $this->funciones = $funciones;
  }

  public function getNombre() {
    return $this->nombre;
  }
  public function getDireccion() {
    return $this->direccion;
  }
  public function getFunciones() {
    return $this->funciones;
  }
  public function setNombre($nombre) {
    $this->nombre = $nombre;
  }
  public function setDireccion($direccion) {
    $this->direccion = $direccion;
  }

  public function setNombreFuncion($nombre, $num) {
    $this->funciones[$num - 1]["nombre"] = $nombre;
  }

  public function setPrecioFuncion($precio, $num) {
    $this->funciones[$num - 1]["precio"] = $precio;
  }
  
  public function __toString() {
    $resultado =
      "\n\n ---- Teatro " . $this->nombre . " ---- " .
      "\nDireccion: " . $this->direccion .
      "\n";
    for ($i = 0; $i < 4; $i++) {
      $resultado = $resultado . "\n-- Funcion " . ($i + 1) . " --";
      $resultado = $resultado . "\nNombre: " . $this->funciones[$i]["nombre"];
      $resultado = $resultado . "\nPrecio: $" . $this->funciones[$i]["precio"] . "\n";
    }
    return $resultado;
  }
}
