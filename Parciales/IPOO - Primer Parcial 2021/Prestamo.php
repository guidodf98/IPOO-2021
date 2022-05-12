<?php

class Prestamo {
  private $identificacion;
  private $codigoElectro;
  private $fechaOtorgamiento;
  private $monto;
  private $cantCuotas;
  private $tazaInteres;
  private $colCuotas;
  private $refPersona;


  public function __construct($identificacion, $codigoElectro, $monto, $cantCuotas, $tazaInteres, $refPersona) {
    $this->identificacion = $identificacion;
    $this->codigoElectro = $codigoElectro;
    $this->fechaOtorgamiento = null;
    $this->monto = $monto;
    $this->cantCuotas = $cantCuotas;
    $this->tazaInteres = $tazaInteres;
    $this->colCuotas = [];
    $this->refPersona = $refPersona;
  }


  public function getIdentificacion() {
    return $this->identificacion;
  }
  public function getCodigoElectro() {
    return $this->codigoElectro;
  }
  public function getFechaOtorgamiento() {
    return $this->fechaOtorgamiento;
  }
  public function getMonto() {
    return $this->monto;
  }
  public function getCantCuotas() {
    return $this->cantCuotas;
  }
  public function getTazaInteres() {
    return $this->tazaInteres;
  }
  /**
   * @return array
   */
  public function getColCuotas() {
    return $this->colCuotas;
  }
  public function getRefPersona() {
    return $this->refPersona;
  }


  public function setIdentificacion($identificacion) {
    $this->identificacion = $identificacion;
  }
  public function setCodigoElectro($codigoElectro) {
    $this->codigoElectro = $codigoElectro;
  }
  public function setFechaOtorgamiento($fechaOtorgamiento) {
    $this->fechaOtorgamiento = $fechaOtorgamiento;
  }
  public function setMonto($monto) {
    $this->monto = $monto;
  }
  public function setCantCuotas($cantCuotas) {
    $this->cantCuotas = $cantCuotas;
  }
  public function setTazaInteres($tazaInteres) {
    $this->tazaInteres = $tazaInteres;
  }
  public function setColCuotas($colCuotas) {
    $this->colCuotas = $colCuotas;
  }
  public function setRefPersona($refPersona) {
    $this->refPersona = $refPersona;
  }


  public function __toString() {
    $string = "";
    $string = $string . "\nIdentificacion: " . $this->getIdentificacion();
    $string = $string . "\nCodigo del Electrodomestico: " . $this->getCodigoElectro();
    $string = $string . "\nFecha Otorgamiento: " . $this->getFechaOtorgamiento();
    $string = $string . "\nMonto: $" . $this->getMonto();
    $string = $string . "\nCantidad de Cuotas: " . $this->getCantCuotas();
    $string = $string . "\nTaza de Interes: " . $this->getTazaInteres() . "%";

    $string = $string . "\nCuotas del prestamo: ";
    $string = $string . "\n\n---------- CUOTAS ----------";
    if ($this->getColCuotas() !== []) {
      foreach ($this->getColCuotas() as $indice => $cuota) {
        $string = $string . "\n\n-------- CUOTA " . ($indice + 1) . " --------";
        $string = $string . $cuota->__toString();
      }
    } else {
      $string = $string . "\n\nSin datos de cuotas";
    }
    $string = $string . "\n\n---------- FIN CUOTAS ----------";

    $string = $string . "\nPersona: " . $this->getRefPersona()->__toString();
    return $string;
  }

  /**
   * Anota la fecha actual en la que se otorga el prestamo
   * Genera cada cuota del prestamo segun la cantidad de cuotas establecidas
   * Se calcula su coste y se asigna a la coleccion de cuotas
   */
  public function otorgarPrestamo() {
    $cantCuotas = $this->getCantCuotas();
    $montoCuota = $this->getMonto() / $cantCuotas;

    $this->setFechaOtorgamiento($this->fechaActual());

    for ($i = 0; $i < $cantCuotas; $i++) {
      $montoInteres = $this->calcularInteresPrestamo($i);
      $cuota = new Cuota($i + 1, $montoCuota, $montoInteres);
      $this->setNuevaCuota($cuota);
    }
  }

  /**
   * Recibe un numero de cuota y calcula el importe de interes sobre el saldo deudor
   * @param int
   * @return int
   */
  private function calcularInteresPrestamo($numCuota) {
    $interesCuota = 0;

    if ($numCuota > 0) {
      $monto = $this->getMonto();
      $interesCuota = ($monto - (($monto / $this->getCantCuotas()) * $numCuota - 1)) * $this->getTazaInteres();
    }

    return $interesCuota;
  }

  /**
   * Recorre la coleccion de cuotas en busqueda de una que no haya sido cancelada
   * Devuelve la primer cuota sin cancelar que encuentra
   * @return Cuota
   */
  public function darSiguienteCuotaPagar() {
    $colCuotas = $this->getColCuotas();
    $siguiente = null;
    $i = 0;
    while ($i < count($colCuotas) && $colCuotas[$i]->getCancelada()) {
      $i++;
    }
    if ($i < count($colCuotas)) {
      $siguiente = $colCuotas[$i];
    }
    return $siguiente;
  }

  /**
   * Ingresa una cuota al final de la coleccion de cuotas
   * @param Cuota
   */
  public function setNuevaCuota($cuota) {
    $this->colCuotas[count($this->getColCuotas())] = $cuota;
  }

  /**
   * Devuelve la fecha actual con año, mes, dia, hora y minuto
   * @return string
   */
  private function fechaActual() {
    $localtime_assoc = localtime(time(), true);
    $año = $localtime_assoc["tm_year"] + 1900;
    $mes = $localtime_assoc["tm_mon"] + 1;
    $dia = $localtime_assoc["tm_mday"];
    $hora = $localtime_assoc["tm_hour"] - 5;
    $minuto = $localtime_assoc["tm_min"];
    $resultado = $dia . "/" . $mes . "/" .  $año . " a las " . $hora . ":" . $minuto;
    return $resultado;
  }
}
