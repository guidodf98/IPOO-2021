<?php

class Tienda {
  private $nombre;
  private $direccion;
  private $telefono;
  private $colProductos;
  private $colVentasRealizadas;

  public function __construct($nombre, $direccion, $telefono, $colProductos, $colVentasRealizadas) {
    $this->nombre = $nombre;
    $this->direccion = $direccion;
    $this->telefono = $telefono;
    $this->colProductos = $colProductos;
    $this->colVentasRealizadas = $colVentasRealizadas;
  }

  public function getNombre() {
    return $this->nombre;
  }
  public function getDireccion() {
    return $this->direccion;
  }
  public function getTelefono() {
    return $this->telefono;
  }
  public function getColProductos() {
    return $this->colProductos;
  }
  public function getColVentasRealizadas() {
    return $this->colVentasRealizadas;
  }

  public function setNombre($nombre) {
    $this->nombre = $nombre;
  }
  public function setDireccion($direccion) {
    $this->direccion = $direccion;
  }
  public function setTelefono($telefono) {
    $this->telefono = $telefono;
  }
  public function setColProductos($colProductos) {
    $this->colProductos = $colProductos;
  }
  public function setcolVentasRealizadas($colVentasRealizadas) {
    $this->colVentasRealizadas = $colVentasRealizadas;
  }
  public function setNuevaVentaRealizada($nuevaVenta) {
    $this->colVentasRealizadas[count($this->colVentasRealizadas)] = $nuevaVenta;
  }

  public function __toString() {
    $string = "";
    $string = $string . "\n\n\n------------ TIENDA ------------";
    $string = $string . "\nNombre: " . $this->getnombre();
    $string = $string . "\nDireccion: " . $this->getdireccion();
    $string = $string . "\nTelefono: " . $this->gettelefono();

    $string = $string . "\n\n---------- PRODUCTOS ----------";
    if ($this->getcolProductos() !== []) {
      foreach ($this->getcolProductos() as $indice => $producto) {
        $string = $string . "\n\n-------- PRODUCTO " . ($indice + 1) . " --------";
        $string = $string . $producto->__toString();
        $string = $string . "\n\n---------------------";
      }
    } else {
      $string = $string . "\n\nSin datos de productos";
    }

    $string = $string . "\n\n---------- VENTAS REALIZADAS ----------";
    if ($this->getcolVentasRealizadas() !== []) {
      foreach ($this->getcolVentasRealizadas() as $indice => $venta) {
        $string = $string . "\n\n-------- VENTA " . ($indice + 1) . " --------";
        $string = $string . $venta->__toString();
        $string = $string . "\n\n---------------------";
      }
    } else {
      $string = $string . "\n\nSin datos de ventas realizadas";
    }

    $string = $string . "\n--------------------------------";
    return $string;
  }

  public function buscarProducto($codigoBarra) {
    $producto = null;
    $encontrado = false;
    $i = 0;
    while ($i < count($this->getcolProductos()) && !$encontrado) {
      if ($this->getcolProductos[$i]->getCodigoBarra() === $codigoBarra) {
        $producto = $this->getcolProductos[$i];
        $encontrado = true;
      }
    }
    return $producto;
  }

  public function realizarVenta($datosVenta) {
    $venta = null;
    $producto = $this->buscarProducto($datosVenta["codigoBarra"]);
    if ($producto !== null) {
      $venta = new Venta(null, null, null, null, null);
      if ($venta->incorporarProducto($producto, $datosVenta["cantidad"])) {
        $venta->setFecha($this->fechaActual());
        $venta->setDenominacionCliente("");
        $venta->setNroFactura(0);
        $venta->setTipoComprobante("");
        $this->setNuevaVentaRealizada[$venta];
      }
    }
    return $venta;
  }

  private function fechaActual() {
    $localtime_assoc = localtime(time(), true);
    $año = $localtime_assoc["tm_year"] + 1900;
    $mes = $localtime_assoc["tm_mon"] + 1;
    $dia = $localtime_assoc["tm_mday"];
    $hora = $localtime_assoc["tm_hour"] - 5;
    $minuto = $localtime_assoc["tm_min"];
    $resultado = $dia . "/" . $mes . "/" .  $año . " a las " . $hora . ":" . $minuto;
    return $resultado;
  }
}
