<?php

class TorneoProvincial extends Torneo {

  public function __construct($montoPremio, $idTorneo, $localidad, $colPartidos) {
    parent::__construct($montoPremio, $idTorneo, $localidad, $colPartidos);
  }

  public function __toString() {
    $string = "\n\n\n------------ TORNEO PROVINCIAL ------------" .
      parent::__toString();
    return $string;
  }

  #public function obtenerPremioTorneo() {
  #  return (parent::obtenerPremioTorneo() * 1.45);
  #}
}
