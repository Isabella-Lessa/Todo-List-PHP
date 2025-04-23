<?php
$host = "localhost";
$usuario = "root";
$senha = "bella2706";
$banco = "todo_list";

$conn = new mysqli($host, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
