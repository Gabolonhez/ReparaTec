<?php
include 'includes/conexao.php';
session_start();
$cod = $_SESSION['cod'];
$acesso = $_SESSION['acesso'];


$pedidos = "";
$valorTotal = 0;
if ($acesso == "tecnico") {
    $selectPedidos = "SELECT * FROM tb_pedidos WHERE tecnico_codigo = '$cod' AND ped_status = 'Encerrado'";
    $resultadoPedidos = $conn->query($selectPedidos);
    if ($resultadoPedidos->num_rows > 0) {
        while ($rowPedidos = $resultadoPedidos->fetch_assoc()) {
            $pedidos .= "<tr>";
            $pedidos .= "<td>" . $rowPedidos['aparelho'] . "</td>";
            $pedidos .= "<td>" . $rowPedidos['empresa'] . "</td>";
            $pedidos .= "<td>" . $rowPedidos['data_entrega'] . "</td>";
            $pedidos .= "<td>R$ " . number_format($rowPedidos['valor'], 2, ',', '.') . "</td>";
            $pedidos .= "</tr>";

            $valorTotal += $rowPedidos['valor'];
        }
    }
}
?>
<?php include 'includes/top.php'; ?>
<!--site header ends -->    
<section class="admin-content ">
    <div class="container-fluid bg-dark m-b-30">
        <div class="row">
            <div class="col-lg-6 my-auto text-white p-t-20 ">
                <h4 class=""><span class="btn btn-white-translucent"><i class="mdi mdi-finance "></i></span>
                Pagamentos</h4>
                <p class="opacity-75 ">
                Verifque o histórico de orçamentos e pagamentos realizados!
                </p>
            </div>
        </div>
    </div>

    <div class="container-fluid  p m-b-30">
        <div class="row">
            <div class="col-md-6 p-b-20 my-auto">
                <h5 class="m-0">Gráficos</h5>
            </div>
            <div class="col-md-6 my-auto p-b-30 text-right">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-white shadow-none js-datepicker"><i
                                class="mdi mdi-calendar"></i> Escolha uma data
                    </button>
                    <button type="button" class="btn btn-white shadow-none">Diário</button>
                    <button type="button" class="btn btn-primary shadow-none">Mensal</button>
                    <button type="button" class="btn btn-white shadow-none">Anual</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 m-b-30 col-xlg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 p-t-15" style="width: 250px;">
                                <h5>Total</h5>
                                <h4 class="text-success" style="width: 250px;"><?="R$ ". number_format($valorTotal, 2, ',', '.') ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
</div>
            <div class="col-lg-4 m-b-30 col-xlg-3 visible-xlg">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 p-t-15">
                                <p class=" text-overline">
                                Mensal
                                </p>
                                <h5>Estimativas</h5>
                                <h4 class="text-success">R$0</h4>
                            </div>
                            <div class="col-md-8 p-t-15">
                                <div id="chart-14" class="chart-canvas"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 m-b-30">
                <div class="card m-b-30">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6 my-auto">
                                <h5 class="m-0"><i class="mdi mdi-package"></i>Serviços</h5>
                            </div>
                            <div class="col-md-6 my-auto text-right">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-white shadow-none js-datepicker"><i
                                                class="mdi mdi-calendar"></i> Escolha uma data
                                    </button>
                                    <button type="button" class="btn btn-primary shadow-none">Hoje</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Hardware/Software</th>
                                    <th>Empresa</th>
                                    <th>Data</th>
                                    <th>Valor</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?= $pedidos ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include 'includes/footer.php'; ?>
<!--Additional Page includes-->
<script src="assets/vendor/apexchart/apexcharts.min.js"></script>
<!--chart data for current dashboard-->
<script src="assets/js/dashboard-04.js"></script>
</body>
</html>
