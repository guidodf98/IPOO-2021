<?php

class ABMMusicalAct {
  /**
   * Pide al usuario un ID de funcion y un nuevo director
   * Modifica el director de la funcion con el ID ingresado
   */
  public static function modificarDirectorFuncion() {
    $funcion = ABMFuncion::seleccionarFuncion('musical');
    echo "\nNuevo director: ";
    $director = trim(fgets(STDIN));
    $funcion->setDirector($director);
    $funcion->modificar();
  }

  /**
   * Pide al usuario un ID de funcion y una nueva cantidad de personas
   * Modifica la cantidad de personas de la funcion con el ID ingresado
   */
  public static function modificarCantPersonasFuncion() {
    $funcion = ABMFuncion::seleccionarFuncion('musical');
    $cantPersonas = pedirEnteroPositivo("\nNueva cantidad de personas: ");
    $funcion->setCantPersonas($cantPersonas);
    $funcion->modificar();
  }
}
