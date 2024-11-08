<?php
$menu = 'feedback';
include '../assets/include/header.php';

$mandar = $_POST['mandar'] ?? "";

if(!empty($mandar)){
    $link       = $_POST['link'];
    $relato     = $_POST['relato'];

    $sql = "INSERT INTO suportes (user_cod, pg_link, suporte_titulo) VALUES (?,?,?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iss", $user_cod, $link, $relato);
    mysqli_stmt_execute($stmt);
}
?>


<head>
    <link rel="stylesheet" href="assets/style/suporte.css">
</head>
<main>
    <div class="cabecalho-central">
        <div class="texto">
            <h1>Suporte</h1>
            <h2>Conte-nos bugs que possam ter acontecido</h2>
        </div>
    </div>
    <div class="container">
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
            <div class="formulario">
                <div class="informacoes">
                    <input type="text" name="link" id="link" placeholder="Insira o link do programa">
                    <textarea name="relato" id="relato" placeholder="Digite aqui o relato do que está acontecendo"></textarea>
                </div>
                <input type="hidden" name="mandar" value="yes">
                <input type="submit" value="Enviar">
            </div>
        </form>
    </div>
</main>
</body>