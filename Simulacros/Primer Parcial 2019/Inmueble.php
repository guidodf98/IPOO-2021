
<?php

class Inmueble {
  private $codigoRef;
  private $numPiso;
  private $tipoInmueble;
  private $costoMensual;
  private $refPersona;

  public function __construct($codigoRef, $numPiso, $tipoInmueble, $costoMensual, $refPersona) {
    $this->codigoRef = $codigoRef;
    $this->numPiso = $numPiso;
    $this->tipoInmueble = $tipoInmueble;
    $this->costoMensual = $costoMensual;
    $this->refPersona = $refPersona;
  }

  public function getCodigoRef() {
    return $this->codigoRef;
  }
  public function getNumPiso() {
    return $this->numPiso;
  }
  public function getTipoInmueble() {
    return $this->tipoInmueble;
  }
  public function getCostoMensual() {
    return $this->costoMensual;
  }
  /**
   * @return Persona
   */
  public function getRefPersona() {
    return $this->refPersona;
  }

  public function setCodigoRef($codigoRef) {
    $this->codigoRef = $codigoRef;
  }
  public function setNumPiso($numPiso) {
    $this->numPiso = $numPiso;
  }
  public function setTipoInmueble($tipoInmueble) {
    $this->tipoInmueble = $tipoInmueble;
  }
  public function setCostoMensual($costoMensual) {
    $this->costoMensual = $costoMensual;
  }
  public function setRefPersona($refPersona) {
    $this->refPersona = $refPersona;
  }

  public function __toString() {
    $string = "";
    $string = $string . "\nCodigo de referencia: " . $this->getCodigoRef();
    $string = $string . "\nNúmero de piso: " . $this->getNumPiso();
    $string = $string . "\nTipo de inmueble: " . $this->getTipoInmueble();
    $string = $string . "\nCosto mensual: " . $this->getCostoMensual();
    if ($this->getRefPersona() !== null) {
      $string = $string . "\nPersona: " . $this->getRefPersona()->__toString();
    } else {
      $string = $string . "\nSin datos de persona";
    }
    return $string;
  }

  public function alquilarInmueble($objPersona) {
    $exito = false;
    if ($this->getRefPersona() === null) {
      $this->setRefPersona($objPersona);
      $exito = true;
    }
    return $exito;
  }
}
