<?php
require_once 'dao/PDOPessoaDAO.php';
require_once 'dao/PDOCidadeDAO.php';

$dao = PDOPessoaDAO::getInstance();
$view = $_GET['view'] ?? null;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8"><title>Pessoas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <div class="menu"><a href="index.php">Voltar ao Início</a></div>
    <?php if ($view):
        $pessoa = $dao->obter($view);
        $cidDao = PDOCidadeDAO::getInstance();
        $cidade = $cidDao->obter($pessoa['cidade_id']);
    ?>
        <h2>Visualizar Pessoa</h2>
        <div class="view-card">
            <p><strong>ID:</strong> <?= $pessoa['id'] ?></p>
            <p><strong>Nome:</strong> <?= htmlspecialchars($pessoa['nome']) ?></p>
            <p><strong>Cidade:</strong> <?= htmlspecialchars($cidade['nome']) ?></p>
            <p><strong>Peso:</strong> <?= $pessoa['peso'] ?> kg</p>
            <p><strong>Altura:</strong> <?= $pessoa['altura'] ?> m</p>
        </div>
        <br><a href="pessoa_list.php" class="btn btn-primary">Voltar</a>
    <?php else: ?>
        <h2>Lista de Pessoas</h2>
        <a href="pessoa_cad.php" class="btn btn-primary">Nova Pessoa</a>
        <table>
            <tr><th>ID</th><th>Nome</th><th>Cidade</th><th>Ações</th></tr>
            <?php foreach ($dao->listar() as $p): ?>
            <tr>
                <td><?= $p['id'] ?></td><td><?= htmlspecialchars($p['nome']) ?></td><td><?= htmlspecialchars($p['cidade_nome']) ?></td>
                <td>
                    <a href="pessoa_list.php?view=<?= $p['id'] ?>" class="btn btn-info">Visualizar</a>
                    <a href="pessoa_cad.php?id=<?= $p['id'] ?>" class="btn btn-warning">Editar</a>
                    <a href="pessoa_acao.php?acao=excluir&id=<?= $p['id'] ?>" class="btn btn-danger" onclick="return confirm('Excluir pessoa?')">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>
</body>
</html>
