<?php
include "Financiera.php";
include "Persona.php";
include "Prestamo.php";
include "Cuota.php";

// inciso 1)
$financiera = new Financiera("Money", "Av. Arg 1234");

// inciso 2)
$persona1 = new Persona("Pepe", "Florez", 40111222, "Bs As 12", "dir@mail.com", 299444567, 40000);
$persona2 = new Persona("Luis", "Suarez", 40222333, "Bs As 123", "dir@mail.com", 2994455, 4000);
$prestamo1 = new Prestamo(1, 111, 50000, 5, 0.1, $persona1);
$prestamo2 = new Prestamo(2, 222,  10000, 4, 0.1, $persona2);
$prestamo3 = new Prestamo(3, 333,  10000, 2, 0.1, $persona2);

// inciso 3)
$financiera->incorporarPrestamo($prestamo1);
$financiera->incorporarPrestamo($prestamo2);
$financiera->incorporarPrestamo($prestamo3);

// inciso 4)
echo $financiera;


// inciso 5)
$financiera->otorgarPrestamoSiCalifica();

// inciso 6)
echo $financiera;


// inciso 7)
$objCuota = $financiera->informarCuotaPagar(2);

// inciso 8)
if ($objCuota === null) {
  echo "\nNo hay cuotas por pagar.";
} else {
  echo "\nLa cuota por pagar es: " . $objCuota;
}

// inciso 9)
if ($objCuota === null || $objCuota->darMontoFinalCuota() === null) {
  echo "\nNo hay cuotas por pagar.";
} else {
  echo "\nEl monto final de la cuota es: " . $objCuota->darMontoFinalCuota();
}

// inciso 10)
if ($objCuota !== null) {
  $objCuota->setCancelada(true);
}

// inciso 11)
$objCuota2 = $financiera->informarCuotaPagar(1);

// inciso 12)
if ($objCuota2 === null) {
  echo "\nNo hay cuotas por pagar.";
} else {
  echo "\nLa cuota por pagar es: " . $objCuota2;
}
