<?php
$nombre = "Manolo Manoloso";
$edad = "19";
$ciudad = "Granada";
$fecha = date("d/m/Y");
$hora = date("H:i:s");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EJ1</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <ul class="cabecera">
                <li>Inicio</li>
                <li>Informacion</li>
                <li>Contacto</li>
                <li>Acerca de</li>
            </ul>
        </nav>
        <form class="buscador">
            <input class="buscar" type="search" placeholder="Search" aria-label="Search">
            <button class="boton" type="submit">Search</button>
        </form>
    </header>

    <div class="main">
        <h1>Ejercicio 1</h1>
        <div class="cositas">
            <p class="info"> Nombre: <?php echo $nombre; ?></p>
            <p class="info"> Edad: <?php echo $edad; ?></p>
            <p class="info"> Ciudad: <?php echo $ciudad; ?></p>
            <p class="info"> Fecha: <?php echo $fecha; ?></p>
            <p class="info"> Hora: <span id="time"></span></p>
        </div>
    </div>

    <script>
        function actualizar(){
            const now = new Date();
            const time = now.toLocaleTimeString();
            document.getElementById("time").textContent = time;
        }
        setInterval(actualizar, 1000);
        actualizar();
    </script>

</body>
</html>