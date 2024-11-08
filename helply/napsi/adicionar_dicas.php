<?php 
$menu = 'adicionar_dicas';
include '../assets/include/header.php';
?>
<head>
    <link rel="stylesheet" href="assets/style/adicionar_dicas.css">
</head>
<main>
    <div class="cabecalho-central">
        <div class="texto">
            <h1>Dicas</h1>
            <h2>Aqui você consegue gerenciar as dicas que os alunos visualizam</h2>
        </div>
    </div>
    <div class="container">
        <div class="top">
            <h2>Lista de dicas</h2>
            <button onclick="fnAdcionarDica()">Adicionar Dicas</button>
        </div>
        <table>
            <thead>
                <tr>
                    <th>TITULO</th>
                    <th>DATA CRIAÇÃO</th>
                    <th>QUANTIDADE LENDO</th>
                    <th>QUANTIDADE LIDOS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT * FROM dicas";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_execute($stmt);
                    $resultado = mysqli_stmt_get_result($stmt);
                    if(mysqli_num_rows($resultado) > 0){
                        while($row = mysqli_fetch_assoc($resultado)){


                ?>
                <tr>
                    <td><?=$row['dica_titulo']?></td>
                    <td><?=date('d/m/Y', strtotime($row['dica_dt_criacao']))?></td>
                    <td><?=$row['quantidade_lendo']?></td>
                    <td><?=$row['quantidade_leitors']?></td>
                </tr>
                <?php    }
                    } else {
                ?>
                    <h1>Nenhum comunicado</h1>
                <?php }?>
            </tbody>
        </table>
    </div>
</main>
<script>
    function fnAdcionarDica(){
        window.location.href="adicionar_dicas2.php"
    }
</script>