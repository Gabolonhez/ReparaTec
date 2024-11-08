<?php
include '../../include/conexao.php';

if (isset($_GET['registro_id'])) {
    $registro_id = $_GET['registro_id'];

    $sql = "DELETE FROM registros WHERE registro_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $registro_id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: ../../registro/registro1.php");
    } else {
        echo "Erro ao deletar o registro.";
    }
}
?>
