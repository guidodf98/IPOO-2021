<?php

class Cuota {
  private $numero;
  private $montoCuota;
  private $montoInteres;
  private $cancelada;

  public function __construct($numero, $montoCuota, $montoInteres) {
    $this->numero = $numero;
    $this->montoCuota = $montoCuota;
    $this->montoInteres = $montoInteres;
    $this->cancelada = false;
  }


  public function getNumero() {
    return $this->numero;
  }
  public function getMontoCuota() {
    return $this->montoCuota;
  }
  public function getMontoInteres() {
    return $this->montoInteres;
  }
  public function getCancelada() {
    return $this->cancelada;
  }


  public function setNumero($numero) {
    $this->numero = $numero;
  }
  public function setMontoCuota($montoCuota) {
    $this->montoCuota = $montoCuota;
  }
  public function setMontoInteres($montoInteres) {
    $this->montoInteres = $montoInteres;
  }
  public function setCancelada($cancelada) {
    $this->cancelada = $cancelada;
  }


  public function __toString() {
    $string = "";
    $string = $string . "\nNumero: " . $this->getNumero();
    $string = $string . "\nMonto Cuota: " . $this->getMontoCuota();
    $string = $string . "\nMonto Interes: " . $this->getMontoInteres();
    $string = $string . "\nCancelada: ";
    if ($this->getCancelada()) {
      $string = $string . "Si";
    } else {
      $string = $string . "No";
    }
    return $string;
  }

  /**
   * Suma el monto de la cuota y el monto de interes y lo retorna
   * @return int
   */
  public function darMontoFinalCuota() {
    $montoFinal = $this->getMontoCuota() + $this->getMontoInteres();
    return $montoFinal;
  }
}
