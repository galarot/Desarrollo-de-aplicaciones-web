<?php
$conn = new mysqli("db", "user", "pass", "testdb");
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
$result = $conn->query("SELECT mensaje FROM mensajes");
$row = $result->fetch_assoc();
echo "Mensaje desde la BD: " . $row["mensaje"] . "<br>";

echo "Servidor: " . gethostname();
?>
