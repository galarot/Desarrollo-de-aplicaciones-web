<?php
$articulos = [
    ["nombre" => "Tablet", "precio" => 800],
    ["nombre" => "Auriculares", "precio" => 50],
    ["nombre" => "Impresora", "precio" => 250],
    ["nombre" => "Cargador", "precio" => 20]
];

function filtrarCarillos($items) {
    return array_filter($items, function($item) {
        return $item["precio"] > 100;
    });
}
function ordenarPorCoste($items) {
    usort($items, function($x, $y) {
        return $x["precio"] <=> $y["precio"];
    });
    return $items;
}
function aplicarRebaja($items) {
    return array_map(function($item) {
        $item["precio"] = $item["precio"] * 0.9;
        return $item;
    }, $items);
}

echo "Productos: ";
print_r($articulos);

echo "Los mas caros: ";
print_r(filtrarCarillos($articulos));

echo "Ordenados por precio: ";
print_r(ordenarPorCoste($articulos));

echo "Rebajas aplicadas: ";
print_r(aplicarRebaja($articulos));
?>