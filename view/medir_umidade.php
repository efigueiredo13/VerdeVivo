<?php
    session_start();
    include_once('../model/config.php');

    if((!isset($_SESSION['usuario']) == true) and (!isset($_SESSION['senha']) == true)) {   
        unset($_SESSION['usuario']);
        unset($_SESSION['senha']);
        header('Location: login.php');
        exit;
    }

    $logado = $_SESSION['usuario'];


?>
<!DOCTYPE html>
<html lang="Pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medir Umidade</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/medir_umidade.css">
</head>
<body>

<div class="cabecalho" id= "cabecalho">
        <img id="logo" src="../assets/img/logo 1.svg" alt="logo do site" >

            <nav>
                <a href="lista_planta.php">Minhas Plantas</a>
                <a href="medir_umidade.php">Medir Umidade</a>
            </nav>
            
            <div class="usuario-sair">
                <?php 
                    echo "<p class='usuario'><u>$logado</u></p>";
                ?>
                <a class="btn btn-outline btn-sm" href="../controller/sair.php">Sair</a>
            </div>
    </div>
    <h1>Dados de Umidade do Solo</h1>
    <?php
      
       // Defina a chave da sua API do ThingSpeak
       $api_key = "W030R0LZO5GEVOQM";
       
       // URL da consulta para obter os últimos dados do ThingSpeak
       $url = "https://api.thingspeak.com/channels/2538413/feed.json?api_key=" . $api_key . "&results=1";
       
       // Faz a solicitação HTTP para o ThingSpeak
       $response = file_get_contents($url);
       
       // Decodifica a resposta JSON
       $data = json_decode($response);
       
       // Verifica se a resposta foi bem-sucedida
       if ($data !== false && isset($data->feeds[0])) {
           // Extrai os dados do feed
           $umidade = $data->feeds[0]->field1;
           
           // Exibe os dados
           echo "Umidade do Solo: " . $umidade . "%";
       } else {
           echo "Não foi possível obter os dados.";
       }
       
    ?>
    
<!--------------API de Libras--------------------->
<div vw class="enabled">
        <div vw-access-button class="active"></div>
            <div vw-plugin-wrapper>
                <div class="vw-plugin-top-wrapper"></div>
            </div>
    </div>
  
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script> new window.VLibras.Widget('https://vlibras.gov.br/app');</script>

    <script src="../assets/javascript/tab.js"></script>

</body>
</html>