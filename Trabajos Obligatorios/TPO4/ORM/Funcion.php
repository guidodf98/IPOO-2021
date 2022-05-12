<?php
include_once "BaseDatos.php";

class Funcion {
  private $idFuncion;
  private $objTeatro;
  private $nombre;
  private $horaInicio;
  private $duracion;
  private $precio;
  private $mensajeoperacion;

  public function __construct() {
    $this->objTeatro = null;
    $this->nombre = '';
    $this->horaInicio = '';
    $this->duracion = '';
    $this->precio = 0;
  }

  public function cargar($datosFuncion) {
    $this->setObjTeatro($datosFuncion['objteatro']);
    $this->setNombre($datosFuncion['nombre']);
    $this->setHoraInicio($datosFuncion['horainicio']);
    $this->setDuracion($datosFuncion['duracion']);
    $this->setPrecio($datosFuncion['precio']);
  }

  // GETTERS
  public function getIdFuncion() {
    return $this->idFuncion;
  }

  /**
   * @return Teatro
   */
  public function getObjTeatro() {
    return $this->objTeatro;
  }

  public function getNombre() {
    return $this->nombre;
  }

  public function getHoraInicio() {
    return $this->horaInicio;
  }

  public function getDuracion() {
    return $this->duracion;
  }

  public function getPrecio() {
    return $this->precio;
  }

  public function getmensajeoperacion() {
    return $this->mensajeoperacion;
  }

  // SETTERS
  public function setIdFuncion($idFuncion) {
    $this->idFuncion = $idFuncion;
  }

  public function setObjTeatro($objTeatro) {
    $this->objTeatro = $objTeatro;
  }

  public function setNombre($nombre) {
    $this->nombre = $nombre;
  }

  public function setHoraInicio($horaInicio) {
    $this->horaInicio = $horaInicio;
  }

  public function setDuracion($duracion) {
    $this->duracion = $duracion;
  }

  public function setPrecio($precio) {
    $this->precio = $precio;
  }

  public function setmensajeoperacion($mensajeoperacion) {
    $this->mensajeoperacion = $mensajeoperacion;
  }


  public function __toString() {
    return
      "\nID Funcion: " . $this->getIdFuncion() .
      "\nNombre: " . $this->getNombre() .
      "\nHora Inicio: " . $this->getHoraInicio() .
      "\nDuracion: " . $this->getDuracion() .
      "\nPrecio: $" . $this->getPrecio();
  }

  public function darCosto() {
    return $this->getPrecio();
  }

  // BASE DE DATOS
  public function Buscar($idFuncion) {
    $db = new BaseDatos();
    $consultaFuncion = "SELECT * FROM funcion WHERE idfuncion=" . $idFuncion;
    $resp = false;
    if ($db->Iniciar()) {
      if ($db->Ejecutar($consultaFuncion)) {
        if ($tupla = $db->Registro()) {
          $this->setIdFuncion($idFuncion);
          $objTeatro = new Teatro();
          $objTeatro->Buscar($tupla['idteatro']);
          $this->setObjTeatro($objTeatro);
          $this->setNombre($tupla['nombre']);
          $this->setHoraInicio($tupla['horainicio']);
          $this->setDuracion($tupla['duracion']);
          $this->setPrecio($tupla['precio']);
          $resp = true;
        }
      } else {
        $this->setmensajeoperacion($db->getError());
      }
    } else {
      $this->setmensajeoperacion($db->getError());
    }
    return $resp;
  }

  public function listar($condicion = "") {
    $arregloFuncion = [];
    $db = new BaseDatos();
    $consultaFuncion = "SELECT * FROM funcion ";
    if ($condicion != "") {
      $consultaFuncion .= ' WHERE ' . $condicion;
    }
    $consultaFuncion .= " ORDER BY idfuncion ";
    if ($db->Iniciar()) {
      if ($db->Ejecutar($consultaFuncion)) {
        $arregloFuncion = array();
        while ($tupla = $db->Registro()) {
          $funcion = new Funcion();
          $funcion->buscar($tupla['idfuncion']);
          array_push($arregloFuncion, $funcion);
        }
      } else {
        $this->setmensajeoperacion($db->getError());
      }
    } else {
      $this->setmensajeoperacion($db->getError());
    }
    return $arregloFuncion;
  }

  public function insertar() {
    $db = new BaseDatos();
    $resp = false;
    $consultaInsertar = "INSERT INTO funcion(idteatro, nombre, horainicio, duracion, precio) VALUES (" . $this->getObjTeatro()->getIdTeatro() . ",'" . $this->getNombre() . "','" . $this->getHoraInicio() . "','" . $this->getDuracion() . "'," . $this->getPrecio() . ")";

    if ($db->Iniciar()) {
      if ($id = $db->devuelveIDInsercion($consultaInsertar)) {
        $this->setIdFuncion($id);
        $resp =  true;
      } else {
        $this->setmensajeoperacion($db->getError());
      }
    } else {
      $this->setmensajeoperacion($db->getError());
    }
    return $resp;
  }

  public function modificar() {
    $resp = false;
    $db = new BaseDatos();
    $consultaModifica = "UPDATE funcion SET nombre='" . $this->getNombre() . "',precio=" . $this->getPrecio() . ",horainicio='" . $this->getHoraInicio() . "',duracion='" . $this->getDuracion() . "' WHERE idfuncion =" . $this->getIdFuncion();
    if ($db->Iniciar()) {
      if ($db->Ejecutar($consultaModifica)) {
        $resp =  true;
      } else {
        $this->setmensajeoperacion($db->getError());
      }
    } else {
      $this->setmensajeoperacion($db->getError());
    }
    return $resp;
  }

  public function eliminar() {
    $db = new BaseDatos();
    $resp = false;
    if ($db->Iniciar()) {
      $consultaBorra = "DELETE FROM funcion WHERE idfuncion=" . $this->getIdFuncion();
      if ($db->Ejecutar($consultaBorra)) {
        $resp =  true;
      } else {
        $this->setmensajeoperacion($db->getError());
      }
    } else {
      $this->setmensajeoperacion($db->getError());
    }
    return $resp;
  }
}
