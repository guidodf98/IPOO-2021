<?php

include "MinisterioDeporte.php";
include "Torneo.php";
include "TorneoNacional.php";
include "TorneoProvincial.php";
include "Partido.php";
include "Equipo.php";
include "Categoria.php";

$juvenil = new Categoria(1, "juvenil");
$primera = new Categoria(2, "primera");
$reserva = new Categoria(3, "reserva");


$objE1 = new Equipo("Equipo 1", "Franco P.", 15, $juvenil);
$objE2 = new Equipo("Equipo 2", "Pedro A.", 13, $primera);
$objE3 = new Equipo("Equipo 3", "Ezequiel G.", 15, $juvenil);
$objE4 = new Equipo("Equipo 4", "Rodrigo E.", 20, $primera);
$objE5 = new Equipo("Equipo 5", "Mauro Z.", 14, $primera);
$objE6 = new Equipo("Equipo 6", "Marcos D.", 13, $juvenil);
$objE7 = new Equipo("Equipo 7", "Jose L.", 13, $reserva);
$objE8 = new Equipo("Equipo 8", "Federico E.", 12, $reserva);
$objE9 = new Equipo("Equipo 9", "Pablo P.", 12, $juvenil);
$objE10 = new Equipo("Equipo 10", "Agusto A.", 14, $reserva);
$objE11 = new Equipo("Equipo 11", "Guido A.", 15, $reserva);
$objE12 = new Equipo("Equipo 12", "Ramiro H.", 14, $juvenil);

// 1)
$objPart1 = new Partido(1, "martes",  80, 120, $objE7, $objE8);
$objPart2 = new Partido(1, "jueves",  81, 110, $objE9, $objE10);
$objPart3 = new Partido(1, "viernes",  115, 85, $objE11, $objE12);
$objPart4 = new Partido(1, "lunes",  3, 2, $objE1, $objE2);
$objPart5 = new Partido(1, "martes",  0, 1, $objE3, $objE4);
$objPart6 = new Partido(1, "lunes",  2, 3, $objE5, $objE6);

// 2)
$ColPartidos_p2 = [$objPart1, $objPart2, $objPart3];
// 3)
$ColPartidos_p3 = [$objPart4, $objPart5, $objPart6];

// 4)
$ministerio = new MinisterioDeporte(2021);

// 5)

$ArrayAsociativo = array("monto" => 1200, "idTorneo" => 1, "localidad" => "Neuquen");
$torneo1 = $ministerio->registrarTorneo($ColPartidos_p2, "provincial", $ArrayAsociativo);
echo $ministerio->__toString();

// 6)
$ArrayAsociativo = array("monto" => 3500, "idTorneo" => 2, "localidad" => "Centenario");
$torneo2 = $ministerio->registrarTorneo($ColPartidos_p3, "nacional", $ArrayAsociativo);
echo $ministerio->__toString();

// 7)
echo $premioTorneo1 = $ministerio->otorgarPremioTorneo($torneo1->getIdTorneo());

// 8)
echo $premioTorneo2 = $ministerio->otorgarPremioTorneo($torneo2->getIdTorneo());


// 9)
echo $ministerio;
