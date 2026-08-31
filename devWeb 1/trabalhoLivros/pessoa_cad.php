<?php
require_once 'dao/PDOPessoaDAO.php';
require_once 'dao/PDOCidadeDAO.php';
$id = $_GET['id'] ?? null;
$pessoa = ['id' => '', 'nome' => '', 'cidade_id' => '', 'peso' => '', 'altura' => ''];
$dao = PDOPessoaDAO::getInstance();
$cidadeDao = PDOCidadeDAO::getInstance();
$cidades = $cidadeDao->listar();

if ($id) $pessoa = $dao->obter($id);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Pessoa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<main class="container mt-4">
    <header class="mb-4">
        <h2><?= $id ? 'Editar' : 'Nova' ?> Pessoa</h2>
    </header>
    <section>
        <form action="pessoa_acao.php" method="POST" class="w-50">
            <input type="hidden" name="acao" value="salvar">
            <input type="hidden" name="id" value="<?= $pessoa['id'] ?>">
            
            <div class="mb-3">
                <label class="form-label">Nome:</label>
                <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($pessoa['nome']) ?>" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Cidade:</label>
                <select name="cidade_id" class="form-select" required>
                    <option value="">Selecione a Cidade...</option>
                    <?php foreach ($cidades as $c): ?>
                        <option value="<?= $c['id'] ?>" <?= ($c['id'] == $pessoa['cidade_id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($c['nome']) ?> - <?= htmlspecialchars($c['estado_nome']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Peso (kg):</label>
                <input type="number" step="0.01" name="peso" class="form-control" value="<?= $pessoa['peso'] ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Altura (m):</label>
                <input type="number" step="0.01" name="altura" class="form-control" value="<?= $pessoa['altura'] ?>">
            </div>
            
            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="pessoa_list.php" class="btn btn-danger">Cancelar</a>
        </form>
    </section>
</main>
</body>
</html>