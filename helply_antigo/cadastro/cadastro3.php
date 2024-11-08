<?php include '../include/conexao.php';?>
<?php
session_start();
$email_session = $_SESSION['email']; 
$function = $_GET['function'] ?? "";
$pg_atual = "cadastro3.php";

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
$data_nascimento = $_POST['data_nascimento'] ?? $row['user_dt_nascimento'] ?? ""; // Corrigido para corresponder ao nome do campo
$cpf = $_POST['cpf'] ?? $row['user_cpf'] ?? "";
$telefone = $_POST['telefone'] ?? $row['user_telefone'] ?? "";
$genero = $_POST['genero'] ?? $row['user_genero'] ??"";



if (!empty($mandar)){
    $cpf_formatado = str_replace(['.', '-'], '', $cpf);

    // Comando de atualização
    $sql = "UPDATE users SET user_dt_nascimento = ?, user_telefone = ?, user_genero = ?, user_cpf = ?, register_level = ? WHERE user_cod = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssssi", $data_nascimento, $telefone, $genero, $cpf_formatado, $pg_atual, $_SESSION['cod']); // Alterado para usar $_SESSION['cod']
    
    if (mysqli_stmt_execute($stmt)) {
        // Atualização bem-sucedida
        echo "<script>window.location.href='cadastro4.php';</script>";
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
    <link rel="stylesheet" href="../assets/style/cadastro/cadastro3.css">
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
                <div class="traco2"></div>
                <div class="pessoal">
                    <span class="ball"></span>
                    <p class="text">PERFIL</p>
                </div>
                <div class="traco3"></div>
                <div class="pessoal">
                    <span class="ball"></span>
                    <p class="text">ACEITE</p>
                </div>
            </div>
            
            <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                <div class="form">
                    <div class="form1">
                        <label>
                            Data de nascimento <br>
                            <input type="text" name="data_nascimento" id="data" placeholder="12/05/2003" required value="<?=$data_nascimento?>">
                        </label>
                        <label>
                            CPF <br>
                            <input type="text" name="cpf" id="cpf" placeholder="123.456.789-99" required value="<?=$cpf?>">
                        </label>
                    </div>
                    <div class="telefone">
                        <label>
                            Telefone <br>
                            <input type="text" name="telefone" id="telefone" placeholder="(DDD) Telefone" required value="<?=$telefone?>">
                        </label>
                    </div>
                    <div class="genero">
                        <label>
                            Gênero <br>
                            <input type="text" name="genero" id="genero" placeholder="Masculino" required value="<?=$genero?>">
                        </label>
                    </div>
                    <div class="botao">
                        <button type="button" onclick="voltar('upt')" class="voltar"><i class="fa-solid fa-chevron-left"></i> Voltar</button>
                        <button type="submit" class="continuar"> <i class="fa-solid fa-chevron-right"></i> Continuar</button>
                        <input type="hidden" name="mandar" value="yes">
                    </div>
                </div>
            </form>
        </div>
    </main>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
    function entrar(){
        window.location.href="../index.php";
    }

    function voltar(funcao){
        window.location.href="cadastro2.php?function="+funcao;
    }
    
    $(document).ready(function(){
        $('#data').mask('00/00/0000'); // Máscara para data
        $('#telefone').mask('(00) 00000-0000'); // Máscara para telefone
        $('#cpf').mask('000.000.000-00', {reverse: true}); // Máscara para CPF
    });
</script>
</html>
