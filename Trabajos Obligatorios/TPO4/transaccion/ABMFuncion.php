<?php

class ABMFuncion {

  /**
   * Muestra el listado de funciones
   * Pide un ID
   * @return Object
   */
  public static function seleccionarFuncion($tipo = '') {
    switch ($tipo) {
      case 'cine':
        $funcion = new CineAct();
        break;
      case 'musical':
        $funcion = new MusicalAct();
        break;
      default:
        $funcion = new Funcion;
        break;
    }

    $colFunciones = $funcion->listar();
    foreach ($colFunciones as $funcionM) {
      echo "\n";
      echo $funcionM;
    }

    do {
      $id = pedirEnteroPositivo("\n\nIngrese el ID de la funcion: ");
    } while (!$funcion->buscar($id));

    return $funcion;
  }

  /**
   * Pide al usuario los datos para crear el objeto funcion
   * Pregunta el tipo de funcion que es
   * Segun el tipo pide mas datos
   * Carga la funcion
   */
  public static function ingresarFuncion() {
    echo "\n Selecione el ID del teatro donde ingresara las funciones: ";
    $teatroActual = ABMTeatro::seleccionarTeatro();
    $cant = pedirEnteroPositivo("\nCantidad de funciones: ");

    for ($i = 0; $i < $cant; $i++) {
      echo "\n-- Funcion " . ($i + 1) . " --\n";
      $tipo = pedirTipo();
      echo "Nombre: ";
      $nombre = trim(fgets(STDIN));
      do {
        $horaInicio = pedirHora("Horario de inicio (hh:mm): ");
        $duracion = pedirHora("Duracion (hh:mm): ");
        $horaFin = calcularHoraFin($horaInicio, $duracion);
      } while (!horarioLibre($horaInicio, $horaFin, $teatroActual));
      $precio = pedirEnteroPositivo("Precio: $");

      $datosFuncion['objteatro'] = $teatroActual;
      $datosFuncion['nombre'] = $nombre;
      $datosFuncion['horainicio'] = $horaInicio;
      $datosFuncion['duracion'] = $duracion;
      $datosFuncion['precio'] = $precio;

      switch ($tipo) {
        case 'teatro':
          $funcion = new TeatroAct();
          break;
        case 'cine':
          echo "Ingrese el genero: ";
          $datosFuncion['genero'] = trim(fgets(STDIN));
          echo "Ingrese el pais de origen: ";
          $datosFuncion['paisorigen'] = trim(fgets(STDIN));

          $funcion = new CineAct($datosFuncion);
          break;
        case 'musical':
          echo "Ingrese el director: ";
          $datosFuncion['director'] = trim(fgets(STDIN));
          $datosFuncion['cantpersonas'] = pedirEnteroPositivo("Ingrese la cantidad de personas en escenario: ");

          $funcion = new MusicalAct($datosFuncion);
          break;
        default:
          echo "Tipo de actividad incorrecta";
          break;
      }
      $funcion->cargar($datosFuncion);
      $funcion->insertar();
    }
  }

  /**
   * Pide al usuario un ID de funcion y un nuevo nombre
   * Modifica el nombre de la funcion con el ID ingresado
   */
  public static function modificarNombreFuncion() {
    $funcion = ABMFuncion::seleccionarFuncion();
    echo "\nNuevo nombre: ";
    $nombre = trim(fgets(STDIN));
    $funcion->setNombre($nombre);
    $funcion->modificar();
  }

  /**
   * Pide al usuario un ID de funcion y una nueva hora de inicio
   * Verifica que el horario de la funcion este disponible con la nueva duracion
   * Modifica la hora inicial de la funcion con el ID ingresado
   */
  public static function modificarHoraInicioFuncion() {
    $funcion = ABMFuncion::seleccionarFuncion();

    do {
      $horaInicio = pedirHora("Nuevo horario de inicio (hh:mm): ");
      $horaFin = calcularHoraFin($horaInicio, $funcion->getDuracion());
    } while (!horarioLibre($horaInicio, $horaFin, $funcion->getObjTeatro(), $funcion));

    $funcion->setHoraInicio($horaInicio);
    $funcion->modificar();
  }

  /**
   * Pide al usuario un ID de funcion y una nueva duracion
   * Verifica que el horario de la funcion este disponible con la nueva duracion
   * Modifica la duracion de la funcion con el ID ingresado
   */
  public static function modificarDuracionFuncion() {
    $funcion = ABMFuncion::seleccionarFuncion();

    do {
      $duracion = pedirHora("Nueva duracion (hh:mm): ");
      $horaFin = calcularHoraFin($funcion->getHoraInicio(), $duracion);
    } while (!horarioLibre($funcion->getHoraInicio(), $horaFin, $funcion->getObjTeatro(), $funcion));

    $funcion->setDuracion($duracion);
    $funcion->modificar();
  }

  /**
   * Pide al usuario un ID de funcion y un nuevo precio
   * Modifica el precio de la funcion con el ID ingresado
   */
  public static function modificarPrecioFuncion() {
    $funcion = ABMFuncion::seleccionarFuncion();
    $precio = pedirEnteroPositivo("\nNuevo precio: ");
    $funcion->setPrecio($precio);
    $funcion->modificar();
  }

  /**
   * Asigna todas las funciones a un array
   * Muestra cada elemento del array
   */
  public static function mostrarFunciones() {
    echo "\n Seleccione el teatro que desea ver sus funciones";
    $teatro = ABMTeatro::seleccionarTeatro();
    $colFunciones = $teatro->getColFunciones();
    foreach ($colFunciones as $funcion) {
      echo "\n";
      echo $funcion;
    }
  }

  /**
   * Elimina una funcion, que entra por parametro o la pide al usuario
   * @param Funcion
   */
  public static function eliminarFuncion($funcion = null) {
    if ($funcion == null) {
      $funcion = ABMFuncion::seleccionarFuncion();
    }
    if (ABMFuncion::eliminarFuncionHija($funcion->getIdFuncion())) {
      if ($funcion->eliminar()) {
        echo "\nLa funcion se elimino correctamente";
      } else {
        echo "\nNo se pudo eliminar la funcion";
      }
    }
  }

  /**
   * Busca el ID de funcion en la cada coleccion de funciones
   * Cuando encuentra la funcion, la elimina
   * @return boolean
   */
  public static function eliminarFuncionHija($id) {
    $exito = false;
    $funcionHija = new TeatroAct();
    if ($funcionHija->Buscar($id)) {
      $funcionHija->eliminar();
      $exito = true;
    }
    if (!$exito) {
      $funcionHija = new CineAct();
      if ($funcionHija->Buscar($id)) {
        $funcionHija->eliminar();
        $exito = true;
      }
    }
    if (!$exito) {
      $funcionHija = new MusicalAct();
      if ($funcionHija->Buscar($id)) {
        $funcionHija->eliminar();
        $exito = true;
      }
    }
    return $exito;
  }
}
