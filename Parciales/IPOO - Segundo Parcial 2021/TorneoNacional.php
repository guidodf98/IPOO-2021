<?php

class TorneoNacional extends Torneo {

  public function __construct($montoPremio, $idTorneo, $localidad, $colPartidos) {
    parent::__construct($montoPremio, $idTorneo, $localidad, $colPartidos);
  }

  public function __toString() {
    $string = "\n\n\n------------ TORNEO NACIONAL ------------" .
      parent::__toString();
    return $string;
  }

  public function obtenerPremioTorneo() {
    $ganador = parent::obtenerEquipoGanadorTorneo();
    $montoTotal = parent::obtenerPremioTorneo();
    return ($montoTotal + (($montoTotal * 0.1) * $ganador["goles"]));
  }
}
