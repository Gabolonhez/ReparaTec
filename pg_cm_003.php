<?php 
include 'includes/conexao.php';
session_start();
$cod = $_SESSION['cod'];
$acesso = $_SESSION['acesso'];

$mostrar    = $_POST['mostrar'] ?? "";
$mandar     = "";
$users      = "";

$buscar = $_POST['buscar'] ?? "";
$mandar = 'sim';

$select = "SELECT * FROM usuarios WHERE user_cod IN(SELECT send FROM amizades WHERE recived = '$cod' AND amz_status = 'aceita')";
$resultado = $conn->query($select);
if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $users .= "<div class='users' style='border: 1px solid black;'>";
            $users .= "<h4>".$row['user_nome']."</h4>";
            $users .= "<p>".$row['telefone']."</p>";
            $users .= "</div>";
    }
} else {
    $selectEnviado = "SELECT * FROM usuarios WHERE user_cod IN(SELECT recived FROM amizades WHERE send = '$cod' AND amz_status = 'aceita')";
    $resultadoEnviado = $conn->query($selectEnviado);
    if($resultadoEnviado->num_rows > 0){
        while ($rowResultado = $resultadoEnviado->fetch_assoc()) {
            $users .= "<div class='users' style='border: 1px solid black;'>";
                $users .= "<h4>".$rowResultado['user_nome']."</h4>";
                $users .= "<p>".$rowResultado['telefone']."</p>";
                $users .= "</div>";
        }
    }
}


?>

<style>
    #buscar{
        padding: 9px;
        font-size: 18px;
        width: 70%;
        outline: none;
        border: none;
        background-color: transparent;
        border-bottom: 1px solid gray;
    }

    .usuario{
        margin-top: 60px;
        display: flex;
        flex-direction: column;
        gap: 30px;
        /* border: 1px solid purple; */
    }

    .users{
        /* border: 1px solid blue; */
        width: 100%;
        padding: 30px 10px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 4px 4px 6px rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .users p{
        font-size: 15px !important;
        margin-top: -10px;
    }

    button{
        background-color: transparent;
        border: none;
        color: gray;
        transition: all 0.3s ease;
        outline: none;
    }

    button:hover{
        color: blue;
    }

    .botoes{
        display: flex;
    }

</style>

<?php include 'includes/top.php';?>

<div class="container">
    <div class="usuario">
        <?=$users?>
    </div>
</div>

<script>
    buscar = document.getElementById("buscar");
    buscar.focus();
</script>

<?php include 'includes/footer.php';?>

