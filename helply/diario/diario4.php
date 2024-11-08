<?php $menu = 'diario'?>
<?php include '../assets/include/header.php';?>
<?php
$semana_cod = $_GET['semana_cod'];
$dia_semana = $_GET['dia_semana'];

// Verifica se já existe uma entrada para esta semana
$sql_semana = "SELECT * FROM semana_sequencial WHERE semana_id = ? AND user_cod = ?";
$stmt_semana = mysqli_prepare($conn, $sql_semana);
mysqli_stmt_bind_param($stmt_semana, "si", $semana_cod, $user_cod);
mysqli_stmt_execute($stmt_semana);
$result_semana = mysqli_stmt_get_result($stmt_semana);

if(mysqli_num_rows($result_semana) > 0){
    // Atualiza o dia da semana correspondente no banco de dados
    $update_semana = "UPDATE semana_sequencial SET $dia_semana = 1 WHERE semana_id = ? AND user_cod = ?";
    $stmt_update = mysqli_prepare($conn, $update_semana);
    mysqli_stmt_bind_param($stmt_update, "si", $semana_cod, $user_cod);
    mysqli_stmt_execute($stmt_update);
} else {
    // Se for o primeiro diário da semana, cria uma nova entrada
    $insert_semana = "INSERT INTO semana_sequencial (semana_id, user_cod, $dia_semana) VALUES (?, ?, 1)";
    $stmt_insert = mysqli_prepare($conn, $insert_semana);
    mysqli_stmt_bind_param($stmt_insert, "si", $semana_cod, $user_cod);
    mysqli_stmt_execute($stmt_insert);
}

// Seleciona novamente para exibir quais dias foram registrados
$sql_semana2 = "SELECT * FROM semana_sequencial WHERE semana_id = ? AND user_cod = ?";
$stmt_semana2 = mysqli_prepare($conn, $sql_semana2);
mysqli_stmt_bind_param($stmt_semana2, "si", $semana_cod, $user_cod);
mysqli_stmt_execute($stmt_semana2);
$result_semana = mysqli_stmt_get_result($stmt_semana2);
$semanasDias = mysqli_fetch_assoc($result_semana); // Obtém os dados da semana

// Dias da semana
$diasDaSemana = ['segunda' => 'Seg', 'terca' => 'Ter', 'quarta' => 'Qua', 'quinta' => 'Qui', 'sexta' => 'Sex', 'sabado' => 'Sáb', 'domingo' => 'Dom'];
?>
<head>
    <link rel="stylesheet" href="../assets/style/diario/diario4.css">
</head>
<main>
    <div class="cabecalho-central">
        <div class="texto">
            <h1>Diário</h1>
            <h2>ACOMPANHAMENTO DO SEU DIA-A-DIA</h2>
        </div>
        <div class="fogo">
            <img src="../assets/img/diario/fire.png" alt="Fogo">
            <span class="numero">1</span>
        </div>
    </div>
    <div class="conquista">
        <img src="../assets/img/diario/fire-big.png" alt="Fogo grande">
        <div class="dias">
            <span class="sequencia-dias">2</span>
            <span>dias</span>
        </div>
        <h1>de sequência</h1>
    </div>
    <div class="sequencia-semanal">
        <div class="resultados">
            <table>
                <thead>
                    <tr>
                        <?php foreach ($diasDaSemana as $key => $dia): ?>
                            <th class="<?= isset($semanasDias[$key]) && $semanasDias[$key] == 1 ? 'day-select' : 'normal-day' ?>">
                                <?= $dia ?>
                            </th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php foreach ($diasDaSemana as $key => $dia): ?>
                            <td>
                                <div class="<?= isset($semanasDias[$key]) && $semanasDias[$key] == 1 ? 'ball-select' : 'normal-ball' ?>">
                                    <?= isset($semanasDias[$key]) && $semanasDias[$key] == 1 ? '<img src="../assets/img/diario/check.png" alt="">' : '' ?>
                                </div>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                </tbody>
            </table>
            <div class="text">
                <p>Parabéns, você está em uma sequência de 2 dias</p>
            </div>
        </div>
    </div>
    <div class="opcoes">
        <div class="pincel">
            <img src="../assets/img/diario/pincel.png" alt="">
        </div>
        <button class="adicionar" onclick="voltar()" style="border: none; cursor: pointer;">
            <img src="../assets/img/diario/check.png" alt=""> PREENCHIDO
        </button>
    </div>
</main>
<script>
    function voltar(){
        window.location.href="diario2.php";
    }
</script>
</body>
</html>