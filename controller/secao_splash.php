<?php
    if(!isset($_SESSION['splash']))
    {
        $_SESSION['splash'] = true;

        include('../view/splash.php');
    }
?>