<?php
include 'include/conexao.php';
session_start();

$email = "";
$mandar = $_POST['mandar'] ?? "";
$email_errado = FALSE;
if (!empty($mandar)){
    $email = $_POST['email'];
    $sql = "SELECT user_cod, user_cpf FROM users WHERE user_email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $user_cod = $row['user_cod'];
        $_SESSION['user_cod'] = $user_cod;
        echo "<script>window.location.href='login/index.php'</script>";       
    } else {
        $email_errado = TRUE;
        // echo "email não encontrado";
    }

}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/style/login.css">
    <script src="https://kit.fontawesome.com/cc58ee488d.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="fundo">
        <img src="assets/img/login/fundo.png" alt="">
    </div>
    <div class="container">
        <header>
            <div class="logo">
                <img src="assets/img/login/logo.png" alt="Helpy logo">
            </div>
        </header>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
        <div class="form">
            <div class="welcome">
                <h2>Olá!</h2>
                <h3>Entre na sua conta</h3>
            </div>            
            <div class="informations">
            <?php if ($email_errado) {?>
                <p>Email não encontrado!</p>
            <?php } else {?>
                <p>&nbsp;</p>
            <?php }?>
            <label>Email <br>
                <input type="email" name="email" id="email" placeholder="Email" value="<?=$email?>">
            </label>
                    <!-- <div class="botao-continuar"> -->
                        <!-- <i class='fa-regular fa-envelope'></i> -->
            <input type="submit" class="continue" value="Continuar com e-mail">
            <input type="hidden" name="mandar" value="yes">
                    <!-- </div> -->
            <a href="cadastro/cadastro1.php" class="new">Criar uma conta</a>
            </div>
        </div>
        </form>
    </div>
</body>
<script>
    function criarConta(){
        window.location.href="cadastro/cadastro1.html"
    } 
</script>
</html>