<?php
require_once 'config.php';
include 'header.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo $site_title; ?></title>
    <style>
        .date{
            text-align: center;
            border: black 10px solid;
            border-radius: 15px;
            background-color: #f3f3f3;
            opacity: 80%;
            width: 800px;
            margin-left: 500px;
            margin-top: 40px;
            margin-bottom: 250px;
        }
        .comprar{
            width: 300px;
        }
        body{
            background-image: url("multimedia/inutero.png");
            background-repeat: no-repeat;
            background-position: center center;
        }
        .comprar{
            transition: transform 0.3s ease;
        }
        .comprar:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>

    <div class="date">
        <p>¡Lleva el espíritu de Nirvana contigo! Descubre nuestra<br>
            colección oficial de merch y muestra tu amor por la banda<br>
            que cambió el rock para siempre. Desde camisetas icónicas<br>
            hasta accesorios únicos, cada pieza refleja la esencia grunge<br>
            y la actitud rebelde de Kurt Cobain y compañía. No te quedes sin tu <br>
            estilo Nirvana: hazlo tuyo hoy a fecha:</p>
        <p class="info"> Fecha: <?php echo $fecha; ?></p>
        <p class="info"> Hora: <span id="time"></span></p>
        <img class="comprar" src="multimedia/buy.png">
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

<?php
include 'footer.php';
?>
