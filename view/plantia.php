<?php

    session_start();
    //print_r($_SESSION);

    if((!isset($_SESSION['usuario']) == true) and (!isset($_SESSION['senha']) == true))
    {
        unset($_SESSION['usuario']);
        unset($_SESSION['senha']);
        header('Location: login.php');
    }
    $logado = $_SESSION['usuario'];
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
    
<div class="cabecalho">
    <img id="logo" src="../assets/img/logo 1.svg" alt="logo do site" >
    <div class="usuario-sair">
        <?php 
            echo "<p class='usuario'><u>$logado</u></p>";
        ?>
        <a class="btn btn-outline btn-sm" href="login.php">Sair</a>
    </div>
</div>

    <div vw class="enabled">
        <div vw-access-button class="active"></div>
            <div vw-plugin-wrapper>
                <div class="vw-plugin-top-wrapper"></div>
            </div>
    </div>
  
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script> new window.VLibras.Widget('https://vlibras.gov.br/app');</script>
<!--
<footer>
    <p>© 2024 Verde Vivo. Todos os direitos reservados.</p>
</footer>
-->
</body>
</html>