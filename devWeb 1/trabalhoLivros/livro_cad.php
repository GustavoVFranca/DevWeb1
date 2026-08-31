<?php
require_once 'dao/PDOLivroDAO.php';
$id = $_GET['id'] ?? null;
$livro = ['id' => '', 'nome' => '', 'autor' => '', 'genero' => '', 'descricao' => ''];
if ($id) {
    $dao = PDOLivroDAO::getInstance();
    $livro = $dao->obter($id);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Livro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<main class="container mt-4">
    <header class="mb-4">
        <h2><?= $id ? 'Editar' : 'Novo' ?> Livro</h2>
    </header>
    <section>
        <form action="livro_acao.php" method="POST" class="w-50">
            <input type="hidden" name="acao" value="salvar">
            <input type="hidden" name="id" value="<?= $livro['id'] ?>">
            
            <div class="mb-3">
                <label class="form-label">Nome:</label>
                <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($livro['nome']) ?>" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Autor:</label>
                <input type="text" name="autor" class="form-control" value="<?= htmlspecialchars($livro['autor']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Gênero:</label>
                <input type="text" name="genero" class="form-control" value="<?= htmlspecialchars($livro['genero']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Descrição:</label>
                <textarea name="descricao" class="form-control" rows="4"><?= htmlspecialchars($livro['descricao']) ?></textarea>
            </div>
            
            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="livro_list.php" class="btn btn-danger">Cancelar</a>
        </form>
    </section>
</main>
</body>
</html>