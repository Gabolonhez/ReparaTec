<?php include '../include/conexao.php'; ?>
<?php
session_start();
$email_session = $_SESSION['email']; 
$pg_atual = "cadastro4.php";

// Consultar o usuário
$sql_email = "SELECT * FROM users WHERE user_email = ?";
$stmt_email = mysqli_prepare($conn, $sql_email);
mysqli_stmt_bind_param($stmt_email, "s", $email_session);
mysqli_stmt_execute($stmt_email);
$result_email = mysqli_stmt_get_result($stmt_email);
$row = mysqli_fetch_assoc($result_email);

// Armazenar o código do usuário na sessão
$_SESSION['cod'] = $row['user_cod'];

$mandar = $_POST['mandar'] ?? "";
$tipo_cadastro = $_POST['escolha'] ?? "";

if (!empty($mandar)){
    // Atualizar tipo de cadastro no banco de dados
    $sql = "UPDATE users SET user_tp_conta = ?, register_level = ? WHERE user_cod = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssi", $tipo_cadastro, $pg_atual, $_SESSION['cod']);

    if (mysqli_stmt_execute($stmt)) {
        // Atualização bem-sucedida, redirecionar para a próxima etapa
        header("Location: cadastro5.php");
        exit();
    } else {
        // Erro na execução da atualização
        echo "<script>alert('Erro ao atualizar os dados: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar conta</title>
    <link rel="stylesheet" href="../assets/style/cadastro/cadastro4.css">
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
                <h2>Queremos saber mais sobre você</h2>
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
                <div class="traco3"></div>
                <div class="pessoal">
                    <span class="ball"></span>
                    <p class="text">ACEITE</p>
                </div>
            </div>
            <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                <div class="form">
                    <div class="item">
                        <input type="radio" name="escolha" id="alunos" value="alunos" required <?php if($row['user_tp_conta'] == 'alunos'){ ?>checked<?php }?>>
                        <label for="alunos">
                            <div class="opcao">
                                <div class="informacao">
                                    <img src="../assets/img/cadastro/aluno 1.png" alt="Aluno">
                                    <div class="text">
                                        <h3>Sou um estudante</h3>
                                        <p>Alunos em busca de autoconhecimento e orientação para otimizar sua experiência acadêmica</p>
                                    </div>
                                </div>
                                <span class="custom-radio"></span>
                            </div>
                        </label>
                    </div>
                    <div class="item">
                        <input type="radio" name="escolha" id="docentes" value="docentes" required <?php if($row['user_tp_conta'] == 'docentes'){ ?>checked<?php }?>>
                        <label for="docentes">
                            <div class="opcao">
                                <div class="informacao">
                                    <img src="../assets/img/cadastro/professor 2.png" alt="Professor">
                                    <div class="text">
                                        <h3>Sou um professor</h3>
                                        <p>Educadores responsáveis por lecionar a alunos com diversas neurotipicidades.</p>
                                    </div>
                                </div>
                                <span class="custom-radio"></span>
                            </div>
                        </label>
                    </div>
                    <div class="item">
                        <input type="radio" name="escolha" id="napsi" value="napsi" required <?php if($row['user_tp_conta'] == 'napsi'){ ?>checked<?php }?>>
                        <label for="napsi">
                            <div class="opcao">
                                <div class="informacao">
                                    <img src="../assets/img/cadastro/profissional.png" alt="Profissional da Saúde">
                                    <div class="text">
                                        <h3>Sou um profissional da Saúde</h3>
                                        <p>Profissionais da saúde dedicados a oferecer aconselhamento e suporte emocional aos usuários.</p>
                                    </div>
                                </div>
                                <span class="custom-radio"></span>
                            </div>
                        </label>
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
        window.location.href="cadastro3.php?function=upt"
    }
</script>
</html>
