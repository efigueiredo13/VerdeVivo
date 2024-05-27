<?php
    $usuario = mysqli_real_escape_string($conexao, $_POST['usuario']); 
    $email = mysqli_real_escape_string($conexao, $_POST['email']); 
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

    $check = mysqli_query($conexao, "SELECT * FROM cadastro WHERE usuario='$usuario' OR email='$email'");
    if(mysqli_num_rows($check) > 0){
        $message = 'Usuário ou email já cadastrado!';
    } else {
        $result = mysqli_query($conexao, "INSERT INTO cadastro(usuario, senha, email) VALUES('$usuario', '$senha', '$email')");
        if($result){
            echo "<script>alert('Cadastro enviado com sucesso!'); window.location.href='login.php';</script>";
        } else {
            $message = 'Erro ao enviar o cadastro.';
        }
    }
?>