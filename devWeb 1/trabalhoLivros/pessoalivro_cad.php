<?php
require_once 'dao/PDOPessoaLivroDAO.php';
require_once 'dao/PDOPessoaDAO.php';
require_once 'dao/PDOLivroDAO.php';
$id = $_GET['id'] ?? null;
$pl = ['id' => '', 'pessoa_id' => '', 'livro_id' => '', 'data_emprestimo' => '', 'prazo' => ''];
$dao = PDOPessoaLivroDAO::getInstance();
$pessoaDao = PDOPessoaDAO::getInstance();
$livroDao = PDOLivroDAO::getInstance();

$pessoas = $pessoaDao->listar();
$livros = $livroDao->listar();

if ($id) $pl = $dao->obter($id);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Empréstimo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<main class="container mt-4">
    <header class="mb-4">
        <h2><?= $id ? 'Editar' : 'Novo' ?> Empréstimo</h2>
    </header>
    <section>
        <form action="pessoalivro_acao.php" method="POST" class="w-50">
            <input type="hidden" name="acao" value="salvar">
            <input type="hidden" name="id" value="<?= $pl['id'] ?>">
            
            <div class="mb-3">
                <label class="form-label">Pessoa:</label>
                <select name="pessoa_id" class="form-select" required>
                    <option value="">Selecione a Pessoa...</option>
                    <?php foreach ($pessoas as $p): ?>
                        <option value="<?= $p['id'] ?>" <?= ($p['id'] == $pl['pessoa_id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($p['nome']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Livro:</label>
                <select name="livro_id" class="form-select" required>
                    <option value="">Selecione o Livro...</option>
                    <?php foreach ($livros as $l): ?>
                        <option value="<?= $l['id'] ?>" <?= ($l['id'] == $pl['livro_id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($l['nome']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Data de Empréstimo:</label>
                <input type="date" name="data_emprestimo" class="form-control" value="<?= $pl['data_emprestimo'] ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Prazo de Devolução:</label>
                <input type="date" name="prazo" class="form-control" value="<?= $pl['prazo'] ?>" required>
            </div>
            
            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="pessoalivro_list.php" class="btn btn-danger">Cancelar</a>
        </form>
    </section>
</main>
</body>
</html>