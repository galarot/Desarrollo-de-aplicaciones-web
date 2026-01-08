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
        .titulo{
            text-align: center;
        }
        .info1{
            text-align: center;
            border: black 10px solid;
            padding: 10px;
            width: 100%;

            border-radius: 15px;
            background-color: #f3f3f3;
            opacity: 80%;
        }
        body{
            background-image: url("multimedia/inutero.png");
            background-repeat: no-repeat;
            background-position: center center;
        }

    </style>
</head>
    <body>
        <header>
            <h1 class="titulo">Nirvana</h1>
        </header>
        <div class="info1">
            <p>
                Nirvana fue una banda de rock estadounidense formada por el cantante <br>
                y guitarrista Kurt Cobain y el bajista Krist Novoselic en Aberdeen (Washington)<br>
                en 1987. La banda pasó por una sucesión de bateristas, siendo Chad Channing quien<br>
                más tiempo permaneció hasta que en 1990 fue sustituido por Dave Grohl, su baterista<br>
                definitivo. El éxito de la banda popularizó el rock alternativo y a menudo son considerados la banda <br>
                más representativa de la Generación X. A pesar de contar con una corta carrera profesional<br>
                que duró sólo siete años, su música sigue siendo popular y continúa influyendo en el rock moderno.<br>
                A fines de la década de 1980, Nirvana formaba parte de la escena grunge de Seattle antes de <br>
                lanzar su primer álbum, Bleach, en el sello discográfico independiente SubPop en 1989. <br>
                Parte del sonido característico de muchas de sus canciones se basaba en estructuras que <br>
                alternaban estrofas musicalmente tranquilas con estribillos más ruidosos y contundentes.

            </p>
        </div>

    </body>
</html>

<?php
    include 'footer.php';
?>
