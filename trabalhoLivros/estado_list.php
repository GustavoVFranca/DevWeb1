<?php
require_once 'dao/PDOEstadoDAO.php';

$dao = PDOEstadoDAO::getInstance();
$view = $_GET['view'] ?? null;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8"><title>Estados</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <div class="menu"><a href="index.php">Voltar ao Início</a></div>
    <?php if ($view): $estado = $dao->obter($view); ?>
        <h2>Visualizar Estado</h2>
        <div class="view-card">
            <p><strong>ID:</strong> <?= $estado['id'] ?></p>
            <p><strong>Nome:</strong> <?= htmlspecialchars($estado['nome']) ?></p>
            <p><strong>Sigla:</strong> <?= htmlspecialchars($estado['sigla']) ?></p>
        </div>
        <br><a href="estado_list.php" class="btn btn-primary">Voltar</a>
    <?php else: ?>
        <h2>Lista de Estados</h2>
        <a href="estado_cad.php" class="btn btn-primary">Novo Estado</a>
        <table>
            <tr><th>ID</th><th>Nome</th><th>Sigla</th><th>Ações</th></tr>
            <?php foreach ($dao->listar() as $e): ?>
            <tr>
                <td><?= $e['id'] ?></td><td><?= htmlspecialchars($e['nome']) ?></td><td><?= htmlspecialchars($e['sigla']) ?></td>
                <td>
                    <a href="estado_list.php?view=<?= $e['id'] ?>" class="btn btn-info">Visualizar</a>
                    <a href="estado_cad.php?id=<?= $e['id'] ?>" class="btn btn-warning">Editar</a>
                    <a href="estado_acao.php?acao=excluir&id=<?= $e['id'] ?>" class="btn btn-danger" onclick="return confirm('Excluir estado?')">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>
</body>
</html>
