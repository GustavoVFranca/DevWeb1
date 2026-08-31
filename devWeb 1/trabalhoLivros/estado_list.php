<?php
require_once 'dao/PDOEstadoDAO.php';
$dao = PDOEstadoDAO::getInstance();
$view = $_GET['view'] ?? null;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Estados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<main class="container mt-4">
    <nav class="mb-4">
        <a href="index.php" class="btn btn-secondary">Voltar ao Início</a>
    </nav>
    <?php if ($view): $estado = $dao->obter($view); ?>
        <header class="mb-3">
            <h2>Visualizar Estado</h2>
        </header>
        <section class="card mb-3 w-50">
            <div class="card-body">
                <p><strong>ID:</strong> <?= $estado['id'] ?></p>
                <p><strong>Nome:</strong> <?= htmlspecialchars($estado['nome']) ?></p>
                <p><strong>Sigla:</strong> <?= htmlspecialchars($estado['sigla']) ?></p>
            </div>
        </section>
        <a href="estado_list.php" class="btn btn-primary">Voltar</a>
    <?php else: ?>
        <header class="mb-3 d-flex justify-content-between align-items-center">
            <h2>Lista de Estados</h2>
            <a href="estado_cad.php" class="btn btn-primary">Novo Estado</a>
        </header>
        <section class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr><th>ID</th><th>Nome</th><th>Sigla</th><th>Ações</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($dao->listar() as $e): ?>
                    <tr>
                        <td><?= $e['id'] ?></td>
                        <td><?= htmlspecialchars($e['nome']) ?></td>
                        <td><?= htmlspecialchars($e['sigla']) ?></td>
                        <td>
                            <a href="estado_list.php?view=<?= $e['id'] ?>" class="btn btn-info btn-sm">Visualizar</a>
                            <a href="estado_cad.php?id=<?= $e['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="estado_acao.php?acao=excluir&id=<?= $e['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Excluir estado?')">Excluir</a>
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