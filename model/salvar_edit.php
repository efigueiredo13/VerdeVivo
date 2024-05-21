<?php
    include_once('config.php');
 
        $id_planta = $_POST['id_planta'];
        $nome_planta = $_POST['nome_planta']; 
        $tipo_planta = $_POST['tipo_planta']; 
        $descricao = $_POST['descricao'];
        
        $sqlUpdate = "UPDATE cadastro_planta SET nome_planta='$nome_planta', tipo_planta='$tipo_planta', descricao='$descricao' WHERE id_planta='$id_planta'";
        
        $result = $conexao->query($sqlUpdate);
        
 
    header('Location: ../view/minhas_planta.php');
    
   
?>