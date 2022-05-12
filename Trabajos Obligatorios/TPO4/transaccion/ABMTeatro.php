<?php

class ABMTeatro {
  /**
   * Muestra el listado de teatros
   * Pide un ID y retorna el teatro correspondiente
   * @return Teatro
   */
  public static function seleccionarTeatro() {
    $teatro = new Teatro;

    $colTeatros = $teatro->listar();
    foreach ($colTeatros as $teatro) {
      echo $teatro;
    }

    do {
      $id = pedirEnteroPositivo("\nIngrese el ID del teatro: ");
    } while (!$teatro->buscar($id));

    return $teatro;
  }
  
  /**
   * Asigna todos los teatros a un array
   * Muestra cada elemento del array
   */
  public static function mostrarTeatros() {
    $teatro = new Teatro;
    $colTeatros = $teatro->listar();
    foreach ($colTeatros as $teatro) {
      echo $teatro;
    }
  }

  /**
   * Pide al usuario un ID de teatro
   * Elimina a las funciones del teatro y luego elimina el teatro
   */
  public static function eliminarTeatro() {
    $teatro = ABMTeatro::seleccionarTeatro();
    $colFunciones = $teatro->getColFunciones();
    foreach ($colFunciones as $funcion) {
      ABMFuncion::eliminarFuncion($funcion);
    }
    $teatro->eliminar();
  }

  /**
   * Pide al usuario un ID de teatro y una nueva direccion
   * Modifica la direccion del teatro con el ID ingresado
   */
  public static function modificarDireccionTeatro() {
    $teatro = ABMTeatro::seleccionarTeatro();
    echo "\nNueva dirección: ";
    $direccion = trim(fgets(STDIN));
    $teatro->setDireccion($direccion);
    $teatro->modificar();
  }

  /**
   * Pide al usuario un ID de teatro y un nuevo nombre
   * Modifica el nombre del teatro con el ID ingresado
   */
  public static function modificarNombreTeatro() {
    $teatro = ABMTeatro::seleccionarTeatro();
    echo "\nNuevo nombre: ";
    $nombre = trim(fgets(STDIN));
    $teatro->setNombre($nombre);
    $teatro->modificar();
  }

  /**
   * Pide al usuario los datos para crear el objeto teatro
   * Carga el teatro
   */
  public static function ingresarTeatro() {
    echo "Nombre del teatro: ";
    $datosTeatro['nombre'] = trim(fgets(STDIN));
    echo "Direccion: ";
    $datosTeatro['direccion'] = trim(fgets(STDIN));
    $teatro = new Teatro();
    $teatro->cargar($datosTeatro);
    if ($teatro->insertar()) {
      echo "Teatro insertado";
    } else {
      echo "Teatro no insertado";
    }
  }
}
