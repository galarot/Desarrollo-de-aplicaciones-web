<?php
function validarEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}
function validarNombre($nombre) {
    return strlen($nombre) >= 2 && preg_match('/^[a-zA-Z\s]+$/', $nombre);
}
function validarTelefono($telefono) {
    return preg_match('/^[0-9]{9}$/', $telefono);
}
function validarClave($clave) {
    return strlen($clave) >= 8 &&
        preg_match('/[A-Z]/', $clave) && preg_match('/[a-z]/', $clave) && preg_match('/[0-9]/', $clave);
}
$nombre = "Manolito pies de plata";
$email = "patata@gmail.com";
$telefono = "611727298";
$clave = "Clave123";

if (validarNombre($nombre) && validarEmail($email) && validarTelefono($telefono) && validarClave($clave)) {
    echo "Todos los datos son válidos.";
} else {
    echo "Algunos datos no son válidos.\n";
    if(!validarNombre($nombre)) echo "Nombre invalido\n";
    if(!validarEmail($email)) echo "Email invalido\n";
    if(!validarTelefono($telefono)) echo "Telefono invalido\n";
    if(!validarClave($clave)) echo "Clave invalido\n";
}

?>