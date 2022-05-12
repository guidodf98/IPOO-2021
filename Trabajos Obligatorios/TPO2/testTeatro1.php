<?php

include "Teatro1.php";
include "Funciones1.php";

main();

/**
 * Se inicializa el teatro
 * Pide una opcion a menu()
 * Segun esta opcion ejecuta una funcion
 */
function main() {
  $teatro = registroTeatro();
  $horariosEstablecidos = null;
  do {
    $opcion = menu();
    switch ($opcion) {
      case 1:
        $teatro = registroFunciones($teatro, $horariosEstablecidos);
        break;
      case 2:
        echo $teatro->__toString();
        break;
      case 3:
        cambiarNombre($teatro);
        break;
      case 4:
        cambiarDireccion($teatro);
        break;
      case 5:
        if ($teatro->getFunciones() == null) {
          echo "\nPrimero cargue una funcion";
        } else {
          cambiarNombreFuncion($teatro);
        }
        break;
      case 6:
        if ($teatro->getFunciones() == null) {
          echo "\nPrimero cargue una funcion";
        } else {
          cambiarPrecioFuncion($teatro);
        }
        break;
      default:
        "\nOpcion incorrecta\n";
    }
  } while ($opcion != 0);
}

/**
 * Le muestra al usuario las opciones disponibles
 * Lee y devuelve la opcion elegida
 * @return int
 */
function menu() {
  echo "\n ------------------- MENU --------------------";
  echo "\n| 1) Cargar nuevas funciones                  |";
  echo "\n| 2) Ver datos                                |";
  echo "\n| 3) Cambiar el nombre del teatro             |";
  echo "\n| 4) Cambiar la dirección del teatro          |";
  echo "\n| 5) Cambiar el nombre de una funcion         |";
  echo "\n| 6) Cambiar el precio de una funcion         |";
  echo "\n| 0) Salir                                    |";
  echo "\n ---------------------------------------------";
  echo "\nIngrese una opción: ";
  $opcion = trim(fgets(STDIN));
  echo "\n";
  return $opcion;
}

/**
 * Pide al usuario los datos para crear el objeto teatro
 * Devuelve el objeto
 * @return Teatro
 */
function registroTeatro() {
  echo "Nombre del teatro: ";
  $nombre = trim(fgets(STDIN));
  echo "Direccion: ";
  $direccion = trim(fgets(STDIN));
  $teatro = new Teatro($nombre, $direccion, null);
  return $teatro;
}

/**
 * Pide al usuario los datos para crear el arreglo de objetos de funciones
 * Asigna el arreglo a teatro y lo devuelve
 * @param Teatro|array
 * @return Teatro
 */
function registroFunciones($teatro, $horariosEstablecidos) {
  echo "\n--- Funciones ---\n";
  $funciones = pedirDatosFunciones($horariosEstablecidos);
  $teatro->setFunciones($funciones);
  return $teatro;
}

/* ########## Cambiar datos ########## */

/**
 * Cambia el nombre del teatro
 * @param Teatro
 */
function cambiarNombre($teatro) {
  echo "\nIngrese el nuevo nombre del teatro: ";
  $nombreT = trim(fgets(STDIN));
  $teatro->setNombre($nombreT);
}

/**
 * Cambia la direccion del teatro
 * @param Teatro
 */
function cambiarDireccion($teatro) {
  echo "\nIngrese la nueva dirección del teatro: ";
  $direccionT = trim(fgets(STDIN));
  $teatro->setDireccion($direccionT);
}

/**
 * Muestra las funciones disponibles
 * Pide al usuario el numero de una funcion para cambiar
 * Cambia el nombre de una funcion
 * @param Teatro
 */
function cambiarNombreFuncion($teatro) {
  echo $teatro->__toString();
  $completado = false;
  do {
    echo "\nSeleccione el numero de funcion que desea cambiar: ";
    $num = trim(fgets(STDIN));
    if ($num > 0 && $num <= count($teatro->getFunciones())) {
      echo "\nNuevo nombre: ";
      $nombre = trim(fgets(STDIN));
      $teatro->setNombreFuncion($nombre, $num);
      $completado = true;
    } else {
      echo "\nOpción incorrecta";
    }
  } while (!$completado);
}

/**
 * Muestra las funciones disponibles
 * Pide al usuario el numero de una funcion para cambiar
 * Cambia el precio de una funcion
 * @param Teatro
 */
function cambiarPrecioFuncion($teatro) {
  echo $teatro->__toString();
  $completado = false;
  do {
    echo "\nSeleccione el numero de funcion que desea cambiar: ";
    $num = trim(fgets(STDIN));
    if ($num > 0 && $num <= count($teatro->getFunciones())) {
      echo "\nNuevo precio: ";
      $precio = trim(fgets(STDIN));
      $teatro->setPrecioFuncion($precio, $num);
      $completado = true;
    } else {
      echo "\nOpción incorrecta";
    }
  } while (!$completado);
}


/* ########## Pedir datos ########## */

/**
 * Pide cantidad de funciones que se desea agregar
 * Se piden los datos de cada funcion
 * Se crea un objeto Funciones y se asigna a una posicion de un arreglo
 * @param array
 * @return array
 */
function pedirDatosFunciones($horariosEstablecidos) {
  echo "\nCantidad de funciones: ";
  $cant = pedirNumeroPositivo();
  for ($i = 0; $i < $cant; $i++) {
    echo "\n-- Funcion " . ($i + 1) . " --\n";
    echo "Nombre: ";
    $nombre = trim(fgets(STDIN));
    do {
      echo "\nRecuerde que el fortamo de la hora es (hh/mm)\n";
      echo "\n- Horario de inicio -";
      $horaInicio = pedirHoraCompleta();
      echo "\n- Duracion -";
      $duracion = pedirHoraCompleta();
      $horaFin = calcularHoraFin($horaInicio, $duracion);
      $horariosEstablecidos = horarioLibre($horariosEstablecidos, $horaInicio, $horaFin, $i);
    } while ((count($horariosEstablecidos) - 1) != $i);
    echo "Precio: $";
    $precio = pedirNumeroPositivo();
    $funciones[$i] = new Funciones($nombre, $horaInicio, $duracion, $precio);
  }
  return $funciones;
}


/**
 * Se pide la hora y minutos
 * Se lo asigna a un arreglo y devuelve
 * @return array
 */
function pedirHoraCompleta() {
  echo "\nHora: ";
  $hora = pedirHora();
  echo "Minuto: ";
  $minutos = pedirMinuto();
  $horaCompleta = array(
    "hora" => $hora,
    "minuto" => $minutos
  );
  return $horaCompleta;
}

/**
 * Pide al usuario un numero entre 0 y 23
 * @return int
 */
function pedirHora() {
  $num = trim(fgets(STDIN));
  while (!(is_numeric($num)) || $num < 0 || $num > 23) {
    echo "\nHora incorrecta";
    echo "\nVuelva a ingresar una hora: ";
    $num = trim(fgets(STDIN));
  }
  return $num;
}

/**
 * Pide al usuario un numero entre 0 y 59
 * @return int
 */
function pedirMinuto() {
  $num = trim(fgets(STDIN));
  while (!(is_numeric($num)) || $num < 0 || $num > 59) {
    echo "\nMinuto incorrecto";
    echo "\nVuelva a ingresar un minuto: ";
    $num = trim(fgets(STDIN));
  }
  return $num;
}

/**
 * Pide al usuario un numero positivo
 * @return int
 */
function pedirNumeroPositivo() {
  $num = trim(fgets(STDIN));
  while (!(is_numeric($num)) || $num < 0) {
    echo "\nNúmero incorrecto";
    echo "\nVuelva a ingresar un número: ";
    $num = trim(fgets(STDIN));
  }
  return $num;
}

/* ########## Otros ########## */

/**
 * Se calcula el horario en que termina una funcion
 * @param array|array
 * @return array
 */
function calcularHoraFin($horaInicio, $duracion) {
  $minutoAdd = ($horaInicio["minuto"] + $duracion["minuto"]) / 60;
  $hora = ($horaInicio["hora"] + $duracion["hora"] + $minutoAdd) % 24;
  $minuto = ($horaInicio["minuto"] + $duracion["minuto"]) % 60;
  return array("hora" => $hora, "minuto" => $minuto);
}

/**
 * Se pasan los minutos a un int en el que las horas se multiplican por 100 y se suman los minutos
 * Se verifica que el horario ingresado este en un horario disponible
 * Si esta disponible se asigna a un arreglo que tiene los horarios establecidos de las funciones
 * @param array|array|array|int
 * @return array
 */
function horarioLibre($horariosEstablecidos, $horaInicio, $horaFin, $pos) {
  $nuevaHoraInicio = ($horaInicio["hora"] * 100) + $horaInicio["minuto"];
  $nuevaHoraFin = ($horaFin["hora"] * 100) + $horaFin["minuto"];
  $disponible = true;
  if ($horariosEstablecidos != null) {
    $i = 0;
    while ($disponible && $i < count($horariosEstablecidos)) {
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
  if ($disponible) {
    $horariosEstablecidos[$pos] = array("inicio" => $nuevaHoraInicio, "fin" => $nuevaHoraFin);
  } else {
    echo "\nHorario no disponible, intente de nuevo";
  }
  return $horariosEstablecidos;
}
