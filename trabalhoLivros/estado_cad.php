<?php
require_once 'dao/PDOEstadoDAO.php';

$id = $_GET['id'] ?? null;
$estado = ['id' => '', 'nome' => '', 'sigla' => ''];

$dao = PDOEstadoDAO::getInstance();
if ($id) {
    $estado = $dao->obter($id);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8"><title>Cadastro de Estado</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <h2><?= $id ? 'Editar' : 'Novo' ?> Estado</h2>
    <form action="estado_acao.php" method="POST">
        <input type="hidden" name="acao" value="<?= $id ? 'Alterar' : 'Salvar' ?>">
        <input type="hidden" name="id" value="<?= $estado['id'] ?>">

        <label>Nome:</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($estado['nome']) ?>" required>

        <label>Sigla:</label>
        <input type="text" name="sigla" value="<?= htmlspecialchars($estado['sigla']) ?>" required maxlength="2">

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="estado_list.php" class="btn btn-danger" style="text-align: center;">Cancelar</a>
    </form>
</div>
</body>
</html>
