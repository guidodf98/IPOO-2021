<?php
main();

/**
 * Repositorio: https://github.com/guidodf98/IPOO
 * Se analizan los datos de los vinos y se calcula
 */
function main(){
    $vinos = datosVinos();
    $vinosExtra = datosExtra($vinos);
    mostrarDatos($vinosExtra);
}


/**
 * Se cargan datos al arreglo $vinos
 * @return array
 */
function datosVinos()
{
    $vinos = array(
        "Malbec" => array(
            "variedad" => ["Secos", "Abocados", "Semi-Secos", "Semi-Dulces", "Dulces"],
            "cantidadBotellas" => [38, 15, 32, 20, 12],
            "anoProducion" => [2005, 2002, 1992, 2008, 2019],
            "precioUnidad" => [147, 175, 165, 170, 142]
        ),
        "Cabernet Sauvignon" => array(
            "variedad" => ["Secos", "Abocados", "Semi-Secos", "Semi-Dulces"],
            "cantidadBotellas" => [10, 39, 46, 27],
            "anoProducion" => [1998, 2005, 2006, 2010],
            "precioUnidad" => [112, 116, 87, 150]
        ),
        "Merlot" => array(
            "variedad" => ["Secos", "Semi-Dulces", "Dulces"],
            "cantidadBotellas" => [31, 50, 14],
            "anoProducion" => [2014, 2005, 2020],
            "precioUnidad" => [140, 173, 143]
        ),
    );
    return $vinos;
}

/**
 * Inicializo el arreglo con valores nulos
 * Recorro cada posicion del arreglo $vino
 * Se calcula la suma total de botellas y el precio promedio y se asigna a un nuevo arreglo
 * @param array 
 * @return array
 */
function datosExtra($vinos)
{
    $vinosExtra = array(
        "Malbec" => array("botellasTotal" => 0, "precioPromedio" => 0),
        "Cabernet Sauvignon" => array("botellasTotal" => 0, "precioPromedio" => 0),
        "Merlot" => array("botellasTotal" => 0, "precioPromedio" => 0)
    );
    
    foreach ($vinos as $nombreUva => $uva)
    {
        $vinosExtra[$nombreUva]["botellasTotal"] = array_sum($uva["cantidadBotellas"]);
        $vinosExtra[$nombreUva]["precioPromedio"] = array_sum($uva["precioUnidad"]) / count($uva["variedad"]);
    }
    return $vinosExtra;
}

/**
 * Muestra la informacion por pantalla sobre la cantidad y precio promedio de los vinos
 */
function mostrarDatos($vinosExtra)
{
    foreach ($vinosExtra as $nombreUva => $uva)
    {
        echo " ---------------------------------\n";
        echo "| ".$nombreUva . ":" . "\n";
        echo "| Cantidad total de botellas: " . $uva["botellasTotal"] . "\n";
        echo "| Precio promedio: $" . $uva["precioPromedio"]. "\n";
        echo " ---------------------------------\n\n";
    }
}
