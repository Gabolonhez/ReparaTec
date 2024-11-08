<?php
    include 'includes/conexao.php';
    session_start();
    
    $_SESSION['cod'] = '';

    header("Location: login.php")
?>