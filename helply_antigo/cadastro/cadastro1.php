<?php include '../include/cadastro_header.php';?>
    <main>
        <div class="container">
            <div class="text">
                <h1>Vamos criar sua conta Helpy!</h1>
                <p>Insira as informaçoes solicitadas para criar sua conta</p>
                <button class="continue" onclick="criarConta()">Vamos lá</button>
            </div>
            <img src="../assets/img/cadastro/fundo.png" alt="Fundo">
        </div>
    </main>
</body>
<script>
    function criarConta(){
        window.location.href="cadastro2.php"
    }
    function entrar(){
        window.location.href="../index.php"
    }
</script>
</html>