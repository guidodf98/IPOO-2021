<?php
include "10D.php";
main();



function main() {
  $nuevaCuenta = new Login("guido", "contrasena123", "frese inolvidable");
  /* Cambio contrasena */
  cambiarContrasena($nuevaCuenta);
}


function cambiarContrasena($nuevaCuenta) {
  $terminado = false;
  while (!$terminado) {
    echo "Ingrese su contrasena ";
    $contrasenaIngresada = trim(fgets(STDIN));
    echo "\n";
    if ($nuevaCuenta->coincide($contrasenaIngresada)) {
      echo "Nueva contrasena: ";
      while (!$nuevaCuenta->cambiarContrasena(trim(fgets(STDIN)))) {
      }
      echo "\n";
    } else {
      echo "Contraseña incorrecta\n";
      echo "Vuelva a intentarlo\n";
    }
  }
}
