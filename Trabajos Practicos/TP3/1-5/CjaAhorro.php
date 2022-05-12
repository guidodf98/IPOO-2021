<?php

include "Cuenta.php";

class CjaAhorro extends Cuenta {

  public function __construct($nroCuenta, $saldo, $refDueño) {
    parent::__construct($nroCuenta, $saldo, $refDueño);
  }

  public function __toString() {
    $string = "\n\n\n------------ CAJA DE AHORRO ------------";
    $string .= parent::__toString();
    return $string;
  }

  public function realizarRetiro($monto) {
    parent::realizarRetiro($monto);
    if ($this->getSaldo() < 0) {
      $this->realizarDeposito($monto);
    }
  }
}
