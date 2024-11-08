<?php
include 'includes/conexao.php';

session_start();

$cod = $_SESSION['cod'];
$acesso = $_SESSION['acesso'];

$select = "SELECT * FROM tb_pedidos WHERE tecnico_codigo IS NULL";
$resultado = $conn->query($select);
$pedidos = "";
if($resultado->num_rows > 0){
    while($row = $resultado->fetch_assoc()){
        $data_americana = $row['data_entrega'];
        $data = new DateTime($data_americana);
        $data_brasileira = $data->format('d/m/Y');

        $pedidos .= "<tr>";
        $pedidos .= "<td><a href='pg_pd_002.php?ped_num=".$row['ped_num']."'>".$row['empresa']."</a></td>";
        $pedidos .= "<td><a href='pg_pd_002.php?ped_num=".$row['ped_num']."'>".$row['aparelho']."</a></td>";
        $pedidos .= "<td><a href='pg_pd_002.php?ped_num=".$row['ped_num']."'>R$ ".number_format($row['valor'],2 , ',', '.')."</a></td>";
        $pedidos .= "<td><a href='pg_pd_002.php?ped_num=".$row['ped_num']."'>".$data_brasileira."</a></td>";
        $pedidos .= "</tr>";
    }
}

?>
<html lang="pt-br">
<?php include 'includes/top.php';?>
<!--site header ends -->    
<section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">
                        <h4 class="">
                        Busca por serviços
                        </h4>
                        <p class="opacity-75 ">
                        Encontre serviços de suporte que ainda não foram atendidos.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container  pull-up">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="table-responsive p-t-10">
                                <table id="example-height" class="table" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Empresa</th>
                                        <th>Hardware/Software</th>
                                        <th>Valor</th>
                                        <th>Entrega</th>
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
</body>
</html>