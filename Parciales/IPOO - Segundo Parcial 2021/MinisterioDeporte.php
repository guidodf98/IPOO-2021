<?php

class MinisterioDeporte {
  private $anio;
  private $colTorneos;

  public function __construct($anio) {
    $this->anio = $anio;
    $this->colTorneos = [];
  }

  public function getAnio() {
    return $this->anio;
  }
  public function getColTorneos() {
    return $this->colTorneos;
  }

  public function setAnio($anio) {
    $this->anio = $anio;
  }
  public function setColTorneos($colTorneos) {
    $this->colTorneos = $colTorneos;
  }
  public function setNuevoTorneos($torneo) {
    $this->colTorneos[count($this->getColTorneos())] = $torneo;
  }

  public function __toString() {
    $string = ""
      . "\n\n\n------------ MINISTERIO DE DEPORTES ------------"
      . "\nanio: " . $this->getAnio()
      . "\n\n---------- TORNEOS ----------";
    if ($this->getColTorneos() !== []) {
      foreach ($this->getColTorneos() as $indice => $partido) {
        $string .= "\n\n-------- TORNEO " . ($indice + 1) . " --------";
        $string .= $partido->__toString();
        $string .= "\n\n---------------------";
      }
    } else {
      $string .= "\n\nSin datos de torneos";
    }
    $string .= "\n--------------------------------";
    return $string;
  }

  public function registrarTorneo($colPartidos, $tipo, $arrayAsociativo) {
    if ($tipo == "nacional") {
      $torneo = new TorneoNacional($arrayAsociativo["monto"], $arrayAsociativo["idTorneo"], $arrayAsociativo["localidad"], $colPartidos);
      $this->setNuevoTorneos($torneo);
    } elseif ($tipo == "provincial") {
      $torneo = new TorneoProvincial($arrayAsociativo["monto"], $arrayAsociativo["idTorneo"], $arrayAsociativo["localidad"], $colPartidos);
      $this->setNuevoTorneos($torneo);
    } else {
      $torneo = null;
    }
    return $torneo;
  }

  public function otorgarPremioTorneo($idTorneo) {
    $i = 0;
    $encontrado = false;
    while ($i < count($this->getColTorneos()) && !$encontrado) {
      if ($idTorneo === $this->getColTorneos()[$i]->getIdTorneo()) {
        $encontrado = true;
        $torneoActual = $this->getColTorneos()[$i];
      }
    }
    $resultado = [$torneoActual->obtenerEquipoGanadorTorneo(), $torneoActual->obtenerPremioTorneo()];
    return $resultado;
  }
}
