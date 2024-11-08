<?php include '../include/conexao.php';
session_start();
$user_cod = $_SESSION['user_cod'];

$sql_informations = "SELECT * FROM users WHERE user_cod = ?";
$stmt_informations = mysqli_prepare($conn, $sql_informations);
mysqli_stmt_bind_param($stmt_informations, "i", $user_cod);
mysqli_stmt_execute($stmt_informations);
$result_informations = mysqli_stmt_get_result($stmt_informations);
$row_information = mysqli_fetch_array($result_informations);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diário</title>
    <link rel="stylesheet" href="../assets/style/diario/style.css">
    <script src="https://kit.fontawesome.com/cc58ee488d.js" crossorigin="anonymous"></script>
    <style>
        .select{
            background-color: #F36F00 !important;
            color: #FAF6F6 !important;
            padding: 5px;
            margin-left: -8px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <aside>
        <div class="cabecalho-lateral">
            <img src="../assets/img/diario/logo.png" alt="Logo Helply">
            <img src="../assets/img/diario/menu.png" alt="Imagem do menu">
        </div>
        <div class="links">
            <div class="menus">
                <div class="menu">
                    <h3>MEU ESPAÇO</h3>
                    <nav>
                        <a href="../inicial/inicial.php" <?php if ($menu == 'inicio'){ ?> class="select" <?php } ?>><img src="../assets/img/diario/house<?php if ($menu == 'inicio'){ echo "-select";}?>.png" alt="Foto do menu"> Início</a>
                        
                        <!-- A váriavel menu vem da página central e são implementado as classes para que o menu fique selecionado -->
                        <?php if ($row_information['user_tp_conta'] == 'alunos'){ ?>
                            <a href="../diario/diario2.php" <?php if ($menu == 'diario'){ ?> class="select" <?php } ?>><img src="../assets/img/diario/diario<?php if ($menu == 'diario'){ echo "-select";}?>.png" alt="Foto do Diario"> Diario</a>
                        <?php }?>
                        <a href="../dicas/dicas1.php" <?php if ($menu == 'dicas'){ ?> class="select" <?php } ?>><img src="../assets/img/diario/Dicas<?php if ($menu == 'dicas'){ echo "-select";}?>.png" alt="Foto do Dicas"> Dicas</a>
                        <a href="../sala/sala1.php"  <?php if ($menu == 'sala'){ ?> class="select" <?php } ?>><img src="../assets/img/diario/diario<?php if ($menu == 'sala'){ echo "-select";}?>.png" alt="Foto do Saúde"> Sala de Aula</a>
                        <a href="../registro/registro1.php" <?php if ($menu == 'registro'){ ?> class="select" <?php } ?>><img src="../assets/img/diario/registro<?php if ($menu == 'registro'){ echo "-select";}?>.png" alt="Foto do Registro"> Registro</a>
                    </nav>
                </div>
                <?php if ($row_information['user_tp_conta'] == 'docentes'){ ?>
                <div class="menu">
                    <h3>APRENDIZADO</h3>
                    <nav>
                        <a href="../docentes/meus_alunos.php" <?php if ($menu == 'meus_alunos'){ ?> class="select" <?php } ?>><img src="../assets/img/diario/Diario<?php if ($menu == 'meus_alunos'){ echo "-select";}?>.png" alt="Foto do Sala de aula"> Meus Alunos</a>
                        <a href="#"><img src="../assets/img/diario/lapis.png" alt="Foto do Atividades"> Atividades</a>
                    </nav>
                </div>
                <?php }?>
                <?php if ($row_information['user_tp_conta'] == 'napsi'){ ?>
                <div class="menu">
                    <h3>NAPSI</h3>
                    <nav>
                        <a href="../napsi/relacionar.php" <?php if ($menu == 'relacionar'){ ?> class="select" <?php } ?>><img src="../assets/img/diario/Diario<?php if ($menu == 'relacionar'){ echo "-select";}?>.png" alt="Foto do Sala de aula"> Relacionar Aluno e Professor</a>
                        <a href="../napsi/comunicados.php" <?php if ($menu == 'comunicados'){ ?> class="select" <?php } ?>><img src="../assets/img/diario/Diario<?php if ($menu == 'comunicados'){ echo "-select";}?>.png" alt="Foto do Sala de aula"> Comunicados</a>
                        <!-- <a href="../napsi/alunos.php" <?php if ($menu == 'alunos'){ ?> class="select" <?php } ?>><img src="../assets/img/diario/Diario<?php if ($menu == 'alunos'){ echo "-select";}?>.png" alt="Foto do Sala de aula"> Alunos</a> -->
                        <a href="../napsi/adicionar_dicas.php" <?php if ($menu == 'adicionar_dicas'){ ?> class="select" <?php } ?>><img src="../assets/img/diario/Diario<?php if ($menu == 'adicionar_dicas'){ echo "-select";}?>.png" alt="Foto do Sala de aula">Registrar nova dica</a>
                    </nav>
                </div>
                <?php }?>
                <?php if ($row_information['user_tp_conta'] != 'napsi'){ ?>
                <div class="menu">
                    <h3>COMUNICAÇÃO</h3>
                    <nav>
                        <a href="../docentes/comunicar.php" <?php if ($menu == 'comunicar'){ ?> class="select" <?php } ?>><img src="../assets/img/diario/registro<?php if ($menu == 'comunicar'){ echo "-select";}?>.png" alt="Foto do Sala de aula"> Comunicar Napsi</a>
                    </nav>
                </div>
                <?php }?>
                <?php if ($row_information['user_tp_conta'] == 'alunos'){ ?>
                <div class="menu">
                    <h3>ALUNOS</h3>
                    <nav>
                        <a href="../alunos/encontro.php" <?php if ($menu == 'encontro'){ ?> class="select" <?php } ?>><img src="../assets/img/diario/registro<?php if ($menu == 'encontro'){ echo "-select";}?>.png" alt="Foto do Sala de aula"> Marcar reunião com NAPSI</a>
                    </nav>
                </div>
                <?php }?>
                <?php if ($row_information['user_tp_conta'] != 'napis'){ ?>
                <div class="menu">
                    <h3>SISTEMA</h3>
                    <nav>
                        <a href="../feedback/feedback.php" <?php if ($menu == 'feedback'){ ?> class="select" <?php } ?>><img src="../assets/img/diario/registro<?php if ($menu == 'feedback'){ echo "-select";}?>.png" alt="Foto do Sala de aula"> Feedback</a>
                    </nav>
                </div>
                <?php }?>
            </div>
            <div class="perfil">
                <span class="imagem-perfil"><img src="../assets/img/diario/perfil.png" alt="Foto de perfil"></span>
                <span class="informacoes">
                    <h3><?=$row_information['user_nome']?></h3>
                    <p><?=strtoupper($row_information['user_tp_conta'])?></p>
                </span>
                <span class="arrow-up">
                    <i class="fa-solid fa-chevron-up"></i>
                </span>
            </div>
        </div>
    </aside>