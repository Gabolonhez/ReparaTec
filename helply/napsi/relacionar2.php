<?php 
$menu = "relacionar";
include '../assets/include/header.php';
$docente_cod = $_GET['docente_cod'];

$sql_docente = "SELECT * FROM docentes WHERE user_cod = ?";
$stmt_docente = mysqli_prepare($conn, $sql_docente);
mysqli_stmt_bind_param($stmt_docente, "i", $docente_cod);
mysqli_stmt_execute($stmt_docente);
$result_docente = mysqli_stmt_get_result($stmt_docente);
$row_docente = mysqli_fetch_array($result_docente);

$nome_completo = $row_docente['nome']." ".$row_docente['sobrenome'];

$sql_quantidade_alunos = "  SELECT	COUNT(*) AS qtd_alunos
                            FROM	alunos_professores
                            WHERE	professor_cod = ?";
$stmt_quantidade_alunos = mysqli_prepare($conn, $sql_quantidade_alunos);
mysqli_stmt_bind_param($stmt_quantidade_alunos, "i", $docente_cod);
mysqli_stmt_execute($stmt_quantidade_alunos);
$result_quantidade_alunos = mysqli_stmt_get_result($stmt_quantidade_alunos);
$row_quantidade_alunos = mysqli_fetch_array($result_quantidade_alunos);

$mandar = $_POST['mandar'] ?? "";

if (!empty($mandar)){
    $aluno_cod = $_POST['aluno_cod'];
    
    $sql = "INSERT INTO alunos_professores (professor_cod, aluno_cod) VALUES (?,?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $docente_cod, $aluno_cod);
    mysqli_stmt_execute($stmt);

    echo "<script>window.location.href='relacionar2.php?docente_cod=".$docente_cod."'</script>";
}
?>
<head>
    <link rel="stylesheet" href="assets/style/relacionar2.css">
</head>
<main>
    <div class="cabecalho-central">
        <div class="texto">
            <h1>Central de Relacionamentos</h1>
            <h2>Aqui você pode relacionar os professores aos alunos</h2>
        </div>
        <div class="fogo">
            <img src="../assets/img/diario/fire.png" alt="Fogo">
            <span class="numero">1</span>
        </div>
    </div>
    <div class="container">
        <div class="informacoes-docente">
            <h3>Professor: <span class="inf-banco"><?=$nome_completo?></span></h3>
            <h3>Quantidade Alunos: <span class="inf-banco"><?=$row_quantidade_alunos['qtd_alunos']?></span></h3>
        </div>
        <div class="incluir">
            <button>Adicionar aluno</button>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Aluno</th>
                    <th>Telefone</th>
                    <th>E-mail</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql_listar_alunos = "  SELECT	nome, sobrenome, user_email, user_telefone, alunos.user_cod
                                            FROM	alunos_professores
                                            JOIN 	alunos ON alunos.user_cod = alunos_professores.aluno_cod
                                            JOIN	users  ON users.user_cod = alunos_professores.aluno_cod";
                    $stmt_listar_alunos = mysqli_prepare($conn, $sql_listar_alunos);
                    mysqli_stmt_execute($stmt_listar_alunos);
                    $result_listar_alunos = mysqli_stmt_get_result($stmt_listar_alunos);
                    if (mysqli_num_rows($result_listar_alunos) > 0){
                        while($row_listar_alunos = mysqli_fetch_array($result_listar_alunos)){
                            $nome_completo_aluno = $row_listar_alunos['nome']." ".$row_listar_alunos['sobrenome']
                ?>
                    <tr onclick="fnGerenciarAluno(<?=$row_listar_alunos['user_cod']?>)">
                        <td><?=$nome_completo_aluno?></td>
                        <td><?=$row_listar_alunos['user_telefone']?></td>
                        <td><?=$row_listar_alunos['user_email']?></td>
                    </tr>
                    <?php                   
                }
            }?>
            </tbody>
        </table>
    </div>
    <!-- Modal -->
    <div id="addAlunoModal" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Adicionar Aluno</h2>
        <form action="<?=$_SERVER['PHP_SELF']?>?docente_cod=<?=$docente_cod?>" method="POST">
                
                    <select name="aluno_cod" id="aluno_cod">
                        <option value="" selected disabled>Escolha um aluno</option>
                        <?php 
                            $sql_alunos = "SELECT * FROM alunos";
                            $stmt_alunos = mysqli_prepare($conn, $sql_alunos);
                            mysqli_stmt_execute($stmt_alunos);
                            $result_alunos = mysqli_stmt_get_result($stmt_alunos);
                            if (mysqli_num_rows($result_alunos) > 0){
                                while($row_alunos = mysqli_fetch_array($result_alunos)){
                                    echo "<option value=".$row_alunos['user_cod'].">".$row_alunos['nome']." ".$row_alunos['sobrenome']."</option>";
                                }
                            }
                        ?>
                    </select>
                
            <input type="hidden" name="mandar" value="yes">
            <button type="submit">Adicionar</button>
        </form>
      </div>
    </div>
</main>
<script>
    // Obter o modal
    var modal = document.getElementById("addAlunoModal");

    // Obter o botão que abre o modal
    var btn = document.querySelector(".incluir button");

    // Obter o elemento <span> que fecha o modal
    var span = document.getElementsByClassName("close")[0];

    // Quando o usuário clicar no botão, o modal será exibido
    btn.onclick = function() {
      modal.style.display = "block";
    }

    // Quando o usuário clicar no <span> (x), o modal será fechado
    span.onclick = function() {
      modal.style.display = "none";
    }

    // Quando o usuário clicar fora do modal, ele será fechado
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }

    function fnGerenciarAluno(aluno_cod){
        window.location.href="alunos.php?aluno_cod="+aluno_cod;
    }

</script>

