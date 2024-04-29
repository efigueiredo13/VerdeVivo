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

    //chamando o cadastro da planta
    include_once('../model/testeCadastroPlanta.php');
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant IA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/plantia.css">
    <link rel="stylesheet" href="../assets/css/splash.css">
    <link rel="stylesheet" href="../assets/css/tab.css">
    <link rel="stylesheet" href="../assets/css/card.css">
    <link rel="shortcut icon" href="../assets/img/logo 1.svg" type="image/x-icon">
    
</head>
<body>

    
    <div class="splash">
            <div class="intro">
                <img src="../assets/img/logo 1.svg" style="width: 12%;" alt="logo">
                <h1 class="logo">
                    <span class="logo-parts">I</span>
                    <span class="logo-parts">N</span>
                    <span class="logo-parts">I</span>
                    <span class="logo-parts">C</span>
                    <span class="logo-parts">I</span>
                    <span class="logo-parts">A</span>
                    <span class="logo-parts">N</span>
                    <span class="logo-parts">D</span>
                    <span class="logo-parts">O</span>
                </h1>
            </div>
        </div>
    <script src="../assets/javascript/splash.js"></script>
    
    
    <div class="cabecalho" id= "cabecalho">
        <img id="logo" src="../assets/img/logo 1.svg" alt="logo do site" >
            <div class="usuario-sair">
                <?php 
                    echo "<p class='usuario'><u>$logado</u></p>";
                ?>
                <a class="btn btn-outline btn-sm" href="../controller/sair.php">Sair</a>
            </div>
    </div>

    <div class="container">
    <div class="position-card">
        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <p class="title">Como Usar a IA?</p> 
                    <div>
                        <img class="icon" src="../assets/img/icon-ia.svg" alt="icone de inteligencia artificial">
                    </div>
                </div>
                <div class="flip-card-back">
                    <p class="title">Comandos:</p>
                    <div class="descricao">
                        <p>Identifique o tipo da planta:<br> “Qual é o tipo da [nome da planta]?”<br></p>
                        <p>Determine a qualidade do solo ideal:<br> “Qual é a qualidade do solo ideal para a [nome da planta]?”</p>
                        <p>ou</p>
                        <p>Determine a qualidade do solo ideal:<br> “Qual a porcentagem do solo ideal para [nome da planta]?”</p>
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <p class="title">Como cadastro a planta?</p>
                    <div>
                        <img class="icon" src="../assets/img/icon-planta.svg" alt="icone de inteligencia artificial">
                    </div>
                </div>
                <div class="flip-card-back">
                    <p class="title">Para o cadastro:</p>
                    <div class="descricao descricao2">
                        <p>Acesse a aba de cadastro de planta.</p>
                        <p>Insira o nome, tipo e descrição.</p>
                        <p>A descrição a IA fornecerá informações<br> sobre a qualidade ideal da água para a planta.</p>
                        <p>Copie e cole no campo descrição</p>
                    </div>
                    
                    
                </div>
            </div>
        </div>

        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <p class="title">Medição de Umidade do Solo</p>
                    <div>
                        <img class="icon" src="../assets/img/icon-umidade.svg" alt="icone de inteligencia artificial">
                    </div>
                </div>
                <div class="flip-card-back">
                <p class="title">Umidade do solo:</p>
                    <div class="descricao descricao2">     
                        <p>Clique no botão abaixo ou acesse o<br>  menu superior para verificar a umidade do solo.</p>
                        <a class="btn-entrar-umidade" href="#">Entar</a>
                    </div>
                </div>
            </div>
        </div>
    
    </div>
    </div>

    <!------------Tabelas--------------->
    <div id="container-tab">
        <div class="tab-buttons">
            <button class="tab-btn active" content-id="ia">
                Inteligência Artificial
            </button>

            <button class="tab-btn" content-id="cadastro-planta">
                Cadastro da planta
            </button>

            
        </div>

        <div class="tab-contents">
            <div class="content" id="ia">
                <div class="infos">
                    <h1 class="content-title">
                        
                    </h1>
                    <iframe class="iaframe" src="https://www.blackbox.ai/agent/VerdeVivo2Ymz1yG7" width="1000" height="500" allowfullscreen frameborder="0" scrolling="no"></iframe>
                    <p class="content-description">
                       
                    </p>
            </div>
        </div>

                <div class="content" id="cadastro-planta">

                    <div class="infos">
                        <form action="plantia.php" method="POST">
                            <div class="input-wrapper">
                                <input type="text" placeholder="Nome da Planta" name="nome_planta" id="nome_planta" class="input">
                            </div>

                            <div class="input-wrapper">
                                <input type="text" placeholder="Tipo da Planta" name="tipo_planta" id="tipo_planta" class="input">
                            </div>

                            <textarea placeholder="Digite seu texto aqui..." name="descricao" id="descricao"></textarea>
                            
                            <input type="submit" name="submit" class="btn-enviar-planta" value="Enviar">
                        </form>
                    </div>

                </div>
        </div>
            </div>
        </div>
    </div>

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

<footer>
    <p>© 2024 Verde Vivo. Todos os direitos reservados.</p>
</footer>

</body>
</html>