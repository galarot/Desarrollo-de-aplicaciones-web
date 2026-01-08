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
        .lithium{
            text-align: center;
            border: black 10px solid;
            border-radius: 15px;
            background-color: #f3f3f3;
            opacity: 80%;
            /*margin-left: 100px;*/
            width: 500px;
        }
        .titulolit{
            margin-left: 290px;
        }
        .something{
            text-align: center;
            border: black 10px solid;
            border-radius: 15px;
            background-color: #f3f3f3;
            opacity: 80%;
            width: 500px;
        }
        .canciones{
            padding: 60px;
            display: flex;

            @media screen and (max-width: 768px) {

                flex-direction: column;
            }
        }

        .titulos{
            display: flex;
        }
        .titulosom{
            margin-left: 260px;
        }
        .comeas{
            text-align: center;
            border: black 10px solid;
            border-radius: 15px;
            background-color: #f3f3f3;
            opacity: 80%;
            width: 500px;
        }
        .titulocome{
            margin-left: 210px;
        }
        body{
            background-image: url("multimedia/inutero.png");
            background-repeat: no-repeat;
            background-position: center center;
        }
    </style>
</head>
<body>
    <div class="titulos">
        <h1 class="titulolit">Lithium</h1>
        <h1 class="titulosom">Somenthing in the way</h1>
        <h1 class="titulocome">Come as you are</h1>
    </div>

    <div class="canciones">

        <p class="lithium">I'm so happy <br>
            'Cause today I've found my friends<br>
            They're in my head<br>

            I'm so ugly<br>
            But that's okay, 'cause so are you<br>
            We broke our mirrors<br>

            Sunday morning<br>
            Is everyday, for all I care<br>
            And I'm not scared<br>
            Light my candles in a daze<br>
            'Cause I've found God<br>

            Yeah, yeah, yeah, yeah<br>
            Yeah, yeah, yeah, yeah<br>
            Yeah, yeah, yeah, yeah, yeah<br>

            I'm so lonely<br>
            But that's okay, I shaved my head<br>
            And I'm not sad<br>
            And just maybe<br>
            I'm to blame for all I've heard<br>
            But I'm not sure<br>

            I'm so excited<br>
            I can't wait to meet you there<br>
            But I don't care<br>
            I'm so horny<br>
            But that's okay<br>
            My will is good<br>
        </p>

        <p class="something">
            Underneath the bridge<br>
            Tarp has sprung a leak<br>
            And the animals I've trapped<br>
            Have all become my pets<br>

            And I'm living off of grass<br>
            And the drippings from my ceiling<br>
            It's okay to eat fish<br>
            'Cause they don't have any feelings<br>

            Something in the way, hmm<br>
            Something in the way, yeah, hmm<br>
            Something in the way, hmm<br>

            Something in the way, yeah, hmm<br>
            Something in the way, hmm<br>
            Something in the way, yeah, hmm<br>

            Underneath the bridge<br>
            The tarp has sprung a leak<br>
            And the animals I've trapped<br>
            Have all become my pets<br>

            And I'm living off of grass<br>
            And the drippings from my ceiling<br>
            It's okay to eat fish<br>
            'Cause they don't have any feelings<br>

            Something in the way, hmm<br>
            Something in the way, yeah, hmm<br>
            Something in the way, hmm<br>
            Something in the way, yeah, hmm<br>
        </p>

        <p class="comeas">
            Come as you are, as you were<br>
            As I want you to be<br>
            As a friend, as a friend<br>
            As an old enemy<br>

            Take your time, hurry up<br>
            Choice is yours, don't be late<br>
            Take a rest, as a friend<br>
            As an old memory, yeah<br>

            Memory, yeah<br>
            Memory, yeah<br>
            Memory, yeah<br>

            Come doused in mud, soaked in bleach<br>
            As I want you to be<br>
            As a trend, as a friend<br>
            As an old memory, yeah<br>

            Memory, yeah<br>
            Memory, yeah<br>
            Memory, yeah<br>

            And I swear that I don't have a gun<br>
            No, I don't have a gun<br>
            No, I don't have a gun<br>

            Memory, yeah<br>
            Memory, yeah<br>
            Memory, yeah<br>
            (No, I don't have a gun)<br>
            And I swear that I don't have a gun<br>
            No, I don't have a gun<br>
            No, I don't have a gun<br>
        </p>
    </div>
</body>
</html>

<?php
include 'footer.php';
?>
