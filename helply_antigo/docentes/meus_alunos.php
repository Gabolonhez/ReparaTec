<?php
$menu = "meus_alunos";

include '../assets/include/header.php';
?>
<head>
    <link rel="stylesheet" href="assets/style/meus_alunos.css">
</head>
<main>
    <div class="cabecalho-central">
        <div class="texto">
            <h1>Meus Alunos</h1>
            <h2>Verifique o cadastro dos seus alunos</h2>
        </div>
    </div>
    <div class="container">
        <div class="top">
            <h2>Lista de Alunos</h2>
        </div>
        <table>
            <thead>
                <tr>
                    <th>NOME</th>
                    <th>DATA NASCIMENTO</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT	alunos_professores.*, nome, sobrenome, user_dt_nascimento
                            FROM	alunos_professores
                            JOIN	alunos ON alunos.user_cod = alunos_professores.aluno_cod
                            JOIN	users ON users.user_cod = alunos_professores.aluno_cod";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_execute($stmt);
                    $resultado = mysqli_stmt_get_result($stmt);
                    if(mysqli_num_rows($resultado) > 0){
                        while($row = mysqli_fetch_assoc($resultado)){


                ?>
                <tr onclick="fnVisualizar()">
                    <td><?=$row['nome']." ".$row['sobrenome']?></td>
                    <td><?=$row['user_dt_nascimento']?></td>
                </tr>
                <?php    }
                    } else {
                ?>
                    <h1>Nenhum aluno</h1>
                <?php }?>
            </tbody>
        </table>
    </div>
</main>
</body>