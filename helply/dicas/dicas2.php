<?php 
$menu = 'dicas';
include '../assets/include/header.php';

$dica_id = $_GET['dica_id'];

// PEGA A DATA ATUAL
date_default_timezone_set('America/Sao_Paulo'); 
$hoje = date("Y-m-d H:i:s"); 

// LEITURA
$sql_dicas = "SELECT * FROM dicas WHERE dica_id = ?";
$stmt_dicas = mysqli_prepare($conn, $sql_dicas);
mysqli_stmt_bind_param($stmt_dicas, "i", $dica_id);
mysqli_stmt_execute($stmt_dicas);
$resultado_dicas = mysqli_stmt_get_result($stmt_dicas);
$row_dicas = mysqli_fetch_assoc($resultado_dicas);

// QUANTIDADE DE LEITORES DA DICAS
$quantidade_leitores = $row_dicas['quantidade_lendo'];
$quantidade_leitores_atualizada = $quantidade_leitores + 1;

$sql_ja_tem_leitura = "SELECT * FROM leituras WHERE dica_cod = ? AND aluno_cod = ?";
$stmt_ja_tem_leitura = mysqli_prepare($conn, $sql_ja_tem_leitura);
mysqli_stmt_bind_param($stmt_ja_tem_leitura, "ii", $dica_id, $user_cod);
mysqli_stmt_execute($stmt_ja_tem_leitura);
$resultado_ja_tem_leitura = mysqli_stmt_get_result($stmt_ja_tem_leitura);
$row_ja_tem_leitura = mysqli_fetch_assoc($resultado_ja_tem_leitura);


$leitura_cod = $row_ja_tem_leitura['leitura_cod'] ?? 0;


if (mysqli_num_rows($resultado_ja_tem_leitura) > 0){
    $sql_update_leitura = "UPDATE leituras SET ultimo_acesso_do_aluno = ? WHERE leitura_cod = ?";
    $stmt_update_leitura = mysqli_prepare($conn, $sql_update_leitura);
    mysqli_stmt_bind_param($stmt_update_leitura, "si", $hoje, $leitura_cod);
    mysqli_stmt_execute($stmt_update_leitura);
}else{
    $sql_insert_leitura = "INSERT INTO leituras (aluno_cod, leitura_inicio, dica_cod, ultimo_acesso_do_aluno)
    VALUES (?,?,?,?)";
    $stmt_insert_leitura = mysqli_prepare($conn, $sql_insert_leitura);
    mysqli_stmt_bind_param($stmt_insert_leitura, "isis", $user_cod, $hoje, $dica_id, $hoje);
    mysqli_stmt_execute($stmt_insert_leitura);

    $sql_update_dicas = "UPDATE dicas SET quantidade_lendo = ? WHERE dica_id = ?";
    $stmt_update_dicas = mysqli_prepare($conn, $sql_update_dicas);
    mysqli_stmt_bind_param($stmt_update_dicas, "ii", $quantidade_leitores_atualizada, $dica_id);
    mysqli_stmt_execute($stmt_update_dicas);
}
?>
<head>
    <link rel="stylesheet" href="../assets/style/dicas/dicas2.css">
</head>
    <main>
        <div class="cabecalho-central">
            <div class="texto">
                <h1>Dicas</h1>
                <h2>Onde você pode ler e descobrir sobre si</h2>
            </div>
        </div>
        <div class="resumo-central">
            <h1><?=$row_dicas['dica_titulo']?></h1>
            <p>03 de março 2024</p>
            <img src="../assets/img/dicas/livrocabeca.png" alt="Menino com livro na cabeça">
            <h3>Introdução</h3>
            <p><?=$row_dicas['dica_conteudo']?></p>
        </div>
    </main>
    <aside class="menu-lateral">
        <div class="lateral-direita">
            <div class="item">
                <h1>Calendário</h1>
                <div class="dias">
                    <p>March</p>
                    <table>
                        <thead>
                            <tr>
                                <th>03</th>
                                <th>Seg</th>
                                <th>Ter</th>
                                <th>Qua</th>
                                <th>Qui</th>
                                <th>Sex</th>
                                <th class="final-semana">Sab</th>
                                <th class="final-semana">Dom</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="contagem-semanal">9</td>
                                <td>26</td>
                                <td>27</td>
                                <td>28</td>
                                <td>29</td>
                                <td class="mes-atual">1</td>
                                <td class="final-semana">2</td>
                                <td class="final-semana">3</td>
                            </tr>
                            <tr>
                                <td class="contagem-semanal">10</td>
                                <td class="mes-atual">4</td>
                                <td class="mes-atual">5</td>
                                <td class="mes-atual">6</td>
                                <td class="mes-atual">7</td>
                                <td class="mes-atual">8</td>
                                <td class="final-semana">9</td>
                                <td class="final-semana">10</td>
                            </tr>
                            <tr>
                                <td class="contagem-semanal">11</td>
                                <td class="mes-atual">11</td>
                                <td class="mes-atual">12</td>
                                <td class="mes-atual">13</td>
                                <td class="mes-atual">14</td>
                                <td class="mes-atual">15</td>
                                <td class="final-semana">16</td>
                                <td class="final-semana">17</td>
                            </tr>
                            <tr>
                                <td class="contagem-semanal">12</td>
                                <td class="mes-atual">18</td>
                                <td class="mes-atual">19</td>
                                <td class="mes-atual">20</td>
                                <td class="mes-atual">21</td>
                                <td class="mes-atual">22</td>
                                <td class="final-semana">23</td>
                                <td class="final-semana">24</td>
                            </tr>
                            <tr>
                                <td class="contagem-semanal">13</td>
                                <td class="mes-atual">25</td>
                                <td class="mes-atual">26</td>
                                <td class="mes-atual">27</td>
                                <td class="mes-atual">28</td>
                                <td class="mes-atual">29</td>
                                <td class="final-semana">30</td>
                                <td class="final-semana">31</td>
                            </tr>
                            <tr>
                                <td class="contagem-semanal">14</td>
                                <td>1</td>
                                <td>2</td>
                                <td>3</td>
                                <td>4</td>
                                <td>5</td>
                                <td class="final-semana-outro-mes">6</td>
                                <td class="final-semana-outro-mes">7</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="item">
                <h1>Pendencias</h1>
            </div>
        </div>
    </aside>
</body>
</html>