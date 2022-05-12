<?php

include "Cuenta.php";

class CtaCorriente extends Cuenta {
  private $montoMinimo;

  public function __construct($nroCuenta, $saldo, $refDueño, $montoMinimo) {
    parent::__construct($nroCuenta, $saldo, $refDueño);
    $this->montoMinimo->$montoMinimo;
  }

  public function getMontoMinimo() {
    return $this->montoMinimo;
  }

  public function setMontoMinimo($montoMinimo) {
    $this->montoMinimo = $montoMinimo;
  }

  public function __toString() {
    $string = "\n\n\n------------ CAJA DE AHORRO ------------";
    $string .= parent::__toString();
    $string .= "\nMonto minimo: " . $this->getMontoMinimo();
    return $string;
  }

  public function realizarRetiro($monto) {
    parent::realizarRetiro($monto);

    if ($this->getSaldo() < $this->getMontoMinimo()) {
      $this->realizarDeposito($monto);
    }
  }
}
