<?php
$menu = "diario";
include '../assets/include/header.php';

// Pega o número de dias no mês atual
date_default_timezone_set('America/Sao_Paulo'); 
$mesAtual = date('n');
$anoAtual = date('Y');
$numeroDias = cal_days_in_month(CAL_GREGORIAN, $mesAtual, $anoAtual);

// Pega o número de dias do mês anterior
$mesAnterior = $mesAtual == 1 ? 12 : $mesAtual - 1;
$anoAnterior = $mesAtual == 1 ? $anoAtual - 1 : $anoAtual;
$diasMesAnterior = cal_days_in_month(CAL_GREGORIAN, $mesAnterior, $anoAnterior);

// Pega o dia da semana do primeiro dia do mês
$primeiroDiaSemana = date('w', strtotime("$anoAtual-$mesAtual-01"));

// Pega o dia atual
$diaAtual = date('j');
// $diaAtual = 3;
$mesAtualNum = date('n');
$anoAtualNum = date('Y');

// Array com os dias da semana
$diasSemana = ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'];
?>
<head>
    <link rel="stylesheet" href="../assets/style/diario/diario2.css">
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
    <div class="calendario">
        <div class="cabecalho-calendario">
            <span class="ano"><?= $anoAtual ?></span>
            <h3>Diário</h3>
        </div>
        <table>
            <thead>
                <tr>
                    <?php foreach ($diasSemana as $dia) : ?>
                        <th><?= $dia ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    // Preencher os dias do mês anterior (cor mais fraca)
                    for ($i = $primeiroDiaSemana - 1; $i >= 0; $i--) {
                        $diaAnterior = $diasMesAnterior - $i;
                        echo '<td class="fora-mes"><div class="dia">' . $diaAnterior . '</div></td>';
                    }

                    // Preencher os dias do mês atual
                    for ($dia = 1; $dia <= $numeroDias; $dia++) {
                        // Adicionar a classe "hoje" se o dia for o dia atual
                        $calendario = "SELECT * FROM dias_respondidos WHERE user_cod = ? AND dia = ? AND mes = ? AND ano = ?";
                        $stmt_calendario = mysqli_prepare($conn, $calendario);
                        mysqli_stmt_bind_param($stmt_calendario, "iiii", $user_cod, $dia, $mesAtual, $anoAtual);
                        mysqli_stmt_execute($stmt_calendario);
                        $humor = "";
                        $resultado_calendario = mysqli_stmt_get_result($stmt_calendario);
                        if (mysqli_num_rows($resultado_calendario) > 0){
                            $row = mysqli_fetch_array($resultado_calendario);
                            if ($row['nota'] == 4){
                                $humor = "smile-green";
                            }elseif ($row['nota'] == 3){
                                $humor = "medium-face";
                            }elseif ($row['nota'] == 2){
                                $humor = "normal-face";
                            }elseif ($row['nota'] == 1){
                                $humor = "bad-face";
                            }elseif ($row['nota'] == 0){
                                $humor = "angry";
                            }
                            echo '<td><div class="dia-feito">'.$dia.'<div class="img"><img src="../assets/img/diario/'.$humor.'.png" alt=""></div></div></td>';
                        }else{
                            if ($dia == $diaAtual && $mesAtual == $mesAtualNum && $anoAtual == $anoAtualNum){
                                echo '<td class="hoje"><a href="diario1.php"><div class="dia">' . $dia . '<div class="img"><img src="../assets/img/diario/plus.png" alt="Mais"></div></div></a></td>';
                            }else{
                                    echo '<td><div class="dia">' . $dia . '</div></td>';
                                }
                            }                        

                        // Quebra a linha no final de cada semana (Domingo-Sábado)
                        if (($dia + $primeiroDiaSemana) % 7 == 0) {
                            echo '</tr><tr>';
                        }
                    }

                    // Preencher os dias do próximo mês (cor mais fraca)
                    $diaSeguinte = 1;
                    while (($dia + $primeiroDiaSemana) % 7 != 1) {
                        echo '<td class="fora-mes"><div class="dia">' . $diaSeguinte . '</div></td>';
                        $diaSeguinte++;
                        $dia++;
                    }
                    ?>
                </tr>
            </tbody>
        </table>
    </div>
    
</main>
</body>
</html>
