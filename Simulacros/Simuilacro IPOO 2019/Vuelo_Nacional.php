<?php

class Vuelo_Nacional extends Vuelo {

  public function __construct($numeroVuelo, $cantPlazasEco, $cantPlazasEje, $horaPartida, $horaLlegada, $destino, $refAvion, $importe, $colPasajeros, $iva) {
    parent::__construct($numeroVuelo, $cantPlazasEco, $cantPlazasEje, $horaPartida, $horaLlegada, $destino, $refAvion, $importe, $colPasajeros);

  }

  public function __toString() {
    $string = "";
    $string = $string . "\n\n\n------------ VUELO NACIONAL ------------";
    $string .= parent::__toString();

    $string = $string . "\n--------------------------------";
    return $string;
  }
}
