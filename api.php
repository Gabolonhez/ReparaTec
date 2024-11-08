<?php

$servername = "108.179.193.85";  // ou o IP do servidor de banco de dados
$username = "repara69_bruno";
$password = "faculdade@123";
$dbname = "repara69_reparatec";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Recuperar todos os usuários
    $sql = "SELECT * FROM usuarios";
    $result = $conn->query($sql);

    $usuarios = array();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $usuarios[] = $row;
        }
        echo json_encode($usuarios);  // Retorna os dados em formato JSON
    } else {
        echo json_encode(["message" => "Nenhum usuário encontrado"]);
    }
}
$conn->close();
?>
