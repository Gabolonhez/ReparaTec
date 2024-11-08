<?php
$menu = "encontro";
include '../assets/include/header.php';
?>
<head>
    <link rel="stylesheet" href="assets/style/encontro.css">
</head>
<main>
    <div class="cabecalho-central">
        <div class="texto">
            <h1>Agendar Reunião</h1>
            <h2>Aqui você consegue agendar sua reunião com o NAPSI</h2>
        </div>
    </div>
    <div class="container">
    <div class="container">
        <div class="top">
            <h2>Suas reuniões</h2>
            <button onclick="fnNovaReuniao()">Nova reunião</button>
        </div>
        <table>
            <thead>
                <tr>
                    <th>TITULO REUNIÃO</th>
                    <th>DATA</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT	*
                            FROM	reunioes
                            WHERE   user_cod = ?";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "i", $user_cod);
                    mysqli_stmt_execute($stmt);
                    $resultado = mysqli_stmt_get_result($stmt);
                    if(mysqli_num_rows($resultado) > 0){
                        while($row = mysqli_fetch_assoc($resultado)){


                ?>
                <tr>
                    <td><?=$row['reuniao_titulo']?></td>
                    <td><?=$row['reuniao_dt']?></td>
                    <td><?=$row['reuniao_status']?></td>
                </tr>
                <?php    }
                    } else {
                ?>
                    <h1>Nenhuma reunião encontrada</h1>
                <?php }?>
                
            </tbody>
        </table>
    </div>
    </div>
</main>
<script>
    function fnNovaReuniao(){
        window.location.href="encontro2.php";
    }
</script>

