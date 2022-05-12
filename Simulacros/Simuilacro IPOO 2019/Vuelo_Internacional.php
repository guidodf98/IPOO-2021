<?php

class Vuelo_Internacional extends Vuelo {
  private $cantEscalas;

  public function __construct($numeroVuelo, $cantPlazasEco, $cantPlazasEje, $horaPartida, $horaLlegada, $destino, $refAvion, $importe, $colPasajeros, $cantEscalas, $iva) {
    parent::__construct($numeroVuelo, $cantPlazasEco, $cantPlazasEje, $horaPartida, $horaLlegada, $destino, $refAvion, $importe, $colPasajeros);
    $this->cantEscalas = $cantEscalas;
  }


  public function getCantEscalas() {
    return $this->cantEscalas;
  }

  public function setcantEscalas($cantEscalas) {
    $this->cantEscalas = $cantEscalas;
  }


  public function __toString() {
    $string = "";
    $string .= "\n\n\n------------ VUELO INTERNACIONAL ------------";
    $string .= parent::__toString();
    $string .= "\ncantEscalas: " . $this->getCantEscalas();

    $string .= "\n--------------------------------";
    return $string;
  }


  public function calcularImporte($objPasajero){
    $importe = parent::calcularImporte($objPasajero);
    $importe /= $this -> getCantEscalas() * 0.7;
    return $importe;
}
}
