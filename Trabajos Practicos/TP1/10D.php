<?php
/*Implementar una clase Login que almacene el nombreUsuario, contraseña, frase que permite recordar la contraseña ingresada y las ultimas 4 contraseñas utilizadas. 

Implementar un método que permita validar una contraseña con la almacenada





y un método para cambiar la contraseña actual por otra nueva,el sistema deja cambiar la contraseña siempre y cuando esta no haya sido usada recientemente (es decir no se encuentra dentro de las cuatro almacenadas). 



Implementar el método recordar que dado el usuario, muestra la frase que permite recordar su contrasena.*/


class Login {
  private $nombreUsuario;
  private $contrasena;
  private $frase;
  private $ultimasContrasenas;

  public function __construct($usuario, $contrasena, $frase) {
    $this->nombreUsuario = $usuario;
    $this->contrasena = $contrasena;
    $this->frase = $frase;
    $this->ultimasContrasenas = [$contrasena];
  }

  public function coincide($contrasenaIngresada) {
    if ($contrasenaIngresada === $this->contrasena) {
      return true;
    } else {
      return false;
    }
  }

  public function cambiarContrasena($nueva) {
    if ($this->nuevaValida($nueva)) {
      $this->setContrasena($nueva);
    } else {
      return false;
    }
  }

  private function nuevaValida($contrasena) {
    $ultimas = $this->ultimasContrasenas;
    foreach ($ultimas as $cAnterior) {
      if ($contrasena === $cAnterior) {
        return false;
      }
    }
    if (count($ultimas) < 4) {
      for ($i = 0; $i < 4; $i++) {
        if ($ultimas[$i] == null) {
          $ultimas[$i] = $contrasena;
        }
      }
    } else {
      array_splice($cAnterior, 0, 0, $contrasena);
      $cAnterior[4] = null;
    }
    return true;
  }



  public function getNombreUsuario() {
    return $this->nombreUsuario;
  }
  public function getContrasena() {
    return $this->contrasena;
  }
  public function getFrase() {
    return $this->frase;
  }
  public function getUltimasContrasenas() {
    return $this->ultimasContrasenas;
  }

  public function setNombreUsuario($valor) {
    $this->nombreUsuario = $valor;
  }
  public function setContrasena($valor) {
    $this->contrasena = $valor;
  }
  public function setFrase($valor) {
    $this->frase = $valor;
  }
  public function setUltimasContrasenas($valor) {
    $this->ultimasContrasenas = $valor;
  }
}
