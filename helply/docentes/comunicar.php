<?php
$menu = "comunicar";
include '../assets/include/header.php';
?>
<head>
    <link rel="stylesheet" href="assets/style/comunicar.css">
</head>
<main>
    <div class="cabecalho-central">
        <div class="texto">
            <h1>Central de Comunicação</h1>
            <h2>Aqui você entra em contato com o NAPSI</h2>
        </div>
    </div>
    <div class="container">
        <div class="top">
            <h2>Lista de comunicados</h2>
            <button onclick="abrirComunicado()">Novo comunicado</button>
        </div>
        <table>
            <thead>
                <tr>
                    <th>TITULO</th>
                    <th>DATA</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT	emails.*
                            FROM	emails
                            WHERE   email_remetente = ?";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "i", $user_cod);
                    mysqli_stmt_execute($stmt);
                    $resultado = mysqli_stmt_get_result($stmt);
                    if(mysqli_num_rows($resultado) > 0){
                        while($row = mysqli_fetch_assoc($resultado)){


                ?>
                <tr>
                    <td><?=$row['email_titulo']?></td>
                    <td><?=date('d/m/Y', strtotime($row['email_dt_envio']))?></td>
                    <td><?=$row['email_status']?></td>
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
    function abrirComunicado(){
        window.location.href="comunicar2.php";
    }
</script>