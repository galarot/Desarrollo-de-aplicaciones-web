<?php
//Ejercicio 5
$host = 'db';
$dbname = 'testdb';
$username = 'alumno';
$password = 'alumno';
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$version = $pdo->query('SELECT VERSION()')->fetchColumn();
echo "<p class='info'>MariaDB versión: $version</p>";
require_once 'basedatos.php';
$categoria_id = 1;
$producto_id = 3;
$cantidad = 2;

$pdo->beginTransaction();

$stmt = $pdo->prepare('UPDATE productos SET precio = precio * 1.10 WHERE categoria_id = ?');

$stmt->execute([$categoria_id]);
echo "si";

$stmt = $pdo->prepare('SELECT stock FROM productos WHERE id = ?');
$stmt->execute([$producto_id]);
$stock_actual = $stmt->fetchColumn();

if($stock_actual === false){
    echo "Producto null";
}
if($stock_actual < $cantidad){
    echo "Stock insuficiente";
}

$stmt = $pdo->prepare('UPDATE productos SET stock = stock - ? WHERE id = ?');
$stmt->execute([$cantidad, $producto_id]);

$stmt = $pdo->query("SELECT * FROM productos");
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($productos);

?>