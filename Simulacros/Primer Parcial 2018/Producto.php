<?php

class Producto {
  private $codigoBarra;
  private $nombre;
  private $marca;
  private $color;
  private $talle;
  private $descripcion;
  private $cantStock;

  /**
   * @param int
   * @param string
   * @param string
   * @param string
   * @param string
   * @param string
   * @param int
   */
  public function __construct($codigoBarra, $nombre, $marca, $color, $talle, $descripcion, $cantStock) {
    $this->codigoBarra = $codigoBarra;
    $this->nombre = $nombre;
    $this->marca = $marca;
    $this->color = $color;
    $this->talle = $talle;
    $this->descripcion = $descripcion;
    $this->cantStock = $cantStock;
  }

  public function getCodigoBarra() {
    return $this->codigoBarra;
  }
  public function getNombre() {
    return $this->nombre;
  }
  public function getMarca() {
    return $this->marca;
  }
  public function getColor() {
    return $this->color;
  }
  public function getTalle() {
    return $this->talle;
  }
  public function getDescripcion() {
    return $this->descripcion;
  }
  public function getCantStock() {
    return $this->cantStock;
  }

  public function setCodigoBarra($codigoBarra) {
    $this->codigoBarra = $codigoBarra;
  }
  public function setNombre($nombre) {
    $this->nombre = $nombre;
  }
  public function setMarca($marca) {
    $this->marca = $marca;
  }
  public function setColor($color) {
    $this->color = $color;
  }
  public function setTalle($talle) {
    $this->talle = $talle;
  }
  public function setDescripcion($descripcion) {
    $this->descripcion = $descripcion;
  }
  public function setCantStock($cantStock) {
    $this->cantStock = $cantStock;
  }

  public function __toString() {
    $string = "";
    $string = $string . "\n\n\n------------ PRODUCTO ------------";
    $string = $string . "\nCodigo de Barra: " . $this->getcodigoBarra();
    $string = $string . "\nNombre: " . $this->getnombre();
    $string = $string . "\nMarca: " . $this->getmarca();
    $string = $string . "\nColor: " . $this->getcolor();
    $string = $string . "\nTalle: " . $this->gettalle();
    $string = $string . "\nDescripcion: " . $this->getdescripcion();
    $string = $string . "\nCantidad en stock: " . $this->getcantStock();
    $string = $string . "\n--------------------------------";
    return $string;
  }

  public function actualizarStock($cant) {
    $this->setCantStock($this->getCantStock() + $cant);
  }
}
