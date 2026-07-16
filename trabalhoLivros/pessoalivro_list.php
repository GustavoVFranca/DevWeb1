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
    <meta charset="UTF-8">
    <title>Empréstimos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<main class="container mt-4">
    <nav class="mb-4">
        <a href="index.php" class="btn btn-secondary">Voltar ao Início</a>
    </nav>
    <?php if ($view): $pl = $dao->obter($view); 
        $pDao = PDOPessoaDAO::getInstance(); $pessoa = $pDao->obter($pl['pessoa_id']);
$lDao = PDOLivroDAO::getInstance(); $livro = $lDao->obter($pl['livro_id']);
    ?>
        <header class="mb-3">
            <h2>Visualizar Empréstimo</h2>
        </header>
        <section class="card mb-3 w-50">
            <div class="card-body">
                <p><strong>ID:</strong> <?= $pl['id'] ?></p>
                <p><strong>Pessoa:</strong> <?= htmlspecialchars($pessoa['nome']) ?></p>
                <p><strong>Livro:</strong> <?= htmlspecialchars($livro['nome']) ?></p>
                <p><strong>Data de Empréstimo:</strong> <?= htmlspecialchars($pl['data_emprestimo']) ?></p>
                <p><strong>Prazo:</strong> <?= htmlspecialchars($pl['prazo']) ?></p>
            </div>
        </section>
        <a href="pessoalivro_list.php" class="btn btn-primary">Voltar</a>
    <?php else: ?>
        <header class="mb-3 d-flex justify-content-between align-items-center">
            <h2>Lista de Empréstimos</h2>
            <a href="pessoalivro_cad.php" class="btn btn-primary">Novo Empréstimo</a>
        </header>
        <section class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr><th>ID</th><th>Pessoa</th><th>Livro</th><th>Prazo</th><th>Ações</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($dao->listar() as $pl): ?>
                    <tr>
                        <td><?= $pl['id'] ?></td>
                        <td><?= htmlspecialchars($pl['pessoa_nome']) ?></td>
                        <td><?= htmlspecialchars($pl['livro_nome']) ?></td>
                        <td><?= htmlspecialchars($pl['prazo']) ?></td>
                        <td>
                            <a href="pessoalivro_list.php?view=<?= $pl['id'] ?>" class="btn btn-info btn-sm">Visualizar</a>
                            <a href="pessoalivro_cad.php?id=<?= $pl['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="pessoalivro_acao.php?acao=excluir&id=<?= $pl['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Excluir empréstimo?')">Excluir</a>
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