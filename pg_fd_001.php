<?php
	include 'includes/conexao.php';
	session_start();

    $cod = $_SESSION['cod'];
    $acesso = $_SESSION['acesso'];
    include 'includes/top.php';

    $mandar = $_POST['mandar'] ?? "";
    if (!empty($mandar)){
        $nome       = $_POST['nome'];
        $telefone   = $_POST['telefone'];
        $presente   = $_POST['presente'];
        $feedback   = $_POST['feedback'];

        $sql_inserir = "INSERT INTO feedback (feedback_nome, feedback_numero, feedback_texto, feedback_palestra) VALUES (?,?,?,?)";
        $stmt_inserir = mysqli_prepare($conn, $sql_inserir);
        mysqli_stmt_bind_param($stmt_inserir, "ssss", $nome, $telefone, $feedback, $presente);
        mysqli_stmt_execute($stmt_inserir);
    }
?>
<style>
    .container{
        margin-top: 20px;
    }

    .texto-feedback{
        /* border: 1px solid; */
        width: 100%;
        height: 20%;
    }

    .texto-feedback textarea{
        width: 100%;
        height: 100%;
        resize: none;
    }
</style>
<div class="container">
    <h2>Deixe seu Feedback</h2>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
        <label>
            Seu nome: <br>
            <input type="text" name="nome" id="nome">
        </label>
        <label>
            Telefone: <br>
            <input type="text" name="telefone" id="telefone" oninput="formatPhone(this)">
        </label>
        <label>
            Você está na nossa apresentação, no nosso banner ou veio pelo Linkedin?<br>
            <select name="presente" style="width: 100%;">
                <option value="s">Sim</option>
                <option value="n">Não</option>
            </select>
        </label>
        <br>
        <label class="texto-feedback">
            Deixe sua opinião:<br>
            <textarea name="feedback"></textarea>
        </label>
        <br>
        <br>
        <input type="hidden" name="mandar" value="sim">
        <input type="submit" value="Enviar">
    </form>
</div>
<script>
    function formatPhone(input) {
        // Remove todos os caracteres não numéricos
        let phone = input.value.replace(/\D/g, "");

        // Verifica o comprimento da string de telefone e formata conforme necessário
        if (phone.length > 10) {
            phone = phone.replace(/^(\d{2})(\d{5})(\d{4})$/, "($1) $2-$3"); // Formato (xx) xxxxx-xxxx
        } else if (phone.length > 6) {
            phone = phone.replace(/^(\d{2})(\d{4})(\d{4})$/, "($1) $2-$3"); // Formato (xx) xxxx-xxxx
        } else if (phone.length > 2) {
            phone = phone.replace(/^(\d{2})(\d{4})(\d{1,4})$/, "($1) $2-$3"); // Formato (xx) xxxx-xxx
        } else {
            phone = phone.replace(/^(\d{2})/, "($1"); // Apenas o DDD (xx)
        }

        input.value = phone;
    }
</script>

<?php include 'includes/footer.php';?>