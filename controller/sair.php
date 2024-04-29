<?php
    session_start();
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    session_destroy();
    header('Location: ../view/index.html');
?>