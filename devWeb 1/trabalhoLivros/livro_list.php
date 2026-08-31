<?php
require_once 'dao/PDOLivroDAO.php';
$dao = PDOLivroDAO::getInstance();
$view = $_GET['view'] ?? null;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Livros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<main class="container mt-4">
    <nav class="mb-4">
        <a href="index.php" class="btn btn-secondary">Voltar ao Início</a>
    </nav>
    <?php if ($view): $livro = $dao->obter($view); ?>
        <header class="mb-3">
            <h2>Visualizar Livro</h2>
        </header>
        <section class="card mb-3 w-50">
            <div class="card-body">
                <p><strong>ID:</strong> <?= $livro['id'] ?></p>
                <p><strong>Nome:</strong> <?= htmlspecialchars($livro['nome']) ?></p>
                <p><strong>Autor:</strong> <?= htmlspecialchars($livro['autor']) ?></p>
                <p><strong>Gênero:</strong> <?= htmlspecialchars($livro['genero']) ?></p>
                <p><strong>Descrição:</strong> <?= nl2br(htmlspecialchars($livro['descricao'])) ?></p>
            </div>
        </section>
        <a href="livro_list.php" class="btn btn-primary">Voltar</a>
    <?php else: ?>
        <header class="mb-3 d-flex justify-content-between align-items-center">
            <h2>Lista de Livros</h2>
            <a href="livro_cad.php" class="btn btn-primary">Novo Livro</a>
        </header>
        <section class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr><th>ID</th><th>Nome</th><th>Autor</th><th>Ações</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($dao->listar() as $l): ?>
                    <tr>
                        <td><?= $l['id'] ?></td>
                        <td><?= htmlspecialchars($l['nome']) ?></td>
                        <td><?= htmlspecialchars($l['autor']) ?></td>
                        <td>
                            <a href="livro_list.php?view=<?= $l['id'] ?>" class="btn btn-info btn-sm">Visualizar</a>
                            <a href="livro_cad.php?id=<?= $l['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="livro_acao.php?acao=excluir&id=<?= $l['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Excluir livro?')">Excluir</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    <?php endif; ?>
</main>
</body>
</html>