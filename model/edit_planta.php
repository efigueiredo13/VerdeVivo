<?php
    if(!empty($_GET['id_planta']))
    {
        include_once('config.php');

        $id_planta = $_GET['id_planta'];

        $sqlSelect = "SELECT * FROM cadastro_planta WHERE id_planta=$id_planta";

        $result = $conexao->query($sqlSelect);

        if($result->num_rows > 0)
        {
            while($user_data = mysqli_fetch_assoc($result)){
                $nome_planta = $user_data['nome_planta']; 
                $tipo_planta = $user_data['tipo_planta']; 
                $descricao = $user_data['descricao'];
            }

        }else{
            header('Location: ../view/minhas_planta.php');
        }

    }

?>