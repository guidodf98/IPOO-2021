<?php

class Vuelo {
  private $numeroVuelo;
  private $cantPlazasEco;
  private $cantPlazasEje;
  private $horaPartida;
  private $horaLlegada;
  private $destino;
  private $refAvion;
  private $importe;
  private $colPasajeros;

  public function __construct($numeroVuelo, $cantPlazasEco, $cantPlazasEje, $horaPartida, $horaLlegada, $destino, $refAvion, $importe, $colPasajeros) {
    $this->numeroVuelo = $numeroVuelo;
    $this->cantPlazasEco = $cantPlazasEco;
    $this->cantPlazasEje = $cantPlazasEje;
    $this->horaPartida = $horaPartida;
    $this->horaLlegada = $horaLlegada;
    $this->destino = $destino;
    $this->refAvion = $refAvion;
    $this->importe = $importe;
    $this->colPasajeros = $colPasajeros;
  }


  public function getNumeroVuelo() {
    return $this->numeroVuelo;
  }
  public function getCantPlazasEco() {
    return $this->cantPlazasEco;
  }
  public function getCantPlazasEje() {
    return $this->cantPlazasEje;
  }
  public function getHoraPartida() {
    return $this->horaPartida;
  }
  public function getHoraLlegada() {
    return $this->horaLlegada;
  }
  public function getDestino() {
    return $this->destino;
  }
  public function getRefAvion() {
    return $this->refAvion;
  }
  public function getImporte() {
    return $this->importe;
  }
  public function getColPasajeros() {
    return $this->colPasajeros;
  }


  public function setNumeroVuelo($numeroVuelo) {
    $this->numeroVuelo = $numeroVuelo;
  }
  public function setCantPlazasEco($cantPlazasEco) {
    $this->cantPlazasEco = $cantPlazasEco;
  }
  public function setCantPlazasEje($cantPlazasEje) {
    $this->cantPlazasEje = $cantPlazasEje;
  }
  public function setHoraPartida($horaPartida) {
    $this->horaPartida = $horaPartida;
  }
  public function setHoraLlegada($horaLlegada) {
    $this->horaLlegada = $horaLlegada;
  }
  public function setDestino($destino) {
    $this->destino = $destino;
  }
  public function setRefAvion($refAvion) {
    $this->refAvion = $refAvion;
  }
  public function setImporte($importe) {
    $this->importe = $importe;
  }
  public function setColPasajeros($colPasajeros) {
    $this->colPasajeros = $colPasajeros;
  }


  public function __toString() {
    $string = "";
    $string = $string . "\n\n\n------------ CLASE ------------";
    $string = $string . "\nnumeroVuelo: " . $this->getNumeroVuelo();
    $string = $string . "\ncantPlazasEco: " . $this->getCantPlazasEco();
    $string = $string . "\ncantPlazasEje: " . $this->getCantPlazasEje();
    $string = $string . "\nhoraPartida: " . $this->getHoraPartida();
    $string = $string . "\nhoraLlegada: " . $this->getHoraLlegada();
    $string = $string . "\ndestino: " . $this->getDestino();
    $string = $string . "\ndestino: " . $this->getRefAvion()->__toString();
    $string = $string . "\ndestino: " . $this->getImporte();

    $string = $string . "\n\n---------- PASAJEROS ----------";
    if ($this->getColPasajeros() !== []) {
      foreach ($this->getColPasajeros() as $indice => $pasajero) {
        $string = $string . "\n\n-------- PASAJERO " . ($indice + 1) . " --------";
        $string = $string . $pasajero->__toString();
        $string = $string . "\n\n---------------------";
      }
    } else {
      $string = $string . "\n\nSin datos de pasajeros";
    }

    $string = $string . "\n--------------------------------";
    return $string;
  }


  public function calcularImporte($refPersona) {
    $total = $this->getImporte();
    if ($refPersona->getNacionalidad() == "Argentina") {
      $total *=  1.21;
    }
    return $total;
  }
}
