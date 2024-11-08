<?php

include 'includes/conexao.php';
$email      = $_POST['email'] ?? "";
$senha      = $_POST['senha'] ?? "";
$senha2     = $_POST['senha2'] ?? "";
$uf         = $_POST['uf'] ?? "";
$cadastro   = $_POST['cadastro'] ?? "";
$mandar     = $_POST['mandar'] ?? "";
$nome       = $_POST['nome'] ?? "";
$sobrenome  = $_POST['sobrenome'] ?? "";


// Definindo $cadastrado como FALSE por padrão
$msg = "";

if($mandar == "sim"){
    if ($senha != $senha2){
        $msg = "As senhas estão divergentes!";
    }else{
        $insert = "INSERT INTO usuarios (user_nome, user_sobrenome, user_email, user_senha, acesso, estado) values ('$nome', '$sobrenome','$email', '$senha', '$cadastro', '$uf')";
        $result = $conn->query($insert);
        if($result == TRUE){
            header('Location: carregamento/index.html');
	        exit();
        }
    }
}

$conn->close();
?>

<?php include 'includes/head.php';?>
<body class="jumbo-page">
<main class="admin-main  ">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-lg-4  bg-white">
                <div class="row align-items-center m-h-100">
                    <div class="mx-auto col-md-8">
                        <form class="needs-validation" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                            <div class="p-b-20 text-center">
                                <p>
                                    <img src="assets/img/logo.png" width="80" alt="" style="border-radius: 10px;">

                                </p>
                                <p class="admin-brand-content">
                                    reparatec
                                </p>
                            </div>
                            <h3 class="text-center p-b-20 fw-400">Registrar-se</h3>
                            <p style="color: red; width: 100%; text-align: center;"><?=$msg?></p>
                            <div class="form-row">
                            <div class="form-group floating-label col-md-12">
                                    <label>Nome</label>
                                    <input type="text" name="nome" required class="form-control" placeholder="Nome">

                                </div>
                                <div class="form-group floating-label col-md-12">
                                    <label>Sobrenome</label>
                                    <input type="text" name="sobrenome" required class="form-control" placeholder="Sobrenome">

                                </div>

                                <div class="form-group floating-label col-md-12">
                                    <label>Email</label>
                                    <input type="email" name="email" required class="form-control" placeholder="Email">

                                </div>
                                <div class="form-group floating-label col-md-12">
                                    <label>Senha</label>
                                    <input type="password" name="senha" required class="form-control " id="password" placeholder="Senha">
                                </div>
                            </div>
                            <div class="form-group floating-label">
                                <label>Repita a senha</label>
                                <input type="password" class="form-control" name="senha2" required id="confirm_password" placeholder="Repita a senha">
                            </div>
                            <div class="form-row">
                                <div class="form-group floating-label col-md-6">
                                    <label>UF-Estado</label>
                                    <input type="text" class="form-control" name="uf" placeholder="UF-Estado" maxlength="2">
                                </div>
                                <div class="form-group floating-label show-label col-md-4">
                                        <label>Acesso</label>
                                        <select class="form-control" name="cadastro" style="width: 150px;">
                                            <option value="empresa">Empresa</option>
                                            <option value="tecnico">Técnico</option>
                                        </select>
                                    </div>
                                    <input type="hidden" name="mandar" value="sim">
                            </div>
                            <p class="">
                                <label class="cstm-switch">
                                    <input type="checkbox" checked name="option" value="1" class="cstm-switch-input">
                                    <span class="cstm-switch-indicator"></span>
                                    <span class="cstm-switch-description">  I agree to the Terms and Privacy.</span>
                                </label>


                            </p>

                            <button type="submit" class="btn btn-primary btn-block btn-lg">Criar conta</button>

                        </form>
                        <p class="text-right p-t-10">
                            <a href="login.php" class="text-underline">Já tem uma conta?</a>
                        </p>
                    </div>

                </div>
            </div>
            <div class="col-lg-8 d-none d-md-block bg-cover" style="background-image: url('assets/img/fundo.jpg');">

            </div>
        </div>
    </div>
</main>
</body>
</html>