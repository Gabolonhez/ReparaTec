<?php
include '../include/conexao.php';

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

$nome_completo = $row_aluno['nome']." ".$row_aluno['sobrenome'];

date_default_timezone_set('America/Sao_Paulo');
$hoje = date("d/m/Y H:i")
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style/calendario.css">
    <title>Calendário - <?=$nome_completo?></title>
</head>
<body>
    <header>
        <span><b>Nome:</b> <?=$row_aluno['nome']." ".$row_aluno['sobrenome']?></span>
        <span><b>CPF:</b> <?=$row_aluno['user_cpf']?></span>
        <span><b>Data de Impressão:</b> <?=$hoje?></span>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Nota (Máx: 5)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql_calendario = "SELECT * FROM dias_respondidos WHERE user_cod = ?";
                $stmt_calendario = mysqli_prepare($conn, $sql_calendario);
                mysqli_stmt_bind_param($stmt_calendario, "i", $aluno_cod);
                mysqli_stmt_execute($stmt_calendario);
                $resultado_calendario = mysqli_stmt_get_result($stmt_calendario);
                while($row_calendario = mysqli_fetch_assoc($resultado_calendario)){
                    if (strlen($row_calendario['dia']) < 2) {
                        $dia = "0" . $row_calendario['dia'];
                    }else{
                        $dia = $row_calendario['dia'];
                    }
                    $dia_completo = $dia."/".$row_calendario['mes']."/".$row_calendario['ano']
                ?>
                <tr class="dias">
                    <td><?=$dia_completo?></td>
                    <td><span <?php if ($row_calendario['nota'] < 4) {?>style="color: red;" <?php }?>><?=$row_calendario['nota']?></span></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </main>
</body>
</html>