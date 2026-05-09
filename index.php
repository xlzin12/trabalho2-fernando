<?php
require_once 'classes/Database.php';
require_once 'classes/ListarFilmes.php';

$filme = new FilmesLista();
$filmes = $filme->listarfilmes();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netflix - Catálogo</title>
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

    <main>
        <h1>Catálogo de Filmes</h1>

        <div class="vitrine">
            <?php foreach ($filmes as $linha): ?>
                
                <div class="card-filme">
                    <img src="<?= $linha['imagem'] ?>" alt="Capa" class="capa-filme">
                    
                    <div class="info-filme">
                        <h3><?= $linha['nome'] ?></h3>
                        <p><strong>Gênero:</strong> <?= $linha['genero'] ?></p>
                        <p><strong>Diretor:</strong> <?= $linha['diretor'] ?></p>
                        <p><strong>Duração:</strong> <?= $linha['duracao'] ?> min</p>
                        
                        <a href="classes/Excluir.php?id=<?= $linha['id'] ?>" class="btn-excluir">Excluir</a>
                        <a href="editar.php?id=<?= $linha['id'] ?>" class="btn-editar" >Editar</a>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Netflix. Todos os direitos reservados.</p>
    </footer>
</body>

</html>