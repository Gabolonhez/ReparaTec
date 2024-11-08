<?php include '../include/conexao.php';?>
<?php
session_start();
$mandar = $_POST['mandar'] ?? "";
$function = $_GET['function'] ?? "";

$exists_email = FALSE;
$email_not_equals = FALSE;

$nome           = "";
$sobrenome      = "";
$email          = "";
$email2         = "";
$msg			= "";

$atualizar = FALSE;

if ($function == 'upt'){
    $email_vindo_session = $_SESSION['email'];

    $atualizar = TRUE;
    $sql_email = "SELECT * FROM users WHERE user_email = ?";
    $stmt_email = mysqli_prepare($conn, $sql_email);
    mysqli_stmt_bind_param($stmt_email, "s", $email_vindo_session);
    mysqli_stmt_execute($stmt_email);
    $result_email = mysqli_stmt_get_result($stmt_email);
    $row = mysqli_fetch_assoc($result_email);

    $nome           = $row['user_nome'];
    $sobrenome      = $row['user_sobrenome'];
    $email          = $row['user_email'];
    $email2         = $row['user_email'];


    
    if (!empty($mandar)){
        $nome           = $_POST['nome'];
        $sobrenome      = $_POST['sobrenome'];
        $email          = $_POST['email'];
        $email2         = $_POST['email2'];


        if ($email == $email2){
            $sql = "UPDATE users SET user_nome = ?, user_sobrenome = ?, user_email = ?, register_level = ? WHERE user_email = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sssss", $nome, $sobrenome, $email, "cadastro2.php", $email_vindo_session);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $_SESSION['email'] = $email;
            echo "<script>window.location.href='cadastro3.php'</script>";
        }
    }
}else{

    if (!empty($mandar)){
        $nome           = $_POST['nome'];
        $sobrenome      = $_POST['sobrenome'];
        $email          = $_POST['email'];
        $email2         = $_POST['email2'];


        $sql_email = "SELECT * FROM users WHERE user_email = ?";
        $stmt_email = mysqli_prepare($conn, $sql_email);
        mysqli_stmt_bind_param($stmt_email, "s", $email);
        mysqli_stmt_execute($stmt_email);
        $result_email = mysqli_stmt_get_result($stmt_email);

        if(mysqli_num_rows($result_email) > 0){
            $exists_email = TRUE;
			$msg = "Este e-mail já esta em uso";
        }else{
            if ($email == $email2){
                $sql = "INSERT INTO users (user_nome, user_sobrenome, user_email) VALUES (?, ?, ?)";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "sss", $nome, $sobrenome, $email);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                $_SESSION['email'] = $email;

                echo "<script>window.location.href='cadastro3.php'</script>";
            }else{
				$email_not_equals = TRUE;
				$msg = "Os e-mails continuam divergentes";
			}
        }

    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar conta</title>
    <link rel="stylesheet" href="../assets/style/cadastro/cadastro2.css">
    <link rel="stylesheet" href="../assets/style/cadastro/barras.css">
    <script src="https://kit.fontawesome.com/cc58ee488d.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <img src="../assets/img/login/logo.png" alt="Logo Helply">
        <button class="entrar" onclick="entrar()">Entrar</button>
    </header>
    <main>
        <div class="container">
            <div class="text">
                <h2>Informações básicas</h2>
                <p>Insira as informações para criar sua conta</p>
            </div>
            <div class="barra">
                <div class="info">
                    <span class="ball-select"></span>
                    <p class="text-select">INFO</p>
                </div>
                <div class="traco"></div>
                <div class="pessoal">
                    <span class="ball"></span>
                    <p class="text">PESSOAL</p>
                </div>
                <div class="traco2"></div>
                <div class="pessoal">
                    <span class="ball"></span>
                    <p class="text">PERFIL</p>
                </div>
                <div class="traco3"></div>
                <div class="pessoal">
                    <span class="ball"></span>
                    <p class="text">ACEITE</p>
                </div>
            </div>
            
            <form <?php if($atualizar){?>action="<?=$_SERVER['PHP_SELF']?>?function=upt" <?php } else {?>action="<?=$_SERVER['PHP_SELF']?>" <?php }?> method="post">
                <div class="form">
                    <?php if (($exists_email) || ($email_not_equals)){ ?>
                        <p style="color: red;"><?=$msg?></p>
                    <?php } else {?>
                        <p>&nbsp;</p>
                    <?php }?>
                    <div class="nome">
                        <label>
                            Nome <br>
                            <input type="text" name="nome" id="nome" placeholder="Osvaldo" value="<?=$nome?>">
                        </label>
                        <label>
                            Sobrenome <br>
                            <input type="text" name="sobrenome" id="sobrenome" placeholder="Sobrenome" value="<?=$sobrenome?>">
                        </label>
                    </div>
                    <div class="email">
                        <label>
                            Email <br>
                            <input type="email" name="email" id="email" placeholder="osvaldo@email.com" value="<?=$email?>">
                        </label>
                    </div>
                    <div class="email">
                        <label>
                            Confirmar email <br>
                            <input type="email" name="email2" id="email2" placeholder="osvaldo@email.com" oninput="validar_email()" value="<?=$email2?>">
                        </label>
                    </div>
                    <p id="email_igual" style="color: black;">Os emails precisam estar iguais</p>
                    <div class="botao">
                        <button type="submit"> <i class="fa-solid fa-chevron-right"></i>  Continuar</button>
                        <input type="hidden" name="mandar" value="yes">
                    </div>
                </div>
            </form>
        </div>
    </main>
</body>
<script>
    function entrar(){
        window.location.href="../index.php"
    }



    function validar_email() {
        const email = document.getElementById("email").value;
        const email2 = document.getElementById("email2").value;
        const texto = document.getElementById("email_igual");

        if (email === "" || email2 === "") {
            texto.textContent = "Os emails precisam estar iguais";
            texto.style.color = "black";
        } else if (email !== email2) {
            texto.textContent = "Os emails são diferentes";
            texto.style.color = "red";
        } else {
            texto.textContent = "Emails iguais, pode prosseguir!";
            texto.style.color = "green";
        }
    }
</script>
</html>