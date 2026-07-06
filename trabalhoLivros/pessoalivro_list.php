<?php
require_once 'dao/PDOPessoaLivroDAO.php';
require_once 'dao/PDOPessoaDAO.php';
require_once 'dao/PDOLivroDAO.php';

$dao = PDOPessoaLivroDAO::getInstance();
$view = $_GET['view'] ?? null;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8"><title>Empréstimos</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <div class="menu"><a href="index.php">Voltar ao Início</a></div>
    <?php if ($view):
        $pl = $dao->obter($view);
        $pDao = PDOPessoaDAO::getInstance();
        $pessoa = $pDao->obter($pl['pessoa_id']);
        $lDao = PDOLivroDAO::getInstance();
        $livro = $lDao->obter($pl['livro_id']);
    ?>
        <h2>Visualizar Empréstimo</h2>
        <div class="view-card">
            <p><strong>ID:</strong> <?= $pl['id'] ?></p>
            <p><strong>Pessoa:</strong> <?= htmlspecialchars($pessoa['nome']) ?></p>
            <p><strong>Livro:</strong> <?= htmlspecialchars($livro['nome']) ?></p>
            <p><strong>Data de Empréstimo:</strong> <?= htmlspecialchars($pl['data_emprestimo']) ?></p>
            <p><strong>Prazo:</strong> <?= htmlspecialchars($pl['prazo']) ?></p>
        </div>
        <br><a href="pessoalivro_list.php" class="btn btn-primary">Voltar</a>
    <?php else: ?>
        <h2>Lista de Empréstimos</h2>
        <a href="pessoalivro_cad.php" class="btn btn-primary">Novo Empréstimo</a>
        <table>
            <tr><th>ID</th><th>Pessoa</th><th>Livro</th><th>Prazo</th><th>Ações</th></tr>
            <?php foreach ($dao->listar() as $pl): ?>
            <tr>
                <td><?= $pl['id'] ?></td><td><?= htmlspecialchars($pl['pessoa_nome']) ?></td><td><?= htmlspecialchars($pl['livro_nome']) ?></td>
                <td><?= htmlspecialchars($pl['prazo']) ?></td>
                <td>
                    <a href="pessoalivro_list.php?view=<?= $pl['id'] ?>" class="btn btn-info">Visualizar</a>
                    <a href="pessoalivro_cad.php?id=<?= $pl['id'] ?>" class="btn btn-warning">Editar</a>
                    <a href="pessoalivro_acao.php?acao=excluir&id=<?= $pl['id'] ?>" class="btn btn-danger" onclick="return confirm('Excluir empréstimo?')">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>
</body>
</html>
