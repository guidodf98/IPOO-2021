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

  public function setFunciones($funciones) {
    $this->funciones = $funciones;
  }

  public function setNombreFuncion($nombre, $pos) {
    $this->funciones[$pos - 1]->setNombre($nombre);
  }

  public function setPrecioFuncion($precio, $pos) {
    $this->funciones[$pos - 1]->setPrecio($precio);
  }

  public function __toString() {
    $resultado =
      "\n\n ---- Teatro " . $this->nombre . " ---- " .
      "\nDireccion: " . $this->direccion .
      "\n";
    if ($this->funciones != null) {
      for ($i = 0; $i < count($this->funciones); $i++) {
        $resultado = $resultado . "\n-- Funcion " . ($i + 1) . " --";
        $resultado = $resultado . $this->funciones[$i]->__toString();
      }
    } else {
      $resultado = $resultado . "\nNo hay datos de funciones ";
    }
    return $resultado;
  }

  public function darCosto() {
    $costoTotal = 0;
    foreach ($this->getFunciones() as $funcion) {
      $costoTotal += $funcion->darCostos();
    }
    return $costoTotal;
  }
}
