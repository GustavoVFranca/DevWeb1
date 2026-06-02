<?php
$noticias = [
    ['id' => 1, 'titulo' => 'Noticia 1', 'conteudo' => 'Conteudo completo da noticia 1.'],
    ['id' => 2, 'titulo' => 'Noticia 2', 'conteudo' => 'Conteudo completo da noticia 2.'],
];

function noticia_completa($noticia) {
    echo '<article class="noticia_item">';
    echo '<h2>' . $noticia['titulo'] . '</h2>';
    echo '<p>' . $noticia['conteudo'] . '</p>';
    echo '</article>';
}
?>

<h1>Noticias</h1>

<?php foreach ($noticias as $n) { ?>
    <?php noticia_completa($n); ?>
<?php } ?>
