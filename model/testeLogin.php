<?php 

    session_start();

    if(isset($_POST['submit']) && !empty($_POST['usuario']) && !empty($_POST['senha']))
    {
        // Acessa
        include_once('config.php');
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];
        
        /*
        print_r('usuario: ' . $usuario);
        print_r('<br>');
        print_r('Senha: ' . $senha);
        */
        
        $sql = "SELECT * FROM cadastro WHERE usuario = '$usuario' and senha = '$senha'";

        $result = $conexao->query($sql);

        //print_r($sql);
        //print_r($result);
        
        if(mysqli_num_rows($result) < 1)
        {
            unset($_SESSION['usuario']);
            unset($_SESSION['senha']);
            header('Location: ../view/login.php');
        }
        else
        {
            $_SESSION['usuario'] = $usuario;
            $_SESSION['senha'] = $senha;
            header('Location: ../view/plantia.php');
        }
        
    }
    else
    {
        // Não acessa
        header('Location: ../view/login.php');
    }

?>