<?php

class Edificio {
  private $direccion;
  private $colDepartamentos;
  private $refAdministrador;

  public function __construct($direccion, $colDepartamentos, $refAdministrador) {
    $this->direccion = $direccion;
    $this->colDepartamentos = $colDepartamentos;
    $this->refAdministrador = $refAdministrador;
  }

  public function getDireccion() {
    return $this->direccion;
  }
  public function getColDepartamentos() {
    return $this->colDepartamentos;
  }
  public function getRefAdministrador() {
    return $this->refAdministrador;
  }

  public function setdireccion($direccion) {
    $this->direccion = $direccion;
  }
  public function setcolDepartamentos($colDepartamentos) {
    $this->colDepartamentos = $colDepartamentos;
  }
  public function setrefAdministrador($refAdministrador) {
    $this->refAdministrador = $refAdministrador;
  }

  public function __toString() {
    $string = "";
    $string = $string . "\n\n\n------------ EDIFICIO ------------";
    $string = $string . "\nDirección: " . $this->getDireccion();
    $string = $string . "\nAdministrador: " . $this->getRefAdministrador();
    $string = $string . "\n\n-------- DEPARTAMENTOS --------";
    if ($this->getColDepartamentos() !== []) {
      foreach ($this->getColDepartamentos() as $numero => $depto) {
        $string = $string . "\n\n------ DEPTO " . ($numero + 1) . " ------";
        $string = $string . $depto->__toString();
        $string = $string . "\n\n---------------------";
      }
    } else {
      $string = $string . "\n\nSin datos de departamentos";
    }
    $string = $string . "\n--------------------------------";
    return $string;
  }

  public function darInmueblesDisponiblesParaAlquilar($unTipoInmueble, $costoMensual) {
    $deptosDisponibles = [];
    foreach ($this->getColDepartamentos() as $depto) {
      if ($depto->getRefPersona() === null && $depto->getTipoInmueble() === $unTipoInmueble && $depto->getCostoMensual() <= $costoMensual) {
        array_push($deptosDisponibles, $depto);
      }
    }
    return $deptosDisponibles;
  }

  /**
   * @param Inmueble
   * @param Persona
   */
  public function registrarAlquilerInmueble($objInmueble, $objPersona) {
    $exito = false;
    $deptosDeTipo = $this->darInmueblesDisponiblesParaAlquilar($objInmueble->getTipoInmueble(), 9999999999999999999);

    $i = -1;
    do {
      $i++;
    } while ($i < count($deptosDeTipo) && $deptosDeTipo[$i] !== $objInmueble);
 
    if ($i < count($deptosDeTipo) && $deptosDeTipo[$i] === $objInmueble) {
      if ($i === 0 || $deptosDeTipo[$i - 1]->getRefPersona() !== null) {
        $objInmueble->alquilarInmueble($objPersona);
        $exito = true;
      }
    }
    return $exito;
  }

  public function calculaCostoEdificio() {
    $costo = 0;
    foreach ($this->getColDepartamentos() as $depto) {
      if ($depto->getRefPersona() !== null) {
        $costo += $depto->getCostoMensual();
      }
    }
    return $costo;
  }
}
