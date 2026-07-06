<?php
require_once 'dao/PDOLivroDAO.php';

$dao = PDOLivroDAO::getInstance();
$view = $_GET['view'] ?? null;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8"><title>Livros</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <div class="menu"><a href="index.php">Voltar ao Início</a></div>
    <?php if ($view): $livro = $dao->obter($view); ?>
        <h2>Visualizar Livro</h2>
        <div class="view-card">
            <p><strong>ID:</strong> <?= $livro['id'] ?></p>
            <p><strong>Nome:</strong> <?= htmlspecialchars($livro['nome']) ?></p>
            <p><strong>Autor:</strong> <?= htmlspecialchars($livro['autor']) ?></p>
            <p><strong>Gênero:</strong> <?= htmlspecialchars($livro['genero']) ?></p>
            <p><strong>Descrição:</strong> <?= nl2br(htmlspecialchars($livro['descricao'])) ?></p>
        </div>
        <br><a href="livro_list.php" class="btn btn-primary">Voltar</a>
    <?php else: ?>
        <h2>Lista de Livros</h2>
        <a href="livro_cad.php" class="btn btn-primary">Novo Livro</a>
        <table>
            <tr><th>ID</th><th>Nome</th><th>Autor</th><th>Ações</th></tr>
            <?php foreach ($dao->listar() as $l): ?>
            <tr>
                <td><?= $l['id'] ?></td><td><?= htmlspecialchars($l['nome']) ?></td><td><?= htmlspecialchars($l['autor']) ?></td>
                <td>
                    <a href="livro_list.php?view=<?= $l['id'] ?>" class="btn btn-info">Visualizar</a>
                    <a href="livro_cad.php?id=<?= $l['id'] ?>" class="btn btn-warning">Editar</a>
                    <a href="livro_acao.php?acao=excluir&id=<?= $l['id'] ?>" class="btn btn-danger" onclick="return confirm('Excluir livro?')">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>
</body>
</html>
