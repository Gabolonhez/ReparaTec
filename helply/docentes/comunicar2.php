<?php 
$menu = "comunicar";
include '../assets/include/header.php';

$mandar = $_POST['mandar'] ?? "";
if (!empty($mandar)){
    $titulo = $_POST['titulo'];
    $motivo = $_POST['motivo'];
    $conteudo = $_POST['conteudo'];

    $sql = "INSERT INTO emails (email_remetente, email_titulo, email_motivo, email_conteudo, email_status)
            VALUES (?,?,?,?, 'Enviado')";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "isss", $user_cod, $titulo, $motivo, $conteudo);
    mysqli_stmt_execute($stmt);

    echo "<script>window.location.href='comunicar.php'</script>";
}
?>
<head>
    <link rel="stylesheet" href="assets/style/comunicar2.css">
</head>
<body>
    <main>
        <div class="cabecalho-central">
            <div class="texto">
                <h1>Central de comunicação</h1>
                <h2>Aqui você entra em contato com o NAPSI</h2>
            </div>
        </div>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
        <div class="container">
            <div class="registro-informacoes">
                <div class="titulo">
                    <input type="text" name="titulo" id="titulo" placeholder="Insira um título ...">
                </div>
                <?php if ($row_information['user_tp_conta'] == 'docentes'){ ?>
                    <div class="motivo_comunicacao">
                        <select name="motivo" id="motivo">
                            <option value="" disabled selected>Selecione o motivo da comunicação</option>
                            <option value="sem_controle">Aluno sem controle</option>
                        </select>
                    </div>
                <?php }?>
                <div class="sobre-registro">
                    <textarea name="conteudo" id="conteudo" placeholder="Escreva oque esta acontecendo ..."></textarea>
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
