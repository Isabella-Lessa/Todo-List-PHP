<?php
require_once '../src/taskController.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Lista de Tarefas</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1>Todo List</h1>

    <?php if (!empty($erro)): ?>
        <p class="error"><?= $erro ?></p>
    <?php endif; ?>

    <form method="post" action="index.php">
        <input type="text" name="descricao" placeholder="Descrição da tarefa" required>
        <button type="submit">Adicionar</button>
    </form>

    <h2>Suas tarefas</h2>
    <?php if (!empty($tarefas)): ?>
        <ul>
            <?php foreach ($tarefas as $tarefa): ?>
                <li>
                    <?= htmlspecialchars($tarefa['descricao']) ?>
                    <a href="?delete=<?= $tarefa['id'] ?>">Excluir</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Não há tarefas.</p>
    <?php endif; ?>
</body>

</html>