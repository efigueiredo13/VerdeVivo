<?php

    session_start();
    //print_r($_SESSION);

    if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true))
    {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: login.php');
    }
    $logado = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/splash.css">
    <script src="../assets/javascript/tab.js" type="text/javascript"></script>
    <title>Bem vindo</title>
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

    <?php 
        echo "<p>Entrou no sistema<u>$logado</u></p>"
    ?>

    <a href="sair.php">Sair</a>
</body>
</html>