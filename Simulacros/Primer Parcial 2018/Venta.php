<?php

class Venta {
  private $fecha;
  private $denominacionCliente;
  private $nroFactura;
  private $tipoComprobante;
  private $colItemsVendidos;

  public function __construct($fecha, $denominacionCliente, $nroFactura, $tipoComprobante, $colItemsVendidos) {
    $this->fecha = $fecha;
    $this->denominacionCliente = $denominacionCliente;
    $this->nroFactura = $nroFactura;
    $this->tipoComprobante = $tipoComprobante;
    $this->colItemsVendidos = $colItemsVendidos;
  }

  public function getFecha() {
    return $this->fecha;
  }
  public function getDenominacionCliente() {
    return $this->denominacionCliente;
  }
  public function getNroFactura() {
    return $this->nroFactura;
  }
  public function getTipoComprobante() {
    return $this->tipoComprobante;
  }
  public function getColItemsVendidos() {
    return $this->colItemsVendidos;
  }

  public function setFecha($fecha) {
    $this->fecha = $fecha;
  }
  public function setDenominacionCliente($denominacionCliente) {
    $this->denominacionCliente = $denominacionCliente;
  }
  public function setNroFactura($nroFactura) {
    $this->nroFactura = $nroFactura;
  }
  public function setTipoComprobante($tipoComprobante) {
    $this->tipoComprobante = $tipoComprobante;
  }
  public function setColItemsVendidos($colItemsVendidos) {
    $this->colItemsVendidos = $colItemsVendidos;
  }
  public function setNuevoItemVendido($itemVendido) {
    $this->colItemsVendidos[count($this->getColItemsVendidos())] = $itemVendido;
  }

  public function __toString() {
    $string = "";
    $string = $string . "\n\n\n------------ VENTA ------------";
    $string = $string . "\nFecha: " . $this->getFecha();
    $string = $string . "\nDenominacion del Cliente: " . $this->getDenominacionCliente();
    $string = $string . "\nNúmer de Factura: " . $this->getNroFactura();
    $string = $string . "\nTipo de Comprobante: " . $this->getTipoComprobante();
    $string = $string . "\n\n---------- ITEMS VENDIDOS ----------";
    if ($this->getColItemsVendidos() !== []) {
      foreach ($this->getColItemsVendidos() as $indice => $item) {
        $string = $string . "\n\n-------- ITEM " . ($indice + 1) . " --------";
        $string = $string . $item->__toString();
        $string = $string . "\n\n---------------------";
      }
    } else {
      $string = $string . "\n\nSin datos de items";
    }

    $string = $string . "\n--------------------------------";
    return $string;
  }

  public function incorporarProducto($objProducto, $cantParaVender) {
    $exito = false;
    if ($objProducto->getCantStock() >= $cantParaVender) {
      $this->setNuevoItemVendido(new Item($cantParaVender, $objProducto));
      $objProducto->actualizarStock(-$cantParaVender);
      $exito = true;
    }
    return $exito;
  }
}
