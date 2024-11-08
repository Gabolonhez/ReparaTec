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
$select = "SELECT * FROM usuarios WHERE user_cod IN(SELECT send FROM amizades WHERE recived = '$cod' AND amz_status = 'solicitado')";
$resultado = $conn->query($select);
if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $users .= "<div class='users' style='border: 1px solid black;'>";
            $users .= "<div>";
            $users .= "<h4>".$row['user_nome']."</h4>";
            $users .= "<p>".$row['telefone']."</p>";
            $users .= "</div>";
            $users .= "<div class='botoes'>";
                $users .= "<form action='' method='post'>";
                $users .= "<input type='hidden' name='acao' value='aceitar'>";
                $users .= "<input type='hidden' name='codigo_remetente' value='".$row['user_cod']."'>";
                $users .= "<button type='submit' class='mdi mdi-account-plus' style='font-size: 40px;'></button>";
                $users .= "</form>";
                $users .= "<form action='' method='post'>";
                $users .= "<input type='hidden' name='acao' value='recusar'>";
                $users .= "<input type='hidden' name='codigo_remetente' value='".$row['user_cod']."'>";
                $users .= "<button type='submit' class='mdi mdi-trash-can-outline' style='font-size: 40px; color: red;'></button>";
                $users .= "</form>";
                $users .= "</div>";
        $users .= "</div>";
    }
} else {
    $users = "Nenhuma solicitação enviada para você";
}

$remetente  = $_POST['codigo_remetente'] ?? "";
$acao       = $_POST['acao'] ?? "";


if($acao == 'aceitar'){
    if($remetente > 0){
        $update = "UPDATE amizades SET amz_status = 'aceita' WHERE send = '$remetente' and recived = '$cod' and amz_status = 'solicitado'";
        $resultadoupdate = $conn->query($update);
    }
}else if ($acao == 'recusar'){
    if($remetente > 0){
        $delete = "DELETE FROM amizades WHERE send = '$remetente' and recived = '$cod' and amz_status = 'solicitado'";
        $resultadodelete = $conn->query($delete);
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

