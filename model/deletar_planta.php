<?php
if(!empty($_GET['id_planta']))
{
    include_once('config.php');

    $id_planta = $_GET['id_planta'];

    $sqlSelect = "SELECT * FROM cadastro_planta WHERE id_planta=$id_planta";

    $result = $conexao->query($sqlSelect);

    if($result->num_rows > 0)
    {
        $sqlDelete = "DELETE FROM cadastro_planta WHERE id_planta=$id_planta";

        $resultDelete = $conexao->query($sqlDelete);
    }

}
header('Location: ../view/minhas_planta.php');
?>