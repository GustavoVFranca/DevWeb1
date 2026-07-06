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

if ($id) {
    $pl = $dao->obter($id);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8"><title>Cadastro de Empréstimo</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <h2><?= $id ? 'Editar' : 'Novo' ?> Empréstimo</h2>
    <form action="pessoalivro_acao.php" method="POST">
        <input type="hidden" name="acao" value="<?= $id ? 'Alterar' : 'Salvar' ?>">
        <input type="hidden" name="id" value="<?= $pl['id'] ?>">

        <label>Pessoa:</label>
        <select name="pessoa_id" required>
            <option value="">Selecione a Pessoa...</option>
            <?php foreach ($pessoas as $p): ?>
                <option value="<?= $p['id'] ?>" <?= ($p['id'] == $pl['pessoa_id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($p['nome']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Livro:</label>
        <select name="livro_id" required>
            <option value="">Selecione o Livro...</option>
            <?php foreach ($livros as $l): ?>
                <option value="<?= $l['id'] ?>" <?= ($l['id'] == $pl['livro_id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($l['nome']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Data de Empréstimo:</label>
        <input type="date" name="data_emprestimo" value="<?= $pl['data_emprestimo'] ?>" required>

        <label>Prazo de Devolução:</label>
        <input type="date" name="prazo" value="<?= $pl['prazo'] ?>" required>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="pessoalivro_list.php" class="btn btn-danger" style="text-align: center;">Cancelar</a>
    </form>
</div>
</body>
</html>
