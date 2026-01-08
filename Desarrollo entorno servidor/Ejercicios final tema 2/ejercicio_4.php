<?php
function procesarTextoEpico($texto) {
    $texto = strtolower($texto);
    $texto = preg_replace('/[^\w\s]/', ' ', $texto);
    $palabras = preg_split('/\s+/', trim($texto));

    $totalPalabras = count($palabras);
    $frecuencia = array_count_values($palabras);

    $sumaLong = 0;
    foreach ($palabras as $palabra) {
        $sumaLong += strlen($palabra);
    }
    $longitudProm = $totalPalabras > 0 ? round($sumaLong / $totalPalabras, 2) : 0;

    return [
        'total_palabras' => $totalPalabras,
        'frecuencia' => $frecuencia,
        'longitud_promedio' => $longitudProm
    ];
}
$texto = readline("Introduce el texto: ");
$resultado = procesarTextoEpico($texto);

echo "Total de palabras: " . $resultado['total_palabras'] . "\n";
echo "Longitud promedio: " . $resultado['longitud_promedio'] . "\n";
echo "Frecuencia de palabras:\n";
foreach ($resultado['frecuencia'] as $palabra => $cantidad) {
    echo "$palabra: $cantidad\n";
}
?>
