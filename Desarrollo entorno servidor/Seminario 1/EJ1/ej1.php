<?php
// Ejercicio 1. Número máximo de un array
// Crea una función que obtenga el número máximo de un array de números.
function arraymax($numeros){
    if (empty($numeros)){
        return null;
    }
    $max = $numeros[0];
    foreach ($numeros as $numero){
        if ($numero > $max){
            $max = $numero;
        }
    }
    return $max;
}
$numeros = [1,2,3,4,5,6,7,23,9];
echo "Numeros max: ".arraymax($numeros) ."\n";

// Ejercicio 2. Sumatoria de un array
// Crea una función que obtenga la sumatoria de un array de números.
function sumArray($nums){
    if (empty($nums)){
        return null;
    }
    $suma = 0;
    foreach ($nums as $num) {
        $suma += $num;
    }
    return $suma;
}
$arrayNums = [1,2,3,4,5];
echo "Numeros suma: ".sumArray($arrayNums) ."\n";

// Ejercicio 3. Conversión de millas a kilómetros
// Crea una función que dada una distancia en millas calcule su correspondiente en kilómetros.
// Nota: 1 milla = 1.60934 kilómetros
function millas($distancia){
    $milla = 2;
    $distancia = 1.60934;
    $kilometroscount = $milla * $distancia;
    return $kilometroscount;
}
$kilometros = $kilometroscount = 0;
echo "Resultado: ".millas($kilometros) ."\n";

// Ejercicio 4. Palíndromo
// Crea una función que determine si una cadena de texto es un palíndromo.
function palindromo($texto) {
    $texto = strtolower(str_replace(' ', '', $texto));
    return $texto == strrev($texto);
}
$consolatext = readline("Introduce la palabra: \n");
if (palindromo($consolatext)) {
    echo "Palindromo \n";
} else {
    echo "No palindromo \n";
}

// Ejercicio 5. Contar ocurrencias de una letra
// Crea una función que cuente cuántas veces aparece una letra en un texto.
function apletra($texto, $letra){
    $texto = strtolower($texto);
    $letra = strtolower($letra);
    $conteo = substr_count($texto, $letra);
    return $conteo;
}
$texto = "Tengo un sueño que flipas";
$letra = "e";
echo "La letra insertada se repite ". apletra($texto, $letra). " veces \n";

// Ejercicio 6. Contar ocurrencias de una subcadena
// Crea una función que cuente cuántas veces aparece una subcadena en un texto.
function subcadena($texto, $subcadena){
    $texto = strtolower($texto);
    $letra = strtolower($subcadena);
    $conteo = substr_count($texto, $subcadena);
    return $conteo;
}
$texto = "Tengo un sueño que flipas, un dia de estos me quedo dormio y to \n";
$subcadena = "un \n";
echo "La subcadena se repite ". subcadena($texto, $subcadena). " veces \n";

// Ejercicio 7. Capitalizar palabras
// Crea una función que ponga en mayúscula la primera letra de cada palabra de un texto.
function mayusculas($texto){
    return ucwords($texto);
}
$texto = "hola mundo";
echo mayusculas($texto) ."\n";

// Ejercicio 8. Suma de dígitos
// Crea una función que sume los dígitos de un número.
function sumadigitos($numero){
    return array_sum(str_split($numero));
}
echo sumadigitos(456) ."\n";

// Ejercicio 9. Máximo común divisor (MCD)
// Crea una función que calcule el máximo común divisor de dos números naturales.
function mcd($numero1, $numero2){
    while ($numero2 != 0){
        $temp = $numero2;
        $numero2 = $numero1 % $numero2;
        $numero1 = $temp;
    }
    return $numero1;
}
echo mcd(20, 33) ."\n";

// Ejercicio 10. Fibonacci
// Crea una función que calcule el término n-ésimo de la sucesión de Fibonacci.
function fibonacci($numero) {
    if ($numero == 0) return 0;
    if ($numero == 1) return 1;
    return fibonacci($numero - 1) + fibonacci($numero - 2);
}
echo fibonacci(8) ."\n";

// Ejercicio 11. Números primos relativos
// Crea una función que determine si dos números son primos relativos.
function primosRelativos($a, $b){
    while ($b != 0){
        $temp = $b;
        $b = $a % $b;
        $a = $temp;
    }
    return $a == 1;
}
$num1 = 22;
$num2 = 33;
if (primosRelativos($num1, $num2)) {
    echo "$num1 y $num2 si son primos \n";
} else {
    echo "$num1 y $num2 no son primos \n";
}

// Ejercicio 12. Número capicúa
// Crea una función que determine si un número dado es capicúa.
function capicua($numero){
    $texto = strval($numero);
    $revertir = strrev($texto);
    return $texto === $revertir;
}
$num = 1221;
if (capicua($num)) {
    echo "$num si es capicua, epico";
} else {
    echo "$num no es capicua \n";
}

// Ejercicio 13. Generador de tabla HTML
// Crea una función que dada una cadena de texto con formato Emmet devuelva su correspondiente etiqueta HTML.
function emmetFunc($emmet) {
    list($tag, $class) = explode('.', $emmet);
    return "<$tag class=\"$class\"></$tag>";
}
echo emmetFunc("div.oferta")."\n";

// Ejercicio 14. Mosaico numérico
// Crea una función que dado un número n imprima el siguiente 'mosaico'.
function mosaicoNumerico($num) {
    for ($i = 1; $i <= $num; $i++) {
        echo str_repeat($i, $i) . "\n";
    }
}
mosaicoNumerico(6);

// Ejercicio 15. Comparar arrays elemento a elemento
// Crear una función que reciba dos arrays y devuelva un array de booleanos indicando si los elementos son iguales.
function compararArray($a, $b) {
   $resultados = [];
   for ($i = 0; $i < count($a); $i++) {
       $resultados[] = $a[$i] === $b[$i];
   }
   return $resultados;
}
print_r(compararArray([1, 2, 3], [1, 2, 4]));

// Ejercicio 16. Producto de elementos de un array
// Crea una función que calcule el producto de todos los elementos de un array.
function productoArray($numeros) {
   $resultados = 1;
   foreach ($numeros as $num) {
       $resultados *= $num;
   }
   return $resultados;
}
echo "producto: " .productoArray([2, 3, 4]) . "\n";

// Ejercicio 17. Filtrar números pares
// Crea una función que dada un array devuelva un nuevo array solo con los números pares.
function arrayPares($numeros) {
   $pares = [];
   foreach ($numeros as $num) {
       if ($num % 2 == 0) {
           $pares[] = $num;
       }
   }
   return $pares;
}
print_r(arrayPares([1, 2, 3, 4, 5, 6]));

// Ejercicio 18. Número primo
// Crea una función que determine si un número es primo.
function esPrimo($numeros) {
   if ($numeros <= 1) return false;
   for ($i = 2; $i < $numeros; $i++) {
       if ($numeros % $i == 0) return false;
   }
   return true;
}
$num = 7;
if (esPrimo($num)) {
   echo "$num es primo\n";
} else {
   echo "$num no es primo \n";
}

// Ejercicio 19. Eliminar vocales
// Crea una función que elimine todas las vocales de una cadena.
function eliminarVocales($texto) {
   return str_replace(['a','e','i','o','u','A','E','I','O','U'], '', $texto);
}
echo eliminarVocales("Estoy de los juegos gachas hasta aquí, fucking ludopatía \n");

// Ejercicio 20. Factorial
// Crea una función que calcule el factorial de un número.
function factorial($num) {
   $resultados = 1;
   for ($i = 1; $i <= $num; $i++) {
       $resultados *= $i;
   }
   return $resultados;
}
echo "El factorial es: ".factorial(5). "\n";

// Ejercicio 21. Invertir cadena
// Crea una función que invierta una cadena de texto.
function invertirCadena($texto) {
   return strrev($texto);
}
echo invertirCadena("webos con aceite");

// Ejercicio 22. Número perfecto
// Crea una función que devuelva true si un número es perfecto.
function numPerfecto($numeros) {
   if ($numeros <= 1) return false;
   $suma = 0;
   for ($i = 1; $i <= $numeros / 2; $i++) {
       if ($numeros % $i == 0) {
           $suma += $i;
       }
   }
   return $suma == $numeros;
}
$num = 6;
if (numPerfecto($num)) {
   echo "$num es un número perfecto \n";
} else {
   echo "$num no es un número perfecto \n";
}

// Ejercicio 23. Número Armstrong
// Crea una función que determine si un número es un número Armstrong.
function numArmstrong($numeros) {
   $digitos = str_split($numeros);
   $numDigitos = count($digitos);
   $suma = 0;
   foreach ($digitos as $d) {
       $suma += pow($d, $numDigitos);
   }
   return $suma == $numeros;
}
$num = 153;
if (numArmstrong($num)) {
   echo "$num es un número Armstrong \n";
} else {
   echo "$num no es un número Armstrong \n";
}

// Ejercicio 24. Calculadora de descuentos con constantes
// Crea un programa que calcule el precio final aplicando descuentos según el tipo de cliente.
define("descuento_estudiante", 0.15);
define("descuento_jubilado", 0.20);
define("descuento_vip", 0.25);
function descuentosCalcu($precio, $tipoDeCliente) {
   $descuentos = 0;
   if ($tipoDeCliente == "estudiante") {
       $descuentos = descuento_estudiante;
   } elseif ($tipoDeCliente == "jubilado") {
       $descuentos = descuento_jubilado;
   } elseif ($tipoDeCliente == "vip") {
       $descuentos = descuento_vip;
   }
   $precioFinal = $precio - ($precio * $descuentos);
   return $precioFinal;
}
echo "Precio : " . descuentosCalcu(100, "estudiante") ."\n";

// Ejercicio 25. Clasificador de notas con match
// Crea una función que clasifique una nota numérica en su calificación textual.
function notasMatch($nota) {
   return match (true) {
       $nota >= 9 && $nota <= 10 => "sobresaliente",
       $nota >= 7 && $nota <= 8  => "notable",
       $nota >= 5 && $nota <= 6  => "aprobado",
       $nota >= 0 && $nota <= 4  => "suspenso",
       default => "Nota no válida"
   };
}
echo "\n El alumno tiene como calificacion un: ".notasMatch(8)."\n";

// Ejercicio 26. Validador de datos con operador null coalescing
// Crea una función que valide datos de usuario asignando valores por defecto cuando falten.
function validarDatosNull($usuario) {
   return [
       'nombre' => $usuario['nombre'] ?? 'Anónimo',
       'email'  => $usuario['email']  ?? 'sin-email@example.com',
       'edad'   => $usuario['edad']   ?? 18,
       'ciudad' => $usuario['ciudad'] ?? 'Desconocida'
   ];
}
print_r(validarDatosNull(['nombre' => 'Juan', 'edad' => 25]));

// Ejercicio 27. Acceso seguro a propiedades con nullsafe operator
// Crea una función que acceda de forma segura a propiedades anidadas que pueden no existir.
function codigoPostal($usuario) {
   return $usuario?->direccion?->codigoPostal ?? "Código postal no disponible";
}
$usuario = (object)[
   'nombre' => 'Manu',
   'direccion' => (object)[
       'calle' => 'Diagonal',
       'ciudad' => 'Barcelona',
       'codigoPostal' => '17273'
   ]
];
echo codigoPostal($usuario)."\n";

// Ejercicio 28. Calculadora interactiva
// Crea un programa que solicite dos números y una operación, mostrando el resultado.
$num1 = readline("Primer número: ");
$num2 = readline("Segundo número: ");
$operacion = readline("Operación (+, -, *, /): ");
if ($operacion == '+') {
   $res = $num1 + $num2;
} else if ($operacion == '-') {
   $res = $num1 - $num2;
} else if ($operacion == '*') {
   $res = $num1 * $num2;
} else if ($operacion == '/') {
   if ($num2 == 0) {
       echo "Error \n";
       exit;
   }
   $res = $num1 / $num2;
} else {
   echo "Error \n";
   exit;
}
echo "Resultado: $num1 $operacion $num2 = $res \n";

// Ejercicio 29. Conversor de temperaturas con constantes mágicas
// Crea un programa que convierta temperaturas entre Celsius, Fahrenheit y Kelvin.
define("KELVIN", 273.15);
function convertirTemp($valor, $desde, $hasta) {
   echo "Función: " . __FUNCTION__ . " (línea " . __LINE__ . ")\n";
   if ($desde == "celsius" && $hasta == "fahrenheit") {
       return ($valor * 9/5) + 32;
   } elseif ($desde == "celsius" && $hasta == "kelvin") {
       return $valor + KELVIN;
   } elseif ($desde == "fahrenheit" && $hasta == "celsius") {
       return ($valor - 32) * 5/9;
   } elseif ($desde == "kelvin" && $hasta == "celsius") {
       return $valor - KELVIN;
   } else {
       return "Conversión no válida";
   }
}
echo convertirTemp(40, "celsius", "kelvin");
?>