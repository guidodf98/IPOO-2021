<?php

include "ORM/Teatro.php";
include "ORM/Funcion.php";
include "ORM/TeatroAct.php";
include "ORM/CineAct.php";
include "ORM/MusicalAct.php";

include "transaccion/ABMTeatro.php";
include "transaccion/ABMFuncion.php";
include "transaccion/ABMTeatroAct.php";
include "transaccion/ABMCineAct.php";
include "transaccion/ABMMusicalAct.php";

main();

/**
 * Llama al metodo que muestra las opciones
 * Y ejecuta la opcion elejida
 */
function main() {;
  do {
    $opcion = menu();
    switch ($opcion) {
      case 0:
        break;
      case 1:
        subMenuTeatro();
        break;
      case 2:
        subMenuFuncion();
        break;
      case 3:;
        ABMTeatro::mostrarTeatros();
        break;
      case 4:;
        ABMFuncion::mostrarFunciones();
        break;
      case 5:
        calcularCostoTeatro();
        break;
      default:
        echo "\nOpcion incorrecta\n";
    }
  } while ($opcion != 0);
}

/**
 * Le muestra al usuario las opciones disponibles
 * Lee y devuelve la opcion elegida
 * @return int
 */
function menu() {
  echo "\n\n ------------------- MENU --------------------";
  echo "\n| 1) Opciones de teatro                       |";
  echo "\n| 2) Opciones de funciones                    |";
  echo "\n| 3) Ver teatros registrados                  |";
  echo "\n| 4) Ver funciones registradas                |";
  echo "\n| 5) Calcular el costo de alquiler del teatro |";
  echo "\n| 0) Salir                                    |";
  echo "\n ---------------------------------------------";
  echo "\nIngrese una opción: ";
  $opcion = trim(fgets(STDIN));
  echo "\n";
  return $opcion;
}


/* #################### MENU TEATRO #################### */

/**
 * Llama al metodo que muestra las opciones de teatro
 * Y ejecuta la opcion elejida
 */
function subMenuTeatro() {
  do {
    $opcion = subMenuTeatroOpcion();
    switch ($opcion) {
      case 0:
        break;
      case 1:
        ABMTeatro::ingresarTeatro();
        break;
      case 2:;
        ABMTeatro::modificarNombreTeatro();
        break;
      case 3:;
        ABMTeatro::modificarDireccionTeatro();
        break;
      case 4:;
        ABMTeatro::eliminarTeatro();
        break;
      default:
        echo "\nOpcion incorrecta\n";
    }
  } while ($opcion != 0);
}

/**
 * Muestra las opciones disponibles para los teatros
 * Pide y devuelve la opcion elejida
 * @return int
 */
function subMenuTeatroOpcion() {
  echo "\n --------------- MENU TEATRO ----------------";
  echo "\n| 1) Ingresar nuevo                          |";
  echo "\n| 2) Modifica nombre                         |";
  echo "\n| 3) Modificar direccion                     |";
  echo "\n| 4) Eliminar                                |";
  echo "\n| 0) Salir                                   |";
  echo "\n --------------------------------------------";
  echo "\nIngrese una opción: ";
  $opcion = trim(fgets(STDIN));
  echo "\n";
  return $opcion;
}


/* #################### MENU FUNCION #################### */

/**
 * Llama al metodo que muestra las opciones de funcion
 * Ejecuta la opcion elejida
 */
function subMenuFuncion() {
  do {
    $opcion = subMenuFuncionOpcion();
    switch ($opcion) {
      case 1:
        ABMFuncion::ingresarFuncion();
        break;
      case 2:
        ABMFuncion::modificarNombreFuncion();
        break;
      case 3:
        ABMFuncion::modificarHoraInicioFuncion();
        break;
      case 4:
        ABMFuncion::modificarDuracionFuncion();
        break;
      case 5:
        ABMFuncion::modificarPrecioFuncion();
        break;
      case 6:
        ABMCineAct::modificarGeneroFuncion();
        break;
      case 7:
        ABMCineAct::modificarPaisOrigenFuncion();
        break;
      case 8:
        ABMMusicalAct::modificarDirectorFuncion();
        break;
      case 9:
        ABMMusicalAct::modificarCantPersonasFuncion();
        break;
      case 10:
        ABMFuncion::eliminarFuncion();
        break;
      default:
        "\nOpcion incorrecta\n";
    }
  } while ($opcion != 0);
}

/**
 * Muestra las opciones disponibles para las funciones
 * @return int
 */
function subMenuFuncionOpcion() {
  echo "\n --------------- MENU FUNCION ----------------";
  echo "\n| 1) Ingresar nueva                           |";
  echo "\n| 2) Modificar nombre                         |";
  echo "\n| 3) Modificar hora de inicio                 |";
  echo "\n| 4) Modificar duracion                       |";
  echo "\n| 5) Modificar precio                         |";
  echo "\n| 6) Modificar genero                         |";
  echo "\n| 7) Modificar pais de origen                 |";
  echo "\n| 8) Modificar director                       |";
  echo "\n| 9) Modificar cantidad de personas           |";
  echo "\n| 10) Eliminar                                |";
  echo "\n| 0) Salir                                    |";
  echo "\n ---------------------------------------------";
  echo "\nIngrese una opción: ";
  $opcion = trim(fgets(STDIN));
  echo "\n";
  return $opcion;
}


/* #################### HORARIO #################### */

/**
 * Recibe un id de teatro y busca su coleccion de funciones
 * Por cada funcion, registra la hora de inicio y fin en un arreglo
 * Si recibe una funcion por parametro, quita del arreglo su hora de inicio y fin
 * 
 * @param int
 * @param Funcion
 * @return array
 */
function calcularHorarios($teatro, $funcionR = null) {
  $horariosEstablecidos = [];
  $colFunciones = $teatro->getColFunciones();
  $i = 0;
  foreach ($colFunciones as $funcion) {
    $horaInicio = $funcion->getHoraInicio();
    $horaFin = calcularHoraFin($funcion->getHoraInicio(), $funcion->getDuracion());
    $horariosEstablecidos[$i]['inicio'] = horaInt($horaInicio);
    $horariosEstablecidos[$i]['fin'] = horaInt($horaFin);
    $i++;
  }

  if ($funcionR != null) {
    $repetido = true;
    $nuevaHoraInicio = horaInt($funcionR->getHoraInicio());
    $nuevaHoraFin = horaInt(calcularHoraFin($funcionR->getHoraInicio(), $funcionR->getDuracion()));
    $j = 0;

    while ($j < count($horariosEstablecidos) && $repetido) {
      if ($horariosEstablecidos[$j]['inicio'] == $nuevaHoraInicio && $horariosEstablecidos[$j]['fin'] == $nuevaHoraFin) {
        $horariosEstablecidos[$j] = null;
        $repetido = false;
      } else {
        $j++;
      }
    }
  }
  return $horariosEstablecidos;
}

/**
 * Recibe un id teatro, calcula los horarios establecidos de sus funciones
 * Compara el horario ingresado por parametro, con los ya establecidos
 * Devuelve true o false, si el horario esta disponible
 * 
 * @param string
 * @param string
 * @param Teatro
 * @param Funcion
 * @return boolean
 */
function horarioLibre($horaInicioCompleta, $horaFin, $teatro, $funcion = null) {
  $horariosEstablecidos = calcularHorarios($teatro, $funcion);

  $nuevaHoraInicio = horaInt($horaInicioCompleta);
  $nuevaHoraFin = horaInt($horaFin);

  $disponible = true;
  if ($horariosEstablecidos != []) {
    $i = 0;
    while ($disponible && $i < count($horariosEstablecidos) && $horariosEstablecidos[$i] != null) {
      $horaInicio = $horariosEstablecidos[$i]["inicio"];
      $horaFin = $horariosEstablecidos[$i]["fin"];

      if ($nuevaHoraInicio >= $horaInicio && $nuevaHoraInicio <= $horaFin) {
        $disponible = false;
      } elseif ($nuevaHoraFin >= $horaInicio && $nuevaHoraFin <= $horaFin) {
        $disponible = false;
      } elseif ($nuevaHoraInicio <= $horaInicio && $nuevaHoraFin >= $horaFin) {
        $disponible = false;
      }

      $i++;
    }
  }

  return $disponible;
}

/**
 * Segun una hora de inicio y una duracion
 * calcula la hora de fin
 * @return string
 */
function calcularHoraFin($horaCompleta, $duracion) {
  list($horaInicio, $minInicio) = explode(":", $horaCompleta);
  list($horaDuracion, $minDuracion) = explode(":", $duracion);

  $horaAdd = ($minInicio + $minDuracion) / 60;
  $minuto = ($minInicio + $minDuracion) % 60;
  $hora = ($horaInicio + $horaDuracion + $horaAdd) % 24;

  $horaFin = $hora . ":" . $minuto;
  return $horaFin;
}

/**
 * Ingresa una hora en formato (hh:mm)
 * Separa la hora y minutos en dos variables
 * Multiplica las horas por 100 y le suma los minutos
 * @return int
 */
function horaInt($hora) {
  list($h, $m) = explode(":", $hora);
  return (intval($h) * 100) + intval($m);
}


/* #################### PEDIR DATOS #################### */

/**
 * Pido una hora que cumpla con el formato (hh:mm)
 * Retorno la hora
 * @return string
 */
function pedirHora($mensaje) {
  do {
    echo $mensaje;
    $hora = trim(fgets(STDIN));
  } while (!preg_match("/^(?:[01]\d|2[0-3]):[0-5]\d$/", $hora));
  return $hora;
}

/**
 * Pido un entero positivo
 * Retorno el numero
 * @return int
 */
function pedirEnteroPositivo($mensaje) {
  do {
    echo $mensaje;
    $num = trim(fgets(STDIN));
  } while (!preg_match("/^[1-9]\d*$/", $num));
  return $num;
}

/**
 * Pido una cadena de texto que coincida con musical, teatro o cine
 * Retorno el tipo
 * @return String
 */
function pedirTipo() {
  do {
    echo "\nTipo de funcion (musical, teatro o cine): ";
    $tipo = trim(fgets(STDIN));
  } while (!preg_match("/^\b(?:musical|teatro|cine)\b$/", $tipo));
  return $tipo;
}


/* #################### OTROS #################### */

/**
 * Pide al usuario el ID de un teatro 
 * Calcula segun el precio de las funciones, el costo total
 */
function calcularCostoTeatro() {
  $teatro = ABMTeatro::seleccionarTeatro();
  echo "\n El costo del teatro es: " . $teatro->darCosto();
}
