<?php

class Venta2 {
  private $numero;
  private $fecha;
  private $refCliente;
  private $refColProductos;
  private $precioFinal;

  public function __construct($numero, $fecha, $refCliente) {
    $this->numero = $numero;
    $this->fecha = $fecha;
    $this->refCliente = $refCliente;
    $this->refColProductos = [];
    $this->precioFinal = 0;
  }

  public function getNumero() {
    return $this->numero;
  }
  public function getFecha() {
    return $this->fecha;
  }
  public function getRefCliente() {
    return $this->refCliente;
  }
  public function getRefColProductos() {
    return $this->refColProductos;
  }
  public function getPrecioFinal() {
    return $this->precioFinal;
  }

  public function setNumero($numero) {
    $this->numero = $numero;
  }
  public function setFecha($fecha) {
    $this->fecha = $fecha;
  }
  public function setRefCliente($refCliente) {
    $this->refCliente = $refCliente;
  }
  public function setRefColProductos($objProducto) {
    if ($objProducto !== null) {
      $this->refColProductos[count($this->refColProductos)] = $objProducto;
    }
  }
  public function setPrecioFinal($precioFinal) {
    $this->precioFinal = $precioFinal;
  }

  public function __toString() {
    $string = "";
    $string = $string . "\nNumero de venta: " . ($this->getnumero() + 1);
    $string = $string . "\nFecha: " . $this->getfecha();
    $string = $string . "\n-------- CLIENTE --------" . $this->getrefCliente()->__toString();
    $string = $string . "\n-------------------------";
    foreach ($this->getrefColProductos() as $producto) {
      $string = $string . "\n-------- PRODUCTO --------" . $producto->__toString();
    }
    $string = $string . "\n--------------------------";
    $string = $string . "\nPrecio Final: $" . $this->getprecioFinal();
    return $string;
  }

  /**
   * Devuelve true si se pudo incorporar el producto a la coleccion
   * Caso contrario devuelve false
   * @param Producto
   */
  public function incorporarProducto($objProducto) {
    $precioProducto = $objProducto->darPrecioVenta();
    $exito = false;
    if ($precioProducto > 0) {
      $this->setRefColProductos($objProducto);
      $this->setPrecioFinal($this->getPrecioFinal() + $precioProducto);
      $exito = true;
    }
    return $exito;
  }
}
