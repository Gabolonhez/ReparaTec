<?php
$menu = 'inicio';
include '../assets/include/header.php';

?>
<head>
    <link rel="stylesheet" href="style.css">
</head>
    <main>
        <h1>Bem-vindo <?=$row_information['user_nome']?>!!</h1>
        <h2>Escolha um menu para navegar:</h2>
        <div class="menus">
            <nav>
                <a href="../diario/diario2.php"><img src="../assets/img/diario/diario.png" alt="Foto do Diario"><h2> Diario</h2></a>
                <a href="#"><img src="../assets/img/diario/Dicas.png" alt="Foto do Dicas"><h2>Dicas</h2></a>
                <a href="../docentes/comunicar.php"><img src="../assets/img/diario/saude.png" alt="Foto do Saúde"> <h2>Comunicar Naspsi</h2></a>
                <a href="#"><img src="../assets/img/diario/registro.png" alt="Foto do Registro"> <h2>Registro</h2></a>
                <a href="#"><img src="../assets/img/diario/Diario.png" alt="Foto do Sala de aula"> <h2>Sala de aula</h2></a>
                <a href="#"><img src="../assets/img/diario/lapis.png" alt="Foto do Atividades"> <h2>Atividades</h2></a>
            </nav>
        </div>
    </main>
</body>
</html>