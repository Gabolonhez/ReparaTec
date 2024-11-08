<?php
include '../../include/conexao.php';

$email_id = $_GET['email_id'];

$sql = "UPDATE emails SET email_status = 'Visualizado' WHERE email_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $email_id);
mysqli_stmt_execute($stmt);

header("Location: ../../napsi/responder_email.php?email_id=".$email_id."");
?>