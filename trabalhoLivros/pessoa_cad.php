<?php
require_once 'dao/PDOPessoaDAO.php';
require_once 'dao/PDOCidadeDAO.php';

$id = $_GET['id'] ?? null;
$pessoa = ['id' => '', 'nome' => '', 'cidade_id' => '', 'peso' => '', 'altura' => ''];

$dao = PDOPessoaDAO::getInstance();
$cidadeDao = PDOCidadeDAO::getInstance();
$cidades = $cidadeDao->listar();

if ($id) {
    $pessoa = $dao->obter($id);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8"><title>Cadastro de Pessoa</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <h2><?= $id ? 'Editar' : 'Nova' ?> Pessoa</h2>
    <form action="pessoa_acao.php" method="POST">
        <input type="hidden" name="acao" value="<?= $id ? 'Alterar' : 'Salvar' ?>">
        <input type="hidden" name="id" value="<?= $pessoa['id'] ?>">

        <label>Nome:</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($pessoa['nome']) ?>" required>

        <label>Cidade:</label>
        <select name="cidade_id" required>
            <option value="">Selecione a Cidade...</option>
            <?php foreach ($cidades as $c): ?>
                <option value="<?= $c['id'] ?>" <?= ($c['id'] == $pessoa['cidade_id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($c['nome']) ?> - <?= htmlspecialchars($c['estado_nome']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Peso (kg):</label>
        <input type="number" step="0.01" name="peso" value="<?= $pessoa['peso'] ?>">

        <label>Altura (m):</label>
        <input type="number" step="0.01" name="altura" value="<?= $pessoa['altura'] ?>">

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="pessoa_list.php" class="btn btn-danger" style="text-align: center;">Cancelar</a>
    </form>
</div>
</body>
</html>
