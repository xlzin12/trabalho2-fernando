<?php
    require_once 'classes/Cadastro.php';
    
    $mensagem = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $filme = new Filmes();
        $filme->adicionarFilme($_POST['nome'], $_POST['genero'], $_POST['diretor'], $_FILES['imagem'], $_POST['duracao']);
       
        $mensagem = "Filme adicionado com sucesso! <a href='index.php'>Voltar ao catálogo</a>";
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netflix - Cadastrar Filme</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <nav>
            <ul class="menu">
                <li class="logo">NETFLIX</li>
                <li><a href="index.php">Início</a></li>
                <li><a href="cadastro.php">Cadastrar Filmes</a></li>
            </ul>
        </nav>
    </header>

    <main class="container-cadastro">
        <h1 class="titulo_form">Cadastrar Filmes</h1>
        
        <?php if (!empty($mensagem)): ?>
            <div class="msg-sucesso">
                <?= $mensagem ?>
            </div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data" class="form-filme">
            <label>Nome:</label>
            <input type="text" name="nome" required>

            <label>Gênero:</label>
            <input type="text" name="genero" required>

            <label>Diretor:</label>
            <input type="text" name="diretor" required>

            <label>Capa do Filme:</label>
            <input type="file" name="imagem" accept="image/*" required>

            <label>Duração:</label>
            <input type="time" name="duracao" required>

            <button type="submit">Cadastrar</button>
        </form>
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Netflix. Todos os direitos reservados.</p>
    </footer>
</body>
</html>