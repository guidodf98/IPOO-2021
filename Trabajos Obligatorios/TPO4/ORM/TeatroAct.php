<?php

class TeatroAct extends Funcion {
  private $mensajeoperacion;


  public function __construct() {
    parent::__construct();
  }
  
  public function cargar($datosFuncion) {
    parent::cargar($datosFuncion);
  }

  // GETTERS
  public function getmensajeoperacion() {
    return $this->mensajeoperacion;
  }

  // SETTERS
  public function setmensajeoperacion($mensajeoperacion) {
    $this->mensajeoperacion = $mensajeoperacion;
  }


  public function __toString() {
    return
      parent::__toString() .
      "\nTipo: Teatro";
  }

  public function darCostos() {
    return (parent::darCosto() * 1.45);
  }


  // BASE DE DATOS
  public function Buscar($idFuncion) {
    $db = new BaseDatos();
    $consultaFuncion = "SELECT * FROM teatroact WHERE idfuncion=" . $idFuncion;
    $resp = false;
    if ($db->Iniciar()) {
      if ($db->Ejecutar($consultaFuncion)) {
        if ($tupla = $db->Registro()) {
          parent::Buscar($idFuncion);
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
    $consultaFuncion = "SELECT * FROM teatroact INNER JOIN funcion ON funcion.idfuncion = teatroact.idfuncion";
    if ($condicion != "") {
      $consultaFuncion = $consultaFuncion . ' WHERE ' . $condicion;
    }
    $consultaFuncion .= " ORDER BY teatroact.idfuncion ";
    if ($db->Iniciar()) {
      if ($db->Ejecutar($consultaFuncion)) {
        $arregloFuncion = array();
        while ($tupla = $db->Registro()) {
          $funcion = new TeatroAct();
          $funcion->Buscar($tupla['idfuncion']);
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
    if (parent::insertar()) {
      $consultaInsertar = "INSERT INTO teatroact(idfuncion) VALUES (" . parent::getIdFuncion() . ")";
      if ($db->Iniciar()) {
        if ($db->Ejecutar($consultaInsertar)) {
          $resp =  true;
        } else {
          $this->setmensajeoperacion($db->getError());
        }
      } else {
        $this->setmensajeoperacion($db->getError());
      }
    }
    return $resp;
  }

  public function modificar() {
    return parent::modificar();
  }

  public function eliminar() {
    $db = new BaseDatos();
    $resp = false;
    if ($db->Iniciar()) {
      $consultaBorra = "DELETE FROM teatroact WHERE idfuncion=" . parent::getIdFuncion();
      if ($db->Ejecutar($consultaBorra)) {
        if (parent::eliminar()) {
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
}
