<?php
$menu = "comunicados";
include '../assets/include/header.php';
$email_id = $_GET['email_id'];

$sql = "SELECT * FROM emails WHERE email_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $email_id);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($resultado);

$mandar = $_POST['mandar'] ?? "";

if (!empty($mandar)){
    $resposta = $_POST['resposta'];

    $sql_insert = "INSERT INTO emails_respostas (email_cod, resposta_user, resposta_conteudo) VALUES (?,?,?)";
    $stmt_insert = mysqli_prepare($conn, $sql_insert);
    mysqli_stmt_bind_param($stmt_insert,"iis", $email_id, $user_cod, $resposta);
    mysqli_stmt_execute($stmt_insert);

    $update = "UPDATE emails SET email_status = 'Respondido' WHERE email_id = ?";
    $stmt_updt = mysqli_prepare($conn, $update);
    mysqli_stmt_bind_param($stmt_updt, "i", $email_id);
    mysqli_stmt_execute($stmt_updt);
}
?>
<head>
    <link rel="stylesheet" href="assets/style/responder_email.css">
</head>
<body>
<main>
    <div class="cabecalho-central">
        <div class="texto">
            <h1>Central de Comunicação</h1>
            <h2>Aqui você entra em contato com o NAPSI</h2>
        </div>
    </div>
    <div class="container">
        <div class="registro-informacoes">
            <div class="titulo">
                <input type="text" name="titulo" id="titulo" disabled value="<?=$row['email_titulo']?>">
            </div>
            <div class="motivo_comunicacao">
                <select name="motivo" id="motivo">
                    <option value="sem_controle">Aluno sem controle</option>
                </select>
            </div>
            <div class="sobre-registro">
                <textarea name="conteudo" id="conteudo" disabled><?=$row['email_conteudo']?></textarea>
            </div>
        </div>
    </div>
    <div class="btnResponder">
        <button onclick="fnResponder()"> Responder</button>
    </div>        
    <br><br>
    <div class="resposta_box" id="resposta_box" style="display: none;">
        <form action="<?=$_SERVER['PHP_SELF']?>?email_id=<?=$email_id?>" method="post">
            <input type="text" name="resposta" id="resposta" placeholder="Escreva aqui a resposta para o professor...">
            <input type="hidden" name="mandar" value="yes">
            <input type="submit" value="Mandar">
        </form>                
    </div>
</main>

<script>
    function fnResponder() {
        const resposta = document.getElementById("resposta_box");
        resposta.style.display = "block"; // Mostra o box ao clicar
    }
</script>
</body>
