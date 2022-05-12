<?php

class CineAct extends Funcion {
  private $genero;
  private $paisOrigen;
  private $mensajeoperacion;

  public function __construct() {
    parent::__construct();
    $this->genero = '';
    $this->paisOrigen = '';
  }
  
  public function cargar($datosFuncion) {
    parent::cargar($datosFuncion);
    $this->genero = $datosFuncion['genero'];
    $this->paisOrigen = $datosFuncion['paisorigen'];
  }

  // GETTERS
  public function getGenero() {
    return $this->genero;
  }
  
  public function getPaisOrigen() {
    return $this->paisOrigen;
  }
  
  public function getmensajeoperacion() {
    return $this->mensajeoperacion;
  }

  // SETTERS
  public function setGenero($genero) {
    $this->genero = $genero;
  }
  
  public function setPaisOrigen($paisOrigen) {
    $this->paisOrigen = $paisOrigen;
  }
  
  public function setmensajeoperacion($mensajeoperacion) {
    $this->mensajeoperacion = $mensajeoperacion;
  }


  public function __toString() {
    return
      parent::__toString() .
      "\nGenero: " . $this->getGenero() .
      "\nPais de origen: " . $this->getPaisOrigen() .
      "\nTipo: Cine";
  }

  public function darCostos() {
    return (parent::darCosto() * 1.65);
  }


  // BASE DE DATOS
  public function Buscar($idFuncion) {
    $db = new BaseDatos();
    $consultaFuncion = "SELECT * FROM cineact WHERE idfuncion=" . $idFuncion;
    $resp = false;
    if ($db->Iniciar()) {
      if ($db->Ejecutar($consultaFuncion)) {
        if ($tupla = $db->Registro()) {
          parent::Buscar($idFuncion);
          $this->setGenero($tupla['genero']);
          $this->setPaisOrigen($tupla['paisorigen']);
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
    $consultaFuncion = "SELECT * FROM cineact INNER JOIN funcion ON funcion.idfuncion = cineact.idfuncion";
    if ($condicion != "") {
      $consultaFuncion = $consultaFuncion . ' WHERE ' . $condicion;
    }
    $consultaFuncion .= " ORDER BY cineact.idfuncion ";
    if ($db->Iniciar()) {
      if ($db->Ejecutar($consultaFuncion)) {
        $arregloFuncion = array();
        while ($tupla = $db->Registro()) {
          $funcion = new CineAct();
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
      $consultaInsertar = "INSERT INTO cineact(idfuncion, genero, paisorigen) VALUES (" . parent::getIdFuncion() . ",'" . $this->getGenero() . "','" . $this->getPaisOrigen() . "')";
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
      $consultaModifica = "UPDATE cineact SET genero='" . $this->getGenero() . "', paisorigen='" . $this->getPaisOrigen() . "' WHERE idfuncion=" . parent::getIdFuncion();
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
      $consultaBorra = "DELETE FROM cineact WHERE idfuncion=" . parent::getIdFuncion();
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
