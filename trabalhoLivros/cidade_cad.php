<?php
require_once 'dao/PDOCidadeDAO.php';
require_once 'dao/PDOEstadoDAO.php';

$id = $_GET['id'] ?? null;
$cidade = ['id' => '', 'nome' => '', 'estado_id' => ''];

$dao = PDOCidadeDAO::getInstance();
$estadoDao = PDOEstadoDAO::getInstance();
$estados = $estadoDao->listar();

if ($id) {
    $cidade = $dao->obter($id);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8"><title>Cadastro de Cidade</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <h2><?= $id ? 'Editar' : 'Nova' ?> Cidade</h2>
    <form action="cidade_acao.php" method="POST">
        <input type="hidden" name="acao" value="<?= $id ? 'Alterar' : 'Salvar' ?>">
        <input type="hidden" name="id" value="<?= $cidade['id'] ?>">

        <label>Nome:</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($cidade['nome']) ?>" required>

        <label>Estado:</label>
        <select name="estado_id" required>
            <option value="">Selecione um Estado...</option>
            <?php foreach ($estados as $e): ?>
                <option value="<?= $e['id'] ?>" <?= ($e['id'] == $cidade['estado_id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($e['nome']) ?> (<?= $e['sigla'] ?>)
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="cidade_list.php" class="btn btn-danger" style="text-align: center;">Cancelar</a>
    </form>
</div>
</body>
</html>
