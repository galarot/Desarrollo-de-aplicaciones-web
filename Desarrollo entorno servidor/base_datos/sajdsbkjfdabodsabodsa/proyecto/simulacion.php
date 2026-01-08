<?php
require_once 'basedatos.php';
$host = 'db';
$dbname = 'testdb';
$username = 'alumno';
$password = 'alumno';
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$version = $pdo->query('SELECT VERSION()')->fetchColumn();
//Ejercicio 7
$usuario_id = 1;
$producto_id = 1;
$cantidad = 1;
try{
    $pdo->beginTransaction();
    $stmt=$pdo->prepare('SELECT id FROM usuarios WHERE id=?');
    $stmt->execute([$usuario_id]);
    if(!$stmt->fetch()){
        echo "No existe usuario";
    }

    $stmt = $pdo->prepare('SELECT precio, stock FROM productos WHERE id=?');
    $stmt->execute([$producto_id]);
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);
    if(!$producto){
        echo "No existe producto";
    }

    if($producto['stock'] < $cantidad){
        echo "No stock";

    }

    $total = $producto['precio'] * $cantidad;
    $stmt = $pdo->prepare('INSERT INTO pedidos(usuario_id, fecha, total) VALUES (?, NOW(), ?)');
    $stmt->execute([$usuario_id, $total]);
    $pdo->commit();
    echo "Total compra: $total";
}catch(PDOException $e){

    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    echo "error;".$e->getMessage();
}
?>
