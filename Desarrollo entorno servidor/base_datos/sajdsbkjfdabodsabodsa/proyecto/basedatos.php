<?php
//Ejercicio 1
$host = 'db';
$dbname = 'testdb';
$username = 'alumno';
$password = 'alumno';
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$version = $pdo->query('SELECT VERSION()')->fetchColumn();
echo "<p class='info'>MariaDB versión: $version</p>";

$pdo->exec("CREATE TABLE IF NOT EXISTS categorias(id INT PRIMARY KEY AUTO_INCREMENT, nombre VARCHAR(100), descripcion TEXT)");

$pdo->exec("CREATE TABLE IF NOT EXISTS productos(id INT PRIMARY KEY AUTO_INCREMENT,nombre VARCHAR(100), categoria_id INT NOT NULL,precio DECIMAL(10,2), stock INT DEFAULT 0, FOREIGN KEY (categoria_id) REFERENCES categorias (id))");

$pdo->exec("CREATE TABLE IF NOT EXISTS usuarios(id INT PRIMARY KEY AUTO_INCREMENT,nombre VARCHAR(100), email VARCHAR(100),contraseña VARCHAR(100))");

$pdo->exec("CREATE TABLE IF NOT EXISTS pedidos(id INT PRIMARY KEY AUTO_INCREMENT,usuario_id INT NOT NULL UNIQUE,fecha DATETIME,total DECIMAL(10, 2), FOREIGN KEY (usuario_id) REFERENCES usuarios (id))");

$stmt=$pdo->query('SELECT * FROM categorias');
$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($categorias);

$stmt=$pdo->query('SELECT * FROM productos');
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($productos);

$stmt=$pdo->query('SELECT * FROM usuarios');
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($productos);

$stmt=$pdo->query('SELECT * FROM pedidos');
$pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($pedidos);

//Ejercicio 2
echo "<br>";
$count = $pdo->query("SELECT COUNT(*) FROM categorias")->fetchColumn();
if ($count == 0) {
    $pdo->exec("
        INSERT INTO categorias(nombre) VALUES
        ('Citricos'),
        ('Frutas rojas'),
        ('Tropicales')
    ");
}

$count = $pdo->query("SELECT COUNT(*) FROM productos")->fetchColumn();
if ($count == 0) {
    $pdo->exec("
        INSERT INTO productos(nombre, categoria_id, precio, stock) VALUES
        ('Manzana', 1, 0.5, 18),
        ('Pera', 2, 0.4, 21),
        ('Sandia', 3, 2, 0),
        ('Melon', 4, 1.5, 9),
        ('Frambuesa', 5, 0.3, 24),
        ('Naranja', 6, 0.6, 0),
        ('Platano', 7, 0.7, 19),
        ('Fresa', 8, 0.3, 31),
        ('Uva', 9, 0.1, 36),
        ('Cereza', 10, 0.2, 12)
    ");
    echo "<p class='success'>Datos de ejemplo insertados</p>";
}
//Ejercicio 3
echo "<br>";
$stmt = $pdo->prepare( 'SELECT * FROM productos ORDER BY precio ASC' );
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($productos as $producto) {
    echo "<p>$producto[nombre]</p>";
}

$stmt = $pdo->prepare('SELECT * FROM productos WHERE categoria_id =2');
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($productos as $producto) {
    echo "<p>$producto[nombre]</p>";
}

$stmt = $pdo->prepare('SELECT * FROM productos WHERE stock < 20');
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($productos as $producto) {
    echo "<p>$producto[nombre]</p>";
}

$stmt = $pdo->prepare ('SELECT COUNT(*) AS total FROM productos');
$stmt->execute();
$total = $stmt->fetchColumn();
foreach ($productos as $producto) {
    echo "<p>$producto[nombre]</p>";
}

//Ejercicio 4
echo "<br>";
$stmt = $pdo->prepare('SELECT p.nombre AS producto, p.precio, c.nombre AS categorias FROM productos p INNER JOIN categorias c ON p.categoria_id = c.id ORDER BY c.nombre ASC, p.precio ASC');
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($productos);

//Ejercicio 8
echo "<br>";
$pdo->exec('CREATE TABLE IF NOT EXISTS detalle_pedidos (id INT PRIMARY KEY AUTO_INCREMENT, pedido_id INT NOT NULL, producto_id INT NOT NULL, cantidad INT NOT NULL, precio DECIMAL(10,2) NOT NULL,
FOREIGN KEY (pedido_id) REFERENCES pedidos(id), FOREIGN KEY (producto_id) REFERENCES productos(id))');

$productos_mas_vendidos = $pdo->query('SELECT p.nombre, SUM(dp.cantidad) AS total_vendido FROM detalle_pedidos dp JOIN productos p ON dp.producto_id = p.id
GROUP BY p.id ORDER BY total_vendido DESC')->fetchAll(PDO::FETCH_ASSOC);

print_r($productos_mas_vendidos);

$ingresos_categoria = $pdo->query('SELECT c.nombre AS categoria, SUM(dp.cantidad * dp.precio) AS ingresos FROM detalle_pedidos dp
JOIN productos p ON dp.producto_id = p.id JOIN categorias c ON p.categoria_id = c.id GROUP BY c.id
ORDER BY ingresos DESC')->fetchAll(PDO::FETCH_ASSOC);

print_r($ingresos_categoria);

$bajo_stock = $pdo->query('SELECT nombre, stock FROM productos WHERE stock < 10 ORDER BY stock ASC')->fetchAll(PDO::FETCH_ASSOC);

print_r($bajo_stock);

$usuarios_mas_compras = $pdo->query("SELECT u.nombre, COUNT(p.id) AS total_pedidos FROM usuarios u JOIN pedidos p ON u.id = p.usuario_id
GROUP BY u.id ORDER BY total_pedidos DESC")->fetchAll(PDO::FETCH_ASSOC);

print_r($usuarios_mas_compras);
?>
