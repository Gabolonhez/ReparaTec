
<?php $menu = 'diario'?>
<?php include '../assets/include/header.php';?>
<?php

date_default_timezone_set('America/Sao_Paulo'); 
$diaAtual = date('j');
// $diaAtual = 8; 
$mesAtual = date('F');
$mes_para_o_banco = date('m');
$ano = date('Y');
$mandar = $_POST['mandar'] ?? "";


$semanal = "SELECT WEEK(CURDATE()) AS semana_atual;";
$semanam_stmt = mysqli_prepare($conn, $semanal);
mysqli_stmt_execute($semanam_stmt);
$resultado_semana = mysqli_stmt_get_result($semanam_stmt);
$resultado = mysqli_fetch_array($resultado_semana);
$semanaAtual = $resultado['semana_atual'];
$codigo_semana = $semanaAtual.'-'.$ano.'-'.$user_cod;
$diaSemana = date('l'); // Nome do dia da semana em inglês

$meses = [
    'January' => 'janeiro',
    'February' => 'fevereiro',
    'March' => 'março',
    'April' => 'abril',
    'May' => 'maio',
    'June' => 'junho',
    'July' => 'julho',
    'August' => 'agosto',
    'September' => 'setembro',
    'October' => 'outubro',
    'November' => 'novembro',
    'December' => 'dezembro'
];

$diasSemana = [
    'Sunday' => 'domingo',
    'Monday' => 'segunda',
    'Tuesday' => 'terca',
    'Wednesday' => 'quarta',
    'Thursday' => 'quinta',
    'Friday' => 'sexta',
    'Saturday' => 'sabado'
];

$diaSemana = $diasSemana[$diaSemana]; // Traduz o dia da semana
// $diaSemana = 'quinta';
$mesAtual = $meses[$mesAtual]; 

if(!empty($mandar)){
    $somatoria = $_POST['resultado'];
    $nota = $somatoria / 5;
    $sql_informations = "INSERT INTO dias_respondidos (user_cod, dia, mes, ano, form_finish, nota) VALUES (?,?,?,?,1,?)";
    $stmt_informations = mysqli_prepare($conn, $sql_informations);
    mysqli_stmt_bind_param($stmt_informations, "iiiii", $user_cod, $diaAtual, $mes_para_o_banco, $ano, $nota);
    mysqli_stmt_execute($stmt_informations);
    echo"<script>window.location.href='diario4.php?semana_cod=".$codigo_semana."&dia_semana=".$diaSemana."'</script>";
}

?>
<head>
    <link rel="stylesheet" href="../assets/style/diario/diario3.css">
    <style>
        .ativo {
            background-color: lightgray; /* Escolha a cor que deseja para o fundo do botão selecionado */
        }
    </style>
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
        <div class="caderno">
            <div class="capa">
                <div class="subcapa">
                    <div class="pagina">
                        <h2>Dia <?=$diaAtual?> de <?=$mesAtual?></h2>
                        <div class="respostas">
                        <div class="seu-dia" data-linha="1">
                            <h3>Como foi seu dia?</h3>
                                <div class="botoes-emoji">
                                    <button onclick="calcular(4, 1)"><img src="../assets/img/diario/smile-green.png" alt="Sorriso Verde"></button>
                                    <button onclick="calcular(3, 1)"><img src="../assets/img/diario/medium-face.png" alt="Sorriso Médio"></button>
                                    <button onclick="calcular(2, 1)"><img src="../assets/img/diario/normal-face.png" alt="Sorriso Normal"></button>
                                    <button onclick="calcular(1, 1)"><img src="../assets/img/diario/bad-face.png" alt="Sorriso Triste"></button>
                                    <button onclick="calcular(0, 1)"><img src="../assets/img/diario/angry.png" alt="Sorriso Bravo"></button>
                                </div>
                            </div>

                            <div class="seu-dia" data-linha="2">
                                <h3>Como foi seu dia?</h3>
                                <div class="botoes-emoji">
                                    <button onclick="calcular(4, 2)"><img src="../assets/img/diario/smile-green.png" alt="Sorriso Verde"></button>
                                    <button onclick="calcular(3, 2)"><img src="../assets/img/diario/medium-face.png" alt="Sorriso Médio"></button>
                                    <button onclick="calcular(2, 2)"><img src="../assets/img/diario/normal-face.png" alt="Sorriso Normal"></button>
                                    <button onclick="calcular(1, 2)"><img src="../assets/img/diario/bad-face.png" alt="Sorriso Triste"></button>
                                    <button onclick="calcular(0, 2)"><img src="../assets/img/diario/angry.png" alt="Sorriso Bravo"></button>
                                </div>
                            </div>
                            <div class="seu-dia" data-linha="3">
                                <h3>Como foi seu dia?</h3>
                                <div class="botoes-emoji">
                                    <button onclick="calcular(4, 3)"><img src="../assets/img/diario/smile-green.png" alt="Sorriso Verde"></button>
                                    <button onclick="calcular(3, 3)"><img src="../assets/img/diario/medium-face.png" alt="Sorriso Verde"></button>
                                    <button onclick="calcular(2, 3)"><img src="../assets/img/diario/normal-face.png" alt="Sorriso Verde"></button>
                                    <button onclick="calcular(1, 3)"><img src="../assets/img/diario/bad-face.png" alt="Sorriso Verde"></button>
                                    <button onclick="calcular(0, 3)"><img src="../assets/img/diario/angry.png" alt="Sorriso Verde"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="espiral">
                <div class="barra-vertical"></div>
                <div class="barra-horizontal"></div>
                <div class="barra-horizontal"></div>
                <div class="barra-horizontal"></div>
                <div class="barra-horizontal"></div>
                <div class="barra-horizontal"></div>
                <div class="barra-horizontal"></div>
                <div class="barra-horizontal"></div>
                <div class="barra-horizontal"></div>
                <div class="barra-horizontal"></div>
            </div>
            <div class="capa">
                <div class="subcapa">
                    <div class="pagina2">
                                <div class="respostas">
                                <div class="seu-dia" data-linha="4">
                                        <h3>Como foi seu dia?</h3>
                                        <div class="botoes-emoji">
                                            <button onclick="calcular(4, 4)"><img src="../assets/img/diario/smile-green.png" alt="Sorriso Verde"></button>
                                            <button onclick="calcular(3, 4)"><img src="../assets/img/diario/medium-face.png" alt="Sorriso Verde"></button>
                                            <button onclick="calcular(2, 4)"><img src="../assets/img/diario/normal-face.png" alt="Sorriso Verde"></button>
                                            <button onclick="calcular(1, 4)"><img src="../assets/img/diario/bad-face.png" alt="Sorriso Verde"></button>
                                            <button onclick="calcular(0, 4)"><img src="../assets/img/diario/angry.png" alt="Sorriso Verde"></button>
                                        </div>
                                    </div>
                                    <div class="seu-dia" data-linha="5">
                                        <h3>Como foi seu dia?</h3>
                                        <div class="botoes-emoji">
                                            <button onclick="calcular(4, 5)"><img src="../assets/img/diario/smile-green.png" alt="Sorriso Verde"></button>
                                            <button onclick="calcular(3, 5)"><img src="../assets/img/diario/medium-face.png" alt="Sorriso Verde"></button>
                                            <button onclick="calcular(2, 5)"><img src="../assets/img/diario/normal-face.png" alt="Sorriso Verde"></button>
                                            <button onclick="calcular(1, 5)"><img src="../assets/img/diario/bad-face.png" alt="Sorriso Verde"></button>
                                            <button onclick="calcular(0, 5)"><img src="../assets/img/diario/angry.png" alt="Sorriso Verde"></button>
                                        </div>
                                    </div>
                                </div>
                            <div class="observacao">
                                <h3>OBSERVAÇÃO</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="opcoes">
            <div class="pincel">
                <img src="../assets/img/diario/pincel.png" alt="">
            </div>
            <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                <button type="submit" class="adicionar" style="border: none; cursor: pointer;">
                    <img src="../assets/img/diario/check.png" alt="">
                    <input type="hidden" name="resultado" id="resultado" value="0">
                    <input type="hidden" name="mandar" value="yes">
                </button>
            </form>
        </div>
    </main>
    <script>
    // Objeto para armazenar as avaliações por linha
    let avaliacoes = {};

    function calcular(novoValor, linhaId) {
        const linha = document.querySelector(`[data-linha="${linhaId}"]`);

        // Seleciona o input de resultado
        const resultadoInput = document.getElementById("resultado");
        let resultadoAtual = parseInt(resultadoInput.value);

        // Verifica se já houve uma avaliação anterior nesta linha
        if (avaliacoes[linhaId] !== undefined) {
            // Subtrai o valor anterior
            resultadoAtual -= avaliacoes[linhaId];
        }

        // Atualiza a avaliação com o novo valor
        avaliacoes[linhaId] = novoValor;

        // Soma o novo valor
        resultadoAtual += novoValor;
        resultadoInput.value = resultadoAtual;

        // Permite que o usuário clique em outro emoji, mas só uma vez por linha
        const botoes = linha.querySelectorAll("button");
        botoes.forEach(botao => {
            botao.classList.remove("ativo"); // Remove a classe de emoji ativo (opcional para destacar o selecionado)
        });

        // Destaca o botão selecionado (opcional, para feedback visual)
        const botaoSelecionado = linha.querySelector(`button[onclick="calcular(${novoValor}, ${linhaId})"]`);
        botaoSelecionado.classList.add("ativo");
    }
</script>
</body>
</html>