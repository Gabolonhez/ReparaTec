<?php
if($acesso == 'tecnico'){
    $selectConversa = "SELECT * FROM tb_pedidos WHERE tecnico_codigo = '$cod' and ped_status = 'Em andamento'";
    $resultadoConversa = $conn->query($selectConversa);
    $conversas = "";
    if($resultadoConversa->num_rows> 0){
        while($rowConversa = $resultadoConversa->fetch_assoc()){
            $ped_num = $rowConversa['ped_num'];
            $conversas .= "<a href='pg_pd_004.php?ped_num=$ped_num' target='_blank' class='list-group-item d-flex align-items-center' style='display: flex; justify-content: space-between; text-decoration: none;'>";
            $conversas .= "<div>";
            $conversas .= "<div class='name'>".$rowConversa['empresa']."</div>";
            $conversas .= "<div class='text-muted'>".$rowConversa['aparelho']."</div>";
            $selectQuantidadeDeMensagens = "SELECT count(*) AS mensagens FROM mensagens WHERE pedido = '$ped_num' AND msg_status != 'visualizada' AND user_id != '$cod'";
            $resultadoQuantidadeDeMensagens = $conn->query($selectQuantidadeDeMensagens);
            if($resultadoQuantidadeDeMensagens->num_rows > 0){
                $rowMensagens = $resultadoQuantidadeDeMensagens->fetch_assoc();
                if($rowMensagens['mensagens'] > 0){
                    $conversas .= "<div style='border-radius: 50%; background-color: blue; color: white; width: 22px; height: 22px; text-align: center; display: flex; justify-content: center; align-items: center; font-size: 11px;'>";
                    $conversas .= "<span>".$rowMensagens['mensagens']."</span>";
                    $conversas .= "</div>";
                }
            }
            $conversas .= "</div>";
            $conversas  .= "</a>";
        }
    }
}else{
    $selectConversa = "SELECT * FROM tb_pedidos WHERE empresa_codigo = '$cod' and ped_status = 'Em andamento'";
    $resultadoConversa = $conn->query($selectConversa);
    $conversas = "";
    if($resultadoConversa->num_rows> 0){
        while($rowConversa = $resultadoConversa->fetch_assoc()){
            $ped_num = $rowConversa['ped_num'];
            $conversas .= "<a href='pg_pd_004.php?ped_num=$ped_num' target='_blank' class='list-group-item d-flex align-items-center' id='mensagens' style='display: flex; justify-content: space-between; text-decoration: none;'>";
            $conversas .= "<div>";
            $conversas .= "<div class='name'>".$rowConversa['tecnico']."</div>";
            $conversas .= "<div class='text-muted'>".$rowConversa['aparelho']."</div>";
            $selectQuantidadeDeMensagens = "SELECT count(*) AS mensagens FROM mensagens WHERE pedido = '$ped_num' AND msg_status != 'visualizada' AND user_id != '$cod'";
            $resultadoQuantidadeDeMensagens = $conn->query($selectQuantidadeDeMensagens);
            if($resultadoQuantidadeDeMensagens->num_rows > 0){
                $rowMensagens = $resultadoQuantidadeDeMensagens->fetch_assoc();
                if($rowMensagens['mensagens'] > 0){
                    $conversas .= "<div style='border-radius: 50%; background-color: blue; color: white; width: 22px; height: 22px; text-align: center; display: flex; justify-content: center; align-items: center; font-size: 11px;'>";
                    $conversas .= "<span>".$rowMensagens['mensagens']."</span>";
                    $conversas .= "</div>";
                }
            }
            $conversas .= "</div>";
            $conversas  .= "</a>";
        }
    }
}



?>

<style>
    #mensagens:hover{
        background-color: #f4f7fc;
    }
</style>

<div class="modal modal-slide-left  fade" id="siteSearchModal" tabindex="-1" role="dialog" aria-labelledby="siteSearchModal"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body p-all-0" id="site-search">
                <button type="button" class="close light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="form-dark bg-dark text-white p-t-60 p-b-20 bg-dots" >
                    <h3 class="text-uppercase    text-center  fw-300 "> Conversas</h3>

                    <div class="container-fluid">
                        <div class="col-md-10 p-t-10 m-auto">
                            <input type="search" placeholder="Procurar Chat"
                                   class=" search form-control form-control-lg">

                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="bg-dark text-muted container-fluid p-b-10 text-center text-overline">
                        results
                    </div>
                    <div class="list-group list">
                        <?=$conversas?>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>


<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/jquery-ui/jquery-ui.min.js"></script>
<script src="assets/vendor/popper/popper.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/vendor/select2/js/select2.full.min.js"></script>
<script src="assets/vendor/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="assets/vendor/listjs/listjs.min.js"></script>
<script src="assets/vendor/moment/moment.min.js"></script>
<script src="assets/vendor/daterangepicker/daterangepicker.js"></script>
<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="assets/vendor/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="assets/js/atmos.min.js"></script>
<script src="assets/js/validadores.js"></script>
<!--page specific scripts for demo-->


</body>
</html>
<?php $conn->close(); ?>