<?php

class Cuenta {
  private $nroCuenta;
  private $saldo;
  private $refDueño;


  public function __construct($nroCuenta, $saldo, $refDueño) {
    $this->nroCuenta = $nroCuenta;
    $this->saldo = $saldo;
    $this->refDueño = $refDueño;
  }


  public function getNroCuenta() {
    return $this->nroCuenta;
  }
  public function getSaldo() {
    return $this->saldo;
  }
  public function getRefDueño() {
    return $this->refDueño;
  }


  public function setNroCuenta($nroCuenta) {
    $this->nroCuenta = $nroCuenta;
  }
  public function setSaldo($saldo) {
    $this->saldo = $saldo;
  }
  public function setRefDueño($refDueño) {
    $this->refDueño = $refDueño;
  }


  public function __toString() {
    $string = "";
    $string = $string . "\n\n\n------------ CUENTA ------------";
    $string = $string . "\nnroCuenta: " . $this->getNroCuenta();
    $string = $string . "\nsaldo: " . $this->getSaldo();
    $string = $string . "\nDueño de la cuenta: " . $this->getRefDueño()->__toString();
    $string = $string . "\n--------------------------------";
    return $string;
  }

  public function saldoCuenta() {
    return $this->getSaldo();
  }

  public function realizarDeposito($monto) {
    $this->setSaldo($this->getSaldo() + $monto);
  }

  public function realizarRetiro($monto) {
    $this->setSaldo($this->getSaldo() - $monto);
  }
}
