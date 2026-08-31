<?php
require_once 'dao/PDOCidadeDAO.php';
require_once 'dao/PDOEstadoDAO.php';
$dao = PDOCidadeDAO::getInstance();
$view = $_GET['view'] ?? null;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cidades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<main class="container mt-4">
    <nav class="mb-4">
        <a href="index.php" class="btn btn-secondary">Voltar ao Início</a>
    </nav>
    <?php if ($view): $cidade = $dao->obter($view); $estDao = PDOEstadoDAO::getInstance(); $estado = $estDao->obter($cidade['estado_id']); ?>
        <header class="mb-3">
            <h2>Visualizar Cidade</h2>
        </header>
        <section class="card mb-3 w-50">
            <div class="card-body">
                <p><strong>ID:</strong> <?= $cidade['id'] ?></p>
                <p><strong>Nome:</strong> <?= htmlspecialchars($cidade['nome']) ?></p>
                <p><strong>Estado:</strong> <?= htmlspecialchars($estado['nome']) ?></p>
            </div>
        </section>
        <a href="cidade_list.php" class="btn btn-primary">Voltar</a>
    <?php else: ?>
        <header class="mb-3 d-flex justify-content-between align-items-center">
            <h2>Lista de Cidades</h2>
            <a href="cidade_cad.php" class="btn btn-primary">Nova Cidade</a>
        </header>
        <section class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr><th>ID</th><th>Nome</th><th>Estado</th><th>Ações</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($dao->listar() as $c): ?>
                    <tr>
                        <td><?= $c['id'] ?></td>
                        <td><?= htmlspecialchars($c['nome']) ?></td>
                        <td><?= htmlspecialchars($c['estado_nome']) ?></td>
                        <td>
                            <a href="cidade_list.php?view=<?= $c['id'] ?>" class="btn btn-info btn-sm">Visualizar</a>
                            <a href="cidade_cad.php?id=<?= $c['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="cidade_acao.php?acao=excluir&id=<?= $c['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Excluir cidade?')">Excluir</a>
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