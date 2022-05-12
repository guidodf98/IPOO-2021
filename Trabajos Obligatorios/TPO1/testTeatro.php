<?php

include "teatro.php";

/* Un teatro se caracteriza por su nombre y su dirección y en él se realizan 4 funciones al día. Cada función tiene un nombre y un precio.

  Realice la implementación de la clase Teatro e implemente los métodos necesarios para cambiar el nombre del teatro, la dirección, el nombre de una función y el precio.

  Implementar las 4 funciones usando un array que almacena la información correspondiente a cada función. Cada función es un array asociativo con las claves “nombre” y “precio”.

  Implementar un script testTeatro.php que cree una instancia de la clase Teatro y presente un menú  que permita cargar la información del Teatro, modificar y ver sus datos 
 */

main();

/**
 * Pide una opcion a menu()
 * Segun esta opcion ejecuta una funcion
 */
function main() {
  $teatro = null;
  do {
    $opcion = menu();
    switch ($opcion) {
      case 1:
        $teatro = registroTeatro();
        break;
      case 2:
        if ($teatro !== null) {
          echo $teatro->__toString();
        } else {
          echo "Primero llene los datos del teatro\n";
        }
        break;
      case 3:
        cambiarNombre($teatro);
        break;
      case 4:
        cambiarDireccion($teatro);
        break;
      case 5:
        cambiarNombreFuncion($teatro);
        break;
      case 6:
        cambiarPrecioFuncion($teatro);
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
  echo "\n| 1) Llenar datos del teatro                  |";
  echo "\n| 2) Ver datos                                |";
  echo "\n| 3) Cambiar el nombre del teatro             |";
  echo "\n| 4) Cambiar la dirección del teatro          |";
  echo "\n| 5) Cambiar una el nombre de una función     |";
  echo "\n| 6) Cambiar una el precio de una función     |";
  echo "\n| 0) Salir                                    |";
  echo "\n ---------------------------------------------";
  echo "\nIngrese una opción: ";
  $opcion = trim(fgets(STDIN));
  echo "\n";
  return $opcion;
}

/**
 * Pide al usuario los datos para crear el objeto
 * Devuelve el objeto
 * @return Teatro
 */
function registroTeatro() {
  echo "Nombre del teatro: ";
  $nombre = trim(fgets(STDIN));
  echo "Direccion: ";
  $direccion = trim(fgets(STDIN));
  echo "\n--- Funciones ---\n";
  $funciones = datosFunciones();
  $teatro = new Teatro($nombre, $direccion, $funciones);
  return $teatro;
}

/**
 * Pide al usuario los datos de las funciones
 * Segun estos datos llena un arreglo y lo devuelve
 * @return array
 */
function datosFunciones() {
  for ($i = 0; $i < 4; $i++) {
    echo "\n-- Funcion " . ($i + 1) . " --\n";
    echo "Nombre: ";
    $nombreFun = trim(fgets(STDIN));
    echo "Precio: $";
    $precioFun = trim(fgets(STDIN));
    $funciones[$i]["nombre"] = $nombreFun;
    $funciones[$i]["precio"] = $precioFun;
  }
  return $funciones;
}

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
 * @param Teatrp
 */
function cambiarDireccion($teatro) {
  echo "\nIngrese la nueva dirección del teatro: ";
  $direccionT = trim(fgets(STDIN));
  $teatro->setDireccion($direccionT);
}

/**
 * Muestra al usuario los datos de su teatro
 * Le pide que ingrese el numero de la funcion que quiere cambiar
 * Pide el valor que quiere cambiar y lo envia a setNombreFuncion 
 * @param Teatro
 */
function cambiarNombreFuncion($teatro) {
  echo $teatro->__toString();
  $completado = false;
  do {
    echo "\nSeleccione el numero de funcion que desea cambiar: ";
    $num = trim(fgets(STDIN));
    if ($num > 0 && $num < 5) {
      echo "\nNuevo nombre: ";
      $nombreF = trim(fgets(STDIN));
      $teatro->setNombreFuncion($nombreF, $num);
      $completado = true;
    } else {
      echo "\nOpción incorrecta";
    }
  } while (!$completado);
}

/**
 * Muestra al usuario los datos de su teatro
 * Le pide que ingrese el numero de la funcion que quiere cambiar
 * Pide el valor que quiere cambiar y lo envia a setPrecioFuncion
 * @param Teatro
 */
function cambiarPrecioFuncion($teatro) {
  echo $teatro->__toString();
  $completado = false;
  do {
    echo "\nSeleccione el numero de funcion que desea cambiar: ";
    $num = trim(fgets(STDIN));
    if ($num > 0 && $num < 5) {
      echo "\nNuevo precio: ";
      $precioF = trim(fgets(STDIN));
      $teatro->setPrecioFuncion($precioF, $num);
      $completado = true;
    } else {
      echo "\nOpción incorrecta";
    }
  } while (!$completado);
}
