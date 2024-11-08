<?php 
include 'includes/conexao.php';
session_start();
$cod = $_SESSION['cod'];
$acesso = $_SESSION['acesso'];

$mostrar    = $_POST['mostrar'] ?? "";
$mandar     = "";
$users      = "";

if (!empty($mostrar)) {
    $buscar = $_POST['buscar'] ?? "";
    $mandar = 'sim';
    $select = "SELECT * FROM usuarios WHERE user_nome LIKE '%$buscar%' AND user_cod != $cod";
    $resultado = $conn->query($select);
    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            $users .= "<form action='' method='post'>";
            $users .= "<div class='users'>";
            $users .= "<div>";
            $users .= "<h4>".$row['user_nome']."</h4>";
            $users .= "<p>".$row['telefone']."</p>";
            $users .= "<input type='hidden' name='codigo_remetente' value='".$row['user_cod']."'>";
            $users .= "</div>";
            $users .= "<div><button type='submit' class='mdi mdi-account-plus' style='font-size: 40px;'></button></div>";
            $users .= "</div>";
            $users .= "</form>";
        }
    } else {
        $users = "Nenhum usuário encontrado.";
    }
}
$remetente = $_POST['codigo_remetente'] ?? "";

if($remetente > 0){
    $insert = "INSERT INTO amizades (send, recived, amz_status) value ('$cod', '$remetente', 'solicitado')";
    $resultadoInsert = $conn->query($insert);
}

?>

<style>
    form{
        display: flex;
        /* border: 1px solid black; */
        justify-content: space-between;
        align-items: center;
    }

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
        justify-content: space-between;
        align-items: center;
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

</style>

<?php include 'includes/top.php';?>

<div class="container" style="margin-top: 100px;">
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
        <input type="text" name="buscar" id="buscar" placeholder="Busque aqui...">
        <button type="submit" class="btn  m-b-30 ml-2 mr-2 btn-secondary" style="display: flex; align-items: center; margin: 0 !important; padding: 10px; width: 15%; gap: 20px; font-size: 20px;">
            <i class="mdi mdi-search-web" style="font-size: 20px;"></i> Procurar  
        </button>
        <input type="hidden" name="mostrar" value="sim">
    </form>
    <?php if($mandar == 'sim') {?>
        <div class="usuario">
            <?=$users?>
        </div>
    <?php }?>
</div>

<script>
    buscar = document.getElementById("buscar");
    buscar.focus();
</script>

<?php include 'includes/footer.php';?>

