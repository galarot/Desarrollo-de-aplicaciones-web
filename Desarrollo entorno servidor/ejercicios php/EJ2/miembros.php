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
        .nombres{
            display: flex;
        }
        .textkrist{
            text-align: center;
            border: black 10px solid;
            border-radius: 15px;
            background-color: #f3f3f3;
            opacity: 80%;
            width: 500px;
            margin-left: 5px;
        }
        .descint{
            display: flex;
        }

        .kristimg{
            margin-left: 190px;
        }
        .nombres{
            gap: 360px;
            justify-content: center;
        }

        .textkurt{
            text-align: center;
            border: black 10px solid;
            border-radius: 15px;
            background-color: #f3f3f3;
            opacity: 80%;
            width: 500px;
            margin-left: 100px;
        }
        .kurtimg{
            width: 600px;
            margin-left: 100px;
        }
        .textdave{
            text-align: center;
            border: black 10px solid;
            border-radius: 15px;
            background-color: #f3f3f3;
            opacity: 80%;
            width: 500px;
            margin-left: 100px;
        }
        .daveimg{
            width: 400px;
            margin-left: 150px;
        }
        body{
            background-image: url("multimedia/inutero.png");
            background-repeat: no-repeat;
            background-position: center center;
        }
    </style>
</head>
<body>
    <div class="nombres">
        <h1 class="kristname">Krist Novoselic</h1>
        <h1 class="kurtname">Kurt Cobain</h1>
        <h1 class="davename">Dave Grohl</h1>
    </div>
    <img class="kristimg" src="multimedia/krist.png">
    <img class="kurtimg" src="multimedia/kurt.png">
    <img class="daveimg" src="multimedia/dave.png">
    <div class="descint">
        <p class="textkrist">Bajista de la banda. Conocido por su altura imponente <br>
            y presencia escénica, proporcionaba la base rítmica y <br>
            melódica que sostenía las canciones de Nirvana, complementando <br>
            la intensidad de Kurt.</p>
        <p class="textkurt">
            Vocalista y guitarrista principal. Fue el líder creativo y compositor <br>
            principal de la banda, conocido por su estilo introspectivo y letras <br>
            emotivas que conectaban con la generación grunge de los 90. Su influencia <br>
            en la música alternativa es enorme.<br>
        </p>
        <p class="textdave">
            Baterista de Nirvana desde 1990. Destacó por su energía y potencia en la <br>
            batería, aportando un sonido contundente que definió gran parte del estilo <br>
            de la banda. Después de Nirvana, se convirtió en líder de Foo Fighters.
        </p>
    </div>

</body>
</html>

<?php
include 'footer.php';
?>
