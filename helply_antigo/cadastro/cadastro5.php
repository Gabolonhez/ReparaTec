<?php include '../include/conexao.php'; ?>
<?php
session_start();
$email_session = $_SESSION['email']; 

// Consultar o usuário
$sql_email = "SELECT * FROM users WHERE user_email = ?";
$stmt_email = mysqli_prepare($conn, $sql_email);
mysqli_stmt_bind_param($stmt_email, "s", $email_session);
mysqli_stmt_execute($stmt_email);
$result_email = mysqli_stmt_get_result($stmt_email);
$row = mysqli_fetch_assoc($result_email);



$tipo_conta     = $row['user_tp_conta'];
$user_cod       = $row['user_cod'];
$nome           = $row['user_nome'];
$sobrenome      = $row['user_sobrenome'];
$dt_nascimento  = $row['user_dt_nascimento'];
$cpf            = $row['user_cpf'];

$pg_atual = "cadastro5.php";

// Armazenar o código do usuário na sessão
$_SESSION['cod'] = $row['user_cod'];

// Variáveis
$mandar = $_POST['mandar'] ?? "";

$confirmar = $_POST['confirmar'] ?? "";

if (!empty($mandar)) {
    if($confirmar){
        // Atualizar tipo de cadastro no banco de dados
        $sql = "UPDATE users SET register_complete = 1, register_level = ? WHERE user_cod = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "si", $pg_atual, $_SESSION['cod']);
        mysqli_stmt_execute($stmt);

        $sql_inserir = "INSERT INTO $tipo_conta (user_cod, nome, sobrenome, dt_nascimento, cpf) VALUES (?,?,?,?,?)";
        $stmt_inserir = mysqli_prepare($conn, $sql_inserir);
        mysqli_stmt_bind_param($stmt_inserir, "issss", $user_cod, $nome, $sobrenome, $dt_nascimento, $cpf);
        mysqli_stmt_execute($stmt_inserir);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: cadastro6.html");
            exit();
        } else {
            echo "<script>alert('Erro ao atualizar os dados: " . mysqli_error($conn) . "');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar conta</title>
    <link rel="stylesheet" href="../assets/style/cadastro/cadastro5.css">
    <link rel="stylesheet" href="../assets/style/cadastro/barras.css">
    <script src="https://kit.fontawesome.com/cc58ee488d.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <img src="../assets/img/login/logo.png" alt="Logo Helply">
        <button class="entrar" onclick="entrar()">Entrar</button>
    </header>
    <main>
        <div class="container">
            <div class="text">
                <h2>Termos e Condições</h2>
                <p>Insira as informações para criar sua conta</p>
            </div>
            <div class="barra">
                <div class="info">
                    <span class="ball-select"></span>
                    <p class="text-select">INFO</p>
                </div>
                <div class="traco-select"></div>
                <div class="pessoal">
                    <span class="ball-select"></span>
                    <p class="text-select">PESSOAL</p>
                </div>
                <div class="traco2-select"></div>
                <div class="pessoal">
                    <span class="ball-select"></span>
                    <p class="text-select">PERFIL</p>
                </div>
                <div class="traco3-select"></div>
                <div class="pessoal">
                    <span class="ball-select"></span>
                    <p class="text-select">ACEITE</p>
                </div>
            </div>
            <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                <div class="form">
                    <div class="termos">
                        <input type="checkbox" name="confirmar" id="confirmar" required>
                        <p>Ao clicar em "Aceitar", você confirma ter lido, compreendido e concordado com os <a href="#">Termos e Condições</a>. O não cumprimento destas diretrizes pode resultar na suspensão ou término da conta.</p>
                    </div>
                    <div class="botao">
                        <button type="button" onclick="voltar()" class="voltar"><i class="fa-solid fa-chevron-left"></i> Voltar</button>
                        <button type="submit" class="continuar"><i class="fa-solid fa-chevron-right"></i> Continuar</button>
                        <input type="hidden" name="mandar" value="yes">
                    </div>
                </div>
            </form>
        </div>
    </main>
</body>
<script>
    function entrar(){
        window.location.href="../index.php"
    }
    function voltar(){
        window.location.href="cadastro4.php"
    }
</script>
</html>
