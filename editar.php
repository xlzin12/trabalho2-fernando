<?php
require_once 'classes/Editar.php';

$editar = new Editar();
$mensagem = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $filmeAtual = $editar->buscarFilme($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $editar->atualizarFilme($_POST['id'], $_POST['nome'], $_POST['genero'], $_POST['diretor'], $_POST['duracao']);
    header("Location: index.php"); // Redireciona de volta para a lista
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Netflix - Editar Filme</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main class="container-cadastro">
        <h1 class="titulo_form">Editar Filme</h1>
        <form method="POST" class="form-filme">
            <input type="hidden" name="id" value="<?= $filmeAtual['id'] ?>">
            
            <label>Nome:</label>
            <input type="text" name="nome" value="<?= $filmeAtual['nome'] ?>" required>

            <label>Gênero:</label>
            <input type="text" name="genero" value="<?= $filmeAtual['genero'] ?>" required>

            <label>Diretor:</label>
            <input type="text" name="diretor" value="<?= $filmeAtual['diretor'] ?>" required>

            <label>Duração:</label>
            <input type="time" name="duracao" value="<?= $filmeAtual['duracao'] ?>" required>

            <button type="submit">Atualizar</button>
        </form>
    </main>
</body>
</html>