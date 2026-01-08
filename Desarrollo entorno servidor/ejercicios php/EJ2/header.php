<?php
require_once 'config.php';

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo $site_title; ?></title>
    <style>
        body{
            background-color: bisque;
        }
        a{
            margin-left: 20px;
            text-decoration: none;

        }
        .cabecera{
            border: black 5px solid;
            border-radius: 20px;
            padding: 30px;
            background-color: aqua;
            display: flex;
            align-items: center;
            font-size: 150%;
        }
        footer{
            border-radius: 20px;
            border: black 5px solid;
            padding: 30px;
            background-color: aqua;
        }
        .buscador{
            /*margin-left: 700px;*/
        }
        .logo{
            width: 100px;
            height: auto;
        }
        .opciones{
            margin-left: 20px;
        }

    </style>
</head>
<body>
    <header class="cabecera">
        <img class="logo" src="multimedia/nirvana.png">
        <nav class="opciones">
            <a href="index.php">Inicio</a>
            <a href="canciones.php">Canciones</a>
            <a href="miembros.php">Integrantes</a>
            <a href="merch.php">Merch</a>
        </nav>
        <form class="buscador">
            <input class="buscar" type="search" placeholder="Search" aria-label="Search">
            <button class="boton" type="submit">Search</button>
        </form>
    </header>
