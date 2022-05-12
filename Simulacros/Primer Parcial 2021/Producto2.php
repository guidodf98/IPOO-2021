<?php

class Producto2 {
  private $codigo;
  private $costo;
  private $anioFabricacion;
  private $descripcion;
  private $porcentajeIncrementoAnual;
  private $activo;

  public function __construct($codigo, $costo, $anioFabricacion, $descripcion, $porcentajeIncrementoAnual, $activo) {
    $this->codigo = $codigo;
    $this->costo = $costo;
    $this->anioFabricacion = $anioFabricacion;
    $this->descripcion = $descripcion;
    $this->porcentajeIncrementoAnual = $porcentajeIncrementoAnual;
    $this->activo = $activo;
  }

  public function getCodigo() {
    return $this->codigo;
  }
  public function getCosto() {
    return $this->costo;
  }
  public function getAnioFabricacion() {
    return $this->anioFabricacion;
  }
  public function getDescripcion() {
    return $this->descripcion;
  }
  public function getPorcentajeIncrementoAnual() {
    return $this->porcentajeIncrementoAnual;
  }
  public function getActivo() {
    return $this->activo;
  }

  public function setCodigo($codigo) {
    $this->codigo = $codigo;
  }
  public function setCosto($costo) {
    $this->costo = $costo;
  }
  public function setAnioFabricacion($anioFabricacion) {
    $this->anioFabricacion = $anioFabricacion;
  }
  public function setDescripcion($descripcion) {
    $this->descripcion = $descripcion;
  }
  public function setPorcentajeIncrementoAnual($porcentajeIncrementoAnual) {
    $this->porcentajeIncrementoAnual = $porcentajeIncrementoAnual;
  }
  public function setIncrementoAnual($incrementoAnual) {
    $this->incrementoAnual = $incrementoAnual;
  }
  public function setActivo($activo) {
    $this->activo = $activo;
  }

  public function __toString() {
    $string = "";
    $string = $string . "\nCodigo: " . $this->getCodigo();
    $string = $string . "\nCosto: " . $this->getCosto();
    $string = $string . "\nAño de Fabricacion: " . $this->getAnioFabricacion();
    $string = $string . "\nDescripcion: " . $this->getDescripcion();
    $string = $string . "\nPorcentaje de Incremento Anual: " . $this->getPorcentajeIncrementoAnual() . "%";
    $string = $string . "\nActivo: ";
    if ($this->getActivo()) {
      $string = $string . "Si";
    } else {
      $string = $string . "No";
    }
    return $string;
  }

  public function darPrecioVenta() {
    if ($this->getActivo()) {
      $aniosTranscurridos = 2021 - $this->getAnioFabricacion();
      $venta = $this->getCosto() + $this->getCosto() * ($aniosTranscurridos * $this->getPorcentajeIncrementoAnual());
    } else {
      $venta = -1;
    }
    return $venta;
  }
}
