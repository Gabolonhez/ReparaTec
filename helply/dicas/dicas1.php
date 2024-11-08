<?php 
$menu = 'dicas';
include '../assets/include/header.php';
?>
<head>
    <link rel="stylesheet" href="../assets/style/dicas/dicas1.css">
</head>
    <main>
        <div class="cabecalho-central">
            <div class="texto">
                <h1>Dicas</h1>
                <h2>Onde você pode ler e descobrir sobre si</h2>
            </div>
        </div>
        <div class="pesquisa">
            <input type="text" name="pesquisa" id="pesquisa" placeholder="Procure o texto que te interessa ...">
            <div class="imagem-lupa">
                <img src="../assets/img/dicas/search.png" alt="Lupa">
            </div>
        </div>
        <div class="resultado-pesquisa">
            <div class="tdah">
                <div class="space">
                    &nbsp;
                </div>
                <div class="text">
                    <div class="informacao">
                        <h1>TDAH Explicado</h1>
                        <p>O TDAH é um distúrbio neurobiológico caracterizado por sintomas de desatenção, hiperatividade e impulsividade</p>
                    </div>
                    <div class="saiba-mais">
                        <button> <i class="fa-solid fa-chevron-left"></i>Saiba mais</button>
                    </div>
                </div>
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
</html>