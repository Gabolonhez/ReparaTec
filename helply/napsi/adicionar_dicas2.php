<?php
$menu = 'adicionar_dicas';
include '../assets/include/header.php';

$mandar = $_POST['mandar'] ?? "";

if (!empty($mandar)){
    $dica_titulo    = $_POST['dica_titulo'];
    $dica_conteudo  = $_POST['dica_conteudo'];

    $sql = "INSERT INTO dicas (dica_titulo, dica_conteudo) VALUES (?,?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $dica_titulo, $dica_conteudo);
    mysqli_stmt_execute($stmt);
    echo "<script>window.location.href='adicionar_dicas.php'</script>";
}
?>

<head>
    <link rel="stylesheet" href="assets/style/adicionar_dicas2.css">
</head>
<body>
    <main>
        <div class="cabecalho-central">
            <div class="texto">
                <h1>Adicionar dica</h1>
                <h2>Adicione dicas para que os alunso leiam</h2>
            </div>
        </div>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
        <div class="container">
            <div class="registro-informacoes">
                <div class="titulo">
                    <input type="text" name="dica_titulo" id="dica_titulo" placeholder="Insira um título ...">
                </div>
                <div class="sobre-registro">
                    <textarea name="dica_conteudo" id="dica_conteudo" placeholder="Esreva o texto para a dica..."></textarea>
                </div>
                <div class="botao-enviar">
                    <input type="hidden" name="mandar" value="yes">
                    <button type="submit">Enviar</button>
                </div>
            </div>
        </div>
        </form>
    </main>
</body>
