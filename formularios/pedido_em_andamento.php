<?php

$ped_num = $_GET['ped_num'];

$selectPedido = "SELECT * FROM tb_pedidos WHERE ped_num = '$ped_num'";
$resultadoPedido = $conn->query($selectPedido);
if($resultadoPedido->num_rows > 0){
    $rowPedido = $resultadoPedido->fetch_assoc();
    $empresa_codigo = $rowPedido['empresa_codigo'];
    $tecnico_codigo = $rowPedido['tecnico_codigo'];
}

if($acesso == "tecnico"){
    $select         = "SELECT * FROM usuarios WHERE user_cod = '$empresa_codigo'";
    $resultado      = $conn->query($select);
    
    if($resultado->num_rows > 0){
        $row        = $resultado->fetch_assoc();
        $nome       = $row['user_nome'];
        $estado     = $row['estado'];
        $cidade     = $row['cidade'];
        $estado     = $row['logradouro'];
        $numero     = $row['numero'];
        $telefone   = $row['telefone'];
        $bairro     = $row['bairro'];
        $avaliacao  = $row['avaliacao'];
    }
}

if($acesso == "empresa"){
    $select         = "SELECT * FROM usuarios WHERE user_cod = '$tecnico_codigo'";
    $resultado      = $conn->query($select);
    
    if($resultado->num_rows > 0){
        $row        = $resultado->fetch_assoc();
        $nome       = $row['user_nome'];
        $estado     = $row['estado'];
        $cidade     = $row['cidade'];
        $estado     = $row['logradouro'];
        $numero     = $row['numero'];
        $telefone   = $row['telefone'];
        $bairro     = $row['bairro'];
        $avaliacao  = $row['avaliacao'];
    }
}

// Função para gerar estrelas
function gerarEstrelas($avaliacao) {
    $estrelas = '';
    for($i = 1; $i <= 5; $i++) {
        if($i <= $avaliacao) {
            $estrelas .= '<i class="fas fa-star"></i>'; // estrela cheia
        } else {
            $estrelas .= '<i class="far fa-star"></i>'; // estrela vazia
        }
    }
    return $estrelas;
}

if(!empty($_POST['encerrar']) || (!empty($_POST['solicitar']))){	
	if($acesso == "tecnico"){
		$motivo = $_POST['motivo'] ?? "";
		$updateMotivo = "UPDATE tb_pedidos SET motivo_encerrar = '$motivo'";
		$resultadoMotivo = $conn->query($updateMotivo);
		
		$nota = $_POST['nota'] ?? "";
		$update = "UPDATE tb_pedidos SET ped_status = 'Encerrado' WHERE ped_num = '$ped_num'";
		$resultadoUpdate = $conn->query($update);
		
		$selectCod = "SELECT * FROM tb_pedidos WHERE ped_num = '$ped_num'";
		$resultadoCod = $conn->query($selectCod);
		if($resultadoCod->num_rows > 0){
			$rowCod = $resultadoCod->fetch_assoc();
			$empresaCod = $rowCod['empresa_codigo'];
		}		
		$updateEmpresa = "UPDATE usuarios SET avaliacao = '$nota' WHERE user_cod = '$empresaCod'";
		$resultadoEmpresa = $conn->query($updateEmpresa);
	}
	
	if($acesso == "empresa"){
		$nota = $_POST['nota'] ?? "";
		$update = "UPDATE tb_pedidos SET ped_status = 'Encerrado' WHERE ped_num = '$ped_num'";
		$resultadoUpdate = $conn->query($update);
		
		$selectCod = "SELECT * FROM tb_pedidos WHERE ped_num = '$ped_num'";
		$resultadoCod = $conn->query($selectCod);
		if($resultadoCod->num_rows > 0){
			$rowCod = $resultadoCod->fetch_assoc();
			$tecnicoCod = $rowCod['tecnico_codigo'];
		}		
		$updateEmpresa = "UPDATE usuarios SET avaliacao = '$nota' WHERE user_cod = '$tecnicoCod'";
		$resultadoEmpresa = $conn->query($updateEmpresa);
	}
}
?>
<html lang="pt-br">
<style>
    .informacoes {
        margin-top: 40px;
        background-color: #fff;
        padding: 20px;
        box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.5);
    }
    .fa-star {
        color: gold;
    }
	.menu-pedido {
		margin-top: 50px;
		height: 100px;
		display: flex;
		justify-content: space-between;
		align-items: center;
	}
	
	.menu-pedido a{	
		display: flex;
		flex-direction: column;
	}
	.mdi-chat{
		font-size: 25px !important;
	}
</style>
<div class="tamanho-padrao">
    <div class="informacoes">
        <div style= "display: flex; flex-direction: row; justify-content: space-between; align-items: center;">
			<div><h1><?=$nome?></h1></div>
			<div><h3><?=gerarEstrelas($avaliacao)?></h3></div>
		</div>
        <h5><?=$telefone?></h5>
    </div>
	<div class="menu-pedido">
		<a href="pg_pd_004.php?ped_num=<?=$ped_num?>" target="_blank" class="btn btn-lg m-b-15 ml-2 mr-2 btn-info"><i class="mdi mdi-chat"></i>CHAT</a>
		<?php if($acesso == 'empresa'){?>
			<button type="submit" value="ENCERRAR PEDIDO" class="btn btn-lg m-b-15 ml-2 mr-2 btn-danger" data-toggle="modal" data-target="#encerramento">
				Encerrar serviço
			</button>
		<?php }?>
		<?php if($acesso == 'tecnico') {?>
			<?php if($status != 'Encerrado'){ ?>
				<button type="submit" value="SOLICITAR ENCERRAMENTO PEDIDO" class="btn btn-lg m-b-15 ml-2 mr-2 btn-danger" data-toggle="modal" data-target="#solicitarEncerramento">
				Solicitar encerramento do serviço
				</button>
			<?php }?>
			<?php if($status == 'Encerrado') {?>
				<button type="submit" class="btn btn-lg m-b-15 ml-2 mr-2 btn-warning" data-toggle="modal" data-target="#encerramento"> Avaliar Empresa </button>
			<?php }?>
		<?php }?>		
	</div>
	<?php if(($acesso == 'empresa') && (!empty($motivo))) {?>
		<div style="margin-top: 50px;">
			<h1 style="color: red;">Técnico solicitou cancelamento</h1>
			<h3><b>Motivo:</b> <?=$motivo?></h3>
		</div>
	<?php }?>
	<?php include 'modal/encerrar_pedido.php';?>
	<?php include 'modal/solicitar_encerramento.php'; ?>

</div>
<script>
</script>
