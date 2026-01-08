<?php
function sumar($num1, $num2){
    return $num1 + $num2;
}
function restar($num1, $num2){
    return $num1 - $num2;
}
function multiplicar($num1, $num2){
    return $num1 * $num2;
}
function dividir($num1, $num2){
    return $num1 / $num2;
}

function calculosa($num1, $num2, $op){
    return match ($op) {
        '+' => sumar($num1, $num2),
        '-' => restar($num1, $num2),
        '*' => multiplicar($num1, $num2),
        '/' => dividir($num1, $num2),
        default => "Error, bobo"
    };
}

$num1 = readline("Primer numero: ");
$op = readline("Operacion: ");
$num2 = readline("Segundo numero: ");

$resultado = calculosa($num1, $num2, $op);

echo ("Resultado: $resultado");
?>
