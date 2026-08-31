<?php
require_once 'dao/PDOPessoaDAO.php';
require_once 'dao/PDOCidadeDAO.php';
$dao = PDOPessoaDAO::getInstance();
$view = $_GET['view'] ?? null;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Pessoas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<main class="container mt-4">
    <nav class="mb-4">
        <a href="index.php" class="btn btn-secondary">Voltar ao Início</a>
    </nav>
    <?php if ($view):
        $pessoa = $dao->obter($view);
        $cDao = PDOCidadeDAO::getInstance();
        $cidade = $cDao->obter($pessoa['cidade_id']);
    ?>
        <header class="mb-3">
            <h2>Visualizar Pessoa</h2>
        </header>
        <section class="card mb-3 w-50">
            <div class="card-body">
                <p><strong>ID:</strong> <?= $pessoa['id'] ?></p>
                <p><strong>Nome:</strong> <?= htmlspecialchars($pessoa['nome']) ?></p>
                <p><strong>Cidade:</strong> <?= htmlspecialchars($cidade['nome']) ?></p>
                <p><strong>Peso:</strong> <?= $pessoa['peso'] ?> kg</p>
                <p><strong>Altura:</strong> <?= $pessoa['altura'] ?> m</p>
            </div>
        </section>
        <a href="pessoa_list.php" class="btn btn-primary">Voltar</a>
    <?php else: ?>
        <header class="mb-3 d-flex justify-content-between align-items-center">
            <h2>Lista de Pessoas</h2>
            <a href="pessoa_cad.php" class="btn btn-primary">Nova Pessoa</a>
        </header>
        <section class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr><th>ID</th><th>Nome</th><th>Cidade</th><th>Ações</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($dao->listar() as $p): ?>
                    <tr>
                        <td><?= $p['id'] ?></td>
                        <td><?= htmlspecialchars($p['nome']) ?></td>
                        <td><?= htmlspecialchars($p['cidade_nome']) ?></td>
                        <td>
                            <a href="pessoa_list.php?view=<?= $p['id'] ?>" class="btn btn-info btn-sm">Visualizar</a>
                            <a href="pessoa_cad.php?id=<?= $p['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="pessoa_acao.php?acao=excluir&id=<?= $p['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Excluir pessoa?')">Excluir</a>
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