<?php
$menu = "alunos";

include '../assets/include/header.php';

$aluno_cod = $_GET['aluno_cod'];

$sql_aluno = "SELECT * FROM alunos WHERE user_cod = ?";
$stmt_aluno = mysqli_prepare($conn, $sql_aluno);
mysqli_stmt_bind_param($stmt_aluno, "i", $aluno_cod);
mysqli_stmt_execute($stmt_aluno);
$resultado_aluno = mysqli_stmt_get_result($stmt_aluno);
$row_aluno = mysqli_fetch_assoc($resultado_aluno);
?>
<head>
    <link rel="stylesheet" href="assets/style/alunos.css">
</head>
<main>
    <div class="cabecalho-central">
        <div class="texto">
            <h1>Gerenciar Alunos</h1>
            <h2>Aqui você consegue gerenciar os alunos</h2>
        </div>
    </div>
    <div class="container">
        Nome: <?=$row_aluno['nome']." ".$row_aluno['sobrenome']?>

        <div class="relatorios">
            <button onclick="fnRelatorioCalendario(<?=$aluno_cod?>)">Relatório Calendário</button>
        </div>
    </div>
</main>
<script>
    function fnRelatorioCalendario(aluno_cod){
        window.location.href=""+aluno_cod;
    }
</script>

