<?php
require_once 'dao/PDOCidadeDAO.php';
require_once 'dao/PDOEstadoDAO.php';

$dao = PDOCidadeDAO::getInstance();
$view = $_GET['view'] ?? null;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8"><title>Cidades</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <div class="menu"><a href="index.php">Voltar ao Início</a></div>
    <?php if ($view):
        $cidade = $dao->obter($view);
        $estDao = PDOEstadoDAO::getInstance();
        $estado = $estDao->obter($cidade['estado_id']);
    ?>
        <h2>Visualizar Cidade</h2>
        <div class="view-card">
            <p><strong>ID:</strong> <?= $cidade['id'] ?></p>
            <p><strong>Nome:</strong> <?= htmlspecialchars($cidade['nome']) ?></p>
            <p><strong>Estado:</strong> <?= htmlspecialchars($estado['nome']) ?></p>
        </div>
        <br><a href="cidade_list.php" class="btn btn-primary">Voltar</a>
    <?php else: ?>
        <h2>Lista de Cidades</h2>
        <a href="cidade_cad.php" class="btn btn-primary">Nova Cidade</a>
        <table>
            <tr><th>ID</th><th>Nome</th><th>Estado</th><th>Ações</th></tr>
            <?php foreach ($dao->listar() as $c): ?>
            <tr>
                <td><?= $c['id'] ?></td><td><?= htmlspecialchars($c['nome']) ?></td><td><?= htmlspecialchars($c['estado_nome']) ?></td>
                <td>
                    <a href="cidade_list.php?view=<?= $c['id'] ?>" class="btn btn-info">Visualizar</a>
                    <a href="cidade_cad.php?id=<?= $c['id'] ?>" class="btn btn-warning">Editar</a>
                    <a href="cidade_acao.php?acao=excluir&id=<?= $c['id'] ?>" class="btn btn-danger" onclick="return confirm('Excluir cidade?')">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>
</body>
</html>
