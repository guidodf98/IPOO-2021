<?php

class Aereolinea {
  private $nombre;
  private $colVuelos;

  public function __construct($nombre, $colVuelos) {
    $this->nombre = $nombre;
    $this->colVuelos = $colVuelos;
  }


  public function getNombre() {
    return $this->nombre;
  }
  public function getColVuelos() {
    return $this->colVuelos;
  }

  public function setNombre($nombre) {
    $this->nombre = $nombre;
  }
  public function setColVuelos($colVuelos) {
    $this->colVuelos = $colVuelos;
  }
  public function setNuevoVuelo($objVuelo) {
    $this->colVuelos[count($this->colVuelos)] = $objVuelo;
  }


  public function __toString() {
    $string = "";
    $string = $string . "\n\n\n------------ AEREOLINEA ------------";
    $string = $string . "\nNombre: " . $this->getNombre();

    $string = $string . "\n\n---------- VUELOS ----------";
    if ($this->getColVuelos() !== []) {
      foreach ($this->getColVuelos() as $indice => $coleccion) {
        $string = $string . "\n\n-------- VUELO " . ($indice + 1) . " --------";
        $string = $string . $coleccion->__toString();
        $string = $string . "\n\n---------------------";
      }
    } else {
      $string = $string . "\n\nSin datos de vuelos";
    }

    $string = $string . "\n--------------------------------";
    return $string;
  }

  //un arreglo asociativo con las siguientes claves (partida, hora de llegada al destino, importe)

  public function configurarVuelo($objDestino, $objAvion, $datos) {
    $numeroVuelo = count($this->getColVuelos);
    $cantPlazasEco = $objAvion->getPlazasEconomicas();
    $cantPlazasEje = $objAvion->getPlazasEjecutivas();
    $horaPartida = $datos["partida"];
    $horaLlegada = $datos["llegada"];
    $destino = $objDestino->getNombreDestino();
    $refAvion = $objAvion;
    $importe = $datos["importe"];
    $colPasajeros = [];
    new Vuelo($numeroVuelo, $cantPlazasEco, $cantPlazasEje, $horaPartida, $horaLlegada, $destino, $refAvion, $importe, $colPasajeros);
  }
}
