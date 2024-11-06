<?php
    include 'includes/conexao.php';
    //$cod = $_SESSION['cod'];
    $select = "SELECT * FROM usuarios WHERE user_cod = '$cod'";
    $resultado = $conn->query($select);
    if($resultado->num_rows > 0){
        $row = $resultado->fetch_assoc();
        $nome = mb_substr($row['user_nome'], 0, 1);
        $sobrenome = mb_substr($row['user_sobrenome'], 0, 1);
        $estado = $row['estado'];
        $nome_completo = $nome.$sobrenome;
    }

    $alertaPedidos = "select count(*) AS total from tb_pedidos WHERE empresa_codigo IN(select user_cod FROM usuarios WHERE estado = '$estado') AND ped_status = 'Aguardando Técnico'";
    $resultadoAlertaPedidos = $conn->query($alertaPedidos);
    if($resultadoAlertaPedidos->num_rows > 0){
        $rowAlertaPedidos = $resultadoAlertaPedidos->fetch_assoc();
        $total_pedidos = $rowAlertaPedidos['total'];
    }
    if($acesso == 'empresa'){
        $alertaMensagens = "select count(*) AS mensagens from mensagens WHERE pedido IN(select ped_num from tb_pedidos where empresa_codigo = '$cod') and msg_status != 'visualizada' and user_id != '$cod'";
    }else{
        $alertaMensagens = "select count(*) AS mensagens from mensagens WHERE pedido IN(select ped_num from tb_pedidos where tecnico_codigo = '$cod') and msg_status != 'visualizada' and user_id != '$cod'";
    }
    $resultadoAlertaMensagens = $conn->query($alertaMensagens);
    if($resultadoAlertaMensagens->num_rows > 0){
        $rowAlertaMensagens = $resultadoAlertaMensagens->fetch_assoc();
        $quantidadeMensagens = $rowAlertaMensagens['mensagens'];
    }

    $pedidosAmizade = 0;
    $selectPedidosAmizade = "SELECT count(*) AS pedidosAmizade FROM amizades WHERE recived = '$cod' AND amz_status = 'solicitado'";
    $resultadoPedidosAmizade = $conn->query($selectPedidosAmizade);
    if ($resultadoPedidosAmizade->num_rows > 0) {
        while ($rowPedidosAmizade = $resultadoPedidosAmizade->fetch_assoc()) {
            $pedidosAmizade = $rowPedidosAmizade['pedidosAmizade'];
        }
    }

    ?>
<style>
    .nav-link:hover{
        .nova-msg{
            text-decoration: underline;
        }
    }
</style>
    <?php include 'includes/head.php';?>
<body class="sidebar-pinned">
	<?php include 'includes/aside.php';?>
<main class="admin-main">
<header class="admin-header">
    <a href="#" class="sidebar-toggle" data-toggleclass="sidebar-open" data-target="body"></a>
    <nav class=" mr-auto my-auto">
        <ul class="nav align-items-center">
            <li class="nav-item">
                <a class="nav-link" data-target="#siteSearchModal" data-toggle="modal" href="#">
                    <i class=" mdi mdi-chat mdi-24px align-middle"></i>
                    <i class="nova-msg"><?=$quantidadeMensagens?> Novas Mensagens</i>
                </a>
            </li>
        </ul>
    </nav>
    <nav class=" ml-auto">
        <ul class="nav align-items-center">
            <li class="nav-item">
                <div class="dropdown">
                    <a href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-24px mdi-bell-outline"></i>
                        <span class="notification-counter"></span>
                    </a>
                    <div class="dropdown-menu notification-container dropdown-menu-right">
                        <div class="d-flex p-all-15 bg-white justify-content-between border-bottom ">
                            <a href="#!" class="mdi mdi-18px mdi-settings text-muted"></a>
                            <span class="h5 m-0">Notificações</span>
                            <a href="#!" class="mdi mdi-18px mdi-notification-clear-all text-muted"></a>
                        </div>
                        <div class="notification-events bg-gray-300">
                            <a href="#" class="d-block m-b-10">
                                <div class="card">
                                    <div class="card-body"> Existem<span style="font-size: 16px; font-weight: 700;"> <?=$total_pedidos?> pedidos</span> perto de você.</div>
                                </div>
                            </a>
                            <a href="pg_cm_002.php" class="d-block m-b-10">
                                <div class="card">
                                    <div class="card-body"><b style="font-size: 20px;"><?=$pedidosAmizade?></b> Solicitações de Amizade</div>
                                </div>
                            </a>
                            <a href="#" class="d-block m-b-10">
                                <div class="card">
                                    <div class="card-body">
                                        <i class="mdi mdi-cancel text-danger"></i> Your holiday has been denied
                                    </div>
                                </div>
                            </a>


                        </div>

                    </div>
                </div>
            </li>
            <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle" href="#"   role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-sm avatar-online">
                        <span class="avatar-title rounded-circle bg-dark"><?=$nome_completo?></span>

                    </div>
                </a>
                <div class="dropdown-menu  dropdown-menu-right"   >
                    <a class="dropdown-item" href="#">  Add Account
                    </a>
                    <a class="dropdown-item" href="#">  Reset Password</a>
                    <a class="dropdown-item" href="#">  Help </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"> Logout</a>
                </div>
            </li>

        </ul>

    </nav>
</header>