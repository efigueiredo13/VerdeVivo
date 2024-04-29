<?php 

    $dbHost = 'Localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'verdevivo';

    
    $conexao = new mysqli($dbHost, $dbUsername, $dbPassword,$dbName);
    //if ($conexao->connect_errno) {
    //     echo "Falha na conexão";
    // }
    // else {
    //     echo "Conexão efetuada com sucesso";
    // }

        
?>
