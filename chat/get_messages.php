<?php
include '../includes/conexao.php';
session_start();
$cod = $_SESSION['cod'];
$acesso = $_SESSION['acesso'];
$ped_num = $_GET['ped_num'];
$sua_msg = "";

// Consulta para pegar todas as mensagens entre a empresa e o técnico
$sql = "SELECT * FROM mensagens WHERE pedido = '$ped_num' AND (user_id = '$cod' OR user_id IN (SELECT user_cod FROM usuarios WHERE acesso != '$acesso')) ORDER BY id ASC";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $status = $row['msg_status'];
        $mensagem = $row['mensagem'];
        $timestamp = date('H:i', strtotime($row['timestamp']));

        // Marcar mensagem como visualizada se ainda não estiver marcada como tal
        if ($row['user_id'] != $cod && $status == 'enviada') {
            $sql_update = "UPDATE mensagens SET msg_status = 'visualizada' WHERE id = " . $row['id'];
            $conn->query($sql_update);
        }

        // Construir HTML da mensagem
        if ($row['user_id'] == $cod) {
            // Mensagem enviada pelo usuário atual
            $sua_msg .= "<div class='message sent'>";
        } else {
            // Mensagem recebida de outro usuário
            $sua_msg .= "<div class='message received'>";
        }
        $sua_msg .= "<p>$mensagem</p>";
        $sua_msg .= "<span class='timestamp'>$timestamp</span>";
        $sua_msg .= "</div>";
    }
}

echo $sua_msg;
?>