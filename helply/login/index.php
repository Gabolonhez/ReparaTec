<?php
include '../include/conexao.php';
session_start();
$user_cod = $_SESSION['user_cod'];

// Para verificar qual a senha do usuário no banco de dados depois comparar com a senha digitada
$sql_cod = "SELECT user_cpf, user_email, register_complete, register_level FROM users WHERE user_cod = ?";
$stmt_cod = mysqli_prepare($conn, $sql_cod);
mysqli_stmt_bind_param($stmt_cod, "s", $user_cod);
mysqli_stmt_execute($stmt_cod);
$result_cod = mysqli_stmt_get_result($stmt_cod);
$row_cod = mysqli_fetch_assoc($result_cod);
$db_cpf = $row_cod['user_cpf'];
$db_email = $row_cod['user_email'];

date_default_timezone_set('America/Sao_Paulo');
$hoje = date('d/m/Y H:i');

// Usuário so pode entrar no sistema se o seu usuário estiver completo
$register_complete = $row_cod['register_complete'];
$register_level = $row_cod['register_level'];
$senha_errada = FALSE;

$mandar = $_POST['mandar'] ?? "";
if (!empty($mandar)){
    $cpf = $_POST['cpf'];
    if ($cpf != $db_cpf){
        // Caso a senha seja incorreta mostrar a mensagem "SENHA INCORRETA!" ao usuário
        $senha_errada = TRUE;
    }else{
        // Atualiza o status para Logado do usuário, e o seu último acesso no banco de dados
        $sql_update = "UPDATE users SET logged = 1, ultimo_acesso = ? WHERE user_cod = ?";
        $stmt_update = mysqli_prepare($conn, $sql_update);
        mysqli_stmt_bind_param($stmt_update, "ss", $hoje, $user_cod);
        mysqli_stmt_execute($stmt_update);

        if ($register_complete){
            echo "<script>window.location.href='../inicial/inicial.php'</script>";
        }else{
            echo "<script>window.location.href='../cadastro/".$register_level."'</script>";
            $_SESSION['email'] = $db_email;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/style/login/style.css">
    <script src="https://kit.fontawesome.com/cc58ee488d.js" crossorigin="anonymous"></script>
    <?php if ($senha_errada) {?>
        <style>
            #cpf {
                outline: 1px solid red !important;
            }
        </style>
    <?php }?>
</head>
<body>
    <div class="fundo">
        <img src="../assets/img/login/fundo.png" alt="">
    </div>
    <div class="container">
        <header>
            <div class="logo">
                <img src="../assets/img/login/logo.png" alt="Helpy logo">
            </div>
        </header>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
        <div class="form">
            <div class="welcome">
                <h2>Olá!</h2>
                <h3>Entre na sua conta</h3>
            </div>            
            <div class="informations">
            <?php if ($senha_errada) {?>
                <p>Senha Incorreta!</p>
            <?php } else {?>
                <p>&nbsp;</p>
            <?php }?>
            <label>Email <br>
                <input type="email" name="email" id="email" placeholder="Email" value="<?=$db_email?>" disabled>
            </label>
            <label>Senha <br>
                <input type="password" name="cpf" id="cpf" placeholder="Senha">
            </label>
                    <!-- <div class="botao-continuar"> -->
                        <!-- <i class='fa-regular fa-envelope'></i> -->
            <input type="submit" class="continue" value="Continuar com e-mail">
            <input type="hidden" name="mandar" value="yes">
                    <!-- </div> -->
            <a href="../cadastro/cadastro1.php" class="new">Criar uma conta</a>
            </div>
        </div>
        </form>
    </div>
</body>
<script>
    function criarConta(){
        window.location.href="cadastro/cadastro1.php"
    } 
</script>
</html>