<?php
    include_once('../model/edit_planta.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/img/logo 1.svg" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/edit.css">
</head>
<body>

<div class="cabecalho" id= "cabecalho">
        <img id="logo" src="../assets/img/logo 1.svg" alt="logo do site" >
        
            <div class="usuario-voltar">
                <a class="btn btn-outline btn-sm" href="minhas_planta.php">Voltar</a>
            </div>
    </div>

<div class="container" id="cadastro-planta">

    <form action="../model/salvar_edit.php" method="POST">
        <div class="input-wrapper">
            <input type="text" placeholder="Nome da Planta" value="<?php echo $nome_planta?>" name="nome_planta" id="nome_planta" class="input" required>
        </div>

        <div class="input-wrapper">
            <input type="text" placeholder="Tipo da Planta" value="<?php echo $tipo_planta?>" name="tipo_planta" id="tipo_planta" class="input" required>
        </div>

        <div class="input-wrapper">
            <input type="text" placeholder="Digite seu texto aqui..." value="<?php echo $descricao?>" name="descricao" id="descricao" class="input" required>
        </div>

        <input type="hidden" name="id_planta" value="<?php echo $id_planta ?>">
        <input type="submit" name="update" class="btn-enviar-planta" value="Enviar" id="update">
    </form>


</div>
</body>
</html>
