<?php
require_once 'basedatos.php';
$host = 'db';
$dbname = 'testdb';
$username = 'alumno';
$password = 'alumno';
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$version = $pdo->query('SELECT VERSION()')->fetchColumn();

try{
    $stmt = $pdo->prepare('UPDATE productos SET eliminado = 1 WHERE stock = 0');
    $stmt->execute([1.00]);

    echo "No<br>";

    $stmt = $pdo->prepare('SELECT * FROM productos WHERE eliminado = 0');
    $stmt->execute();
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    print_r($productos);
} catch (Exception $e){
    echo "Error";
}

?>