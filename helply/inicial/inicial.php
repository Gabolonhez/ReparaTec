<?php
$menu = 'inicio';
include '../assets/include/header.php';

// Variável realmente esta grande, mas eu não tive outra ideia para o nome dela
$sql_verificar_aluno_leitura = "SELECT * FROM leituras WHERE aluno_cod = ?";
$stmt_verificar_aluno_leitura = mysqli_prepare($conn, $sql_verificar_aluno_leitura);
mysqli_stmt_bind_param($stmt_verificar_aluno_leitura, "i", $user_cod);
mysqli_stmt_execute($stmt_verificar_aluno_leitura);
$resultado_verificar_aluno_leitura = mysqli_stmt_get_result($stmt_verificar_aluno_leitura);
if (mysqli_num_rows($resultado_verificar_aluno_leitura) > 0){
    $titulo_dicas = "Leitura";
    $subtitulo_dicas = "Continue com as suas leituras";
    $ja_tem_leitura = True;
}else{
    $titulo_dicas = "Novidades";
    $subtitulo_dicas = "Aqui estão algumas novidades para que você possa ler";
    $ja_tem_leitura = False;
}
?>
<head>
    <link rel="stylesheet" href="../assets/style/dicas/dicas1.css">
    <link rel="stylesheet" href="style.css">
</head>
    <main>
        <div class="cabecalho-central">
            <div class="texto">
                <h1><?=$titulo_dicas?></h1>
                <h2><?=$subtitulo_dicas?></h2>
            </div>
        </div>
        <div class="pesquisa">
            <input type="text" name="pesquisa" id="pesquisa" placeholder="Procure o texto que te interessa ...">
            <div class="imagem-lupa">
                <img src="../assets/img/dicas/search.png" alt="Lupa">
            </div>
        </div>
        <!-- AQUI ESTÁ AS LEITURAS QUE O USUÁRIO FEZ OU NOVAS LEITURAS -->
         <?php
            if ($ja_tem_leitura){
                $sql_leitura = "SELECT		*, dicas.*
                                FROM		leituras
                                JOIN		dicas ON dicas.dica_id = leituras.dica_cod
                                WHERE		aluno_cod = ?
                                ORDER BY 	ultimo_acesso_do_aluno DESC
                                LIMIT 1";
                $stmt_leitura = mysqli_prepare($conn, $sql_leitura);
                mysqli_stmt_bind_param($stmt_leitura, "i", $user_cod);
                mysqli_stmt_execute($stmt_leitura);

                $resultado_leitura = mysqli_stmt_get_result($stmt_leitura);
            }else{
                $sql_leitura = "SELECT		*
                                FROM		dicas
                                ORDER BY 	dica_dt_criacao DESC
                                LIMIT		1";
                $stmt_leitura = mysqli_prepare($conn, $sql_leitura);
                mysqli_stmt_execute($stmt_leitura);

                $resultado_leitura = mysqli_stmt_get_result($stmt_leitura);
            }
            
            if (mysqli_num_rows($resultado_leitura) > 0){
                while($row_leitura = mysqli_fetch_assoc($resultado_leitura)){
            
         ?>
            <div class="resultado-pesquisa">
                <div class="tdah">
                    <div class="space">
                        &nbsp;
                    </div>
                    <div class="text">
                        <div class="informacao">
                            <h1><?=$row_leitura['dica_titulo']?></h1>
                            <p><?=$row_leitura['dica_conteudo']?></p>
                        </div>
                        <div class="saiba-mais">
                            <button onclick="fnLer('<?=$row_leitura['dica_id']?>')"> <i class="fa-solid fa-chevron-left"></i>Saiba mais</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php            
                }
            }
            ?>

            <div class="menus">
                <div class="registro" onclick="fnRegistro()">
                    <img src="../assets/img/inicial/registro.png" alt="imagem registro">
                    <h2>Registro</h2>
                </div>
                <div class="turma">
                    <img src="../assets/img/inicial/turma.png" alt="imagem Turma">
                    <h2>Turma</h2>
                </div>
                <div class="diario">
                    <img src="../assets/img/inicial/diario.png" alt="imagem registro">
                    <h2>Diário</h2>
                </div>
                <div class="encontros">
                    <img src="../assets/img/inicial/encontros.png" alt="imagem Turma">
                    <h2>Encontros</h2>
                </div>
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
<script>
    function fnLer(leitura_cod){
        window.location.href="../dicas/dicas2.php?dica_id="+leitura_cod
    }

    function fnRegistro(){
        window.location.href="../registro/registro1.php";
    }
</script>
</html>