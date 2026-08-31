<?php
require_once 'dao/PDOCidadeDAO.php';
require_once 'dao/PDOEstadoDAO.php';
$id = $_GET['id'] ?? null;
$cidade = ['id' => '', 'nome' => '', 'estado_id' => ''];
$dao = PDOCidadeDAO::getInstance();
$estadoDao = PDOEstadoDAO::getInstance();
$estados = $estadoDao->listar();

if ($id) $cidade = $dao->obter($id);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Cidade</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<main class="container mt-4">
    <header class="mb-4">
        <h2><?= $id ? 'Editar' : 'Nova' ?> Cidade</h2>
    </header>
    <section>
        <form action="cidade_acao.php" method="POST" class="w-50">
            <input type="hidden" name="acao" value="salvar">
            <input type="hidden" name="id" value="<?= $cidade['id'] ?>">
            
            <div class="mb-3">
                <label class="form-label">Nome:</label>
                <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($cidade['nome']) ?>" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Estado:</label>
                <select name="estado_id" class="form-select" required>
                    <option value="">Selecione um Estado...</option>
                    <?php foreach ($estados as $e): ?>
                        <option value="<?= $e['id'] ?>" <?= ($e['id'] == $cidade['estado_id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($e['nome']) ?> (<?= $e['sigla'] ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="cidade_list.php" class="btn btn-danger">Cancelar</a>
        </form>
    </section>
</main>
</body>
</html>