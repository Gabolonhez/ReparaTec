<?php
include '../includes/conexao.php';
session_start();
$cod = $_SESSION['cod'];
$ped_num = $_GET['ped_num'];
$mensagem = $_POST['mensagem_enviada'] ?? "";

if (!empty($mensagem)) {
    $mandar = "INSERT INTO mensagens (user_id, mensagem, pedido, msg_status) values ('$cod', '$mensagem', '$ped_num', 'enviada')";
    $conn->query($mandar);
}
?>
