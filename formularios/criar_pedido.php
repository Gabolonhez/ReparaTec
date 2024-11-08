<?php
if(empty($ped_num)){
    $msg = "";

    // Resgatar variáveis do formulário
    $aparelho = $_POST['aparelho'] ?? "";
    $data = $_POST['data'] ?? "";
    $descricao = $_POST['descricao'] ?? "";
    $valor = isset($_POST['valor']) ? str_replace(',', '.', str_replace('.', '', $_POST['valor'])) : "";

    // Definir timezone e datas
    date_default_timezone_set('America/Sao_Paulo');
    $dataHoraAtual = date('Y-m-d H:i:s');
    $data_usuario = date('Y-m-d');

    // Selecionar dados do usuário
    $select = "SELECT * FROM usuarios WHERE user_cod = '$cod'";
    $resultSelect = mysqli_query($conn, $select);

    if ($resultSelect && mysqli_num_rows($resultSelect) > 0) {
        $row = mysqli_fetch_assoc($resultSelect);
        $empresa = $row['user_nome'];
        $emp_cod = $row['user_cod'];
    } else {
        $msg = "Nenhum dado encontrado";
    }

    // Inserir pedido no banco de dados
    if (empty($aparelho) || empty($valor) || empty($data) || empty($descricao)) {
        $msg = "Preencha todos os campos!";
    } else {
        $insert = "INSERT INTO tb_pedidos (empresa_codigo, aparelho, valor, ped_status, ped_data_abertura, descricao, data_entrega, empresa)
                   VALUES ('$emp_cod', '$aparelho', '$valor', 'Aguardando Técnico', '$dataHoraAtual', '$descricao', '$data_usuario', '$empresa')";

        $resultado = mysqli_query($conn, $insert);
        if ($resultado) {
            $msg = "Pedido criado com sucesso!";
        } else {
            $msg = "Erro ao tentar criar pedido: " . mysqli_error($conn);
        }
    }
}

?>

<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
        <div class="card m-b-30">
            <div class="card-header">
                <h5 class="m-b-0">Abrir solicitação</h5>
                <p class="m-b-0 text-muted">Essas informações serão mostradas para o técnico que irá prestar o suporte, seja o mais compreensível possível</p>
            </div>
            <div class="card-body">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="aparelho" placeholder="Equipamento (Hardware) ou Software" aria-label="Aparelho" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Seu e-mail" aria-label="Seu e-mail" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <select class="input-group-text" id="basic-addon2">
                            <option value="gmail">@gmail.com</option>
                            <option value="outlook">@outlook.com</option>
                            <option value="hotmail">@hotmail.com</option>
                            <option value="yahoo">@yahoo.com</option>
                        </select>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="js-datepicker form-control" name="data" placeholder="Data prevista">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">R$</span>
                    </div>
                    <input type="text" class="form-control" name="valor" placeholder="Valor" aria-label="Valor" oninput="formatNumber(this)">
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Descrição da solicitação</span>
                    </div>
                    <textarea class="form-control" name="descricao" aria-label="With textarea" placeholder="Descreva que suporte você precisa (manutenção, instalação, configuração, treinamento, assistência remota ou resolução de algum problema)"></textarea>
                </div>
                <br>
                <br>
                <div style="display: flex; gap: 20px; align-items: center;">
                    <button class="btn btn-primary" id="abrirPedidoBtn" type="submit">Abrir solicitação</button>
                    <div class="m-b-10">
                        <div class="spinner-border" id="loadingSpinner" role="status">
                            <span class="sr-only">Carregando...</span>
                        </div>
                    </div>
                    <div class="mdi mdi-check" id="checkIcon" style="font-size: 45px; font-weight: 700; color: lightgreen;"></div>
                    <h1><?=$msg?></h1>
                </div>
            </div>
        </div>
    </form>