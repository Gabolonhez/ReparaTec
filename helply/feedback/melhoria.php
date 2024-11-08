<?php
$menu = 'feedback';
include '../assets/include/header.php';

$mandar = $_POST['mandar'] ?? "";

if(!empty($mandar)){
    $titulo       = $_POST['titulo'];
    $melhoria     = $_POST['melhoria'];

    $sql = "INSERT INTO melhorias (user_cod, melhoria_titulo, melhoria_conteudo) VALUES (?,?,?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iss", $user_cod, $titulo, $melhoria);
    mysqli_stmt_execute($stmt);
}
?>


<head>
    <link rel="stylesheet" href="assets/style/melhoria.css">
</head>
<main>
    <div class="cabecalho-central">
        <div class="texto">
            <h1>Melhoria</h1>
            <h2>Conte-nos oque podemos fazer para melhorar dentro do sistema</h2>
        </div>
    </div>
    <div class="container">
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
            <div class="formulario">
                <div class="informacoes">
                    <input type="text" name="titulo" id="titulo" placeholder="Insira o titulo para a melhoria">
                    <textarea name="melhoria" id="melhoria" placeholder="Descreva melhor oque podemos melhorar"></textarea>
                </div>
                <input type="hidden" name="mandar" value="yes">
                <input type="submit" value="Enviar">
            </div>
        </form>
    </div>
</main>
</body>