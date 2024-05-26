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
    include_once('../model/pesquisar_planta.php');
    $result = $conexao->query($sql);

   
?>
<!DOCTYPE html>
<html lang="Pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Plantas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/lista_planta.css">
    <link rel="shortcut icon" href="../assets/img/logo 1.svg" type="image/x-icon">
</head>
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

    <div class="box-search">
        <input type="search" class="form-control w-25" placeholder="Pesquisar" id="pesquisar">
        <button onclick="searchData()" class="btn btn-success">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
            </svg>
        </button>
    </div>
    
    <a href="minhas_planta.php"  class=" btn_tudo btn btn-success">Ver tudo</a>


    <div class="m-5">
        <table class="table table-bg">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">...</th>
                    
                </tr>
            </thead>
            <tbody>
           
                <?php
                    while($user_data = mysqli_fetch_assoc($result)){
                        echo "<tr>";
                        echo "<td>".$user_data['id_planta']."</td>";
                        echo "<td>".$user_data['nome_planta']."</td>";
                        echo "<td>".$user_data['tipo_planta']."</td>";
                        echo "<td>".$user_data['descricao']."</td>";
                        echo "<td>
                        <div class='botoes' id='botoes'>
                            <a class='btn btn-sm btn-success' href='edit.php?id_planta=$user_data[id_planta]'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                                    <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325'/>
                                    </svg>
                            </a>
                            

                            <a class='btn btn-sm btn-danger' href='../model/deletar_planta.php?id_planta=$user_data[id_planta]'>                 
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash3' viewBox='0 0 16 16'>
                                <path d='M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5'/>
                                </svg>
                            </a>
                            
                            </div>
                        </td>";
                        echo "<tr>";
                    }
                ?>
            </tbody>
        </table>
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
    <script src="../assets/javascript/pesquisar.js"></script>
    
    

</body>
</html>