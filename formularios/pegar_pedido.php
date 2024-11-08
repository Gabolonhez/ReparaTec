<?php
if(!empty($ped_num)){
    $select = "SELECT * FROM tb_pedidos WHERE ped_num = '$ped_num'";
    $resultado = $conn->query($select);
    if($resultado->num_rows > 0){
        $row = $resultado->fetch_assoc();
        $aparelho       = $row['aparelho'];
        $empresa        = $row['empresa'];
        $descricao      = $row['descricao'];
        $imagem         = $row['dispositivo_img'];
        $empresa_cod    = $row['empresa_codigo'];
		$valor 			= number_format($row['valor'], 2, ',', '.');
		$status			= $row['ped_status'];
    }
    $selectEmpresa = "SELECT * FROM usuarios WHERE user_cod = '$empresa_cod'";
    $resultadoEmpresa = $conn->query($selectEmpresa);
    if($resultadoEmpresa->num_rows > 0){
        $rowEmpresa         = $resultadoEmpresa->fetch_assoc();
        $empresa_nome       = $rowEmpresa['user_nome'];
        $empresa_rua        = $rowEmpresa['logradouro'];
        $empresa_bairro     = $rowEmpresa['bairro'];
        $empresa_numero     = $rowEmpresa['numero'];
        $empresa_estado     = $rowEmpresa['estado'];
		$empresa_telefone	= $rowEmpresa['telefone'];
		$empresa_cidade		= $rowEmpresa['cidade'];
		$empresa_cep		= $rowEmpresa['CEP'];
    }
	
	if(!empty($_POST['aceitar_pedido'])){
		$selectTecnico = "SELECT * FROM usuarios WHERE user_cod = '$cod'";
		$resultadoTecnico = $conn->query($selectTecnico);
		if($resultadoTecnico->num_rows > 0){
			$rowTecnico = $resultadoTecnico->fetch_assoc();
			$tecnico	= $rowTecnico['user_nome'];
		}
		$tipo_pagamento = $_POST['tipo_pagamento'] ?? "";
		$insert = "UPDATE tb_pedidos SET ped_status = 'Em andamento', tecnico = '$tecnico', tecnico_codigo = '$cod', forma_pagamento = '$tipo_pagamento' WHERE ped_num ='$ped_num'";
		$resultadoInsert = $conn->query($insert);
		if($resultadoInsert){
			echo "<script>
				var x = confirm('Pedido pego com sucesso')
				if (x == true){
					window.location.href = 'pg_pd_001.php';
				}
			</script>";
		}
	}
}

?>

<div class="destaque">
    <h2>Pegar Pedido</h2>
</div>
<div style="margin-top: 50px;">
    <div style="max-width: 1000px; width: 70%; margin: 0 auto;">
        <div style="display: flex; justify-content: space-between;">
            <div style="display: flex; flex-direction: column; gap: 5px;">
                <span style="font-size: 25px;"><?=$empresa_nome?></span>
                <span style="font-size: 17px;"><?=$aparelho?></span>
                <span style="font-size: 17px;"><?=$descricao?></span>
				<span id="valor_total" style="font-size: 17px;">R$ <?=$valor?></span>     
            </div>
            <ul style="list-style: none; text-align: right;">
                <li style="font-size: 20px;"><?=$empresa_rua?> - <?=$empresa_numero?></li>
                <li style="font-size: 17px;"><?=$empresa_cidade?> - <?=$empresa_estado?></li>
                <li style="font-size: 17px;"><?=$empresa_telefone?></li>
                <li style="font-size: 17px;"><?=$empresa_cep?></li>
            </ul>
        </div>

        <!-- Novo Campo: Tipo de Pagamento -->
		<form action="#" method="post">
			<div style="margin-top: 50px; display: flex; justify-content: space-between; align-items: center">
				<div>
					<label for="tipo_pagamento" style="font-size: 17px;">Tipo de Pagamento:</label>
					<select id="tipo_pagamento" name="tipo_pagamento" class="custom-select">
						<option value="credito">Crédito</option>
						<option value="debito">Débito</option>
						<option value="dinheiro">Dinheiro</option>
						<option value="pix">Pix</option>
					</select>
				</div>
				<input type="hidden" value="sim" name="aceitar_pedido">
				<input type="submit" value="ACEITAR PEDIDO" class="btn m-b-15 ml-2 mr-2 btn-info" style="margin: 0 !important;">
			</div>
		</form>
    </div>
</div>