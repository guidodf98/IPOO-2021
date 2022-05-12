<?php

class MusicalAct extends Funcion {
  private $director;
  private $cantPersonas;
  private $mensajeoperacion;


  public function __construct() {
    parent::__construct();
    $this->director = '';
    $this->cantPersonas = '';
  }

  public function cargar($datosFuncion) {
    parent::cargar($datosFuncion);
    $this->director = $datosFuncion['director'];
    $this->cantPersonas = $datosFuncion['cantpersonas'];
  }

  // GETTERS
  public function getDirector() {
    return $this->director;
  }
  
  public function getCantPersonas() {
    return $this->cantPersonas;
  }
  
  public function getmensajeoperacion() {
    return $this->mensajeoperacion;
  }

  // SETTERS
  public function setDirector($director) {
    $this->director = $director;
  }

  public function setCantPersonas($cantPersonas) {
    $this->cantPersonas = $cantPersonas;
  }

  public function setmensajeoperacion($mensajeoperacion) {
    $this->mensajeoperacion = $mensajeoperacion;
  }


  public function __toString() {
    return
      parent::__toString() .
      "\nDirector: " . $this->getDirector() .
      "\nCantidad de personas: " . $this->getCantPersonas() .
      "\nTipo: Musical";
  }

  public function darCostos() {
    return (parent::darCosto() * 1.12);
  }


  // BASE DE DATOS
  public function Buscar($idFuncion) {
    $db = new BaseDatos();
    $consultaFuncion = "SELECT * FROM musicalact WHERE idfuncion=" . $idFuncion;
    $resp = false;
    if ($db->Iniciar()) {
      if ($db->Ejecutar($consultaFuncion)) {
        if ($tupla = $db->Registro()) {
          parent::Buscar($idFuncion);
          $this->setDirector($tupla['director']);
          $this->setCantPersonas($tupla['cantpersonas']);
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
    $consultaFuncion = "SELECT * FROM musicalact INNER JOIN funcion ON funcion.idfuncion = musicalact.idfuncion";
    if ($condicion != "") {
      $consultaFuncion = $consultaFuncion . ' WHERE ' . $condicion;
    }
    $consultaFuncion .= " ORDER BY musicalact.idfuncion ";
    if ($db->Iniciar()) {
      if ($db->Ejecutar($consultaFuncion)) {
        $arregloFuncion = array();
        while ($tupla = $db->Registro()) {
          $funcion = new MusicalAct();
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
      $consultaInsertar = "INSERT INTO musicalact(idfuncion, director, cantpersonas) VALUES (" . parent::getIdFuncion() . ",'" . $this->getDirector() . "'," . $this->getCantPersonas() . ")";
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
    $resp = false;
    $db = new BaseDatos();
    if (parent::modificar()) {
      $consultaModifica = "UPDATE musicalact SET director='" . $this->getDirector() . "', cantpersonas='" . $this->getCantPersonas() . "' WHERE idfuncion=" . parent::getIdFuncion();
      if ($db->Iniciar()) {
        if ($db->Ejecutar($consultaModifica)) {
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

  public function eliminar() {
    $db = new BaseDatos();
    $resp = false;
    if ($db->Iniciar()) {
      $consultaBorra = "DELETE FROM musicalact WHERE idfuncion=" . parent::getIdFuncion();
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
