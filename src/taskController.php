<?php
require_once __DIR__ . '/db.php';

$tarefas = [];
$erro = "";

// Criar tarefa
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['descricao'])) {
    $descricao = trim($conn->real_escape_string($_POST['descricao']));
    if ($descricao !== "") {
        $check = $conn->query("SELECT COUNT(*) as total FROM tarefas WHERE descricao = '$descricao'");
        $count = $check->fetch_assoc();
        if ($count['total'] == 0) {
            $conn->query("INSERT INTO tarefas (descricao) VALUES ('$descricao')");
            header('Location: index.php');
            exit;
        } else {
            $erro = "Tarefa já existe!";
        }
    } else {
        $erro = "Descrição não pode estar vazia!";
    }
}

// Deletar tarefa
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM tarefas WHERE id = $id");
    header('Location: index.php');
    exit;
}

// Listar tarefas
$result = $conn->query("SELECT * FROM tarefas ORDER BY data_criacao DESC");
while ($row = $result->fetch_assoc()) {
    $tarefas[] = $row;
}
