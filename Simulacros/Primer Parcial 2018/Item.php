<?php

class Item {
  private $cantVendida;
  private $refProducto;

  public function __construct($cantVendida, $refProducto) {
    $this->cantVendida = $cantVendida;
    $this->refProducto = $refProducto;
  }

  public function getcantVendida() {
    return $this->cantVendida;
  }
  public function getrefProducto() {
    return $this->refProducto;
  }

  public function setcantVendida($cantVendida) {
    $this->cantVendida = $cantVendida;
  }
  public function setrefProducto($refProducto) {
    $this->refProducto = $refProducto;
  }

  public function __toString() {
    $string = "";
    $string = $string . "\n\n\n------------ ITEM ------------";
    $string = $string . "\nCantidad Vendida: " . $this->getcantVendida();
    $string = $string . "\nProducto: " . $this->getrefProducto()->__toString();
    $string = $string . "\n--------------------------------";
    return $string;
  }
}
