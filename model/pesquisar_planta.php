<?php

    if (!empty ($_GET['search'])) {
    $data = $_GET['search'];

    $sql = "SELECT id_planta, nome_planta, tipo_planta, descricao FROM cadastro_planta WHERE id_planta LIKE '%$data%' or nome_planta LIKE '%$data%' or tipo_planta LIKE '%$data%' ORDER BY id_planta ASC";

    }else{
        
        $sql = "SELECT id_planta, nome_planta, tipo_planta, descricao FROM cadastro_planta ORDER BY id_planta ASC";

    }
    
?>