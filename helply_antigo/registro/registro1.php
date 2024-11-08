<?php 
$menu = "registro";
include '../assets/include/header.php';

$sql_tipo = "SELECT * FROM users WHERE user_cod = ?";
$stmt_tipo = mysqli_prepare($conn, $sql_tipo);
mysqli_stmt_bind_param($stmt_tipo, "i", $user_cod);
mysqli_stmt_execute($stmt_tipo);
$result_tipo= mysqli_stmt_get_result($stmt_tipo);
$row_tipo = mysqli_fetch_array($result_tipo);

$tipo_cadastro = $row_tipo['user_tp_conta'];
?>
<head>
    <link rel="stylesheet" href="../assets/style/registro/registro1.css">
</head>
    <main>
        <div class="cabecalho-central">
            <div class="texto">
                <h1>Registro</h1>
                <h2>Registro pessoal de estudo</h2>
            </div>
            <div class="fogo">
                <img src="../assets/img/diario/fire.png" alt="Fogo">
                <span class="numero">1</span>
            </div>
        </div>
        <div class="container">
            <div class="pesquisa">
                <input type="text" name="pesquisa" id="pesquisa" placeholder="Procure o texto que te interessa ...">
                <div class="imagem-lupa">
                    <img src="../assets/img/dicas/search.png" alt="Lupa">
                </div>
            </div>
            <div class="registros">
                <?php 
                    if ($tipo_cadastro == 'alunos'){
                        $sql = "SELECT * FROM registros WHERE aluno_cod = ? OR user_cod = ?";
                        $stmt = mysqli_prepare($conn, $sql);
                        mysqli_stmt_bind_param($stmt, "ii", $user_cod, $user_cod);
                        mysqli_stmt_execute($stmt);
                        $result= mysqli_stmt_get_result($stmt);
                    }

                    if ($tipo_cadastro == 'docentes'){
                        $sql = "SELECT * FROM registros WHERE docente_view = 1 OR user_cod = ?";
                        $stmt = mysqli_prepare($conn, $sql);
                        mysqli_stmt_bind_param($stmt, "i", $user_cod);
                        mysqli_stmt_execute($stmt);
                        $result= mysqli_stmt_get_result($stmt);
                    }

                    if ($tipo_cadastro == 'napsi'){
                        $sql = "SELECT * FROM registros";
                        $stmt = mysqli_prepare($conn, $sql);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt); 
                    }

                    if (mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                ?>
                <div class="registro">
                    <div class="text">
                        <?=$row['registro_total']?>
                    </div>
                    <div class="footer">
                        <div class="data">Fevereiro, 28, 2024</div>
                        <?php if($row['user_cod'] == $user_cod){ ?><div class="editar" onclick="fnEditar(<?=$row['registro_id']?>)"><img src="../assets/img/registro/pencil.png" alt="Lápis"></div><?php }?>
                    </div>
                </div>
                <?php }
                    } else {?>
                        <h1>Sem registros</h1>
                    <?php }?>
            </div>
        </div>
        <div class="opcoes">
            <div class="adicionar">
                <a href="registro2.php"><img src="../assets/img/diario/plus.png" alt="Mais"></a>
            </div>
        </div>
    </main>
    <script>
        function fnEditar(registro_id){
            window.location.href = "registro3.php?registro_id="+registro_id;
        }
    </script>
</body>
</html>