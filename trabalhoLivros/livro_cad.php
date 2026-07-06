<?php
require_once 'dao/PDOLivroDAO.php';

$id = $_GET['id'] ?? null;
$livro = ['id' => '', 'nome' => '', 'autor' => '', 'genero' => '', 'descricao' => ''];

$dao = PDOLivroDAO::getInstance();
if ($id) {
    $livro = $dao->obter($id);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8"><title>Cadastro de Livro</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <h2><?= $id ? 'Editar' : 'Novo' ?> Livro</h2>
    <form action="livro_acao.php" method="POST">
        <input type="hidden" name="acao" value="<?= $id ? 'Alterar' : 'Salvar' ?>">
        <input type="hidden" name="id" value="<?= $livro['id'] ?>">

        <label>Nome:</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($livro['nome']) ?>" required>

        <label>Autor:</label>
        <input type="text" name="autor" value="<?= htmlspecialchars($livro['autor']) ?>" required>

        <label>Gênero:</label>
        <input type="text" name="genero" value="<?= htmlspecialchars($livro['genero']) ?>" required>

        <label>Descrição:</label>
        <textarea name="descricao" rows="4"><?= htmlspecialchars($livro['descricao']) ?></textarea>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="livro_list.php" class="btn btn-danger" style="text-align: center;">Cancelar</a>
    </form>
</div>
</body>
</html>
