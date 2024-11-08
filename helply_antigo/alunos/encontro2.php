<?php 
$menu = "comunicar";
include '../assets/include/header.php';

$mandar = $_POST['mandar'] ?? "";
if (!empty($mandar)){
    $titulo     = $_POST['titulo'];
    $data       = $_POST['data'];
    $conteudo   = $_POST['conteudo'];

    //user_cod 					INT,
    //reuniao_dt					VARCHAR(20),
    //reuniao_titulo				VARCHAR(200),
    //reuniao_desc				VARCHAR(200),
    //reuniao_status				VARCHAR(200),

    $sql = "INSERT INTO reunioes (user_cod, reuniao_dt, reuniao_titulo, reuniao_desc, reuniao_status)
            VALUES (?,?,?,?, 'Solicitada')";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "isss", $user_cod, $data, $titulo, $conteudo);
    mysqli_stmt_execute($stmt);

    echo "<script>window.location.href='encontro.php'</script>";
}
?>
<head>
    <link rel="stylesheet" href="assets/style/encontro2.css">
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
                    <input type="text" name="titulo" id="titulo" placeholder="Insira um título para a reunião ...">
                    <input type="date" name="data" id="data">
                </div>                
                <div class="sobre-registro">
                    <textarea name="conteudo" id="conteudo" placeholder="De uma breve descrição sobre oque deseja falar na reunião..."></textarea>
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
