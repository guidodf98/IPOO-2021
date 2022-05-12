<?php

class Financiera {
  private $denominacion;
  private $direccion;
  private $colPrestamos;

  public function __construct($denominacion, $direccion) {
    $this->denominacion = $denominacion;
    $this->direccion = $direccion;
    $this->colPrestamos = [];
  }


  public function getDenominacion() {
    return $this->denominacion;
  }
  public function getDireccion() {
    return $this->direccion;
  }
  /**
   * @return array
   */
  public function getColPrestamos() {
    return $this->colPrestamos;
  }


  public function setDenominacion($denominacion) {
    $this->denominacion = $denominacion;
  }
  public function setDireccion($direccion) {
    $this->direccion = $direccion;
  }
  public function setColPrestamos($colPrestamos) {
    $this->colPrestamos = $colPrestamos;
  }


  public function __toString() {
    $string = "";
    $string = $string . "\n\n\n------------ FINANCIERA ------------";
    $string = $string . "\nDenominacion: " . $this->getDenominacion();
    $string = $string . "\nDireccion: " . $this->getDireccion();

    $string = $string . "\n\n---------- PRESTAMOS ----------";
    if ($this->getColPrestamos() !== []) {
      foreach ($this->getColPrestamos() as $indice => $prestamo) {
        $string = $string . "\n\n-------- PRESTAMO " . ($indice + 1) . " --------";
        $string = $string . $prestamo->__toString();
        $string = $string . "\n\n-------- FIN PRESTAMO " . ($indice + 1) . " --------";
      }
    } else {
      $string = $string . "\n\nSin datos de prestamo";
    }

    return $string;
  }

  /**
   * Busca el prestamo que coincide con el id ingresado
   * Si lo encontro, calcula la siguiente cuota por pagar y la retorna
   * @param int
   * @return Cuota
   */
  public function informarCuotaPagar($idPrestamo) {
    $colPrestamos = $this->getColPrestamos();
    $pagarCuota = null;
    $i = 0;
    while ($i < count($colPrestamos) && $colPrestamos[$i]->getIdentificacion() !== $idPrestamo) {
      $i++;
    }
    if ($i < count($colPrestamos)) {
      $pagarCuota = $colPrestamos[$i]->darSiguienteCuotaPagar();
    }
    return $pagarCuota;
  }

  /**
   * Recorre la coleccion de prestamos
   * Si el prestamo no genero cuotas, se verifica si la persona esta 
   * habilitada para pagar
   * Si puede pagar, se le otorga el prestamo
   */
  public function otorgarPrestamoSiCalifica() {
    $colPrestamos = $this->getColPrestamos();
    foreach ($colPrestamos as $prestamo) {
      if ($prestamo->getColCuotas() === []) {
        $netoPersona = $prestamo->getRefPersona()->getNeto();
        if ($prestamo->getMonto() / $prestamo->getCantCuotas() <= ($netoPersona * 40 / 100)) {
          $prestamo->otorgarPrestamo();
        }
      }
    }
  }

  /**
   * Agrega un nuevo prestamo al final de la coleccion
   * @param Prestamo
   */
  public function incorporarPrestamo($nuevoPrestamo) {
    $this->colPrestamos[count($this->getColPrestamos())] = $nuevoPrestamo;
  }
}
