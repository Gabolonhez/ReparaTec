<?php
	include 'includes/conexao.php';
	session_start();

    $cod = $_SESSION['cod'];
    $acesso = $_SESSION['acesso'];

    $pedidos = "";
    if (($acesso == "empresa")||($acesso == "Suporte")){
		$tipo = "Técnico";
	    $select = "SELECT * FROM tb_pedidos WHERE empresa_codigo = '$cod'";
	    $resultado = $conn->query($select);
        if($resultado->num_rows > 0){
            while($row = $resultado->fetch_assoc()){
                $pedidos .= "<tr>";
                $pedidos .= "<td><a href='pg_pd_002.php?ped_num=".$row['ped_num']."'>".$row['empresa'] ."</a></td>";
                $pedidos .= "<td><a href='pg_pd_002.php?ped_num=".$row['ped_num']."'>".$row['aparelho']."</a></td>";
                $pedidos .= "<td><a href='pg_pd_002.php?ped_num=".$row['ped_num']."'>".$row['data_entrega']."</a></td>";
                $pedidos .= "<td><a href='pg_pd_002.php?ped_num=".$row['ped_num']."'>R$ ".number_format(($row['valor']),2, ",",".") ."</a></td>";
                $pedidos .= "<td><a href='pg_pd_002.php?ped_num=".$row['ped_num']."'>".$row['ped_status'] ."</a></td>";
                $pedidos .= "</tr>";
            }
        }    
    }
	if ($acesso == "tecnico"){
	    $select = "SELECT * FROM tb_pedidos WHERE tecnico_codigo = '$cod'";
		$tipo = "Empresa";
	    $resultado = $conn->query($select);
        if($resultado->num_rows > 0){
            while($row = $resultado->fetch_assoc()){
                $pedidos .= "<tr>";
                $pedidos .= "<td><a href='pg_pd_002.php?ped_num=".$row['ped_num']."'>".$row['empresa'] ."</a></td>";
                $pedidos .= "<td><a href='pg_pd_002.php?ped_num=".$row['ped_num']."'>".$row['aparelho']."</a></td>";
                $pedidos .= "<td><a href='pg_pd_002.php?ped_num=".$row['ped_num']."'>".$row['data_entrega']."</a></td>";
                $pedidos .= "<td><a href='pg_pd_002.php?ped_num=".$row['ped_num']."'>R$ ".number_format(($row['valor']),2, ",",".") ."</a></td>";
                $pedidos .= "<td><a href='pg_pd_002.php?ped_num=".$row['ped_num']."'>".$row['ped_status'] ."</a></td>";
                $pedidos .= "</tr>";
            }
        }
    }


?>
<?php include 'includes/top.php';?>
<!--site header ends -->    <section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">

                        <h4 class=""> <span class="btn btn-white-translucent">
                                <i class="mdi mdi-table "></i></span> Verificar serviços
                        </h4>
                        <p class="opacity-75 ">
                            Verifique o andamento e histório dos serviços de suporte que você atendeu até o momento.
                        </p>


                    </div>
                </div>
            </div>
        </div>

        <div class="container pull-up">
            <div class="row">

                <div class="col-md-12">
                    <div class="card m-b-30">
                        <div class="card-header">
                            <h5 class="m-b-0">
                                <i class="mdi mdi-checkbox-intermediate"></i> Pedidos
                            </h5>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-hover ">
                                    <thead>
                                    <tr>
                                        <th><?=$tipo?></th>
                                        <th>Hardware/Software</th>
                                        <th>Data</th>
                                        <th>Valor</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?=$pedidos?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include 'includes/footer.php';?>