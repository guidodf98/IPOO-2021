<?php

include "Cliente.php";
include "Producto.php";
include "Venta.php";
include "Empresa.php";

$objCliente1 = new Cliente("Jose", "San Martin", false, "DNI", 20350413);
$objCliente2 = new Cliente("Manuel", "Belgrano", false, "DNI", 21623313);
$obProducto1 = new Producto2(11, 50000, 2018, "Cemento loma Negra", 70, true);
$obProducto2 = new Producto2(12, 10000, 2019, "Hierro del 12", 60, true);
$obProducto3 = new Producto2(13, 10000, 2020, "Cal Santa Clara", 50, false);
$empresa = new Empresa("Cosmos", "Av Argentina 123", [$objCliente1, $objCliente2], [$obProducto1, $obProducto2, $obProducto3], []);

echo $empresa->registrarVenta([11, 12, 13], $objCliente2);
echo $empresa->registrarVenta([0], $objCliente2);
echo $empresa->registrarVenta([2], $objCliente2);
$empresa->retornarVentasXCliente($objCliente1->getTipoDocumento(), $objCliente1->getNumeroDocumento());
$empresa->retornarVentasXCliente($objCliente2->getTipoDocumento(), $objCliente2->getNumeroDocumento());
echo $empresa;


































/* $c = new Cliente("Pepe", "Mujica", false, "DNI", 40590329230);
$p1 = new Producto(111, 222, 1910, "aaa", 13, true);
$p2 = new Producto(222, 222, 1920, "sss", 23, true);
$p3 = new Producto(333, 222, 1930, "ddd", 33, true);
$p4 = new Producto(444, 222, 1940, "fff", 43, true);
$v = new Venta(111, 222, $c);
$v->incorporarProducto($p1);
$e = new Empresa("aaa", "bbb", [], [$p1, $p2, $p3, $p4], []);


$col = [111, 333];
$obj = $c;
$e->registrarVenta($col, $obj);



echo $e;
 */
/* $test = $e->retornarProducto(1211);
if ($test !== null) {
  echo $test;
} else {
  echo "\nNo encontrado";
} */
