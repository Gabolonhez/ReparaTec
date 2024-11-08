<?php 
$menu = "relacionar";
include '../assets/include/header.php';
?>
<head>
    <link rel="stylesheet" href="assets/style/relacionar.css">
</head>
<main>
        <div class="cabecalho-central">
            <div class="texto">
                <h1>Central de Relacionamentos</h1>
                <h2>Aqui você pode relacionar os professores aos alunos</h2>
            </div>
            <div class="fogo">
                <img src="../assets/img/diario/fire.png" alt="Fogo">
                <span class="numero">1</span>
            </div>
        </div>
        <div class="container">
            <h2>Escolha um professor</h2>
            <table>
                <thead>
                    <tr>
                        <th width="700">Nome</th>
                        <th>Quantidade de alunos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $sql_docentes = "SELECT * FROM docentes";
                        $stmt_docentes = mysqli_prepare($conn, $sql_docentes);
                        mysqli_stmt_execute($stmt_docentes);
                        $result_docentes = mysqli_stmt_get_result($stmt_docentes);

                        if(mysqli_num_rows($result_docentes) > 0){
                            while($row_docentes = mysqli_fetch_array($result_docentes)){
                                $nome_completo = $row_docentes['nome'].' '.$row_docentes['sobrenome'];
                                $professor_cod = $row_docentes['user_cod'];
                                
                                $sql_quantidade_alunos = "  SELECT	COUNT(*) AS qtd_alunos
                                                            FROM	alunos_professores
                                                            WHERE	professor_cod = ?";
                                $stmt_quantidade_alunos = mysqli_prepare($conn, $sql_quantidade_alunos);
                                mysqli_stmt_bind_param($stmt_quantidade_alunos, "i", $professor_cod);
                                mysqli_stmt_execute($stmt_quantidade_alunos);
                                $result_quantidade_alunos = mysqli_stmt_get_result($stmt_quantidade_alunos);
                                $row_quantidade_alunos = mysqli_fetch_array($result_quantidade_alunos);
                    ?>
                    <tr>
                        <td><a href="relacionar2.php?docente_cod=<?=$row_docentes['user_cod']?>"><?=$nome_completo?></a></td>
                        <td><a href="relacionar2.php?docente_cod=<?=$row_docentes['user_cod']?>"><?=$row_quantidade_alunos['qtd_alunos']?></a></td>
                    </tr>
                    <?php }
                    }?>
                </tbody>
            </table>
        </div>
    </main>