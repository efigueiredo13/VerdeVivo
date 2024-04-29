<?php 
include_once('config.php');
if(isset($_POST['submit'])){
    $result = $conexao->query("SELECT * FROM cadastro WHERE usuario = '{$_SESSION['usuario']}' AND senha = '{$_SESSION['senha']}'");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_usuario = $row['id_usuario'];
        $_SESSION['id_usuario'] = $id_usuario;

        $nome_planta = $_POST['nome_planta']; 
        $tipo_planta = $_POST['tipo_planta']; 
        $descricao = $_POST['descricao'];

        $result = mysqli_query($conexao, "INSERT INTO cadastro_planta(id_usuario, nome_planta, tipo_planta, descricao) 
        VALUES('$id_usuario', '$nome_planta', '$tipo_planta', '$descricao')");

        // Redireciona para a mesma página após a inserção
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    } else {
        echo "Nome de usuário ou senha incorretos";
    }
}
?>