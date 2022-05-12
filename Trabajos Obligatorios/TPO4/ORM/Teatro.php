<?php

class Teatro {
  private $idTeatro;
  private $nombre;
  private $direccion;
  private $colFunciones;
  private $mensajeoperacion;


  public function __construct() {
    $this->nombre = '';
    $this->direccion = '';
    $this->colFunciones = [];
  }

  public function cargar($datosTeatro) {
    $this->setNombre($datosTeatro['nombre']);
    $this->setDireccion($datosTeatro['direccion']);
  }

  // GETTERS
  public function getIdTeatro() {
    return $this->idTeatro;
  }

  public function getNombre() {
    return $this->nombre;
  }

  public function getDireccion() {
    return $this->direccion;
  }

  public function getColFunciones() {
    $colFunciones = $this->recuperarFunciones($this->getIdTeatro());
    $this->setColFunciones($colFunciones);
    return $this->colFunciones;
  }

  public function getmensajeoperacion() {
    return $this->mensajeoperacion;
  }

  // SETTERS
  public function setIdTeatro($idTeatro) {
    $this->idTeatro = $idTeatro;
  }

  public function setNombre($nombre) {
    $this->nombre = $nombre;
  }

  public function setDireccion($direccion) {
    $this->direccion = $direccion;
  }

  public function setColFunciones($colFunciones) {
    $this->colFunciones = $colFunciones;
  }

  public function setmensajeoperacion($mensajeoperacion) {
    $this->mensajeoperacion = $mensajeoperacion;
  }


  public function __toString() {
    return
      "\n\n---- Teatro " . $this->getNombre() . " ----" .
      "\nDireccion: " . $this->getDireccion() .
      "\nCantidad de funciones: " . count($this->getColFunciones()) .
      "\nID Teatro: " . $this->getIdTeatro() .
      "\n";
  }

  public function darCosto() {
    $costoTotal = 0;
    foreach ($this->getColFunciones() as $funcion) {
      $costoTotal += $funcion->darCostos();
    }
    return $costoTotal;
  }


  // BASE DE DATOS
  public function Buscar($idTeatro) {
    $base = new BaseDatos();
    $consultaTeatro = "SELECT * FROM teatro WHERE idteatro=" . $idTeatro;
    $resp = false;
    if ($base->Iniciar()) {
      if ($base->Ejecutar($consultaTeatro)) {
        if ($tupla = $base->Registro()) {
          $this->setIdTeatro($idTeatro);
          $this->setNombre($tupla['nombre']);
          $this->setDireccion($tupla['direccion']);

          // $colFuncionesTotal = $this->recuperarFunciones($idTeatro);
          // $this->setColFunciones($colFuncionesTotal);
          $resp = true;
        }
      } else {
        $this->setmensajeoperacion($base->getError());
      }
    } else {
      $this->setmensajeoperacion($base->getError());
    }
    return $resp;
  }

  public function listar($condicion = "") {
    $arregloTeatro = [];
    $db = new BaseDatos();
    $consultaTeatro = "SELECT * FROM teatro ";
    if ($condicion != "") {
      $consultaTeatro = $consultaTeatro . ' WHERE ' . $condicion;
    }
    $consultaTeatro .= " ORDER BY idteatro ";
    if ($db->Iniciar()) {
      if ($db->Ejecutar($consultaTeatro)) {
        $arregloTeatro = array();
        while ($tupla = $db->Registro()) {
          $tupla['colfunciones'] = $this->recuperarFunciones($tupla['idteatro']);
          $teatro = new Teatro();
          $teatro->buscar($tupla['idteatro']);
          array_push($arregloTeatro, $teatro);
        }
      } else {
        $this->setmensajeoperacion($db->getError());
      }
    } else {
      $this->setmensajeoperacion($db->getError());
    }
    return $arregloTeatro;
  }

  public function insertar() {
    $db = new BaseDatos();
    $resp = false;
    $consultaInsertar = "INSERT INTO teatro(nombre, direccion) 
				VALUES ('" . $this->getNombre() . "','" . $this->getDireccion() . "')";
    if ($db->Iniciar()) {
      if ($id = $db->devuelveIDInsercion($consultaInsertar)) {
        $this->setIdTeatro($id);
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
    $consultaModifica = "UPDATE teatro SET nombre='" . $this->getNombre() . "', direccion='" . $this->getDireccion() . "' WHERE idteatro =" . $this->getIdTeatro();
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
      $consultaBorra = "DELETE FROM teatro WHERE idteatro=" . $this->getIdTeatro();
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

  public function recuperarFunciones($idTeatro) {
    $colFuncionesTotal = [];
    $condicion = " idteatro = " . $idTeatro;

    $objFuncionCine = new CineAct();
    $objFuncionMusical = new MusicalAct();
    $objFuncionTeatro = new TeatroAct();

    $colFuncionCine = $objFuncionCine->listar($condicion);
    $colFuncionMusical = $objFuncionMusical->listar($condicion);
    $colFuncionTeatro = $objFuncionTeatro->listar($condicion);

    $colFuncionesTotal = array_merge($colFuncionCine, $colFuncionMusical, $colFuncionTeatro);
    return $colFuncionesTotal;
  }
}
