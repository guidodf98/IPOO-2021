<?php

include "Edificio.php";
include "Inmueble.php";
include "Persona.php";

$p1 = new Persona("DNI", 27432561, "Carlos", "Martinez", 154321233);
$inc1 = new Persona("DNI", 12333456, "Pepe", "Suarez", 4456722);
$inc2 = new Persona("DNI", 12333422, "Pedro", "Suarez", 446678);
$i1 = new Inmueble("I1", 1, "local comercial", 50000, $inc1);
$i2 = new Inmueble("I2", 1, "local comercial", 50000, null);
$i3 = new Inmueble("I3", 2, "departamento", 35000, $inc2);
$i4 = new Inmueble("I4", 2, "departamento", 35000, null);
$i5 = new Inmueble("I5", 3, "departamento", 35000, null);
$e = new Edificio("Juan B. Justo 3456", [$i1, $i2, $i3, $i4, $i5], $p1);
$persona = new Persona("DNI", 28765436, "Mariela", "Suarez", 25543562);


/* echo $e; */
/* print_r($e->darInmueblesDisponiblesParaAlquilar("local comercial", 4000));*/

/*  
if ($e->registrarAlquilerInmueble($i3, $persona)) {
  echo "Se pudo registrar";
} else {
  echo "No se pudo registrar";
} */

/* if ($e->registrarAlquilerInmueble($i4, $persona)) {
  echo "Se pudo registrar";
} else {
  echo "No se pudo registrar";
} */

/* echo $e->calculaCostoEdificio(); */
