<?php

class ABMCineAct {
  /**
   * Pide al usuario un ID de funcion y un nuevo genero
   * Modifica el genero de la funcion con el ID ingresado
   */
  public static function modificarGeneroFuncion() {
    $funcion = ABMFuncion::seleccionarFuncion('cine');
    echo "\nNuevo genero: ";
    $genero = trim(fgets(STDIN));
    $funcion->setGenero($genero);
    $funcion->modificar();
  }

  /**
   * Pide al usuario un ID de funcion y un nuevo pais de origen
   * Modifica el pais de origen de la funcion con el ID ingresado
   */
  public static function modificarPaisOrigenFuncion() {
    $funcion = ABMFuncion::seleccionarFuncion('cine');
    echo "\nNuevo pais de origen: ";
    $paisOrigen = trim(fgets(STDIN));
    $funcion->setPaisOrigen($paisOrigen);
    $funcion->modificar();
  }
}
