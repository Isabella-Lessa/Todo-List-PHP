 <!-- Comando mysql no terminal: mysql -u root -p -->

 <?php

    $host = "localhost"; // IP do servidor do banco de dados
    $usuario = "root";
    $senha = "bella2706";
    $banco = "todo_list";

    $conn = new mysqli($host, $usuario, $senha, $banco); // função que tem o caráter de conexão. isso é para fazer a conexão

    // Validação para verificar se conectou ou não
    if ($conn->connect_error) {
        die("Falha na conexão com o banco. " . $conn->connect_error);
    }

    // Tarefas:
    // criação
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['descricao'])) {
        $descricao = $conn->real_escape_string($_POST['descricao']); // real_escape_string limpa caracteres maliciosos
        $sqlInsert = "INSERT INTO tarefas (descricao) VALUES ('$descricao')";

        if ($conn->query($sqlInsert) === TRUE) {
            // Encontrou a tarefa
            header('Location: 6_todo_crud.php');
            exit;
        }
    }
    // exclusão
    if(isset($_GET['delete'])) {
        $id = intval($_GET['delete']);

        $sqlDelete = "DELETE FROM tarefas WHERE id = $id";

        if ($conn->query($sqlDelete) === TRUE) {
            header('Location: 6_todo_crud.php');
            exit;
        }
    }
    // resgate

    $tarefas = [];
    $sqlSelect = "SELECT * FROM tarefas ORDER BY data_criacao DESC";
    $result = $conn->query($sqlSelect);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) // cria um array associativo de cada tarefa
        {
            $tarefas[] = $row;
        }
    }

    ?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Todo list</title>
 </head>

 <body>
     <h1>Todo list</h1>
     <form action="6_todo_crud.php" method="post">
         <input type="text" placeholder="Descrição da tarefa" name="descricao" required>
         <button type="submit">Adicionar</button>
     </form>

     <h2>Suas tarefas</h2>
     <?php if (!empty($tarefas)): ?>
         <ul>
             <?php foreach ($tarefas as $tarefa): ?>
                 <li>
                     <?php echo $tarefa['descricao'] ?>
                     <a href="6_todo_crud.php?delete=<?php echo $tarefa['id'] ?>">Excluir</a>
                 </li>
             <?php endforeach; ?>
         </ul>
     <?php else: ?>
         <p>Não há tarefas</p>
     <?php endif; ?>
 </body>

 </html>