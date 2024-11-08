<?php
$menu = "alunos";

include '../assets/include/header.php';

$aluno_cod = $_GET['aluno_cod'];

$sql_aluno = "  SELECT 	*, users.*
                FROM 	alunos
                JOIN	users ON alunos.user_cod = users.user_cod 
                WHERE 	alunos.user_cod = ?";
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
        <div class="informacoes">
            <span><b>Nome:</b> <?=$row_aluno['nome']." ".$row_aluno['sobrenome']?></span>
            <span><b>CPF:</b> <?=$row_aluno['user_cpf']?></span>
            <span><b>Email</b> <?=$row_aluno['user_email']?></span>
            <span><b>Último acesso:</b> <?=$row_aluno['ultimo_acesso']?></span>
        </div>
        <div class="historico">
            <h2>Histórico de reuniões</h2>
            <table>
                <thead>
                    <tr>
                        <th>Motivo</th>
                        <th>Dia</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql_reuniao = "SELECT * FROM reunioes WHERE user_cod = ?";
                        $stmt_reuniao = mysqli_prepare($conn, $sql_reuniao);
                        mysqli_stmt_bind_param($stmt_reuniao, "i", $aluno_cod);
                        mysqli_stmt_execute($stmt_reuniao);
                        $resultado_reuniao = mysqli_stmt_get_result($stmt_reuniao);
                        while($row_reuniao = mysqli_fetch_assoc($resultado_reuniao)){
                    ?>
                    <tr>
                        <td><?=$row_reuniao['reuniao_titulo']?></td>
                        <td><?= date('d/m/Y', strtotime($row_reuniao['reuniao_dt'])) ?></td>
                        <td><?=$row_reuniao['reuniao_status']?></td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
        <div class="relatorios">
            <button onclick="fnRelatorioCalendario(<?=$aluno_cod?>)">Relatório Calendário</button>
        </div>
    </div>
</main>
<script>
    function fnRelatorioCalendario(aluno_cod){
        window.location.href="../relatorios/calendario.php?aluno_cod="+aluno_cod;
    }
</script>

