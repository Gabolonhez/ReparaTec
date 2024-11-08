<?php 
include 'includes/conexao.php';
session_start();

// Verifica se a sessão foi iniciada corretamente
if (!isset($_SESSION['cod']) || !isset($_SESSION['acesso'])) {
    die("Erro: Sessão não iniciada corretamente.");
}
$cod = $_SESSION['cod'];
$acesso = $_SESSION['acesso'];
$ped_num = $_GET['ped_num'] ?? "";

$selectStatus = "SELECT * FROM tb_pedidos WHERE ped_num = '$ped_num'";
$resultadoStatus = $conn->query($selectStatus);
if($resultadoStatus->num_rows > 0){
	$rowStatus = $resultadoStatus->fetch_assoc();
	$status = $rowStatus['ped_status'];
	$motivo = $rowStatus['motivo_encerrar'] ?? "";
}

?>

<?php include 'includes/top.php'; ?>
<style>
    .hidden {
        display: none;
    }

 
</style>
<body>
<?php if(empty($ped_num)) {?>
    <?php include 'formularios/criar_pedido.php'?> <!-- FORMULARIO PARA O USUÁRIO CRIAR PEDIDO -->
<?php }?>
<?php if(!empty($ped_num) && ($status == "Aguardando Técnico")){ ?>
	<?php include 'formularios/pegar_pedido.php'?> <!-- FORMULARIO PARA O USUÁRIO QUE É TÉCNICO PEGAR PEDIDO -->
<?php }?>
<?php if (!empty($ped_num) && ($status != "Aguardando Técnico")) { ?>
	<?php include 'formularios/pedido_em_andamento.php'?> <!-- FORMULARIO PARA OS USUÁRIOS VERIFICAREM COMO ESTÃO OS PEDIDOS QUE ESTÃO VINCULADO A ELES -->
<?php } ?>
<script>
var spinner = document.getElementById('loadingSpinner');
var checkIcon = document.getElementById('checkIcon');
checkIcon.classList.add('hidden');
spinner.classList.add('hidden');
document.getElementById('abrirPedidoBtn').addEventListener('click', function() {
    spinner.classList.remove('hidden');                           
    setTimeout(function() {
        spinner.classList.add('hidden');  
        checkIcon.classList.remove('hidden');
        setTimeout(function() {
            window.location.href = 'pg_pd_001.php';
        }, 100);
    }, 1500);
});

</script>
</body>
<?php include 'includes/footer.php'; ?>
