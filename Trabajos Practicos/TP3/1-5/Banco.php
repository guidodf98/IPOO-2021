<?php

class Banco {
  private $colCuentaCorriente;
  private $colCajaAhorro;
  private $ultimoValorCuentaAsignado;
  private $colCliente;

  public function __construct($colCuentaCorriente, $colCajaAhorro, $ultimoValorCuentaAsignado, $colCliente) {
    $this->colCuentaCorriente = $colCuentaCorriente;
    $this->colCajaAhorro = $colCajaAhorro;
    $this->ultimoValorCuentaAsignado = $ultimoValorCuentaAsignado;
    $this->colCliente = $colCliente;
  }

  public function getColCuentaCorriente() {
    return $this->colCuentaCorriente;
  }
  public function getColCajaAhorro() {
    return $this->colCajaAhorro;
  }
  public function getUltimoValorCuentaAsignado() {
    return $this->ultimoValorCuentaAsignado;
  }
  public function getColCliente() {
    return $this->colCliente;
  }

  public function setColCuentaCorriente($colCuentaCorriente) {
    $this->colCuentaCorriente = $colCuentaCorriente;
  }
  public function setColCajaAhorro($colCajaAhorro) {
    $this->colCajaAhorro = $colCajaAhorro;
  }
  public function setUltimoValorCuentaAsignado($ultimoValorCuentaAsignado) {
    $this->ultimoValorCuentaAsignado = $ultimoValorCuentaAsignado;
  }
  public function setColCliente($colCliente) {
    $this->colCliente = $colCliente;
  }

  public function __toString() {
    $string = "";
    $string = $string . "\n\n\n------------ CLASE ------------";
    $string = $string . "\n\n---------- CUENTAS CORRIENTES----------";
    if ($this->getColCuentaCorriente() !== []) {
      foreach ($this->getColCuentaCorriente() as $indice => $cuenta) {
        $string = $string . "\n\n-------- CUENTA " . ($indice + 1) . " --------";
        $string = $string . $cuenta->__toString();
        $string = $string . "\n\n---------------------";
      }
    } else {
      $string = $string . "\n\nSin datos de objeto";
    }
    $string = $string . "\n\n---------- CAJAS DE AHORRO ----------";
    if ($this->getColCajaAhorro() !== []) {
      foreach ($this->getColCajaAhorro() as $indice => $caja) {
        $string = $string . "\n\n-------- CAJA DE AHORRO " . ($indice + 1) . " --------";
        $string = $string . $caja->__toString();
        $string = $string . "\n\n---------------------";
      }
    } else {
      $string = $string . "\n\nSin datos de cajas de ahorro";
    }
    $string = $string . "\nultimoValorCuentaAsignado: " . $this->getUltimoValorCuentaAsignado();
    $string = $string . "\n\n---------- CLIENTES ----------";
    if ($this->getColCliente() !== []) {
      foreach ($this->getColCliente() as $indice => $cliente) {
        $string = $string . "\n\n-------- CLIENTE " . ($indice + 1) . " --------";
        $string = $string . $cliente->__toString();
        $string = $string . "\n\n---------------------";
      }
    } else {
      $string = $string . "\n\nSin datos de clientes";
    }
    $string = $string . "\n--------------------------------";
    return $string;
  }

  public function incorporarCliente($objCliente) {
    if ($objCliente !== null) {
      $colCliente = $this->getColCliente();
      array_push($colCliente, $objCliente);
      $this->setColCliente($colCliente);
    }
  }
  public function incorporarCuentaCorriente($objCuentaCorriente) {
    if ($objCuentaCorriente !== null) {
      $colCuentaCorriente = $this->getColCuentaCorriente();
      array_push($colCliente, $objCuentaCorriente);
      $this->setColCuentaCorriente($colCuentaCorriente);
    }
  }
  public function incorporarCajaAhorro($objCajaAhorro) {
    if ($objCajaAhorro !== null) {
      $colCajaAhorro = $this->getColCajaAhorro();
      array_push($colCajaAhorro, $objCajaAhorro);
      $this->setColCajaAhorro($colCajaAhorro);
    }
  }
}
