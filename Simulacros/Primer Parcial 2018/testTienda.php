<?php
include "Venta.php";
include "Item.php";
include "Producto.php";
include "Tienda.php";

$p1 = new Producto(0001, "jogging", "mountain", "gris", "X", "pantalon deportivo", 3);
$p2 = new Producto(0002, "remera", "reef", "celeste", "L", "remera termica", 7);
$p3 = new Producto(0003, "campera", "adidas", "roja", "XL", "campera rompe viento", 2);
$p4 = new Producto(0004, "gorro", "nike", "negro", "S", "gorra con visera", 6);

$colProd = [$p1,$p2,$p3,$p4];

$tienda = new Tienda("Ferraciolli", "Av Argentina 2000", 299585426, $colProd, []);
//no sigo el test porque el enunciado esta mal hecho.

