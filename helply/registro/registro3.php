<?php 
$menu = "registro";
include '../assets/include/header.php';

$registro_id = $_GET['registro_id'];

$sql = "SELECT	    registros.*, nome, sobrenome, alunos.user_cod
        FROM	    registros
        LEFT JOIN	alunos ON registros.aluno_cod = alunos.user_cod
        WHERE	    registro_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $registro_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_array($result);

$atualizar = $_POST['atualizar'] ?? "";

if(!empty($atualizar)){
    $titulo     = $_POST['titulo'];
    $registro   = $_POST['registro'];
    $aluno_cod  = $_POST['aluno_cod'] ?? 0;

    $docente    = isset($_POST['docente']) ? $_POST['docente'] : null;
    $aluno      = isset($_POST['aluno']) ? $_POST['aluno'] : null;

    if ($docente) {
        $docente_db = 1;
    }
    if ($aluno) {
        $aluno_db = 1;
    }    

    $sql = "UPDATE registros SET docente_view = ?, aluno_view = ?, aluno_cod = ?, registro_titulo = ?, registro_total = ? WHERE registro_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iiissi", $docente_db, $aluno_db, $aluno_cod, $titulo, $registro, $registro_id);
    mysqli_stmt_execute($stmt);

    echo "<script>window.location.href='registro1.php'</script>";
}
?>
<head>
    <link rel="stylesheet" href="../assets/style/registro/registro3.css">
</head>
<body>
    <main>
        <div class="cabecalho-central">
            <div class="texto">
                <h1>Registro</h1>
                <h2>Registro pessoal de estudo</h2>
            </div>
        </div>
        <form action="<?=$_SERVER['PHP_SELF']?>?registro_id=<?=$registro_id?>" method="post">
        <div class="container">
            <div class="registro-informacoes">
                <div class="titulo">
                    <input type="text" name="titulo" id="titulo" placeholder="Insira um título ..." value="<?=$row['registro_titulo']?>">
                </div>
                <div class="sobre-registro">
                    <textarea name="registro" id="registro" placeholder="Insira seu relato ..."><?=$row['registro_total']?></textarea>
                </div>
                <div class="botao-enviar">
                    <button type="button" class="excluir" onclick="fnExcluirRegistro(<?=$registro_id?>)">Excluir</button>
                    <button type="button" onclick="abrirModal()">Continuar</button>
                </div>
            </div>
        </div>
        <div id="meuModal" class="modal">
          <div class="modal-conteudo">
            <span class="fechar" onclick="fecharModal()">&times;</span>
            <h2>Visibilidade</h2>
            <p>Para quem será visível este registro?</p>

            <div class="checkboxs" style="display: none;">
                <input type="checkbox" name="docente" id="docente">
                <input type="checkbox" name="aluno" id="aluno">
            </div>
            <div class="opcoes">
                <div class="item">
                    <h3 id="docenteText">Professores</h3>
                    <label for="docente" onclick="toggleVisibilidade('docente')">
                        <img id="docenteImg" src="../assets/img/registro/close.png" alt="Olho fechado">
                    </label>
                </div>
                <div class="item">
                    <h3 id="alunoText">Alunos</h3>
                    <label for="aluno" onclick="toggleVisibilidade('aluno')">
                        <img id="alunoImg" src="../assets/img/registro/close.png" alt="Olho fechado">
                    </label>
                </div>
            </div>
            <div class="escolherAluno" id="escolherAluno" style="visibility: hidden; opacity: 0; transition: opacity 0.5s;">
                <label>Escolha o aluno: <br>
                    <select name="aluno_cod" id="aluno_cod">

                        <option value="<?=$row['aluno_cod']?>" selected><?=$row['nome']." ". $row['sobrenome']?></option>
                        <?php 
                            $sql_alunos = " SELECT	alunos.user_cod, nome, sobrenome
                                            FROM	alunos_professores
                                            JOIN 	alunos ON alunos.user_cod = alunos_professores.aluno_cod
                                            JOIN	users  ON users.user_cod = alunos_professores.aluno_cod
                                            WHERE	professor_cod = ?";
                            $stmt_alunos = mysqli_prepare($conn, $sql_alunos);
                            mysqli_stmt_bind_param($stmt_alunos, "i", $user_cod);
                            mysqli_stmt_execute($stmt_alunos);
                            $result_alunos = mysqli_stmt_get_result($stmt_alunos);
                            if (mysqli_num_rows($result_alunos) > 0){
                                while($row_alunos = mysqli_fetch_array($result_alunos)){
                                    if ($row_alunos['user_cod'] != $row['aluno_cod']){
                                        echo "<option value=".$row_alunos['user_cod'].">".$row_alunos['nome']." ".$row_alunos['sobrenome']."</option>";
                                    }
                                }
                            }
                        ?>
                    </select>
                </label>
                <br>
                <br>
            </div>
            <button type="submit" class="enviar">Salvar</button>
            <input type="hidden" name="atualizar" value="sim">
          </div>
        </div>
        </form>
    </main>
    <script>
        function fnExcluirRegistro(registro_id){
            if (confirm("Tem certeza que deseja excluir este registro?")) {
                window.location.href = "../assets/functions/excluir_registro.php?registro_id=" + registro_id;
            }
        }
        function abrirModal() {
            document.getElementById("meuModal").style.display = "block";
        }

        function fecharModal() {
            document.getElementById("meuModal").style.display = "none";
        }

        function toggleVisibilidade(id) {
            var img = document.getElementById(id + "Img");
            var h3 = document.getElementById(id + "Text");
            const alunoSelector = document.getElementById("escolherAluno");

            if (id === 'aluno') {
                if (alunoSelector.style.visibility === "hidden") {
                    alunoSelector.style.visibility = "visible"; // Mostra o contêiner
                    setTimeout(() => {
                        alunoSelector.style.opacity = 1; // Torna opaco
                    }, 10);
                } else {
                    alunoSelector.style.opacity = 0; // Torna transparente
                    setTimeout(() => {
                        alunoSelector.style.visibility = "hidden"; // Esconde após a animação
                    }, 500); // Espera o tempo da animação antes de esconder
                }
            }

            if (img.src.includes("close.png")) {
                img.src = "../assets/img/registro/open.png";
                h3.style.color = "orange";
            } else {
                img.src = "../assets/img/registro/close.png";
                h3.style.color = ""; // Restaura a cor original
            }
        }
    </script>
</body>
