<?php

class Torneo {
  private $montoPremio;
  private $idTorneo;
  private $localidad;
  private $colPartidos;

  public function __construct($montoPremio, $idTorneo, $localidad, $colPartidos) {
    $this->montoPremio = $montoPremio;
    $this->idTorneo = $idTorneo;
    $this->localidad = $localidad;
    $this->colPartidos = $colPartidos;
  }

  public function getMontoPremio() {
    return $this->montoPremio;
  }
  public function getIdTorneo() {
    return $this->idTorneo;
  }
  public function getLocalidad() {
    return $this->localidad;
  }
  public function getColPartidos() {
    return $this->colPartidos;
  }

  public function setMontoPremio($montoPremio) {
    $this->montoPremio = $montoPremio;
  }
  public function setIdTorneo($idTorneo) {
    $this->idTorneo = $idTorneo;
  }
  public function setLocalidad($localidad) {
    $this->localidad = $localidad;
  }
  public function setColPartidos($colPartidos) {
    $this->colPartidos = $colPartidos;
  }

  public function __toString() {
    $string = ""
      . "\n\n\n------------ TORNEO ------------"
      . "\nMonto del premio: " . $this->getMontoPremio()
      . "\nId del torneo: " . $this->getIdTorneo()
      . "\nLocalidad: " . $this->getLocalidad()
      . "\n\n---------- PARTIDOS ----------";
    if ($this->getColPartidos() !== []) {
      foreach ($this->getColPartidos() as $indice => $partido) {
        $string .= "\n\n-------- PARTIDO " . ($indice + 1) . " --------";
        $string .= $partido->__toString();
        $string .= "\n\n---------------------";
      }
    } else {
      $string .= "\n\nSin datos de partidos";
    }
    $string .= "\n--------------------------------";
    return $string;
  }

  public function obtenerEquipoGanadorTorneo() {
    $datosEquipo = [];
    $golesEquipo = [];
    $objResultado = [];
    if ($this->getColPartidos() !== null) {
      foreach ($this->getColPartidos() as $partido) {
        # Checkeo equipo que ganó
        $equipoGanador = "empate";
        if ($partido->getCantGolesE1() > $partido->getCantGolesE2()) {
          # Gana equipo 1
          $equipoGanador = $partido->getobjEquipo1();
        } elseif ($partido->getCantGolesE1() < $partido->getCantGolesE2()) {
          # Gana equipo 2
          $equipoGanador = $partido->getobjEquipo2();
        }
        # Asigno al equipo ganador
        if ($equipoGanador != "empate") {
          $nombreEquipoGanador = $equipoGanador->getNombre();
          if (array_key_exists($nombreEquipoGanador, $datosEquipo)) {
            $datosEquipo[$nombreEquipoGanador]["ganados"] = $datosEquipo[$nombreEquipoGanador]["ganados"] + 1;
          } else {
            $datosEquipo[$nombreEquipoGanador]["ganados"] = 1;
          }
        }
        # Asigno goles primer equipo
        $equipo1 = $partido->getobjEquipo1()->getNombre();
        $cantGolesE1 = $partido->getCantGolesE1();
        if (array_key_exists($equipo1, $golesEquipo)) {
          $golesEquipo[$equipo1]["goles"] = $golesEquipo[$equipo1]["goles"] + $cantGolesE1;
        } else {
          $golesEquipo[$equipo1]["goles"] = $cantGolesE1;
        }
        # Asigno goles segundo equipo
        $equipo2 = $partido->getobjEquipo2()->getNombre();
        $cantGolesE2 = $partido->getCantGolesE2();
        if (array_key_exists($equipo2, $golesEquipo)) {
          $golesEquipo[$equipo2]["goles"] = $golesEquipo[$equipo2]["goles"] + $cantGolesE2;
        } else {
          $golesEquipo[$equipo2]["goles"] = $cantGolesE2;
        }
      }

      # Busco equipo ganador
      $mayorCantGanados = -1;
      $resultado = null;
      foreach ($datosEquipo as $nombreEquipo => $equipo) {
        if ($equipo["ganados"] > $mayorCantGanados) {
          $mayorCantGanados = $equipo["ganados"];
          $resultado = $equipo;
          $nombreResultado = $nombreEquipo;
        } elseif ($equipo["ganados"] = $mayorCantGanados) {
          if ($equipo["goles"] > $resultado["goles"]) {
            $resultado = $equipo;
            $nombreResultado = $nombreEquipo;
          }
        }
      }
      $objResultado["goles"] = $resultado["goles"];
      # Retorno el objeto
      $i = 0;
      $encontrado = false;
      while ($i < count($this->getColPartidos()) && !$encontrado) {
        if ($nombreResultado == $this->getColPartidos()->getobjEquipo1()->getNombre()) {
          $encontrado = true;
          $objResultado["equipo"] = $this->getColPartidos()->getobjEquipo1();
        } elseif ($nombreResultado == $this->getColPartidos()->getobjEquipo2()->getNombre()) {
          $encontrado = true;
          $objResultado["equipo"] = $this->getColPartidos()->getobjEquipo2();
        }
      }
    }
    return $objResultado;
  }

  public function obtenerPremioTorneo() {
    return $this->getMontoPremio();
  }
}
