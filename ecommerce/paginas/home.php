<?php
// dados de exemplo
$destaques = [
    ['titulo' => 'Produto 1', 'descricao' => 'Descricao do produto 1'],
    ['titulo' => 'Produto 2', 'descricao' => 'Descricao do produto 2'],
    ['titulo' => 'Produto 3', 'descricao' => 'Descricao do produto 3'],
];

$noticias = [
    ['id' => 1, 'titulo' => 'Noticia 1', 'resumo' => 'Resumo da noticia 1'],
    ['id' => 2, 'titulo' => 'Noticia 2', 'resumo' => 'Resumo da noticia 2'],
];

// funcoes
function destaque_item($titulo, $descricao) {
    echo '<div class="destaque_item">';
    echo '<img src="#" width="100" height="100" alt="">';
    echo '<h3>' . $titulo . '</h3>';
    echo '<p>' . $descricao . '</p>';
    echo '</div>';
}

function noticia_item($id, $titulo, $resumo) {
    echo '<article class="noticia_item">';
    echo '<h2>' . $titulo . '</h2>';
    echo '<p>' . $resumo . '</p>';
    echo '<a href="index.php?pagina=noticias&id=' . $id . '">leia mais</a>';
    echo '</article>';
}
?>

<section id="banner">
    <img src="#" width="800" height="150" alt="banner">
</section>

<h2>Destaques</h2>
<section id="destaques">
    <?php foreach ($destaques as $d) { ?>
        <?php destaque_item($d['titulo'], $d['descricao']); ?>
    <?php } ?>
</section>

<h2>Noticias</h2>
<section id="noticias">
    <?php foreach ($noticias as $n) { ?>
        <?php noticia_item($n['id'], $n['titulo'], $n['resumo']); ?>
    <?php } ?>
</section>
