<?php
$id = $_GET['id'] ?? 1;

$produto = [
    'id'        => $id,
    'nome'      => 'Produto Exemplo',
    'preco'     => 'R$ 99,90',
    'descricao' => 'Descricao do produto.',
];

$avaliacoes = [
    ['usuario' => 'Joao',  'nota' => 5, 'texto' => 'Otimo!'],
    ['usuario' => 'Maria', 'nota' => 4, 'texto' => 'Bom.'],
];

$comentarios = [
    ['usuario' => 'Pedro', 'texto' => 'Chegou rapido!'],
];

function secao_avaliacoes($avaliacoes) {
    echo '<h2>Avaliacoes</h2>';
    echo '<table>';
    echo '<tr><th>Usuario</th><th>Nota</th><th>Comentario</th></tr>';
    foreach ($avaliacoes as $a) {
        echo '<tr>';
        echo '<td>' . $a['usuario'] . '</td>';
        echo '<td>' . $a['nota'] . '/5</td>';
        echo '<td>' . $a['texto'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
}

function formulario_duvidas($produto_id) {
    echo '<h2>Duvidas</h2>';
    echo '<form method="POST">';
    echo '<input type="text" name="duvida" placeholder="Sua duvida" style="width:300px">';
    echo '<input type="submit" value="ok">';
    echo '</form>';
}

function secao_comentarios($comentarios, $produto_id) {
    echo '<h2>Comentarios</h2>';
    echo '<table>';
    echo '<tr><th>Usuario</th><th>Comentario</th></tr>';
    foreach ($comentarios as $c) {
        echo '<tr><td>' . $c['usuario'] . '</td><td>' . $c['texto'] . '</td></tr>';
    }
    echo '</table>';
    echo '<form method="POST">';
    echo '<input type="text" name="nome" placeholder="Nome"><br>';
    echo '<input type="text" name="comentario" placeholder="Comentario" style="width:300px"><br>';
    echo '<input type="submit" value="ok">';
    echo '</form>';
}
?>

<div id="produto-detalhe">
    <div class="produto-imagens">
        <img src="#" alt="foto principal">
        <div class="produto-imagens-mini">
            <img src="#" alt="foto 2">
            <img src="#" alt="foto 3">
        </div>
    </div>
    <div class="produto-info">
        <h1><?= $produto['nome'] ?></h1>
        <p class="preco"><?= $produto['preco'] ?></p>
        <p><?= $produto['descricao'] ?></p>
        <form method="POST" action="index.php?pagina=carrinho">
            <input type="hidden" name="produto_id" value="<?= $produto['id'] ?>">
            <button class="btn-comprar">COMPRAR</button>
        </form>
    </div>
</div>

<hr>
<?php secao_avaliacoes($avaliacoes); ?>
<hr>
<?php formulario_duvidas($id); ?>
<hr>
<?php secao_comentarios($comentarios, $id); ?>
