<?php

require __DIR__ . "/vendor/autoload.php";

use Source\App\Sorteio;

$monetizze = new Sorteio(CONF_QTD_DEZENAS, CONF_QTD_JOGOS);
$monetizze->gerarJogos();
$monetizze->sortear();
$monetizze->confereResultado();

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Sorteio Monettize</title>
  </head>
  <body>
    <h1 class="text-center">Sorteio Monettize</h1>

    <?php echo $monetizze->confereResultado(); ?>

  </body>
</html>