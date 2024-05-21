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
    <link rel="shortcut icon" href="../assets/img/logo 1.svg" type="image/x-icon">
</head>
<style>
        .container {
            width: 80%;
            max-width: 600px;
            text-align: center;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .progress-bar {
            width: 100%;
            background: #e6e6e6;
            border-radius: 5px;
            overflow: hidden;
            position: relative;
            height: 30px;
            margin-top: 20px;
        }
        .progress-bar-inner {
            height: 100%;
            background: #4caf50;
            width: 0;
            transition: width 0.5s ease;
        }
        .value {
            font-size: 24px;
            margin-top: 20px;
            font-weight: bold;
        }
        .progress-value {
            position: absolute;
            width: 100%;
            text-align: center;
            line-height: 30px;
            color: #fff;
            font-weight: bold;
        }
    </style>
<body>

<div class="cabecalho" id= "cabecalho">
        <img id="logo" src="../assets/img/logo 1.svg" alt="logo do site" >

            <nav>
                <a href="plantia.php">PlantIA</a>
                <a href="minhas_planta.php">Minhas Plantas</a>
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
    <div class="container">
        <?php
            
            $api_key = "W030R0LZO5GEVOQM";
            
            
            $url = "https://api.thingspeak.com/channels/2538413/feed.json?api_key=" . $api_key . "&results=1";
            
            
            $response = file_get_contents($url);
            
           
            $data = json_decode($response);
            
            
            if ($data !== false && isset($data->feeds[0])) {
                
                $umidade = $data->feeds[0]->field1;
                echo "<div class='progress-bar' id='progress-bar'>
                        <div class='progress-bar-inner' id='progress-bar-inner'></div>
                        <div class='progress-value' id='progress-value'></div>
                      </div>";
                echo "<div class='value'>Umidade do Solo: " . $umidade . "%</div>";
            } else {
                echo "<div class='value'>Não foi possível obter os dados.</div>";
            }
        ?>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var umidade = <?php echo $umidade; ?>;
            var progressBarInner = document.getElementById('progress-bar-inner');
            var progressValue = document.getElementById('progress-value');
            progressBarInner.style.width = umidade + '%';
            progressValue.textContent = umidade + '%';
        });
    </script>
    
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