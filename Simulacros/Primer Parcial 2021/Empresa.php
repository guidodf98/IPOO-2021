<?php

class Empresa {
  private $denominacion;
  private $direccion;
  private $colClientes;
  private $colProductos;
  private $colVentas;

  public function __construct($denominacion, $direccion, $colClientes, $colProductos, $colVentas) {
    $this->denominacion = $denominacion;
    $this->direccion = $direccion;
    $this->colClientes = $colClientes;
    $this->colProductos = $colProductos; //[$p] arreglo de objetos
    $this->colVentas = $colVentas;
  }

  public function getDenominacion() {
    return $this->denominacion;
  }
  public function getDireccion() {
    return $this->direccion;
  }
  public function getColClientes() {
    return $this->colClientes;
  }
  public function getColProductos() {
    return $this->colProductos;
  }
  public function getColVentas() {
    return $this->colVentas;
  }

  public function setDenominacion($denominacion) {
    $this->denominacion = $denominacion;
  }
  public function setDireccion($direccion) {
    $this->direccion = $direccion;
  }
  public function setColClientes($colClientes) {
    $this->colClientes = $colClientes;
  }
  public function setColProductos($colProductos) {
    $this->colProductos = $colProductos;
  }
  public function setColVentas($colVentas) {
    $this->colVentas = $colVentas;
  }

  public function __toString() {
    $string = "\n---------------- EMPRESA ----------------";
    $string = $string . "\nDenominacion: " . $this->getdenominacion();
    $string = $string . "\nDireccion: " . $this->getdireccion();
    $string = $string . "\n\n\n-------- CLIENTES --------";
    if ($this->getcolClientes() !== []) {
      foreach ($this->getcolClientes() as $numero => $cliente) {
        $string = $string . "\n\n------ CLIENTE " . ($numero + 1) . " ------";
        $string = $string . $cliente->__toString();
        $string = $string . "\n---------------------";
      }
    } else {
      $string = $string . "\n\nSin datos de clientes";
    }
    $string = $string . "\n--------------------------";
    $string = $string . "\n\n\n-------- PRODUCTOS --------";
    if ($this->getcolProductos() !== []) {
      foreach ($this->getcolProductos() as $numero => $producto) {
        $string = $string . "\n\n------ PRODUCTO " . ($numero + 1) . " ------";
        $string = $string . $producto->__toString();
        $string = $string . "\n\n---------------------";
      }
    } else {
      $string = $string . "\nSin datos de productos";
    }
    $string = $string . "\n---------------------------";
    $string = $string . "\n\n\n------------ VENTAS ------------";
    if ($this->getColVentas() !== []) {
      foreach ($this->getColVentas() as $numero => $venta) {
        $string = $string . "\n\n------ VENTA " . ($numero + 1) . " ------";
        $string = $string . $venta->__toString();
        $string = $string . "\n\n---------------------";
      }
    } else {
      $string = $string . "\n\nSin datos de ventas";
    }
    $string = $string . "\n--------------------------------";
    $string = $string . "\n\n-----------------------------------------";
    return $string;
  }


  
  public function setNuevaVenta($venta) {
    $this->colVentas[count($this->getColVentas())] = $venta;
  }

  public function retornarProducto($codigoProducto) {
    $producto = null;
    $colProd = $this->getcolProductos();
    if (count($colProd) !== 0) {
      $i = 0;
      while ($producto === null && $i < count($colProd)) {
        if ($colProd[$i]->getCodigo() === $codigoProducto) {
          $producto = $colProd[$i];
        }
        $i++;
      }
    }
    return $producto;
  }

  public function registrarVenta($colCodigosProductos, $objCliente) {
    if (!$objCliente->getDeBaja()) {
      $a = new Venta2(count($this->getColVentas()), $this->fechaActual(), $objCliente);
      foreach ($colCodigosProductos as $codProd) {
        $producto = $this->retornarProducto($codProd);
        if ($producto !== null) {
          if ($producto->getActivo()) {
            $a->incorporarProducto($producto);
          }
        }
      }
      if ($a->getPrecioFinal() !== 0) {
        $this->setNuevaVenta($a);
      }
    }
    return $a->getPrecioFinal();
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

  public function retornarVentasXCliente($tipo, $numDoc) {
    $colVentasCliente = [];
    $ventas = $this->getColVentas();
    foreach ($ventas as $venta) {
      $cliente = $venta->getRefCliente();
      if ($cliente->getTipoDocumento() === $tipo && $cliente->getNumeroDocumento() === $numDoc) {
        array_push($colVentasCliente, $venta);
      }
    }
    return $colVentasCliente;
  }
}
